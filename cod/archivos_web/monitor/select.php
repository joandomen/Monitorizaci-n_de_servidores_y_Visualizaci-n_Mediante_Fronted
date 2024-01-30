<!DOCTYPE html>
<html>
<head>
  <title>MONITORS</title>
  <meta charset="utf-8">
  <META http-equiv=refresh content=10>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #FF8DC;
  }

  p-5 bg-primary text-white text-center{
        background:red;
        font-size: 20px;
  }
table {
   width: 100%;
   border: 3px solid #000;
}
th, td {
   width: 25%;
   text-align: center;
   vertical-align: top;
   border: 2px solid #000;
   color: black;
}
.red {color:red;
}
.orange {color:orange;
}
.green {color:green;
}

  </style>

<script>

        $(document).ready(function(){

  var mc = {
    '0-19'     : 'green',
    '20-59'    : 'orange',
    '60-100'   : 'red'
  };

function between(x, min, max) {
  return x >= min && x <= max;
}

  var dc;
  var first;
  var second;
  var th;

  $('td').each(function(index){

    th = $(this);

    dc = parseInt($(this).attr('data-color'),10);


    $.each(mc, function(name, value){


first = parseInt(name.split('-')[0],10);
second = parseInt(name.split('-')[1],10);

console.log(between(dc, first, second));

if( between(dc, first, second) ){
  th.addClass(value);
}

});

});
});
</script>
</head>
<body>
<div class="p-5 bg-primary text-white text-center">
  <h1>MONITORS</h1>
  <p>Monitorización de servidores y visualización mediante aplicación web.</p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="index.html">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="select.php">MONITORIZAR</a>
      </li>
    </ul>
  </div>
</nav>
</div>

<?php
$servername = "192.168.1.45";
$username = "usermoni";
$password = "usermonitor";
$dbname = "monitorizacion";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID_PORCENTAJE, POR_CPU, POR_RAM, NOMBRE_EQUIPO FROM monitorizacion.porcentaje ORDER BY ID_PORCENTAJE DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<h3>CONSULTA DE RECURSOS DE PORCENTAJE</h3>";
    echo "<table ><tr><th>ID_PORCENTAJE</th><th>CPU</th><td>RAM</td><td>NOMBRE_EQUIPO</td></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
     echo "<tr><td>" . $row["ID_PORCENTAJE"]. "</td><td  data-color= '".$row["POR_CPU"] . "' class='col'>" . $row["POR_CPU"]. "%</td><td  data-color= '".$row["POR_RAM"] . "'  class='col'>" . $row["POR_RAM"]. "%</td><td  class='col'>". $row["NOMBRE_EQUIPO"]. "</td></tr>";    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<div class="mt-5 p-4 bg-dark text-white text-center">
  <p>Joan Domenech Picó ASIX 21/22 </p>
</div>

</body>
</html>