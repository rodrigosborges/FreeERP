<div class="row form-group">
    <div class="col-12 ">
        <label for="">Selecione a mão de obra</label>
        <select style="width:100%;" name="servicos[]" id="valor_servico" class="form-control multi-select"
            multiple="true">
            @foreach($servicos as $servico)

            <option data-valor="{{ $servico->valor }}" value="{{$servico->id}}">{{ $servico->nome }} |
                {{ $servico->valor }}</option>


            @endforeach


        </select>
    </div>
</div>