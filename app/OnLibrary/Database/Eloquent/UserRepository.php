<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\UserRepository as RepoInterface;
use OnLibrary\Exception\FatalAjaxException;
use \User;

class UserRepository implements RepoInterface
{
    /** Error message when user could not be found */
    const USER_NOT_FOUND_ERROR = 'The requested user could not be found.';

    /** Error message when unable to update the database */
    const DATABASE_ERROR = 'There was a problem updating the database.';

    /**
     * Returns all users.
     *
     * @retval array Array of all users
     */
    public function all()
    {
        return User::all()->toArray();
    }//end all()

    /**
     * Returns data for a specific user.
     *
     * @param integer $id ID of user to return data for
     * @param boolean $returnModel (optional) If true, return the Eloquent model
     * @throws OnLibrary::Exception::FatalAjaxException Unable to find user
     * @retval array Array of user data
     */
    public function select($id, $returnModel = false)
    {
        try {
            $user = User::findOrFail($id);
            return ($returnModel) ? $user : $user->toArray();
        } catch (Exception $e) {
            throw new FatalAjaxException(self::USER_NOT_FOUND_ERROR);
        }//end try/catch
    }//end select()

    /**
     * Adds a new user to the database.
     *
     * @param array $input Data to add to the database
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function insert(array $input)
    {
        $user = new User;
        $user->fill($input);
        if ($user->save() === false) {
            throw new FatalAjaxException(self::DATABASE_ERROR);
        }//end if
    }//end insert()

    /**
     * Updates a user's data in the database.
     *
     * @param integer $id ID of user to update data for
     * @param array $input Array of data to update
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function update($id, array $input)
    {
        $user = $this->select($id, true);
        $user->fill($input);
        if ($user->update() === false) {
            throw new FatalAjaxException(self::DATABASE_ERROR);
        }//end if
    }//end update()

    /**
     * Generates a random password and sets it on the given user.
     *
     * @param integer $id ID of user to generate password for
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval string The new password
     */
    public function resetPassword($id)
    {
        //
    }//end resetPassword()

    /**
     * Deletes the specified user.
     *
     * @param integer $id ID of user to delete
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function delete($id)
    {
        $user = $this->select($id, true);
        if ($user->delete() === false) {
            throw new FatalAjaxException(self::DATABASE_ERROR);
        }//end if
    }//end delete()
}//end class UserRepository

//end file UserRepository.php
