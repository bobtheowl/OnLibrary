<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

class SeriesValidator extends BaseLaravelValidator implements ValidatorInterface
{
    /** Validation rules */
    protected $rules = [
        'insert' => [
            'name' => 'required'
        ],
        
        'update' => [
            'name' => 'required'
        ]
    ];
}//end class SeriesValidator

//end file SeriesValidator.php
