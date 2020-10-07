<?php

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Indica los métodos permitidos.
	header('Access-Control-Allow-Origin: https://cabifyactivaciones.scm.azurewebsites.net:443/cabifyactivaciones.git');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
    
    // Indica los encabezados permitidos.
    header('Access-Control-Allow-Headers: Authorization');
    http_response_code(204);
}
header('Content-Type: application/json');
//conexion con la base de datos y el servidor
	
	
// PHP Data Objects(PDO):
try {
    $conn = new PDO ("sqlsrv:server = tcp:symphony-server-cabify.database.windows.net,1433; Database = activaciones_CCA", "symphony-root", "Aquiestoy1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server :( ");
    die(print_r($e));
}

//Detectamos si ID tiene información
//if(isset($_POST['jsonObj']))
//	{
        //echo $_POST['jsonObj'] [0]['value'];

		
		
		$sql = "SELECT  * FROM datos_cca"; 
		$row = $conn->query($sql)->fetch();
        echo json_encode($row);

//};



?>

