<?php
	require_once '../Models/Cadastro.php';

	header('Access-Control-Allow-Origin:http://localhost:4200');
	header("Access-Control-Allow-Headers: Content-Type");
	header('Access-Control-Allow-Credentials: true');
	header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");
	$params = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
	$postdata = file_get_contents("php://input");
    $request = (object)json_decode($postdata);
    $metodo = $_SERVER['REQUEST_METHOD'];
    //$id=$request->id;
	$nome=isset($request->nome)?$request->nome:"";
	$telefone=isset($request->telefone)?$request->telefone:"";
	$tipo=isset($request->tipo)?$request->tipo:"";
	$operadora=isset($request->operadora)?$request->operadora:"";
	// remover os @	

	//$id = isset($_GET['id'])?$_GET['id']:"";

	/*$nome=$_POST['nome'];
	$telefone=$_POST['telefone'];
	$tipo=$_POST['tipo'];
	$operadora=$_POST['operadora'];*/

	$cadastro = new Cadastro;
	switch ($metodo) {
		case "GET":
			$response = $cadastro->lerContatos($params[0]);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			break;
		case "POST":
			$response = $cadastro->addContato ($nome, $telefone, $tipo, $operadora);
			if ($response == ""){
				$msg = "Cadastro feito com sucesso";
				echo $msg;
			} else{
				echo $response;
			}			
			break;
		case "PUT":
			$response = $cadastro->editarContato ($params[0], $nome, $telefone, $tipo, $operadora);
			if ($response == ""){
				$msg = "Contato alterado com sucesso";
				echo $msg;
			} else{
				echo $response;
			}	
			break;
		case "DELETE":
			$response = $cadastro->excluirContato ($params[0]);
			if ($response == ""){
				$msg = "Contato removido com sucesso";
				echo $msg;
			} else{
				echo $response;
			}	
			break;
	}
	
?>