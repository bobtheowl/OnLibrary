/*global jQuery, siteUrl*/
'use strict';

/**
 * Main module containing JavaScript functionality which is used site-wide.
 */
var onLibrary = (function ($) {
    /**
     * Reads errors from the JSON object and displays validation errors.
     *
     * @param object json Object containing validation errors.
     * @retval undefined
     */
    function parseValidationErrors(json) {
        var $elem, $formGroup, $error, inputId;
        $('.form-group').removeClass('has-error');
        $('.help-block').addClass('hidden');
        for (inputId in json) {
            if (json.hasOwnProperty(inputId)) {
                $elem = $('#' + inputId);
                $formGroup = $elem.parents('.form-group');
                $error = $('.help-block', $formGroup);

                $formGroup.addClass('has-error');
                $error.text(json[inputId].join('<br />'));
                $error.removeClass('hidden');
            }//end if
        }//end for
    }//end parseValidationErrors()

    return {
        /**
         * Checks the jqXHR object to determine how the error needs to be handled.
         *
         * @param jqXHR jqXHR jQuery AJAX object which returned an error
         * @retval undefined
         */
        'handleAjaxError': function (jqXHR) {
            var json;
            try {
                json = JSON.parse(jqXHR.responseText);
                parseValidationErrors(json);
            } catch(e) {
/*DEV*/         alert('other error: ' + jqXHR.responseText);
            }
        }//end onLibrary.handleAjaxError()
    };
}(jQuery));

//end file register.js
