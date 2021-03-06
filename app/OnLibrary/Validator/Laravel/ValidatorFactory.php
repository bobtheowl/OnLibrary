<?php
namespace OnLibrary\Validator\Laravel;

use OnLibrary\Exception\InternalException;
use \App;

class ValidatorFactory
{
    /** Error message displayed when an invalid validator type is requested */
    const INVALID_TYPE_ERROR = 'Requested an invalid validator type.';

    /** Array of valid validator types */
    private static $types = array(
        'author' => 'OnLibrary\Validator\Laravel\AuthorValidator',
        'book' => 'OnLibrary\Validator\Laravel\BookValidator',
        'publisher' => 'OnLibrary\Validator\Laravel\PublisherValidator',
        'series' => 'OnLibrary\Validator\Laravel\SeriesValidator',
        'user' => 'OnLibrary\Validator\Laravel\UserValidator'
    );

    /**
     * Returns an instance of OnLibrary::Validator::ValidatorInterface based
     * on the type specified.
     *
     * @param string $type The type of validator to return
     * @return OnLibrary::Validator::ValidatorInterface
     * @throws OnLibrary::Exception::InternalException Invalid type specified
     */
    public static function getByType($type)
    {
        if (array_key_exists($type, self::$types) === false) {
            throw new InternalException(self::INVALID_TYPE_ERROR);
        }//end if
        return App::make(self::$types[$type]);
    }//end getByType()
}//end class ValidatorFactory

//end file ValidatorFactory.php
