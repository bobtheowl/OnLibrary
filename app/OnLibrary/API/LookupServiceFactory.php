<?php
namespace OnLibrary\API;

use OnLibrary\Exception\InternalException;
use \App;

class LookupServiceFactory
{
    /** Error thrown when requesting an invalid service ID */
    const BAD_SERVICE_ERROR = 'Requested an invalid lookup service.';
    
    /** Array of valid lookup services mapped to classes */
    private static $lookupServices = [
        'googlebooks' => 'OnLibrary\API\GoogleBooks\LookupService'
    ];
    
    /**
     * Returns an instance of OnLibrary::API::LookupService matching the
     * given service ID.
     *
     * @param string $serviceId Unique identifier for requested lookup service
     * @retval OnLibrary::API::LookupService Instance of LookupService interface
     * @throws OnLibrary::Exception::InternalException Invalid lookup service ID
     */
    public static function getByServiceId($serviceId)
    {
        $serviceId = trim(strtolower($serviceId));
        if (array_key_exists($serviceId, self::$lookupServices) === false) {
            throw new InternalException(self::BAD_SERVICE_ERROR);
        }
        return App::make(self::$lookupServices[$serviceId]);
    }//end getByServiceId()
}//end class LookupServiceFactory

//end file LookupServiceFactory.php
