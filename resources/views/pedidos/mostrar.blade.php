@extends('layouts.main')
@section('titulo')
Pedidos
@endsection
@section('contenido')
                    <div class="card-body">
                        @if(session('info'))
                            <div class="alert alert-success">{{session('info')}}</div>
                        @endif
                        <form method="GET" action="{{route('pedidos.clientes')}}">
                        <div class="row">
                            @method('get')
                            @csrf
                            <div class="offset-md-7 col-md-2">
                                <label for="">Buscar por cliente</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="buscarcliente">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>

                        </div>
                    </form>
                    <table class="table table-hovwe table-sm">
                        <thead>
                            <th style="width:35px" >Pedido</th>
                            <th>Cliente</th>
                            <th style="width:110px" >Detalles</th>
                            <th>Valor</th>
                            <th>Tipo madera</th>
                            <th>Fecha entrega</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->cliente}}</td>
                                <td>{{Str::limit($pedido->detalles,20)."..."}}</td>
                                <td>{{$pedido->valor}}</td>
                                @foreach ($materiales as $material)
                                    @if($material->id==$pedido->material_id)
                                        <td>{{$material->nombre}}</td>
                                    @endif
                                @endforeach
                                <td>{{$pedido->fechaEntrega}}</td>
                                <td>
                                @if($pedido->estado=='pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    @if($pedido->estado=='cortado')
                                        <span class="badge bg-info text-dark">Cortado</span>
                                    @else
                                        <span class="badge bg-success">Entregado</span>
                                    @endif
                                @endif
                                </td>
                                <td>
                                    <a href="{{route('pedidos.details',$pedido->id)}}" class="btn btn-warning btn-sm">Ver detalles</a>
                                    <!---@if($pedido->estado!='entregado')
                                    <a href="javascript: document.getElementById('nuevoEstado-{{ $pedido->id }}').submit()" class="btn btn-danger btn-sm">Actualizar</a>
                                        <form id="nuevoEstado-{{ $pedido->id }}" action="{{route('pedidos.nuevoEstado',$pedido->id)}}" method="POST">
                                            @method('put')
                                            @csrf
                                        </form>
                                    @endif--->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div >
                        <a href="{{route('pedidos.pendientes')}}" class="btn btn-success btn-sm">Ver todos los pendientes</a>
                        <a href="{{route('index')}}" class="btn btn-success btn-sm">Ver todo</a>
                    </div>
                    </div>



@endsection

