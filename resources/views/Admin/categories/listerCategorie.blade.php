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
        <h5>List Categories</h5>
    </div>
     <x:notify-messages />
      @notifyJs
    @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

    <div class="widget-content nopadding">
        <table class="table table-striped">
            <thead>
            <tr>
                
                <th>Nom Category</th>
                <th>Sous_categories</th>
               
            </tr>
            </thead>
            <tbody>
                 {{-- Modal id should be unique --}}
              @foreach ($categories as $a)
                    <tr class="gradeC">
                         
                        <td>{{$a->nom}}</td>
                        <td> <a href="{{ route('liste_Sous_categorie',$a->id) }}"> {{count($a->sous_categories )}}</a></td>
                        
                        <td style="text-align: center;">
                            <a href="{{route('category.edit',$a->id)}}"> <span>
                                <i class="fas fa-pen-square"></i>
                            </span></a>
                            <span   data-toggle="modal" data-target="#exampleModal{{ $a->id }}"><i class='fas fa-trash-alt' style='color:red'></i></span>
                        </td>
                        <td>
                                                    <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                   
                                <h5 class="modal-title" id="exampleModalLabel">Supprission du Categorie</h5>
                                <form  class="form-inline" method="POST" action="{{route('category.delete',$a->id)}}">
                                    @csrf
                                    @method('DELETE')
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous supprimer Categorie: {{$a->nom}} , ainsi ses sous_categories  ?
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
                        <td style="text-align: center;">
                            <a href="{{route('ajouter_Sous_categorie',$a->id)}}" class="btn btn-primary btn-mini">Ajouter Sous Categorie</a>
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