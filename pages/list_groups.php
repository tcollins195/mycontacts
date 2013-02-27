<h2>Groups</h2>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Group</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		// Connect to DB
		$conn = connect();
		
		// Query groups
//		$sql = "SELECT * FROM groups ORDER BY group_name";  // SELECT group_name, CAST(GROUP_CONCAT(CONCAT_WS(',',contact_id,contact_firstname,contact_lastname) SEPARATOR'|')AS CHAR)AS group_contacts FROM groups LEFT JOIN contacts ON groups.group_id=contacts.group_id GROUP BY groups.group_id ORDER BY group_name
		
		$sql = 'SELECT groups.*, COUNT(contact_id) AS num_contacts FROM groups LEFT JOIN contacts ON groups.group_id=contacts.group_id GROUP BY group_id ORDER BY group_name';
		$results = $conn->query($sql);
		
		// Loop over results set
		while(($group = $results->fetch_assoc()) != null) {
				extract($group); ?>
			<tr>
				<td><a href="./?p=group&id=<?php echo $group_id ?>"><?php echo $group_name?></a></td>
				<td><span class="badge"><?php echo $num_contacts?></span></td>				
			</tr>			
			<?php	
			}	
		$conn->close() ?>
	</tbody>
</table>	






