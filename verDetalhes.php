<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>IDPropriedade</th>
            <th>Tipo</th>
            <th>Numero de Quartos</th>
            <th>Classe Energetica</th>
            <th>Numero de Casa de Banho</th>
            <th>Garagem</th>
            <th>Tamanho</th>
        </tr>
    </thead>

    <tbody>
    <?php

if(isset($_GET['id'])){

    $id = $_GET['id'];

$nome = $id;  // Replace "some_value" with the actual value you want to pass as the parameter

$storedProcedure = "CALL `GetDetalhes`('$nome');";
$resultProcedure = mysqli_query($connection, $storedProcedure);

if (!$resultProcedure) {
    die("Query Failed: " . mysqli_error($connection));
} else {
    while ($rowProcedure = mysqli_fetch_assoc($resultProcedure)) {
        print_r($rowProcedure);  // Assuming you want to print the result row, not the stored procedure call
        ?>
<tr>
<td><?php echo $rowProcedure['IDPropriedade']; ?></td>
  <td><?php echo $rowProcedure['Tipo']; ?></td>
  <td><?php echo $rowProcedure['NumeroQuartos']; ?></td>
  <td><?php echo $rowProcedure['ClasseEnergetica']; ?></td>
  <td><?php echo $rowProcedure['NumeroCasaBanho']; ?></td>
  <td><?php echo $rowProcedure['Garagem']; ?></td>
  <td><?php echo $rowProcedure['Tamanho']; ?></td>
</tr>
<?php
}
        }
            }
        ?>      
    </tbody>
</table>





