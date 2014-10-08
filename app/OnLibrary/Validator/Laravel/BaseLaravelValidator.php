<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;

abstract class BaseLaravelValidator implements ValidatorInterface
{
    /**
     * Sets input to be checked using the validator.
     *
     * @param array $input Array of input to be checked
     * @retval null
     */
    abstract public function usingInput(array $input);

    /**
     * Sets rule to be used to validate input.
     *
     * @param string $rule Rule to use to validate input
     * @param array $params Optional array of parameters to use with the rules
     * @retval null
     */
    abstract public function usingRule($rule, array $params = []);

    /**
     * Validates the set input against the specified rule.
     *
     * @retval boolean True if input is valid, false otherwise
     */
    public function isValid()
    {
        //
    }//end isValid()
}//end abstract class BaseLaravelValidator

//end file BaseLaravelValidator.php
