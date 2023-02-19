<?php

namespace Core\HttpFoundation;

final class Headers
{

    /**
     * [Description for get]
     *
     * @param string $key
     * @param mixed|null $defaultValue
     * 
     * @return mixed
     * 
     */
    public function get(string $key, mixed $defaultValue = null): mixed
    {
        if (array_key_exists($key, $this->all())) {
            return $_COOKIE[$key];
        }

        return $defaultValue;
    }

    /**
     * [Description for set]
     *
     * @param string $key
     * @param mixed $value
     * 
     * @return void
     * 
     */
    public function set(string $key, mixed $value): void
    {
        header("{$key}: {$value}");
    }

    /**
     * [Description for has]
     *
     * @param string $key
     * 
     * @return bool
     * 
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->all());
    }

    /**
     * [Description for all]
     *
     * @return array|null
     * 
     */
    public function all(): ?array
    {
        return getallheaders();
    }

    /**
     * [Description for remove]
     *
     * @param string $key
     * 
     * @return void
     * 
     */
    public function remove(string $key): void
    {
        unset($this->all()[$key]);
    }
}
