<?php

/*
 * This file is part of the yoeunes/toastr package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Toastr options
    |--------------------------------------------------------------------------
    |
    | Here you can specify the options that will be passed to the toastr.js
    | library. For a full list of options, visit the documentation.
    |
    | Example:
    | 'options' => [
    |     'closeButton' => true,
    |     'debug' => false,
    |     'newestOnTop' => false,
    |     'progressBar' => true,
    | ],
    */

    'options' => [
        'extendedTimeOut' => 0,
        'hideDuration' => 500,
        'timeOut' => 2500,
        'positionClass' => 'toast-bottom-right',
    ],
];
