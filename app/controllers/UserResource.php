<?php
use OnLibrary\Database\UserRepository as Repository;
use OnLibrary\Database\PostSqlMapper;
use OnLibrary\Exception\InternalException;
use OnLibrary\Exception\FatalAjaxError;

class UserResource extends \BaseController
{
    /** Generic error to display */
    const GENERIC_ERROR = 'An unknown error occurred.';

    /** Database repository */
    private $repo;

    /**
     * Store an instance of the repository
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
        return $this->repo->all();
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
            $input = PostSqlMapper::generateSqlArray('users', Input::all());
            $this->repo->insert($input);
        } catch (FatalAjaxError $e) {
            return Response::make($e->getMessage(), 400);
        } catch (InternalError $e) {
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
            return $this->repo->select($id);
        } catch (FatalAjaxError $e) {
            return Response::make($e->getMessage(), 400);
        } catch (InternalError $e) {
            return Response::make(self::GENERIC_ERROR, 400);
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
}//end class UserResource

//end file UserResource.php
