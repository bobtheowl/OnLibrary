<?php
namespace OnLibrary\User;

interface CurrentUser
{
    /**
     * Error message to be thrown when trying to retrieve a property if the
     * user is not logged in.
     */
    const PROPERTY_AUTH_ERROR = 'Attempting to access user property without user being logged in.';
    
    /**
     * Error message to be thrown when trying to retrieve a property that
     * doesn't exist.
     */
    const BAD_PROPERTY_ERROR = 'Attempting to access a non-existant user property.';

    /**
     * Checks to see if the user is logged in
     *
     * @retval boolean True if user is logged in, false otherwise
     */
    public function isLoggedIn();

    /**
     * Retrieves the specified database field for the current user
     *
     * @param string $property Name of the database field to get
     * @retval mixed Data from database
     * @throws OnLibrary::Exception::FatalAjaxException User is not logged in.
     */
    public function __get($property);
}//end interface CurrentUser

//end file CurrentUser.php
