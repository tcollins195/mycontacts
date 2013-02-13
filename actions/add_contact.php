<?php session_start() ?>

<!-- <pre><?php print_r($_POST) ?></pre> -->



<?php
require('../config/db.php');

$required = array(
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone1',
	'contact_phone2',
	'contact_phone3'
);

// Extract POST data to variables
extract($_POST);

foreach($required as $r) {
	// If invalid, redirect with message
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
		// Store message into session
		$_SESSION['message'] = array(
				'text' => 'Please enter all required information.',
				'type' => 'block'
		);
		
		// Store form data into session
		$_SESSION['POST'] = $_POST;
		
		// Set location header
		header('Location:../?p=form_add_contact');
		
		// Kill script
		die();
	}
}

// Now that we know all fields have been inputted..

// Connect to DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;

// Execute query
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone) VALUES ('$contact_firstname','$contact_lastname','$contact_email',$contact_phone)";
$conn->query($sql);

if($conn->errno > 0) {
	echo $conn->error;
}

// Close DB connection
$conn->close();

$_SESSION['message'] = array(
		'text' => 'Your contact has been added.',
		'type' => 'success'
);

// Redirect to the main page
header('Location:../?p=list_contacts');




