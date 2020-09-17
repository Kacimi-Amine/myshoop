@extends('admin.layout')
@section('main')
<link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/listeProd.css') }}">

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table" id='myTable'>
           <thead>
                                        <tr>
                                            {{-- <th>
                                            <div class="checkbox checkbox-info p-0">
                                                <input id="selectable0" type="checkbox" class="checkAll" name="checkAll">
                                                <label for="selectable0"></label>
                                            </div>
                                            </th> --}}
                                            <th scope="col">Image</th>
                                            <th scope="col">Titre</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">sous Category</th>
                                            <th scope="col">quantite</th>
                                            {{-- <th>Commandes</th> --}}
                                            <th scope="col">created_at</th>
                                            
                                            <th scope="col">Action</th>
                                        </tr>
            </thead>
            </table>
        </div>
    </div> 
</div>
<script  src="https://code.jquery.com/jquery-3.5.1.min.js"   integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="   crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
    processing: true,
    // responsive: true,
    serverSide: true,
    ajax: '{!! route('ghdj')  !!}',
     columns: [
            // {data: 'images[, ].filename', name: 'images',searchable: false,   orderable:false},

{ data: 'images[, ].filename', name: 'images',searchable: false,   orderable:false,
                    render: function( data, type, full, meta ) {
                        // console.log( full.images[0].filename);
                        return "<img src=\"/uploads/images/" + full.images[0].filename + "\" />";
                    }},

            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'sous_category', name: 'sous_category'},
            {data: 'quantite', name: 'quantite',searchable: false,   orderable:false,
            
            render: function( data, type, full, meta ) {
                //  console.log(full.quantite);
                // Object.keys(myArray)
              
                // console.log(  );

            if(full.type=='configurable'){
                console.log( (full.varia).length);
                console.log( '-----------');
                return " <p style='color:red;'> "+full.varia[0].quantite+"</p>"
            }
            else
            {
                // console.log(full.quantite);

                return " <p> "+full.quantite+"</p>"

            }
           
            }
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ]
     

    });
   

     

} );
</script>
@endsection