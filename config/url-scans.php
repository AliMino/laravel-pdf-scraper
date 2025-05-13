<?php

return [

    'url_scan_expiration_minutes' => 60,
    
    'storageDir' => 'app/pdfs',

    'api' => [

        'recordsPerPage' => 10
    ],

    'notificationEmail' => [

        'from'    => 'support@app.com',
        'subject' => 'URL Scan Completed'
    ]
];
