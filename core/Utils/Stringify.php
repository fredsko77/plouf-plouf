<?php

namespace Core\Utils;

trait Stringify
{

    public function skipAccents(?string $str = '', ?string $charset = 'utf-8'): string
    {
        $str    = trim($str);
        $str    = htmlentities($str, ENT_NOQUOTES, $charset);

        $str    = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str    = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        $str    = preg_replace('#&[^;]+;#', '', $str);
        $str    = preg_replace('/[^A-Za-z0-9\-]/', ' ', $str);

        return $str;
    }

    public function randomString(?int $length = 10): string
    {
        $char_to_shuffle =  'azertyuiopqsdfghjklwxcvbnAZERTYUIOPQSDFGHJKLLMWXCVBN1234567890';
        return substr(str_shuffle($char_to_shuffle), 0, $length) . (new \DateTimeImmutable)->format('YmwdHsiu');
    }
}
