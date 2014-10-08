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
     * Set up the one-to-many relationship with the books table.
     */
    public function books()
    {
        return $this->hasMany('Book');
    }//end books()
}//end class Publisher

//end file Publisher.php
