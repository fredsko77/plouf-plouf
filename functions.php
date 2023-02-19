<?php

/**
 * Skip accents in string
 * @param string $str
 * @param string $charset
 * @return string
 */
function skip_accents(string $str, string $charset = 'utf-8'): string
{
    $str    = trim($str);
    $str    = htmlentities($str, ENT_NOQUOTES, $charset);

    $str    = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str    = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    $str    = preg_replace('#&[^;]+;#', '', $str);
    $str    = preg_replace('/[^A-Za-z0-9\-]/', ' ', $str);

    return $str;
}

/**
 * custom var_dump() values
 * @param mixed $values
 * @return void
 */
function dump(...$values)
{
    $params = func_get_args();
    echo "<pre style='border-radius: .175rem;
            background-color: #efefef;
            color: #70AC9B;
            box-shadow: .1rem .22rem .3rem 0 rgba(175,190,180,.4);
            padding: 10px 1.95rem;
            color: #2f718d;
            border-radius: 5px;
            max-width: 1200px;
            width: 100%;
            box-sizing: content-box;
            height: auto;
            min-height: 5vh;
            overflow-x: scroll;
            text-align: justify;
            margin : 10px auto;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;'
            >";
    foreach ($params as $key => $param) {
        var_dump($param);
    }
    echo "</pre>";
}

/**
 * dump() values and die
 * @param [type] $values
 * @return void
 */
function dd(...$values)
{
    dump(...$values);
    die();
}

/**
 * Refresh page
 * @return void
 */
function refresh_page()
{
    header('refresh:0');
}

/**
 * Redirect to url
 * @param [type] $url
 * @return void
 */
function redirect($url)
{
    header("location:$url");
}

function get_template(string $path = '')
{
    try {
        if (file_exists($path)) {
            require_once("{$path}.php");
        }
    } catch (\Throwable $th) {
        throw $th->getMessage();
    }
}

function get_stylesheets(): string
{
    return '';
}

function get_file()
{
}

function get_scripts(array $scripts = []): string
{
    return '';
}

function random_string(): string
{
    return '';
}


/**
 * Encrypt the password
 * @param string $pass
 * @return string
 */
function encrypt_password(string $pass): string
{
    return password_hash($pass, PASSWORD_ARGON2I);
}

/**
 * Check if the password match with pattern
 * @param string $pass
 * @return boolean
 */
function pass_valid(string $pass): bool
{
    return preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]){8,}#', $pass) ? true : false;
}

/**
 * check if email is valid
 * @param string $email
 * @return boolean
 */
function email_valid(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
}

/**
 * Get the current url
 * @return void
 */
function get_current_url()
{
    return (new Request)->server('REQUEST_URI');
}

/**
 * Generate a filename
 * @return string
 */
function generate_filename(): string
{
    $char_to_shuffle =  'azertyuiopqsdfghjklwxcvbnAZERTYUIOPQSDFGHJKLLMWXCVBN1234567890';
    return substr(str_shuffle($char_to_shuffle), 0, 30);
}

/**
 * Transform array to string for strip_tags
 * @param array $data
 * @return string
 */
function array_to_string(array $data): string
{
    $str = '';
    foreach ($data as $v) {
        $str .= "&lt;{$v}&gt;";
    }
    return $str;
}

/**
 * init_session
 *
 * @return mixed
 */
function init_session()
{
    if (session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED) {
        return session_start();
    }
    return session_start();
}

/**
 * french date
 *
 * @param string $date
 * @return string
 */
function fr_date(string $date = ''): string
{
    return utf8_encode(strftime("%d %B %Y", strtotime($date ?? (new DateTime())->format('d/m/Y à H:m'))));
}

/**
 * date diff 
 * @param string $date
 * @return string
 */
function diff(string $date): string
{
    $now = new DateTime('now');
    $date = new DateTime($date);
    $diff = $date->diff($now, false);
    $str = 'il y a ';
    if ($diff->y > 0) {
        return $str . "{$diff->y} " . ($diff->y === 1 ? "an" : "ans");
    }

    if ($diff->m > 0) {
        return $str . "{$diff->m} mois";
    }

    if ($diff->d > 0) {
        return " $str {$diff->d} " . ($diff->d === 1 ? "jour" : "jours");
    }

    if ($diff->h > 0) {
        return " $str {$diff->h} " . ($diff->h === 1 ? "heure" : "heures");
    }

    if ($diff->i > 0) {
        return " $str{$diff->i} " . ($diff->i === 1 ? "minute" : "minutes");
    }

    return "à l'instant";
}

/**
 * now
 * @return string
 */
function now(): string
{
    return (new DateTime('now'))->format('Y-m-d H:i:s');
}

/**
 * esc_html
 * @param string $html
 * @return string
 */
function esc_html(string $html): string
{
    return htmlentities($html, ENT_IGNORE);
}

/**
 * _e
 * @param string $html
 * @return void
 */
function _e(string $html)
{
    echo html_entity_decode($html, ENT_IGNORE);
}

/**
 * esc_url
 * @param string $url
 * @return string
 */
function esc_url(string $url): string
{
    return urldecode(urlencode($url));
}
