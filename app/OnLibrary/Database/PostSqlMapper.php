<?php
namespace OnLibrary\Database;

use OnLibrary\Exception\InternalException

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
     * passed to insert() or update().
     *
     * @param string $table Table to map data for
     * @param array $input Array of POST input
     * @throws OnLibrary::Exception::InternalException Requested table doesn't exist
     * @retval array Array of SQL input
     */
    public static function generateSqlArray($table, array $input)
    {
        if (array_key_exists($table, self::$maps) === false) {
            throw new InternalException(self::BAD_TABLE_ERROR);
        }//end if

        $sqlData = [];
        foreach ($input as $key => $value) {
            if (array_key_exists($key, self::$maps[$table][$key])) {
                $sqlData[self::$maps[$table][$key]] = $value;
            }//end if
        }//end foreach
        return $sqlData;
    }//end generateSqlArray()
}//end class PostSqlMapper

//end file PostSqlMapper.php