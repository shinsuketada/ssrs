$(function() {
  $(document).ready(function(){
    $('#wrap').css('height', $(window).height());
  });

  $(window).resize(function(){ 
    $('#wrap').css('height', $(window).height());
  });
});