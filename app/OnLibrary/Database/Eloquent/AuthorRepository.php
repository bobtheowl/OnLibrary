<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\AuthorRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \Author;
use \Exception;

class AuthorRepository implements RepoInterface
{
    /**
     * Checks to see if the author already exists. If the author doesn't exist, creates it.
     *
     * @param string $name Name of author to create
     * @throws OnLibrary::Exception::FatalAjaxException Author couldn't be created
     * @retval integer ID of created (or existing) author
     */
    public function create($name)
    {
        try {
            return $this->getByName($name)['id'];
        } catch (FatalAjaxException $e) {
            $author = Author::create(['name' => $name]);
            return $author->id;
        }//end try/catch
    }//end create()

    /**
     * Returns the author based on the ID given.
     *
     * @param integer $id ID of author to retrieve
     * @retval Author Author data
     * @throws OnLibrary::Exception::FatalAjaxException Author doesn't exist
     */
    public function get($id)
    {
        try {
            $author = Author::findOrFail((int)$id);
            $author->load('books');
            return $author->toArray();
        } catch (Exception $e) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end try/catch
    }//end get()

    /**
     * Returns the author based on the name given.
     *
     * @param string $name Name of author to retrieve
     * @retval Author Author data
     * @throws OnLibrary::Exception::FatalAjaxException Author doesn't exist
     */
    public function getByName($name)
    {
        $author = Author::where('name', '=', $name)->get();
        $author->load('books');
        if ($author->count() === 0) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end if
        return $author->first()->toArray();
    }//end get()
}//end class AuthorRepository

//end file AuthorRepository.php
