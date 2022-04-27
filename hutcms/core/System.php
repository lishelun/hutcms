<?php

declare (strict_types = 1);

namespace hutcms\core;

class System extends \hutcms\Core
{
    protected array $config = [];

    public function setConfig(string $name , string|array $value = ''): int|string|\think\Model
    {
        $this->config = [];
        [$type , $field] = $this->_parse($name);
        if ( is_array($value) ) {
            $count = 0;
            foreach ( $value as $kk => $vv ) {
                $count += $this->set("{$field}.{$kk}" , $vv);
            }
            return $count;
        } else {
            $this->app->cache->delete('system_config');
            $map   = ['type' => $type , 'name' => $field];
            $data  = array_merge($map , ['value' => $value]);
            $query = M('system_config')->master(true)->where($map);
            return (clone $query)->count() > 0 ? $query->update($data) : $query->insert($data);
        }
    }

    /**
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\DataNotFoundException
     */
    public function getConfig(?string $name = null , ?string $default = ''): string|array
    {
        if ( empty($this->config) ) {
            M('system_config')->cache('system_config')->select()->map(function ($item) {
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
     * @param string $item
     *
     * @return array [type,field,outer]
     */
    private function _parse(string $item): array
    {
        $type = 'base';
        if ( stripos($item , '.') !== false ) {
            [$type , $item] = explode('.' , $item , 2);
        }
        [$field , $outer] = explode('|' , "{$item}|");
        return [$type , $field , strtolower($outer)];
    }
}

?>