<h1>Buscar NFe</h1>
<span><p class="retorno_chave"></p></span>
<span><p class="retorno_manifesta"></p></span>
<span><p class="retorno_download"></p></span>
<script>
    function buscar_chave() {
        $.ajax({
            type: 'POST',
            data: '&acao=buscar_chave',
            url: 'php/buscar_chave.php',
            beforeSend: load_in(),
            success: function (data) {
                var data_return = jQuery.parseJSON(data);
                if(data_return.type === 'success'){
                    $(".retorno_chave").html(data_return.msg);
                    manifesto();
                }else{
                    $(".retorno_chave").html('Erro ao processar chave!');
                }
                load_out();
            }
        });
    }
    function manifesto() {
        $.ajax({
            type: 'POST',
            data: '&acao=buscar_manista',
            url: 'php/manifesta.php',
            beforeSend: load_in(),
            success: function (data) {
                var data_return = jQuery.parseJSON(data);
                if(data_return.type === 'success'){
                    $(".retorno_manifesta").html(data_return.msg);
                    download();
                }else{
                    $(".retorno_manifesta").html('Erro ao processar o manifesto!');
                }
                load_out();
            }
        });
    }
    function download() {
        $.ajax({
            type: 'POST',
            data: '&acao=buscar_download',
            url: 'php/download.php',
            beforeSend: load_in(),
            success: function (data) {
                var data_return = jQuery.parseJSON(data);
                if(data_return.type === 'success'){
                    $(".retorno_download").html(data_return.msg);
                }else{
                    $(".retorno_download").html('Erro ao processar o download!');
                }
                load_out();
            }
        });
    }
    $(function(){
        buscar_chave();
    });
</script>