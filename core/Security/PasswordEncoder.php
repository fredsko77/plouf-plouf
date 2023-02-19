<?php

namespace Core\Security;

class PasswordEncoder
{

    private $options = [];

    public function __construct()
    {
        $this->options = ['cost' => 12];
    }

    /**
     * [Description for encode]
     *
     * @param string|null $password
     * 
     * @return string
     * 
     */
    public function encode(?string $password = ''): string
    {
        return password_hash($password, PASSWORD_ARGON2ID, $this->options);
    }

    /**
     * [Description for isValid]
     *
     * @param string $plainPassword
     * @param string $hashedPassword
     * 
     * @return bool
     * 
     */
    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    /**
     * [Description for getInfo]
     *
     * @param string $hashedPassword
     * 
     * @return array
     * 
     */
    public function getInfo(string $hashedPassword): array
    {
        return password_get_info($hashedPassword);
    }

    public function needRehash(string $hashedPassword): bool
    {
        return password_needs_rehash($hashedPassword, PASSWORD_ARGON2ID, $this->options);
    }
}
