<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\BookRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \Book;
use \Exception;

class BookRepository implements RepoInterface
{
    /**
     * Returns all books.
     *
     * @retval array Array of book data
     */
    public function all()
    {
        //
    }//end all()

    /**
     * Returns all books linked to the specified user.
     *
     * @param integer $userId ID of user to get books for
     * @retval array Array of book data
     */
    public function allForUser($userId)
    {
        //
    }//end allForUser()

    /**
     * Returns an array of book data matching the passed search criteria.
     *
     * @param array $criteria Array of search criteria
     * @param integer $userId ID of user to get books for
     * @retval array Array of book data
     */
    public function search(array $criteria, $userId)
    {
        $books = Book::forUser($userId);
        if (!empty($criteria['title'])) {
            $criteria['title'] = strtolower($criteria['title']);
            $books->whereRaw('lower(title) like ?', ['%' . implode('%', explode(' ', $criteria['title'])) . '%']);
        }//end if
        if (!empty($criteria['subtitle'])) {
            $criteria['subtitle'] = strtolower($criteria['subtitle']);
            $books->whereRaw('lower(subtitle) like ?', ['%' . implode('%', explode(' ', $criteria['subtitle'])) . '%']);
        }//end if
        if (!empty($criteria['isbn'])) {
            $books->where('isbn', 'like', '%' . $criteria['isbn'] . '%');
        }//end if
        if (!empty($criteria['series'])) {
            $books->searchSeries($criteria['series']);
        }//end if
        if (!empty($criteria['publisher'])) {
            $books->searchPublisher($criteria['publisher']);
        }//end if
        if (!empty($criteria['author'])) {
            $books->searchAuthor($criteria['author']);
        }//end if
        return $books->with('publisher', 'series', 'authors')->get()->toArray();
    }//end search()

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
