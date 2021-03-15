$(function() {
  'use strict';
  var i, shokei, num, price;
  var total = 0;
  var tr = $('tr');

  $('input.submit').css('pointerEvents', 'none');
  $('input.conf').on('change', function() {
    $('input.submit').css('pointerEvents', '');
  });

  //load
  $(document).ready(function() {
    for(i=0; i<tr.length-1; i++) {
      price = parseInt($('td.price'+i).text().slice(0,-1));
      num = parseInt($('td.num'+i).text());
      shokei = price * num;
      total += shokei;
    }
    $('#total').text('お支払い: '+total+'円');
  });

});