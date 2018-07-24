<?php

/** @var \Composer\Autoload\ClassLoader $autoload */
$loader = require(__DIR__ . '/../vendor/autoload.php');
$loader->add('University', __DIR__ . '/../src');

$loader = new Twig_Loader_Array([
    'index' => file_get_contents(__DIR__ . '/../templates/index.html.twig'),
]);
$twig   = new Twig_Environment($loader);

echo $twig->render('index', [
    'statistic_spbtsu'   => unserialize(file_get_contents(__DIR__ . '/../tmp/spbtsu')),
    'statistic_unecon_m' => unserialize(file_get_contents(__DIR__ . '/../tmp/unecon_m')),
    'statistic_unecon_p' => unserialize(file_get_contents(__DIR__ . '/../tmp/unecon_p'))
]);
