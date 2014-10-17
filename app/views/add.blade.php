@extends('loggedin')

@section('content')
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <i class="fa fa-plus"></i> <strong>Add New Book</strong>
          </div>{{-- /.panel-heading --}}
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="add-isbn-lookup">Look up by ISBN</label>
                  <div class="input-group">
                    <input type="tel" class="form-control" id="add-isbn-lookup" />
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" id="btn-run-lookup">
                        <i class="fa fa-search"></i> Look up
                      </button>
                    </span>
                  </div>{{-- /.input-group --}}
                  <span class="help-block">
                    <i class="fa fa-info-circle"></i> Enter only the numbers for the ISBN.
                  </span>
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-lookup-service">Look up using service</label>
                  <select id="add-lookup-service" class="form-control">
                    <option value="googlebooks">Google Books API</option>
                  </select>
                </div>{{-- /.form-group --}}
                <hr />
              </div>{{-- /.col-md-6 --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="subtitle">Sub-title</label>
                  <input type="text" class="form-control" id="subtitle" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="author">Author(s)</label>
                  <input type="text" class="form-control" id="author" />
                  <span class="help-block">
                    <i class="fa fa-info-circle"></i> Separate multiple authors using a semi-colon.
                  </span>
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="series">Series</label>
                  <input type="text" class="form-control" id="series" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" class="form-control" id="publisher" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="tel" class="form-control" id="isbn" />
                  <span class="help-block">
                    <i class="fa fa-info-circle"></i> Enter only the numbers for the ISBN.
                  </span>
                </div>{{-- /.form-group --}}
              </div>{{-- /.col-md-6 --}}
            </div>{{-- /.row --}}
          </div>{{-- /.panel-body --}}
          <div class="panel-footer clearfix">
            <button class="btn btn-default pull-left" type="button" id="btn-reset">
              <i class="fa fa-refresh"></i> Reset
            </button>
            <button class="btn btn-primary pull-right" type="button" id="btn-submit">
              <i class="fa fa-plus"></i> Add Book
            </button>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </div>{{-- /.col-md-6.col-offset-3 --}}
    </div>{{-- /.row --}}
@stop

@section('js-include')
	<script src="{{ URL::asset('js/add-lookup.js') }}"></script>
	<script src="{{ URL::asset('js/add.js') }}"></script>
@stop

@section('onload')
    $('#onlibrary-nav-add').addClass('active');
	lookup.init();
	add.init();
@stop
