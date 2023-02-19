<?php

namespace Core\Security;

use Core\HttpFoundation\Session;

class CstrToken
{

    /**
     * Check if csrf_token is valid
     * @param string $token
     * @return boolean
     */
    public static function checkCsrfToken(string $token): bool
    {
        $session_csrf = (new Session)->get('csrf_token');
        return $session_csrf && $session_csrf === $token ? true : false;
    }
}
