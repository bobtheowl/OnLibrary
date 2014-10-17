<?php
namespace OnLibrary\Database\Eloquent;

use OnLibrary\Database\BookUserRepository as RepoInterface;
use OnLibrary\Exception\NonFatalAjaxException;

class BookUserRepository implements RepoInterface
{
    /**
     * Creates a row connecting a book to a user.
     *
     * @param integer $bookId ID of book to link
     * @param integer $userId ID of user to link
     * @throws OnLibrary::Exception::NonFatalAjaxException Book and user couldn't be linked
     */
    public function linkBookAndUser($bookId, $userId)
    {
        $row = BookUser::firstOrCreate([
            'book_id' => (int)$bookId,
            'user_id' => (int)$userId
        ]);
        if (empty($row->id)) {
            throw new NonFatalAjaxException(self::LINK_ERROR);
        }//end if
        return $row->id;
    }//end linkBookAndUser()

    /**
     * Removes a row connecting a book to a user.
     *
     * @param integer $bookId ID of book to unlink
     * @param integer $userId ID of user to unlink
     * @throws OnLibrary::Exception::NonFatalAjaxException Book and user couldn't be unlinked
     */
    public function unlinkBookAndUser($bookId, $userId)
    {
        $rows = BookUser::where('book_id', '=', (int)$bookId)
            ->where('user_id', '=', (int)$userId)
            ->get();
        foreach ($rows as $row) {
            if ($row->delete() === false) {
                throw new NonFatalAjaxException(self::UNLINK_ERROR);
            }//end if
        }//end foreach
    }//end unlinkBookAndUser()
}//end class BookUserRepository

//end file BookUserRepository.php
