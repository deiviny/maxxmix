const urlController = "app/controller/cadastro.php" 
$("#btn_evolua").on("click", function(){
    window.location.href='#div_evolua'
    return false;
})
function cadastrar(){
    dados = {
        "acao": "insert"
        ,"nome_empresa": $("#nome_empresa").val()
        ,"nome": $("#nome").val()
        ,"cep": $("#cep").val()
        ,"uf": $("#uf").val()
        ,"cidade": $("#cidade").val()
        ,"bairro": $("#bairro").val()
        ,"logradouro": $("#endereco").val()
        ,"telefone": $("#telefone").val()
        ,"email": $("#email").val()
    }
    $.ajax({
        type: "POST",
        data: dados,
        dataType: "json",
        url: urlController,
        beforeSend: function( xhr ) {
            $("#btn_cadastar").prop("disabled", true)
            $("#btn_cadastar").text("Enviando...")
        }
        }).done(function (data) {
            $("#btn_cadastar").prop("disabled", false)
            $("#btn_cadastar").text("Cadastrar")
            swal("Vamos lá!", "Cadastro realizado com sucesso a senha foi enviada para seu email!", "success")
            $("#nome_empresa").val("")
            $("#nome").val("")
            $("#cep").val("")
            $("#uf").val("")
            $("#cidade").val("")
            $("#bairro").val("")
            $("#endereco").val("")
            $("#telefone").val("")
            $("#email").val("")
            window.location.href = "https://crm.crmsimpled.com.br/";
        })
        .fail(function (data) {
            msgErro = data.responseText
            swal("Erro!", msgErro, "error")
            console.log(data.responseText)
        })
}

$("#cep").on("focusout", function(){
    let cep = $(this).val()    
    buscarCep(cep)    
})

