@extends('layouts.main')
@section('titulo')
Calculadora de costos
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
<form method="POST" action="{{route('costos.calcular')}}">
    @method('post')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmail">Tiempo</label>
                <input type="number" class="form-control" id="tiempo" name="tiempo" placeholder="Minutos">
            </div>
        </div>
        <div class="col-md-6">
            <label for="">Seleccione el material</label>
            <select class="form-control" name="tipoMadera">
                @foreach ($materiales as $material)
                    <option value='{{$material->id}}'>{{$material->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputPassword">Base</label>
                <input type="number" class="form-control" id="base" name="base" placeholder="cm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputPassword">Altura</label>
                <input type="number" class="form-control" id="altura" name="altura" placeholder="cm">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Calcular</button>
    @if(session('info'))
        <div class="alert alert-success">{{session('info')}}</div>
    @endif
</form>
@endsection
