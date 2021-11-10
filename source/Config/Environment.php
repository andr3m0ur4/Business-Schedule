<?php

/**
 * DATABASE
 */
define('CONF_DB_HOST', 'localhost');
//efine('CONF_DB_USER', 'andre-moura');
 define('CONF_DB_USER', 'root');
//define('CONF_DB_PASS', 'andre-moura');
   define('CONF_DB_PASS', '');
//efine('CONF_DB_PASS', 'root');
define('CONF_DB_NAME', 'business_schedule');

/**
 * URL
 */
define('ENVIRONMENT', 'development');
//define('ENVIRONMENT', 'production');
define('CONF_URL_BASE', 'https://www.website.com');
define('CONF_URL_DEV', 'http://localhost:8000');
define('CONF_URL_ADMIN', '/admin');
define('CONF_URL_ERROR', CONF_URL_BASE . '/404');

/**
 * DATE TIME
 */
define('CONF_DATE_BR', 'd/m/Y H:i:s');
define('CONF_DATE_APP', 'Y-m-d H:i:s');

/**
 * PASSWORD
 */
define('CONF_PASSWORD_MIN_LEN', 8);
define('CONF_PASSWORD_MAX_LEN', 40);
define('CONF_PASSWORD_ALGO', PASSWORD_DEFAULT);
define('CONF_PASSWORD_OPTION', ['cost' => 10]);

/**
 * MESSAGES
 */
define('CONF_MESSAGE_CLASS', 'alert');
define('CONF_MESSAGE_INFO', 'info');
define('CONF_MESSAGE_SUCCESS', 'success');
define('CONF_MESSAGE_WARNING', 'warning');
define('CONF_MESSAGE_ERROR', 'error');

/**
 * PATH
 */
define('CONF_VIEW_PATH', __DIR__ . '/../Views');
define('CONF_VIEW_EXT', 'phtml');
define('CONF_VIEW_THEME', 'business-schedule');

/**
 * UPLOAD
 */
define('CONF_UPLOAD_DIR', './storage');
define('CONF_UPLOAD_IMAGE_DIR', 'images');
define('CONF_UPLOAD_FILE_DIR', 'files');
define('CONF_UPLOAD_MEDIA_DIR', 'medias');

/**
 * IMAGES
 */
define('CONF_IMAGE_CACHE', CONF_UPLOAD_DIR . '/' . CONF_UPLOAD_IMAGE_DIR . '/cache');
define('CONF_IMAGE_SIZE', 2000);
define('CONF_IMAGE_QUALITY', ['jpg' => 75, 'png' => 5]);

/**
 * EMAIL
 */
define('CONF_MAIL_HOST', 'smtp-relay.sendinblue.com');
define('CONF_MAIL_PORT', 587);
define('CONF_MAIL_USER', 'andre.benedicto@etec.sp.gov.br');
define('CONF_MAIL_PASS', 'BOLnJ2F65AfKmUrN');
define('CONF_MAIL_SENDER', [
    'name' => 'André Moura',
    'address' => 'andre.benedicto@etec.sp.gov.br'
]);
define('CONF_MAIL_OPTION_LANG', 'br');
define('CONF_MAIL_OPTION__HTML', true);
define('CONF_MAIL_OPTION_AUTH', true);
define('CONF_MAIL_OPTION_SECURE', 'tls');
define('CONF_MAIL_OPTION_CHARSET', 'utf-8');
    