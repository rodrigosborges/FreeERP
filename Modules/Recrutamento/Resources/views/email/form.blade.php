@extends('template')
@section('content')
    
    <div class="card col-md-6 offset-md-3">
    <div class="card-header d-flex justify-content-center"><h3>{{$data['title']}}</h3></div>
    <div class="card-body">
              
        <form action="{{ $data['url'] }}" method="POST">
            {{ csrf_field() }}
            @if($data['model'])
                @method('PUT')
            @endif 

            <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">    
                    <label for="email" class="control-label">Email</label>
                    <input type="email" required name="email" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
                    <label class="errors"> {{ $errors->first('email') }} </label>
                </div>
            </div>
    </div>
    </div>
    <div class="card-footer">
        <div class="form-row">
            <a class="btn btn-light " href="{{ $data['voltar'] }}"> Voltar</a>
            <button type="submit" class="btn btn-success "> {{ $data['button'] }} </button>
        </div>
        </form>
    </div>
    </div>

@endsection
