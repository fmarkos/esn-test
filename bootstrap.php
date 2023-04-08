<?php

/**
 * @file
 * Bootstrap loader for Twig environment and composer classes.
 */
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

// Load our autoloader if the file exists.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once __DIR__ . '/vendor/autoload.php';
}
else {
  echo 'It seems the vendor folder is missing. You need to run some command first.';
  die();
}

// Disable OPcache or other internal caches that might be enabled.
// opcache_reset(); // I don't use apache of xampp, just windows and C:\tools\php72\php.exe -S localhost:8000

// Specify our Twig templates location.
$twigLoader = new FilesystemLoader('templates/');
// Instantiate our Twig.
$_twig = new Environment($twigLoader, ['debug' => true, 'cache' => false, 'auto_reload' => true]);
// Add extra extensions, global twig variables, etc.
$_twig->addExtension(new DebugExtension());
$req_scheme = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://'; // $_SERVER["REQUEST_SCHEME"] is not reliable.
if($_SERVER['SERVER_PORT'] != 80) {
  $url = $req_scheme . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] ;
} else {
  $url = $req_scheme . $_SERVER['SERVER_NAME'] ;
}
$_twig->addGlobal('site_url', $url );
// $_twig->addGlobal('site_url', $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]));
