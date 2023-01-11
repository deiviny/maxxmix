<?php
    namespace Model;
    use Model\Conect;
    use Exception;
    use DateTime;
    use PDOException;

    include_once 'Init.php';
    include_once '../../ini/funcoes.php';

    class Cadastro extends Conect
    {        
        private $token; 
        public function __construct()
        {
            $this->token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZHUiOm51bGwsImVtYWlsIjpudWxsfQ==.7SNUUe1jwuBvDSQRB3eIyoc7OY4inz8cgS4lvlqPBf8=";
        }
        public function insert($dados){     
            $sql = "SELECT email FROM usuarios WHERE email = ? ";
            $result = $this->select($sql, [$dados['email']]);

            if(count($result) > 0){
                throw new Exception("Esse email({$dados['email']}) já esta cadastrado!");
            }
            $sql = "INSERT INTO empresa
                        (
                            nome,
                            cep,
                            logradouro,
                            uf,
                            cidade,
                            telefone,
                            email)
                        VALUES(?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?)";

            $sqlarray = [                                
                $dados['nome_empresa'],                
                soNumero($dados['cep']),
                $dados['logradouro'],
                $dados['uf'],
                $dados['cidade'],
                soNumero($_REQUEST['telefone']),
                $_REQUEST['email']            
            ];

            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);
            

            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }

            $idEmpresa = $conn->lastInsertId();
            // ----------------------- rfv

            $sql_res = "INSERT INTO `empresa_param_rfv` (`id_loja`, `tipo`, `r1_in`, `r1_fim`, `r2_in`, `r2_fim`, `r3_in`, `r3_fim`, `r4_in`, `r4_fim`, `r5_in`, `r5_fim`) 
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arr_res_sql = [
                $idEmpresa,
                'recencia', 
                360, 3000, 91, 120, 61, 90, 31, 60, 0, 10
            ];
            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql_res);            

            if(!$sqlpre->execute($arr_res_sql)){
                throw new Exception("Erro no cadastro!");
            }

            $sql_fre = "INSERT INTO `empresa_param_rfv` (`id_loja`, `tipo`, `r1_in`, `r1_fim`, `r2_in`, `r2_fim`, `r3_in`, `r3_fim`, `r4_in`, `r4_fim`, `r5_in`, `r5_fim`) 
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arr_fre_sql = [
                $idEmpresa,
                'frequencia', 
                1, 5, 5, 10, 10, 40, 40, 70, 70, 0
            ];
            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql_fre);            

            if(!$sqlpre->execute($arr_fre_sql)){
                throw new Exception("Erro no cadastro!");
            }

            $sql_val = "INSERT INTO `empresa_param_rfv` (`id_loja`, `tipo`, `r1_in`, `r1_fim`, `r2_in`, `r2_fim`, `r3_in`, `r3_fim`, `r4_in`, `r4_fim`, `r5_in`, `r5_fim`) 
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $arr_val_sql = [
                $idEmpresa,
                'valor', 
                0, 1000, 1000, 3000, 3000, 5000, 5000, 7000, 7000, 100000000
            ];
            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql_val);            

            if(!$sqlpre->execute($arr_val_sql)){
                throw new Exception("Erro no cadastro!");
            }

            // ----------------------- rfv


            $data_hoje = new DateTime();
            $data_fim = clone $data_hoje;
            $data_fim->modify('+8 days');
            $obs = "Cadastro realizado no site com 7 dias gratis.";
            $tipo_pagamento = "free";
            $arraySql = [$idEmpresa, $data_hoje->format('Y-m-d H:i:s'), '7', $data_fim->format('Y-m-d H:i:s'), $obs, $tipo_pagamento, 'S'];            
            $sql = "INSERT INTO empresa_contrato_crm (id_empresa, data_cadastro, qtd_dias, data_fim, obs, tipo_pagamento, pago) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $conn = $this->conecta();            
            $sqlpre = $conn->prepare($sql);            
            $sqlpre->execute($arraySql);


            $sql = "INSERT INTO empresa_modulo (id_empresa, id_modulo) VALUES ";
            $arraySql = [];
            $modulos = ['5','7','3'];
            $qtdModulo = count($modulos) - 1;
            foreach ($modulos as $key => $val){
                if($val != ""){
                    array_push($arraySql, $idEmpresa);
                    array_push($arraySql, $val);
                    $sql .= "(?, ?)";
                    if($key < $qtdModulo){
                        $sql .= ", ";
                    }
                }                
            }

            $conn = $this->conecta();            
            $sqlpre = $conn->prepare($sql);            
            $sqlpre->execute($arraySql);

            //====================== colaborador
            $sql = "
                    INSERT INTO colaboradores (                        
                            idEmpresa,                             
                            nome,                             
                            email                           
                            ) VALUES (
                            ?, 
                            ?, 
                            ?                            
                            );                        
                ";
            $sqlarray = [                
                $idEmpresa,
                $dados['nome'],
                $dados['email'],
                
            ];

            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);

            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }
            $idColaborador = $conn->lastInsertId();
            //====================== colaborador

            $sql = "
                    INSERT INTO usuarios (                        
                            idEmpresa,                             
                            idColaborador,                             
                            nivel,                             
                            nome,                             
                            email,
                            senha
                            ) VALUES (
                            ?, 
                            ?, 
                            ?, 
                            ?, 
                            ?, 
                            ?                           
                            );                        
                ";
            $senha = gerarSenha($dados['nome']);
            $sqlarray = [                
                $idEmpresa,
                $idColaborador,
                '2',
                $dados['nome'],
                $dados['email'],
                md5($senha)
            ];

            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);
            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }
            

            


            $dados['assunto'] = "Cadastro CRM Simpled";
            $dados['emailPara'] = $dados['email']; 
            $dados['nomePara'] = $dados['nome'];
            $dados['texto'] = "
            <h3>Cadastro CRM Simpled</h3>
            <p>Seu cadastro foi realizado com sucesso, segue abaixo sua senha de acesso.</p>
            <p>Aproveite!</p>
            <p>Senha: $senha</p>
            ";
            enviarEmail($dados);

            $dados['assunto'] = "Cadastro CRM Simpled - " . $dados['nome_empresa'];
            $dados['emailPara'] = 'deiviny62@gmail.com'; 
            $dados['nomePara'] = 'Deiviny Lamarck';
            $dados['texto'] = "
            <h3>Cadastro CRM Simpled</h3>
            <p>Nova empresa cadastrada, verifica os dados e entre em contato.</p>
            <p>Empresa: " . $dados['nome_empresa'] . "</p>            
            <p>Contato: " . $dados['nome'] . "</p>            
            <p>Telefone: " . $dados['telefone'] . "</p>            
            <p>Email: " . $dados['email'] . "</p>            
            ";
            enviarEmail($dados);
        }
    }