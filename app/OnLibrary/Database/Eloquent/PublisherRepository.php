<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\PublisherRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \Publisher;

class PublisherRepository implements RepoInterface
{
    /**
     * Checks to see if the publisher already exists. If the publisher doesn't exist, creates it.
     *
     * @param string $name Name of publisher to create
     * @throws OnLibrary::Exception::FatalAjaxException Publisher couldn't be created
     * @retval integer ID of created (or existing) publisher
     */
    public function create($name)
    {
        try {
            return $this->getByName($name)['id'];
        } catch (FatalAjaxException $e) {
            $publisher = Publisher::create(['name' => $name]);
            return $publisher->id;
        }//end try/catch
    }//end create()

    /**
     * Returns the publisher based on the ID given.
     *
     * @param integer $id ID of publisher to retrieve
     * @retval array Publisher data
     * @throws OnLibrary::Exception::FatalAjaxException Publisher doesn't exist
     */
    public function get($id)
    {
        try {
            $publisher = Publisher::findOrFail((int)$id);
            $publisher->load('books');
            return $publisher->toArray();
        } catch (Exception $e) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end try/catch
    }//end get()

    /**
     * Returns the publisher based on the name given.
     *
     * @param string $name Name of publisher to retrieve
     * @retval array Publisher data
     * @throws OnLibrary::Exception::FatalAjaxException Publisher doesn't exist
     */
    public function getByName($name)
    {
        $publisher = Publisher::where('name', '=', $name)->get();
        $publisher->load('books');
        if ($publisher->count() === 0) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end if
        return $publisher->first()->toArray();
    }//end getByName()
}//end class PublisherRepository

//end file PublisherRepository.php
