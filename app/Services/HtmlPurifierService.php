<?php

// namespace App\Services;

// use HTMLPurifier\HTMLPurifier;
// use HTMLPurifier_Config;

// class HtmlPurifierService
// {
//     protected $purifier;

//     public function __construct()
//     {
//         $configArray = config('htmlpurifier.config', []);

//         $config = HTMLPurifier_Config::createDefault();

//         foreach ($configArray as $key => $value) {
//             $config->set($key, $value);
//         }

//         $this->purifier = new HTMLPurifier($config); 
//     }

//     public function purify($html)
//     {
//         return $this->purifier->purify($html);
//     }
// }
