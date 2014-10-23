OnLibrary Book Manager
======================

This application will allow a person to keep a directory of books. This will allow them to check to make sure they
don't already have a book that they are thinking about purchasing.

Completed features
------------------

 *  **User Authentication**<br />
    Users are able to register and log in. This includes "Remember Me" functionality, but does not yet
    include password resetting.
 *  **Multiple users**<br />
    A single instance of the application will be able to store data for multiple users. The first version utilizes
    a simple registration and login mechanism. Users are currently only be able to search/add to their own library,
    and currently cannot remove books from their library.
 *  **Adding books to the directory**<br />
    This allows the user to enter an ISBN, which hits a Google API and auto-populates the remaining fields. The
    user may also manually enter all the data.
 *  **Searching the directory**<br />
    Users can search by any of the fields used to enter data.

Features in development
-----------------------

 *  **Saving searches**<br />
    The user can save search criteria to more easily run searches later.
 *  **Viewing previous searches**<br />
    The dashboard will contain a section listing recent searches. The user will be able to click on a recent search
    and re-run that search.
 *  **Viewing popular searches**<br />
    The dashboard will contain a section listing popular searches. The user will be able to click on a popular search
    and re-run that search.
 *  **Account management**<br />
    The user will be able to go in and delete books which have been entered, as well as update their profile.
 *  **User levels**<br />
    A super-user will be able to modify the master directory of books.
 *  **Multiple lookup APIs**<br />
    Users will eventually have more choices to lookup data when entering a book. The site is already set up to allow
    for more APIs. I simply need to find more usable APIs and setup implementations of the lookup interface.

Long-term goals
---------------

 *  Support multiple types of media, not just books, eventually storing anything from music, movies, to video games.
 *  Share your library with other users. This would allow other users to view what you have and comment on your
    collection or make recommendations.
 *  Rate and review items stored in your library. These would be public to anyone searching for that item.
 *  Have the site make recommendations for you based on various factors (genre, author, publisher, etc.).
