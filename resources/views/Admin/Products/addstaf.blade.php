@extends('admin.layout')
@section('main')
<script type="text/javascript" src="{{ URL::asset('assets/js/jss.js') }}"></script>
 <form role="form"method="POST" action="">
        {{ csrf_field() }}
        <div id="contentt">
     
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
                    <input id="regularprice" placeholder="00.00" name="price_initial" type="text" value="100.00" class="form-control">
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
                    <input id="regularprice" placeholder="00.00" name="price_reduit" type="text" value="99.00" class="form-control">
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
                    <input id="Quantité"  name="quantite" type="text" value="10" class="form-control">
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
                    <input id="regularprice" placeholder="00.00" name="price_reduit" type="text" value="99.00" class="form-control">
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
      <button type="submit" class="btn btn-md btn-primary">create</button>  
</form>

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