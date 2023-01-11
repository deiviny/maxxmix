<?php
    namespace Model;
    use Model\Conect;
    use Exception;
    use PDOException;

    include_once $_SESSION['dir'] .'/model/Init.php';
    require_once $_SESSION['dir'] . '/ini/funcoes.php';
    
    class Empresa extends Conect
    {
        private $tabela = "empresa";
        private $tabelaModulo = "empresa_modulo";
        public $idCrip = "id";
        public $sess_usuario;
        public function __construct($sess_usuario = "")
        {
            $this->sess_usuario = $sess_usuario;
        }

        public function insert($dados){
            if($this->sess_usuario['nivel'] != "1"){
                throw new Exception("Usuário sem permissão!");
            }
            $sql = "INSERT INTO empresa
                        (
                            nome,
                            cnpj,
                            ie,
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
                                ?,
                                ?,
                                ?)";

            $sqlarray = [                                
                $_REQUEST['nome'],
                soNumero($_REQUEST['cnpj']),
                soNumero($_REQUEST['ie']),
                soNumero($_REQUEST['cep']),
                $_REQUEST['logradouro'],
                $_REQUEST['uf'],
                $_REQUEST['cidade'],
                soNumero($_REQUEST['telefone']),
                $_REQUEST['email']            
            ];

            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);
            

            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }

            $idEmpresa = $conn->lastInsertId();

            $sql = "INSERT
                        INTO
                        `pesquisas` (
                        `idEmpresa`,
                        `idDepartamento`,
                        `idFuncao`,
                        `nome`,
                        `descricao`,
                        `tipo_pesquisa`,
                        `tipo_periodo`,
                        `dia`,
                        `data_unica`,
                        `hora_inicio`,
                        `pesquisa_secreta`,
                        `ativa`,
                        `pesquisa_sistema`,
                        `data_cadastro`) VALUES";
            $arraySql = [                        
                        $idEmpresa,
                        NULL,
                        NULL,
                        "Como você esta.",
                        "Olá como você esta hoje?",
                        "quantitativa",
                        "diaria",
                        NULL,
                        NULL,
                        "08:00:00",
                        false,
                        true,
                        1,
                        "2021-11-14 14:57:08",                        
                        $idEmpresa,
                        NULL,
                        NULL,
                        'Como foi o dia.',
                        'Olá como foi o seu dia?',
                        'quantitativa',
                        'diaria',
                        NULL,
                        NULL,
                        '17:00:00',
                        false,
                        true,
                        2,
                        '2021-11-14 14:58:17'
            ];
            $sql .= "(?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,                        
                        ?),";
            $sql .= "(?,                        
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?)";

            
            $sqlpre = $conn->prepare($sql);
            
            if(!$sqlpre->execute($arraySql)){
                throw new Exception("Erro no cadastro!");
            }

            return $idEmpresa;
        }
        
        public function updateLogo($dados){
            $idEmpresa = $dados['idEmpresa'];
            if($idEmpresa == ""){
                $idEmpresa = $this->sess_usuario['idEmpresa'];
            }
            $sqlarray = [
                $dados['logo'],
                $idEmpresa                
            ];
            $sql = "UPDATE {$this->tabela} SET                         
                        logo=?
                        WHERE {$this->idCrip} = ?
            ";
            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);
            

            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }
        }
        public function update($dados){
            
            $id = $dados['id'];
            $modulos = explode('|',$dados['modulos']);
            $modulos = array_filter($modulos, "vazio");
            $this->insertModulo($id, $modulos);
            if($id == ""){
                $id = $this->sess_usuario['idEmpresa'];
            }
            if(($this->sess_usuario['nivel'] != "1") and ($id != $this->sess_usuario['idEmpresa'])){
                throw new Exception("Usuário sem permissão!");
            }
            $sqlarray = [
                $dados['nome'],
                soNumero($dados['cnpj']),
                $dados['ie'],
                $dados['cep'],
                $dados['logradouro'],
                $dados['uf'],
                $dados['cidade'],
                $dados['telefone'],
                $dados['email'],
                $id
            ];
            
            $sql = "UPDATE
                        {$this->tabela}
                    SET                        
                        nome = ?,
                        cnpj = ?,
                        ie = ?,
                        cep = ?,
                        logradouro = ?,
                        uf = ?,
                        cidade = ?,
                        telefone = ?,
                        email = ?
                    WHERE
                        id = ?";

            $conn = $this->conecta();
            $sqlpre = $conn->prepare($sql);
            

            if(!$sqlpre->execute($sqlarray)){
                throw new Exception("Erro no cadastro!");
            }
        }        
        
        public function show($id = ""){         
            
            if($id == "" ){
                $id = $this->sess_usuario['idEmpresa'];
            }
            if(($this->sess_usuario['nivel'] != "1") and ($id != $this->sess_usuario['idEmpresa'])){
                throw new Exception("Usuário sem permissão!");
            }
            $sql = "SELECT * FROM " . $this->tabela;                     
            $sql .= " WHERE ";            
            $sql .= " excluido = ?";            
            $sql .= " AND id = ?";            
            $result = $this->select($sql, ['N', $id]);
            $empresa = $result[0];
            $empresa['modulos'] = $this->listingModulo($empresa['id']);
            return $empresa;
        }

        public function selectTabela($campos, $valores)
        {
            $sql = "SELECT * FROM " . $this->tabela;                     
            $sql .= " WHERE ";            
            $sql .= " 0=0";  
            foreach($campos as $key => $val){   
                $sql .= " and ";
                if(!\strchr($val, "like")){
                    $sql .= $val . " = ?";
                } else {
                    $sql .= $val . " ? ";
                }
            }
            $result = $this->select($sql, $valores);
            $empresa = $result[0];
            return $empresa;
        }

        public function list(){            
            if($this->sess_usuario['nivel'] != "1"){
                throw new Exception("Usuário sem permissão!");
            }

            $sql = "SELECT * FROM ".$this->tabela . " WHERE excluido = ?";
            $result = $this->select($sql, ["N"]);               
            foreach ($result as $key => $val){
                $result[$key]['modulos'] = $this->listingModulo($val['id']);
            }
            return $result;

        }

        public function listingModulo($idEmpresa){
            $sql = "SELECT em.*, m.nome as nome_modulo FROM " . $this->tabelaModulo . " em ";            
            $sql .= " INNER JOIN modulo m ON(m.id = em.id_modulo) ";            
            $sql .= "WHERE em.id_empresa = ?";            
            $result = $this->select($sql, [$idEmpresa]);
            return $result;
        }

        public function insertModulo($idEmpresa, $modulos = []){
            if((count($modulos) <= 0) and ($modulos[0] == "")){
                return false;
            }
            $sql = "DELETE FROM {$this->tabelaModulo} WHERE id_empresa = ?";
            $conn = $this->conecta();
            $sqlarray = [$idEmpresa];

            try{
                $sqlpre = $conn->prepare($sql);            
                $sqlpre->execute($sqlarray);
            }catch(Exception $e){
                $this->sqlError($e);
            }

            $sql = "INSERT INTO {$this->tabelaModulo} (id_empresa, id_modulo) VALUES ";
            $arraySql = [];
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
            try{
                $sqlpre = $conn->prepare($sql);            
                $sqlpre->execute($arraySql);
            }catch(Exception $e){
                $this->sqlError($e);
            }

            return true;
        }

        public function showParamRfv(){
            $sql = " SELECT * FROM empresa_param_rfv WHERE id_loja = ? "; 
            $result = $this->select($sql, [$this->sess_usuario['idEmpresa']]);
            $resultado = [];
            foreach ($result as $row => $val){
                $resultado[$val['tipo']] = $val;
            }            
            return $resultado;
        }

        
        
    }