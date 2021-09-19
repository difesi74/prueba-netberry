<?php

namespace App\Http\Controllers;

use App\Http\Resources\TareaResource;
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
        return TareaResource::collection(Tarea::with('categorias')->get());
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
            $categorias = array_unique($request->categorias);
            $validarCategorias = $this->validarCategorias($categorias);
            if (!$validarCategorias['ok']) {
                return response()->json(['res' => $validarCategorias['mensaje']], 422);
            }
        }

        $tarea = new Tarea();
        $tarea->nombre = $request->nombre;
        $tarea->save();

        foreach ($categorias as $categoriaId) {
            $tarea->categorias()->attach($categoriaId);
        }

        return response()->json([
            'res' => 'Tarea añadida correctamente'
        ]);
    }

    private function validarCategorias($categorias)
    {
        $mensaje = '';
        $ok = true;

        foreach ($categorias as $categoriaId) {
            if (!Categoria::find($categoriaId)) {
                $ok = false;
                $mensaje .= ($mensaje ? '' : 'Categorías no existentes: ') . ($mensaje ? ', ' : '') . $categoriaId;
            }
        }

        return compact('mensaje', 'ok');
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
            'res' => 'Tarea eliminada correctamente'
        ]);
    }
}
