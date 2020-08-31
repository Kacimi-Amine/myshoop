<?php

namespace App\Http\Controllers;

use App\Category;
use App\Sous_Category;
use Illuminate\Http\Request;

class SousCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $souscate = Sous_Category::where('category_id',$id)->get();
        $category_name=Category::findOrFail($id);
        return view('Admin.categories.sous_categorie.ListeSousCategorie',["souscate"=>$souscate],['category_name'=>$category_name] );


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Admin.categories.sous_categorie.ajouterSousCategorie', ['souscategory' => Category::findOrFail($id)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $scategory = new Sous_Category();
        $scategory->nom = $request->input('nom');
        $scategory->category_id = $id;
        $scategory->save();
        $message = 'Sous Categorie bien ajouté';
        return redirect(route('liste_categorie'))->withMessage($message);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Sous_Category  $sous_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Sous_Category $sous_Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sous_Category  $sous_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Sous_Category $sous_Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sous_Category  $sous_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$scat)
    {
        $this->validate($request,[
            'nom'=>'required|max:40'
        ]);
//$category = Sous_Category::findorFail($id);

$sscat=Sous_Category::findorfail($scat);

        $category = Sous_Category::where('id',"=",$sscat->id)->where('category_id',"=",$sscat->category_id);
// dd( $category);
        $category->update(['nom'=>$request->nom]);
        $message='Sous Categorie bien modifier';
        return redirect("/admin/listesouscat/$sscat->category_id")->withMessage($message);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sous_Category  $sous_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   {
        Sous_Category::destroy($id);
        $message='Sous_Categorie bien supprimé';
        return redirect()->back()->withMessage($message);
    }
}
