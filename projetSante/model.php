<?php
/****** Connexion au serveur de BdD *******/
function ConnectDB() {
	$id = new PDO('mysql:host=localhost;dbname=code_barre;charset=utf8', 'admin', 'admin');
	return $id;
}

function exectuterRequete($id,$req,$tableauDeDonnees){
	$res=preparerRequete($id,$req);
	$res=exectuterRequetePrepare($res,$tableauDeDonnees);
	return extraireDonneesRequetePrepare($res);

}

function preparerRequete($id,$req){
	$res=$id->prepare($req, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	return $res;
}

function exectuterRequetePrepare($res,$tableauDeDonnees){
	$res->execute($tableauDeDonnees);
  return $res;
}

function extraireDonneesRequetePrepare($res){
	  return $res->fetchAll(PDO::FETCH_ASSOC);
}

function recupererLeDernierIdInserer($id){
	  return $id->lastInsertId();
}

function fermerCursor($res){
	$res->closeCursor();
}

function executerRequeteCurl($donnees,$method){
  $url='http://ip/MW08/rest_tello.php/';
  $url.=$donnees;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL,$url );
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));

  $tabListMission=curl_exec($curl);curl_error($curl);
	curl_close($curl);
  $ListMissionJSON=json_decode($tabListMission,true);

  return $ListMissionJSON;
}


?>
