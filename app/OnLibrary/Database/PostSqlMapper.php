<?php
namespace OnLibrary\Database;

use OnLibrary\Exception\InternalException;

class PostSqlMapper
{
    /** Error message when a bad table is requested */
    const BAD_TABLE_ERROR = 'Requested an invalid table.';

    private static $maps = [
        'users' => [
            'firstname' => 'first_name',
            'lastname' => 'last_name',
            'username' => 'username',
            'email' => 'email_address',
            'password' => 'password'
        ]//end self::$maps['user']
    ];//end self::$maps

    /**
     * Converts an array of POST data to an array of SQL data which can then be
     * passed to insert() or update(). This only affects the array keys.
     *
     * @param string $table Table to map data for
     * @param array $input Array of POST input
     * @throws OnLibrary::Exception::InternalException Requested table doesn't exist
     * @retval array Array of SQL input
     */
    public static function postToSql($table, array $input)
    {
        self::checkTable($table);
        $sqlData = [];
        foreach ($input as $key => $value) {
            if (array_key_exists($key, self::$maps[$table])) {
                $sqlData[self::$maps[$table][$key]] = $value;
            }//end if
        }//end foreach
        return $sqlData;
    }//end postToSql()
    
    /**
     * Converts an array of SQL data to an array of POST data. This only affects the
     * array keys.
     *
     * @param string $table Table to map data for
     * @param array $input Array of SQL input
     * @throws OnLibrary::Exception::InternalException Requested table doesn't exist
     * @retval array Array of POST input
     */
    public static function sqlToPost($table, array $input)
    {
        self::checkTable($table);
        $postData = [];
        foreach ($input as $key => $value) {
            $newKey = array_search($key, self::$maps[$table]);
            if ($newKey !== null && $newKey !== false) {
                $postData[$newKey] = $value;
            }//end if
        }//end foreach
        return $postData;
    }//end sqlToPost()
    
    /**
     * Checks to see if the specified table exists in the maps array.
     *
     * @param string $table Table to check
     * @throws OnLibrary::Exception::InternalException Requested table doesn't exist
     * @retval null
     */
    private static function checkTable($table)
    {
        if (array_key_exists($table, self::$maps) === false) {
            throw new InternalException(self::BAD_TABLE_ERROR);
        }//end if
    }//end checkTable()
}//end class PostSqlMapper

//end file PostSqlMapper.php