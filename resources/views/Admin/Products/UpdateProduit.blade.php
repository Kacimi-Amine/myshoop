@extends('admin.layout')
@section('main')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jss.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/styleprod.css') }}">
 <div>
            <div class="row">
                <div class="col ">
                    {{-- <div class="form-wrapper "> --}}
                        <!-- form starts -->
                        
                        <form action="{{ route('updateProduit',$prod->id) }}" name="demoform" id="demoform" method="PUT" class="dropzone" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf 
                            <div class="form-group">
                               
                                <input type="hidden" class="produitid" name="produitid" id="produitid" value="">
                                <label for="name">name</label>
                                <input type="text" name="name" value="{{ $prod->name }}" id="name" placeholder="Enter your slugon" class="form-control" required autocomplete="on">
                     
                                <label for="name">slugon</label>
                                <input type="text" name="slugon" id="slugon" value="{{ $prod->slugon }}" placeholder="Enter your slugon" class="form-control" required autocomplete="on">
                     
                                <label for="name">description</label>
                                <input type="text" name="description" id="name"  value="{{ $prod->description }}" placeholder="Enter your name" class="form-control" required autocomplete="on">
                                <label for="name">sous_category</label>
                                <input type="text" name="sous_category" value="{{ $prod->sous_category }}" id="name" placeholder="Enter your name" class="form-control" required autocomplete="on">
                                 <p>{{ $prod->type }}</p>
                                
                                <label class="btn btn-light active" id="togg1">simple</label>
                                <label class="btn btn-light" id="togg2">configurable </label>
                               
                                <input type="hidden" id="typeprod" name="typeProduct" value="{{ $prod->type ?? 'simple' }}">
                                <div id="d1"  @if ($prod->type=='configurable')
                                    style="display: none;"
                                    @endif >
                                  <div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="regularprice">Prix initial</label> 
                                                <div class="w-90">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">DH</span>
                                                    </div> 
                                                    <input id="regularprice" placeholder="00.00" name="prix_initial" type="text" value="{{ $prod->prix_initial }}"  class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="regularprice">Prix apres reduction</label> 
                                                <div class="w-90">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">DH</span>
                                                    </div> 
                                                    <input id="regularprice" placeholder="00.00" name="prix_redution" value="{{ $prod->prix_redution }}" type="text"   class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="Quantité">Quantité</label> 
                                                <div class="w-90">
                                                <div class="input-group">
                                                    <input id="Quantité"  name="quantite" type="text" value="{{ $prod->quantite }}"   class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="regularprice">Prix d'achat</label> 
                                                <div class="w-90">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">DH</span>
                                                    </div> 
                                                    <input id="regularprice" placeholder="00.00" name="prix_achat" type="text"  value="{{ $prod->prix_achat }}"   class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                                </div>
                                <div id="d2"  @if ($prod->type=='simple')
                                style="display: none;"
                                @endif>
                                  <input type="button" value="ajouter une variable" onclick="addRow()">
                                
                                  
                                    {{-- add variabl --}}

                                  @foreach ($vr as $var)
                                    <input type="hidden"  name="idexist2[]"  value="{{$var->id}}">
                            
                                    <div class="col-md-15  table-responsive" id="ct2{{ $var->id }}">
                                    <table class="table table-bordered " style="min-width: 550px;">
                                    <thead>
                                    <tr class="bg-light">
                                    <th scope="col"  style="width: 230px;" >Varient</th>
                                    <th style="width: 200px;">value</th>
                                    
                                    <th style="width: 150px;">Prix.Pr</th>
                                    <th style="width: 150px;">Prix.Rég</th>
                                    <th style="width: 150px;">Prix.ach</th>
                                    <th style="width: 150px;">Quantité</th>
                                    </tr></thead> 
                                    <tbody>
                                     <tr class="">
                                     
                                     <td class="py-3" >
                                      <select name="type[]" style="width: 200px;" class="form-control" id="mySelectt{{ $var->id }}"  onchange="myFunction22({{ $var->id }});">
                                    <option  value="Taille" {{ $var->type == 'Taille' ? 'selected' : ''}}>Taille</option>
                                    <option  value="color" {{ $var->type == 'color' ? 'selected' : ''}}>color</option>
                                  </select>
                                     </td> 
                                  
                                     <td class="py-3" id="divvv{{ $var->id }}" >
                                        @if ($var->type=='color')
                                        <input id="{{ $var->id }}" type="color" name="colorval[]" value="{{ $var->colorval }}" />
                                        @endif
                                     <input type="hidden"  name="typeCT[]" id="typeCTT{{ $var->id }}" value="{{$var->type ?? 'taille'}}">
                                     <input type="hidden"  name="idexist[]"  value="{{$var->id}}">
                                     
                                     <input placeholder="value" type="text"  value="{{$var->value}}" class="form-control"name='valeur[]' >
                                     
                                     </td>
                                     
                                      <td class="py-3"><input placeholder="00.00"  type="text"  value="{{ $var->prix_initial }}"name='prixx_initial[]' class="form-control">
                                      
                                      </td>
                                      <td class="py-3">
                                      <input placeholder="00.00" type="text" value="{{ $var->prix_redution }}" name='prixx_redution[]'  class="form-control">
                                       
                                      </td>
                                      <td class="py-3">
                                      <input placeholder="00.00" type="text"   value="{{ $var->prix_achat }}" name='prixx_achat[]' class="form-control">
                                       
                                      </td>
                                      <td class="py-3"><input type="number"   value="{{ $var->quantite }}" name='quantitex[]'  min="1" class="form-control"></td>
                                      <td> <button class="btn btn-warning"  onclick="removeRow2({{ $var->id }})" > <i class='fas fa-trash-alt'></i></button>
                                    
                                      </td>
                                      </tr>
                                      </tbody></table>
                                  
                                      </div>
                                  @endforeach
                                </div>
                                        
                                    </div>
                                     
                                
                              
                                    <div class="form-group">
                                        <div id="dropzone" class="dz-default dz-message dropzoneDragArea">
                                            <span>Upload image</span>
                                        </div>
                                        <div class="dropzone-previews">
                                            
                                            @foreach ($img as $im)
                                            <div  style="display: none" id="divhid{{ $im->id}}"></div>
                                                <input value="{{ $im->id}}"   type="hidden"  name="imginit[]">

                                            {{-- <img src="{{ asset( '/uploads/images/'.$im->filename.'') }}" > --}}

                                            <div class="product-image draggable-item ui-sortable-handle" id="inp{{ $im->id}}" style="background-image: url('/uploads/images/{{$im->filename  }}')">

                                                {{-- background-image: url("/uploads/sm/260720191836261429765921.jpg"); position: relative; left: 0px; top: 0px; --}}
                                                <input value="{{$im->id}}"  id="inp{{ $im->id}}"     type="hidden"   name="image_restant[]">
                                                <i class="fa fa-times delete" onclick="removeinput({{ $im->id }},'{{ $im->filename }}')"></i>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group" align="center">
                                      <button type="submit"  class="btn btn-md btn-outline-success" >Update</button>
                                  </div>
                              </form>
                            </div>
                           

                            
                        
                        <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
 <!-- Adding a script for dropzone -->
 <script>
    Dropzone.autoDiscover = false;
    // Dropzone.options.demoform = false;	
    var y={{ $prod->id }};
    console.log(y);
    $(function() {
    var myDropzone = new Dropzone("div#dropzone", { 
        headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
        type: 'PUT',
        url: "{{ url('admin/product/updateimage/') }}"+'/'+y,
        // url: "{{ url('admin/updateimage/{  $prod->id }') }}",
        //  url : '{{url("admin/recipients")}}' + '/' + news,
        
        paramName: "file",
        previewsContainer: 'div.dropzone-previews',
        // addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 10,
        
         
         // The setting up of the dropzone
         init: function() {
            var myDropzone = this;
            //form submission code goes here
            $("form[name='demoform']").submit(function(event) {
                //Make sure that the form isn't actully being sent.
                event.preventDefault();
                URL = $("#demoform").attr('action');
                formData = $('#demoform').serialize();
                $.ajax({
                    type: 'PUT',
                    url: URL,
                    data: formData,
                    success: function(result){
                        if(result.status == "success"){
                            // fetch the useid 
                            var produitid = result.produit_id;
                            $("#produitid").val(produitid); // inseting produitid into hidden input field
                            //process the queue
                           
                            if(result.etat==0){
                                myDropzone.processQueue();
                               alert(result.etat,'done');
                                 location.reload();

                            }
                           
                        }else{

                            console.log(error);
                        }
                    }
                });
            });
            //Gets triggered when we submit the image.
            this.on('sending', function(file, xhr, formData){
            //fetch the produit id from hidden input field and send that produitid with our image
              var produitid = document.getElementById('produitid').value;
               formData.append('produitid', produitid);
            });
            
            this.on("success", function (file, response) {
                // //reset the form
                // $('#demoform')[0].reset();
                // //reset dropzone
                // $('.dropzone-previews').empty();
                //  console.log(produitid.value);
                 window.location.replace("/admin/product/update/"+produitid.value)
            });
    
        }
        });
    });
    </script>
<script type="text/javascript">
     
	//     jQuery(document).ready(function() {

	//   $("div#dropzone").dropzone({
    //     headers: {
    //                             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //                         },
    //     type: 'POST',
	//     url: ' {{ url("image/upload/store") }}'
       
	//   });

    // });
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ url("admin/image/delete") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
</script>


<script>
    let togg1 = document.getElementById("togg1");
  let togg2 = document.getElementById("togg2");
  let d1 = document.getElementById("d1");
  let d2 = document.getElementById("d2");
  togg1.addEventListener("click", () => {
    if(getComputedStyle(d1).display == "none"){
      d1.style.display = "block";
      togg1.className='btn btn-light active';
      d2.style.display='none';
      togg2.className="btn btn-light";
      document.getElementById("typeprod").value = "simple";
    } 
  })
  
  function togg(){
    if(getComputedStyle(d2).display == "none"){
      d2.style.display = "block";
      d1.style.display = "none";
      togg2.className='btn btn-light active';
      togg1.className='btn btn-light ';
      document.getElementById("typeprod").value = "configurable";
    } 
  };
  togg2.onclick = togg;
  
  </script>
@endsection