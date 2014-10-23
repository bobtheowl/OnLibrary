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
        self::observe(App::make('OnLibrary\Validator\Laravel\BookObserver'));
    }//end boot()

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

    /**
     * Only returns books linked to a specific user.
     *
     * @param Eloquent $query Current SQL query
     * @param integer $userId ID of user to return books for
     * @retval Eloquent Updated SQL query
     */
    public function scopeForUser($query, $userId)
    {
        return $query->whereHas('users', function ($q) use ($userId) {
            $q->where('users.id', '=', (int)$userId);
        });
    }//end scopeForUser()

    /**
     * Only returns books linked to authors with a name like the name given.
     * Search is case-insensitive.
     *
     * @param Eloquent $query Current SQL query
     * @param string $author Author name to search for
     * @retval Eloquent Updated SQL query
     */
    public function scopeSearchAuthor($query, $author)
    {
        return $query->whereHas('authors', function ($q) use ($author) {
            $author = strtolower($author);
            $q->whereRaw('lower(authors.name) like ?', ['%' . implode('%', explode(' ', $author))]);
        });
    }//end scopeSearchAuthor()

    /**
     * Only returns books linked to a series with a name like the name given.
     * Search is case-insensitive.
     *
     * @param Eloquent $query Current SQL query
     * @param string $series Name of series to search for
     * @retval Eloquent Updated SQL query
     */
    public function scopeSearchSeries($query, $series)
    {
        return $query->whereHas('series', function ($q) use ($series) {
            $series = strtolower($series);
            $q->whereRaw('lower(series.name) like ?', ['%' . implode('%', explode(' ', $series))]);
        });
    }//end scopeSearchSeries()

    /**
     * Only returns books linked to a publisher with a name like the name given.
     * Search is case-insensitive.
     *
     * @param Eloquent $query Current SQL query
     * @param string $publisher Name of publisher to search for
     * @retval Eloquent Updated SQL query
     */
    public function scopeSearchPublisher($query, $publisher)
    {
        return $query->whereHas('publisher', function ($q) use ($publisher) {
            $publisher = strtolower($publisher);
            $q->whereRaw('lower(publishers.name) like ?', ['%' . implode('%', explode(' ', $publisher))]);
        });
    }//end scopeSearchPublisher()

    /**
     * Only returns books with either a title, subtitle, or author similar to
     * the search term given. Search is case-insensitive.
     *
     * @param Eloquent $query Current SQL query
     * @param string $search Search term
     * @retval Eloquent Updated SQL query
     */
    public function scopeQuickSearch($query, $search)
    {
        $search = '%' . implode('%', explode(' ', strtolower($search))) . '%';
        return $query->where(function ($bookQuery) use ($search) {
            $bookQuery->orWhereRaw('lower(books.title) like ?', [$search]);
            $bookQuery->orWhereRaw('lower(books.subtitle) like ?', [$search]);
            $bookQuery->orWhereHas('authors', function ($authorQuery) use ($search) {
                $authorQuery->whereRaw('lower(authors.name) like ?', [$search]);
            });
        });
    }//end scopeQuickSearch()
}//end class Book

//end file Book.php
