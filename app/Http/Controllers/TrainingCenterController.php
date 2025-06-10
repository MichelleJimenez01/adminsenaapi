<?php

namespace App\Http\Controllers;

use App\Models\Training_center;
use App\Http\Requests\Storetraining_centerRequest;
use App\Http\Requests\Updatetraining_centerRequest;

class TrainingCenterController extends Controller
{
   /**
     * Lista todos los centros de formación registrados.
     */
    public function index()
    {
        $centers = Training_center::included()->get();
        return response()->json($centers);
    }

    /**
     * Guarda un nuevo centro de formación.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $center = Training_center::create($request->all());
        return response()->json($center);
    }

    /**
     * Muestra un centro específico por su ID.
     */
    public function show($id)
    {
        $center = Training_center::included()->findOrFail($id);
        return response()->json($center);
    }

    /**
     * Actualiza un centro existente.
     */
    public function update(Request $request, Training_center $training_center)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $training_center->update($request->all());

        return $training_center;
    }

    /**
     * Elimina un centro de formación.
     */
    public function destroy(Training_center $training_center)
    {
        $training_center->delete();
        return $training_center;
    }
}
