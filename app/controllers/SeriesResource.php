<?php
use OnLibrary\Database\SeriesRepository as Repository;
use OnLibrary\Database\PostSqlMapper;
use OnLibrary\Exception\InternalException;
use OnLibrary\Exception\FatalAjaxException;
use OnLibrary\Exception\NonFatalAjaxException;

class SeriesResource extends \BaseController
{
    /** Database repository */
    private $repo;

    /**
     * Create an instance of the repository.
     *
     * @param OnLibrary::Database::AuthorRepository $repo Database repository
     */
    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }//end __construct()

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }//end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }//end create()

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            return $this->repo->create(Input::get('series'));
        } catch (NonFatalAjaxException $e) {
            return Response::make($e->getMessage(), 200);
        } catch (FatalAjaxException $e) {
            return Response::make($e->getMessage(), 400);
        } catch (InternalException $e) {
            return Response::make(self::GENERIC_ERROR, 400);
        } catch (Exception $e) {
            return Response::make(self::GENERIC_ERROR, 500);
        }//end try/catches
    }//end store()

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return $this->repo->get($id);
        } catch (FatalAjaxException $e) {
            return Response::make($e->getMessage(), 400);
        } catch (Exception $e) {
            return Response::make(self::GENERIC_ERROR, 500);
        }//end try/catches
    }//end show()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }//end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }//end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }//end destroy()
}//end class SeriesResource

//end file SeriesResource.php

