<?php
require_once dirname(__DIR__) . '/src/Apache/Solr/Autoload.php';
\Apache\Solr\Autoload::register();

require_once dirname(__DIR__) . '/vendor/.composer/autoload.php';

$solr = new Apache_Solr_Service('127.0.0.1', 8983);
var_dump($solr->ping());
