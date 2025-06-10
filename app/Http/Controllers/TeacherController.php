<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateteacherRequest;

class TeacherController extends Controller
{
   /**
     * Lista todos los docentes con sus relaciones.
     */
    public function index()
    {
        $teachers = Teacher::included()->get();
        return response()->json($teachers);
    }

    /**
     * Registra un nuevo docente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:teachers,email',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json($teacher);
    }

    /**
     * Muestra un docente específico por ID.
     */
    public function show($id)
    {
        $teacher = Teacher::included()->findOrFail($id);
        return response()->json($teacher);
    }

    /**
     * Actualiza los datos de un docente.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $teacher->update($request->all());

        return $teacher;
    }

    /**
     * Elimina un docente del sistema.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return $teacher;
    }


    public function create()
    {
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teacher $teacher)
    {
        //
    }


}
