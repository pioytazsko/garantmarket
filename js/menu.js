$(document).ready(function() {
    $(".dropdown-toggle,.pull-left").click(function(event) {
        event.stopImmediatePropagation();
        console.log(event);
    })
    $('.menu_catalog').parent().mouseenter(function() {
        $(this).addClass('open');
        setTimeout(function() {
            $('body').append('<div class="overlay"></div>');
            setTimeout(function() {

                $('.overlay').css({

                    'position': 'fixed',
                    'left': 0,
                    'top': 199,
                    'background-color': 'black',
                    'width': '100%',
                    'height': '100%',
                    'opacity': 0.4,
                    'z-index': 10
                });
                var y = window.pageYOffset;
                if (y > 50) {
                    $('.overlay').css({
                        'top': '80px'
                    })
                }
            }, 10)
        }, 10);
    });


    $('.main_li').mouseleave(function() {

        $(this).removeClass('open');
        setTimeout(function() {
            $('.overlay').remove();
        }, 10)


    })
    //    $('body').mousemove(function(event){
    //console.log(event.clientY);})
    //чтение команд клавиатуры
    var scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
    );
    addEventListener("keydown", function(event) {
        if (event.keyCode == 13 && event.ctrlKey) {
            var comment = prompt('Опишите найденную ошибку:');

            if ((window.getSelection().toString() != '') || (comment != null)) {
                var txt = window.getSelection().toString();


                //здесь реализовываем отправку письма через ajax  на слушатель, оттуда-пользователю
                $.ajax({

                    url: "/error_on_page.php",
                    data: {
                        txt: txt,
                        href: window.location.href,
                        comment: comment,
                        browser: navigator.userAgent

                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                    }
                });
                console.log(txt);
            }
        }
    });

    addEventListener('scroll', function() {
        var y = window.pageYOffset;
        if (y < 1000) {
            var n = y / 300
        };
        if (y <= 122) {

            //            $('.fixed_menu').css({
            ////                'display': 'block'
            //            }); 
            $('.navbar-inner').css({
                'position': 'static'
            });

        }
        if (y > 122) {

            $('.navbar-inner').css({
                'position': 'fixed',
                'top': '40px',
                'z-index': '100',
                'width': '1002px'
            });
        }

        if (y > 50) {
            $('.search').css({
                'position': 'fixed',
                'top': '8px',
                'z-index': '200',
                'margin': '0 0 0 612px'
            });
            $('.fixed_menu').css({
                'display': 'block',
                'opacity': n
            });
        } else {
            $('.search').css({
                'position': 'static',
                'margin': '7px 0 0 0'
            });
            $('.fixed_menu').hide();
        }
        //        console.log(window.pageYOffset);
    });
    // для комплектов 
    function proc() {
        var res = $('input:checkbox:checked').toArray();
        console.log(res.length);
    }
    $('input:checkbox').click(proc);
    proc();
});