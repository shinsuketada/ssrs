$(function() {
  'use strict';
  var count = 0;

  $('#cat_id').on('click', function(){
    count++;
    if(count % 2 == 1) {
      $(this).css('background-image', "url('icon/arrow_up.svg')");
    } else {
      $(this).css('background-image', "url('icon/arrow_down.svg')");
    }
  });

  $('#cat_id').on('change', function() {
    $('.prompt').remove();
    var cat = $(this).val();
    if(cat == '0') {
      $('<p class="prompt">※ご覧になりたい商品のカテゴリを選択してください。</p>').insertBefore('#pro_list');
    }

    $.ajax({
      url: 'show.php',
      data: {cat_id: $('#cat_id').val()},
      type: 'get',
      dataType: 'json',
    })
    .done(function(data) {
      var i, listItem, img, anchor;

      $('#pro_list').empty();

      for(i=0;i<data.length;i++) {
        listItem = '<li class="list_item'+i+'"></li>';
        $('#pro_list')
          .append(listItem)
          .css({
            textAlign: "center",
            width: "100%",
            height: "100%",
            paddingLeft: "0",
            paddingBottom: "0",
            display: "flex",
            justifyContent: "space-between",
            listStyleType: "none"
          });

        anchor = '<a class="anchor'+i+'" href="store_product.php?pro_id='+data[i].pro_id+'"></a>';
        if(i == data.length - 1) {
          $(".list_item"+i+'')
          .append(anchor)
          .css({
            display: "inline-block",
            width: "100%",
            height: "100%",
            paddingBottom: "0",
            marginBottom: "5.5rem",
            textAlign: "center"
          });
        } else {
          $(".list_item"+i+'')
          .append(anchor)
          .css({
            display: "inline-block",
            width: "100%",
            height: "100%",
            paddingBottom: "0",
            marginBottom: "0",
            textAlign: "center"
          });
        }
        
        img = '<img class="img'+i+'" src="img_product.php?img='+data[i].image+'">';
        $(".anchor"+i+'').append(img);
        $(".img"+i+'').css({
          width: "60%",
          height: "60%",
          marginBottom: "2rem;",
          verticalAlign: "bottom"
        });

        var clientHeight = document.documentElement.clientHeight;
        $('#wrap').css('height', clientHeight);
        $('#footer').addClass('footer_margin');
        $('#index_title h1').toggleClass('index_title_margin');
        
      }
    })
    .fail(function() {});
  });
});
