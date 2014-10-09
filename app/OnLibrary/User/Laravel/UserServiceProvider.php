<?php
namespace OnLibrary\User\Laravel;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Binds the Laravel user driver to the OnLibrary user interface in the Laravel IOC container.
     *
     * @retval null
     */
    public function register()
    {
        $this->app->bind(
            'OnLibrary\User\CurrentUser',
            'OnLibrary\User\Laravel\CurrentUser'
        );
    }//end register()
}//end class UserServiceProvider

//end file UserServiceProvider.php
