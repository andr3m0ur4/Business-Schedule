<?php

namespace Source\Core;

use CoffeeCode\Router\Router;

class Route extends Router
{
    public function __construct(string $projectUrl, ?string $separator = ':')
    {
        parent::__construct($projectUrl, $separator);
        $this->patch = self::getUrl();
    }

    private static function getUrl() : string
    {
        $url = parse_url(
            filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_SPECIAL_CHARS),
            PHP_URL_PATH
        );

        if (str_ends_with($url, '/') && strlen($url) > 1) {
            $url = substr($url, 0, strlen($url) - 1);
        }

        return $url;
    }
}
