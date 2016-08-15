<?php 
/*$username = "root"; $pass="Buzzphp369";$db="angdb";

 mysql_connect("localhost",$username,$pass);
@mysql_select_db("angdb");

$result = mysql_query("select * from users ");

$userArr = array();



while($row = mysql_fetch_assoc($result) )
{


 $userArr[] = $row;


} */

$connection = new MongoClient();
$db = $connection->selectDB('angdb');
$collection = $db->users;

$cursor = $collection->find();
$userArr = array();
foreach($cursor as $id=>$val)
{
	
	foreach($val as $key=>$value)
	{
		$userArr[$id][$key] = $value;
	}
}


header('Content-Type: application/json');
 echo json_encode($userArr);
?>


