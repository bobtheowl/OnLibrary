<?php
namespace OnLibrary\Database;

interface BookRepository
{
    /** Error thrown when book could not be found */
    const NOT_FOUND_ERROR = 'The requested book could not be found.';

    /**
     * Returns all books.
     *
     * @retval array Array of book data
     */
    public function all();

    /**
     * Returns all books linked to the specified user.
     *
     * @param integer $userId ID of user to get books for
     * @retval array Array of book data
     */
    public function allForUser($userId);

    /**
     * Returns an array of book data matching the passed search criteria.
     *
     * @param array $criteria Array of search criteria
     * @param integer $userId ID of user to get books for
     * @retval array Array of book data
     */
    public function search(array $criteria, $userId);

    /**
     * Attempts to get the requested book, or if the book doesn't exist, creates it.
     *
     * @param array $input Array of book select/insert data
     * @retval integer ID of selected/inserted book
     * @throws OnLibrary::Exception::FatalAjaxException
     */
    public function create(array $input);

    /**
     * Returns the requested book based on the ID passed.
     *
     * @param integer $id ID of book to retrieve
     * @retval array Array of book data
     * @throws OnLibrary::Exception::FatalAjaxException Book could not be found
     */
    public function get($id);

    /**
     * Returns the requested book based on the title, subtitle, and ISBN passed.
     *
     * @param string $title Title of book to retrieve
     * @param string $subtitle Subtitle of book to retrieve
     * @param string $isbn ISBN of book to retrieve
     * @throws OnLibrary::Exception::FatalAjaxException Book could not be found
     */
    public function getByData($title, $subtitle, $isbn);
}//end interface BookRepository

//end file BookRepository.php
