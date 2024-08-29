<?php
   
   include('db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Enlace</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

<style>
	div.container {
		width: 96%;
		max-width: 960px;
		margin: 0 auto;
		}
		img {
		width: 100%;
		height: auto;
	}
</style>     
</head>
<body> 
<div id=contenido class="divPanel page-content">
<?php
	//setlocale(LC_TIME,"es_MX.UTF-8");
	//setlocale(LC_TIME, 'spanish');
	//mysqli_query('SET lc_time_names = es_ES');
	include('db.php');
	$sql="Select id,titulo, contenido,DATE_FORMAT(fecha,'%d - %b - %Y') AS fecha, publicar from noticias where publicar='si' order by fechaPublicacion desc";

	$datos=mysqli_query($conn, $sql) or die("Error de SQL");
	echo "<table border=0 cellpadding='20' class='table-responsive'>";
	while($reg=mysqli_fetch_array($datos))
	{
      echo "<tr>";
	  $titulo = mb_strtoupper($reg['titulo'], 'UTF-8');
	  echo "<td><b><font color='green' size='4'>$titulo </font></b> <br/>";  
	  echo "Publicado: ".$reg['fecha']."</td>";
	  echo "</tr>";	
	  if($reg['imagen1']!=='') 
	  { 	    
       echo "<tr>";
	   echo "<td><div>
	   <img src=../img/jpg/".str_replace(" ","%20",$reg['imagen1'])." align=center>
	   </div>
	   </td>";
	  echo "</tr>";
	  }
	  echo "<tr>";
	  echo "<td align=justify>".$reg['contenido']." <br/></td>";
	  echo "</tr>";   
	}   // Fin del while
	echo "</table>";
	mysqli_free_result($datos);
	mysqli_close($conn);
?>
</div>
</body>
</html>