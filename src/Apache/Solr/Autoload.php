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
        if (strpos($class, 'Test') !== false) {
            return false;
        }
        $file = str_replace('Apache_Solr_', '', $class);
        $file = str_replace('_', '/', $file);
        return include __DIR__ . '/' . $file . '.php';
    }
}
