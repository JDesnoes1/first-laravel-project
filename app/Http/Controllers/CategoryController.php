<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function allCat() {
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function addCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Vous devez insérer une catégorie !',
            'category_name.unique' => 'Cette catégorie existe déjà !',
            'category_name.max' => 'Le nom de votre catégorie doit avoir moins de 255 caractères',
        ]);

        //Avec l'orm Eloquent

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        //Avec le queryBuilder

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);
        
        //Meilleur façon de faire 

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        return Redirect()->back()->with('success', 'La catégorie a été ajoutée avec succès !');
    }

    public function editCat($id) {
        $categories = Category::find($id);
        // $categories = DB::table('categories')->where('id', $id)->first() ;
        return view('admin.category.edit', compact('categories'));
    }

    public function updateCat(Request $request, $id) {
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] =Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);


        return Redirect()->route('all.category')->with('success', 'La catégorie a été modifiée avec succès !');

    }

    public function softDelete($id) {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Votre catégorie a bien été placée dans la liste des suppressions');
    }

    public function restoreCat($id) {
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Votre catégorie a bien été récupérée avec succès !');
    }

    public function pdeleteCat($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Votre catégorie a bien été supprimée définitivement !');
    }
}
