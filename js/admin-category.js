    $('.category').click(function() {
        $(this).children().css('display', 'block')
    });
    $('.subcategory').click(function() {
        $(this).children().css('display', 'block')
    });
    $('.category').hover(function() {
        $(this).css("background", "smoke");


    }, function() {
        $(this).css("background", "white");
    });
    $('input:checkbox+span').click(function() {
        $(this).prev().trigger('click');
        $('#num_of_cheked').html('Выбрано:' + $('input:checked').length);
        var checked_span = $('input:checked').next().toArray();

        var checked = $('input:checked').toArray();
        var items = '';
        for (var i = 0; i < checked.length; ++i) {
            items = items + '<input type="text" class="sort" value="' + i + '" data=' + checked[i].value + ' size="3" style="margin-right:13px"><div class="they_buy_items"  style="border-bottom:1px solid grey;padding:10px; "data=' + checked[i].value + ' >' + checked_span[i].innerHTML + '</div>';

        }
        $('.select_items').html(items);

        $('.they_buy_items').bind('click', function() {
            var n = $(this).attr('data');
            $('[value=' + n + ']:checkbox').attr('checked', '');
            $(this).unbind();
            $(this).prev().remove();
            $(this).remove();


            $('#num_of_cheked').html('Выбрано:' + $('input:checked').length);




        })

    })
    x = Array();
    $('input:checkbox').click(function() {

        $('#num_of_cheked').html('Выбрано:' + $('input:checked').length);
        var checked_span = $('input:checked').next().toArray();

        var checked = $('input:checked').toArray();
        var items = '';
        for (var i = 0; i < checked.length; ++i) {
            items = items + '<input type="text" class="sort" data=' + checked[i].value + ' value=' + i + ' size="3"style="margin-right:13px"><div class="they_buy_items"  style="border-bottom:1px solid grey;padding:10px; "data=' + checked[i].value + ' >' + checked_span[i].innerHTML + '</div>';

        }
        $('.select_items').html(items);

        $('.they_buy_items').bind('click', function() {
            var n = $(this).attr('data');
            $('[value=' + n + ']:checkbox').attr('checked', '');
            $(this).unbind();
            $(this).prev().remove();
            $(this).remove();

            $('#num_of_cheked').html('Выбрано:' + $('input:checked').length);




        })

    })

    $('[name=product]').click(function() {
        $(this).css('background', 'yellow');
    })
    $('#add_product').click(function() {
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
      sort_object.sort(function(a,b){ console.log(a.key+'a---b'+b.key); return a.key - b.key; 
                                    
                                    });
            
        // результат сортировки 
        var check = new Array();
        check.push(id);
        for (var i = 0; i < sort_object.length; ++i) {
            console.log(sort_object[i].value + '--->>>>');
            check.push(sort_object[i].value)
        }


        //ajax 
        $.ajax({
            type: "POST",
            url: "/admin/controller/add_then_buy_category.php",
            data: {
                id: JSON.stringify(check)
            },
            cache: false,
            success: function(data) {
                console.log(data);
                alert('Изменения внесены!!!')
            }

        })



    });
    $('input:text').unbind();
$('#hide').click(function(){$('#num_of_cheked,.select_items,#add_product').slideToggle(1000)})