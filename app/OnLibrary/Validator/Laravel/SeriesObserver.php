<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\FatalAjaxError;

class SeriesObserver
{
    /** Data validator */
    private $validator;

    /** Get an instance of the validator */
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('series');
    }//end __construct()

    /**
     * Validates series input before it is added to the database.
     *
     * @param Series $series Instance of model with data to be added
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function creating($series)
    {
        $input = $series->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('insert')
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('series', $this->validator->getErrors())
                )
            );
        }//end if
    }//end creating

    /**
     * Validates series input before it is added to the database.
     *
     * @param Series $series Instance of model with data to be updated
     * @throws OnLibrary::Exception::FatalAjaxError Input failed validation
     */
    public function updating($series)
    {
        $input = $series->getAttributes();
        $success = $this->validator
            ->usingInput($input)
            ->usingRule('update', ['id' => $input['id']])
            ->isValid();
        if ($success === false) {
            throw new FatalAjaxException(
                json_encode(
                    PostSqlMapper::sqlToPost('series', $this->validator->getErrors())
                )
            );
        }//end if
    }//end updating
}//end class SeriesObserver