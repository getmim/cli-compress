<?php
/**
 * CLI Compress
 * @package cli-compress 
 * @version 0.0.1
 */

return [
    '__name' => 'cli-compress',
    '__version' => '0.1.0',
    '__git' => 'git@github.com:getphun/cli-compress.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'modules/cli-compress' => ['install', 'update', 'remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'cli' => null
            ],
            [
                'lib-compress' => null
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'CliCompress\\Controller' => [
                'type' => 'file',
                'base' => 'modules/cli-compress/controller'
            ],
            'CliCompress\\Library' => [
                'type' => 'file',
                'base' => 'modules/cli-compress/library'
            ]
        ]
    ],
    'routes' => [
        'tool' => [
            'toolCompressFile' => [
                'info' => 'Compress file(s) to brotli, gzip, or webp',
                'path' => [
                    'value' => 'compress (:type) (:files)',
                    'params' => [
                    	'type' => ['all', 'brotli', 'gzip', 'webp', 'jp2'],
                    	'files' => 'rest'
                    ]
                ],
                'handler' => 'CliCompress\\Controller\\Compressor::compress'
            ]
        ]
    ],
    
    'cli' => [
    	'autocomplete' => [
    		'!^compress (all|gzip|webp|brotli|jp2)( .*)?$!' => [
    			'priority' => 7,
    			'handler' => [
                    'class' => 'CliCompress\\Library\\Autocomplete',
                    'method' => 'files'
                ]
    		],

    		'!^compress( [a-z]*)?$!' => [
    			'priority' => 6,
    			'handler' => [
                    'class' => 'CliCompress\\Library\\Autocomplete',
                    'method' => 'command'
                ]
    		]
    	]
    ]
];