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
                      <button class="btn btn-default" type="button">
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
                    <option value="google-books-api">Google Books API</option>
                  </select>
                </div>{{-- /.form-group --}}
                <hr />
              </div>{{-- /.col-md-6 --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="add-title">Title</label>
                  <input type="text" class="form-control" id="add-title" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-subtitle">Sub-title</label>
                  <input type="text" class="form-control" id="add-subtitle" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-author">Author(s)</label>
                  <input type="text" class="form-control" id="add-author" />
                  <span class="help-block">
                    <i class="fa fa-info-circle"></i> Separate multiple authors using a semi-colon.
                  </span>
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-series">Series</label>
                  <input type="text" class="form-control" id="add-series" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-publisher">Publisher</label>
                  <input type="text" class="form-control" id="add-publisher" />
                </div>{{-- /.form-group --}}
                <div class="form-group">
                  <label for="add-isbn">ISBN</label>
                  <input type="tel" class="form-control" id="add-isbn" />
                  <span class="help-block">
                    <i class="fa fa-info-circle"></i> Enter only the numbers for the ISBN.
                  </span>
                </div>{{-- /.form-group --}}
              </div>{{-- /.col-md-6 --}}
            </div>{{-- /.row --}}
          </div>{{-- /.panel-body --}}
          <div class="panel-footer clearfix">
            <button class="btn btn-default pull-left" type="button">
              <i class="fa fa-refresh"></i> Reset
            </button>
            <button class="btn btn-primary pull-right" type="button">
              <i class="fa fa-plus"></i> Add Book
            </button>
          </div>{{-- /.panel-footer.clearfix --}}
        </div>{{-- /.panel.panel-primary --}}
      </div>{{-- /.col-md-6.col-offset-3 --}}
    </div>{{-- /.row --}}
@stop

@section('onload')
    $('#onlibrary-nav-add').addClass('active');
@stop
