<?php
include("Connections/Connection.php");

if(isset($_POST['submitted'])) {
   $heading = $_POST['heading'];
   $desc = $_POST['description'];
   $sitelink = $_POST['link'];
   $letype = $_POST['type'];

   $validated_form=array("jpeg","jpg","JPG","JPEG","png","PNG");
   $pic=$_FILES['file']['name'];
   if($pic!="")
   {
      list($filename,$ext)=explode(".",$pic);}
      $size=$_FILES['file']['size'];
      $type=$_FILES['file']['type'];
      $tmp=$_FILES['file']['tmp_name'];
      if($pic!="")
      {
         if(in_array($ext,$validated_form))
         {

            $dir="imagegallery/".$pic;
            if(move_uploaded_file($tmp,$dir))
            {
               mysqli_query($link, "INSERT INTO work VALUES ('','{$desc}','{$heading}','{$pic}','{$sitelink}','{$letype}')");
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
   <!DOCTYPE html>
   <html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add Work</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">
      <script src="js/respond.js"></script>
      <link rel="stylesheet" href="menu/rmm-css/responsivemobilemenu.css" type="text/css"/>
      <link href="css/scrolling-nav.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/custom.css">
      <link href="css/slider.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/ddmenu.css">
      <script type="text/javascript" src="js/ddmenu.js"></script>

      <link href='http://fonts.googleapis.com/css?family=Exo+2|Oxygen|Alegreya+Sans+SC|Raleway:200|Poiret+One|Courgette' rel='stylesheet' type='text/css'>

   </head>
   <body>
      <div class="banner">
         <div class="row">
            <h1 class="cust-banner-h1">Add Your Stupid Work!</h1>
         </div>
      </div>
      <div class="container">
         <div class="cust-our-div">
            <h1 class="cust-work cust-our-h1"></h1>

         </div>
         <form class="form-horizontal" action="add_work.php" method="post" id="form_work" enctype="multipart/form-data">
            <div class="form-group">
               <label for="heading" class="col-sm-2 control-label col-sm-offset-2">Heading</label>
               <div class="col-sm-5">
                  <input type="text" class="form-control" id="heading" name="heading" placeholder="Heading">
               </div>
            </div>
            <br/>
            <div class="form-group">
               <label for="description" class="col-sm-2 control-label col-sm-offset-2">Description</label>
               <div class="col-sm-5">
                  <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
               </div>
            </div>
            <br/>
            <div class="form-group">
               <label for="link" class="col-sm-2 control-label col-sm-offset-2">Link</label>
               <div class="col-sm-5">
                  <input type="text" class="form-control" id="link" name="link" placeholder="Link">
               </div>
            </div>
            <br/>
            <div class="form-group">
               <label for="radio" class="col-sm-2 control-label col-sm-offset-2">Web Design</label>
               <div class="col-sm-1">
                  <input type="radio" class="form-control" value="design" name="type" id="type">
               </div>
               <label for="radio" class="col-sm-2 control-label">Web Development</label>
               <div class="col-sm-1">
                  <input type="radio" class="form-control" value="development" name="type" id="type">
               </div>
            </div>
            <br/>
            <div class="form-group">
               <label for="file" class="col-sm-2 col-sm-offset-2 control-label">Upload File</label>
               <div class="col-sm-5">
                  <input type="file" name="file" id="file"><br>
               </div>

            </div>
            <div class="form-group">
               <div class="col-sm-offset-3 col-sm-6">
                  <input type="hidden" id="submitted" name="submitted" value="submitted">
                  <button type="submit" class="btn btn-default btn-block">Submit Work</button>
               </div>
            </div>
         </form>

      </div>
      <?php require_once('footer.php') ?>

   </body>
   </html>
