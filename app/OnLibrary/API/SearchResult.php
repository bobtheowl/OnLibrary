<?php
namespace OnLibrary\API;

use \ArrayAccess;

class SearchResult implements ArrayAccess
{
    /**
     * Array of book data
     */
    private $data = [
        'title' => '',
        'subtitle' => '',
        'series' => '',
        'authors' => [],
        'publisher' => '',
        'isbn' => ''
    ];

    /**
     * Checks to see if any of the data fields contain data.
     *
     * @retval boolean True if at least one of the fields contain data
     */
    public function hasData()
    {
        return (
            !empty($this->data['title']) ||
            !empty($this->data['subtitle']) ||
            !empty($this->data['series']) ||
            !empty($this->data['authors']) ||
            !empty($this->data['publisher']) ||
            !empty($this->data['isbn'])
        );
    }//end hasData()

    /**
     * Returns a JSON-encoded string containing the data object.
     *
     * @retval string JSON string
     */
    public function toJson()
    {
        return json_encode($this->data, true);
    }//end toJson()

    /**
     * Checks to see if the specified data offset exists.
     *
     * @param string $offset Data offset to check
     * @retval boolean True if offset exists
     */
    public function offsetExists($offset)
    {
        return (array_key_exists($offset, $this->data));
    }//end offsetExists()

    /**
     * Returns the specified data offset.
     *
     * @param string $offset Data offset to get
     * @retval mixed Data from data offset
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }//end offsetGet()

    /**
     * Sets a new value to the specified data offset.
     *
     * @param string $offset Data offset to set value to
     * @param mixed $value Value to set
     * @retval null
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }//end offsetSet()

    /**
     * Clears the specified data offset.
     *
     * @param string $offset Offset to clear
     * @retval null
     */
    public function offsetUnset($offset)
    {
        switch ($offset) {
            case 'authors':
                $this->data['authors'] = [];
            default:
                $this->data[$offset] = '';
        }//end switch
    }//end offsetUnset()
}//end class SearchResult

//end file SearchResult.php
