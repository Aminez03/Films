<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
    $films=Film::with('categorie')->get(); // Inclut  catégorie liée;
    return response()->json($films,200);
    } catch (\Exception $e) {
    return response()->json("Sélection impossible {$e->getMessage()}");
    }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try {
    $film=new Film([
    "name"=> $request->input('name'),
    "image"=> $request->input('image'),
    "rating"=> $request->input('rating'),
    "date"=> $request->input('date'),
    "description"=> $request->input('description'),
    "trailer"=> $request->input('trailer'),
    "categorieID"=> $request->input('categorieID'),
    ]);
    $film->save();
    return response()->json($film);
    
    } catch (\Exception $e) {
    return response()->json("insertion impossible {$e->getMessage()}");
    }
    
    }
   

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    try {
    $film=Film::findOrFail($id);
    return response()->json($film);
    } catch (\Exception $e) {
    return response()->json("probleme de récupération des données {$e->getMessage()}");
    }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    try {
    $film=Film::findorFail($id);
    $film->update($request->all());
    return response()->json($film);
    } catch (\Exception $e) {
    return response()->json("probleme de modification {$e->getMessage()}");
    }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    try {
    $film=Film::findOrFail($id);
    $film->delete();
    return response()->json("film supprimée avec succes");
    } catch (\Exception $e) {
    return response()->json("probleme de suppression de film {$e->getMessage()}");
    }
    }

    public function showFilmsByCAT($idcat)
    {
    try {
    $films= Film::where('categorieID', $idcat)->with('categorie')->get();
    return response()->json($films);
    } catch (\Exception $e) {
    return response()->json("Selection impossible {$e->getMessage()}");
    }
    }


    public function filmsPaginate()
    {
        try {
            // Récupérer la taille de la page depuis les paramètres de requête (3 par défaut)
            $perPage = request()->input('pageSize', 3);
    
            // Récupérer les films avec la relation 'categorie' et les paginer
            $films = Film::with('categorie')->paginate($perPage);
    
            // Construire une réponse JSON formatée
            return response()->json([
                'success' => true,
                'data' => [
                    'films' => $films->items(), // Les films de la page courante
                    'totalPages' => $films->lastPage(), // Nombre total de pages
                    'currentPage' => $films->currentPage(), // Page courante
                    'totalItems' => $films->total(), // Nombre total d'éléments
                ]
            ], 200);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message clair avec un code d'erreur HTTP approprié
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la récupération des films : {$e->getMessage()}"
            ], 500);
        }
    }
    






}
