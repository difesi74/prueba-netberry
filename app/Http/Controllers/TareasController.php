<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::with('categorias')->get();

        foreach($tareas as $tarea) {
            $categorias = $tarea['categorias'];
            foreach ($categorias as $categoria) {
                $categoria['nombre'] = mb_strtolower($categoria['nombre']);
            }
        }

        return response()->json($tareas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categorias' => 'array'
        ]);

        $categorias = [];
        if ($request->has('categorias')) {
            $categorias = $request->categorias;
            $validarCategorias = $this->validarCategorias($categorias);
            if (!$validarCategorias['res']) {
                return response()->json([
                    'message' => $validarCategorias['message']
                ], 422);
            }
        }

        $tarea = new Tarea();
        $tarea->nombre = $request->nombre;
        $tarea->save();

        foreach ($categorias as $categoriaId) {
            $tarea->categorias()->attach($categoriaId);
        }

        return response()->json([
            'message' => 'Tarea añadida correctamente'
        ]);
    }

    private function validarCategorias($categorias)
    {
        $message = '';
        $res = true;

        foreach ($categorias as $categoriaId) {
            if (!Categoria::find($categoriaId)) {
                $res = false;
                $message .= ($message ? '' : 'Categorías no existentes: ') . ($message ? ', ' : '') . $categoriaId;
            }
        }

        return compact('res', 'message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $categorias = $tarea->categorias();

        foreach ($categorias as $categoria) {
            $categorias->detach($categoria['id']);
        }

        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada correctamente'
        ]);
    }
}
