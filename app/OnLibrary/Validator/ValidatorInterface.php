<?php
namespace OnLibrary\Validator;

interface ValidatorInterface
{
    /**
     * Sets input to be checked using the validator.
     *
     * @param array $input Array of input to be checked
     * @retval null
     */
    public function usingInput(array $input);

    /**
     * Sets rule to be used to validate input.
     *
     * @param string $rule Rule to use to validate input
     * @param array $params Optional array of parameters to use with the rules
     * @retval null
     */
    public function usingRule($rule, array $params = []);

    /**
     * Validates the set input against the specified rule.
     *
     * @retval boolean True if input is valid, false otherwise
     */
    public function isValid();
}//end interface ValidatorInterface

//end file ValidatorInterface.php
