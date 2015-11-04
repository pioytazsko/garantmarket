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

    //именим ооп для создания структуры заказа 
    function Order(name_item, arr, item_price) {
        var names_items = $('input:checkbox:checked').next().next().toArray();
        var names = [];
        var arr_items=[];
        
       
        this.id=$('#price_item').attr("id_item");
        this.name = name_item;
        //        this.complect = arr;
        this.num_of_items = arr.length;
        this.names_items = names;
        //ниже цена без учета экономии
        this.your_price = x();
        this.economy = econ();
        this.item_price = Number(item_price);
        this.price = Number(pri());
        this.clients_summ=function(){ return (this.your_price-this.economy);}
        this.discount={
        name:this.names_items,
        discount:read_discount(),
        prices:read_prices(),
        id:read_id()
        };
        this.items=arr_items;
        
     function Create_item(name,discount,price,id)
        {
     this.id=id;
     this.name=name;
     this.discount=discount;
     this.price=price;
     }
        function econ() {
            var economy = null;
            for (var p in arr) {
                economy = economy + (Number(arr[p].attributes.data.value) / 100) * Number(arr[p].attributes.data_proc.value);
            };
            return economy;
        };
        function read_discount(){
             var arr1=[];
             for (var p in arr) {
              arr1.push( Number(arr[p].attributes.data_proc.value)) ;
                 
             };
             return arr1;
         }
        function read_prices(){
         var arr1=[];
             for (var p in arr) {
               arr1.push( Number(arr[p].attributes.data.value)) ;
                 
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
        function read_id(){
            
         var arr1=[];
             for (var p in arr) {
              arr1.push( Number(arr[p].attributes.id_complect.value)) ;
             };
             return arr1;
        }
         for (p in names_items) {
            names.push(names_items[p].textContent);
        }
        for(p in this.discount.name){
            var temp=new Create_item(this.discount.name[p],this.discount.discount[p],this.discount.prices[p],this.discount.id[p]);
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
      $('#confirm_order').click(function() {
            if(($('[name="name"]').val()!=0)&&($('#phone').val()!=0)&&($('[name="adress"]').val()!=0)){
              delete data;
            var data = {
                name: $('[name="name"]').val(),
                phone: $('#phone').val(),
                adress: $('[name="adress"]').val(),
                note: $('[name="note"]').val(),
                url:window.location.href,
                complect: {
                    name_main_item:purchase.name,
                    id_main_item:purchase.id,
                    main_item_cost:purchase.item_price,
                    order_price: purchase.your_price,
                    economy: purchase.economy,
                    client_summ: purchase.clients_summ(),
                    items_whith_discount:purchase.items
                }
            };  console.log(data);
            $.post("/order.php", {
                    JSON: JSON.stringify(data)

                },
                function(datas, status) {
                    console.log(datas);
                $('.form_buy').trigger('click');
                });
            }
            else
            {
            alert('Заполните поля помеченные *')
            }
        });
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
});
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