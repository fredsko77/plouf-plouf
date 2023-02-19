<?php

namespace Core\HttpFoundation;

use Core\HttpFoundation\HttpInterface;

final class Query implements HttpInterface
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
        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }

        return $defaultValue;
    }

    /**
     * [Description for set]
     *
     * @param string $key
     * @param mixed $value
     * 
     * @return self
     * 
     */
    public function set(string $key, mixed $value): self
    {
        $_GET[$key] = $value;
        return $this;
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
        return array_key_exists($key, $_GET);
    }

    /**
     * [Description for all]
     *
     * @return array|null
     * 
     */
    public function all(): ?array
    {
        return $_GET;
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
        unset($_GET[$key]);
        return;
    }
}
