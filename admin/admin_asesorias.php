<style>
  td[data-href] {
    cursor: pointer;
  }

  td[data-href]:hover {
    background-color: #33a652;
  }
</style>

<?php
include 'navbar_admin.php';


$where = "WHERE TRUE";

$escuela = !empty($_POST['escuela']) ? $_POST['escuela'] : "";
$asesor = !empty($_POST['asesor']) ? $_POST['asesor'] : "";
$anio = !empty($_POST['anio']) ? $_POST['anio'] : "";
$semestre = !empty($_POST['semestre']) ? $_POST['semestre'] : "";
$mes = !empty($_POST['mes']) ? $_POST['mes'] : "";
$rangoDeFechasInicio = !empty($_POST['rangoDeFechasInicio']) ? $_POST['rangoDeFechasInicio'] : "";
$rangoDeFechasFin = !empty($_POST['rangoDeFechasFin']) ? $_POST['rangoDeFechasFin'] : "";

if (isset($_POST['filtrar'])) {

  if ($asesor) $where .= " AND asesor.nombre = '" . $asesor . "' ";
  if ($anio) $where .= " AND YEAR(asesoria.fecha) = '" . $anio . "' ";
  if ($mes) $where .= " AND MONTH(asesoria.fecha) = " . $mes;
  if (isset($_POST['filtroFecha']) && $rangoDeFechasInicio && $rangoDeFechasFin) {
    $where .= " AND asesoria.fecha BETWEEN '$rangoDeFechasInicio' AND '$rangoDeFechasFin'";
  }

}

?>

<div class="container">
  <h4 class="display-4 text-center">Historial de asesorias</h4>
  <br>
  <br>
  <div class="row">
    <form method="POST">
      <div class="row mb-3">
        <div class="col-sm-12">
          <h5>FILTROS</h5>
        </div>
        <div class="col-sm-3">
          <select id="filtroAsesor" class="form-control" name="asesor">
            <option value="" selected>Asesor</option>
            <?php
            include '../config/Conn.php';
            $resultado = $conn->query("SELECT nombre FROM Asesor");
            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
              $nombreAsesor = $fila['nombre'];
            ?>
              <option value="<?php echo $nombreAsesor; ?>"><?php echo $nombreAsesor; ?></option>
            <?php
            }
            $conn->close();
            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <select id="filtroSede" class="form-control" name="sede">
            <option value="" selected>Sede</option>
            <?php
            include '../config/Conn.php';
            $resultado = $conn->query("SELECT nombre FROM Localidad");
            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
              $nombreSede = $fila['nombre'];
            ?>
              <option value="<?php echo $nombreSede; ?>"><?php echo $nombreSede; ?></option>
            <?php
            }
            $conn->close();
            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <select id="filtroEscuela" class="form-control" name="Escuela">
            <option value="" selected>Escuela</option>
            <?php
            include '../config/Conn.php';
            $resultado = $conn->query("SELECT nombre FROM Escuela");
            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
              $nombreEscuela = $fila['nombre'];
            ?>
              <option value="<?php echo $nombreEscuela; ?>"><?=utf8_encode($nombreEscuela)?></option>
            <?php
            }
            $conn->close();
            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <select id="filtroAnio" class="form-control" name="anio">
            <option value="" selected>Año</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-sm-3">
          <select id="filtroSemestre" class="form-control" name="semestre">
            <option value="" selected>Semestre</option>
            <option value="EJ20">Enero-Junio 2020</option>
            <option value="JD19">Julio-Agosto 2019</option>
            <option value="EJ20">Enero-Junio 2019</option>
            <option value="JD18">Julio-Agosto 2018</option>
            <option value="EJ20">Enero-Junio 2018</option>
            <option value="JD17">Julio-Agosto 2017</option>
            <option value="EJ20">Enero-Junio 2017</option>
            <option value="JD16">Julio-Agosto 2016</option>
            <option value="EJ16">Enero-Junio 2016</option>
          </select>
        </div>
        <div class="col-sm-3">
          <select id="filtroMes" class="form-control" name="mes">
            <option value="" selected>Mes</option>
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
      </div>
      <div class="row mb-3">
        <div class="col-sm-12">
          <h5>FILTRAR POR FECHA</h5>
          <input type="checkbox" name="filtroFecha" id="filtroFecha">
        </div>
        <div id="rangoDeFechas" class="form-group col-sm-5">
            <input id="rangoDate" type="text" autocomplete="off" name="fechas" class="form-control">
            <input id="resultStart" type="hidden" name="rangoDeFechasInicio">
            <input id="resultEnd" type="hidden" name="rangoDeFechasFin">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2">
          <button name="filtrar" type="submit" class="btn btn-success">FILTRAR</button>
        </div>
      </div>
    </form>
  </div>
  <div class="row">
      <form action="exportar_csv.php?where=<?=$where?>" method="post">
        <input type="submit" name="exportar" value="Exportar CSV" class="btn btn-warning">
        <input type="hidden" name="where" value="<?=$where?>">
      </form>
  </div>
  <br>
  <div class="row">
    
    <h5>ASESORIAS</h5>
    <div class="table-responsive">
      <table class="table table-striped table-dark table-sm table-bordered">
        <thead>
          <th scope="col">ID</th>
          <th scope="col">Alumno</th>
          <th scope="col">Facilitador</th>
          <th scope="col">Fecha</th>
          <th scope="col">Motivo</th>
          <th scope="col">Observaciones</th>
        </thead>
        <tbody id="pagination">
          <?php
          include '../config/Conn.php';
          $query =
            "SELECT 
                asesoria.idAsesoria AS idAsesoria 
                , alumno.idAlumno AS id 
                , CONCAT(alumno.nombre,' ',alumno.apellido) AS Alumno
                , asesor.idAsesor AS idAsesor
                , asesor.nombre AS Asesor
                , DATE_FORMAT(asesoria.fecha, '%d-%m-%Y') AS Fecha 
                , motivo.motivo AS Motivo
                , integrantes.descripcion AS Dinamica 
                , asesoria.observaciones AS Observaciones
            FROM asesoria 
            JOIN alumno on alumno.idAlumno = asesoria.idAlumno 
            JOIN asesor on asesor.idAsesor = asesoria.idAsesor 
            JOIN motivo on motivo.idMotivo = asesoria.idMotivo 
            JOIN integrantes on integrantes.idIntegrantes = asesoria.idIntegrantes
            $where
            ORDER BY asesoria.idAsesoria DESC";
          //echo $query;
          $resultado = $conn->query($query);
          if (!$resultado) echo "ERROR: " . $conn->error . $query;
          $resultado->data_seek(0);
          while ($fila = $resultado->fetch_assoc()) {
          ?>
            <tr>
              <td class="align-middle"><?php echo $fila['idAsesoria']; ?></td>
              <td data-alumno="" data-href="alumno_historial.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
              <td data-asesor="" data-href="asesorias_facilitador.php" data-id="<?php echo $fila['idAsesor']; ?>" class="align-middle"><?php echo $fila['Asesor']; ?></td>
              <td class="align-middle"><?php echo $fila['Fecha']; ?></td>
              <td class="align-middle"><?php echo $fila['Motivo']; ?></td>
              <td class="align-middle"><?php echo $fila['Observaciones']; ?></td>
            </tr>
          <?php
          }
          $conn->close();

          ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="pagination_page"></ul>
    </div>

    <div class="row">
      <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_dashboard.php'">
        Regresar
      </button>
      <br>
    </div>
  </div>
</div>

<script src="../paginacion/bootstrap-table-pagination.js"></script>
<script src="../paginacion/pagination.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
  $(document).ready(function() {
    $(document.body).on("click", "td[data-alumno]", function() {
      window.location.href = this.dataset.href + "?idAlumno=" + this.dataset.id;
    });
    $(document.body).on("click", "td[data-asesor]", function() {
      window.location.href = this.dataset.href + "?idUsuario=" + this.dataset.id;
    });
  });
</script>

<script src="../js/filtrosPorFecha.js"></script>

</body>

</html>