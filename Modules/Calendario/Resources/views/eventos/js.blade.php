<script type="text/javascript">
    $(function () {
        $('a.deletar-evento').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.deletar-evento').attr('href');
                    }
                }
            });
        });

        $('a.deletar-convite').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente excluir o convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.deletar-convite').attr('href');
                    }
                }
            });
        });

        $('a.aceitar-convite').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente aceitar o convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.aceitar-convite').attr('href');
                    }
                }
            });
        });

        $('a.revogar-convite').on('click', function (event) {
            event.preventDefault();
            bootbox.confirm({
                title: 'Confirmar ação',
                message: 'Deseja realmente revogar o aceite do convite para o evento?',
                onEscape: true,
                backdrop: true,
                locale: 'br',
                callback: function (result) {
                    if (result == true) {
                        window.location = $('a.revogar-convite').attr('href');
                    }
                }
            });
        });
    });
</script>
