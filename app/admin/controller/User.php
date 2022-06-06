<?php
/*
 *  +----------------------------------------------------------------------
 *  | HUTCMS
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2022 http://hutcms.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://mit-license.org )
 *  +----------------------------------------------------------------------
 *  | Author: lishelun <lishelun@qq.com>
 *  +----------------------------------------------------------------------
 */

declare (strict_types=1);

namespace app\admin\controller;

use hutphp\Controller;
use hutphp\helper\JWTHelper;
use hutphp\service\AdminService;
use think\db\exception\DbException;

/**
 * 用户
 */
class User extends Controller
{
    protected string $table = 'system_user';

    /**
     * 用户登陆
     * @return void
     */
    public function login(): void
    {
        if ( $this->request->isGet() ) {
            $this->fetch();
        }

        $login_type = $this->request->param('login_type/s' , '');
        if ( $login_type == 'phone' ) {
            $this->__loginFromPhone();
        }
        else {
            $this->__loginFromPass();
        }
    }

    /**
     * 退出登陆
     * @login true
     * @return void
     */
    public function exit(): void
    {
        AdminService::instance()->clearSession();
        if ( session('user.id') ) {
            $this->error();
        }
        $this->success();
    }

    /**
     * 设置用户信息
     * @login true
     * @return void
     */
    public function setInfo(): void
    {
        if ( $this->request->isGet() ) {
            $this->error('post');
        }
        $login    = $this->__check();
        $id       = input('id');
        $password = input('password');
        $data     = [];
        if ( $password ) {
            $data['salt']     = random(8 , 3);
            $data['password'] = create_password($password , $data['salt']);
        }
        if ( !$id == $login['id'] && AdminService::instance()->isSuper() ) {
            $this->error(lang('hutcms_not_admin_only_edit_self_user'));
        }

        try {
            $this->_form('' , '' , 'id' , [] , $data);
        } catch (\Exception $exception) {
            $this->error('' , ['error' => $exception->getMessage()]);
        }
    }

    /**
     * 获取用户信息
     * @login true
     * @return void
     */
    public function getInfo(): void
    {
        $login = $this->__check();
        $id    = input('id');
        if ( !$id == $login['id'] && AdminService::instance()->isSuper() ) {
            $this->error(lang('hutcms_not_admin_only_fetch_self_user'));
        }
        $data = $this->query()->field('id,username,nickname,phone,email,pic,truename,role_id,status')->findOrEmpty($id);
        if ( $data->isEmpty() ) {
            $this->error('数据错误');
        }
        $this->success('ok' , ['data' => $data]);
    }

    /**
     * 设置密码
     * @login true
     * @return void
     */
    public function setPass(): void
    {
        if ( $this->request->isGet() ) {
            $this->error('post');
        }
        $login = $this->__check();
        $id    = input('id');
        if ( !$id == $login['id'] && AdminService::instance()->isSuper() ) {
            $this->error(lang('hutcms_not_admin_only_edit_self_user'));
        }

        $do = $this->query()->findOrEmpty($id);
        $do->isEmpty() && $this->error(lang('hutcms_user_data_error'));
        $new_password = $this->request->param('new_password/s');
        $re_password  = $this->request->param('re_password/s');

        if ( !$new_password == $re_password ) {
            $this->error(lang('hutcms_passwords_are_inconsistent'));
        }

        $salt         = random(8 , 3);
        $md5          = create_password($new_password , $salt);
        $do->password = $md5;
        if ( $do->save() ) {
            $this->success();
        }
        $this->error();
    }

    public function captcha()
    {
        $out = base64_encode(captcha()->getContent());
        $this->success('ok' , ['data' => ['captcha' => "data:image/png;base64,{$out}"]]);
    }

    /**
     * 检查登陆
     * @login true
     * @return bool|array
     */
    private function __check(): bool|array
    {
        $user = JWTHelper::instance()->checkLogin();
        if ( is_array($user) && !empty($user) ) {
            return $user;
        }
        else {
            $this->error(lang('hutphp_not_login') , [] , 4001);
            return false;
        }
    }

    /**
     * 使用用户名密码登陆
     * @return void
     */
    private function __loginFromPass(): void
    {
        $username = $this->request->param('username/s' , '');
        $password = $this->request->param('password/s' , '');
        $captcha  = $this->request->param('captcha/s' , '');

        if ( empty($username) ) {
            $this->error(lang('hutcms_input_username'));
        }
        if ( empty($password) ) {
            $this->error(lang('hutcms_input_password'));
        }
        if ( empty($captcha) ) {
            $this->error(lang('hutcms_input_captcha'));
        }
        $ip    = $this->request->ip();
        $check = $this->query("system_user_log")->where("ip" , $ip)->where("status" , 2)->whereDay('create_at')->count();
        if ( $check >= (int)hut_conf('user.login_max_num' , null , '5') ) {
            $this->error(lang('hutcms_login_num_out'));
        }

        //检查验证码
        if ( !captcha_check($captcha) ) {
            $this->error(lang('hutcms_captcha_error'));
        }
        //检查用户名和密码
        $user = $this->query()->where('username' , '=' , $username)->whereOr('phone' , '=' , $username)->fetchSql(false)->findOrEmpty();
        if ( $user->isEmpty() ) {
            $this->error(lang('hutcms_username_error'));
        }


        $md5_password = create_password($password , $user['salt']);
        if ( $md5_password != $user['password'] ) {
            $this->__log(2 , ['username' => $username , 'password' => $password]);
            $this->error(lang('hutcms_password_error'));
        }

        $this->__globalLogin($user);
    }

    /**
     * 使用手机验证码登陆
     * @return void
     */
    private function __loginFromPhone(): void
    {
        $phone_code = $this->request->param('code/s' , '');
        $phone      = $this->request->param('phone/s' , '');

        if ( !$phone ) {
            $this->error(lang('hutcms_input_phone'));
        }
        if ( !$phone_code ) {
            $this->error(lang('hutcms_input_phone_code'));
        }

        $sms = $this->query('system_user_sms')->where('phone' , $phone)->order('create_time' , 'desc')->limit(1)->findOrEmpty();
        if ( $sms->isEmpty() ) {
            $this->error(lang('hutcms_need_send_phone_code'));
        }
        if ( $sms->code != $phone_code ) {
            $this->error(lang('hutcms_phone_code_error'));
        }

        $user = $this->query()->findOrEmpty($sms['user_id']);
        if ( $user->isEmpty() ) {
            $this->error(lang('hutcms_phone_error'));
        }
        $this->__globalLogin($user);
    }

    /**
     * 登陆公共部分
     * @param $user
     * @return void
     */
    private function __globalLogin($user): void
    {
        if ( $user['status'] <> 1 ) {
            $this->error(lang('hutcms_user_status_deny'));
        }
        $role = $this->query('system_role')->where('id' , $user['role_id'])->findOrEmpty();
        if ( $role->isEmpty() ) {
            $this->error(lang('hutcms_role_data_error'));
        }
        if ( $role['status'] <> 1 ) {
            $this->error(lang('hutcms_role_status_deny'));
        }

        //jwt用户信息
        $token_data  = [
            'id'       => $user['id'] ,
            'username' => $user['username'] ,
            'nickname' => $user['nickname'] ,
            'role_id'  => $user['role_id'] ,
            'rolename' => $role['name']
        ];
        $expire_time = $user['expire_time'] ?: (int)hut_conf('user.user_login_expired_time' , null , '3600');
        $token       = JWTHelper::instance()->encode($token_data , $expire_time);
        //更新用户信息
        $user['token']      = $token;
        $user['login_time'] = time();
        $user['login_ip']   = $this->request->ip();
        $user['login_port'] = $this->request->remotePort();
        $user['login_num']  = intval($user['login_num']) + 1;
        try {
            $user->master(true)->update($user->toArray());
        } catch (\Exception $exception) {
            $this->error(lang('hutcms_login_error') , ['error' => $exception->getMessage()]);
        }

        //额外返回前台信息
        $token_data['pic']         = $user['pic'];
        $token_data['token']       = $token;
        $token_data['expire_time'] = $expire_time + time();
        $token_data['auth']        = $role['auth'];
        $token_data['rolename']    = $role['name'];

        //设置sessions
        AdminService::instance()->setSession($token_data);
        $this->__log(1 , array_merge($token_data , ['login_ip' => $user['login_ip'] , 'login_port' => $user['login_port'] , 'login_time' => $user['login_time']]));
        $this->success(lang('hutcms_login_success') , ['data' => $token_data]);
    }

    public function session()
    {
        $data = $this->__check();
        $this->success('ok' , ['data' => $data]);
    }

    /**
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\DataNotFoundException
     */
    public function loginInfo()
    {
        $user = $this->__check();
        $last = $this->query('system_user_log')
                     ->where('user_id' , $user['id'])
                     ->where('status' , 1)
                     ->order('create_at' , 'desc')->limit(2)->select();

        $num=$this->query('system_user')->where('id' , $user['id'])->column('login_num');
        $data = [];

        $data['login_ip']        = $last[0]['ip'] ?? '-';
        $data['login_time']      = $last[0]['create_at'] ?? '-';
        $data['login_num']       = $num ?: '0';
        $data['username']        = $user['username'] ?? '-';
        $data['last_login_ip']   = $last[1]['ip'] ?? '-';
        $data['last_login_time'] = $last[1]['create_at'] ?? '-';

        $data['role_id'] = $user['role_id']??'-';
        $data['rolename'] = $user['rolename']??'-';


        $this->success('ok' , ['data' => $data]);

    }

    private function __log($status , $add = []): void
    {
        $data            = [];
        $data['status']  = $status;
        $data['user_id'] = 0;
        $data['username'] = $add['username'];
        if ( $status == 1 ) {
            $data['user_id']  = $add['id'];
            $data['pass']     = 'success';
            $data['ip']       = $add['login_ip'];
            $data['port']     = $add['login_port'];
        }
        else {
            $data['pass']     = $add['password'];
            $data['ip']       = $this->request->ip();
            $data['port']     = $this->request->remotePort();
        }
        $this->query('system_user_log')->insertGetId($data);
    }
}