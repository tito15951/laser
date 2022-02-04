@extends('layouts.main')
@section('titulo')
Materiales
@endsection
@section('contenido')
                    <div class="card-body">
                        @if(session('info'))
                            <div class="alert alert-success">{{session('info')}}</div>
                        @endif
                        <form method="POST" action="">
                            <table class="table table-hovwe table-sm">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Multiplicador</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>
                                    @foreach ($materiales as $material)
                                    <tr>
                                        <td><input type="text" class="form-control" placeholder='Nombre' name="nombre" autocomplete="off" value="{{$material->nombre}}"></td>
                                        <td><input type="text" class="form-control" placeholder='Nombre' name="nombre" autocomplete="off" value="{{$material->multiplicador}}"></td>
                                        <td><input type="text" class="form-control" placeholder='Nombre' name="nombre" autocomplete="off" value="{{$material->cantidad}}"></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <form>
                                        <td><input type="text" class="form-control" placeholder='Nombre' name="nombre" autocomplete="off"></td>
                                        <td><input type="number" class="form-control" placeholder='Multiplicador' name="multiplicador" autocomplete="off"></td>
                                        <td><input type="number" class="form-control" placeholder='Cantidad' name="candidad" autocomplete="off"></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    <div>
                        <a href="{{route('index')}}" class="btn btn-success btn-sm">Atras</a>
                    </div>
                    </div>
@endsection

