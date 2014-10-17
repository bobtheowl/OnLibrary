/*global onlibrary, jQuery, lookup*/
'use strict';

var add = (function ($) {
    var $resetBtn = $('#btn-reset'),
        $submitBtn = $('#btn-submit'),
        $modal = $('#saving-modal'),
        $stepPublisher = $('#saving-modal-publisher-step'),
        $stepSeries = $('#saving-modal-series-step'),
        $stepAuthors = $('#saving-modal-authors-step'),
        $stepBook = $('#saving-modal-book-step'),
        $modalPlaceholderBtn = $('#saving-modal-placeholder-btn'),
        $modalDoneBtn = $('#saving-modal-ok-btn'),
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

    function resetModal() {
        var defaultIcon = 'fa-ellipsis-h',
            defaultTextClass = 'text-muted';
        // Reset step icons
        $stepPublisher.find('i').removeClass().addClass('fa').addClass(defaultIcon);
        $stepSeries.find('i').removeClass().addClass('fa').addClass(defaultIcon);
        $stepAuthors.find('i').removeClass().addClass('fa').addClass(defaultIcon);
        $stepBook.find('i').removeClass().addClass('fa').addClass(defaultIcon);
        // Reset step colors
        $stepPublisher.removeClass().addClass(defaultTextClass);
        $stepSeries.removeClass().addClass(defaultTextClass);
        $stepAuthors.removeClass().addClass(defaultTextClass);
        $stepBook.removeClass().addClass(defaultTextClass);
        // Reset modal buttons
        $modalPlaceholderBtn.removeClass('hidden');
        $modalDoneBtn.addClass('hidden');
    }//end resetModal()

    function setStepInProgress($step) {
        $step.find('i').removeClass().addClass('fa').addClass('fa-spin').addClass('fa-spinner');
        $step.removeClass().addClass('text-warning');
    }//end setStepInProgress()

    function setStepComplete($step) {
        $step.find('i').removeClass().addClass('fa').addClass('fa-check');
        $step.removeClass().addClass('text-success');
    }//end setStepComplete()

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
        var url = siteUrl + 'book',
            data = generateNewDataObject(),
            publisher = $publisher.val(),
            series = $series.val(),
            authors = getAuthorArray(),
            i = 0;
        
        $modal.modal('show');
        // Get/create publisher
        setStepInProgress($stepPublisher);
        data.publisher = (publisher !== '') ? getPublisherId(publisher) : null;
        setStepComplete($stepPublisher);
        // Get/create series
        setStepInProgress($stepSeries);
        data.series = (series !== '') ? getSeriesId(series) : null;
        setStepComplete($stepSeries);
        // Get/create author(s)
        setStepInProgress($stepAuthors);
        for (i; i < authors.length; i++) {
            data.authors.push(getAuthorId(authors[i]));
        }//end for
        setStepComplete($stepAuthors);
        // Add book
        setStepInProgress($stepBook);
        $.ajax({'url': url, 'data': data, 'type': 'POST'})
            .done(function () {
                setStepComplete($stepBook);
                $modalPlaceholderBtn.addClass('hidden');
                $modalDoneBtn.removeClass('hidden');
                resetForm();
            })
            .fail(function (jqXHR, status, error) {
                $modal.modal('hide');
                onLibrary.handleAjaxError(jqXHR, status, error);
            });
    }//end submitForm()

    return {
        'init': function () {
            $resetBtn.off('click.add');
            $resetBtn.on('click.add', resetForm);
            $submitBtn.off('click.add');
            $submitBtn.on('click.add', submitForm);
            $modal.modal({
                'keyboard': false,
                'show': false
            });
            $modal.off('hidden.bs.modal');
            $modal.on('hidden.bs.modal', resetModal);
        }//end add.init()
    };
})(jQuery);//end add

//end file add.js
