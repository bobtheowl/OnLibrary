<?php

class Author extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * Sets up the validation and logging.
     *
     * @retval null
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(App::make('OnLibrary\Validator\Laravel\AuthorObserver'));
    }//end boot()
}//end class Author

//end file Author.php
