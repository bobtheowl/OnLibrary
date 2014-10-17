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
     * The attributes which are not mass-assignable.
     *
     * @var array
     */
    protected $guarded = array('id', 'created_at', 'updated_at');

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
    
    /**
     * Sets up many-to-many relationship with the books table.
     */
    public function books()
    {
        return $this->belongsToMany('Book');
    }//end books()
}//end class Author

//end file Author.php
