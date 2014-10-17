<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\BookRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \Book;
use \Exception;

class BookRepository implements RepoInterface
{
    /**
     * Attempts to get the requested book, or if the book doesn't exist, creates it.
     *
     * @param array $input Array of book select/insert data
     * @retval integer ID of selected/inserted book
     * @throws OnLibrary::Exception::FatalAjaxException
     */
    public function create(array $input)
    {
        try {
            return $this->getByData($input['title'], $input['subtitle'], $input['isbn'])['id'];
        } catch (FatalAjaxException $e) {
            $book = Book::create($input);
            return $book->id;
        }//end try/catch
    }//end create()

    /**
     * Returns the requested book based on the ID passed.
     *
     * @param integer $id ID of book to retrieve
     * @retval array Array of book data
     * @throws OnLibrary::Exception::FatalAjaxException Book could not be found
     */
    public function get($id)
    {
        try {
            $book = Book::findOrFail((int)$id);
            $book->load('publisher', 'series', 'authors');
            return $book->toArray();
        } catch (Exception $e) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end try/catch
    }//end get()

    /**
     * Returns the requested book based on the title, subtitle, and ISBN passed.
     *
     * @param string $title Title of book to retrieve
     * @param string $subtitle Subtitle of book to retrieve
     * @param string $isbn ISBN of book to retrieve
     * @throws OnLibrary::Exception::FatalAjaxException Book could not be found
     */
    public function getByData($title, $subtitle, $isbn)
    {
        $book = Book::where('title', '=', $title)
            ->where('subtitle', '=', $subtitle)
            ->where('isbn', '=', $isbn)
            ->get();
        $book->load('publisher', 'series', 'authors');
        if ($book->count() === 0) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end if
        return $book->first()->toArray();
    }//end getByData()
}//end class BookRepository

//end file BookRepository.php
