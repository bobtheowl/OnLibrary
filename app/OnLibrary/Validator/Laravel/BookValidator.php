<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

class BookValidator extends BaseLaravelValidator implements ValidatorInterface
{
    /** Validation rules */
    protected $rules = [
        'insert' => [
            'title' => 'required',
            'subtitle' => '',
            'isbn' => 'numeric',
            'publisher_id' => 'numeric',
            'series_id' => 'numeric',
        ],
        
        'update' => [
            'title' => 'required',
            'subtitle' => '',
            'isbn' => 'numeric',
            'publisher_id' => 'numeric',
            'series_id' => 'numeric',
        ]
    ];
}//end class BookValidator

//end file BookValidator.php
