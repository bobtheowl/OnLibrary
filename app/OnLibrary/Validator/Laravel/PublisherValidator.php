<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

class PublisherValidator extends BaseLaravelValidator implements ValidatorInterface
{
    /** Validation rules */
    private static $rules = [
        'insert' => [
            'name' => 'required'
        ],
        
        'update' => [
            'name' => 'required'
        ]
    ];
}//end class PublisherValidator

//end file PublisherValidator.php
