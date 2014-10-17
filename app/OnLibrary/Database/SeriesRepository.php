<?php
namespace OnLibrary\Database;

interface SeriesRepository
{
    /** Error displayed if the series couldn't be created */
    const CREATE_ERROR = 'The series could not be added to the database.';

    /** Error displayed if the requested series doesn't exist */
    const NOT_FOUND_ERROR = 'The requested series could not be found.';

    /**
     * Checks to see if the series already exists. If the series doesn't exist, creates it.
     *
     * @param string $name Name of series to create
     * @throws OnLibrary::Exception::FatalAjaxException Series couldn't be created
     * @retval integer ID of created (or existing) series
     */
    public function create($name);

    /**
     * Returns the series based on the ID given.
     *
     * @param integer $id ID of series to retrieve
     * @retval array Series data
     * @throws OnLibrary::Exception::FatalAjaxException Series doesn't exist
     */
    public function get($id);

    /**
     * Returns the series based on the name given.
     *
     * @param string $name Name of series to retrieve
     * @retval array Series data
     * @throws OnLibrary::Exception::FatalAjaxException Series doesn't exist
     */
    public function getByName($name);
}//end interface SeriesRepository

//end file SeriesRepository.php
