<?php

return [
    'database' => [
        'dataType' => [
            'string' => 'VARCHAR',
            'json' => 'JSON',
            'integer' => 'INT',
            'unsignedInteger' => 'UNSIGNED INT',
            'tinyInteger' => 'TINYINT',
            'unsignedTinyInteger' => 'UNSIGNED TINYINT',
            'float' => 'FLOAT',
            'text' => 'TEXT',
            'double' => 'DOUBLE',
            'timestamp' => 'TIMESTAMP',
            'boolean' => 'BOOLEAN',
            'date' => 'DATE',
            'dateTime' => 'DATETIME',
        ],
        'numb' => [
            'integer',
            'unsignedInteger',
            'tinyInteger',
            'unsignedTinyInteger',
            'float',
            'double'
        ],
        'text' => [
            'string',
            'json',
            'text',
        ],
        'formElement' => [
            'text',
            'password',
            'email',
            'textarea',
            'textarea with CKEditor',
            'number',
            'checkbox',
            'radio',
            'datetimepicker',
            'datepicker',
            'file upload single',
            'file upload multiple',
            'select',
        ]
    ],
    'image' => [
        'thumb' => [
            'width' => 100,
            'height' => 100
        ]
    ]
];