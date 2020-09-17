<?php

namespace App\Http\Controllers;

use App\Image;
use App\Produit;
use App\Category;
use Carbon\Carbon;
use App\VariableProduit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTable;
use App\Http\Requests\UpdateProduitRequest;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $product = Produit::with('images', 'varia');
        // dd($product);
        return view('Admin.Products.ListProduct');
    }


    public function getproduct()
    {
        $product = Produit::with('images', 'varia');

        $produits = DataTables::of($product)->addColumn('action', function ($prod) {
            return '<a href="product/update/' . $prod->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="product/destroy/' . $prod->id .
                '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> delete</a>';
        })->editColumn('id', 'ID: {{$id}}')
            ->editColumn('created_at', function ($date) {
                return $date->created_at ? with(new Carbon($date->created_at)) : '';
            })

            ->make(true);
        // dd($product);
        return  $produits;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Products.CreateProduct', ['categories' => Category::with('sous_categories')->get()]);
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
        $cat = Category::with('sous_categories')->get();
        $img = Image::where('produit_id', $id)->get();
        $vr = VariableProduit::where('produit_id', $id)->get();
        return view('Admin.Products.UpdateProduit', compact('prod', 'img', 'vr', 'cat'));
    }
    public function updateprod(UpdateProduitRequest $request, $id)
    {
        $prod = Produit::findorfail($id);
        $prod->name = $request->name;
        $prod->slugon = $request->slugon;
        $prod->description = $request->description;
        // dd($request->sous_category);
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
    public function update(UpdateProduitRequest $request, $id)
    {
        $i = 0;
        $this->updateprod($request, $id);
        if ($request->input('typeProduct') == 'configurable') {
            $varianteproduit = VariableProduit::where('produit_id', "=", $id)->get();
            // $varianteproduit = VariableProduit::find($id);
            $nbr = count($varianteproduit);
            if (empty($request->input('prixx_initial'))) {
                $nbrreq = 0;
            } else {
                $nbrreq = count($request->input('prixx_initial'));
            }
            $reslt = $nbr - $nbrreq;
            // dd($reslt);
            //premier if passage de simple vers configurable
            if ($nbr == 0) {
                $b = 0;
                // dd(count($request->input('prixx_initial')));
                foreach ($request->input('prixx_initial') as $item => $v) {
                    $varianteproduit = new VariableProduit();
                    $varianteproduit->produit_id = $id;
                    $varianteproduit->type = 'taille';
                    $varianteproduit->colorval = null;
                    if ($request->typeCT[$item] === 'color') {
                        $varianteproduit->type = 'color';
                        $varianteproduit->colorval = $request->input('colorval')[$b];
                        $b++;
                    }
                    $varianteproduit->value = $request->input('valeur')[$item];
                    $varianteproduit->prix_initial = $request->input('prixx_initial')[$item];
                    $varianteproduit->prix_redution = $request->input('prixx_redution')[$item];
                    $varianteproduit->prix_achat = $request->input('prixx_achat')[$item];
                    $varianteproduit->quantite = $request->input('quantitex')[$item];
                    $varianteproduit->save();
                }
            } else {
                $updatedvar = $request->idexist;
                $exested_var = $request->idexist2;
                if (empty($request->idexist) || empty($request->idexist2)) {
                    $count_var_rester = 0;
                    $diffirence = $exested_var;
                } else {
                    $count_var_rester = count($request->idexist);
                    $diffirence = array_diff($exested_var, $updatedvar);
                }
                $count_var = count($request->idexist2);
                if ($count_var > $count_var_rester) {
                    foreach ($diffirence as $item => $v) {
                        VariableProduit::destroy($diffirence[$item]);
                        // $varpro_to_delete->destroy();
                    }
                }
                $varianteproduit2 = VariableProduit::where('produit_id', "=", $id)->get();
                $nbr2 = count($varianteproduit2);
                $restl2 = $nbr2 - $nbrreq;
                //premiere boucle pour modifier
                for ($j = 0; $j < ($count_var_rester); $j++) {
                    $varianteproduit2[$j]->type = 'taille';
                    $varianteproduit2[$j]->colorval = 'NULL';
                    // dd($nbrcolor=count( $request->input('colorval')),$request->input('colorval'));
                    if ($request->typeCT[$j] == 'color') {
                        $varianteproduit2[$j]->type = 'color';
                        //  dd($request->input('colorval')[$item]);
                        $varianteproduit2[$j]->colorval = $request->input('colorval')[$i];
                        $i++;
                    }
                    $varianteproduit2[$j]->value = $request->input('valeur')[$j];
                    $varianteproduit2[$j]->prix_initial = $request->input('prixx_initial')[$j];
                    $varianteproduit2[$j]->prix_redution = $request->input('prixx_redution')[$j];
                    $varianteproduit2[$j]->prix_achat = $request->input('prixx_achat')[$j];
                    $varianteproduit2[$j]->quantite = $request->input('quantitex')[$j];
                    $varianteproduit2[$j]->save();
                }
                // dd($restl2, $nbr2, $nbrreq, $count_var_rester);
                for ($j = 0; $j < (-$restl2); $j++) {
                    $varianteproduit = new VariableProduit();
                    $varianteproduit->produit_id = $id;
                    $varianteproduit->type = 'taille';
                    $varianteproduit->colorval = null;
                    if ($request->typeCT[$j + $nbr2] === 'color') {
                        $varianteproduit->type = 'color';
                        $varianteproduit->colorval = $request->input('colorval')[$i];
                        $i++;
                    }
                    $varianteproduit->value = $request->input('valeur')[$j + $nbr2];
                    $varianteproduit->prix_initial = $request->input('prixx_initial')[$j + $nbr2];
                    $varianteproduit->prix_redution = $request->input('prixx_redution')[$j + $nbr2];
                    $varianteproduit->prix_achat = $request->input('prixx_achat')[$j + $nbr2];
                    $varianteproduit->quantite = $request->input('quantitex')[$j + $nbr2];
                    $varianteproduit->save();
                }
            }
        }
        //update image
        if (empty($request->image_restant)) {
            $difference2 = $request->imginit;
        } else {
            $image_restant = $request->image_restant;
            $image_initial = $request->imginit;
            $difference2 = array_diff($image_initial, $image_restant);
            // $data[] = $difference2;
        }

        if (!empty($request->img_to_delete) && !empty($difference2)) {
            foreach ($request->img_to_delete as $item => $v) {
                // dd($request->img_to_delete[$item], $difference2[$item]);
                if (file_exists(public_path($request->img_to_delete[$item]))) {
                    unlink(public_path($request->img_to_delete[$item]));
                }
            }
            foreach ($difference2 as $item => $v) {
                Image::destroy($difference2);
            }
        }
        Session::flash('message', 'produit bien modifier !');

        return response()->json(['status' => "success", 'produit_id' => $id, 'etat' => 0]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Produit::destroy($id);
        return redirect()->back()->with([
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        ]);
    }
    public function storeData(ProductRequest $request)
    {
        // dd($request->description);
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
            $produit_id = $produit->id; // this give us the last inserted record id
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
                    $varianteproduit->produit_id = $produit_id; //product id !!
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
        // $request->session()->flash('message', 'Task was successful!');
        Session::flash('message', 'produit bien ajouter!');
        return response()->json(['status' => "success", 'produit_id' => $produit_id]);
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
            $produit_image->produit_id = $request->produitid;
            $produit_image->save();
            // return redirect("/update/produit/"+$produitid );
            Session::flash('message', 'produit bien modifier !');
            Session::flash('alert-class', 'alert-success');

            return response()->json(['status' => "success", 'imgdata' => $original_name, 'produitid' => $produitid]);
        }
    }
    public function updateImage(Request $request, $id)
    {

        // dd($request->file);
        // $produitid = $request->produitid;
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
            $produit_image->produit_id = $id;
            $produit_image->save();
            Session::flash('message', 'produit bien modifier !');
            Session::flash('alert-class', 'alert-success');

            return response()->json(['status' => "success", 'imgdata' => $original_name, 'produitid' => $id, 'etat' => 1]);
        }
    }
}