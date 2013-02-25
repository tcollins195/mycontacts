<h2>New Contact</h2>
<form class="form-horizontal" action="actions/add_contact.php" method="post">
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
	<div class="control-group">
		<label class="control-label" for="group_id">Group</label>
		<div class="controls">			
			<?php 
				// Connect to DB
				$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			
				// Query groups table
				$sql = "SELECT * FROM groups ORDER BY group_name";
				$results = $conn->query($sql);
				
				$options[0] = 'Select a group';
				// Loop over result set
				while(($group = $results->fetch_assoc()) != null) {
					extract($group);
					$options[$group_id] = $group_name;
				}
				echo dropdown('group_id', $options);
				
				// Close DB connection
				$conn->close();
			?>
		</div>
	</div>	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Add Contact</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>
