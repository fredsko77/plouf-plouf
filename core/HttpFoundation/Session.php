<?php

namespace Core\HttpFoundation;

use Core\HttpFoundation\HttpInterface;

final class Session implements HttpInterface
{

    public function __construct()
    {
    }

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
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
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
        $_SESSION[$key] = $value;
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
        return array_key_exists($key, $_SESSION);
    }

    /**
     * [Description for all]
     *
     * @return array|null
     * 
     */
    public function all(): ?array
    {
        return $_SESSION;
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
        unset($_SESSION[$key]);
    }
}
