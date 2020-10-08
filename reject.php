<?php

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Indicamos al server los métodos permitidos.
	header('Access-Control-Allow-Origin: https://cabifyactivaciones.scm.azurewebsites.net:443/cabifyactivaciones.git');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
    // Indicamos los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);
}
header('Content-Type: application/json');
//conexion con la base de datos y el servidor
//PHP Data Objects(PDO) :
try {
    $conn = new PDO ("sqlsrv:server = tcp:symphony-server-cabify.database.windows.net,1433; Database = activaciones_CCA", "symphony-root", "Aquiestoy1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Cabify Activation Server :( ");
    die(print_r($e));
}


	//echo $_POST['jsonObj']['value'];
	//Creación de variables
	 $ID				= $_POST['jsonObj']['value'];
	 $Status_Final		= $_POST['jsonObj']['value2'];
	//obtenemos los valores del formulario del Licencia 

				
			
$Trabajado_Por = "Agente1";
$currDate = getDate(); 
$FechaUsuario = $currDate['year'] . "-" . $currDate['mon'] . "-" . $currDate['mday']  . " " .  $currDate['hours'] . $currDate['minutes'] . $currDate['seconds'] ;
// Update SQL Server Query:
$sql = 	    "UPDATE datos_cca SET    Status_Final=?, Trabajado_Por=?,  Fecha_Hora=? WHERE ID=?";
$stmt= $conn->prepare($sql);
$stmt->execute([$Status_Final, $Trabajado_Por, $FechaUsuario, $ID]);
//$sql2 = "SELECT * FROM datos_cca WHERE ID = $ID"; 
//$row = $conn->query($sql2)->fetch();
//echo json_encode($row);
//};
//};		
?>
