@extends('template')

@section('content')
<div class="container">
    <form action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-header">
                <h5>{{$data['title']}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="nome" class="control-label">Nome do cargo</label>
                        <input type="text" placeholder="Nome" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
                        <label class="errors"> {{ $errors->first('nome') }} </label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success" type="submit">{{$data['button']}}</button>
            </div>
        </div>
    </form>
</div>
<script src="{{ Module::asset('funcionario:js/cargo.js') }}"></script>

@endsection