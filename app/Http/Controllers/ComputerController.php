<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Http\Requests\StorecomputerRequest;
use App\Http\Requests\UpdatecomputerRequest;

class ComputerController extends Controller
{
   /**
     * Lista todos los computadores.
     */
    public function index()
    {
        $computers = Computer::included()->get();
        return response()->json($computers);
    }

    /**
     * Registra un nuevo computador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|max:50',
            'brand' => 'required|max:100',
        ]);

        $computer = Computer::create($request->all());

        return response()->json($computer);
    }

    /**
     * Muestra un computador específico.
     */
    public function show($id)
    {
        $computer = Computer::included()->findOrFail($id);
        return response()->json($computer);
    }

    /**
     * Actualiza la información de un computador.
     */
    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            'number' => 'required|max:50',
            'brand' => 'required|max:100',
        ]);

        $computer->update($request->all());

        return $computer;
    }

    /**
     * Elimina un computador del sistema.
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();
        return $computer;
    }
}
