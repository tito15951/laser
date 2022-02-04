<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laser</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('index')}}"><h1>Laser</h1></a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('costos.calculadora')}}">Calculadora de costos</a>
                </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('materiales')}}">Materiales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('pedidos.create')}}">Nuevo pedido</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('pedidos.control')}}">Administrar pedidos</a>
              </li>

          </div>
        </div>
      </nav>
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            @yield('titulo')
                        </h1>

                        <!---<div class="row">
                           <div class="offset-7 col-1">
                                <a href="{{route('pedidos.create')}}" class="btn btn-primary btn-sm float-right">Nuevo pedido</a>
                           </div>
                           <div class="offset-1 col-1">
                                <a href="{{route('materiales')}}" class="btn btn-primary btn-sm float-right">Materiales</a>
                            </div>
                            <div class="offset-1 col-1">
                                <a href="{{route('costos.calculadora')}}" class="btn btn-primary btn-sm float-right">Calculadora de costos</a>
                            </div>--->
                        </div>
                    </div>
                    @yield('contenido')

                </div>
            </div>
        </div>
    </div>

    @yield('js')
</body>
</html>
