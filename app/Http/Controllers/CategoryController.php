<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.listerCategorie',['categories' => Category::with('sous_categories')->get()]);

  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $category = new category();
        $category->nom = $request->input('nom');
        $category->save();
       $message='Categorie bien ajouté';
       return redirect('/admin/categories/list')->withMessage($message);

    }


    public function Addcat(){
        return view('admin.categories.AjouterCategorie');

    }

    /**
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       return view('Admin.categories.ModifierCategorie',['edit_category' =>Category::findOrFail($id)]);
   }


    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request,$id)
   {
       $this->validate($request,[
           'nom'=>'required|max:25'
       ]);
       $category = Category::findorFail($id);
       $category->update($request->all());
       $message='Categorie bien modifié';
       return redirect(route('liste_categorie'))->withMessage($message);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $request, $id)
   {
        Category::destroy($id);
        $request->session()->flash('status', 'Post was Deleted !!!');
        $message='Categorie bien supprimé';
        return redirect()->back()->withMessage($message);
    }
}
