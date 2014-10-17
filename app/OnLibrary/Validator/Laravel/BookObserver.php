<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\FatalAjaxException;
use OnLibrary\Database\PostSqlMapper;

class BookObserver
{
    /** Data validator */
    private $validator;

    /** Get an instance of the validator */
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('book');
    }//end __construct()

    /**
     * Validates book input before it is added to the database.
     *
     * @param Book $book Instance of model with data to be added
     * @throws OnLibrary::Exception::FatalAjaxException Input failed validation
     */
    public function creating($book)
    {
        $input = $book->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('insert')
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('books', $this->validator->getErrors())
                )
            );
        }//end if
    }//end creating

    /**
     * Validates book input before it is added to the database.
     *
     * @param Book $book Instance of model with data to be updated
     * @throws OnLibrary::Exception::FatalAjaxException Input failed validation
     */
    public function updating($book)
    {
        $input = $book->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('update', ['id' => $input['id']])
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('books', $this->validator->getErrors())
                )
            );
        }//end if
    }//end updating
}//end class BookObserver

//end file BookObserver.php
