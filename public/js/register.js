/*global jQuery, onLibrary, siteUrl*/
'use strict';

/**
 * Module containing JavaScript functionality for the user registration page.
 */
var register = (function ($) {
    /**
     * Submits the registration form.
     */
    function submitForm () {
        var url = siteUrl + 'user',
            data = {
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
                'username': $('#username').val(),
                'email': $('#email').val(),
                'password': $('#password').val()
            };
        $('.form-group').removeClass('has-error');
        $('.help-block').addClass('hidden');
 
        if (data.password !== $('#password-repeat').val()) {
            onLibrary.handleAjaxError({
                'responseJSON': {
                    'password-repeat': 'The password entered here must match the password entered above.'
                }
            });
        }//end if

        $('#register-submit').prop('disabled', true)
            .addClass('disabled')
            .html('<i class="fa fa-clock-o"></i> Creating...');
        $.ajax({'url': url, 'data': data, 'type': 'POST'})
            .done(function () {
/*DEV*/         alert('SUCCESS');
            })
            .fail(onLibrary.handleAjaxError)
            .always(function () {
                $('#register-submit').prop('disabled', false)
                    .removeClass('disabled')
                    .html('<i class="fa fa-pencil-square-o"></i> Create Account');
            });
    }//end submitForm

    return {
        /**
         * Sets up click event for submit button.
         */
        'init': function () {
            $('#register-submit').on('click.register', submitForm);
        }//end register.init()
    };
}(jQuery));

//end file register.js
