<?php
if ( !function_exists('hut_log') ) {
    /**
     * 写入系统日志
     * @param string      $type    日志类型
     * @param string|null $content 日志内容
     * @return mixed
     */
    function hut_log(string $type , ?string $content = null): bool
    {

        $log = [
            'node' => \hutphp\service\NodeService::instance()->getCurrent() ,
            '$type' => $$type , 'content' => $content ,
            'ip' => request()->ip() ?: '127.0.0.1' ,
            'port' => request()->port() ,
            'username' => \hutphp\service\AdminService::instance()->getUserName() ?: '-' ,
            'create_at' => time() ,
        ];
        //to do...
        return false;
    }
}
if ( !function_exists('hut_var') ) {
    /**
     * 系统变量
     * @param string      $name
     * @param string|null $value
     * @return string|array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    function hut_var(string $name = '' , ?string $value = null): string|array|bool
    {
        static $data = [];
        if ( $value === null ) {
            if ( $name ) {
                if ( isset($data[$name]) ) return $data[$name];
                if ( ($data = cache('hut_var')) && isset($data[$name]) ) return $data[$name];
            } else {
                if ( count($data) > 0 ) return $data;
                if ( $data = cache('hut_var') ) return $data;
            }
            $r = \think\facade\Db::name('system_var')->select()->toArray();
            if ( $r ) foreach ( $r as $item ) {
                $data[$item['name']] = $item['value'];
            }
            if ( $data ) {
                cache('hut_var' , $data);
            }
            return hut_var($name);
        } else {
            $query = \think\facade\Db::name('system_var');
            $save = ['value' => $value];
            if ( $name ) {
                if ( !$value ) return false;
                if ( $result = data_save('system_var' , $save , 'id' , ['name' => $name]) ) {
                    $data = [];
                    cache('hut_var' , null);
                    $r = \think\facade\Db::name('system_var')->select()->toArray();
                    if ( $r ) foreach ( $r as $item ) {
                        $data[$item['name']] = $item['value'];
                    }
                    if ( $data ) {
                        cache('hut_var' , $data);
                        return true;
                    }
                }
            }
            return false;
        }
    }
}
if ( !function_exists('hut_conf') ) {
    /**
     * 系统配置
     * @param string|null $name
     * @param string|null $value
     * @return string|array|bool
     */
    function hut_conf(string $name = null , ?string $value = null): bool|array|string
    {

        return false;
    }
}
if ( !function_exists('hutcms_path') ) {
    /**
     * 获得hutcms目录
     * @param string $path
     * @return string
     */
    function hutcms_path(string $path=''): string
    {
        return HUTCMS_PATH. ($path ? ltrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR : $path);
    }
}