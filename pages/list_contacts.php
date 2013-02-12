<h2>Contacts</h2>
<?php 
echo '<table>
		<tr>
			<th><a href="read.php?sort=firstname">First Name</a></th>
			<th><a href="read.php?sort=lastname">Last Name</a></th>
			<th><a href="read.php?sort=email">Email</a></th>
			<th><a href="read.php?sort=phone">Phone</a></th>
			<th></th>
		</tr>';
// Loop over the contacts & display them
					//		fetches the next row from the results set as associative array 
 // assicative array			* returns null when there are no more results in result set

while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	
	echo '<tr>';
	echo	"<td>$contact_firstname</td>";
	echo	"<td>$contact_lastname</td>";
	echo	"<td><a href=\"mailto:$contact_email\">$contact_email</a></td>";	// excape quotes because string inside quotes
	if($contact_phone != null) {													// ,6,4		or just the last four
		$phone = '('.substr($contact_phone,0,3).') '.substr($contact_phone,3,3).'-'.substr($contact_phone,-4);
	} else {
		$phone = '-';
	}
	echo	"<td>$phone</td>";
	echo	"<td><a href=\"form_edit_contact.php?id=$contact_id\">edit</a>";
	echo 		'<form style="display:inline;" method="post" action="delete.php">';
	echo			"<input type=\"hidden\" name=\"id\" value=\"$contact_id\"/>";
	echo			'<input type="submit" value="delete" />';
	echo		'</form>';
	echo	'</td>';
	echo '</tr>';
	
	
	
/*  	echo '<pre>';
		print_r($contact);
	echo '</pre>'; */	 
}
echo '<table>';

?>