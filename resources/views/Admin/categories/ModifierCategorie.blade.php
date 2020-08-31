@extends('admin.layout')
@section('main')
           <!-- general form elements -->
           <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Modifier Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form"method="POST" action="{{route('updatecate',$edit_category->id)}}">
                @method('PUT')
                {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label for="addcat">Label category</label>
                  <input type="text" name='nom' class="form-control" id="addcat" value="{{$edit_category->nom}}" placeholder="Enter categ">
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Modifier</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
@endsection
