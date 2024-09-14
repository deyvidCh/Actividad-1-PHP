<?php
ob_start(); 

if (isset($_POST["btn_crear"])) {
    include("datos_conexion.php");
    $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
    $txt_codigo = utf8_decode($_POST["txt_codigo"]);
    $txt_nombres = utf8_decode($_POST["txt_nombres"]);
    $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $drop_puesto = utf8_decode($_POST["drop_puesto"]);
    $txt_fn = utf8_decode($_POST["txt_fn"]);
    $sql = "INSERT INTO empleados(codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) VALUES ('" . $txt_codigo . "','" . $txt_nombres . "','" . $txt_apellidos . "','" . $txt_direccion . "','" . $txt_telefono . "','" . $txt_fn . "'," . $drop_puesto . ");";
    if ($db_conexion->query($sql) === true) {
        $db_conexion->close();
        header("Refresh:0");
        exit;
    } else {
        echo "Error" . $sql . "<br>" . $db_conexion->close();
    }
}

ob_end_flush(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/" target="_blank">Umg</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="empleados.php">Empleado</a></li>
                            <li><a class="dropdown-item" href="empleado.php">Nuevo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Vacio</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>   
</header>
<h1>Formulario Empleado</h1>
<div class="container">
    <form action="#" method="post" class="form-group needs-validation" novalidate>
        <label for="lbl_id" class="form-label"><b>ID</label>
        <input type="text" class="form-control" name="txt_id" value="0" readonly>
        <label for="lbl_codigo" class="form-label"><b>Codigo</label>
        <input type="text" class="form-control" name="txt_codigo" placeholder="Ej:E001" pattern="[E]{1}[0-9]{3}" required>
        <label for="lbl_nombres" class="form-label"><b>Nombres</label>
        <input type="text" class="form-control" name="txt_nombres" placeholder="Ej:Nombre 1 Nombre 2" required>
        <label for="lbl_apellidos" class="form-label"><b>Apellidos</label>
        <input type="text" class="form-control" name="txt_apellidos" placeholder="Ej:Apellido 1 Apellido 2" required>
        <label for="lbl_direccion" class="form-label"><b>Direccion</label>
        <input type="text" class="form-control" name="txt_direccion" placeholder="Ej:casa 23 zona 1" required>
        <label for="lbl_telefono" class="form-label"><b>Telefono</label>
        <input type="number" class="form-control" name="txt_telefono" placeholder="Ej:34567890" required>
        <label for="lbl_fn" class="form-label"><b>Nacimiento</label>
        <input type="date" class="form-control" name="txt_fn" placeholder="Ej:10/02/1997" required>
        <label for="lbl_puesto" class="form-label"><b>Puesto</label>
        <select name="drop_puesto" id="drop_puesto" class="form-select" required>
            <option selected disabled value="">Seleccione</option>
            <?php
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
                if ($db_conexion) {
                    $db_conexion->real_query("select id_puesto as id, puesto from puestos");
                    $resultado = $db_conexion->use_result();
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value=" . $fila['id'] . ">" . $fila['puesto'] . "</option>";
                    }
                }
                $db_conexion->close();
            ?>
        </select>
        </br>
        <button class="btn btn-primary" name="btn_crear" id="btn_crear" value="crear"><i class="bi bi-floppy"></i> Crear</button>
        <button class="btn btn-warning" name="btn_actualizar" id="btn_actualizar" value="crear"><i class="bi bi-pencil-fill"></i> Actualizar</button>
        <button class="btn btn-danger" name="btn_borrar" id="btn_borrar" value="crear"><i class="bi bi-trash-fill"></i> Borrar</button>
        </br>
    </form>
    <table class="table table-striped table-inverse table-responsive">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Puesto</th>
                <th>Nacimiento</th>  
            </tr>
        </thead>
        <tbody>
            <?php
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
                if ($db_conexion) {
                    $db_conexion->real_query("SELECT e.id_empleado as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, p.puesto, e.fecha_nacimiento FROM empleados as e inner join puestos as p on e.id_puesto = p.id_puesto order by codigo;");
                    $resultado = $db_conexion->use_result();
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr data-id=" . $fila['id'] . ">";
                        echo "<td>" . $fila['codigo'] . "</td>";
                        echo "<td>" . $fila['nombres'] . "</td>";
                        echo "<td>" . $fila['apellidos'] . "</td>";
                        echo "<td>" . $fila['direccion'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['puesto'] . "</td>";
                        echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                        echo "</tr>";
                    }
                }
                $db_conexion->close();
            ?> 
        </tbody>
    </table> 
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0YJTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
