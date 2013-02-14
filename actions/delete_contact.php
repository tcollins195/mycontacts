<pre>$_POST: <?php print_r($_POST)?></pre>

<?php
session_start();

// Connect to the DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Execute the query
$sql = "DELETE FROM contacts WHERE contact_id={$_POST['id']}";
$conn->query($sql);

// Close the connection
$conn->close();

$_SESSION['message'] = array(
		'text' => 'Your contact has been deleted.',
		'type' => 'error'
);

// Redirect
header('Location:../?p=list_contacts');











/* session_start();

// Read file into array
$lines = file('../data/colleges.csv',FILE_IGNORE_NEW_LINES);

// Delete the line of that band
unset($lines[$_GET['linenum']]);

// Create the string to write to the file
$data_string = implode("\n", $lines);

// Write the string to the file, overwriting the current contents
$f = fopen('../data/colleges.csv', 'w'); // a+ for append
fwrite($f, $data_string);
fclose($f);

$_SESSION['message'] = array(
		'text' => 'Your college has been deleted.',
		'type' => 'error'
);

// Redirect to the main page
header('Location:../?p=list_colleges'); */
?>