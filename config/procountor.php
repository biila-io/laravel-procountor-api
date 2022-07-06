<?php

return [

    'domain' => $domain = env('PROCOUNTOR_DOMAIN', 'https://api.procountor.com'),

    'base_url' => env('PROCOUNTOR_BASE_URL', "$domain/api"),

    'storage_key' => 'procountor:accessToken',

    'accounting_code' => env('PROCOUNTOR_ACCOUNTING_CODE'),

];
