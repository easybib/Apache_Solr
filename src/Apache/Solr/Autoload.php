<?php

namespace Apache\Solr;

class Autoload
{
    public static function register()
    {
        $loader = new self;
        spl_autoload_register(array($loader, 'load'));
    }

    public function load($class)
    {
        if (strpos($class, 'Apache_Solr') === false) {
            return false;
        }
        $base = dirname(dirname(dirname(__DIR__)));
        if (strpos($class, 'Test') !== false) {
            $base .= '/tests';
        } else {
            $base .= '/src';
        }
        $file = str_replace('_', '/', $class);
        return include $base . '/' . $file . '.php';
    }
}
