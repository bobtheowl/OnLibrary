@extends('loggedin')

@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading" id="search-criteria">
            <i class="fa fa-search"></i> Search Criteria
          </div>{{-- /.panel-heading --}}
          <div class="panel-body">
            <input type="hidden"
                   id="search-quick-query"
                   value="{{{ (Input::has('query-all')) ? Input::get('query-all') : '' }}}"
            />
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="search-title">Title</label>
                  <input type="text"
                         class="form-control"
                         id="search-title"
                         name="search-title"
                         value="{{{ (Input::has('title')) ? Input::get('title') : '' }}}"
                  />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="search-subtitle">Subtitle</label>
                  <input type="text"
                         class="form-control"
                         id="search-subtitle"
                         name="search-subtitle"
                         value="{{{ (Input::has('subtitle')) ? Input::get('subtitle') : '' }}}"
                  />
                </div>{{-- /.form-group --}}
              </div>{{-- /.col-md-4 --}}
              <div class="col-md-4">
                <div class="form-group">
                  <label for="search-author">Author</label>
                  <input type="text"
                         class="form-control"
                         id="search-author"
                         name="search-author"
                         value="{{{ (Input::has('author')) ? Input::get('author') : '' }}}"
                  />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="search-series">Series</label>
                  <input type="text"
                         class="form-control"
                         id="search-series"
                         name="search-series"
                         value="{{{ (Input::has('series')) ? Input::get('series') : '' }}}"
                  />
                </div>{{-- /.form-group --}}
              </div>{{-- /.col-md-4 --}}
              <div class="col-md-4">
                <div class="form-group">
                  <label for="search-publisher">Publisher</label>
                  <input type="text"
                         class="form-control"
                         id="search-publisher"
                         name="search-publisher"
                         value="{{{ (Input::has('publisher')) ? Input::get('publisher') : '' }}}"
                  />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="search-isbn">ISBN</label>
                  <input type="tel"
                         class="form-control"
                         id="search-isbn"
                         name="search-isbn"
                         value="{{{ (Input::has('isbn')) ? Input::get('isbn') : ''}}}"
                  />
                </div>{{-- /.form-group --}}
              </div>{{-- /.col-md-4 --}}
            </div>{{-- /.row --}}
          </div>{{-- /.panel-body --}}
          <div class="panel-footer clearfix">
            <div class="btn-group pull-left">
              {{-- These buttons disabled until database can support this functionality --}}
              <button class="btn btn-default disabled" type="button" id="search-load-btn" disabled>
                <i class="fa fa-folder-open-o"></i>
              </button>
              <button class="btn btn-default disabled" type="button" id="search-save-btn" disabled>
                <i class="fa fa-floppy-o"></i>
              </button>
            </div>{{-- /.btn-group.pull-left --}}
            <button class="btn btn-primary pull-right" type="button" id="search-run-btn">
              <i class="fa fa-search"></i> Run Search
            </button>
            <button class="btn btn-primary hidden disabled pull-right" type="button" id="search-running-btn" disabled>
              <i class="fa fa-spinner fa-spin"></i> Running...
            </button>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </div>{{-- /.col-md-12 --}}
    </div>{{-- /.row --}}
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <i class="fa fa-search"></i> Search Results
          </div>{{-- /.panel-heading --}}
          <div class="panel-body">
            <div class="row" id="search-results">{{-- Search results added here --}}</div>
          </div>{{-- /.panel-body --}}
          <div class="panel-footer clearfix">
            <span id="results-count">0</span> Result(s)
            <a href="#search-criteria" class="btn btn-default btn-xs pull-right">
              <i class="fa fa-angle-up"></i> Return to Top
            </a>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </div>{{-- /.col-md-12 --}}
    </div>{{-- /.row --}}
@stop

@section('modals')
    <script type="text/x-template" id="search-result-template">
      <div class="col-xs-12 col-sm-6 col-md-4 results-container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>{$title}</strong>
          </div>{{-- /.panel-heading --}}
          <table class="table table-striped">
            <thead>
              <tr>
                <th>By</th>
                <td>{$author}</td>
              </tr>
            </thead>
            <tbody class="hidden">
              <tr>
                <th>Subtitle</th>
                <td>{$subtitle}</td>
              </tr>
              <tr>
                <th>Series</th>
                <td>{$series}</td>
              </tr>
              <tr>
                <th>Publisher</th>
                <td>{$publisher}</td>
              </tr>
              <tr>
                <th>ISBN</th>
                <td>{$isbn}</td>
              </tr>
            </tbody>
          </table>{{-- /.table.table-striped --}}
          <div class="panel-footer text-right">
            <button class="btn btn-default btn-xs results-details-btn" type="button">
              <i class="fa fa-plus"></i> Details
            </button>
          </div>{{-- /.panel-footer --}}
        </div>{{-- /.panel-panel-default --}}
      </div>{{-- /.col-xs-12.col-sm-6.col-md-4 --}}
    </script>
@stop

@section('js-include')
	<script src="{{ URL::asset('js/search.js') }}"></script>
@stop

@section('onload')
    $('#onlibrary-nav-search').addClass('active');
	search.init();
@stop
