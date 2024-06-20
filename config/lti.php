<?php

return [
    'private_key' => env('LTI_PRIVATE_KEY'),
    'public_key' => env('LTI_PUBLIC_KEY'),
    'client_id' => env('LTI_CLIENT_ID'),
    'issuer' => env('LTI_ISSUER'),
    'auth_login_url' => env('LTI_AUTH_LOGIN_URL'),
    'auth_token_url' => env('LTI_AUTH_TOKEN_URL'),
    'auth_server' => env('LTI_AUTH_SERVER'),
    'deployment_id' => env('LTI_DEPLOYMENT_ID'),
    'redirect_uri' => env('LTI_REDIRECT_URI'),
];