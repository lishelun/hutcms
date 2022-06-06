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

declare (strict_types = 1);

namespace hutcms\core;

use hutcms\Core;
use think\Model;

class System extends Core
{
    protected array $config = [];
    protected array $var    = [];
    protected array $data   = [];

    /**
     * @param string       $name
     * @param string|array $value
     *
     * @return bool|int
     */
    public function setConfig(string $name , string|array $value = ''): bool|int
    {
        $this->config = [];
        $this->app->cache->delete('system_config');
        if ( is_array($value) ) {
            $type  = str_contains($name , '.') ? explode('.' , $name)[0] : $name;
            foreach ( $value as $kk => $vv ) {
                [$t , $n] = $this->_parse($kk , $type);
                $this->setConfig("{$t}.{$n}" , $vv);
            }
            return true;
        } else {
            [$type , $field] = $this->_parse($name , 'base');
            $map  = ['type' => $type , 'name' => $field];
            $data = array_merge($map , ['value' => $value]);
            return data_save('system_config' , $data , 'id' , $map);
        }
    }

    /**
     * @param string|null $name
     * @param string|null $default
     *
     * @return string|array
     */
    public function getConfig(?string $name = null , ?string $default = ''): string|array
    {
        if ( empty($this->config) ) {
            db('system_config')->cache('system_config')->select()->map(function ($item) {
                $this->config[$item['type']][$item['name']] = $item['value'];
            });
        }
        [$type , $field , $outer] = $this->_parse($name);
        if ( empty($name) ) {
            return $this->config;
        } else if ( isset($this->config[$type]) ) {
            $group = $this->config[$type];
            if ( $field ) {
                $result = $group[$field] ?? $default;
                if ( $outer !== 'raw' ) {
                    $result = htmlspecialchars(strval($result));
                }
                return $result;
            }
            if ( $outer !== 'raw' ) foreach ( $group as $kk => $vo ) {
                $group[$kk] = htmlspecialchars(strval($vo));
            }
            return $group;
        } else {
            return $default;
        }
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $description
     *
     * @return bool|int
     */
    public function setVar(string $name , string $value = '' , string $description = ''): bool|int
    {
        $this->var = [];
        $this->app->cache->delete('system_var');
        $data = ['name' => $name , 'value' => $value , 'description' => $description];

        return data_save('system_var' , $data , 'id' , ['name' => $name]);

    }

    /**
     * @param string $name
     * @param string $default
     *
     * @return string
     */
    public function getVar(string $name , string $default = ''): string
    {
        if ( empty($this->var) ) {
            db('system_var')->cache('system_var')->select()->map(function ($item) {
                $this->var[$item['name']] = $item['value'];
            });
        }
        return $this->var[$name] ?? $default;
    }

    /**
     * @param string       $name
     * @param string|array $data
     * @param string       $description
     *
     * @return bool
     */
    public function setData(string $name , string|array $data = '' , string $description = ''): bool
    {
        $this->data = [];
        $this->app->cache->delete('system_data');
        $save = ['code' => $name , 'content' => serialize($data) , 'description' => $description];
        return data_save('system_data' , $save , 'id' , ['code' => $name]);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return string|array
     */
    public function getData(string $name , mixed $default = ''): string|array
    {
        if ( empty($this->data) ) {
            db('system_data')->cache('system_data')->select()->map(function ($item) {
                $this->data[$item['code']] = $item['content'];
            });
        }
        return isset($this->data[$name]) ? unserialize($this->data[$name]) : $default;
    }

    /**
     * @param string      $item
     * @param string|null $default
     *
     * @return array [type,field,outer]
     */
    private function _parse(string $item , ?string $default = ''): array
    {
        $type = $default ?: 'base';
        if ( stripos($item , '.') !== false ) {
            [$type , $item] = explode('.' , $item , 2);
        }
        [$field , $outer] = explode('|' , "{$item}|");
        return [$type , $field , strtolower($outer)];
    }
}