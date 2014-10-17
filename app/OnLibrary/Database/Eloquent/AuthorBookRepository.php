<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\AuthorBookRepository as RepoInterface;
use OnLibrary\Exception\NonFatalAjaxException;
use \AuthorBook;
use \Author;
use \Book;

class AuthorBookRepository implements RepoInterface
{
    /**
     * Creates a row connecting a book to an author.
     *
     * @param integer $bookId ID of book to link
     * @param integer $authorId ID of author to link
     */
    public function linkBookAndAuthor($bookId, $authorId)
    {
        $row = AuthorBook::firstOrCreate([
            'author_id' => (int)$authorId,
            'book_id' => (int)$bookId
        ]);
        if (empty($row->id)) {
            throw new NonFatalAjaxException(self::LINK_ERROR);
        }//end if
        return $row->id;
    }//end linkBookAndAuthor()

    /**
     * Removes a row connecting a book to an author.
     *
     * @param integer $bookId ID of book to link
     * @param integer $authorId ID of author to link
     */
    public function unlinkBookAndAuthor($bookId, $authorId)
    {
        $rows = AuthorBook::where('author_id', '=', (int)$authorId)
            ->where('book_id', '=', (int)$bookId)
            ->get();
        foreach ($rows as $row) {
            if ($row->delete() === false) {
                throw new NonFatalAjaxException(self::UNLINK_ERROR);
            }//end if
        }//end foreach
    }//end unlinkBookAndAuthor()
}//end class AuthorBookRepository

//end file AuthorBookRepository.php
