<?php
    namespace Model;
    use PDO;
    use Exception;
    class Conect
    {
        public function conecta()
        {

            $server = SERVER;
            $user = USER;
            $senha = PASS;
            $banco = BANCO;
            $porta = PORTA;


            try {

                $Dsn = 'mysql:host=' . $server . ';port=' . $porta.';dbname=' . $banco;
                $Options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                $conn = new pdo($Dsn, $user, $senha, $Options);
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                return $conn;

            } catch (\PDOException $e) {
                echo "Erro gerado<br>" . $e->getCode() . "<br>(<b>" . $e->getMessage() . "</b>)";
            }


        }

        public function select($sql, $sqlarray=null){            
            try{                
                $conn = $this->conecta();
                $sqlpre = $conn->prepare($sql);            
                $sqlpre->execute($sqlarray);
                $post = $sqlpre->FetchAll(PDO::FETCH_ASSOC);
                return $post;
            }catch(Exception $e){
                $this->sqlError($e);
            }
        }

        public function sqlError($e)
        {
            $erro = $e->errorInfo;
            $codeError = $erro[1];
            $msgErro = "";
            switch($codeError){
                case "1062":                        
                    $regrex = '/\'(.*?)\'/';
                    preg_match_all($regrex, $erro[2], $resultado);
                    $msgErro = "O {$resultado[0][1]} ({$resultado[0][0]}) já está cadastrado.";
                    break;
                case "1146":
                    $regrex = '/\'(.*?)\'/';
                    preg_match_all($regrex, $erro[2], $resultado);
                    $msgErro = "A tabela {$resultado[0][0]} não existe.";
                    break;
                default:
                    $msgErro = $erro[2];
                break;
            }
            throw new Exception($msgErro);
        }
    }