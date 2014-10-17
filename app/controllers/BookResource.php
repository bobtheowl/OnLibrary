<?php

class BookResource extends \BaseController
{
    /** Error displayed when required input is missing */
    const MISSING_INPUT_ERROR = 'The required input was not sent.';
    
    /** Error displayed when a book could not be found */
    const BOOK_NOT_FOUND = 'The requested book could not be found.';

    /** Error displayed when there was a problem using a lookup API */
    const API_ERROR = 'A problem occurred while attempting to look up the book.';
    
    /** Error displayed when a generic/internal exception is thrown */
    const UNKNOWN_ERROR = 'An unknown error occurred.';

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
        //
    }//end store()

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
    
    /**
     * Lookup book data using the specified API service
     *
     * @param string $serviceId
     * @return Response
     */
    public function search($serviceId)
    {
        if (Input::has('query') === false) {
            return Response::make(self::MISSING_INPUT_ERROR, 400);
        }//end if
        $query = Input::get('query');
        // Attempt to look up the book
        try {
            $lookup = OnLibrary\API\LookupServiceFactory::getByServiceId($serviceId);
            $result = $lookup->search($query, 'isbn');
        } catch (InternalException $e) {
            return Response::make(self::API_ERROR, 400);
        } catch (Exception $e) {
            return Response::make(var_export($e, true), 400);
            //return Response::make(self::UNKNOWN_ERROR, 400);
        }//end try/catches
        // Return the appropriate response depending on if data was returned or not
        return ($result->hasData())
            ? Response::make($result->toJson(), 200)
            : Response::make(self::BOOK_NOT_FOUND, 400);
    }//end search()
}//end class BookResource

//end file BookResource.php

