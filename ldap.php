<?php
/*
	$connet = ldap_connect('http://10.20...',389);
	
	if($connect){
		echo "it connects to ldap";
	}else{
		echo "error connecting to ldap";
	}
?>
<?php
	
	error_reporting(-1);
ini_set('display_errors', 'On');
	$dn = "OU=example Boardrooms,DC=example,DC=local";
	
	 $attributes = array("displayname", "l");

    $filter = "(cn=*)";

    $ad = ldap_connect("10.6.82.19",389) or die("error connecting"); //creating connection
  
    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);

    $bd = ldap_bind($ad,"username", "my_password") or die("unable to bind to ldap");//bind to ldap

    $result = ldap_search($ad, $dn, $filter, $attributes);

    $entries = ldap_get_entries($ad, $result);
	$count = 0;
    for ($i=0; $i<$entries["count"]; $i++)
    {
        echo $entries[$i]["displayname"]
             [0]."(".$entries[$i]["l"][0].")<br />";
			 $count++;
    }

	
	ldap_unbind($ad);
	echo "<br><br><br>$count : results found";
	echo "<br>done!";
	
?>

<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	$dn="OU=General,OU=example Head Office,DC=example,DC=local";
	$attributes = array("displayname", "1");
	$filter = "(cn=*)";
	$ad = ldap_connect("10.20...", 389) or die("error connecting to the ldap");
	ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	$bd = ldap_bind($ad,"username", "my_password") or die("able to bind to ldap");
	$result = ldap_search($ad, $dn, $filter, $attributes);
	$entries = ldap_get_entries($ad, $result);
	$count=0;
	for ($i=0; $i<$entries["count"]; $i++){
		echo $entries[$i]["displayname"][0]."<br>";
		$count++;
	}
	ldap_unbind($ad);
	echo $count;
	echo "done";
*/	
	/*searching ldap 
	$dn = "OU=Branches,OU=Example Head Office,DC=example,DC=local";
	$attr = array("displayname","1");
	$filter = "(cn=*)";
	
	$ad = ldap_connect("10.6.82.20", 389) or die("unable to connect to ldap");
	ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
	$bd = ldap_bind($ad, "username", "my_password") or die("unable to bind to ldap");
	$result = ldap_search($ad, $dn, $filter, $attr);
	$ent = ldap_get_entries($ad, $result);
	
	for($i = 0; $i < $ent["count"]; $i++){
		echo $ent[$i]["displayname"][0]."<br>";
			
		if($ent[$i]["displayname"][0] == "saposupport"){
			echo "found..........<br><br>";

		}
		
		if(($i + 1) === $ent["count"]){
			$i++;
			echo "<br>Results found: $i";
		}
	}
	ldap_unbind($ad);
	echo "<br><br>Done!..............";
	
	*
	
	
	function ldap_connection(){
		$dn = "CN=tshepo zuma,OU=Collections Department,OU=example Head Office,DC=example,DC=local";
		$attr = array("displayname", "1");
		$filter = "(cn=*)";
		
		$ad = ldap_connect("10.6.82.20", 389) or die("Error connecting to the ldap");
		ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
		$bd = ldap_bind($ad, "username", "my_password") or die("unable to bind to ldap");
		$results = ldap_search($ad, $dn, $filter, $attr);
		$entry = ldap_get_entries($ad, $results);
		$res = "";
		for($i=0; $i< $entry["count"];$i++){
			$res = $entry[$i]["displayname"][0];
			if($res != ""){
				echo "results found: $res <br>";
			}else{
				echo "No results found";
			}
		}
		ldap_unbind($ad);
		echo "done!";
	}
	function mys_connection(){
		echo "creating variables....<br>";
		define("host", "localhost", true);
		define("database", "example_intranet", true);
		define("password", "example01", true);
		define("username", "root", true);
		
		
		$host = host;
		$username = username;
		$password = password;
		$database = database;
		
		echo "varibles created....<br>";
		echo "connecting to database....<br>";
		$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
		echo "Done!";
		echo connected;
	}
	*/
	?>

<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
//echo "starting";
function creds(){
	$host = 'localhost';
	$password = 'P@ssword321';
	$username = 'root';
	$baseName = 'example_intranet';
	
	$connection = new PDO("mysql:host=$host;dbname=$baseName", $username, $password);
	return $connection;
}

function dbConnection($sql_statement){
	$conn = creds();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare($sql_statement);
	
	$stmt->execute();
	$results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$results = $stmt->fetchAll();
	
	return $results;
}

function getResults(){
	$sql = "SELECT * from _posts";
	try{
		foreach(dbConnection($sql) as $row){
			if($row['post_type'] == "page" && $row['post_title'] != "Auto Draft"){
				if($row['post_parent'] == 0){
					echo $row['post_title'].$row['post_title']."<br>";
					
				}
			}
		}
	}catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	echo "<br><br><br>Done!!!";
	$conn = null;
}
getResults();

echo "hello world from php";


?>

















