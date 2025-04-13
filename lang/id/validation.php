<?php

return [
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'The :attribute has already been taken.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],

    'password' => [
        'min' => 'Password must be at least :min characters.',
        'letters' => 'Password must contain at least one letter.',
        'mixed' => 'Password must contain both uppercase and lowercase letters.',
        'numbers' => 'Password must contain at least one number.',
        'symbols' => 'Password must contain at least one symbol.',
    ],
];