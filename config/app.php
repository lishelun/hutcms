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

// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------

return [
    // 应用地址
    'app_host'              => env('app.host' , '') ,
    // 应用的命名空间
    'app_namespace'         => '' ,
    // 是否启用路由
    'with_route'            => true ,
    // 开启应用快速访问
    'app_express'           => true ,
    // 默认应用
    'default_app'           => 'web' ,
    // 默认时区
    'default_timezone'      => 'Asia/Shanghai' ,
    // 应用映射（自动多应用模式有效）
    'app_map'               => [] ,
    // 域名绑定（自动多应用模式有效）
    'domain_bind'           => [] ,
    // 禁止URL访问的应用列表（自动多应用模式有效）
    'deny_app_list'         => [] ,

    // 异常页面的模板文件
    'exception_tmpl'        => root_path(). 'hutcms/view/hutcms_exception.php' ,

    // 错误显示信息,非调试模式有效
    'error_message'         => '页面错误！请稍后再试～' ,
    /**
     * ----------------------------------
     * hutcms配置
     * ----------------------------------
     */
    // 显示错误信息
    'show_error_msg'        => false ,
    //后台超级用户
    'super_username'        => ['admin'] ,
    //前台超级用户
    'super_membername'      => ['admin'] ,
    //开启后台验证的app
    'auth_app'              => ['admin'] ,
    //禁止后台权限验证的控制器
    'deny_auth_list'        => ['admin@user/login' , 'admin@user/exit' , 'admin@index/index','admin@user/captcha'] ,
    //是否开启模型日志
    'open_hutcms_model_log' => false,
    // CORS 自动配置跨域
    'cors_auto'               => true,
    // CORS 配置跨域域名
    'cors_host'               => [],
    // CORS 授权请求方法
    'cors_methods'            => 'GET,PUT,POST,PATCH,DELETE,OPTIONS',
    // CORS 跨域头部字段
    'cors_headers'            => 'Api-Name,Api-Type,Api-Token,User-Form-Token,User-Token,Token,Lang,Access-Token',
    //JWT 密匙
    'JWT_secret'=>'2nUS[1-TH^mL{dW3N>ZAfaJ:z&4l+jsXoCy@h0PI~',
    'user_check_header'=>"Authorization"
];
