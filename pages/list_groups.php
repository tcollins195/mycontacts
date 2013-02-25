<h2>Groups</h2>

<ul>
	<?php 
	$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	$sql = "SELECT * FROM groups ORDER BY group_name";
	$results = $conn->query($sql);
	
	while(($group = $results->fetch_assoc()) != null) {
		extract($group);
		?>
		<li><a href="./?p=group&id=<?php echo $group_id ?>"><?php echo $group_name?></a></li>		
	<?php	
	}	
$conn->close() ?>
</ul>