<?php
include 'navbar_admin.php';


$where = "";
$asesor = $_POST['asesor'];
$mes = $_POST['mes'];

if(isset($_POST['filtrar'])){
    if(empty($_POST['asesor'])){
        if($mes == 0){
            $where = "";
        }else{
            $where = " WHERE MONTH(Asesores.fecha) = '" . $mes . "'";
        }
        
    }
    else if(empty($_POST['mes'])){
        
            $where = "WHERE Asesores.nombre = '". $asesor ."'";
        
        
    }
    else{
            $where = "WHERE MONTH(Asesores.fecha) = " . $mes . " and Asesores.nombre = '". $asesor ."'";
        
       
    }
}


?>

<div class="container">
    <div class="row">
        <form method="POST">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4>FILTROS</h4>
                </div>
                
                <div class="col-sm-4">
                    
                    <select id="tipoAsesoria" class="form-control" name="asesor">
                        <option value="0" selected>Asesor</option>
                        <?php
                        include 'conexion_admin.php';
                        $resultado = $conn->query("SELECT nombre FROM Asesor");
                        $resultado->data_seek(0);
                        while ($fila = $resultado->fetch_assoc()) { 
                            $nombreAsesor = $fila['nombre'];
                            ?>
                            <option value="<?php echo $nombreAsesor;?>"><?php echo $nombreAsesor; ?></option>
                            <?php
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    
                    <select id="motivoAsesoria" class="form-control" name="mes">
                        <option value="0" selected>Mes</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button name="filtrar" type="submit" class="btn btn-success">FILTRAR</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <h5>ASESORIAS</h5>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-sm table-bordered">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Asesor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Observaciones</th>
                </thead>
                <tbody>
                    <?php
                    include 'conexion_admin.php';
                    $query = "SELECT Asesores.idAsesoria, CONCAT(Alumno.nombre,' ', Alumno.apellido) AS Alumno,Asesores.nombre, Asesores.fecha, Asesores.Motivo, Asesores.observaciones
                    FROM (	
                        SELECT * FROM Asesor 
                        NATURAL JOIN (
                            SELECT *
                            FROM Motivo 
                            NATURAL JOIN Asesoria
                        ) as Motivos 
                    ) AS Asesores
                    INNER JOIN Alumno
                    ON Asesores.idAlumno = Alumno.idAlumno  
                    $where
                    ORDER BY Asesores.fecha DESC";
                    //echo $query;
                    $resultado = $conn->query($query);

                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $fila['idAsesoria']; ?></td>
                            <td class="align-middle"><?php echo $fila['Alumno']; ?></td>
                            <td class="align-middle"><?php echo $fila['nombre']; ?></td>
                            <td class="align-middle"><?php echo $fila['fecha']; ?></td>
                            <td class="align-middle"><?php echo $fila['motivo']; ?></td>
                            <td class="align-middle"><?php echo $fila['observaciones']; ?></td>
                        </tr>
                    <?php
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_dashboard.php'">BACK</button><br>
        </div>
    </div>
</div>
    <?php include 'admin_check.php'; ?>
    </body>