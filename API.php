<?php

$url = "http://stu3.test.pyrohealth.net/fhir/Patient";

//Envoie d'une requete au serveur FHIR
function sendRequest($methode, $data, $id){
	global $url;
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/fhir+json",
			'method'  => $methode, //méthode http demandé
			'content' => $data //données envoyées
			)
		);
	$context  = stream_context_create($options);
	try {
		$result = file_get_contents($url.'/'.$id, false, $context); //précision de l'id si besoin
		
		if ($result === FALSE) { return 1;	 }
		$result = json_decode($result);
		
		$_SESSION['patient'] = $result;
	} catch (Exception $e) {
		var_dump($e);
	}
	return 0;
}

//ajout d'un patient
function addPatient($nom, $prenom, $dateNaissance, $genre, $tel, $adr){
	$newDate = date("d-m-Y", strtotime($dateNaissance));

	if($genre == 'M'){
		$genre = 'male';
	} else if($genre == 'F'){
		$genre = 'female';
	} else{
		$genre = 'unknown';
	}

	//construction du json a envoyer un serveur FHIR
	$donnees = array( 'resourceType' => 'Patient',
		'name' => 
		array('use' => 'official', 'family' => $nom, 'given' => array($prenom)), 
		'birthDate' => $newDate,
		'gender' => $genre,
		'telecom' =>
		array('system' => 'phone', 'value' => $tel, 'use' => 'mobile'),
		'address' =>
		array('use' => 'home', 'city' => $adr)
		);

	$donnees = json_encode($donnees);

	sendRequest('POST', $donnees, '');
}

//recherche d'un patient
function getPatient($id){
	$res = sendRequest('GET','',$id); //id du patient recherché
	if($res == 1){
		$_SESSION['erreur'] = 'ID inexistant';
	}
}

//suppression d'un patient
function deletePatient($id){
	sendRequest('DELETE','',$id);
}

//modification d'un atient
function putPatient($id, $nom, $prenom, $dateNaissance, $genre, $tel, $adr){
	$newDate = date("d-m-Y", strtotime($dateNaissance));

	if($genre == 'M'){
		$genre = 'male';
	} else if($genre == 'F'){
		$genre = 'female';
	} else{
		$genre = 'unknown';
	}

	//construction du json a envoyer un serveur FHIR
	$donnees = array( 'resourceType' => 'Patient',
		'id' => $id,
		'name' => 
		array('use' => 'official', 'family' => $nom, 'given' => array($prenom)), 
		'birthDate' => $newDate,
		'gender' => $genre,
		'telecom' =>
		array('system' => 'phone', 'value' => $tel, 'use' => 'mobile'),
		'address' =>
		array('use' => 'home', 'city' => $adr)
		);

	$donnees = json_encode($donnees);

	sendRequest('PUT',$donnees,$id);
}
