$(function() {
  'use strict';
  var i, shokei, num, price, total2;
  var name = $('.name');
  var total1 = 0;
  var total2 = 0;

  //load 
  $(document).ready(function() {
    for(i=0; i<name.length-1; i++) {
    price = parseInt($('td.price'+i).text().slice(0,-1));
    num = parseInt($('input.num'+i).val());
    shokei = price * num;
    total1 += shokei;
    $('input[name="shokei'+i+'"]').val(shokei + '円');
    $('.shokei' +i+ ' input' ).val(shokei + '円');
    }
    $('input[name="total"]').val(total1 + '円');
  });

  if(name.length-1 == 1) {
    $('input.num0').on('change', function() {
        price = parseInt($('td.price0').text().slice(0,-1));
        num = parseInt($('input.num0').val());
        shokei = price * num;
        $('input[name="shokei0"]').val(shokei + '円');
        total2 += shokei;
      $('input[name="total"]').val(shokei + '円');
    });
  } else {
    $('input[type="number"]').on('change', function() {
      total2 = 0;
      for(i=0; i<name.length-1; i++) {
        price = parseInt($('td.price'+i).text().slice(0,-1));
        num = parseInt($('input.num'+i).val());
        shokei = price * num;
        $('input[name="shokei'+i+'"]').val(shokei + '円');
        total2 += shokei;
      }
      $('input[name="total"]').val(total2 + '円');
    });
  }

  //on checkbox to delete
  $('.modify').css('pointerEvents', 'none');
  $('.delete_check').on('change', function() {
    $('.modify').css('pointerEvents', '');
  });
  
});