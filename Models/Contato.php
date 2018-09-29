<?php
	require_once 'Query.php';
	class Contato extends Query {
		private $nome;
		private $telefone;
		private $tipo;
        private $operadora;

	public function definirDados($nome, $telefone, $tipo, $operadora ){
		$this->nome = $nome;
		$this->telefone = $telefone;
        $this->tipo = $tipo;
        $this->operadora = $operadora;
		
	}
    public function getNome(){
        return $this->nome;
    }
    public function setNome() {
        $this->nome = $nome;
    }
    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone(){
        $this->telefone = $telefone;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo() {
        $this->tipo = $tipo;
    }
    public function getOperadora() {
        return $this->operadora;
    }
    public function setOperadora(){
        $this->operadora = $operadora;
    }
    public function getQueryinclusao(){
        return $this->queryinclusao;
    }
    public function setQueryinclusao(){
        $this->queryinclusao = "INSERT INTO contatos values ('default', '".$this->getNome()."', '".$this->getTelefone()."', '".$this->getTipo()."', '".$this->getOperadora()."')";
    }
    public function getQueryalteracao(){
        return $this->queryalteracao;
    }
    public function setQueryalteracao($id){
        $this->queryalteracao = "UPDATE contatos SET nome ='".$this->getNome()."', telefone='".$this->getTelefone()."', tipo = '".$this->getTipo()."', operadora = '".$this->getOperadora()."' WHERE id =".$id;
    }
    public function getQueryverificacao(){
        return $this->queryverificacao;
    }
    public function setQueryverificacao(){
        $this->queryverificacao = "SELECT * FROM contatos WHERE nome = '".$this->getNome()."' and telefone = '".$this->getTelefone()."'";
    }
    public function getQueryjson(){
        return $this->queryjson;
    }
    public function setQueryjson($id){
        if ($id == ""){
            $this->queryjson = "SELECT * FROM contatos ORDER BY nome";    
        }else {
            $this->queryjson = "SELECT * FROM contatos WHERE id = ".$id;
        }
        
    }
    public function getQueryexclusao(){
        return $this->queryexclusao;
    }
    public function setQueryexclusao($id){
        $this->queryexclusao = "DELETE FROM contatos WHERE id =".$id;
    }

}
?>