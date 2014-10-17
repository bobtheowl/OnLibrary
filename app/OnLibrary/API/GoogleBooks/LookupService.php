<?php
namespace OnLibrary\API\GoogleBooks;

use OnLibrary\API\LookupService as LookupInterface;
use OnLibrary\API\SearchResult;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException;
use OnLibrary\Exception\InternalException;

class LookupService implements LookupInterface
{
    const BASE_URL = 'https://www.googleapis.com/books/v1/volumes';
    
    const BAD_FIELD_ERROR = 'Attempted to request a non-existant field.';
    
    private static $fields = [
        'title' => 'intitle',
        'author' => 'inauthor',
        'publisher' => 'inpublisher',
        'isbn' => 'isbn'
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
        $this->client->setDefaultOption('verify', false);
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
        
        if ($response->getStatusCode() !== '200') {
            throw new InternalException(
                $response->getStatusCode() . ' ' . $response->getReasonPhrase()
            );
        }//end if
        $this->populateResult($response);
        
        return $this->result;
    }//end search()
    
    private function createRequest(array $params)
    {
        return $this->client->createRequest(
            'GET',
            self::BASE_URL,
            [
                'headers' => ['Accept' => 'application/json'],
                'query' => $params
            ]
        );
    }//end createRequest()
    
    private function populateResult($response)
    {
        $data = $response->json();
        if (isset($data['totalItems']) && $data['totalItems'] > 0) {
            $book = $data['items'][0]['volumeInfo'];
            $this->result['title'] = (isset($book['title'])) ? $book['title'] : '';
            $this->result['subtitle'] = (isset($book['subtitle'])) ? $book['subtitle'] : '';
            $this->result['series'] = '';// Google doesn't return series
            $this->result['authors'] = (isset($book['authors'])) ? $book['authors'] : [];
            $this->result['publisher'] = (isset($book['publisher'])) ? $book['publisher'] : '';
            $this->result['isbn'] = '';
            foreach ($book['industryIdentifiers'] as $identifier) {
                if ($identifier['type'] === 'ISBN_13') {
                    $this->result['isbn'] = $identifier['identifier'];
                }//end if
            }//end foreach
        }//end if
    }//end populateResult()
}//end class LookupService

//end file LookupService.php
