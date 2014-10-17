<?php

class BaseController extends Controller
{
    /** Generic error to display */
    const GENERIC_ERROR = 'An unknown error occurred.';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (is_null($this->layout) === false) {
            $this->layout = View::make($this->layout);
        }//end if
    }//end setupLayout()
}//end class BaseController

//end file BaseController.php
