<?php 
// Check to see if user is searching for a contact
if(isset($_GET['q']) && $_GET['q'] != '') {
	extract($_GET);
	$where = "WHERE contact_lastname OR contact_firstname LIKE '%$q%'";
	$search_message = "<p>Contacts with last name containing '$q'</p>";?> 
	<div class="alert alert-info">Contacts with last name containing '<?php echo $q ?>'
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div> 
	<?php 	
	
	$show_all ='<a href="./">Show all contacts</a></br>';
} else {
	$where = '';
	$search_message = '';
	$show_all = '';
}

?>



<h2>Contacts</h2>

<!-- From read.php in hellomysql -->




<table class="table table-hover">
	<thead>
		<tr>
			<?php 
				if(isset($_GET['q']) && $_GET['q'] != '') {	
					$sort_append = '';
				} else {
					$sort_append = './?';
				}
			
			
			
			
			?>
		
			<th><a href="<?php echo $sort_append ?>sort=firstname">First</a></th>
			<th><a href="<?php echo $sort_append ?>sort=lastname">Last</a></th>
			<th><a href="<?php echo $sort_append ?>sort=email">Email</a></th>
			<th><a href="<?php echo $sort_append ?>sort=phone">Phone</a></th>
			<th>Group</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		// Connect to the database
		//      new mysqli( host,       user,             password,          db name    )
		$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		if(isset($_GET['sort']) && $_GET['sort'] != '') {
			extract($_GET);
			$orderby = "contact_$sort";
		} else {
			$orderby = "contact_lastname ASC, contact_firstname";
		}
		
//		$sql = "SELECT * FROM contacts $where $orderby";
		$sql = "SELECT * FROM contacts LEFT JOIN groups ON contacts.group_id=groups.group_id $where ORDER BY $orderby";
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
			
			<tr data-location="./?p=form_edit_contact&id=<?php echo $contact_id?>">
				<td><?php echo $contact_firstname ?></td>
				<td><?php echo $contact_lastname ?></td>
				<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email?></a></td>	
				<td><?php echo format_phone($contact_phone) ?></td>
				<td><a class="label label-info" href="./?p=group&id=<?php echo $group_id ?>"><?php echo $group_name?></a></td>				
				<?php $onclick = "return confirm('Are you sure you want to delete $contact_firstname?')"?>				
				<td>
					<a class="btn btn-warning" href="./?p=form_edit_contact&id=<?php echo $contact_id?>"><i class="icon-edit icon-white"></i></a> 
					<form  class="form-inline" action="actions/delete_contact.php" method="post">
						<input type="hidden" name="contact_id" value="<?php echo $contact_id?>" />
						<button onclick=<?php echo $onclick ?> class="btn btn-danger" type="submit"><i class="icon-trash icon-white"></i></button>
					</form>
				</td> 
			 </tr>
		<?php }?>
	</tbody>
</table>	
<?php $conn->close();?>