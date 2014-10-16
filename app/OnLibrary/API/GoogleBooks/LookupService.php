<?php
namespace OnLibrary\API\GoogleBooks;

use OnLibrary\API\LookupService as LookupInterface;
use OnLibrary\API\SearchResult;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException;
use OnLibrary\Exception\InternalException;// Just in case, may be removed later

class LookupService implements LookupInterface
{
    const BASE_URL = 'http://www.googleapis.com/books/v1/volumes';
    
    const BAD_FIELD_ERROR = 'Attempted to request a non-existant field.';
    
    private static $fields = [
        'title': 'intitle',
        'author': 'inauthor',
        'publisher': 'inpublisher',
        'isbn': 'isbn'
    ];
    
    private $client;
    
    private $result;
    
    /**
     * Stores an instance of GuzzleHttp::Client.
     *
     * @param GuzzleHttp::Client $client
     */
    public function __construct(Client $client, SearchResult $result)
    {
        $this->client = $client;
        $this->result = $result;
    }//end __construct()
    
    //http://www.googleapis.com/books/v1/volumes?q=isbn:
    /**
     * Performs a lookup for the given query.
     *
     * @param string $query Search query
     * @param string $field (optional) Specific field to search
     * @retval OnLibrary::API::SearchResult Search result object containing book data
     * @throws GuzzleHttp::Exception::RequestException Error with the request
     * @throws OnLibrary::Exception::InternalException Bad field was specified
     */
    public function search($query, $field = null)
    {
        if ($field !== null && array_key_exists($field, self::$fields) === false) {
            throw new InternalException(self::BAD_FIELD_ERROR);
        }//end if
        
        $request = $this->createRequest([
            'q' => ($field === null) ? $query : self::$fields[$field] . ':' . $query
        ]);
        $response = $this->client->send($request);
        
        if ($response->getStatusCode() === 200) {
            $this->populateResult($response);
        }//end if
        
        return $this->result;
    }//end search()
    
    private function createRequest(array $params)
    {
        return $this->client->createRequest(
            'GET',
            self::BASE_URL,
            $params
        );
    }//end createRequest()
    
    private function populateResult($response)
    {
        // TODO: This
        $this->result['title'] = '';
        $this->result['subtitle'] = '';
        $this->result['series'] = '';
        $this->result['authors'] = '';
        $this->result['publisher'] = '';
        $this->result['isbn'] = '';
    }//end populateResult()
}//end class LookupService

//end file LookupService.php
