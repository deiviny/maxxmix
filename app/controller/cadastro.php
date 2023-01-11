<?php
    use Model\Cadastro;
    use Dompdf\Dompdf;
    use Dompdf\Options;
    
    session_start();    
    ini_set('display_errors', 0 );
    error_reporting(0);
    try{
        $output = [];
        require_once '../../model/Init.php';
        require_once '../../vendor/autoload.php';
        require_once '../ini/funcoes.php';
        $acao = $_REQUEST['acao'];
        $obj = new Cadastro();        
                
        switch ($acao){
            case "insert":
                // sleep(4);
                $dados = $obj->insert($_REQUEST);
                $output['dados'] = $dados;
                break;                
        }
        $output = json_encode($output);
        echo $output;
    } catch (Exception $e){
        die($e->getMessage());
    }
