<?php ob_start(); 
/*$username = "root"; $pass="Buzzphp369";$db="angdb";

 mysql_connect("localhost",$username,$pass);
@mysql_select_db("angdb");

$userArr = $_POST;
$userid = $userArr['userid'];


$insQry = "delete from users where userid = " . $userid;
$insResult = mysql_query($insQry);

$selQry = " select userid, firstname, lastname, emailid from users ";
$qryResult = mysql_query($selQry);
$userData = array();
while($qRow = mysql_fetch_assoc($qryResult)){
$userData[] = $qRow; 
}
*/

$connection = new MongoClient();
$db = $connection->selectDB('angdb');
$collection = $db->users;

$usrArr  = array("_id"=> new MongoId($_POST['userid']));
$ins = $collection->remove($usrArr);

$cursor = $collection->find();
$userArr = array();
foreach($cursor as $id=>$val)
{
	
	foreach($val as $key=>$value)
	{
		$userArr[$id][$key] = $value;
	}
}
$insResponse = array("message"=>"Record deleted successfully","status"=>"success","users"=>$userArr); 


header('Content-Type: application/json');
 echo json_encode($insResponse);
?>


