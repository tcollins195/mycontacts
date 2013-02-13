<pre>$_POST: <?php print_r($_POST)?></pre>

<?php
session_start();

// Extract POST data to variables
extract($_POST);

// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','s9D8HZJ3T8QBtuRZ','mycontacts');

// Execute the query
$sql = "UPDATE contacts 
		SET contact_firstname='$contact_firstname', contact_lastname='$contact_lastname', contact_email='$contact_email', contact_phone=$contact_phone 
		WHERE contact_id={$_POST['id']}";
$conn->query($sql);

if($conn->errno > 0) {
	echo $conn->error;
}

// Close the connection
$conn->close();

$_SESSION['message'] = array(
		'text' => 'Your band has been edited.',
		'type' => 'info'
);

// Redirect
header('Location:../?p=list_contacts');
?>
