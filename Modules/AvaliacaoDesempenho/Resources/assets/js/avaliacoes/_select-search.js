$(document).on('keyup keydown', '#questoes', function() {
  if ($("#questoes").val() == '') {
    $('#questaoCard').addClass('hidden')
  }
})

$(document).ready(function() {

    const _token = $('#token').val()

    var options = {

        url: function(phrase) {
            return 'http://localhost/tcc/public/avaliacaodesempenho/ajax/field'
        },

        getValue: function(element) {
            return element.enunciado + ' | ' + element.categoria.nome;
        },

        placeholder: "Pesquise a questão por enunciado ou categoria...",

        ajaxSettings: {
            method: "POST",
            dataType: "json",
            data: {
                _token: _token,
                table: 'questao'
            },
        },

        preparePostData: function(data) {
            data.phrase = $("#questoes").val()
            return data;
        },

        list: {
            match: {
                enabled: true
            },
            onSelectItemEvent: function() {
                populateCard($("#questoes").getSelectedItemData())
            }
        },

        requestDelay: 100
    }
    $("#questoes").easyAutocomplete(options);
})

function populateCard(data) {

    $('#questaoCard').html(`

        <div class='card'>

            <div class='card-header'>
                <b>Categoria: ${data.categoria.nome}</b>
            </div>

            <div class='card-body'>
                <b>Enunciado: ${data.enunciado}</b>
                <br>
                <b>Alternativas:</b>
                <ul class='alternativas'>
                    <li>a) - ${data.opt1}</li>
                    <li>b) - ${data.opt2}</li>
                    <li>c) - ${data.opt3}</li>
                    <li>d) - ${data.opt4}</li>
                    <li>e) - ${data.opt5}</li>
                </ul>
            </div>

            <div class='card-footer'>
                <button type='button' class='btn btn-primary btn-sm float-right save-card' onclick='salvarQuestao(${data.id},"${data.enunciado}")'>Adicionar</button>
            </div>

        </div>
    `)

    $('#questaoCard').removeClass('hidden')
}

function salvarQuestao(id, enunciado) {

  $('#input-questoes').append(`

    <div class='row input-questao'>
      <input class='name-questao' type='hidden' name='avaliacao[questoes][]' value='${id}'></input>

      <div>
        <h6 class='questao-count'></h6>
        <p><b>Enunciado: </b>${enunciado}</p>
      </div>

      <button type='button' class='btn btn-danger btn-sm float-right'><i class="material-icons md-18">close</i>
    </div>

  `)

  recontarQuestoes()
}

function excluirQuestao(id) {

  $(`#input-questoes :input[name="avaliacao[questoes][${id}]"]`).parent().remove()

  recontarQuestoes()
}

function recontarQuestoes() {
  var count1 = 0
  var count2 = 0

  $('.questao-count').each(function() {
    $(this).html(`Questão ${count1+1}`)
    count1++
  })

  $('.name-questao').each(function() {
    $(this).attr('name', `avaliacao[questoes][${count2}]`)
    $(this).siblings('button').attr('onclick', `excluirQuestao(${count2})`)
    count2++
  })
}
