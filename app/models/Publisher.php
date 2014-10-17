<?php

class Publisher extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publishers';

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
        self::observe(App::make('OnLibrary\Validator\Laravel\PublisherObserver'));
    }//end boot()

    /**
     * Set up the one-to-many relationship with the books table.
     */
    public function books()
    {
        return $this->hasMany('Book');
    }//end books()
}//end class Publisher

//end file Publisher.php
