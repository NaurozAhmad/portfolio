<?php require_once('Connections/Connection.php'); ?>
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

mysql_select_db($database_connection, $connection);
$query_word = "SELECT * FROM `work`";
$word = mysql_query($query_word, $connection) or die(mysql_error());


?>
<div class="container">
    <h1 class="cust-work cust-our-h1">Projects we worked on</h1>
    <p class="cust-work-p">We've worked on projects ridiculously big and embarrassingly small.</p>
    <div id="Container">
        <div class="row">
            <div class="filter col-md-4 col-sm-4 col-xs-4 btn btn-thumb" data-filter="all">All</div>
            <div class="filter col-md-4 col-sm-4 col-xs-4 btn btn-thumb" data-filter=".design">Web Design</div>
            <div class="filter col-md-4 col-sm-4 col-xs-4 btn btn-thumb" data-filter=".development">Web Development</div>
        </div>
        <div class="row thumbs">
            <?php 
                if(($totalRows_word = mysql_num_rows($word)) > 0) {
                    while($row_word = mysql_fetch_assoc($word)){

            ?>
            <article class="mix <?php echo $row_word['type'] ?> hover-dynamic" data-myorder="1" style="background-image: url(imagegallery/<?php echo $row_word['image'] ?>); background-size: 500px 265px;">
                <div class="back">
                    <h4><?php echo $row_word['heading'] ?></h4>
                    <p class="subtitle"><?php echo $row_word['description'] ?></p>
                    <p class="port">
                        <a class="btn btn-cust btn-block" href="<?php echo $row_word['link'] ?>" target="_blank">View Live</a>
                    </p>
                </div>    
            </article>
            <?php 
                    }
                } ?>
                <!--
            <article class="mix design hover-alsadaf" data-myorder="1">
                <div class="back">
                    <h4>Al-Sadaf Sky Intl.</h4>
                    <p class="subtitle">Al-Sadaf Sky International is an educational development organization. We Designed this site for them.</p>
                    <p class="port">
                        <a class="btn btn-cust btn-block" href="">View Live</a>
                    </p>
                </div>
            </article>
            <article class="mix development hover-befare" data-myorder="1">
                <div class="back">
                    <h4>BEFARe IMU</h4>
                    <p class="subtitle">This Database Management System was developed for BEFARe, an NGO working in collaboration with USAid</p>
                    <p class="port">
                        <a class="btn btn-cust btn-block" href="">View Live</a>
                    </p>
                </div>
            </article>
            <article class="mix design hover-chalghoza" data-myorder="1">
                <div class="back">
                    <h4>Chalghoza Forest Assoc.</h4>
                    <p class="subtitle">This website was designed for a project funded by WWF (World Wildlife Fund) for awareness of the importance of chalghoza forests.</p>
                    <p class="port">
                        <a class="btn btn-cust btn-block" href="">View Live</a>
                    </p>
                </div>
            </article>
            <article class="mix development hover-lms" data-myorder="1">
                <div class="back">
                    <h4>BEFARe IMU</h4>
                    <p class="subtitle">We created this library management system for Islamia College Peshawar. This application is still in use.</p>
                    <p class="port">
                        <a class="btn btn-cust btn-block" href="">View Live</a>
                    </p>
                </div>
            </article> -->
        </div>
    </div>
</div>
<?php
mysql_free_result($word);
?>
