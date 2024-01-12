<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<?php

if(isset($_GET['id'])){

    $id = $_GET['id'];

   
$query = "select propriedades_detalhes.Tipo, propriedades_detalhes.NumeroQuartos, propriedades_detalhes.ClasseEnergetica, propriedades_detalhes.NumeroCasaBanho, propriedades_detalhes.Garagem, propriedades_detalhes.Tamanho 
from propriedades_detalhes 
where IDPropriedade = '$id'";

$result = mysqli_query($connection, $query);

if(!$result) {
die("Query Failed: " . mysqli_error($connection));
} else {

    $row = mysqli_fetch_assoc($result);

}
}
?>



<?php 

if(isset($_POST['updateBotao'])){

    if(isset($_GET['id_new'])){
        $idnew = $_GET['id_new'];
    }

    $tipoMoradia = $_POST['tipo_moradia'];
    $numeroQuartos = $_POST['numero_quartos'];
    $ClasseEnergetica = $_POST['classe_energetica'];
    $NumeroCasasBanho = $_POST['numero_casas_banho'];
    $Garagem = $_POST['garagem'];
    $Tamanho = $_POST['tamanho'];

if ($tipoMoradia == "" || empty($tipoMoradia)) { 
    header('location: index.php?message=Tipoinválido!');
} elseif ($numeroQuartos == "" || empty($numeroQuartos) || !is_numeric($numeroQuartos)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($ClasseEnergetica == "" || empty($ClasseEnergetica) || is_numeric($ClasseEnergetica)) {
    header('location: index.php?message=Classe inválida!');
} elseif ($NumeroCasasBanho == "" || empty($NumeroCasasBanho) || !is_numeric($NumeroCasasBanho)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($Garagem == "" || empty($Garagem) || !is_numeric($Garagem)) {
    header('location: index.php?message=Valor inválido!');
} elseif ($Tamanho == "" || empty($Tamanho) || !is_numeric($Tamanho)) {
    header('location: index.php?message=Valor inválido!');

} else {

    $query = "Update `propriedades_detalhes` 
    set `Tipo` = '$tipoMoradia', `NumeroQuartos` = '$numeroQuartos', 
    `ClasseEnergetica` = '$ClasseEnergetica', 
    `NumeroCasaBanho` = '$NumeroCasasBanho', `Garagem` = '$Garagem', 
    `Tamanho` = '$Tamanho'
    where `IDPropriedade`= '$idnew'
    ";

    $result = mysqli_query($connection, $query);

    if(!$result) {
    die("Query Failed: " . mysqli_error($connection));
    } else {
        header('location:index.php?update_msg=Informações atualizadas com sucesso');
    }


    }

}

?>


<form action="update_page_1.php?id_new=<?php echo $id; ?>" method="post">
        <div class="form-group">
                <label for="tipo_moradia">Tipo</label>
                <select name="tipo_moradia" class="form-control">
                    <?php
                    $queryTipo = "select ID, Descrição from tipopropriedade";
                    $resultTipo = mysqli_query($connection, $queryTipo);

                    if ($resultTipo) {
                        while ($rowTipo = mysqli_fetch_assoc($resultTipo)) {
                            $TipoID = $rowTipo['ID'];
                            $TipoDescricao = $rowTipo['Descrição'];
                            echo "<option value=\"$TipoID\">$TipoDescricao</option>";
                        }

                        mysqli_free_result($resultTipo);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                    ?>
                </select>
        </div>

        <div class="form-group">
                <label for="numero_quartos">Número de quartos</label>
                <input type="text" name="numero_quartos" class="form-control" value="<?php echo $row['NumeroQuartos']?>">
        </div>

        <div class="form-group">
                <label for="classe_energetica">Classe energética</label>
                <input type="text" name="classe_energetica" class="form-control" value="<?php echo $row['ClasseEnergetica']?>">
        </div>

        <div class="form-group">
                <label for="numero_casas_banho">Número Casas de banho</label>
                <input type="text" name="numero_casas_banho" class="form-control" value="<?php echo $row['NumeroCasaBanho']?>">
        </div>

        <div class="form-group">
                <label for="garagem">Garagem</label>
                <input type="text" name="garagem" class="form-control" value="<?php echo $row['Garagem']?>">
        </div>

        <div class="form-group">
                <label for="tamanho">Tamanho (m2)</label>
                <input type="text" name="tamanho" class="form-control" value="<?php echo $row['Tamanho']?>">
        </div>
                
        <input type="submit" class="btn btn-success" name="updateBotao" value="Atualizar" style="margin-top: 5px;">

        
</form>


<?php include('footer.php'); ?>