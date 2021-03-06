<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Validator\ValidatorInterface;
use OnLibrary\Exception\InternalException;

class UserValidator extends BaseLaravelValidator implements ValidatorInterface
{
    /** Available validation rules */
    protected $rules = [
        'insert' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|min:5|alpha_dash',
            'email_address' => 'required|email',
            'password' => 'required'
        ],
        'update' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|min:5|alpha_dash',
            'email_address' => 'required|email',
            'password' => 'required'
        ]
    ];

    /**
     * Sets rule to be used to validate input.
     *
     * @param string $rule Rule to use to validate input
     * @param array $params Optional array of parameters to use with the rules
     * @retval OnLibrary::Validator::Laravel::UserValidator
     */
    public function usingRule($rule, array $params = [])
    {
        if (array_key_exists($rule, $this->rules) === false) {
            throw new InternalException(self::INVALID_RULE_ERROR);
        }//end if

        $this->currentRules = $this->rules[$rule];

        if (array_key_exists('id', $params)) {
            $this->currentRules['username'] .= '|' . $this->generateUniqueRule('users', 'username', $params['id']);
        } else {
            $this->currentRules['username'] .= '|' . $this->generateUniqueRule('users', 'username');
        }//end else
 
        return $this;
    }//end usingRule()
}//end class UserValidator

//end file UserValidator.php
