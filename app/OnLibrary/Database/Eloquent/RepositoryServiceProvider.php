<?php
namespace OnLibrary\Database\Eloquent;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Binds the Eloquent database drivers to the OnLibrary database interfaces
     * in the Laravel IOC container.
     *
     * @retval null
     */
    public function register()
    {
        $this->app->bind(
            'OnLibrary\Database\AuthorBookRepository',
            'OnLibrary\Database\Eloquent\AuthorBookRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\AuthorRepository',
            'OnLibrary\Database\Eloquent\AuthorRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\BookRepository',
            'OnLibrary\Database\Eloquent\BookRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\BookUserRepository',
            'OnLibrary\Database\Eloquent\BookUserRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\PublisherRepository',
            'OnLibrary\Database\Eloquent\PublisherRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\SeriesRepository',
            'OnLibrary\Database\Eloquent\SeriesRepository'
        );
        $this->app->bind(
            'OnLibrary\Database\UserRepository',
            'OnLibrary\Database\Eloquent\UserRepository'
        );
    }//end register()
}//end class RepositoryServiceProvider

//end file RepositoryServiceProvider.php
