<?php

namespace App\Http\Controllers;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
      /**
     * Muestra todos los registros de Area.
     * Se usa un scope 'included' si existe para cargar relaciones opcionales.
     */
    public function index()
    {
        $areas = Area::included()->get(); // Si tienes relaciones predefinidas
        return response()->json($areas);
    }

    /**
     * Guarda un nuevo registro en la tabla areas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario/API
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Crea una nueva área con los datos validados
        $area = Area::create($request->all());

        // Retorna la nueva área en formato JSON
        return response()->json($area);
    }

    /**
     * Muestra un área específica por ID.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Busca un área por ID, lanza 404 si no existe
        $area = Area::included()->findOrFail($id);

        // Retorna el área encontrada
        return response()->json($area);
    }

    /**
     * Actualiza un área específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        // Validación de los campos requeridos
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Actualiza el área con los datos nuevos
        $area->update($request->all());

        // Devuelve la entidad actualizada
        return $area;
    }

    /**
     * Elimina un área específica.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        // Elimina el área
        $area->delete();

        // Devuelve el área eliminada
        return $area;
    }
}
