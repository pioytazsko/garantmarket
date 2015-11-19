// $.Buyme 1.4: author Nazar Tokar * nazarTokar.com * dedushka.org * Copyright 2013-2014
// updated on 2014-06-30

jQuery(function ($) {

    function getScriptFolder(e) { // find script folder
        var scripts = document.getElementsByTagName("script");
        for (var i = 0; i < scripts.length; i++) {
            if (scripts[i].src.indexOf(e) >= 0) {
                var res = scripts[i].src.substring(0, scripts[i].src.indexOf(e));
            }
        }
        return res.replace("buyme/js", "buyme");
    }

    //$(document).ready(function() {
    $.getScript(getScriptFolder("buyme.js") + "js/config.js", function () {
        buyMe();
    });
    //});

    function buyMe() {


        $("head").append("<link type=\"text/css\" rel=\"stylesheet\" href=\"" + getScriptFolder("buyme.js") + "templates/" + bmeData["template"] + "/style.css\">");
        $("head").append("<link type=\"text/css\" rel=\"stylesheet\" href=\"" + getScriptFolder("buyme.js") + "templates/" + bmeData["template"] + "/bs.css\">");

        //сосздадим класс для объекта покупки
        function Item(id) {

            this.id = id;

        }
        // при загрузке
        function get_basket() {
            var x = getCookie('json');
            if (x == '') {
                var cook_arr = []
            } else {
                var cook_arr = JSON.parse(x);

            };
            $('.number_of_goods').text(cook_arr.length);
        };
        get_basket();

        // при нажатии
        $('.b1c').click(function () {
            //            $('.main_li .basket').trigger('click');
            $('.form_buy_basket').show();
            $('.confirm_or_back').show();
            //            сделаем запрос для получения картинки и названия и цены
            $.ajax({
                url: "/basket/confirm_add.php",
                type: "POST",
                data: {
                    id: $(this).attr('value')

                },
                success: function (html) {

                    var result = JSON.parse(html);
                    console.log(result);
                    $('.image_confirm').children().attr('src', '/shopimage/' + result[0].image);
                    $('.name_confirm_buy').html(result[0].name);
                    $('#next_buy').click(function () {
                        $('.form_buy_basket').trigger('click')
                    });
                    $('#checkout').click(function () {
                          $('.confirm_or_back').hide();
                        
                        
                        
                        $('.main_li .basket').trigger('click');
                      
                    });


                }
            });

            //скрываем страницу
            $('.form_buy_basket').click(function () {
                $(this).hide();
                $('.confirm_or_back').hide();
            })

            //            $('.confirm_or_back').html();



            var arr = [];
            var item = new Item(this.value);
            arr.push(item);
            var x = getCookie('json');
            if (x == '') {
                var cook_arr = []
            } else {
                var cook_arr = JSON.parse(x);
            };
            var new_arr = cook_arr.concat(arr);
            var str = JSON.stringify(new_arr);
            setCookie(str);
            $('.main_li .basket').css({
                'background-color': '#d07373'
            })
            setTimeout(function () {
                $('.main_li .basket').css({
                    'background-color': 'inherit'
                })
            }, 400)
            delete(arr);
            //            console.log(str);
            $('.number_of_goods').text(new_arr.length);

        })
 function add_items(){}
        function setCookie(cvalue) {
            var cname = 'json';
            var exdays = 1;
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
        }

        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : '';
        }
    }

});
