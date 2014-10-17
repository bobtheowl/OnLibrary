<?php
namespace OnLibrary\Database;

interface PublisherRepository
{
    /** Error displayed if the publisher couldn't be created */
    const CREATE_ERROR = 'The publisher could not be added to the database.';

    /** Error displayed if the requested publisher doesn't exist */
    const NOT_FOUND_ERROR = 'The requested publisher could not be found.';

    /**
     * Checks to see if the publisher already exists. If the publisher doesn't exist, creates it.
     *
     * @param string $name Name of publisher to create
     * @throws OnLibrary::Exception::FatalAjaxException Publisher couldn't be created
     * @retval integer ID of created (or existing) publisher
     */
    public function create($name);

    /**
     * Returns the publisher based on the ID given.
     *
     * @param integer $id ID of publisher to retrieve
     * @retval array Publisher data
     * @throws OnLibrary::Exception::FatalAjaxException Publisher doesn't exist
     */
    public function get($id);

    /**
     * Returns the publisher based on the name given.
     *
     * @param string $name Name of publisher to retrieve
     * @retval array Publisher data
     * @throws OnLibrary::Exception::FatalAjaxException Publisher doesn't exist
     */
    public function getByName($name);
}//end interface PublisherRepository

//end file PublisherRepository.php
