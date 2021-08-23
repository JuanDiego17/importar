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
    $delimiter = ",";
    $filename = "empleados " . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'nombre', 'APELLIDO', 'EDAD', 'GENERO', 'CARGO');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id_empleado'], $row['nombre'], $row['apellido'], $row['edad'], $row['n_genero'], $row['n_cargo']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>