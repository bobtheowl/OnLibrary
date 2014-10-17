/*global onlibrary, jQuery, lookup*/
'use strict';

var add = (function ($) {
    var $resetBtn = $('#btn-reset'),
        $submitBtn = $('#btn-submit'),
        $title = $('#title'),
        $subtitle = $('#subtitle'),
        $authors = $('#authors'),
        $series = $('#series'),
        $publisher = $('#publisher'),
        $isbn = $('#isbn');

    function resetForm() {
        $title.val('');
        $subtitle.val('');
        $authors.val('');
        $series.val('');
        $publisher.val('');
        $isbn.val('');
    }//end resetForm()

    function generateNewDataObject()
    {
        return {
            'title': $title.val(),
            'subtitle': $subtitle.val(),
            'isbn': $isbn.val(),
            'authors': [],
            'series': null,
            'publisher': null
        };
    }//end generateNewDataObject()
    
    function getAuthorArray()
    {
        var authors = $authors.val().split(';'),
            i = 0,
            length = authors.length;
        
        for (i; i < length; i++) {
            authors[i] = authors[i].trim();
        }//end for
        
        return authors;
    }//end getAuthorArray()
    
    function getPublisherId(publisher) {
        var publisherId;
        $.ajax({
            'url': siteUrl + 'publisher',
            'data': {'publisher': publisher},
            'type': 'POST',
            'async': false,
            'success': function (id) {
                publisherId = id;
            },
            'error': onLibrary.handleAjaxError
        });
        return publisherId;
    }//end getPublisherId()
    
    function getSeriesId(series) {
        var seriesId;
        $.ajax({
            'url': siteUrl + 'series',
            'data': {'series': series},
            'type': 'POST',
            'async': false,
            'success': function (id) {
                seriesId = id;
            },
            'error': onLibrary.handleAjaxError
        });
        return seriesId;
    }//end getSeriesId()
    
    function getAuthorId(author) {
        var authorId;
        $.ajax({
            'url': siteUrl + 'author',
            'data': {'author': author},
            'type': 'POST',
            'async': false,
            'success': function (id) {
                authorId = id;
            },
            'error': onLibrary.handleAjaxError
        });
        return authorId;
    }//end getAuthorId()
    
    function submitForm() {
        // 1. Create/get publisher (if needed)
        // 2. Create/get series (if needed)
        // 3. Create/get authors
        // 4. Create book
        var url = siteUrl + 'book',
            data = generateNewDataObject(),
            publisher = $publisher.val(),
            series = $series.val(),
            authors = getAuthorArray(),
            i = 0;
        
        data.publisher = (publisher !== '') ? getPublisherId(publisher) : null;
        data.series = (series !== '') ? getSeriesId(series) : null;
        for (i; i < authors.length; i++) {
            data.authors.push(getAuthorId(authors[i]));
        }//end for
        
        $.ajax({'url': url, 'data': data, 'type': 'POST'})
            .done(function () {
                bootbox.alert('The book was added successfully!');
                resetForm();
            })
            .fail(onLibrary.handleAjaxError);
    }//end submitForm()

    return {
        'init': function () {
            $resetBtn.off('click.add');
            $resetBtn.on('click.add', resetForm);
            $submitBtn.off('click.add');
            $submitBtn.on('click.add', submitForm);
        }//end add.init()
    };
})(jQuery);//end add

//end file add.js
