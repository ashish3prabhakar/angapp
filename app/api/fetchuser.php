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
//$postvar['userid'] = '57aa9c794e782aca048b4567';
$usrData  = array("_id"=> new MongoId($postvar['userid']));
$usrArr = $collection->findOne($usrData);
$idArr = $usrArr['_id'];
foreach($idArr as $key=>$val)
{
	$usrId = $val;
}

$usrDetails = array("id"=>$usrId, "firstname"=> $usrArr['firstname'], "lastname"=>$usrArr['lastname'], "email"=>$usrArr['email'],"contactno"=>$usrArr['contactno']);

//$cursor = $collection->find();
$insResponse = array("message"=>"Record fetched successfully","status"=>"success","users"=>$usrDetails); 


//print_r($_POST);
//Print_r($_GET);



header('Content-Type: application/json');
 echo json_encode($insResponse);
?>


