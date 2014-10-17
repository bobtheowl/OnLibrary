/*global onlibrary, jQuery*/
'use strict';

var lookup = (function ($) {
    var $input = $('#add-isbn-lookup'),
        $service = $('#add-lookup-service'),
        $lookupBtn = $('#btn-run-lookup'),
        $title = $('#add-title'),
        $subtitle = $('#add-subtitle'),
        $author = $('#add-author'),
        $series = $('#add-series'),
        $publisher = $('#add-publisher'),
        $isbn = $('#add-isbn');

    function doLookup() {
        var url = siteUrl + 'book/search/' + $service.val(),
            data = {'query': $input.val()};
        // TRIGGER SOME LOADING MECHANISM HERE
        $.ajax({'url': url, 'data': data, 'type': 'GET', 'dataType': 'json'})
            .done(function (data) {
                $title.val(data.title);
                $subtitle.val(data.subtitle);
                $author.val(data.authors.join(';'));
                $series.val(data.series);
                $publisher.val(data.publisher);
                $isbn.val(data.isbn);
            })
            .fail(onLibrary.handleAjaxError)
            .always(function () {
                // CLEAR LOADING MECHANISM HERE
            });
    }//end doLookup()

    return {
        'init': function () {
            $lookupBtn.off('click.lookup');
            $lookupBtn.on('click.lookup', doLookup);
        }//end lookup.init()
    };
})(jQuery);//end lookup

//end file lookup.js
