<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Image;
use App\Produit;
use App\VariableProduit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $prod = Produit::findorfail($id);
        $img = Image::where('product_id', $id)->get();
        $vr = VariableProduit::where('product_id', $id)->get();

        return view('Admin.Products.UpdateProduit', compact('prod', 'img', 'vr'));
    }

    public function updateprod(Request $request ,$id){
        $prod = Produit::findorfail($id);
        $prod->name = $request->name;
        $prod->slugon = $request->slugon;
        $prod->description = $request->description;
        $prod->sous_category = $request->sous_category;
        $prod->type = $request->typeProduct;

        if ($request->typeProduct == 'simple') {
            $prod->prix_initial = $request->prix_initial;
            $prod->prix_redution = $request->prix_redution;
            $prod->prix_achat = $request->prix_achat;
            $prod->quantite = $request->quantite;
        }
        // if() hna l etat w moraha l contdown..
        $prod->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $i=0;
     $this->updateprod( $request ,$id);

        if ($request->input('typeProduct') == 'configurable') {

            // $varianteproduit = VariableProduit::find($id);
            $varianteproduit = VariableProduit::where('product_id', "=", $id)->get();
            $nbr = count($varianteproduit);
            $nbrreq = count($request->input('prixx_initial'));
            $reslt=$nbr-$nbrreq;
            dd($reslt);
            // dd($reslt);
            // dd($varianteproduit[0]);
            if ($reslt <= 0) {
                for($j=0;$j<($nbr);$j++)  {
                    $varianteproduit[$j]->type = 'taille';
                    $varianteproduit[$j]->colorval='NULL';
                    // dd($nbrcolor=count( $request->input('colorval')),$request->input('colorval'));
                    if ($request->typeCT[$j] == 'color') {
                      
                        $varianteproduit[$j]->type = 'color';
                        //  dd($request->input('colorval')[$item]);
                        $varianteproduit[$j]->colorval = $request->input('colorval')[$i];
                        $i++;
                    }
                    $varianteproduit[$j]->value = $request->input('valeur')[$j];
                    $varianteproduit[$j]->prix_initial = $request->input('prixx_initial')[$j];
                    $varianteproduit[$j]->prix_redution = $request->input('prixx_redution')[$j];
                    $varianteproduit[$j]->prix_achat = $request->input('prixx_achat')[$j];
                    $varianteproduit[$j]->quantite = $request->input('quantitex')[$j];
                    $varianteproduit[$j]->save();
                }
                for($j=0;$j< (-$reslt);$j++) {
                    $varianteproduit = new VariableProduit();
                    $varianteproduit->product_id = $id;
                    $varianteproduit->type = 'taille';
                    $varianteproduit->colorval = null;
                    if ($request->typeCT[$j+$nbr] === 'color') {

                        $varianteproduit->type = 'color';
                        $varianteproduit->colorval = $request->input('colorval')[$i];
                        $i++;
                    }
                    $varianteproduit->value = $request->input('valeur')[$j+$nbr];
                    $varianteproduit->prix_initial = $request->input('prixx_initial')[$j+$nbr];
                    $varianteproduit->prix_redution = $request->input('prixx_redution')[$j+$nbr];
                    $varianteproduit->prix_achat = $request->input('prixx_achat')[$j+$nbr];
                    $varianteproduit->quantite = $request->input('quantitex')[$j+$nbr];
                    $varianteproduit->save();
                }
            } 
            elseif ($nbr == 0) {

                // dd(count($request->input('prixx_initial')));
                foreach ($request->input('prixx_initial') as $item => $v) {
                    $varianteproduit = new VariableProduit();
                    $varianteproduit->product_id = $id;
                    $varianteproduit->type = 'taille';
                    $varianteproduit->colorval = null;
                    if ($request->typeCT[$item] === 'color') {
                        $varianteproduit->type = 'color';
                        $varianteproduit->colorval = $request->input('colorval')[$item];
                    }
                    $varianteproduit->value = $request->input('valeur')[$item];
                    $varianteproduit->prix_initial = $request->input('prixx_initial')[$item];
                    $varianteproduit->prix_redution = $request->input('prixx_redution')[$item];
                    $varianteproduit->prix_achat = $request->input('prixx_achat')[$item];
                    $varianteproduit->quantite = $request->input('quantitex')[$item];
                    $varianteproduit->save();
                }
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }


    public function storeData(ProductRequest $request)
    {

        try {
            $produit = new Produit();
            $produit->name = $request->name;
            $produit->slugon = $request->slugon;
            $produit->description = $request->description;
            $produit->sous_category = $request->sous_category;
            $produit->type = $request->typeProduct;
            if ($request->typeProduct == 'simple') {
                $produit->prix_initial = $request->prix_initial;
                $produit->prix_redution = $request->prix_redution;
                $produit->prix_achat = $request->prix_achat;
                $produit->quantite = $request->quantite;
            }
            // if() hna l etat w moraha l contdown..
            $produit->save();
            $user_id = $produit->id; // this give us the last inserted record id

            //add variable 
            if ($request->input('typeProduct') == 'configurable') {

                //   $varianteproduit->type= $request->input('type');

                foreach ($request->input('prixx_initial') as $item => $v) {
                    $varianteproduit = new VariableProduit();
                    // dd(isset($request->typeCT[$item])=='color');
                    $varianteproduit->type = 'taille';
                    if ($request->typeCT[$item] === 'color') {
                        $varianteproduit->type = 'color';
                        $varianteproduit->colorval = $request->input('colorval')[$item];
                    }
                    $varianteproduit->value = $request->input('valeur')[$item];
                    $varianteproduit->product_id = $user_id; //product id !!
                    $varianteproduit->prix_initial = $request->input('prixx_initial')[$item];
                    $varianteproduit->prix_redution = $request->input('prixx_redution')[$item];
                    $varianteproduit->prix_achat = $request->input('prixx_achat')[$item];
                    $varianteproduit->quantite = $request->input('quantitex')[$item];
                    $varianteproduit->save();
                }
            }
        } catch (\Exception $e) {
            return  response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
        }
        return response()->json(['status' => "success", 'produit_id' => $user_id]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        Image::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }


    public function storeImage(Request $request)
    {
        $produitid = $request->produitid;

        if ($request->file('file')) {

            $img = $request->file('file');

            //here we are geeting produitid alogn with an image


            $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $img->getClientOriginalExtension();
            $produit_image = new Image();
            $original_name = $img->getClientOriginalName();
            $produit_image->filename = $imageName;

            if (!is_dir(public_path() . '/uploads/images/')) {
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }

            $request->file('file')->move(public_path() . '/uploads/images/', $imageName);

            // we are updating our image column with the help of produit id
            $produit_image->product_id = $request->produitid;
            $produit_image->save();
            // return redirect("/update/produit/"+$produitid );
            return response()->json(['status' => "success", 'imgdata' => $original_name, 'produitid' => $produitid]);
        }
    }



    public function updateImage(Request $request, $id)
    {
        $produitid = $request->produitid;

        if ($request->file('file')) {

            $img = $request->file('file');

            //here we are geeting produitid alogn with an image


            $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $img->getClientOriginalExtension();
            $produit_image = Image::findorfail($id);
            $original_name = $img->getClientOriginalName();
            $produit_image->filename = $imageName;

            if (!is_dir(public_path() . '/uploads/images/')) {
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }

            $request->file('file')->move(public_path() . '/uploads/images/', $imageName);

            // we are updating our image column with the help of produit id
            foreach ($request->input('productIm') as $item => $v) {

                $produit_image->filename = $request->input('productIm')[$item];
                $produit_image->save();
            }

            // return redirect("/update/produit/"+$produitid );
            return response()->json(['status' => "success", 'imgdata' => $original_name, 'produitid' => $produitid]);
        }
    }
}
