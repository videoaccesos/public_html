<?php
session_start();

if (empty($_SESSION["vauser"]))
{
	header("Location: login.php");
    exit();
}

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'pagination.class.php';

if(!isset($_GET['priv']) || $_GET['priv'] === "")
{
	$_GET['priv'] = "Altezza Villas";
}

$szPrivadas = array(
    
    "Alamos Puertos cerrados" => array(
        "Cam 1" => "http://tallercorona.ddns.net:8250",
		"Cam 2" => "http://tallercorona.ddns.net:8251",
		"Cam 3" => "http://tallercorona.ddns.net:8252",
		"Cam 4" => "http://tallercorona.ddns.net:8253",
		"Cam 5" => "http://tallercorona.ddns.net:8254",
		"Cam 6" => "http://tallercorona.ddns.net:8255",
		"Cam 7" => "http://tallercorona.ddns.net:8256",
		"Cam 8" => "http://tallercorona.ddns.net:8257",
		"Cam 9" => "http://tallercorona.ddns.net:8258",
		),
	/*"Andalucia" => array(
		"Cam 1" => "http://andaluciava2020.ddns.net:8101",
		"Cam 2" => "http://andaluciava2020.ddns.net:8093",
		"Cam 3" => "http://andaluciava2020.ddns.net:8100",
		"Cam 4" => "http://andaluciava2020.ddns.net:8094",
		"Cam 5" => "http://andaluciava2020.ddns.net:8097",
		"Cam 6" => "http://andaluciava2020.ddns.net:8099",
		"Cam 7" => "http://andaluciava2020.ddns.net:8091",
		"Cam 8" => "http://andaluciava2020.ddns.net:8092",
	
		),
	"Andalucia Lateral" => array(
	    "Cam 1" => "http://andaluciava2020.ddns.net:8095",
		"Cam 2" => "http://andaluciava2020.ddns.net:8096",
		"Cam 3" => "http://andaluciava2020.ddns.net:8098",
		),*/
	"Anjanas" => array(
		"Cam 1" => "http://vaanjanas20.sytes.net:8091",
		"Cam 2" => "http://vaanjanas20.sytes.net:8092",
		"Cam 3" => "http://vaanjanas20.sytes.net:8093",
		"Cam 4" => "http://vaanjanas20.sytes.net:8094",
		"Cam 5" => "http://vaanjanas20.sytes.net:8095"
		),
	"Banus PUERTOS" => array(
		"Cam 1" => "http://banus2va2020.sytes.net:8095",
		"Cam 2" => "http://banus2va2020.sytes.net:8092",
		"Cam 3" => "http://banus2va2020.sytes.net:8094",
		"Cam 4" => "http://banus2va2020.sytes.net:8091",
		"Cam 5" => "http://banus2va2020.sytes.net:8093"
		),
	"Buena Vista PUERTOS" => array(
		"Cam 1" => "http://buenavistava0202.ddns.net:8093",
		"Cam 2" => "http://buenavistava0202.ddns.net:8091",
		"Cam 3" => "http://buenavistava0202.ddns.net:8092"
		),
	"Country Courts" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8142",
		"Cam 2" => "http://tallercorona.ddns.net:8141",
		"Cam 3" => "http://tallercorona.ddns.net:8144",
		"Cam 4" => "http://tallercorona.ddns.net:8143",
		),
	"Estancia 2" => array(
		"Cam 1" => "http://estancia2va.ddns.net:8093",
		"Cam 2" => "http://estancia2va.ddns.net:8091",
		"Cam 3" => "http://estancia2va.ddns.net:8095",
		"Cam 4" => "http://estancia2va.ddns.net:8094",
		"Cam 5" => "http://estancia2va.ddns.net:8092",
		),
	"Estancia 7 PROBLEMA IP PUBLICA" => array(
		"Cam 1" => "http://estancia7va2020.ddns.net:8091",
		"Cam 3" => "http://estancia7va2020.ddns.net:8094",
		"Cam 4" => "http://estancia7va2020.ddns.net:8093",
		"Cam 5" => "http://estancia7va2020.ddns.net:8092",
		),
	"Hemisferio SIN IP PUBLICA" => array(
		"Cam 1" => "http://hemisferiova.ddns.net:8091",
		"Cam 2" => "http://hemisferiova.ddns.net:8092",
		"Cam 3" => "http://hemisferiova.ddns.net:8093",
		"Cam 4" => "http://hemisferiova.ddns.net:8094",
		"Cam 5" => "http://hemisferiova.ddns.net:8095",
		"Cam 6" => "http://hemisferiova.ddns.net:8096",
		"Cam 7" => "http://hemisferiova.ddns.net:8097",
		),
	"Iberica" => array(
		"Cam 1" => "http://ibericava8080.ddns.net:8094",
		"Cam 2" => "http://ibericava8080.ddns.net:8092",
		"Cam 3" => "http://ibericava8080.ddns.net:8093",
		"Cam 4" => "http://ibericava8080.ddns.net:8091",
		"Cam 5" => "http://ibericava8080.ddns.net:8095",
		),
	"Interlomas" => array(
		"Cam 1" => "http://interlomasva2020.ddns.net:8091",
		"Cam 2" => "http://interlomasva2020.ddns.net:8093",
		"Cam 3" => "http://interlomasva2020.ddns.net:8097",
		"Cam 4" => "http://interlomasva2020.ddns.net:8094",
		"Cam 5" => "http://interlomasva2020.ddns.net:8096",
		"Cam 6" => "http://interlomasva2020.ddns.net:8095",
		"Cam 7" => "http://interlomasva2020.ddns.net:8092",
			),
	"Interlomas Lateral" => array(
		"Cam 1" => "http://lateralinterva22.ddns.net:8099"
		),
	"Jardines de Monaco" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8221",
		"Cam 2" => "http://tallercorona.ddns.net:8222",
		"Cam 3" => "http://tallercorona.ddns.net:8223",
		"Cam 4" => "http://tallercorona.ddns.net:8224",
		),
	"La Vista" => array(
		"Cam 1" => "http://lavistava2020.ddns.net:8091",
		"Cam 2" => "http://lavistava2020.ddns.net:8093",
		"Cam 3" => "http://lavistava2020.ddns.net:8096",
		"Cam 4" => "http://lavistava2020.ddns.net:8095",
		"Cam 5" => "http://lavistava2020.ddns.net:8094",
		"Cam 6" => "http://lavistava2020.ddns.net:8092",
		),
	"Las Flores INTERNET INESTABLE" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8137",
		"Cam 2" => "http://tallercorona.ddns.net:8138",
		"Cam 3" => "http://tallercorona.ddns.net:8139",
		"Cam 4" => "http://tallercorona.ddns.net:8140",
		),
	"Mediterraneo" => array(
		"Cam 1" => "http://mediterraneova2020.ddns.net:8092",
		"Cam 2" => "http://mediterraneova2020.ddns.net:8094",
		"Cam 3" => "http://mediterraneova2020.ddns.net:8095",
		"Cam 4" => "http://mediterraneova2020.ddns.net:8091",
		"Cam 5" => "http://mediterraneova2020.ddns.net:8093",
		),
	/*"Montecarlo" => array(
	    "Cam 1" => "http://montecarlova2020.sytes.net:8098",
		"Cam 2" => "http://montecarlova2020.sytes.net:8099",
		"Cam 3" => "http://montecarlova2020.sytes.net:8096",
		"Cam 4" => "http://montecarlova2020.sytes.net:8091",
		"Cam 5" => "http://montecarlova2020.sytes.net:8093",
		"Cam 6" => "http://montecarlova2020.sytes.net:8094",
		"Cam 7" => "http://montecarlova2020.sytes.net:8092",
		"Cam 8" => "http://montecarlova2020.sytes.net:8095",
		"Cam 9" => "http://montecarlova2020.sytes.net:8097",
		
		
		),
		
	"Montecarlo L. Entrada" => array( 
	    "Cam 1" => "http://montecarlova2020.sytes.net:8101", 
	  
	    "Cam 2" => "http://montecarlova2020.sytes.net:8103",
	    ),
	
	"Montecarlo L. Salida" => array( 
	    "Cam 1" => "http://montecarlova2020.sytes.net:8100", 
	    ),*/	
	    
	
	"Perla" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8202",
		"Cam 2" => "http://tallercorona.ddns.net:8203",
		"Cam 3" => "http://tallercorona.ddns.net:8204",
		"Cam 4" => "http://tallercorona.ddns.net:8205",
		),
	"Portalegre" => array(
		"Cam 1" => "http://portalegreva0202.ddns.net:8091",
		"Cam 2" => "http://portalegreva0202.ddns.net:8092",
		"Cam 3" => "http://portalegreva0202.ddns.net:8093",
		"Cam 4" => "http://portalegreva0202.ddns.net:8095",
		"Cam 5" => "http://portalegreva0202.ddns.net:8094",
		"Cam 6" => "http://portalegreva0202.ddns.net:8096"
		),
	"Privanzas" => array(
		"Cam 1" => "http://privanzasva2020.ddns.net:8091",
		"Cam 2" => "http://privanzasva2020.ddns.net:8092",
		"Cam 3" => "http://privanzasva2020.ddns.net:8093",
		"Cam 4" => "http://privanzasva2020.ddns.net:8094",
		"Cam 5" => "http://privanzasva2020.ddns.net:8095",
		),
	"Privanzas Center" => array(
		"Cam 1" => "http://privanzascenterva2020.ddns.net:8093",
		"Cam 2" => "http://privanzascenterva2020.ddns.net:8098",
		"Cam 3" => "http://privanzascenterva2020.ddns.net:8095",
		"Cam 5" => "http://privanzascenterva2020.ddns.net:8091",
		"Cam 6" => "http://privanzascenterva2020.ddns.net:8097",
		"Cam 7" => "http://privanzascenterva2020.ddns.net:8096",
		"Cam 8" => "http://privanzascenterva2020.ddns.net:8092"
		),
	"Privanzas Natura SIN INTERNET" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8127",
		"Cam 2" => "http://tallercorona.ddns.net:8122",
		"Cam 3" => "http://tallercorona.ddns.net:8120",
		"Cam 4" => "http://tallercorona.ddns.net:8124",
		"Cam 5" => "http://tallercorona.ddns.net:8125",
		),
	"Pueblo Bonito" => array(
		"Cam 1" => "http://pueblobonitova2020.ddns.net:8091",
		"Cam 2" => "http://pueblobonitova2020.ddns.net:8093",
		"Cam 3" => "http://pueblobonitova2020.ddns.net:8094",
		"cam 4" => "http://pueblobonitova2020.ddns.net:8092",
		),
	"Real Del Country" => array( 
		"Cam 1" => "http://realdelcountryva20.sytes.net:8092",
		"Cam 2" => "http://realdelcountryva20.sytes.net:8093",
		"Cam 3" => "http://realdelcountryva20.sytes.net:8094",
		"Cam 4" => "http://realdelcountryva20.sytes.net:8095",
		"Cam 5" => "http://realdelcountryva20.sytes.net:8097",
		),
	"Rincon Colonial" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8134",
		"Cam 2" => "http://tallercorona.ddns.net:8133",
		"Cam 3" => "http://tallercorona.ddns.net:8136",
		"Cam 4" => "http://tallercorona.ddns.net:8135"
		),
	"Santa Ines" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8200",
		"Cam 2" => "http://tallercorona.ddns.net:8199",
		"Cam 3" => "http://tallercorona.ddns.net:8198",
		),
	"Stanza Solare" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8148",
		"Cam 2" => "http://tallercorona.ddns.net:8147",
		"Cam 3" => "http://tallercorona.ddns.net:8146",
		"Cam 4" => "http://tallercorona.ddns.net:8145",
		),
	"Terracota" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8159",
		"Cam 2" => "http://tallercorona.ddns.net:8158",
		"Cam 3" => "http://tallercorona.ddns.net:8161",
		"Cam 4" => "http://tallercorona.ddns.net:8163",
		"Cam 5" => "http://tallercorona.ddns.net:8160",
		"Cam 6" => "http://tallercorona.ddns.net:8162"
		),
	"Torres Del Rio" => array(
		"Cam 1" => "http://tallercorona.ddns.net:8206",
		"Cam 2" => "http://tallercorona.ddns.net:8207",
		"Cam 3" => "http://tallercorona.ddns.net:8208",
		"Cam 4" => "http://tallercorona.ddns.net:8209",
		),
	"Valencia" => array(
		"Cam 1" => "http://valenciava20.sytes.net:8091",
		"Cam 2" => "http://valenciava20.sytes.net:8092",
		"Cam 3" => "http://valenciava20.sytes.net:8094",
		"Cam 4" => "http://valenciava20.sytes.net:8096",
		"Cam 5" => "http://valenciava20.sytes.net:8097",
		"Cam 6" => "http://valenciava20.sytes.net:8093",
		"Cam 7" => "http://valenciava20.sytes.net:8099",
		"Cam 8" => "http://valenciava20.sytes.net:8098",
		"Cam 9" => "http://valenciava20.sytes.net:8095",
		),
	"Vascos" => array(
		"Cam 1" => "http://vascosva20.sytes.net:8091",
		"Cam 2" => "http://vascosva20.sytes.net:8092",
		"Cam 3" => "http://vascosva20.sytes.net:8093",
		"Cam 4" => "http://vascosva20.sytes.net:8094",
		"Cam 5" => "http://vascosva20.sytes.net:8095",
		"Cam 6" => "http://vascosva20.sytes.net:8096",
		),
	"Villa Logrono" => array(
		"Cam 1" => "http://villalogronova20.ddns.net:8091",
		"Cam 2" => "http://villalogronova20.ddns.net:8092",
		"Cam 3" => "http://villalogronova20.ddns.net:8093",
		"Cam 4" => "http://villalogronova20.ddns.net:8094",
		"Cam 5" => "http://villalogronova20.ddns.net:8095",
		"Cam 6" => "http://villalogronova20.ddns.net:8096"
		),
	"Villa Serena" => array(
		"Cam 1" => "http://villaserenava20.ddns.net:8092",
		"Cam 2" => "http://villaserenava20.ddns.net:8093",
		"Cam 3" => "http://villaserenava20.ddns.net:8091",
		),
	"Zafiro" => array(
		"Cam 1" => "http://zafirova20.sytes.net:8094",
		"Cam 2" => "http://zafirova20.sytes.net:8091",
		"Cam 3" => "http://zafirova20.sytes.net:8093",
		"Cam 4" => "http://zafirova20.sytes.net:8095",
		"Cam 5" => "http://zafirova20.sytes.net:8092",
		)
);


if(!isset($_GET['priv']) || $_GET['priv'] === "")
{
	$_GET['priv'] = "Altezza Villas";
}


$iPriv = 0;
$szPrivButtons = "";
$szPrivContent = array();
$szAllContent = array();

$keys = array_keys($szPrivadas);
for($i = 0; $i < count($szPrivadas); $i++)
{
	if($_GET['priv'] == $keys[$i])
		$szPrivButtons .= '<button class="active" onclick="location.href=\'index.php?priv='.$keys[$i].'\';" >'.$keys[$i].'</button>';
	else
		$szPrivButtons .= '<button onclick="location.href=\'index.php?priv='.$keys[$i].'\';" >'.$keys[$i].'</button>';

	foreach($szPrivadas[$keys[$i]] as $key => $value)
	{
		@$szAllContent[$keys[$i]] .= '<div class="imageHolder">
				<img class="jslghtbx-thmb" src="'.$value.'" alt="" data-jslghtbx>
				<div class="caption"><br>'.$keys[$i].' - '.$key.'</div></div>';

        @$szPrivContent[$keys[$i]][$key] = '<div class="imageHolder">
				<img class="jslghtbx-thmb" src="'.$value.'" alt="" data-jslghtbx>
				<div class="caption"><br>'.$keys[$i].' - '.$key.'</div></div>';
    	}
    }
// onerror="this.onerror=null;this.src='http://example.com/existent-image.jpg';"
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title>[VIDEOACCESOS] CAMARAS</title>

	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/main.css">

</head>
<body>


<div class="list">

	<?php echo $szPrivButtons; ?>

</div>


<div class="content">

	<?php

	if (count($szPrivContent[$_GET['priv']]))
	{
		$pagination = new pagination($szPrivContent[$_GET['priv']], (isset($_GET['page']) ? $_GET['page'] : 1), 6);
		$pagination->setShowFirstAndLast(false);
		$pagination->setMainSeperator(' | ');
		$productPages = $pagination->getResults();

		if (count($productPages) != 0)
		{
			foreach ($productPages as $productArray)
			{
				echo $productArray;
			}

			echo $pageNumbers = '<div class="pagination">'.$pagination->getLinks($_GET).'</div>';
		}
	}
	?>

</div>

	<script src="js/lightbox.js" type="text/javascript"></script>
	<script>
		var lightbox = new Lightbox();
		lightbox.load();
	</script>
</body>
</html>