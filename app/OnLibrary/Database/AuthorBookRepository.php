<?php
namespace OnLibrary\Database;

interface AuthorBookRepository
{
    /** Error displayed when an author can't be linked to a book */
    const LINK_ERROR = 'There was a problem adding the author to the book.';

    /** Error displayed when an author can't be unlinked from a book */
    const UNLINK_ERROR = 'There was a problem removing the author from the book.';

    /**
     * Creates a row connecting a book to an author.
     *
     * @param integer $bookId ID of book to link
     * @param integer $authorId ID of author to link
     */
    public function linkBookAndAuthor($bookId, $authorId);

    /**
     * Removes a row connecting a book to an author.
     *
     * @param integer $bookId ID of book to link
     * @param integer $authorId ID of author to link
     */
    public function unlinkBookAndAuthor($bookId, $authorId);
}//end interface AuthorBookRepository

//end file AuthorBookRepository.php
