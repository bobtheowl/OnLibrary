<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;
use OnLibrary\Exception\InternalException;
use \Validator;

abstract class BaseLaravelValidator implements ValidatorInterface
{
    /** An invalid rule was requested */
    const INVALID_RULE_ERROR = 'Requested a set of validation rules that do not exist.';

    /** Input to validate */
    private $input = [];

    /** Available rules to use */
    protected $rules = [];

    /** Validation rules currently selected */
    protected $currentRules = [];

    /** Laravel validator instance */
    private $validator;

    /**
     * Sets input to be checked using the validator.
     *
     * @param array $input Array of input to be checked
     * @retval OnLibrary::Validator::Laravel::BaseLaravelValidator
     */
    public function usingInput(array $input)
    {
        $this->input = $input;
        return $this;
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
        if (array_key_exists($rule, $this->rules) === false) {
            throw new InternalException(self::INVALID_RULE_ERROR);
        }//end if

        $this->currentRules = $this->rules[$rule];
        
        return $this;
    }//end usingRule()

    /**
     * Validates the set input against the specified rule.
     *
     * @retval boolean True if input is valid, false otherwise
     */
    public function isValid()
    {
        $this->validator = Validator::make(
            $this->input,
            $this->currentRules
        );
        
        return !($this->validator->fails());
    }//end isValid()

    /**
     * Returns an array of validation errors.
     *
     * @retval array Validation errors
     */
    public function getErrors()
    {
        return $this->validator->messages()->toArray();
    }//end getErrors()

    /**
     * Generates a rule to check for a unique value while ignoring the
     * row being modified.\
     *
     * @param string $table Table to check unique value in
     * @param string $field Field to check unique value in
     * @param integer $ignoreId (optional) ID of row to ignore
     * @param array $where Array of additional WHERE clauses to add
     * @retval string Unique rule
     */
    protected function generateUniqueRule($table, $field, $ignoreId = null, array $where = [])
    {
        $rule = 'unique:' . $table . ',' . $field . ',' . (($ignoreId === null) ? 'NULL' : $ignoreId) . ',id';
        foreach ($where as $field => $value) {
            $rule .= ',' . $field . ',' . $value;
        }//end foreach
        return $rule;
    }//end generateUniqueRule()
}//end abstract class BaseLaravelValidator

//end file BaseLaravelValidator.php
