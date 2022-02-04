@extends('layouts.main')
@section('titulo')
Administración
@endsection
@section('contenido')
                    <div class="card-body">
                        @if(session('info'))
                            <div class="alert alert-success">{{session('info')}}</div>
                        @endif
                    <table class="table table-hovwe table-sm">
                        <thead>
                            <th style="width:35px" >Pedido</th>
                            <th>Cliente</th>
                            <th style="width:110px" >Detalles</th>
                            <th>Fecha entrega</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>

                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->cliente}}</td>
                                <td>{{Str::limit($pedido->detalles,20)."..."}}</td>
                                <td>{{$pedido->fechaEntrega}}</td>
                                <td>
                                    <a href="javascript: document.getElementById('eliminar-{{ $pedido->id }}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                    <form id="eliminar-{{ $pedido->id }}" action="{{route('pedidos.eliminar',$pedido->id)}}" method="POST">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div >
                        <a href="{{route('index')}}" class="btn btn-success btn-sm">Atras</a>
                    </div>
                    </div>
@endsection

