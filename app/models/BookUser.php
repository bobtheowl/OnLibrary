<?php

class BookUser extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_user';

    /**
     * The attributes which are not mass-assignable.
     *
     * @var array
     */
    protected $guarded = array('id', 'created_at', 'updated_at');
}//end class BookUser

//end file BookUser.php
