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
	
  $logoutGoTo = "login.php?logoutsuccessful";
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

$MM_restrictGoTo = "login.php?loginfirst";
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
<?php require_once('Connections/connection.php'); ?>


<?php 
$validated_form=array("jpeg","jpg","JPG","JPEG");
	if(isset($_POST['upload']))
	{
		 $pic=$_FILES['file']['name'];
		 if($pic!="")
		 {
		 list($filename,$ext)=explode(".",$pic);}
		 $size=$_FILES['file']['size'];
		 $type=$_FILES['file']['type'];
		  $title=$_POST['title'];
		 $tmp=$_FILES['file']['tmp_name'];	
		
		if($pic!="")
		{
			if(in_array($ext,$validated_form))
			{
				if(file_exists("pics/".$pic))
				{
				$pic=$pic."_".time()."_".$pic;
				}
				$dir="pics/".$pic;
				if(move_uploaded_file($tmp,$dir))
				{
mysql_select_db($database_connection, $connection);
				 mysql_query("INSERT INTO `pics` VALUES('','$pic','$size','$type','$title')") or die(mysql_error());		
				}
			}
			else
			{
				echo "Only JPEG AND JPG ARE ALLOWED";
			}	
		}
		else{
			echo "please Select a file";
		}
				
	}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Chalghoza WWF</title>
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


<h1 align="center" class="style1">&nbsp;</h1>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div align="center">
    <p><span class="style1">Please Upload Your Pics Here</span>
      <input name="file" type="file" size="50" maxlength="50" />
    </p>
    <p><span class="style1">Title of the Image</span> 
      <label for="title"></label>
      <input name="title" type="text" id="title" size="50" value="" />
    </p>
    <p>
      <input name="upload" type="submit" id="upload" value="Upload" />
    </p>
  </div>
  <label></label>
  <p>
    <label></label>
  </p>
</form>


</p>
<center>
<table width="" align="center" border="0" id="a">
<tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="2">Pics Are</th></td>
  <tr bgcolor="#FFFFFF">
    
  </tr>
 <?php 
mysql_select_db($database_connection, $connection);$qry=mysql_query("SELECT * FROM `pics`");?> 
 <?php 
 	while($prow=mysql_fetch_array($qry))
	{
 ?> 
  <tr>
    <td>&nbsp;<img src="pics/<?php echo $prow['p_name'];?>" height="200" width="300" /></td>
    <td><h1><strong><a href="del_pic.php?did=<?php echo $prow['p_id'];?>"><img src="images/delete.png" /></a></strong></h1>
    <h1> <strong><a href="upd_pic.php?uid=<?php echo $prow['p_id'];?>"><img src="images/update.png" /></a></strong></h1></td>
   
  </tr>
  <tr>
    <td colspan="2">&nbsp;<?php echo $prow['p_title'];?></td>
    
  </tr>
  <?php }?>
</table>
 
 </center></div>
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
    
<a href="<?php echo $logoutAction ?>"></a>
</body>
</html>
