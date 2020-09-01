
var id = 4;
var y = 1;
function addRow() {
  const div = document.createElement('div');

  div.className = 'row';

  div.innerHTML = `
  <div class="col-md-15  table-responsive" id=ct`+ id + `>
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
    <select name="type[]" style="width: 200px;" class="form-control" id="mySelect`+ id + `" onchange="myFunction2(` + id + `);">
  <option value="Taille">Taille</option>
  <option value="color">color</option>
</select>
   </td> 

   <td class="py-3" id="divv` + id + `" >
   <input type="hidden"  name="typeCT[]" id="typeCT` + id + `" value="taille">
   <input placeholder="value" type="text" class="form-control"name='valeur[]' >
   
   </td>
   
    <td class="py-3"><input placeholder="00.00"  type="text" name='prixx_initial[]' class="form-control">
    
    </td>
    <td class="py-3">
    <input placeholder="00.00" type="text" name='prixx_redution[]'  class="form-control">
     
    </td>
    <td class="py-3">
    <input placeholder="00.00" type="text"  name='prixx_achat[]' class="form-control">
     
    </td>
    <td class="py-3"><input type="number" name='quantitex[]'  min="1" class="form-control"></td>
    <td> <button class="btn btn-warning"  onclick="removeRow(`+ id + `)" > <i class='fas fa-trash-alt'></i></button>
  
    </td>
    </tr>
    </tbody></table>
  
    </div>
    
  `;

  document.getElementById('d2').appendChild(div);
  id++;
  console.log("id=" + id);
}
function myFunction2(i) {
  console.log(i);
  var x = document.getElementById("mySelect" + i).value;
  if (x == 'color') {
    document.getElementById("divv" + i).insertAdjacentHTML('afterbegin', ' <input id="' + i + '" type="color" name="colorval[]" value="" />');
    document.getElementById("typeCT" + i).value = "color";
  }
  else
    if (x == 'Taille') {
      document.getElementById("typeCT" + i).value = "taille";
      document.getElementById(i).remove();
    }

}

function removeRow(i) {
  document.getElementById('ct' + i).remove();
}
function removeRow2(i) {
  document.getElementById('ct2' + i).remove();
}

function removeinput(i, j) {
  document.getElementById('inp' + i).remove();
  document.getElementById("divhid" + i).insertAdjacentHTML('beforeend', ' <input value="uploads/images/' + j + ' "   type="hidden" name="img_to_delete[]">');



}
//pour iviter rwina des ids...
function myFunction22(i) {
  console.log(i);
  var x = document.getElementById("mySelectt" + i).value;
  if (x == 'color') {
    document.getElementById("divvv" + i).insertAdjacentHTML('afterbegin', ' <input id="' + i + '" type="color" name="colorval[]" value="" />');
    document.getElementById("typeCTT" + i).value = "color";
  }
  else
    if (x == 'Taille') {
      document.getElementById("typeCTT" + i).value = "taille";
      document.getElementById(i).remove();
    }

}

