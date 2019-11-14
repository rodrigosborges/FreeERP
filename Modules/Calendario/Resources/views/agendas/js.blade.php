<script type="text/javascript">
    $(function () {
        $('.table').DataTable({
            "lengthChange": false,
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });

        $('#formAgDel button').on('click', function () {
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente mover a agenda para a lixeira?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if(result == true){
                        $('#formAgDel').submit();
                    }
                }
            });
        });
        $('#formAgDelPerm button').on('click', function () {
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir definitivamente a agenda?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if(result == true){
                        $('#formAgDelPerm').submit();
                    }
                }
            });
        });
        $('#formAgRec button').on('click', function () {
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente restaurar a agenda?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if(result == true){
                        $('#formAgRec').submit();
                    }
                }
            });
        });
        $('tr.agendas').hover(
            function () {
                $(this).find('a.novo-evento').removeClass('invisible');
            },
            function () {
                $(this).find('a.novo-evento').addClass('invisible');
            });

        $('.lixeira').on('click', function () {
            $('.trashed').toggle(function () {
                if ($(this).is(':visible')) {
                    $('.lixeira').removeClass('btn-secondary').addClass('btn-dark');
                    $('.vazio').hide();
                } else {
                    $('.lixeira').removeClass('btn-dark').addClass('btn-secondary');
                    $('.vazio').show();
                }
            });

        });

        $('a.deletar-compartilhamento').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir o compartilhamento de agenda?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.deletar-compartilhamento').attr('href');
                    }
                }
            });
        });

        $('a.aprovar-compartilhamento').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente aprovar o compartilhamento de agenda?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.aprovar-compartilhamento').attr('href');
                    }
                }
            });
        });

        $('a.revogar-compartilhamento').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente revogar o compartilhamento de agenda?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.revogar-compartilhamento').attr('href');
                    }
                }
            });
        });
    });
</script>
