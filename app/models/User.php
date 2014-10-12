<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    
    /**
     * Sets up the validation and logging.
     *
     * @retval null
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(App::make('OnLibrary/Validator/Laravel/UserObserver'));
    }//end boot()
    
    /**
     * Set up the one-to-many relationship with the book_user table.
     */
    public function book_users()
    {
        return $this->hasMany('BookUser');
    }//end book_users()

    /**
     * Set up the many-to-many relationship with the books table.
     */
    public function books()
    {
        return $this->belongsToMany('Book');
    }//end books()
}//end class User

//end file User.php
