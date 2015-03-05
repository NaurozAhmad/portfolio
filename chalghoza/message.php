<?php require_once('Connections/connection.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current users. **
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
	
  $logoutGoTo = "login.php?logoutsuccessfully";
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
$MM_authorizedUsers = "admin,entry";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a users is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php?loginfirrst";
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if(isset($_GET['id']))
{
	$id=$_GET['id'];
mysql_select_db($database_connection, $connection);
$query_message = "SELECT * FROM contact where c_id=$id";
$message = mysql_query($query_message, $connection) or die(mysql_error());
$row_message = mysql_fetch_assoc($message);
$totalRows_message = mysql_num_rows($message);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Typography | BlueWhale Admin</title>
   <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/sty.css"/>
    
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
 
    
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/jqPlot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="js/jqPlot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="js/jqPlot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
   
   
    <!-- END: load jqplot -->
    <script src="js/setup.js" type="text/javascript"></script>
  <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

          			setSidebarHeight();


        });
    </script>

</head>
<body>
<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="img/logo.png" alt="Logo" height="50px" width="400px" /></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <?php $username=$_SESSION['MM_Username'];?>
                            <li>Hello <?php echo $username;?></li>
                          
                             <li><a href="<?php echo $logoutAction ?>">Log out</a></li>
                            
                        </ul>
                        <br />
                        <span class="small grey">Last Login: 3 hours ago</span>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
              
              
				<li class="ic-typography"><a href="admin.php"><span>Home</span></a></li>
                <li class="ic-typography"><a href="index.php"><span>Back to Website</span></a></li>
               
            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                        <li><a class="menuitem">Front Page Files</a>
                            <ul class="submenu"> <li><a href="users.php">Users</a> </li>
                                <li><a href="news.php">News</a> </li> <li><a href="projects.php">Projects</a> </li>
                                                            </ul>
                        </li>  <li><a class="menuitem">About Me Files</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
              
                            </ul>
                        </li> <li><a class="menuitem">Gallery Files </a>
                            <ul class="submenu">
                                <li><a href="pics.php">Gallery Pics</a> </li>
                     
                            </ul>
                        </li> <li><a class="menuitem">Contact Us Data</a>
                            <ul class="submenu">
                                <li><a href="contactadmin.php">Inbox</a> </li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
 <div class="grid_10">
            <div class="box round first">
             <div class="block">
<center>

<form id="form" style="text-align:center">
Message From :<input type="text" name="text" value="<?php echo $row_message['c_sender'];?>"/>
</form>
<br />


 <table width="500" align="center" border="0" id="a">
<tr bgcolor="#FFFFFF" id="s" >
<td>Name</td> <td><?php echo $row_message['c_author']; ?></td></tr>
    <tr><td>Email</td>      <td><?php echo $row_message['c_sender']; ?></td></tr>

<tr>    <td>Subject</td>      <td><?php echo $row_message['c_subject']; ?></td></tr>

<tr>    <td height="51" valign="top">Message</td>      <td><?php echo $row_message['c_message']; ?></td></tr>
<tr>    <td>date</td>      <td><?php echo $row_message['date']; ?></td>
  
</tr>
     
</table>

<p><a href="contactadmin.php">Back To Indox</a></p>
<h3 >
<p>Reply Via &nbsp;&nbsp;&nbsp; 
<a href="http:\\www.gmail.com" target="_new"><img src="images/gmail.jpg" height="100" width="100"/>    </a> 

<a href="http:\\www.yahoomail.com" target="_new"><img src="images/yahoo.jpg" height="100" width="100"/></a>
<a href="http:\\www.hotmail.com" target="_new"><img src="images/hotmail.jpg" height="100" width="100"/></a>
</p>
<br />

</h3>
</center>

 </div>
            </div>
  </div>
        <div class="clear">
        </div>
</div>
    <div class="clear">
    </div>
<div id="site_info">
        <p align="center">
            Copyright <a href="#">Chalgoze Admin</a>. All Rights Reserved.
        </p>
    </div>
    <a href="<?php echo $logoutAction ?>">Log out</a>
</body>
</html>
<?php
mysql_free_result($message);
?>
