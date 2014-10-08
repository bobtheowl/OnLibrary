<?php

class AuthorBook extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'author_book';

    /**
     * Set up the one-to-many relationship with the author_book table.
     */
    public function author_books()
    {
        return $this->hasMany('AuthorBook');
    }//end author_books()

    /**
     * Set up the many-to-many relationship with the books table.
     */
    public function books()
    {
        return $this->belongsToMany('Book');
    }//end books()
}//end class AuthorBook

//end file AuthorBook.php
