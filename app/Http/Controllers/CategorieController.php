<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories=Categorie::all();
            return response()->json(($categories));
        } catch (\Exception $e) {
            return response()->json("problem de la récupération de la liste des categories ");
        }
        




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {

        $categorie=new Categorie(["nomCategorie"=>$request->input("nomCategorie"),"description"=>$request->input("description")]);
        $categorie->save();
        return response()->json($categorie); 
    } catch (\Exception $e) {
        return response()->json('Problème lors de la création de la catégorie');
    }
}




    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        try
        {
    $categorie = Categorie::findOrFail($id);
    return response()->json($categorie);
    } catch (\Exception $e) {
        return response()->json('Problème de récupération des données');
    }

    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
    try{
    $categorie = Categorie::findOrFail($id);
    $categorie->update($request->all());
    return response()->json($categorie);}
    catch (\Exception $e) {
    return response()->json('Problème de la mise à jour des données');
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json('Catégorie supprimée !');
        }catch (\Exception $e) {
            return response()->json('Problème de la suppresion ');
        }
    }
}
