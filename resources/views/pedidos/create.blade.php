@extends('layouts.main')
@section('titulo')
Nuevo pedido
@endsection
@section('contenido')
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('pedidos.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Cliente</label>
                                    <input type="text" class="form-control" name="cliente">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Seleccione el material</label>
                                    <select class="form-control" name="tipoMadera">
                                        @foreach ($materiales as $material)
                                            <option value='{{$material->id}}'>{{$material->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" autocomplete="off" name="valor" value="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" autocomplete="off" value="1" name="cantidad">
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="">Detalles</label>
                                <textarea class="form-control" name="detalles"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Fecha de entrega</label>
                                    <input type="date" class="form-control" autocomplete="off" name="fechaEntrega">
                                </div>

                            </div>
                            <!---<div class="form-group">
                                <label for="">Adjuntar imagen</label><br>
                                <input id="archivo" name="archivo" type="file" accept="image/png, image/jpeg">
                            </div>--->
                            <div>

                            <button type="submit" class="btn btn-primary">Finalizar</button>
                            <a href="{{route('index')}}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
@endsection
