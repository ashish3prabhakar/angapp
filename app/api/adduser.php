<?php ob_start(); 
/*$username = "root"; $pass="Buzzphp369";$db="angdb";

 mysql_connect("localhost",$username,$pass);
@mysql_select_db("angdb");


$insQry = "insert into users (firstname, lastname, emailid) values ('" . $_POST['firstname'] . "','". $_POST['lastname'] . "','". $_POST['emailid'] . "')";
$insResult = mysql_query($insQry);

$sQry = " SELECT * from users ";
$sResult = mysql_query($sQry);
$users = array();
while($row = mysql_fetch_assoc($sResult)){
$users[] = $row;
}
*/

$connection = new MongoClient();
$db = $connection->selectDB('angdb');
$collection = $db->users;

$postvar = $_POST;
$ins = $collection->insert($postvar);

$cursor = $collection->find();
$userArr = array();
foreach($cursor as $id=>$val)
{
	
	foreach($val as $key=>$value)
	{
		$userArr[$id][$key] = $value;
	}
}
$insResponse = array("message"=>"Record added successfully","status"=>"success","users"=>$userArr); 


//print_r($_POST);
//Print_r($_GET);



header('Content-Type: application/json');
 echo json_encode($insResponse);
?>


