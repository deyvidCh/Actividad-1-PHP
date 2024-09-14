<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Empleados</title>
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
          <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/"target="_blank">Umg</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="empleados.php">Empleados</a></li>
            <li><a class="dropdown-item" href="empleado.php">Nuevo</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php">Inicio</a></li>
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
    </form>
    <table class="table table-striped table-inverse table-responsive">
      <thead>
        <tr>
            <th>Codigo</th>
            <th>Nomrbres</th>
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
        $db_conexion = mysqli_connect ($db_host,$db_user,$db_pass,$db_db);
            if ($db_conexion){
                $db_conexion -> real_query("SELECT e.id_empleado as id,e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,p.puesto,e.fecha_nacimiento FROM empleados as e inner join puestos as p on e.id_puesto = p.id_puesto order by codigo;");
                $resultado = $db_conexion -> use_result();
                while($fila = $resultado -> fetch_assoc()){
                  echo"<tr data-id=" .$fila ['id'].">";
                  echo "<td>" .$fila ['codigo']."</td>";
                  echo "<td>" .$fila ['nombres']."</td>";
                  echo "<td>" .$fila ['apellidos']."</td>";
                  echo "<td>" .$fila ['direccion']."</td>";
                  echo "<td>" .$fila ['telefono']."</td>";
                  echo "<td>" .$fila ['puesto']."</td>";
                  echo "<td>" .$fila ['fecha_nacimiento']."</td>";
                  echo"<tr>";
                }
                
            }
            $db_conexion ->close();
    ?> 
      </tbody>
    </table> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>