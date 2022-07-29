<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8"/>
    <meta name = "description" content = "Assignment 2"/>
    <meta name = "keywords" content ="cos20019.aws.cloud"/>
    <meta name = "author" content = "Ngo Cong Thanh - 103433609">
    <title>View Photo Album</title>
  
</head>
<body>

<?php
	require_once "setting.php";	
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	if (!$conn) {
		echo "<p> Database connection failure</p>".mysqli_connect_error();
	} 
	else{
		$title = trim($_POST["PhotoTitle"]);
		$datestart = trim($_POST["DateStart"]);
		$datefinish = trim($_POST["DateFinish"]);
		$keyword = trim($_POST["Keywords"]);
		
	$sql_table = "Photos";
	$istitle = false;
	$isdatestart = false;
	$isdatefinish = false;
	$iskeyword = false;
	
	if($title > ""){
		$istitle = true;
	}
	if($datestart > ""){
		$isdatestart = true;
	}
	if($datefinish > ""){
		$isdatefinish = true;
	}
	if($keyword > ""){
		$iskeyword = true;
	}
	
	//1111checked
	if($istitle && $isdatestart && $iskeyword && $isdatefinish){
		echo("1111");
		$query = "SELECT * FROM $sql_table where $sql_table.title like '$title' and ($sql_table.date BETWEEN '$datestart' and '$datefinish' OR ($sql_table.date like '$datefinish' OR $sql_table.date like '$datestart')) or keyword like '$keyword' group by $sql_table.title";	 
	}
	//1011checked
	else if($istitle && !$isdatestart && $iskeyword && $isdatefinish){
		echo("1011");
		$query = "SELECT * FROM $sql_table where $sql_table.title like '$title' and $sql_table.keyword like '$keyword' and $sql_table.$sql_table.date like '$datefinish'";
	}
	//1101notworking
	else if($istitle && $isdatestart && !$iskeyword && $isdatefinish){
		echo("1101");
		$query = "SELECT * FROM $sql_table  where $sql_table.title like '$title' and $sql_table.date BETWEEN '$datestart' and '$datefinish'";
	}
	
	//0111 checked
	else if(!$istitle && $isdatestart && $iskeyword && $isdatefinish){
		echo("0111");
		$query = "SELECT * FROM $sql_table  where ($sql_table.date BETWEEN '$datestart' and '$datefinish' OR ($sql_table.date like '$datefinish' OR $sql_table.date like '$datestart'))and keyword like '$keyword'";
	}
	//0011 checked
	else if(!$istitle && !$isdatestart && $iskeyword && $isdatefinish){
		echo("0011");
		$query = "SELECT  * FROM $sql_table  where keyword like '$keyword' or $sql_table.date like '$datefinish' group by $sql_table.title";	 
	}
	//0101notworking
	else if(!$istitle && $isdatestart && !$iskeyword && $isdatefinish){
		echo("0101");
		$query = "SELECT * FROM $sql_table  where $sql_table.date BETWEEN '$datestart' and '$datefinish'";	 
	}
	//1001verynotworking
	else if($istitle && !$isdatestart && !$iskeyword && $isdatefinish){
		echo("1001");
		$query = "SELECT * FROM $sql_table  where $sql_table.title like '$title' and $sql_table.date like '$datefinish'";	
	}
	//0001notworking
	else if(!$istitle && !$isdatestart && !$iskeyword && $isdatefinish){
		echo("0001");
		$query = "SELECT * FROM $sql_table  where $sql_table.date like '$datefinish'";	 
	}
	
	//1110checked
	else if($istitle && $isdatestart && $iskeyword && !$isdatefinish){
		echo("1110");
		$query = "SELECT * FROM $sql_table  where $sql_table.title like '$title' and $sql_table.date like '$datestart'and keyword like '$keyword'";	 
	}
	//1010checked
	else if($istitle && !$isdatestart && $iskeyword && !$isdatefinish){
		echo("1010");
		$query = "SELECT * FROM $sql_table  where $sql_table.title like '$title' and keyword like '$keyword'";
	}
	//1100notworking
	else if($istitle && $isdatestart && !$iskeyword &&!$isdatefinish){
		echo("1100");
		$query = "SELECT * FROM $sql_table AS P INNER JOIN keywords AS K ON P.'title' = K.title where $sql_table.title like '$title' and  $sql_table.date like '$datestart'";
	}
	//0110 checked
	else if(!$istitle && $isdatestart && $iskeyword && !$isdatefinish){
		echo("0110");
		$query = "SELECT * FROM $sql_table  where $sql_table.date like '$datestart' and keyword like '$keyword'";
	}
	//0010 checked
	else if(!$istitle && !$isdate && $iskeyword && !$isdatefinish){
		echo("0010");
		$query = "SELECT * FROM $sql_table  where keyword like '$keyword'";	 
	}
	//0100notworking
	else if(!$istitle && $isdate && !$iskeyword && !$isdatefinish){
		echo("0100");
		$query = "SELECT * FROM $sql_table  where $sql_table.date like '$datestart'";	 
	}
	//1000verynotworking
	else if($istitle && !$isdate && !$iskeyword && !$isdatefinish){
		echo("1000");
		$query = "SELECT * FROM $sql_table WHERE title = '$title'";	
	}
	//0000checked
	else if(!$istitle && !$isdate && !$iskeyword && !$isdatefinish){
		echo("0000");
		$query = "SELECT * FROM $sql_table ";	 
	}
	else{
		$query = "SELECT * FROM $sql_table ";
	}
	
	$result = mysqli_query($conn,$query);
		if (!$result) {					
		echo "<p> Something is wrong with query</p>";
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
		else {
				
		echo "<table border = \"1\">\n";
		echo "<tr>\n"
			."<th scope =\"col\"> title </th>\n"
			."<th scope =\"col\"> date </th>\n"
			."<th scope =\"col\"> keyword </th>\n"
			."<th scope =\"col\"> description </th>\n"
			."<th scope =\"col\"> reference </th>\n"
			."</tr>\n";
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<tr>\n";
			echo "<td>",htmlspecialchars($row['title']),"</td>\n";
			echo "<td>",htmlspecialchars($row['date']),"</td>\n";
			echo "<td>",htmlspecialchars($row['keyword']),"</td>\n";
			echo "<td>",htmlspecialchars($row['description']),"</td>\n";
			echo "<td>",htmlspecialchars($row['reference']),"</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
		mysqli_free_result($result);
		}
		mysqli_close ($conn);					// Close the database connect
	} 
	
?>	
</body>
</html>