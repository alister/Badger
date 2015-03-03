<?php

return [

    // Debug config
    'debug' => true,

    // Twig config
    'twig.path' => __DIR__ . '/../views',
    'twig.options' => [
        'cache' => __DIR__ . '/../var/cache/twig'
    ],

    // Badge config
    'badge.xsl.path' => __DIR__ . '/../var/xsl',
    'badge.font.filename' => __DIR__ . '/../var/font/FreeSans.ttf'

];
