<?php 
include  'dbcon.php';
if(isset($_POST['adicionarBotao'])){

$nome_cliente = $_POST['nome_cliente'];
$nome_funcionario = $_POST['nome_funcionario'];
$rua = $_POST['rua'];
$codigo_postal = $_POST['codigo_postal'];
$valor_avaliado = $_POST['valor_avaliado'];
$numero_quartos = $_POST['numero_quartos'];
$tipo_moradia = $_POST['tipo_moradia'];
$classe_energetica = $_POST['classe_energetica'];
$numero_casas_banho = $_POST['numero_casas_banho'];
$garagem = $_POST['garagem'];
$tamanho = $_POST['tamanho'];

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
} elseif ($tipo_moradia == "" || empty($tipo_moradia)) { 
    header('location: index.php?message=Tipoinválido!');
} elseif ($numero_quartos == "" || empty($numero_quartos) || !is_numeric($numero_quartos)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($classe_energetica == "" || empty($classe_energetica) || is_numeric($classe_energetica)) {
    header('location: index.php?message=Classe inválida!');
} elseif ($numero_casas_banho == "" || empty($numero_casas_banho) || !is_numeric($numero_casas_banho)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($garagem == "" || empty($garagem) || !is_numeric($garagem)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($tamanho == "" || empty($tamanho) || !is_numeric($tamanho)) {
    header('location: index.php?message=Valor inválido!');
    
} else {

    $query = "insert into `propriedades` (`DiaRegisto`, `IDCliente`, `IDFuncionario`, `Rua`, `Codigo Postal`, `ValorAvaliado`) VALUES (CURDATE(), '$nome_cliente', '$nome_funcionario', '$rua', '$codigo_postal', '$valor_avaliado')";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error());
    } else {

        // Retrieve the last inserted ID
        $last_inserted_id = mysqli_insert_id($connection);

        // Use the ID in the second INSERT query
        $query_detalhes = "INSERT INTO `propriedades_detalhes` (`IDPropriedade`, `Tipo`, `NumeroQuartos`, `ClasseEnergetica`, `NumeroCasaBanho`, `Garagem`, `Tamanho`) VALUES ('$last_inserted_id', '$tipo_moradia', '$numero_quartos', '$classe_energetica', '$numero_casas_banho', '$garagem', '$tamanho')";

        $result_detalhes = mysqli_query($connection, $query_detalhes);

        if (!$result_detalhes) {
            die("Second Query Failed: " . mysqli_error());
        } else {
            header('location: index.php?insert_msg=Moradia adicionado com sucesso');
        }
    }
}
}
?>