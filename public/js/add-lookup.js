/*global onlibrary, jQuery*/
'use strict';

var lookup = (function ($) {
    var $input = $('#add-isbn-lookup'),
        $service = $('#add-lookup-service'),
        $lookupBtn = $('#btn-run-lookup'),
        $modal = $('#lookup-modal'),
        $title = $('#title'),
        $subtitle = $('#subtitle'),
        $authors = $('#authors'),
        $series = $('#series'),
        $publisher = $('#publisher'),
        $isbn = $('#isbn');

    function doLookup() {
        var url = siteUrl + 'book/search/' + $service.val(),
            data = {'query': $input.val()};
        $modal.modal('show');
        $.ajax({'url': url, 'data': data, 'type': 'GET', 'dataType': 'json'})
            .always(function () {
                $modal.modal('hide');
            })
            .done(function (data) {
                $title.val(data.title);
                $subtitle.val(data.subtitle);
                $authors.val(data.authors.join(';'));
                $series.val(data.series);
                $publisher.val(data.publisher);
                $isbn.val(data.isbn);
            })
            .fail(onLibrary.handleAjaxError);
    }//end doLookup()

    return {
        'init': function () {
            $lookupBtn.off('click.lookup');
            $lookupBtn.on('click.lookup', doLookup);
            $modal.modal({
                'keyboard': false,
                'show': false
            });
        }//end lookup.init()
    };
})(jQuery);//end lookup

//end file lookup.js
