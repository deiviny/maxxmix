async function buscarCidades(uf, idCampo, select = null) {

    await $.ajax({
        type: "GET",
        dataType: "json",
        url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf + '/distritos'
    }).done(function (data) {
        
        let cidades = data
        let campo = $("#"+idCampo)
        campo.empty()
        opt = ""
        $.each(cidades, function (key, val) {
            selectIn = ""
            if((select != null) && (retira_acentos(val['nome']).toUpperCase() == retira_acentos(select).toUpperCase())){
                selectIn = "selected"
            }
            opt += "<option " + selectIn + " value='" + retira_acentos(val['nome']).toUpperCase()  +"'> " + retira_acentos(val['nome']).toUpperCase()  +"</option>"
        })
        campo.append(opt)
    })
    .fail(function (data) {
        msgErro = data.responseText
        swal("Erro!", msgErro, "error")
        console.log(data.responseText)
    })
}

async function buscarCep(cep) {
    cep = limparString(cep)
    const endereco = await $.ajax({
        type: "GET",
        dataType: "json",
        url: 'https://viacep.com.br/ws/' + cep + '/json/'
    })
    .done(function (data) {           
        $("#uf").val(data['uf'])
        $("#cidade").val(retira_acentos(data['localidade']).toUpperCase())
        $("#bairro").val(data['bairro'])
        $("#endereco").val(data['logradouro'])
    })
    .fail(function (data) {
        msgErro = data.responseText
        swal("Erro!", msgErro, "error")
        console.log(data.responseText)
    })

    return endereco;

}

function soNumeros(v){
    if(typeof v != 'undefined'){
        return v.replace(/\D/g, "")
    }
}

function limparString(dados) {
    resultado = dados
    resultado = resultado.replace(" ", "");
    resultado = resultado.replace("-", "");
    resultado = resultado.replace(".", "");
    return resultado;
}

function retira_acentos(str)
{

    com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŔÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿŕ";

    sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
    novastr="";
    for(i=0; i<str.length; i++) {
        troca=false;
        for (a=0; a<com_acento.length; a++) {
            if (str.substr(i,1)==com_acento.substr(a,1)) {
                novastr+=sem_acento.substr(a,1);
                troca=true;
                break;
            }
        }
        if (troca==false) {
            novastr+=str.substr(i,1);
        }
    }
    return novastr;
}