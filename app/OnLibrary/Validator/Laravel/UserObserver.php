<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\FatalAjaxException;
use OnLibrary\Database\PostSqlMapper;

class UserObserver
{
    /** Data validator */
    private $validator;

    /** Get an instance of the validator */
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('user');
    }//end __construct()

    /**
     * Validates user input before it is added to the database.
     *
     * @param User $user Instance of model with data to be added
     * @throws OnLibrary::Exception::FatalAjaxException Input failed validation
     */
    public function creating($user)
    {
        $input = $user->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('insert')
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('users', $this->validator->getErrors())
                )
            );
        }//end if
    }//end creating

    /**
     * Validates user input before it is added to the database.
     *
     * @param User $user Instance of model with data to be updated
     * @throws OnLibrary::Exception::FatalAjaxException Input failed validation
     */
    public function updating($user)
    {
        $input = $user->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('update', ['id' => $input['id']])
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('users', $this->validator->getErrors())
                )
            );
        }//end if
    }//end updating
}//end class UserObserver