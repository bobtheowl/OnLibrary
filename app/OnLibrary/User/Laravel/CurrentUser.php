<?php
namespace OnLibrary\User\Laravel;

use OnLibrary\User\CurrentUser as UserInterface;
use OnLibrary\Exception\InternalException;
use \Auth;

/**
 * Laravel implementation of the CurrentUser interface
 */
class CurrentUser implements UserInterface
{
    /** Laravel Auth user object */
    private $user;

    /**
     * Retrieves the Laravel user object.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }//end __construct()

    /**
     * Checks to see if the user is logged in
     *
     * @retval boolean True if user is logged in, false otherwise
     */
    public function isLoggedIn()
    {
        return ($this->user !== null);
    }//end isLoggedIn()

    /**
     * Retrieves the specified database field for the current user
     *
     * @param string $property Name of the database field to get
     * @retval mixed Data from database
     * @throws OnLibrary::Exception::InternalException User is not logged in.
     * @throws OnLibrary::Exception::InternalException Property doesn't exist.
     */
    public function __get($property)
    {
        if ($this->isLoggedIn() === false) {
            throw new InternalException(self::PROPERTY_AUTH_ERROR);
        }//end if

        if (isset($this->user->$property) === false) {
            throw new InternalException(self::BAD_PROPERTY_ERROR);
        }//end if

        return $this->user->$property;
    }//end __get()
}//end class CurrentUser

//end file CurrentUser.php
