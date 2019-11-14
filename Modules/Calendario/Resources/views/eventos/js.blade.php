<script type="text/javascript">
    $(function () {
        $('.table').DataTable({
            "lengthChange": false,
            "columnDefs": [
                { "orderable": false, "targets": 4 }
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });

        $('a.deletar-evento').on('click', function (event) {
            event.preventDefault();
            var url = this.href;
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = url;
                    }
                }
            });
        });

        $('a.deletar-convite').on('click', function (event) {
            event.preventDefault();
            var url = this.href;
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir o convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = url;
                    }
                }
            });
        });

        $('a.aceitar-convite').on('click', function (event) {
            event.preventDefault();
            var url = this.href;
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente aceitar o convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = url;
                    }
                }
            });
        });

        $('a.revogar-convite').on('click', function (event) {
            event.preventDefault();
            var url = this.href;
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente revogar o aceite do convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = url;
                    }
                }
            });
        });
    });
</script>
