<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<div class="box1">
<h2>Moradias</h2>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar Moradia</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>DiaRegisto</th>
            <th>Nome Cliente</th>
            <th>Nome Funcionario</th>
            <th>Rua</th>
            <th>Codigo Postal</th>
            <th>ValorAvaliado</th>
            <th>Atualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>

    <tbody>
        <?php

$query = "select propriedades.*, Clientes.Nome As NomeCliente, funcionario.Nome As NomeFuncionario
from propriedades 
inner join Clientes ON propriedades.IDCliente = Clientes.ID
inner join funcionario ON propriedades.IDFuncionario = funcionario.ID";

$result = mysqli_query($connection, $query);

if(!$result) {
die("Query Failed: " . mysqli_error($connection));
} else {
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><?php echo $row['ID']; ?></td>
  <td><?php echo $row['DiaRegisto']; ?></td>
  <td><?php echo $row['NomeCliente']; ?></td>
  <td><?php echo $row['NomeFuncionario']; ?></td>
  <td><?php echo $row['Rua']; ?></td>
  <td><?php echo $row['Codigo Postal']; ?></td>
  <td><?php echo $row['ValorAvaliado']; ?></td>
  <td><a href="update_page_1.php?id=<?php echo $row['ID']; ?>" class="btn btn-success">Atualizar</a></td>
  <td><a href="delete_page_1.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger">Eliminar</a></td>
</tr>
<?php
}
        }
    
        ?>      
    </tbody>
</table>

<?php 

        if(isset($_GET['message'])){
            echo "<h6>" .$_GET['message']. "</h6>";
        }

?>

<?php 

        if(isset($_GET['insert_msg'])){
            echo "<h7>" .$_GET['insert_msg']. "</h7>";
        }

?>

<form action="insert_data.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Moradia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
                    
        <div class="form-group">
                <label for="nome_cliente">Nome Cliente</label>
                <select name="nome_cliente" class="form-control">
                    <?php
                    $queryClientes = "select ID, Nome from clientes";
                    $resultCliente = mysqli_query($connection, $queryClientes);

                    if ($resultCliente) {
                        while ($rowClientes = mysqli_fetch_assoc($resultCliente)) {
                            $ClienteID = $rowClientes['ID'];
                            $ClienteNome = $rowClientes['Nome'];
                            echo "<option value=\"$ClienteID\">$ClienteNome</option>";
                        }

                        mysqli_free_result($resultCliente);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                    ?>
                </select>
        </div>

        <div class="form-group">
                <label for="nome_funcionario">Nome Funcionario</label>
                <select name="nome_funcionario" class="form-control">
                    <?php
                    $queryFuncionarios = "select ID, Nome from funcionario";
                    $resultFuncionarios = mysqli_query($connection, $queryFuncionarios);

                    if ($resultFuncionarios) {
                        while ($rowFuncionario = mysqli_fetch_assoc($resultFuncionarios)) {
                            $funcionarioID = $rowFuncionario['ID'];
                            $funcionarioNome = $rowFuncionario['Nome'];
                            echo "<option value=\"$funcionarioID\">$funcionarioNome</option>";
                        }

                        mysqli_free_result($resultFuncionarios);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                    ?>
                </select>
        </div>

        <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" name="rua" class="form-control">
        </div>

        <div class="form-group">
                <label for="codigo_postal">Codigo Postal</label>
                <select name="codigo_postal" class="form-control">
                    <?php
                    $queryCodigoPostal = "select Codigo, Localidade from codigopostal";
                    $resultCodigoPostal = mysqli_query($connection, $queryCodigoPostal);

                    if ($resultCodigoPostal) {
                        while ($rowCodigoPostal = mysqli_fetch_assoc($resultCodigoPostal)) {
                            $Codigo = $rowCodigoPostal['Codigo'];
                            $Localidade = $rowCodigoPostal['Localidade'];
                            echo "<option> $Codigo </option>";
                        }

                        mysqli_free_result($resultCodigoPostal);
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                    ?>
                </select>
        </div>

         <div class="form-group">
                <label for="valor_avaliado">Valor Avaliado</label>
                <input type="text" name="valor_avaliado" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-success" name="adicionarBotao" value="Adicionar">
      </div>
    </div>
  </div>
</div>
</form>
<?php include('footer.php'); ?>