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


        //echo $_POST['jsonObj'] [0]['value'];
        $ID			    	= $_POST['jsonObj']['value'];
        $Trabajado_Por		= $_POST['jsonObj']['value2'];
        $currDate = getDate(); // generas un llamado al metodo

$FechaUsuario = $currDate['year'] . "-" . $currDate['mon'] . "-" . $currDate['mday']  . " " .  $currDate['hours'] . $currDate['minutes'] . $currDate['seconds'] ;
$currentid2  =  $ID ;

 $sql = 	    "UPDATE datos_cca SET Trabajado_Por=?,  Fecha_Hora=?  WHERE ID=?";
//$sql = 	    "UPDATE datos_cca SET Fecha_Hora=?   WHERE ID=?";
$stmt= $conn->prepare($sql);
$stmt->execute([$Trabajado_Por, $FechaUsuario , $currentid2]);
//$stmt->execute([$FechaUsuario , $currentid2]);

		
		$currentid =   $ID	;
		$sql = "SELECT TOP 1 * FROM datos_cca WHERE ID > $currentid And Trabajado_Por = ''  ORDER BY ID "; 
		$row = $conn->query($sql)->fetch();
        
        echo json_encode($row);
        

        $currentid2  =  $row[0] ;

        $sql = 	    "UPDATE datos_cca SET Trabajado_Por=?,  Fecha_Hora=?  WHERE ID=?";
       //$sql = 	    "UPDATE datos_cca SET Fecha_Hora=?   WHERE ID=?";
       $stmt= $conn->prepare($sql);
       $stmt->execute([$Trabajado_Por, $FechaUsuario , $currentid2]);
       
        //};

?>

