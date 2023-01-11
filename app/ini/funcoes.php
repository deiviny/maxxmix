<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    function prefixoTabela($tabela){
        $result = substr($tabela, 0, 4);
        $temUnderline = strchr($tabela, '_');
        if($temUnderline !== false){
            $tabelaExp = explode('_', $tabela);
            $result = "";
            foreach ($tabelaExp as $key => $val){
                $result .= substr($val, 0, 2);
            }            
        }
        return $result;
    }

    function formatarDinheiro($valor, $tipo = "Banco"){
        $vlNovo = $valor;
        switch ($tipo){
            case "Banco":
                if(strlen($valor) < 7){
                    $vlNovo = str_replace(",", ".", $valor);
                } else {
                    $vlNovo = "";
                    foreach (str_split($valor) as $key => $val){// 111.111.111,11
                        if((strlen($valor) == 8) and ($key == 1) and ($val == '.')){
                            $vlNovo .= "";
                        }elseif((strlen($valor) == 9) and ($key == 2) and ($val == '.')){
                            $vlNovo .= "";
                        }elseif((strlen($valor) == 10) and ($key == 3) and ($val == '.')){
                            $vlNovo .= "";
                        }
                        else{
                            $vlNovo .= $val;
                        }

                    }
                    $vlNovo = str_replace(",", ".", $vlNovo);
                }
                break;
            case "Mascara":
                $vlNovo = number_format(
                  $valor, 2, ',','.'
                );
                break;
        }

        return $vlNovo;
    }

    function arrumaData($data)
    {
        
        if (strchr($data, "-") == true) {
            $data = explode("-", $data);
            $return = $data[2] . '/' . $data[1] . '/' . $data[0];
        } else {
            $data = explode("/", $data);
            $return = $data[2] . '-' . $data[1] . '-' . $data[0];
        }
        return $return;
    }

    function enviarEmail($dados){

        include ('../vendor/autoload.php');
        if($dados['host'] == ""){
            $host = "mail.simpled.com.br";
        }
        if($dados['usuario'] == ""){
            $usuario = "simpled@simpled.com.br";
        }
        if($dados['senha'] == ""){
            $senha = "Dani@46902056";
        }
        if($dados['nomeDe'] == ""){
            $nomeDe = "Simpled - Sistemas";
        }

        $textoBody = "<table>
                                <tr>
                                    <td style='text-align: center'><img style=\"width: 100px\" src='http://simpled.com.br/img/logo.png'></td>
                                </tr>
                                <tr>                                    
                                    <td>{$dados['texto']}</td>
                                </tr>
                                <tr>                                    
                                    <td><img width='400px;' src='http://simpled.com.br/img/rodapeEmail.png'></td>
                                </tr>                            
                        </table>";

        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $host;
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->Username = $usuario;
        $mail->Password = $senha;
        $mail->setFrom($usuario,$nomeDe);
        $mail->Subject = $dados['assunto'];
        $mail->Body = $textoBody;
        $mail->addAddress($dados['emailPara'], $dados['nomePara']);

        if(!$mail->send()) {
            return true;
        }else{
            return "Erro no envio do e-mail: " . $mail->ErrorInfo;
        }

    }

    function corrigeTelefone($numero, $comDDI = false){
        global $arrDDD;
        $numero = trim($numero);
        $lenNumero = strlen($numero);        
        $ddd = $numero[0].$numero[1];
        $temDDD = (in_array($ddd, $arrDDD))? true : false; 
        $numeroNovo = $numero;
        if($lenNumero <= 8 && $temDDD == false){
            $numeroNovo = "9".$numero;
        }
        if($lenNumero > 8 && $lenNumero < 11 ){
            if($temDDD){
                $numeroNovo = $ddd.'9'.substr($numero,2);
            }
        }

        return $numeroNovo;        
        
    }
    
    function salvarSql($sql){
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/novo.txt","wb");

        fwrite($fp,$sql);

        fclose($fp);
    }

    
    function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function gerarSenha($usuario){
        $senha = strtoupper(substr($usuario,0,1));
        $senha .= substr($usuario,1,1);
        $senha .= substr($usuario,3,1);
        $senha .= substr($usuario,4,1);
        $senha .= "@";
        $senha .= rand(0,9);
        $senha .= rand(0,9);
        $senha .= rand(0,9);
        $senha .= rand(0,9);
        return $senha;
    }