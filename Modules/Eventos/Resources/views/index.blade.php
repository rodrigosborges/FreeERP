@extends('eventos::layouts.template')
@section('title', 'Eventos')

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <h1 style="text-align: center;">Próximos eventos</h1>
            <table>
                <thead>
                    <tr>
                      <th>id</th>
                      <th>nome</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                      <td>{{$evento->id}}</td>
                      <td>{{$evento->nome}}</td>
                   </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection