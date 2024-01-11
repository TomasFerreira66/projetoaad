<?php 
include  'dbcon.php';
if(isset($_POST['adicionarBotao'])){

$nome_cliente = $_POST['nome_cliente'];
$nome_funcionario = $_POST['nome_funcionario'];
$rua = $_POST['rua'];
$codigo_postal = $_POST['codigo_postal'];
$valor_avaliado = $_POST['valor_avaliado'];


if ($nome_cliente == "" || empty($nome_cliente)) { 
    header('location: index.php?message=Nome do cliente inválido!');
} elseif ($nome_funcionario == "" || empty($nome_funcionario)) { 
    header('location: index.php?message=Nome do funcionário inválido!');
} elseif ($rua == "" || empty($rua) || !is_string($rua) || is_numeric($rua)) {
    header('location: index.php?message=Nome da rua inválido!');
} elseif ($codigo_postal == "" || empty($codigo_postal)) { 
    header('location: index.php?message=Código postal inválido!');
} elseif ($valor_avaliado == "" || empty($valor_avaliado) || !is_numeric($valor_avaliado)) {
    header('location: index.php?message=Valor inválido!');
} else {

 $query = "insert into `propriedades` (`DiaRegisto`, `IDCliente`, `IDFuncionario`, `Rua`, `Codigo Postal`, `ValorAvaliado`) values (CURDATE(), '$nome_cliente', '$nome_funcionario', '$rua', '$codigo_postal', '$valor_avaliado')";
 $result = mysqli_query($connection, $query);

 if(!$result){
    die("Query Failed".mysqli_error());
 } else {
    header('location: index.php?insert_msg=Moradia adicionado com sucesso');
 }
}
    

}

?>