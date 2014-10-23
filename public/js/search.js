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
        $count = $('#results-count'),
        $template = $('#search-result-template');

    /**
     * Returns true if one of the fields listed in the $fields object contains data.
     *
     * @retval boolean True if one of the fields contains data
     */
    function formHasData() {
        var field;
        for (field in $fields) {
            if ($fields.hasOwnProperty(field) && $fields[field].val() !== '') {
                return true;
            }//end if
        }//end for
        return false;
    }//end formHasData()

    /**
     * Clears all results from the results container.
     *
     * @retval undefined
     */
    function clearResults() {
        $results.children().remove();
    }//end clearResults()

    /**
     * Generates a search result element and adds it to the results container.
     *
     * @param object data Object containing book data
     * @retval undefined
     */
    function addSearchResult(data) {
        var html = $template.html(),
            authors = [],
            i = 0,
            length = data.authors.length,
            author;

        for (i; i < data.authors.length; i++) {
            authors.push(data.authors[i].name);
        }//end for

        html = html.replace('{$title}', data.title)
            .replace('{$author}', authors.join(', '))
            .replace('{$subtitle}', data.subtitle || '')
            .replace('{$series}', (data.series) ? data.series.name : '')
            .replace('{$publisher}', (data.publisher) ? data.publisher.name : '')
            .replace('{$isbn}', data.isbn || '');

        $results.append($(html));
    }//end addSearchResult()

    /**
     * Handles the click event for any of the details buttons on the search results.
     * If the details are hidden, they are shown. If they're currently shown, they
     * are hidden.
     *
     * The 'this' variable refers to the Details button being clicked.
     *
     * @retval undefined
     */
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

    /**
     * Clears any details click events currently set, and re-adds them.
     *
     * @retval undefined
     */
    function refreshDetailsEvents() {
        var $allDetailsBtns = $('.results-details-btn');
        $allDetailsBtns.off('click.search');
        $allDetailsBtns.on('click.search', handleDetailsClick);
    }//end refreshDetailsEvents()

    /**
     * Clears the current search results, and loops through the new search
     * results and adds the results as needed.
     *
     * @param array data Array of book data objects
     * @retval undefined
     */
    function handleSearchData(data) {
        var i = 0,
            length = data.length;
        
        clearResults();
        for (i; i < length; i++) {
            addSearchResult(data[i]);
        }//end for
        refreshDetailsEvents();
        $count.text(data.length);
    }//end handleSearchData()

    /**
     * Makes the AJAX call to retrieve book search data.
     *
     * @retval undefined
     */
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
            method = 'GET',
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
        /**
         * Adds the click event to the run button, and performs a search if the form
         * already contains data.
         */
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
