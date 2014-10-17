<?php
namespace OnLibrary\Database;

interface AuthorRepository
{
    /** Error displayed if the author couldn't be created */
    const CREATE_ERROR = 'The author could not be added to the database.';

    /** Error displayed if the requested author doesn't exist */
    const NOT_FOUND_ERROR = 'The requested author could not be found.';

    /**
     * Checks to see if the author already exists. If the author doesn't exist, creates it.
     *
     * @param string $name Name of author to create
     * @throws OnLibrary::Exception::FatalAjaxException Author couldn't be created
     * @retval integer ID of created (or existing) author
     */
    public function create($name);

    /**
     * Returns the author based on the ID given.
     *
     * @param integer $id ID of author to retrieve
     * @retval array Author data
     * @throws OnLibrary::Exception::FatalAjaxException Author doesn't exist
     */
    public function get($id);

    /**
     * Returns the author based on the name given.
     *
     * @param string $name Name of author to retrieve
     * @retval array Author data
     * @throws OnLibrary::Exception::FatalAjaxException Author doesn't exist
     */
    public function getByName($name);
}//end interface AuthorRepository

//end file AuthorRepository.php
