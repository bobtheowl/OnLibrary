<?php
namespace OnLibrary\Exception;

use \Exception;

/**
 * Exception thrown when there is an internal issue. The message in this
 * exception should not be output to the user.
 */
class InternalException extends Exception
{
}//end class InternalException

/**
 * Exception thrown to indicate that an error occurred which prevented
 * the database from being updated. This should be used to prevent any
 * forms from being closed.
 *
 * The exception message should be able to be output to the user.
 */
class FatalAjaxException extends Exception
{
}//end class FatalAjaxException

/**
 * Exception thrown to indicate that an error occurred, but the database
 * was still updated. This should allow the submitted form to be closed,
 * but still display an alert to the user.
 */
class NonFatalAjaxException extends Exception
{
}//end class NonFatalAjaxException

//end file AjaxExceptions.php
