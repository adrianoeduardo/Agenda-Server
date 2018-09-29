<?php

	require_once 'Banco.php';
	require_once 'Contato.php';
	
	class Cadastro{  

	    public function lerContatos ($id){
	    	$banco = new Banco;
			$contato = new Contato;	
	    	$contato->setQueryjson($id);
			$query = $contato->getQueryjson();
			$dados=$banco->retornaJson($query);			
			return $dados;
		}	   
		public function addContato ($nome, $telefone, $tipo, $operadora){
		 	$banco = new Banco;
			$nome = $this->tratarNome($nome);
			$contato = new Contato;
		    $contato->definirDados($nome, $telefone, $tipo, $operadora);
		    $contato->setQueryverificacao();
		    $res = $banco->verificaExistente($contato->getQueryverificacao());
		    if ($res == 0){
		    	$contato->setQueryinclusao();
				$res = $banco->executarQuery($contato->getQueryinclusao());
				return $res;

		    }else {
		    	$res = "Erro de duplicidade: Esse contato já existe!";
		    	return $res;
		    }			
		}
		public function editarContato ($id, $nome, $telefone, $tipo, $operadora){
			$banco = new Banco;
			$nome = $this->tratarNome($nome);
			$contato = new Contato;
		    $contato->definirDados($nome, $telefone, $tipo, $operadora);
		    $contato->setQueryalteracao($id);
		    $res = $banco->executarQuery($contato->getQueryalteracao());
			return $res;
		}
		public function excluirContato ($id){
			$banco = new Banco;
			$contato = new Contato;
			$contato->setQueryexclusao($id);
		    $res = $banco->executarQuery($contato->getQueryexclusao());
			return $res;

		}
		public function tratarNome ($n){
		$banco = new Banco;
        $n = $banco->protegerBD($n);
        $nome="";
        $n=trim($n);
        $n=mb_strtolower($n, 'UTF-8');
        $n=explode(" ", $n);
        for ($i=0; $i < count($n); $i++){
            if($n[$i] == "de" || $n[$i] == "da" || $n[$i] == "dos" || $n[$i] == "das" || $n[$i] == "la" || $n[$i] == "los" || $n[$i] == "las" || $n[$i] == "e" || $n[$i] == "do" || $n[$i] == "em"){
                $nome.=$n[$i]." ";
            } else{
                $nome.=ucfirst($n[$i])." ";
            }
        }
        return $nome;
    }

	   
	}
?>