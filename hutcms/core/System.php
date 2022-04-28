<?php

declare (strict_types = 1);

namespace hutcms\core;

class System extends \hutcms\Core
{
    protected array $config = [];

    public function setConfig(string $name , string|array $value = ''): bool|int|string|\think\Model
    {
        $this->config = [];
        if ( is_array($value) ) {
            $type  = str_contains($name , '.') ? explode('.' , $name)[0] : $name;
            $count = 0;
            foreach ( $value as $kk => $vv ) {
                [$t , $n] = $this->_parse($kk , $type);
                $count += $this->setConfig("{$t}.{$n}" , $vv);
            }
            return $count;
        } else {
            [$type , $field] = $this->_parse($name , 'base');
            $this->app->cache->delete('system_config');
            $map   = ['type' => $type , 'name' => $field];
            $data  = array_merge($map , ['value' => $value]);
            $query = M('system_config')->master(true)->where($map);
            try {
                return (clone $query)->count() > 0 ? $query->update($data) : $query->insert($data);
            } catch (\Exception $e) {
                return 0;
            }
        }
    }


    public function getConfig(?string $name = null , ?string $default = ''): string|array
    {
        if ( empty($this->config) ) {
            try {
                db('system_config')->cache('system_config')->select()->map(function ($item) {
                    $this->config[$item['type']][$item['name']] = $item['value'];
                });
            } catch (\Exception $e) {
                return [];
            }
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

?>