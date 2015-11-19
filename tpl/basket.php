<?php
//  define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
//require_once(__ROOT__.'/medoo.min.php');
//require_once(__ROOT__.'/config.php');

//$database = new medoo(array(
//            'database_type' => $config_db['database_type'],
//            'database_name'=> $config_db['database_name'],
//            'server_name' => $config_db['server_name'],
//            'username' => $config_db['username'],
//            'password' => $config_db['password'],
//            'charset'=>$config_db['charset']
//        ));
//формирум страницу для оформления заказа(список товаров+форма для юзер данных)
//echo "";

?>
    <div class='form_buy_basket'></div>
    <div class="confirm_or_back">
        <div class="image_confirm"><img src="" alt="confirm_image"></div>
        <div class="text_about_checkout"><span>Вы добавили в корзину:</span><br><br><span class="name_confirm_buy" ></span></div>
        <div class="add_to_basket"></div>
        <div class="next_buy" id="next_buy"><span>Продолжить покупки</span></div>
        <div><br><span style="font-size:0.8em">* Для отмены покупки пройдите в корзину<br>(нажмите "Оформить заказ")</span></div>
        <div class="next_buy" id="checkout"><span>Оформить заказ</span></div>
    </div>
    <div class='zakaz_basket'>
        <div class='basket_name'><span>Корзина</span><span class="close_basket">&times;</span></div>
        <div class="basket_consist">
        </div>
        <div class="basket_cart">
            <div class="basket_total_summ">
            </div>
        </div>
        <div class='form_basket'>
            <div class='opisanie_zakaza_basket'></div>

            <div class='basket_buttons'>
                <div><span id='back_to_page'>Назад на страницу</span></div>
                <input type="text" id='name' size="30" placeholder="Имя*" value="">
                <div><span id='clear_basket'>Очистить корзину</span></div>
                <input type="text" id='phone_basket' size="30" placeholder="Телефон*" value="">
                <div><span id='send_order'>Отправить заказ</span></div>


                <input type="text" id='adress' size="30" placeholder="Адрес*" value="">
                <input type="text" id='note' size="30" placeholder="Примечание" value="">
            </div>


        </div>
    </div>
