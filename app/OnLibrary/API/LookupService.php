<?php
namespace OnLibrary\API;

interface LookupService
{
    /**
     * Performs a lookup for the given query.
     *
     * @param string $query Search query
     * @param string $field (optional) Specific field to search
     * @retval OnLibrary::API::SearchResult Search result object containing book data
     */
    public function search($query, $field = null);
}//end interface LookupService

//end file LookupService.php
