<h2>Contacts</h2>

<!-- From read.php in hellomysql -->




<table class="table table-hover">
	<thead>
		<tr>
			<th><a href="read.php?sort=firstname">First</a></th>
			<th><a href="read.php?sort=lastname">Last</a></th>
			<th><a href="read.php?sort=email">Email</a></th>
			<th><a href="read.php?sort=phone">Phone</a></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
	
	
	<?php
	// Connect to the database
	//      new mysqli( host,       user,             password,          db name    )
	$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	// Read (SELECT) contacts from the database			exclude quotes
	if(isset($_GET['q']) && $_GET['q'] != '') {
		$where = "WHERE contact_lastname LIKE '%{$_GET['q']}%'";
		$search_message = "<p>Contacts with last name containing '{$_GET['q']}'</p>";
		$show_all ='<a href="read.php">Show all contacts</a></br>';
	} else {
		$where = '';
		$search_message = '';	
		$show_all = '';
	}
	
	if(isset($_GET['sort']) && $_GET['sort'] != '') {
		$orderby = "ORDER BY contact_{$_GET['sort']}";
	} else {
		$orderby = "ORDER BY contact_lastname ASC, contact_firstname";
	}
	
	$sql = "SELECT * FROM contacts $where $orderby";
								//		 contact_phone IS NULL
								//		 contact_phone 4026794965
	$results = $conn->query($sql);		// in java would be conn.query		function on conn
	
	// If there was a MySQL error on the last query,
	// display error and kill the currnet script
	if($conn->errno > 0) {
		echo $conn->error;
		die();		// die() stops execute of the rest of the code
	}
	
	echo $search_message;
	echo $show_all;
	
	// Loop over the contacts & display them
	//		fetches the next row from the results set as associative array
	// assicative array			* returns null when there are no more results in result set	
	while(($contact = $results->fetch_assoc()) != null) {
		extract($contact);
		?>
		
		<tr>
			<td><?php echo $contact_firstname ?></td>
			<td><?php echo $contact_lastname ?></td>
			<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email?></a></td>	
			<td><?php echo format_phone($contact_phone) ?></td>
			
			 <td><a href="./?p=form_edit_contact&id=$contact_id" class="btn btn-warning"><i class="icon-edit icon-white"></i></a>
				 <a href="./actions/delete_contact.php?$contact_id" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
		 </tr>
	<?php }?>
	</tbody>
</table>	
<?php $conn->close();?>