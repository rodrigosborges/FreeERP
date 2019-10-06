@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <!-- <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/index.css')}}" rel="stylesheet"> -->
@endsection

@section('content')

    <div>

        <pre>
            {{ $avaliacao }}
        </pre>

    </div>

@endsection

@section('script')
    <!-- <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/index.js')}}"></script> -->
@endsection