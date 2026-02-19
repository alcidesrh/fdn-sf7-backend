<?php

declare(strict_types=1);
// include 'borrar/borrar.php';

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';
// sleep(3);
// Support CloudFlare Flexible SSL
// https://developers.cloudflare.com/fundamentals/reference/http-request-headers/#cf-visitor
if ($_SERVER['HTTP_CF_VISITOR'] ?? false) {
    $_SERVER['HTTP_X_FORWARDED_PROTO'] = json_decode($_SERVER['HTTP_CF_VISITOR'], true)['scheme'];
}
// die();
return static function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
