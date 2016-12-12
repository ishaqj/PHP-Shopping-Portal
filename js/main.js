/**
 * Created by Ishaq17 on 2016-10-07.
 */
$(document).ready(function () {

    $("#slides").slidesjs({
        width: 513,
        height: 513,
        navigation: false
    });

    tinymce.init({
        selector: 'textarea',
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: '//www.tinymce.com/css/codepen.min.css'
    });

    if(Cookies.get("toggle")) {
        $("#mainCart").hide();
        $(".toggled").show();
    }
    $(".toggle").click(function () {
       $("#mainCart").fadeOut(100);
        $(".toggled").fadeIn(100);
        Cookies.set('toggle', 'toggle', {
            expires: 1/48
        });
    });

    $(".toggled").click(function () {
        $(".toggled").fadeOut(100);
        $("#mainCart").fadeIn(100);
        Cookies.remove('toggle');
    });


    var initShoppingCart = function() {
        var hasData;
        $.post( "shop.php", function( data ) {
            hasData = data;
            if(hasData) {
                $.ajax({
                    url: "shop.php",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $.each(data,function (index,item) {
                            $("#mainCart ul").append("" +
                                "<li><div class='basketQty'>"+item.qty +"</div>"+" "+
                                "<div class='basketName'>"+item.name+"</div>" +
                                "<div class='basketPrice'>"+item.price+" :-</div></li>");
                        });

                        $("#mainCart ul")
                            .after("<div id='sum'> Totalpris: <b>"+data[0].sum+" :-</b></div>");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                    }
                });
            }
            return false;
        });
    };

    var buyItem = function () {
        $(".buy").on("click", function (e) {
            e.preventDefault();
            var id = $(this).attr('href').split("=")[1];
            $(".message").html("");
            $.ajax({
                url: "cart_add_product.php?id="+id+"",
                type: "GET",
                data: {id: id},
                success: function (data) {
                    $("#mainCart li").remove();
                    $("#mainCart #sum").remove();
                    initShoppingCart();
                    $(".message").html(data.message);
                    $("#cart").text(data.items + " produkter," + " pris "  + data.sum + " :-");
                    $(".toggled").text("Varukorg (" + data.items + ")");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        });
    };
    
    var searchBox = function () {
        //search icon in right menu
      $("#searchicon").click(function(e) {
          e.preventDefault();
          setTimeout(function() { $("input[name='q']").focus() }, 100);
          $("#searchicon").toggle();
          $("#navright").hide();
          $("#searchremove").css("cursor","pointer").show();
          $("#searchbox").fadeIn(100);
          $(".navbar").css("z-index",50100);
          $("#searchicon2").css("cursor","pointer");
          $("#overlayForSearch").show();
      });

        //for remove icon when search box is displayed
        $("#searchremove").click(function(e) {
            e.preventDefault();
            $("#searchicon").fadeIn(300);
            $("#searchremove").fadeOut(300);
            $("#navright").fadeIn(300);
            $("#searchbox").hide();
            $("#overlayForSearch").hide();
        });

        // for search icon in the search box
        $("#searchicon2").click(function (e) {
            e.preventDefault();
            var input = $("input[name='q']").val();
            if(input == "")
            {
                alert("Fyll i sökfältet.");
            }
            else {
                $(this).closest('form').submit();
            }
        });
    };
    
    var addImage = function () {
      var i = 1;
      $("#add").click( function (e) {
          e.preventDefault();
          i++;
         $("#firstImg")
             .after('<tr id="img'+i+'"> <td>Image '+i+'</td><td><input type="text" name="image[]" class="form-control" autofocus/></td><td><button class="btn-danger btn-md remove" id="'+i+'"><i class="glyphicon glyphicon-minus-sign"</button></td> </tr>');
      });

        $("body").on("click",".remove",function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            $('#img'+id+'').remove();
            i--;
        });

    };

    addImage();
    buyItem();
    initShoppingCart();
    searchBox();

});