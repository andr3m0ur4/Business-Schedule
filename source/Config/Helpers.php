<?php

/**
 * ########################
 * ###      VALIDATE    ###
 * ########################
 */

 function is_email(string $email) : bool
 {
     return filter_var($email, FILTER_VALIDATE_EMAIL);
 }

 function is_password(string $password) : bool
 {
     if (password_get_info($password)['algo']) {
         return true;
     }

     return mb_strlen($password) >= CONF_PASSWORD_MIN_LEN && mb_strlen($password) <= CONF_PASSWORD_MAX_LEN;
 }

 /**
 * ######################
 * ###      STRING    ###
 * ######################
 */

function str_slug(string $string) : string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "-", str_replace(
        " ",
        "-",
        trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
    ));

    return $slug;
}

function str_studly_case(string $string) : string
{
    $string = str_slug($string);
    $studlyCase = str_replace(' ', '', mb_convert_case(str_replace(
        '-', ' ', $string
    ), MB_CASE_TITLE));

    return $studlyCase;
}

function str_camel_case(string $string) : string
{
    return lcfirst(str_studly_case($string));
}

function str_title(string $string) : string
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

function str_limit_words(string $string, int $limit, string $pointer = '...') : string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(' ', $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(' ', array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}

function str_limit_chars(string $string, int $limit, string $pointer = '...') : string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), ' '));
    return "{$chars}{$pointer}";
}

/**
 * ###################
 * ###      URL    ###
 * ###################
 */

function url(string $path = null) : string
{
    if (!strpos($_SERVER['SERVER_NAME'], 'localhost')) {
        if ($path) {
            return CONF_URL_DEV . '/' . ($path[0] == '/' ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_DEV;
    }

    if ($path) {
        return CONF_URL_BASE . '/' . ($path[0] == '/' ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

function redirect(string $url) : void
{
    header('HTTP/1.1 302 Redirect');
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, 'route', FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

 /**
 * ####################
 * ###      DATE    ###
 * ####################
 */

function date_formatt(string $date = 'now', string $format = 'd/m/Y H\hi') : string
{
    return (new DateTime($date))->format($format);
}

function date_format_br(string $date = 'now') : string
{
    return (new DateTime($date))->format(CONF_DATE_BR);
}

function date_format_app(?string $date = 'now') : string
{
    return (new DateTime($date))->format(CONF_DATE_APP);
}

function date_format_br_to_app(string $date, string $format = 'd/m/Y') : string
{
    return (DateTime::createFromFormat($format, $date))->format(CONF_DATE_APP);
}

function date_format_app_to_br(string $date, string $format = 'Y-m-d') : string
{
    return (DateTime::createFromFormat($format, $date))->format(CONF_DATE_BR);
}

/**
 * ########################
 * ###      PASSWORD    ###
 * ########################
 */

function password(string $password) : string
{
    return password_hash($password, CONF_PASSWORD_ALGO, CONF_PASSWORD_OPTION);
}

function passwd_rehash(string $hash) : bool
{
    return password_needs_rehash($hash, CONF_PASSWORD_ALGO, CONF_PASSWORD_OPTION);
}
