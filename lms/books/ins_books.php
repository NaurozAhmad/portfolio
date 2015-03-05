<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "librarian,admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain user based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain user based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php require_once('../Connections/connection.php'); ?>
<?php
if(isset($_POST['insert']))
 {
	 $scat=$_POST['scat_id'];
     $title=$_POST['b_title'];
	 $author=$_POST['b_author'];
	 $condition=$_POST['b_condition'];
	 $date=$_POST['b_date'];
	 $datee=date('y-m-d',strtotime($date));
	 $volume=$_POST['b_volume'];
	 $year=$_POST['b_year'];                  
     //  mysql_query("INSERT INTO `books` VALUES ('','$scat','$title','$author','$condition','$date','$volume','$year')") or die(mysql_error());     $bid=mysql_insert_id();
	$no_d=$_POST['no_of_detail'];
	for($j=1;$j<=$no_d;$j++)
	{	
	  	$assection=$_POST['b_assection'.$j];
	$issn=$_POST['b_issn'.$j];
	mysql_select_db($database_connection, $connection);
	mysql_query("INSERT INTO `books` VALUES ('','$scat','$title','$author','$condition','$datee','$volume','$year','$assection','$issn','0')") or die(mysql_error());
	//mysql_query("INSERT INTO `b_numbers` VALUES ('','$assection','$issn','$bid')") or die(mysql_error());
	header("Location:books.php");

}}
                      
  /*mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "books.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}*/

mysql_select_db($database_connection, $connection);
$query_all_Cat = "SELECT * FROM category";
$all_Cat = mysql_query($query_all_Cat, $connection) or die(mysql_error());
//$row_all_Cat = mysql_fetch_assoc($all_Cat);
$totalRows_all_Cat = mysql_num_rows($all_Cat);

?>
<script type="text/javascript" src="../jQuery/jquery.js"></script>
<script type="text/javascript" src="../jQuery/insert_form.js"></script>
<script type="text/javascript">

function addMore()
{ //alert("called");
	var no_d = document.getElementById('no_of_detail').value;
	//alert(no_d);
	var next = parseInt(no_d)+1;
	//alert(next);
	var daata = '<p>Assection :<input name="b_assection'+next+'" type="text" id="b_assection'+next+'" value="" size="32"></p><p> ISSN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input name="b_issn'+next+'" type="text" id="b_issn'+next+'" value="" size="32"></p>';
	document.getElementById('repeat').innerHTML+=daata;
	document.getElementById('no_of_detail').value=next;
	}

</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert Books</title>
<meta name="description" content="Education website">
<meta name="keywords" content="education, learning, teaching">
<link href="../css/style.css" rel="stylesheet" type="text/css">


<link href="../css/table.css" rel="stylesheet" type="text/css">
</head>
<center>
<body>
<div id="page">

<div id="top">
   <div id="logo"><img src="../images/logo.png" width="94" height="69" alt=""></div>
     <div id="company_name">Library Management System</div>
     <div id="log"><?php $datee=date('d-m-Y');
					
	
	echo date('d-M-Y',strtotime($datee));?>

    
    </div>
    <div>
    </div>
</div>
<div id="menu"></div>
<div id="log"><a href="<?php echo $logoutAction ?>">Log out</a></div>
<br/>
<div id="contentwrap">
	<div id="sidebar" align="left">
    <h2>Menu</h2>
    <div class="content">
    <a href="../home.php"><h3>Home</h3></a>
    <a href="../category/category.php"><h3>Categories</h3></a>
    <a href="../sub_category/sub_category.php"><h3>Sub Categories</h3></a>
    <a href="books.php"><h3>Books</h3></a>
    <a href="../staff/staff.php"><h3>Staff</h3></a>
      <a href="../students/students.php"><h3>Students</h3></a>
    <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>


    <div id="data">
    	 <h2>Insert Books Here..</h2>

      <center>
      <form method="post" name="form1" action="" id="form">
Category :
          <select name="cat_id"  id="cat_id">
          <option value="-" >Select Catagory </option>
              <?php
while ($row_all_Cat = mysql_fetch_assoc($all_Cat)) {  
?>
              <option value="<?php echo $row_all_Cat['cat_id']?>"><?php echo $row_all_Cat['cat_name']?></option>
              <?php
} 
 
?>
            </select><br>

      <div id="result"></div>
         
<table>
            <tr><td>Book Title</td>
  <td><input type="text" name="b_title" value="" size="32"></td>
              <td>&nbsp;</td></tr>              
              
             <tr> <td>Author:</td>
              <td><input type="text" name="b_author" value="" size="32"></td>
              <td>&nbsp;</td>
              </tr>              
              <tr><td>Condition:</td>
             <td> <input type="text" name="b_condition" value="" size="32"></td>
              <td>&nbsp;</td>
              </tr> 
              
              <tr><td>Date:</td>
              <td><input type="text" name="b_date" value="" size="32"></td>
              <td>&nbsp;</td>
              </tr> 
              
              <tr><td>Volume:</td>
	           <td><input type="text" name="b_volume" value="" size="32"></td>
              <td>&nbsp;</td>
              </tr> 
              
              <tr><td>Year:</td>
              <td><input type="text" name="b_year" value="" size="32"></td>
            <td>&nbsp;</td>
              </tr> 
            <tr><td><span onClick="addMore()">Add More </span></td>
              <td><input name="no_of_detail" type="text" id="no_of_detail" value="1" size="5"></td>
            <td>&nbsp;</td>
              </tr> 
            
            
        </table>
            
            <div id="repeat">
			Assection:&nbsp;&nbsp;
        <input name="b_assection1" type="text" id="b_assection1" value="" size="32">
			
 <br>

            ISSN:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="b_issn1" type="text" id="b_issn1" value="" size="32">
              
        </div>
        
        
          
      
      
		
            <input name="insert" type="submit" id="insert" value="Insert record">
        
        
        <input type="hidden" name="MM_insert" value="form1">
      </form>
      </center>
    
    </div>
    <div class="bottom"></div>
    </div>
	</div>  
    </div>
</div>
<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
    <div id="bottom_addr">© 2013 Company Name. All Rights Reserved</div>
    <div class="bot"></div>
</div>
</div>
</body>
<center>
</html>
