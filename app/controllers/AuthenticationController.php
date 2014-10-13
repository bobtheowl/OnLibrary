<?php

class AuthenticationController extends \BaseController
{
    /** Message displayed if authentication failed */
    const BAD_AUTH_ERROR = 'The username or password entered is invalid.';

    /** Message displayed if the required input wasn't sent */
    const BAD_INPUT_ERROR = 'You must input a username and password.';

    /**
     * Attempts to authenticate the user.
     *
     * @retval Redirect
     */
    public function authenticate()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $remember = Input::get('remember');

        if (empty($username) || empty($password)) {
            return Redirect::to('login')
                ->with('auth-error', self::BAD_INPUT_ERROR)
                ->with('auth-username', (!empty($username)) ? $username : '');
        }//end if

        $success = (!empty($remember))
            ? Auth::attempt(['username' => $username, 'password' => $password], true)
            : Auth::attempt(['username' => $username, 'password' => $password]);

        if ($success === false) {
            return Redirect::to('login')
                ->with('auth-error', self::BAD_AUTH_ERROR)
                ->with('auth-username', $username);
        }//end if

        return Redirect::intended('/');
    }//end authenticate()

    /**
     * Logs the user out and destroys their session.
     *
     * @retval Redirect
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        Session::regenerate();

        return Redirect::to('login');
    }//end logout()
}//end class AuthenticationController

//end file AuthenticationController.php

