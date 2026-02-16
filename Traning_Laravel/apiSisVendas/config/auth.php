<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),

        // customizando voltando para a forma padrao que é mais segura 
        // 'guard' => 'admin', // Mude de 'web' para 'admin'
        // 'passwords' => 'admins' // criando apelido
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        //  Caso a tabela nao seja nativa do laravell como o users
        // é necessário realizar ess configuração para nao da B.O
        // admin -> model
        'admin' => [
            'driver' => 'sanctum', // tipo de driver, pode ser session ou sanctum, o sanctum é mais recomendado para APIs, pois ele gera tokens de autenticação, e o session é mais recomendado para aplicações web, pois ele utiliza sessões para manter o usuário logado
            'provider' => 'administrador', // tabela do banco de dados
        ],

        // 'vendedor' -> nome/flag que damos aqui nesta meddleware, para identificar qual tipo de autentificação vamos usar
        /*'seller' => [
            'driver' => 'sanctum', // 
            'provider' => 'vendedor', // tabela do banco de dados
        ],*/

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent the model / table. These providers may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],

        // O mesmo vale para este!
        'administrador' => [ // nome do provider, tem que ser o mesmo do guard
            'driver' => 'eloquent', // tipo de driver, pode ser eloquent ou database, o eloquent é mais fácil de usar, pois ele já tem a ligação com o model, e o database é mais manual, onde tem que especificar a tabela e as colunas
            'model' => App\Models\Admin::class, // model que representa a tabela do banco de dados, tem que ser o mesmo do provider
        ],

        'vendedor' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendedor::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [

        /*'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],*/

        'admins' => [ // Criamos o apelido 'admins'
            'provider' => 'administrador', // Aponta para o seu provider que usa o Model Admin
            'table' => 'password_reset_tokens', // Onde o Laravel guarda os tokens de recuperação
            'expire' => 60, // 60 minutos para expirar o **token de recuperação**
            'throttle' => 60, // 60 minutos para tempo de espera entre tentativas de acesso
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the number of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
