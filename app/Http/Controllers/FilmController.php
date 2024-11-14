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
        $perPage = request()->input('pageSize', 2);
        // Récupère la valeur dynamique pour la pagination
        $films = Film::with('categorie')->paginate($perPage);
        // Retourne le résultat en format JSON API
        return response()->json([
        'films' => $films->items(), // Les films paginés
        'totalPages' => $films->lastPage(), // Le nombre de pages
        ]);
        } catch (\Exception $e) {
        return response()->json("Selection impossible {$e->getMessage()}");
        }
        }







}
