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
            // Validation des données entrantes avec valeur par défaut en cas de champ vide
            $request->validate([
                'nomCategorie' => 'required|string|max:255',
                'description' => 'nullable|string|max:500', // Champ optionnel avec une longueur maximale de 500 caractères
            ]);
    
            // Créer un nouvel objet Categorie avec les données reçues
            $categorie = new Categorie([
                "nomCategorie" => $request->input("nomCategorie"),
                "description" => $request->input("description"),  // Si description est vide, alors '' est utilisé
                "created_at" => now(),  // Utilisation de Laravel's now() pour la date et l'heure
                "updated_at" => now()   // Utilisation de Laravel's now() pour la date et l'heure
            ]);
    
            // Enregistrer la catégorie dans la base de données
            $categorie->save();
    
            // Retourner la réponse en JSON avec la catégorie créée
            return response()->json($categorie, 201); 
        } catch (\Exception $e) {
            // Retourner un message d'erreur plus précis
            return response()->json(['message' => 'Problème lors de la création de la catégorie', 'error' => $e->getMessage()], 500);
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
