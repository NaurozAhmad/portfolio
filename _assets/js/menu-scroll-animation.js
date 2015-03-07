var t = $("#anchor-top").offset().top;
$(document).scroll(function(){
   if($(this).scrollTop() > 10)
   {
      $('.logo').css({"width":"4%"});
      $('.logo').css({"margin-left":"48.5%"});
      $('.nav').css({"margin-top":"15px"});
      $('.nav').css({"font-size":"12px"});

   }
   else {
      $('.logo').css({"width":"8%"});
      $('.logo').css({"margin-left":"46.5%"});
      $('.nav').css({"margin-top":"35px"});
      $('.nav').css({"font-size":"15px"});
   }
});
$(document).ready(function() {


   // Instantiate MixItUp:

   $('#Container').mixItUp();

});
