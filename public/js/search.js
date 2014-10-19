/*global jQuery, onLibrary, siteUrl*/
'use strict';

/**
 * Module containing JavaScript functionality for the user registration page.
 */
var search = (function ($) {
    var $fields = {
            'quick': $('#search-quick-query'),
            'title': $('#search-title'),
            'subtitle': $('#search-subtitle'),
            'author': $('#search-author'),
            'series': $('#search-series'),
            'publisher': $('#search-publisher'),
            'isbn': $('#search-isbn')
        },
        $loadBtn = $('#search-load-btn'),
        $saveBtn = $('#search-save-btn'),
        $runBtn = $('#search-run-btn'),
        $searchingBtn = $('#search-running-btn'),
        $results = $('#search-results'),
        $template = $('#search-result-template');

    function formHasData() {
        var field;
        for (field in $fields) {
            if ($fields.hasOwnProperty(field) && $fields[field].val() !== '') {
                return true;
            }//end if
        }//end for
        return false;
    }//end formHasData()

    function clearResults() {
        $results.children().remove();
    }//end clearResults()

    function addSearchResult(data) {
        var html = $template.html(),
            authors = [],
            i = 0,
            length = data.authors.length,
            author;

        for (i; i < data.authors.length; i++) {
            authors.push(data.authors[i].name);
        }//end for

        html.replace('{$title}', data.title);
        html.replace('{$author}', authors.join(', '));
        html.replace('{$subtitle}', data.subtitle || '');
        html.replace('{$series}', (data.series) ? data.series.name : '');
        html.replace('{$publisher}', (data.publisher) ? data.publisher.name : '');
        html.replace('{$isbn}', data.isbn || '');

        $results.append($(html));
    }//end addSearchResult()

    function handleDetailsClick() {
        var $this = $(this),
            $icon = $this.find('i'),
            $container = $this.parents('.results-container'),
            $tbody = $container.find('tbody');
        if ($tbody.hasClass('hidden')) {
            $tbody.removeClass('hidden');
            $icon.removeClass('fa-plus').addClass('fa-minus');
        } else {
            $tbody.addClass('hidden');
            $icon.removeClass('fa-minus').addClass('fa-plus');
        }//end if/else
    }//end handleDetailsClick()

    function refreshDetailsEvents() {
        var $allDetailsBtns = $('.results-details-btn');
        $allDetailsBtns.on('click.search', handleDetailsClick);
    }//end refreshDetailsEvents()

    function handleSearchData(data) {
        var i = 0,
            length = data.length;
        
        clearResults();
        for (i; i < length; i++) {
            addSearchResult(data[i]);
        }//end for
        refreshDetailsEvents();
    }//end handleSearchData()

    function performSearch() {
        var url = siteUrl + 'book',
            data = {
                'quick': $fields.quick.val(),
                'title': $fields.title.val(),
                'subtitle': $fields.subtitle.val(),
                'author': $fields.author.val(),
                'series': $fields.series.val(),
                'publisher': $fields.publisher.val(),
                'isbn': $fields.isbn.val(),
            },
            method = 'GET'
            returning = 'json';

        $runBtn.addClass('hidden');
        $searchingBtn.removeClass('hidden');
        $.ajax({'url': url, 'data': data, 'type': method, 'dataType': returning})
            .always(function () {
                $searchingBtn.addClass('hidden');
                $runBtn.removeClass('hidden');
            })
            .done(handleSearchData)
            .fail(onLibrary.handleAjaxError);
    }//end performSearch()

    return {
        'init': function () {
            $runBtn.off('click.search');
            $runBtn.on('click.search', performSearch);
            if (formHasData()) {
                performSearch();
            }//end if
        }//end search.init()
    };
}(jQuery));

//end file search.js
