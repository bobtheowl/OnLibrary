<?php
namespace OnLibrary\Database;

interface UserRepository
{
    /**
     * Returns all users.
     *
     * @retval array Array of all users
     */
    public function all();

    /**
     * Returns data for a specific user.
     *
     * @param integer $id ID of user to return data for
     * @param boolean $returnModel (optional) If true, return the Eloquent model
     * @throws OnLibrary::Exception::FatalAjaxException Unable to find user
     * @retval array Array of user data
     */
    public function select($id, $returnModel = false);

    /**
     * Adds a new user to the database.
     *
     * @param array $input Data to add to the database
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function insert(array $input);

    /**
     * Updates a user's data in the database.
     *
     * @param integer $id ID of user to update data for
     * @param array $input Array of data to update
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function update($id, array $input);

    /**
     * Generates a random password and sets it on the given user.
     *
     * @param integer $id ID of user to generate password for
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval string The new password
     */
    public function resetPassword($id);

    /**
     * Deletes the specified user.
     *
     * @param integer $id ID of user to delete
     * @throws OnLibrary::Exception::FatalAjaxException Unable to update the database
     * @retval null
     */
    public function delete($id);
}//end interface UserRepository

//end file UserRepository.php
