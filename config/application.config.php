<?php

return [

    // Turn on debug mode
    'debug' => true,

    // Path to the directory containing twig template files (it can also be an array of paths).
    'twig.path' => __DIR__ . '/../views',

    // An associative array of twig options.
    'twig.options' => [

        // When set to true, the generated templates have a __toString() method that you can use to display the
        // generated nodes (default to false).
        //'debug' => true,

        // The charset used by the templates (default to utf-8).
        //'charset' => 'utf-8',

        // The base template class to use for generated templates (default to Twig_Template).
        //'base_template_class' => 'Twig_Template',

        // An absolute path where to store the compiled templates, or false to disable caching (which is the default).
        //'cache' => __DIR__ . '/../var/cache/twig',

        // When developing with Twig, it's useful to recompile the template whenever the source code changes.
        // If you don't provide a value for the auto_reload option, it will be determined automatically based on the
        // debug value.
        //'auto_reload' => true,

        // If set to false, Twig will silently ignore invalid variables (variables and or attributes/methods that do
        // not exist) and replace them with a null value. When set to true, Twig throws an exception instead
        // (default to false).
        //'strict_variables' => true,

        // If set to true, HTML auto-escaping will be enabled by default for all templates (default to true).
        //'autoescape' => false,

        // A flag that indicates which optimizations to apply (default to -1 -- all optimizations are enabled;
        // set it to 0 to disable).
        //'optimizations' => 0,

    ],

    // Badge XSL path
    'badge.xsl.path' => __DIR__ . '/../var/xsl',

    // Name of the font file for text metrics calculation
    'badge.font.filename' => __DIR__ . '/../var/font/FreeSans.ttf',

];
