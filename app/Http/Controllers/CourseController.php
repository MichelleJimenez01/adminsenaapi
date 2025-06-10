<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StorecourseRequest;
use App\Http\Requests\UpdatecourseRequest;

class CourseController extends Controller
{
     /**
     * Lista todos los cursos registrados.
     */
    public function index()
    {
        $courses = Course::included()->get();
        return response()->json($courses);
    }

    /**
     * Registra un nuevo curso.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|max:50',
            'day' => 'required|max:50',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course = Course::create($request->all());

        return response()->json($course);
    }

    /**
     * Muestra un curso por su ID.
     */
    public function show($id)
    {
        $course = Course::included()->findOrFail($id);
        return response()->json($course);
    }

    /**
     * Actualiza los datos de un curso.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_number' => 'required|max:50',
            'day' => 'required|max:50',
            'area_id' => 'required|exists:areas,id',
            'training_center_id' => 'required|exists:training_centers,id',
        ]);

        $course->update($request->all());

        return $course;
    }

    /**
     * Elimina un curso.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return $course;
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course $course)
    {
        //
    }

    
}
