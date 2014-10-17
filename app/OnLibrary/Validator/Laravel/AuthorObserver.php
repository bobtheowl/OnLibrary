<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\FatalAjaxException;
use OnLibrary\Database\PostSqlMapper;

class AuthorObserver
{
    /** Data validator */
    private $validator;

    /** Get an instance of the validator */
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('author');
    }//end __construct()

    /**
     * Validates author input before it is added to the database.
     *
     * @param Author $author Instance of model with data to be added
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function creating($author)
    {
        $input = $author->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('insert')
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('authors', $this->validator->getErrors())
                )
            );
        }//end if
    }//end creating

    /**
     * Validates author input before it is added to the database.
     *
     * @param Author $author Instance of model with data to be updated
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function updating($author)
    {
        $input = $author->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('update', ['id' => $input['id']])
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('authors', $this->validator->getErrors())
                )
            );
        }//end if
    }//end updating
}//end class AuthorObserver