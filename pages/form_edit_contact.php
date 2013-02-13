<?php 
require('../config/db.php');

// Connect to the DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Excute SELECT query
$sql = "SELECT * FROM contacts WHERE contact_id={$_GET['id']}";
$results = $conn->query($sql);

// Store the contact data into variables
$contact = $results->fetch_assoc();
extract($contact);

// Close the connection
$conn->close();

?>

<h2>Edit Contact</h2>
<form class="form-horizontal" action="actions/edit_contact.php" method="post">
	<div class="control-group">
		<label class="control-label" for="contact_name">Name</label>
		<div class="controls">
			<?php echo input('contact_firstname', 'first name')?>
			<?php echo input('contact_lastname', 'last name')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_email">Email</label>
		<div class="controls">
			<?php echo input('contact_email', 'you@example.com')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_phone1">Phone</label>
		<div class="controls">
			(<?php echo input('contact_phone1', '999',null,'phone span1')?>)
			<?php echo input('contact_phone2', '888',null,'phone span1')?> - 
			<?php echo input('contact_phone3', '7777',null,'phone span2')?>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Add Contact</button>
		<button type="button" class="btn">Cancel</button>
	</div>
</form>






<form action="update.php" method="post">
	<label>First Name</label>
	<input type="text" name="contact_firstname" value="<?php echo $contact_firstname?>" />
	<br/>
	
	<label>Last Name</label>
	<input type="text" name="contact_lastname" value="<?php echo $contact_lastname?>" />
	<br/>
	
	<label>Email</label>
	<input type="text" name="contact_email" value="<?php echo $contact_email?>" />
	<br/>
	
	<label>Phone number</label>
	<input type="text" name="contact_phone" value="<?php echo $contact_phone?>" />
	<br/>
												
	<input type="hidden" name="id" value="<?php echo $contact_id ?>" />	<!-- $_GET['id'] -->
	<input type="submit" value="Confirm Changes" />
</form>
