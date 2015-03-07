<section name="portfolio">
   <h1 class="portfolio-banner page-scroll" id="portfolio">Portfolio</h1>

   <div id="main-slider" class="carousel slide" data-ride="carousel" data-interval="3000">
      <ol class="carousel-indicators">
         <li data-target="#main-slider" data-slide-to="0" class="active"></li>
         <li data-target="#main-slider" data-slide-to="1"></li>
         <li data-target="#main-slider" data-slide-to="2"></li>
         <li data-target="#main-slider" data-slide-to="3"></li>
         <li data-target="#main-slider" data-slide-to="4"></li>
         <li data-target="#main-slider" data-slide-to="5"></li>

      </ol>

      <div class="carousel-inner" role="list-box">
         <div class="item active">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image1.jpg');   background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Web Applications</h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image2.jpg');   background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Mobile Apps</h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image3.jpg');   background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Designing</h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image4.jpg');   background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Data Security</h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image5.jpg');    background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Training </h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="main-slider-image" style="background-image: url('_assets/_img/slider-gallery/image6.jpg');    background-size: cover;">
               <div class="main-slider-overlay">
                  <div class="carousel-caption">
                     <h3>Maintenance</h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php require_once '_includes/thumbnail-gallery.php' ?>
</section>
