<?php
namespace OnLibrary\Database;

interface BookUserRepository
{
    /** Error displayed when a user can't be linked to a book */
    const LINK_ERROR = 'There was a problem adding the book to the user.';

    /** Error displayed when a user can't be unlinked from a book */
    const UNLINK_ERROR = 'There was a problem removing the book from the user.';

    /**
     * Creates a row connecting a book to a user.
     *
     * @param integer $bookId ID of book to link
     * @param integer $userId ID of user to link
     * @throws OnLibrary::Exception::NonFatalAjaxException Book and user couldn't be linked
     */
    public function linkBookAndUser($bookId, $userId);

    /**
     * Removes a row connecting a book to a user.
     *
     * @param integer $bookId ID of book to unlink
     * @param integer $userId ID of user to unlink
     * @throws OnLibrary::Exception::NonFatalAjaxException Book and user couldn't be unlinked
     */
    public function unlinkBookAndUser($bookId, $userId);
}//end interface BookUserRepository

//end file BookUserRepository.php
