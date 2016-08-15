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
/*$postvar['id'] = '57aa9c794e782aca048b4567';
$postvar['firstname'] = 'Ramesh';
$postvar['lastname'] = 'Kumar Pant';
$postvar['contactno'] = '9876545453';
$postvar['email'] = 'rmkumar@gmail.com';
*/
$usrData  = array("_id"=> new MongoId($postvar['id']));
$editUsrData = array('$set' => array('firstname'=>$postvar['firstname'],'lastname'=>$postvar['lastname'],'email'=>$postvar['email'],'contactno'=> $postvar['contactno']));
$usrArr = $collection->update($usrData,$editUsrData);

$cursor = $collection->find();
$userArr = array();
foreach($cursor as $id=>$val)
{
	
	foreach($val as $key=>$value)
	{
		$userArr[$id][$key] = $value;
	}
}
$insResponse = array("message"=>"Record edited successfully","status"=>"success","users"=>$userArr); 



header('Content-Type: application/json');
 echo json_encode($insResponse);
?>


