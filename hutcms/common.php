<?php
if ( !function_exists('hut_log') ) {
    /**
     * 写入系统日志
     *
     * @param string      $type    日志类型
     * @param string|null $content 日志内容
     *
     * @return mixed
     */
    function hut_log(string $type , ?string $content = null): bool
    {
        $log = [
            'type'     => $type ,
            'node'     => \hutphp\service\NodeService::instance()->getCurrent() ,
            'content'  => $content ,
            'ip'       => request()->ip() ?: '127.0.0.1' ,
            'port'     => request()->remotePort() ,
            'username' => \hutphp\service\AdminService::instance()->getUserName() ?: '-' ,
            'user_id'  => \hutphp\service\AdminService::instance()->getUserId() ?: '0' ,
        ];
        return M('system_log' , $log)->save();
    }
}
if ( !function_exists('hut_var') ) {
    /**
     * 系统变量
     *
     * @param string      $name 变量名
     * @param string|null $value 变量值
     * @param string      $description 变量描述
     * @param string|null $default  默认值
     *
     * @return string|array|bool
     */
    function hut_var(string $name = '' , ?string $value = null , string $description = '' , ?string $default = null): mixed
    {
        if ( $value === null ) {
            return \hutcms\core\System::instance()->getVar($name , $default);
        } else {
            return \hutcms\core\System::instance()->setVar($name , $value , $description);
        }
    }
}
if ( !function_exists('hut_data') ) {
    /**
     * 系统数据
     *
     * @param string     $name        数据名
     * @param mixed|null $data        数据内容
     * @param string     $description 数据说明
     * @param mixed      $default     默认数据
     *
     * @return string|array|bool
     */
    function hut_data(string $name , string|array $data = null , string $description = '' , mixed $default = ''): string|array|bool
    {
        if ( $data == null ) {
            return \hutcms\core\System::instance()->getData($name , $default);
        } else {
            return \hutcms\core\System::instance()->setData($name , $data , $description);
        }
    }
}
if ( !function_exists('hut_conf') ) {
    /**
     * 系统配置
     *
     * @param string|array|null $name
     * @param mixed|null        $value
     * @param string            $default
     *
     * @return string|array|bool
     */
    function hut_conf(string|array $name = null , mixed $value = null , string $default = ''): bool|array|string
    {
        if ( $value === null && is_string($name) ) {
            return \hutcms\core\System::instance()->getConfig($name , $default);
        } else {
            return \hutcms\core\System::instance()->setConfig($name , $value);
        }
    }
}
if ( !function_exists('hutcms_path') ) {
    /**
     * 获得hutcms目录
     *
     * @param string $path
     *
     * @return string
     */
    function hutcms_path(string $path = ''): string
    {
        return HUTCMS_PATH . ($path ? ltrim($path , DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR : $path);
    }
}