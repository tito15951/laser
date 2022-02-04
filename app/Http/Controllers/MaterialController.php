<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Exception;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function Listar()
    {
        $materiales=Material::all();
        return $materiales;
    }

    public function Buscar($id)
    {
        $material=Material::findOrFail($id);
        return $material;
    }

    public function Crear(Request $request)
    {
        $nuevoMaterial=new Material();
        $nuevoMaterial->nombre=$request->input('nombre');
        $nuevoMaterial->valor=$request->input('valor');
        $nuevoMaterial->multiplicador=0;
        $nuevoMaterial->save();
        return true;

    }
}
