<?php 

return [
    
    'Applebiter' => [
        
        'Defaults' => [
            'timezone' => 'America/New_York',
        ],

        'Mailer' => [
            'website_name' => 'Applebiter.com',
            'host_name' => 'applebiter.indigo',
            'name_from' => 'Applebiter.com',
            'email_from' => 'server@applebiter.com',
        ],

        'Storage' => [
            'imagedata' => ROOT . DS . 'storage' . DS . 'imagedata',
            'sounddata' => ROOT . DS . 'storage' . DS . 'sounddata',
            'userdata' => ROOT . DS . 'storage' . DS . 'userdata',
        ],
        
        'Theme' => [   
            'theme' => 'default',         
            'themefile' => ROOT . DS . 'storage' . DS . 'theme',
        ],
    ]
];
