<div class="row form-group">
    <div class="col-12 ">
        <label for="">Selecione a mão de obra</label>
        <select style="width:100%;" name="servicos[]" id="valor_servico" class="form-control multi-select"
            multiple="true">
            @if(count($itemServico) != 0)
                @foreach($servicos as $servico)

                    @foreach($itemServico as $item)
                        <?php 
                            $servicoId = $item->idMaoObra;
                        ?>
                        @if ($servicoId == $servico->id)
                        <option data-valor="{{ $servico->valor }}" selected value="{{$servico->id}}">{{ $servico->nome }} |
                            {{ $servico->valor }}</option>
                        @else
                        <option data-valor="{{ $servico->valor }}" value="{{$servico->id}}">{{ $servico->nome }} |
                            {{ $servico->valor }}</option>
                        @endif

                    @endforeach

                @endforeach
            @else
                @foreach($servicos as $servico)
                    <option data-valor="{{ $servico->valor }}" value="{{$servico->id}}">{{ $servico->nome }} |
                    {{ $servico->valor }}</option>
                @endforeach
            @endif
            


        </select>
    </div>
</div>