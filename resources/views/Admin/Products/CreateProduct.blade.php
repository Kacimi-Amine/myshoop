@extends('admin.layout')
@section('main')
<meta name="_token" content="{{csrf_token()}}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jss.js') }}"></script>
 <div>
            <div class="row">
                <div class="col ">
                    {{-- <div class="form-wrapper "> --}}
                        <!-- form starts -->
                        <form action="{{ route('dataa') }}" name="demoform" id="demoform" method="POST" class="dropzone" enctype="multipart/form-data">
                            
                            @csrf 
                            <div class="form-group">
                                
                                <input type="hidden" class="produitid" name="produitid" id="produitid" value="">
                                <label for="name">name</label>
                                <input type="text" name="name" id="name" placeholder="Enter your slugon" class="form-control" required autocomplete="on">
                     
                                <label for="name">slugon</label>
                                <input type="text" name="slugon" id="slugon" placeholder="Enter your slugon" class="form-control" required autocomplete="on">
                     
                                <label for="name">description</label>
                                <input type="text" name="description" id="name" placeholder="Enter your name" class="form-control" required autocomplete="on">
                                <label for="name">sous_category</label>
                                <input type="text" name="sous_category" id="name" placeholder="Enter your name" class="form-control" required autocomplete="on">
                                 
                                
                                <label class="btn btn-light active" id="togg1">simple</label>
                                <label class="btn btn-light" id="togg2">configurable </label>
                                <input type="hidden" id="typeprod" name="typeProduct" value="simple">
                                <div id="d1">
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
                                                    <input id="regularprice" placeholder="00.00" name="prix_initial" type="text"   class="form-control">
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
                                                    <input id="regularprice" placeholder="00.00" name="prix_redution" type="text"   class="form-control">
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
                                                    <input id="Quantité"  name="quantite" type="text"   class="form-control">
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
                                                    <input id="regularprice" placeholder="00.00" name="prix_achat" type="text"   class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                                </div>
                                <div id="d2" style="display: none">
                                  <input type="button" value="ajouter une variable" onclick="addRow()">
                                {{--  
                                  <input type="radio" name="typevar" id="typevar" onclick="addcol()"> color
                                  <input type="radio" name="typevar" id="typevar"> taille --}}
                                </div>
                                        
                                    </div>
                                     
                                
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
                                    <div class="form-group">
                                        <div id="dropzone" class="dz-default dz-message dropzoneDragArea">
                                            <span>Upload file</span>
                                        </div>
                                        <div class="dropzone-previews"></div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-md btn-primary">create</button>
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
    
    $(function() {
    var myDropzone = new Dropzone("div#dropzone", { 
        headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
        type: 'POST',
        url: "{{ url('admin/storeimgae') }}",
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
                    type: 'POST',
                    url: URL,
                    data: formData,
                    success: function(result){
                        if(result.status == "success"){
                            // fetch the useid 
                            var produitid = result.produit_id;
                            $("#produitid").val(produitid); // inseting produitid into hidden input field
                            //process the queue
                            myDropzone.processQueue();
                        }else{

                            console.log(formData);
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
                // console.log(produitid.value);
                window.location.replace("/admin/update/produit/"+produitid.value)
            });
    
        }
        });
    });
    </script>
<script type="text/javascript">
        Dropzone.autoDiscover = false;
	    jQuery(document).ready(function() {

	  $("div#dropzone").dropzone({
        headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
        type: 'POST',
	    url: ' {{ url("image/upload/store") }}'
       
	  });

    });
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

@endsection