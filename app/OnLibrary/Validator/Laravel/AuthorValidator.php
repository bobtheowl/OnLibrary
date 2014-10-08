<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

class AuthorValidator extends BaseLaravelValidator implements ValidatorInterface
{
    /** Validation rules */
    private static $rules = [
        'insert' => [
        
        ],
        
        'update' => [
        
        ]
    ];

    /**
     * Sets input to be checked using the validator.
     *
     * @param array $input Array of input to be checked
     * @retval null
     */
    public function usingInput(array $input)
    {
        //
    }//end usingInput()

    /**
     * Sets rule to be used to validate input.
     *
     * @param string $rule Rule to use to validate input
     * @param array $params Optional array of parameters to use with the rules
     * @retval null
     */
    public function usingRule($rule, array $params = [])
    {
        //
    }//end usingRule()
}//end class AuthorValidator

//end file AuthorValidator.php
