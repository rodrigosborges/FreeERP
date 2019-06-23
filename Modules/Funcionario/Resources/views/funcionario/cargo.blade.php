@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    <form id="form" action="{{ $data['url'] }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <strong><h6 class="mt-5 mb-3">Cargos</h6></strong>
        <hr>
        @if($data['model'])
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped">
                        <thead class="thead thead-dark">
                            <tr>
                                <th>Cargo</th>
                                <th>Data de Entrada</th>
                                <th>Data de Saída</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data['model']->cargos as $cargo)
                        <tr>   
                            <td>{{ $cargo->nome }}</td>
                            <td>{{ date("d/m/Y", strtotime($cargo->pivot->data_entrada)) }}</td>
                            <td>{{ $cargo->pivot->data_saida ? enToBrDate($cargo->pivot->data_saida) : 'X' }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cargo_id" class="control-label">Cargo Atual</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">work</i>
                            </span>
                        </div>
                        <select required name="cargo[cargo_id]" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($data['cargos'] as $item)
                                <option value="{{ $item->id }}" {{ old('cargo.cargo_id', '') }}> {{ $item->nome }} </option>
                            @endforeach 
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="data_admissao" class="control-label">Data de entrada</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">date_range</i>
                            </span>
                        </div>
                        <input required type="text" placeholder="00/00/0000" name="cargo[data_entrada]" id="data_admissao" class="form-control data" value="{{ old('cargo.data_entrada', '') }}">
                    </div>
                    <span class="errors"> {{ $errors->first('cargo.data_entrada') }} </span>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">{{$data['button']}}</button>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/form.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/helpers.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/views/funcionario/validations.js')}}"></script>
@endsection