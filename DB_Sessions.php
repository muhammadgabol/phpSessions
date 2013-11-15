<?php
 
 /*
		▁ ▂ ▄ ▅ ▆ ▇ █ MĠÄBÖĻ █ ▇ ▆ ▅ ▄ ▂ ▁
 ///////////////////////////////////////////////////
 ///											///
 //												//
 /											   //
 Author: Muhamamd Gabol						  //
 Website: www.mgabol.blogspot.com			 //
 Email: Muhammad.gabol@programmer.net		//
 /										   //
 //										  //
 ///								    ///
 /////////////////////////////////////////
 
 */
 
 
/* 
Ya Source Code Freely Available hai App sab Jigarz ky leyai but app sy Guzarish ki
jati hai ky jahan bhe Code use karain Developer Ko Credits zaror dyain ..


*/
/*
///
//Mozu Saving Session With Database MySql
///   

///
1:Apnai Database main Kuch Tables Bani hongi app ko agar app bhe marai tarha 
Script kiddy ho to :P Direct neachai wala script copy kar ky apnai mysql
main past karain.
///

///////////////////// Mysql Main Past Karain but yaad sy Database ka nam  Session_db rakhain.
    CREATE TABLE sessions (
    Session_ki_id varchar(32) NOT NULL,
    Session_ki_access int(10) unsigned,
    Session_ka_data text,
    PRIMARY KEY (Session_ki_id)
    );

///////////////////////


Actually php hmai eek Funcation provide karti hai jis ky thorugh hm Session ky
Functions ko khud define kar saktai hain ji main hmain 6 dalyail "Arguments" ko define
kary dyna hota hai and mazai ki bat usky bd hm Session ko normally as aam Session ki 
trha Treat kar sakty hain ,

session_set_save_handler(); iss Fucntions ky andar 6 Arugemnts ky sath neacahi deya gya hai

mny Arguments ko apnai custom nams deyai hain and ya Normally Work karain gy, 
Doesn't Matter with namming conventions.
_Kholna = open
_BandKarna = close
_Pharna = Read
_Likhna = write
_ThabhaKarna = Destroy
_SafKarna = clean
/// :p Namming Convention Lash hai :D :D Urdu main Programming ka maza hi kuch Aur hai :P

///Final
session_set_save_handler('_Kholna',
'_BandKarna',
'_Pharna',
'_Likhna',
'_ThabhaKarna', 
'_SafKarna');



   
    */   
   
   
session_set_save_handler('_Kholna','_BandKarna','_Pharna','_Likhna','_ThabhaKarna', '_SafKarna');

 function _Kholna()
{


		/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/

	global $_sain_db;

		/*
		Main agar chatha tou Statement Condition na bhe rakhta but its better
		ky app asai Situations par Conditions use karain ky errors ka pata chalai
		*/
	
	 if ($_sain_db = mysql_connect("localhost", "root", "Pass")) {
	return mysql_select_db("session_db", $_sain_db);
	}
	return FALSE;	
	
	}
 
function _BandKarna()
{
	
	/*Ya Function datbase ka pipeline Close karta hai */
	/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/
	global $_sain_db;
	
	if($_sain_db = mysql_connect("localhost", "root", "pass")){
	
	return mysql_close($_sain_db);
	
	return FALSE;
	
	}
	
	
	
	
}




function _Pharna($id)
{

	/*Ya Function App ky stored Sessions ko Read karta hai  */

	/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/
	global $_sain_db;
 
	$id = mysql_real_escape_string($id);
 
	$sql = "SELECT Session_ka_data
	FROM sessions
	WHERE Session_ki_id = '$id'";
 
	if ($result = mysql_query($sql, $_sain_db)) {
		if (mysql_num_rows($result)) {
		$record = mysql_fetch_assoc($result);
 
		return $record['data'];
	}
		}
 
		return '';
	}



function _Likhna($id, $data)
{

	/*Iss Function sy app new Session Create karty hain*/
	/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/
	global $_sain_db;
 
	$access = time();
 
	$id = mysql_real_escape_string($id);
	$access = mysql_real_escape_string($access);
	$data = mysql_real_escape_string($data);
 
	$sql = "REPLACE
	INTO sessions
	VALUES ('$id', '$access', '$data')";
 
	return mysql_query($sql, $_sain_db);
	}



function _ThabhaKarna($id)
{
	
	/*Iss Function ka maksad ya hai ky jab user logout ho, yan time out ho tou Session ko Delete karta dyta hai*/
	
	/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/
	global $_sain_db;
 
	$id = mysql_real_escape_string($id);
 
	$sql = "DELETE
	FROM sessions
	WHERE Session_ki_id = '$id'";
 
	return mysql_query($sql, $_sain_db);
	}

function _SafKarna($max)
{

		/*
		$_Sain_db = ya Varibale app dabase ka Connction information hold karta hai.
		*/
		/*Iss Function ka main maksad hai ky app Pervious Session ko remove karky new session register karty hain */
		
	global $_sain_db;
 
	$old = time() - $max;
	$old = mysql_real_escape_string($old);
 
	$sql = "DELETE
	FROM sessions
	WHERE Session_ki_access < '$old'";
 
	return mysql_query($sql, $_sain_db);
	}


	/*Ab Ekk Session start karain and check karain ky Database main information jata hai*/

		session_start();
 
 
 
 
  

   
   
   
   
   
   
?>
<html>
<head>
<title>PHP session Bana rhai hain with Database :P </title>
</head>
<body>


<h1>For More Visit www.mgabol.blogspot.com

</body>
</html>
