<?php

use App\Http\Controllers\MaterialController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;


//###################################################PEDIDOS#####################################333
Route::get('/', function () {
    $ControllerPedidos=new PedidoController();
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
    $pedidos=$ControllerPedidos->Listar();
    return view('pedidos.mostrar',compact('pedidos','materiales'));
})->name('index');

Route::get('/pedidos/clientes',function(Request $request){
    $ControllerPedidos=new PedidoController();
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
    $pedidos=$ControllerPedidos->BuscarCliente($request->buscarcliente);
    return view('pedidos.mostrar',compact('pedidos','materiales'));

})->name('pedidos.clientes');

Route::get('/pedidosprueba',function(Request $request){
    $ControllerPedidos=new PedidoController();
    return $ControllerPedidos->BuscarCliente($request->buscarcliente);
})->name('pedidos.prueba');

Route::get('/pedidos/pendientes', function () {
    $ControllerPedidos=new PedidoController();
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
    $pedidos=$ControllerPedidos->ListarPendientes();
    return view('pedidos.mostrar',compact('pedidos','materiales'));
})->name('pedidos.pendientes');

Route::get('pedidos/{id}/details',function($id){//Mostrar pedido en particular
    $ControllerPedidos=new PedidoController();
    $ControllerMaterial=new MaterialController();
    $pedido=$ControllerPedidos->Buscar($id);
    $materialElegido=$ControllerMaterial->Buscar($pedido->material_id);
    $materiales=$ControllerMaterial->Listar();
    return view('pedidos.detalles',compact('pedido','materiales','materialElegido'));
})->name('pedidos.details');

Route::get('pedidos/create',function(){//Mostrar vista de pedido
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
    return view('pedidos.create',compact('materiales'));
})->name('pedidos.create');

Route::post('pedidos',function(Request $request){//Crear un pedido
    $request->validate([
        'detalles'=>'max:255',
        'cliente'=>'required',
        'detalles'=>'required',
        'fechaEntrega'=>'required',
        'valor'=>'integer|min:0',
        'cantidad'=>'integer|min:0',
    ]);
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->Crear($request);
    if($res)
    {return redirect()->route('index')->with('info','Pedido creado exitosamente');}
    else
    return redirect()->route('index')->with('info','El pedido no se puedo crear exitosamente');
})->name('pedidos.store');

Route::put('pedidos/actualizar',function(Request $request){//Actualizar las observaciones del pedido
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->Actualizar($request);
    if($res)
    {return redirect()->route('index')->with('info','Pedido actualizado exitosamente');}
    else
    {return redirect()->route('index')->with('info','El pedido no pudo actualizarse');}
})->name('pedidos.actualizar');


Route::put('pedidos/{id}/nuevoEstado',function($id){//Cambiar de estado a un pedido
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->CambiarEstado($id);
    return redirect()->route('index')->with('info','Pedido actualizado exitosamente');
})->name('pedidos.nuevoEstado');


Route::get('/pedidos/administrar',function(){//Mostrar panel de administracion
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Listar();
    return view('pedidos.admin',compact('pedidos'));
})->name('pedidos.control');

Route::delete('/pedidos/eliminar/{id}',function($id){//Eliminar pedido
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Eliminar($id);
    return redirect()->route('pedidos.control')->with('info','Pedido eliminado correctamente');
})->name('pedidos.eliminar');


//##############################################MATERIALES###################################

Route::get('materiales',function(){
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
return view('materiales.view',compact('materiales'));
})->name('materiales');

Route::post('materiales/crear',function(Request $request){
    $ControllerMateriales=new MaterialController();
    $res=$ControllerMateriales->Crear($request);
    if($res)
    {return redirect()->route('index')->with('info','Material creado exitosamente');}
    else
    {return redirect()->route('index')->with('info','El pedido no pudo actualizarse');}

})->name('materiales.create');

##################COSTOS############################


Route::get('calculadora,',function(){
    $ControllerMateriales=new MaterialController();
    $materiales=$ControllerMateriales->Listar();
    return view('costos.calculadora',compact('materiales'));
})->name('costos.calculadora');


Route::post('calculadora/res',function(Request $request){
    $request->validate([
        'tiempo'=>'required|integer|min:0',
        'altura'=>'required|integer|min:0',
        'base'=>'required|integer|min:0',
    ]);
    $ControllerMateriales=new MaterialController();
    $material=$ControllerMateriales->Buscar($request->tipoMadera);
    $res=800*$request->tiempo+$request->base*$request->altura*$material->multiplicador;
    return redirect()->route('costos.calculadora')->with('info',"El costo es: $".$res);
})->name('costos.calcular');
