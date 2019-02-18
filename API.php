<?php

$url = "http://stu3.test.pyrohealth.net/fhir/Patient";

function sendRequest($methode, $data, $id){
	global $url;
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/fhir+json",
			'method'  => $methode,
			'content' => $data
			)
		);
	$context  = stream_context_create($options);
	try {
		$result = file_get_contents($url.'/'.$id, false, $context);
		
		if ($result === FALSE) { return 1;	 }
		$result = json_decode($result);
		
		$_SESSION['patient'] = $result;
	} catch (Exception $e) {
		var_dump($e);
	}
	return 0;
}

function addPatient($nom, $prenom, $dateNaissance, $genre, $tel, $adr){
	$newDate = date("d-m-Y", strtotime($dateNaissance));

	if($genre == 'M'){
		$genre = 'male';
	} else if($genre == 'F'){
		$genre = 'female';
	} else{
		$genre = 'unknown';
	}

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

function getPatient($id){
	$res = sendRequest('GET','',$id);
	if($res == 1){
		$_SESSION['erreur'] = 'ID inexistant';
	}
}

function deletePatient($id){
	sendRequest('DELETE','',$id);
}

function putPatient($id, $nom, $prenom, $dateNaissance, $genre, $tel, $adr){

	$newDate = date("d-m-Y", strtotime($dateNaissance));

	if($genre == 'M'){
		$genre = 'male';
	} else if($genre == 'F'){
		$genre = 'female';
	} else{
		$genre = 'unknown';
	}

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

	//var_dump($id);

	sendRequest('PUT',$donnees,$id);
}
