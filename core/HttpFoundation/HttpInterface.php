<?php

namespace Core\HttpFoundation;

/**
 * @interface HttpInterface
 * @author Frédérick AGATHE <fagathe77@gmail.com>
 */
interface HttpInterface
{

    /**
     * [Description for get]
     *
     * @param string $key
     * @param mixed|null $defaultValue
     * @return mixed
     */
    public function get(string $key, mixed $defaultValue = null): mixed;

    /**
     * [Description for set]
     *
     * @param string $key
     * @return self
     */
    public function set(string $key, mixed $value): self;

    /**
     * [Description for has]
     * 
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * [Description for all]
     *
     * @return array|null
     */
    public function all(): ?array;

    /**
     * [Description for remove]
     *
     * @param string $key
     * @return void
     */
    public function remove(string $key): void;
}
