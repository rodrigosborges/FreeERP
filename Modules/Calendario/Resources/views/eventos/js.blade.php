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
                        window.location = '{{route('eventos.deletar', $evento->id)}}';
                    }
                }
            });
        });
    });
</script>
