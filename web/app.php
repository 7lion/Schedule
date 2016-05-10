<?php

use Symfony\Component\HttpFoundation\Request;

mb_internal_encoding('UTF-8');
setlocale(LC_ALL, 'en_US.UTF8');
date_default_timezone_set('UTC');
ini_set('memcached.sess_locking', 'off');
umask(0002);

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
Request::setTrustedProxies(array('127.0.0.1', $request->server->get('REMOTE_ADDR')));
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
