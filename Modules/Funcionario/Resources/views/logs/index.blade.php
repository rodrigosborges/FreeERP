@extends('funcionario::template')

@section('title','Logs')

@section('body')
    <form id="form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mensagem</label>
                    <input id="search-input" class="form-control" type="text" name="mensagem" />
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label>De</label>
                    <input id="search-input" class="form-control" data-mask="00/00/0000" type="text" name="de" />
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label>Até</label>
                    <input id="search-input" class="form-control" data-mask="00/00/0000" type="text" name="ate" />
                </div>
            </div>
            <div class="col-md-1">
                <div class="input-group mt-4">
                    <i id="search-button" class="btn btn-info material-icons ml-2 mt-2">search</i>
                </div>
            </div>
        </div>
    </form>
    <div id="logs">
    </div>
@endsection

@section('script')

<script src="{{Module::asset('funcionario:js/views/logs/index.js')}}"></script>

@endsection