<?php

class Book extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * Set up the one-to-many relationship with the publishers table.
     */
    public function publisher()
    {
        return $this->belongsTo('Publisher');
    }//end publisher()

    /**
     * Set up the one-to-many relationship with the series table.
     */
    public function series()
    {
        return $this->belongsTo('Series');
    }//end series()
    
    /**
     * Set up the one-to-many relationship with the author_book table.
     */
    public function author_books()
    {
        return $this->hasMany('AuthorBook');
    }//end author_books()

    /**
     * Set up the one-to-many relationship with the book_user table.
     */
    public function book_users()
    {
        return $this->hasMany('BookUser');
    }//end book_users()

    /**
     * Set up the many-to-many relationship with the authors table.
     */
    public function authors()
    {
        return $this->belongsToMany('Author');
    }//end authors()

    /**
     * Set up the many-to-many relationship with the users table.
     */
    public function users()
    {
        return $this->belongsToMany('User');
    }//end authors()
}//end class Book

//end file Book.php
