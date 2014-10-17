<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\FatalAjaxException;
use OnLibrary\Database\PostSqlMapper;

class PublisherObserver
{
    /** Data validator */
    private $validator;

    /** Get an instance of the validator */
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('publisher');
    }//end __construct()

    /**
     * Validates publisher input before it is added to the database.
     *
     * @param Publisher $publisher Instance of model with data to be added
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function creating($publisher)
    {
        $input = $publisher->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('insert')
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('publishers', $this->validator->getErrors())
                )
            );
        }//end if
    }//end creating

    /**
     * Validates publisher input before it is added to the database.
     *
     * @param Publisher $publisher Instance of model with data to be updated
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function updating($publisher)
    {
        $input = $publisher->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('update', ['id' => $input['id']])
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('publishers', $this->validator->getErrors())
                )
            );
        }//end if
    }//end updating
}//end class PublisherObserver