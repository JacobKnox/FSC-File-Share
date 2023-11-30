<?php

return [
    'bugcreate' => env('allforms', true) && true,
    'commentcreate' => env('allforms', true) && true,
    'commentdelete' => env('allforms', true) && true,
    'filecreate' => env('allforms', true) && true,
    'filefilter' => env('allforms', true) && true,
    'fileupdate' => env('allforms', true) && true,
    'usercreate' => env('allforms', true) && true,
    'userdelete' => env('allforms', true) && true,
    'userlogin' => env('allforms', true) && true,
    'userupdate' => env('allforms', true) && true,
    'bugs' => [
        'categories' => ['text-error', 'visual', 'security', 'other',],
    ],
    'users' => [
        'status' => ['student', 'faculty',],
    ],
];
