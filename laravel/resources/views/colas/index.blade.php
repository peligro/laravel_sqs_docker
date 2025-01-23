@extends('../layouts.frontend')
@section('title','Home')
@section('content')
<div class="container">
    <h1>Ejemplo Qeues - Colas Laravel</h1>
    <div class="row">
        <div class="table-responsive">
            <table id="tabla" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($datos as $dato)
                      <tr>
                        <td>{{$dato->id}}</td>
                        <td>{{$dato->mensaje}}</td>
                        <td>{{$dato->estado}}</td>
                        <td>{{$dato->fecha}}</td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
