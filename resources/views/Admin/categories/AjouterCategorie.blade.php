@extends('admin.layout')
@section('main')
<div class="w-100 bg-white w-100 bg-white mb-1 border">
    <div class="btn-group p-1" role="group">
      <a class="btn btn-default m-1" href="/admin/"><i class="fa fa-home"></i></a>
      <a class="btn btn-default  m-1" href="{{ route('liste_categorie') }}">Catégories</a>
      <a class="btn btn-default disable m-1" href="{{ route('ajouter_categorie') }}">Ajouter</a>
    </div>
</div>

<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Ajouter Categorie</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form"method="POST" action="{{ route('new_categorie') }}">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="addcat">Label category</label>
          <input type="text" name='nom' class="form-control" id="addcat" placeholder="Enter categ">
        </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </form>
  </div>
  <!-- /.card -->

@endsection