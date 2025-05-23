<?php

return [

    'url_scan_expiration_minutes' => 60,
    
    'storageDir' => 'app/pdfs',

    'web' => [

        'recordsPerPage' => 10
    ],

    'api' => [

        'recordsPerPage' => 10
    ],

    'notificationEmail' => [

        'from'    => 'support@app.com',
        'subject' => 'URL Scan Completed'
    ]
];
