<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    $email = 'test@example.com'; // Mettez ici un email pour tester.
    $details = [
        'title' => 'Mail Test',
        'body' => 'Ceci est un email de test'
    ];

    Mail::send([], [], function ($message) use ($email) {
        $message->to($email)
            ->subject('Test Email')
            ->setBody('<h1>Mail Test</h1><p>Ceci est un email de test.</p>', 'text/html');
    });

    return 'Email envoyé!';
});
