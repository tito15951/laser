@extends('layouts.main')
@section('titulo')
Nuevo pedido
@endsection
@section('contenido')
                    <div class="card-body">
                        <form action="{{route('pedidos.actualizar')}}" method="POST">

                            <div class="form-group">
                                <input type="text" class="form-control" style="display: none" name="id" value={{$pedido->id;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Numero de pedido:</label>
                                <input type="text" class="form-control" name="codigo" disabled value={{$pedido->id;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Estado:</label>
                                <input type="text" class="form-control" name="estado" disabled value={{$pedido->estado;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Cliente:</label>
                                <input type="text" class="form-control" name="cliente" value={{$pedido->cliente;}}>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Valor</label>
                                    <input type="number" class="form-control" autocomplete="off" name="valor" value={{$pedido->valor;}}>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipo de madera</label>
                                    <select class="form-control" name="tipoMadera">
                                        @foreach ($materiales as $material)
                                            @if($materialElegido->id==$material->id)
                                                <option selected value="{{$material->id}}">{{$material->nombre}}</option>
                                            @else
                                                <option value="{{$material->id}}">{{$material->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Detalles:</label><br>
                                <div class="form-floating">
                                    <textarea class="form-control" name="observaciones">{{$pedido->detalles;}}</textarea>
                                </div>

                            <!---<div class="form-group">
                                <label for="">Imagen:</label><br>
                                <div class="form-floating">
                                    <img width="80%" height="10%"src='imagenes\"{{$pedido->id}}".jpg'>
                                    <img width="80%" height="10%" src='\public\storage\51.jpg'>
                                </div>
                            </div>--->

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Fecha de entrega:</label>
                                    <input type="date" class="form-control" name="fechaEntrega" value={{$pedido->fechaEntrega}}>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Cantidad:</label>
                                    <input type="number" class="form-control" autocomplete="off" value={{$pedido->cantidad}} name="cantidad">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            @csrf
                            @method('put')
                        </form>
                            <div class="row">
                                <div class="col-2">
                                @if($pedido->estado!='entregado')
                                    <a href="javascript: document.getElementById('nuevoEstado-{{ $pedido->id }}').submit()" class="btn btn-warning btn-sm">Cambiar de estado</a>
                                @endif
                                    <a href="{{route('index')}}" class="btn btn-danger btn-sm">Atras</a>
                                </div>
                            </div>
                            <br><br>
                            <form id="nuevoEstado-{{ $pedido->id }}" action="{{route('pedidos.nuevoEstado',$pedido->id)}}" method="POST" class="formulario-eliminar">
                                @method('put')
                                @csrf
                            </form>

                            <br>
                    </div>
                    @endsection


                    @section('js')
                    <!---<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        $('formulario-eliminar').submit(function(e){
                        e.preventDefault();
                        Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();}
                        })
                        });

                        </script>--->
                        @endsection

