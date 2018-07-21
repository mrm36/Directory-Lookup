<?php 
$connect = mysqli_connect("localhost", "root", "", "directory");
$response = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM directoryInfo 
	WHERE firstName LIKE '%".$search."%'
	OR lastName LIKE '%".$search."%'  
	OR phone LIKE '%".$search."%' 
	OR email LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM directoryInfo ORDER BY lastName";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$response .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Last Name</th>
							<th>First Name</th>
						
							<th>Email</th>
							<th>Extension</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$response .= '
			<tr>
				<td>'.$row["lastName"].'</td>
				<td>'.$row["firstName"].'</td>
				
				<td>'.$row["email"].'</td>
				<td>'.$row["phone"].'</td>
			</tr>
		';
	}
	echo $response;
}
else
{
	echo 'No Results';
}
?>
