$(".fb").hover(function(){
   $(this).attr("src", function(index, attr){
      return attr.replace(".png", "-blue.png");
   });
}, function(){
   $(this).attr("src", function(index, attr){
      return attr.replace("-blue.png", ".png");
   });
});
$(".tt").hover(function(){
   $(this).attr("src", function(index, attr){
      return attr.replace(".png", "-blue.png");
   });


}, function(){
   $(this).attr("src", function(index, attr){
      return attr.replace("-blue.png", ".png");
   });
});
$(".tm").hover(function(){
   $(this).attr("src", function(index, attr){
      return attr.replace(".png", "-blue.png");
   });

}, function(){
   $(this).attr("src", function(index, attr){
      return attr.replace("-blue.png", ".png");
   });
});
