@extends('admin.layout')
@section('main')
<div class="w-100 bg-white w-100 bg-white mb-1 border">
    <div class="btn-group p-1" role="group">
        <a class="btn btn-default m-1" href="/admin/"><i class="fa fa-home"></i></a>
        <a class="btn btn-default  m-1" href="{{ route('liste_categorie') }}">Catégories</a>
        <a class="btn btn-default  m-1" href="{{ route('ajouter_categorie') }}">Ajouter</a>
    </div>
</div>
<div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h5>List sous categorie de :
        <strong style="color: black">
            {{ $category_name->nom }}
        </strong>   
        </h5>
    </div>
    @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

    <div class="widget-content nopadding">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom sous categorie</th>               
            </tr>
            </thead>
            <tbody>
               
              @foreach ($souscate as $a)
                    <tr class="gradeC">
                        <td>{{$a->nom}}</td>
                         
                        <td style="text-align: center;">
                            {{-- for edit --}}
                        
                                <span  data-toggle="modal" data-target="#editModal{{ $a->id }}">
                                <i class="fas fa-pen-square"></i>
                            </span>
                           
                              
                              <!-- Modal -->
                              <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Modifier sous categorie</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ route('update_souscate',$a) }}">
                                            @csrf
                                            @method('PUT')
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                          <label for="newname">nouveau nom :</label>
                                          <br>
                                          <input  class="form-control"   type="text" name='nom'>
                                       
                                     
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            {{-- for delete --}}
                            <span   data-toggle="modal" data-target="#exampleModal{{ $a->id }}"><i class='fas fa-trash-alt' style='color:red'></i></span>
                        </td>
                        <td>
                            
                           
                               
                               
                                  <!-- Modal -->
                                  {{-- Modal id should be unique --}}
                        <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprission du Sous Categorie</h5>
                                <form  class="form-inline" method="POST" action="{{route('souscategory.delete',$a->id)}}">
                                    @csrf
                                    @method('DELETE')
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous supprimer:
                                    <Strong style="color: black">
                                        {{$a->nom}}
                                    </Strong> 
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button  class="btn btn-primary" type="submit">Confirmer</button>
                            </form>
                                </div>
                            </div>
                            </div>
                        </div>
                   
                        </td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row justify-content-center mb-4">
            {{-- {{ $cat->appends(request()->input())->links()}} --}}
        </div>
    </div>

</div>
</div>


@endsection