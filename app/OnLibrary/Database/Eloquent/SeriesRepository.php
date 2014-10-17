<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\SeriesRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \Series;

class SeriesRepository implements RepoInterface
{
    /**
     * Checks to see if the series already exists. If the series doesn't exist, creates it.
     *
     * @param string $name Name of series to create
     * @throws OnLibrary::Exception::FatalAjaxException Series couldn't be created
     * @retval integer ID of created (or existing) series
     */
    public function create($name)
    {
        try {
            return $this->getByName($name)['id'];
        } catch (FatalAjaxException $e) {
            $series = Series::create(['name' => $name]);
            return $series->id;
        }//end try/catch
    }//end create()

    /**
     * Returns the series based on the ID given.
     *
     * @param integer $id ID of series to retrieve
     * @retval array Series data
     * @throws OnLibrary::Exception::FatalAjaxException Series doesn't exist
     */
    public function get($id)
    {
        try {
            $series = Series::findOrFail((int)$id);
            $series->load('books');
            return $series->toArray();
        } catch (Exception $e) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end try/catch
    }//end get()

    /**
     * Returns the series based on the name given.
     *
     * @param string $name Name of series to retrieve
     * @retval array Series data
     * @throws OnLibrary::Exception::FatalAjaxException Series doesn't exist
     */
    public function getByName($name)
    {
        $series = Series::where('name', '=', $name)->get();
        $series->load('books');
        if ($series->count() === 0) {
            throw new FatalAjaxException(self::NOT_FOUND_ERROR);
        }//end if
        return $series->first()->toArray();
    }//end getByName()
}//end class SeriesRepository

//end file SeriesRepository.php
