<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

class AuthorValidator extends BaseLaravelValidator implements ValidatorInterface
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
}//end class AuthorValidator

//end file AuthorValidator.php
