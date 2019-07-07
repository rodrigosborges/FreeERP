@extends('funcionario::template')

@section('title')
    {{$data['title']}}
@endsection

@section('body')

    <div class="row">
        <div class="col-md-8">
            <form id="form">
                <div class="form-group">
                    <div class="input-group">
                        <input id="search-input" class="form-control" type="text" name="pesquisa" />
                        <i id="search-button" class="btn btn-info material-icons ml-2">search</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/funcionario/index.js')}}"></script>
@endsection