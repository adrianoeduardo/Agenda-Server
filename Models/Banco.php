<?php 
class Banco {
        private $server;
        private $user;
        private $senha;
        private $bd;
        private $codcaracteres;
        
    public function __construct() {
            $this->setServer();
            $this->setUser();
            $this->setSenha();
            $this->setBd();
            $this->setCodcaracteres();
        }
    public function getServer() {
        return $this->server;
    }
    public function setServer() {
        $this->server = "localhost";
    }
    public function getUser() {
        return $this->user;
    }
    public function setUser(){
        $this->user = "root";
    }
    public function getSenha() {
        return $this->senha;
    }
    public function setSenha() {
        $this->senha = "";
    }
    public function getBd(){
        return $this->bd;
    }
    public function setBd(){
        $this->bd = "bdagenda";
    }
    public function getCodcaracteres(){
        return $this->codcaracteres;
    }
    public function setCodcaracteres(){
        $this->codcaracteres = "utf8";
    }
    

    public function conectarBD(){
        $link=mysqli_connect($this->getServer(), $this->getUser(), $this->getSenha(), $this->getBd());
        mysqli_set_charset($link, $this->getCodcaracteres());
        if (!$link){
            $erro = '';
            return $erro;
        }
        else{
            return $link;
        }
        
    }
    public function fecharBD ($link){
        mysqli_close($link);
    }

    public function protegerBD($dados){
        $link=$this->conectarBD();
        if(!is_array($dados)){
            $dados=mysqli_real_escape_string($link, $dados);
        }
        else{
            $arr=$dados;
            foreach ($arr as $key => $value) {
                $key = mysqli_real_escape_string($link, $key);
                $value=mysqli_real_escape_string($link, $value);

                $dados[$key] = $value;
            }
        }
        $this->fecharBD ($link);
        return $dados;
    }
    
    public function verificaExistente($query){
        $link = $this->conectarBD();
        $verificar = mysqli_query($link, $query);
        $resposta = mysqli_fetch_all($verificar);
        $res = count($resposta);
        return $res;
        $this->fecharBD ($link);
    }
    public function executarQuery($query){
        $link=$this->conectarBD();
        $sql= mysqli_query($link, $query);
        if (!$sql){
            $erro = "Erro no Banco de Dados: ".mysqli_error($link)." :/";
            return $erro;
        }else{
            $msg = "";
            return $msg;
        }
        $this->fecharBD ($link);
    }
    public function retornaJson ($query){
        $link=$this->conectarBD();
        $sql= mysqli_query($link, $query);
        $dados=[];
        while ($consultar = mysqli_fetch_object($sql)) {
            array_push($dados, $consultar);
        }
        return $dados;
        $this->fecharBD ($link);
    }
}

?>