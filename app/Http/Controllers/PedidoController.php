<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
//use app\Http\Controllers\ImageController.php;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class PedidoController extends Controller
{
    public function Listar()
    {
        $pedidosPendientes=$this->ListarPendientes();
        $pedidosCompletos=$this->ListarCompletos();
        $pedidosCortados=$this->ListarCortados();
        $pedidos=$pedidosPendientes->concat($pedidosCortados)->concat($pedidosCompletos);
        return $pedidos;
    }
    public function ListarPendientes()
    {
        $pedidos=Pedido::all()->sortBy('fechaEntrega')->where('estado','=','pendiente');
        return $pedidos;
    }
    public function ListarCortados()
    {
        $pedidos=Pedido::all()->sortBy('fechaEntrega')->where('estado','=','cortado');
        return $pedidos;
    }

    public function ListarCompletos()
    {
        $pedidos=Pedido::all()->sortBy('fechaEntrega')->where('estado','=','entregado');
        return $pedidos;
    }


    public function BuscarCliente($nombre)
    {
        $pedido=Pedido::where('cliente','LIKE',"%{$nombre}%")->get();
        return $pedido;
    }
    public function Buscar($codigo)
    {
        $pedido=Pedido::findOrFail($codigo);
        return $pedido;
    }

    public function CambiarEstado($id)
    {
        $pedido=Pedido::findOrFail($id);
        if($pedido->estado=='pendiente')
            {$pedido->estado='cortado';}
        else
            {$pedido->estado='entregado';}
        $pedido->save();
    }


    public function Actualizar(Request $request)
    {
        try{
            $fecha =new \DateTime();
            //return $request->input('id');
            $pedido=Pedido::findOrFail($request->id);
            $pedido->cliente=$request->cliente;
            $pedido->material_id=$request->tipoMadera;
            $pedido->detalles=$request->observaciones;
            $pedido->valor=$request->valor;
            $pedido->cantidad=$request->cantidad;
            //$pedido->material_id=$request->input('tipoMadera');
            $pedido->fechaEntrega=$fecha->format($request->fechaEntrega);
            $pedido->save();
            return true;}
        catch(Exception $e)
            {return false;}

    }
    public function Eliminar($id)
    {
        $pedido=Pedido::findOrFail($id);
        $pedido->estado='eliminado';
        $pedido->delete();
    }

    public function Crear(Request $request)
    {

        //try{
            $fecha =new \DateTime();
            $nuevoPedido=new Pedido();
            $nuevoPedido->cliente=$request->input('cliente');
            $nuevoPedido->detalles=$request->input('detalles');
            $nuevoPedido->valor=$request->input('valor');
            $nuevoPedido->cantidad=$request->input('cantidad');
            $nuevoPedido->material_id=$request->input('tipoMadera');
            $nuevoPedido->fechaEntrega=$fecha->format($request->input('fechaEntrega').' '.$request->input('horaEntrega'));

            //$nuevoPedido->fechaEntrega=$request->input('fechaEntrega').$request->input('horaEntrega');
            $nuevoPedido->estado='pendiente';
            $nuevoPedido->save();
            return true;
            /*$id_pedido=$nuevoPedido->id;//Guardar imagen
            if($_FILES["archivo"]["error"]>0)
                {echo "error al cargar archivo";}
            else
                {
                    $ruta='C:\\laragon\\www\\laser\\public\\imagenes\\';
                    //$ruta2='imagenes/'.$id_pedido.'/';
                    //$ruta='imagenes\\'.$id_pedido;
                    //$rutaAbsoluta=str_replace("/","\\",$_SERVER['DOCUMENT_ROOT']);
                    $archivo=$ruta.$id_pedido.'.jpg';
                    //$archivo=$ruta.$_FILES["archivo"]["name"];
                    //return $ruta.' cambio '.$ruta2.' fin '.$rutaAbsoluta.' root ';

                    $resultado=@move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo);
                    return $resultado;
                }*/

           //}
        //catch(Exception $e)
          //  {return false;}
    }
}
