<?php

return [
    \App\Models\Setting::URL_API => env('APP_URL', 'gameon.sarente.com:8000'),
    \App\Models\Setting::URL_LOGOUT => env('LOGOUT_URL', 'gameon.sarente.com'),
    \App\Models\Setting::URL_STUDENT_INTRO => env('STUDENT_INTRO_URL', 'gameon.sarente.com:3003'),
    \App\Models\Setting::URL_STUDENT => env('STUDENT_URL', 'gameon.sarente.com".3002'),
    \App\Models\Setting::URL_TEACHER => env('TEACHER_URL', 'gameon.sarente.com:3001'),
    \App\Models\Setting::URL_ADMIN => env('ADMIN_URL', 'gameon.sarente.com:3001'),
];
