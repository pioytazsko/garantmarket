$(document).ready(function () {
    //    alert();
    checked = new Array_checked();



    //добавим сразу если имеются вывбранные товары 
    var arr = $('input:checkbox:checked[name=product]').toArray();
    console.log(arr);
    for (var p in arr) {
        checked.add_arr(Number(arr[p].value));

    };
    checked.add_name();
    read_date();
    //    checked.add_arr();

    $('.category').click(function () {
        $(this).children().show();
    });
    $('.subcategory').click(function () {
        $(this).children().show();
    });
    //  //обработка нажатия на  чекбокс
    //    var x = 0;
    //    var temp = [];
    $('input:checkbox[name=product]').click(function () {
            checked.add_arr($(this).attr('value'));
            checked.add_name();
            console.log(checked);
            // сделаем подсчет добавленныхз элементов
            read_date();
        })
        //обработчик клика по спану

    // удаление по клику


    $('.items_then_buy').click(function () {
        $(this).prev().trigger('click');
    })

    //    //сохранение изменений
    $('#add_product').click(function () {
        //        сформируем массив объектов с ключом и данными 
        function Sort(key, value) {
            this.key = key;
            this.value = value;
        }
        // сделав класс..создадим массив объектов 
        var sort_object = new Array();
        sort = $('.sort').toArray();
        for (var i = 0; i < sort.length; ++i) {
            temp = new Sort(sort[i].value, sort[i].getAttribute('data'));
            sort_object.push(temp);
        };
        // имеем массив объектов, которые необходимо отсортировать по возврастанию ключа 
        sort_object.sort(function (a, b) {
            //            console.log(a.key + 'a---b' + b.key);
            return a.key - b.key;

        });

        // результат сортировки 
        var check = new Array();
        check.push(id);
        for (var i = 0; i < sort_object.length; ++i) {
            //            console.log(sort_object[i].value + '--->>>>');
            check.push(sort_object[i].value)
        }
        // применим значения скидок в % из текстовых инпутов
        select = $('.select').toArray();
        if ((select[0].checked) || (select[1].checked)) {
            if (select[0].checked) {
                //ajax 
                $.ajax({
                    type: "POST",
                    url: "/admin/controller/add_then_buy.php",
                    data: {
                        id: JSON.stringify(check)
                    },
                    cache: false,
                    success: function (data) {
                        //                        console.log(data);
                        alert('Изменения внесены!!!')
                    }

                });
            } else


            {
                checkedbox = $('.they_buy_items').toArray();

                var temp = check[0];
                check = [];
                check.push(temp);
                for (var p in checkedbox) {
                    check.push(checkedbox[p].attributes.data.value);
                }

                check = check.slice(0, 4);
                //                console.log(check);
                var proc = $('input.sort').toArray();
                proc = proc.slice(0, 3);
                var diskount = [];
                for (p in proc) {
                    diskount.push(proc[p].value);
                };
                //                console.log(check);
                //                console.log(diskount);
                $.ajax({
                    type: "POST",
                    url: "/admin/controller/add_complect.php",
                    data: {
                        id: JSON.stringify(check),
                        discount: JSON.stringify(diskount)
                    },
                    cache: false,
                    success: function (data) {
                        //                        console.log(data);
                        alert('Изменения внесены!!!')
                    }

                })

            }
        } else {
            alert('Выберите комплект или сопутствующие товары!');
        }



    });




    $('[value=0].select').click(function () {})
    $('input:text').unbind();
    $('#hide').click(function () {
        $('#num_of_cheked,.select_items,#add_product').slideToggle(1000)
    });
    var x = null;
    $('#fixed').click(function (event) {
        if (x == null) {
            $('#num_of_cheked,.select_items,#add_product,.select_radio').css({
                "position": "fixed"
            });
            x = 1;
        } else {
            $('#num_of_cheked,.select_items,#add_product,.select_radio').css({
                "position": "static"
            });
            x = null;
        }
    })


    $('[value=0].select').click(function () {
         $('input:checkbox:checked[name=product]').trigger('click');
//чтение и обнуление чекбоксов
          $.ajax({
            type: "POST",
            url: "/admin/controller/read_slider.php",
            data: {
                id: id,
                complect:0

            },
            success: function (msg) {

                msg = JSON.parse(msg);
                for (var p in msg[0]) {
                    //   
                    if ((p != 'i') && (p != 'id') && (msg[0][p] != 0)) {
                        // console.log(msg[0][p]);

                        $('[type=checkbox][value=' + msg[0][p] + ']').trigger('click');
                    }

                }

            }
        });
        
        
        
        
   
    });
      
    $('[value=1].select').click(function () {
        $('input:checkbox:checked[name=product]').trigger('click');
        $.ajax({
            type: "POST",
            url: "/admin/controller/read_slider.php",
            data: {
                id: id,
               complect:1
            },
            success: function (msg) {
console.log(msg);
                msg = JSON.parse(msg);
                for (var p in msg[0]) {
                    //   
                    if ((p != 'i') && (p != 'id') && (msg[0][p] != 0)) {
                        // console.log(msg[0][p]);

                        $('[type=checkbox][value=' + msg[0][p] + ']').trigger('click');
                    }

                }

            }
        });
    });

    function read_date() {
        $('#num_of_cheked').html('Выбрано:' + checked.arr.length);
        var items = '';
        for (var i = 0; i < checked.arr.length; ++i) {
            items = items + '<input type="text" class="sort" value="' + i + '" data=' + checked.arr[i] + ' size="3" style="margin-right:13px"><div class="they_buy_items"  style="border-bottom:1px solid grey;padding:10px; "data=' + checked.arr[i] + ' >' + checked.names[i] + '</div>';

        }
        $('.select_items').html(items);
        $('.they_buy_items').click(function(){
    var temp=$(this).attr('data');
        $('input[value='+temp+']').trigger('click');
    })
    }

    function Array_checked(x) {
        this.arr = []
        this.names = []
        this.add_arr = function (x) {
            var bool = 0;
            for (var p in this.arr) {
                if (this.arr[p] == x) {
                    //delete this element 
                    this.arr.splice(p, 1);
                    bool = 1;
                    break;
                }

            }
            if (bool == 0) {
                this.arr.push(x);
            }

        }
        this.add_name = function () {
            this.names.splice(0, this.names.length);
            for (var p in this.arr) {
                this.names.push($('input[value=' + this.arr[p] + ']').next().text());

            }


        }

    }
})
