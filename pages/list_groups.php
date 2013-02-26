<h2>Groups</h2>

<ul class="nav nav-pills nav-stacked">
	<?php 
	// Connect to DB
	$conn = connect(); 
	
	// Query groups
	$sql = "SELECT * FROM groups ORDER BY group_name";
	$results = $conn->query($sql);
	
	// Loop over results set
	while(($group = $results->fetch_assoc()) != null) {
		extract($group);
		?>
		<li><a href="./?p=group&id=<?php echo $group_id ?>"><?php echo $group_name?></a></li>		
	<?php	
	}	
$conn->close() ?>
</ul>