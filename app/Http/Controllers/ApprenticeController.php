<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Http\Requests\StoreapprenticeRequest;
use App\Http\Requests\UpdateapprenticeRequest;

class ApprenticeController extends Controller
{
        /**
     * Lista todos los aprendices registrados.
     */
    public function index()
    {
        $apprentices = Apprentice::included()->get();
        return response()->json($apprentices);
    }

    /**
     * Registra un nuevo aprendiz.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:apprentices,email',
            'cell_number' => 'required|max:20',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'required|exists:computers,id',
        ]);

        $apprentice = Apprentice::create($request->all());

        return response()->json($apprentice);
    }

    /**
     * Muestra un aprendiz por su ID.
     */
    public function show($id)
    {
        $apprentice = Apprentice::included()->findOrFail($id);
        return response()->json($apprentice);
    }

    /**
     * Actualiza los datos de un aprendiz.
     */
    public function update(Request $request, Apprentice $apprentice)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:apprentices,email,' . $apprentice->id,
            'cell_number' => 'required|max:20',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'required|exists:computers,id',
        ]);

        $apprentice->update($request->all());

        return $apprentice;
    }

    /**
     * Elimina un aprendiz del sistema.
     */
    public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();
        return $apprentice;
    }

}
