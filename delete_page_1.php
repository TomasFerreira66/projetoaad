<?php include('dbcon.php'); ?>

<?php

if(isset($_GET['id'])) {

$id = $_GET['id'];

}

$query_detalhes = "DELETE FROM `propriedades_detalhes` WHERE `IDPropriedade` = '$id'";
$result_detalhes = mysqli_query($connection, $query_detalhes);

if (!$result_detalhes) {
    die("Query Failed: " . mysqli_error($connection));
}

// Now, delete from propriedades
$query = "DELETE FROM `propriedades` WHERE `ID` = '$id'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
} else {
    header('location:index.php?delete_msg=Moradia apagada com sucesso');
}

?>