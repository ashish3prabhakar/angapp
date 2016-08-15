<?php 
/*$username = "root"; $pass="Buzzphp369";$db="angdb";

 mysql_connect("localhost",$username,$pass);
@mysql_select_db("angdb");

$result = mysql_query("select * from products ");

$prdArr = array();



while($row = mysql_fetch_assoc($result) )
{


 $prdArr[] = $row;


}

header('Content-Type: application/json');
 echo json_encode($prdArr);
*/

$connection = new MongoClient();
$db = $connection->selectDB('angdb');
$collection = $db->users;

$cursor = $collection->find();
foreach($cursor as $id=>$val)
{
	echo " $id " ;
	echo "<pre>"; print_r($val); echo "</pre>";
}

//$recordSet = $collection->findOne(array('name' => 'Amit'), array('email'));
//echo "<pre>"; print_r($recordSet); echo "</pre>";
?>


