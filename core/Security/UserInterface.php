<?php

namespace Core\Security;

interface UserInterface
{

    /**
     * [Description for getRoles]
     *
     * @return array
     * 
     */
    public function getRoles(): array;

    /**
     * [Description for getUserIdentifier]
     *
     * @return string|null
     * 
     */
    public function getUserIdentifier(): ?string;

    /**
     * [Description for getPassword]
     *
     * @return string|null
     * 
     */
    public function getPassword(): ?string;
}
