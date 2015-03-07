<?php require_once '_cons/con.php'; ?>
<?php
mysql_select_db($db_name, $con);
$query_word = "SELECT * FROM `work`";
$word = mysql_query($query_word, $con) or die(mysql_error());
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
               <article class="mix <?php echo $row_word['type'] ?> hover-dynamic" data-myorder="1" style="background-image: url('_assets/_img/port-thumb/<?php echo $row_word['image'] ?>'); background-size: 500px 265px;">
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
</div>
</div>
</div>
<?php
mysql_free_result($word);
?>
