{{Form::label('Aparelho')}}
<div class="form-row">
    <div class="col-md-4 mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">device_unknown</i>
                </span>
            </div>
            {{Form::text("aparelho[numero_serie]", $value=null,array('id' => 'aparelho.numero_serie','class' => 'form-control','placeholder'=>'Numero Série'))}}

        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">device_unknown</i>
                </span>
            </div>
            {{Form::text("aparelho[tipo_aparelho]", $value=null ,array('class' => 'form-control','id' =>'aparelho.tipo_aparelho','placeholder'=>'Tipo de Aparelho'))}}
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">device_unknown</i>
                </span>
            </div>
            {{Form::text("aparelho[modelo]", $value=null ,array('class' => 'form-control','id' =>'aparelho.modelo','placeholder'=>'Modelo'))}}
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">device_unknown</i>
                </span>
            </div>
            {{Form::text("aparelho[marca]", $value=null ,array('class' => 'form-control','id' =>'aparelho.marca','placeholder'=>'Marca'))}}
        </div>
    </div>

    <div class="col-md-8 mb-3 form-control acessorios">

        <div class="input-group">

            <div class="input-group-prepend">

                @if(isset($data['model']))
                @foreach($data['acessorios'] as $acessorio)
                <span class='mr-1 p-2 badge badge-primary'>{{$acessorio}} <span class='ml-2 remover-badge'> x </span> </span>
                @endforeach
                @endif
            </div>
            {{Form::text("aparelho[acessorios]", $value=null ,array('style' => 'border:none','id' =>'acessorios','placeholder'=>'Acessórios'))}}
        </div>
        <small class='text-muted'> Pressione enter para adicionar um acessório </small>
    </div>


</div>