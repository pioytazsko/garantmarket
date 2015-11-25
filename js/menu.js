$(document).ready(function() {
     var $menu = $(".dropdown-menu");

            // jQuery-menu-aim: <meaningful part of the example>
            // Hook up events to be fired on menu row activation.
            $menu.menuAim({
                activate: activateSubmenu,
                deactivate: deactivateSubmenu
            });
            // jQuery-menu-aim: </meaningful part of the example>

            // jQuery-menu-aim: the following JS is used to show and hide the submenu
            // contents. Again, this can be done in any number of ways. jQuery-menu-aim
            // doesn't care how you do this, it just fires the activate and deactivate
            // events at the right times so you know when to show and hide your submenus.
            function activateSubmenu(row) {
                var $row = $(row),
                    submenuId = $row.data("submenuId"),
                    $submenu = $("#" + submenuId),
                    height = $menu.outerHeight(),
                    width = $menu.outerWidth();

                // Show the submenu
                $submenu.css({
                    display: "block",
                    top: -1,
                    left: width - 3, // main should overlay submenu
                    height:450 // padding for main dropdown's arrow
                });

                // Keep the currently activated row's highlighted look
                $row.find("a").addClass("maintainHover");
            }

            function deactivateSubmenu(row) {
                var $row = $(row),
                    submenuId = $row.data("submenuId"),
                    $submenu = $("#" + submenuId);

                // Hide the submenu and remove the row's highlighted look
                $submenu.css("display", "none");
                $row.find("a").removeClass("maintainHover");
            }

            // Bootstrap's dropdown menus immediately close on document click.
            // Don't let this event close the menu if a submenu is being clicked.
            // This event propagation control doesn't belong in the menu-aim plugin
            // itself because the plugin is agnostic to bootstrap.
            $(".dropdown-menu li").click(function (e) {
                e.stopPropagation();
            });

            $(document).click(function () {
                // Simply hide the submenu on any click. Again, this is just a hacked
                // together menu/submenu structure to show the use of jQuery-menu-aim.
                $(".popover").css("display", "none");
                $("a.maintainHover").removeClass("maintainHover");
            });
    
    
    
    $(".dropdown-toggle,.pull-left").click(function(event) {
        event.stopImmediatePropagation();
        //        console.log(event);
    })
    $('.menu_catalog').parent().mouseenter(function() {
        $(this).addClass('open');
        setTimeout(function() {
            $('body').append('<div class="overlay"></div>');
            setTimeout(function() {

                $('.overlay').css({

                    'position': 'fixed',
                    'left': 0,
                    'top': 201,
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
                        //                        console.log(result);
                    }
                });
                //                console.log(txt);
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
    //здесь хакочено меню начались комплекты    
    //функция обработка  при нажатия на чекбокс


    $('input:checkbox').click(proc);
    proc();
    $('input:checkbox').click(checked);

    //скрытие при загрузке
    $('input:checkbox:checked').next().css({
        "opacity": "1"
    });
    $('input:checkbox:not(:checked)').next().css({
        "opacity": "0.2"
    });
    //открытие формы для заказа

    // для комплектов

    //приименим ооп для создания структуры заказа 
    //    sessionStorage.setItem('key','value');
    //    alert(sessionStorage.getItem('key'));
    //    document.cookie="username=John Doe";
         function Basket(x,y,z,note,coockie){
                    this.name=x;
                    this.adress=y;
                    this.phone=z;
             this.note=note;
                    this.items=JSON.parse(coockie);
                    }
    
    
    function Order(name_item, arr, item_price) {
        var names_items = $('input:checkbox:checked').next().next().toArray();
        var names = [];
        var arr_items = [];


        this.id = $('#price_item').attr("id_item");
        this.name = name_item;
        //        this.complect = arr;
        this.num_of_items = arr.length;
        this.names_items = names;
        //ниже цена без учета экономии
        this.your_price = x();
        this.economy = econ();
        this.item_price = Number(item_price);
        this.price = Number(pri());
        this.clients_summ = function() {
            return (this.your_price - this.economy);
        }
        this.discount = {
            name: this.names_items,
            discount: read_discount(),
            prices: read_prices(),
            id: read_id()
        };
        this.items = arr_items;

        function Create_item(name, discount, price, id) {
            this.id = id;
            this.name = name;
            this.discount = discount;
            this.price = price;
        }

        function econ() {
            var economy = null;
            for (var p in arr) {
                economy = economy + (Number(arr[p].attributes.data.value) / 100) * Number(arr[p].attributes.data_proc.value);
            };
            return economy;
        };

        function read_discount() {
            var arr1 = [];
            for (var p in arr) {
                arr1.push(Number(arr[p].attributes.data_proc.value));

            };
            return arr1;
        }

        function read_prices() {
            var arr1 = [];
            for (var p in arr) {
                arr1.push(Number(arr[p].attributes.data.value));

            };
            return arr1;
        }

        function pri() {
            var price = null;
            for (var p in arr) {
                price = Number(arr[p].attributes.data.value) + price;
            };
            return price;
        }

        function x() {
            var xs = (Number(pri()) + Number(item_price));
            return xs;
        };

        function read_id() {

            var arr1 = [];
            for (var p in arr) {
                arr1.push(Number(arr[p].attributes.id_complect.value));
            };
            return arr1;
        }
        for (p in names_items) {
            names.push(names_items[p].textContent);
        }
        for (p in this.discount.name) {
            var temp = new Create_item(this.discount.name[p], this.discount.discount[p], this.discount.prices[p], this.discount.id[p]);
            arr_items.push(temp);
        }
    }

    //оформление покупки
    $('.button_bay').click(function() {
        //показать форму
        $('.form_buy').show();
        $('.zakaz').show();
        var list_items = '<p>' + purchase.name + ' в наборе с:</p>';
        for (var p in purchase.names_items) {
            list_items = list_items + purchase.names_items[p] + '<br>';
        };
        $('.opisanie_zakaza').html('<p>Введите ваши контактные данные,адрес доставки для оформления заказа:</p>' +
            '<pre>' + list_items + '</pre>');
        //закрытие формы
        $('#cancel_order').click(function() {
            $('.form_buy').trigger('click');
        });
        $('.form_buy').click(function() {
            $(this).hide();
            $('.zakaz').hide();
        });
        //отправка результатов 

    });
    //оформление покупки из карзины


    $('.main_li .basket').click(function() {
        //делаем запрос к бд 
        var coockie = getCookie('json');
//        console.log(coockie);
        $.post("/basket/read_basket.php", {
                json: coockie
            },
            function(data, status) {
//               console.log(data);
                data = JSON.parse(data);
                          // далее вставляем в корзину полученный товар 
                var div = '';
                for (var i = 0; i < data.length; ++i) {
                    div = div+" <div class=\"basket_line_items\" data='" + data[i][0].price + "' ><div class='basket_items'><span>" + data[i][0].name + "</span></div>                <div class='basket_description'><div class=basket_image_item><img src='/shopimage/" + data[i][0].image + "' alt='img'></div><div class=basket_links><a href='/catalog/" + data[i][0].cat_chpu + "/" + data[i][0].chpu + "'>Просмотреть товар</a></div><div class='delete_item_basket' value='" + data[i][0].id + "'><span>&times;</span></div><div class='basket_item_price'><span>Цена:" + numeric_format(data[i][0].price, ' ', ',') + " руб.</span></div></div></div>";
                    $('.basket_consist').html(div);


                };
                read_total_price();
            });
        //показываем карзину и поле
        $('.form_buy_basket').show();
        $('.zakaz_basket').show();
        $('.close_basket').click(function(){
         $('.form_buy_basket').trigger('click');
        })
        //        закрытие карзины  и поля под ей
        $('.form_buy_basket').click(function() {
            $(this).hide();
            clear_basket();
            $('.zakaz_basket').hide();
        });
        //        выход на страницу
        $('#back_to_page').click(function(event) {
            $('.form_buy_basket').trigger('click');
            event.stopImmediatePropagation();
        });
        //    очистка корзины
        $('#clear_basket').click(function(event) {
            if (confirm('Вы действительно хотетие удалить все товары из корзины?')) {

                $('.delete_item_basket').trigger('click');

            }
            event.stopImmediatePropagation();


        })
        //оформление заказа из корзины товаров
        $('#send_order').click(function(event) {
            //        проверка на заполнение полей

            if (($('#name').attr('value') != '') && ($('#adress').attr('value') != '') && ($('#phone_basket').attr('value') != '')) {
                
                //отправка заказа 
//                формируем ответ для заказа
           if(JSON.parse(getCookie('json')).length!=0){
                var basket = new Basket($('#name').attr('value'),$('#adress').attr('value'),$('#phone_basket').attr('value'),$('#note').attr('value'),getCookie('json'));
//                console.log(basket);
                $.post('/basket/order.php', {
                    json: JSON.stringify(basket)
                }, function(data) {
//console.log(data);
alert('Статус заказа:'+data);
      $('.delete_item_basket').trigger('click');
         $('.form_buy_basket').trigger('click');            


                })}else{alert('Карзина пуста')}


            } else {
                alert('Заполните поля, помеченные *')
            }
            event.stopImmediatePropagation();



        })
        $('.basket_consist').delegate(".delete_item_basket", "click", function(event) {
            $(this).parent().parent().remove();
            event.stopImmediatePropagation()
            //удаление товаров  из кук
            var coockie = getCookie('json')
            var id = $(this).attr('value');
            var temp = getCookie('json');
            temp = JSON.parse(temp);
            for (var i = 0; i < temp.length; i++) {
                if (Number(temp[i].id) === Number(id)) {
                    temp.splice(i, 1);
                    $('.number_of_goods').text(temp.length);
                    temp = JSON.stringify(temp);
                    setCookie(temp);
                    break;
                }
            }
            read_total_price();
        });
        //чтение общей суммы
        function read_total_price() {
            var summ_arr = $('.basket_line_items').toArray();
            var summ = 0;
            for (var p in summ_arr) {
                summ = summ + Number(summ_arr[p].attributes.data.value);
            }
//            console.log(summ);
            $('.basket_total_summ').html('<span>Всего:</span><p>' + numeric_format(summ) + 'руб.</p>');
        }
    });
    // отправка заказа (комплект)
    $('#confirm_order').click(function() {
        if (($('[name="name"]').val() != 0) && ($('#phone').val() != 0) && ($('[name="adress"]').val() != 0)) {
            delete data;
            var data = {
                name: $('[name="name"]').val(),
                phone: $('#phone').val(),
                adress: $('[name="adress"]').val(),
                note: $('[name="note"]').val(),
                url: window.location.href,
                complect: {
                    name_main_item: purchase.name,
                    id_main_item: purchase.id,
                    main_item_cost: purchase.item_price,
                    order_price: purchase.your_price,
                    economy: purchase.economy,
                    client_summ: purchase.clients_summ(),
                    items_whith_discount: purchase.items
                }
            };
//            console.log(data);
            $.post("/order_complekt.php", {
                    JSON: JSON.stringify(data)

                },
                function(datas, status) {
//                    console.log(datas);
                    $('.form_buy').trigger('click');
                });
        } else {
            alert('Заполните поля помеченные *')
        }
    });
    //для комплектов подсчет
    function proc() {
        var res = $('input:checkbox:checked').toArray();
        delete purchase;
        purchase = new Order($('.item_name:eq(0)').text(), res, $('#price_item').attr("data"));
        //        console.log(purchase);
        //расчет цены
        $('#general_price').html("Общая сумма:<br>" + numeric_format(purchase.your_price, ' ', ',') + " руб.")
        $('#econom').html("Экономия:<br>" + numeric_format(purchase.economy, ' ', ',') + " руб.");
        $('#prise_you').html("Ваша цена:<br>" + numeric_format((purchase.your_price - purchase.economy), ' ', ',') + " руб.");
        //выводим строки с экономией  и ... и новой ценой
        //сделаю затемнение 
        //для невыбранных товаров 
    };
    //скрытие товаров 
    function checked() {
        if ($(this)[0].checked) {
            $(this).next().css({
                "opacity": "1"
            });
        } else {
            $(this).next().css({
                "opacity": "0.2"
            });
        };
    }
    // корзина очистка     
    function clear_basket() {
        $('.basket_line_items').remove();

    }
    //форматирование чисел
    function numeric_format(val, thSep, dcSep) {
        if (val != null) {

            // Проверка указания разделителя разрядов
            if (!thSep) thSep = ' ';

            // Проверка указания десятичного разделителя
            if (!dcSep) dcSep = ',';

            var res = val.toString();
            var lZero = (val < 0); // Признак отрицательного числа

            // Определение длины форматируемой части
            var fLen = res.lastIndexOf('.'); // До десятичной точки
            fLen = (fLen > -1) ? fLen : res.length;

            // Выделение временного буфера
            var tmpRes = res.substring(fLen);
            var cnt = -1;
            for (var ind = fLen; ind > 0; ind--) {
                // Формируем временный буфер
                cnt++;
                if (((cnt % 3) === 0) && (ind !== fLen) && (!lZero || (ind > 1))) {
                    tmpRes = thSep + tmpRes;
                }
                tmpRes = res.charAt(ind - 1) + tmpRes;
            }

            return tmpRes.replace('.', dcSep);
        } else {
            return 0;
        }
    }
    //писать куки куки
    function setCookie(cvalue) {
        var cname = 'json';
        var exdays = 1;
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
    }
    //читать куки
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
   
});
