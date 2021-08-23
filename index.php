<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Lista de Empleados
            <a href="exportData.php" class="btn btn-success pull-right">Export Empleados</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Edad</th>
                      <th>Género</th>
                      <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //include database configuration file
                    include 'conexion.php';
                    
                    //get records from database
                    $query = $db->query("SELECT empleado.`id_empleado`, empleado.`nombre`, empleado.`apellido`, empleado.`edad`, genero.`n_genero`, cargo.`n_cargo` FROM empleado
                      INNER JOIN genero
                      ON empleado.`genero` = genero.`id_genero`
                      INNER JOIN cargo
                      ON empleado.`cargo` = cargo.`id_cargo`
                      ORDER BY id_empleado ASC");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){ ?>                
                    <tr>
                      <td><?php echo $row['id_empleado']; ?></td>
                      <td><?php echo $row['nombre']; ?></td>
                      <td><?php echo $row['apellido']; ?></td>
                      <td><?php echo $row['edad']; ?></td>
                      <td><?php echo $row['n_genero']; ?></td>
                      <td><?php echo $row['n_cargo']; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="6">No se encontraron empleados.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>