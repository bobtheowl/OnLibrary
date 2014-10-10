<?php
namespace OnLibrary\Validator\Laravel;

class AuthorObserver
{
    private $validator;
    
    public function __construct()
    {
        $this->validator = ValidatorFactory::getByType('author');
    }//end __construct()
    
    public function creating($author)
    {
        $input = $author->getAttributes();
        if ($this->validator->usingInput($input)->usingRule('insert')->isValid() === false) {
            
        }//end if
    }//end creating
    
    public function updating($author)
    {
        
    }//end updating
}//end class