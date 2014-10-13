<?php
use OnLibrary\Database\UserRepository as Repository;
use OnLibrary\Database\PostSqlMapper;
use OnLibrary\Exception\InternalException;
use OnLibrary\Exception\FatalAjaxException;

class UserResource extends \BaseController
{
    /** Generic error to display */
    const GENERIC_ERROR = 'An unknown error occurred.';
    
    /** Message to display on login screen on successful account creation */
    const CREATE_SUCCESS = '<strong>Your account has been created!</strong> You may now log in above.';

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
            $input = Input::all();
            $input['password'] = Hash::make($input['password']);
            $input = PostSqlMapper::postToSql('users', $input);
            $this->repo->insert($input);
            Session::flash('auth-message', self::CREATE_SUCCESS);
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
            return $this->repo->select($id);
        } catch (FatalAjaxException $e) {
            return Response::make($e->getMessage(), 400);
        } catch (InternalException $e) {
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
