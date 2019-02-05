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
	var_dump($id);
	try {
		$result = file_get_contents($url.'/'.$id, false, $context);
		
		if ($result === FALSE) { echo'erreur100';	 }
		$result = json_decode($result);
		
		$_SESSION['patient'] = $result;
	} catch (Exception $e) {
		var_dump($e);
	}
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
	sendRequest('GET','',$id);
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

	sendRequest('PUT','$donnees',$id);
}
