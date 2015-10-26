<h2>Внимательно вводите данные в таблицы!</h2>
<h3>Шапка таблицы </h3>
<table border='1' style='font-size:1.1em'>
    <tr>
        <td>'id'</td>
        <td>'iditem'</td>
        <td>'name'</td>
        <td>'price'</td>
        <td>'linkobzor'</td>
        <td>'linkobzortitle'</td>
        <td>'linkotziv'</td>
        <td>linkotzivtitle'</td>
        <td>'manufekted'</td>
        <td>'category'</td>
        <td>'deskripshn'</td>
        <td>'keywords'</td>
        <td>'image'</td>
        <td>'spase'</td>
        <td>'vip'</td>
        <td>'levl'</td>
        <td>'filename'</td>
        <td>'filetitle'</td>
        <td>'publick'</td>    
        <td>'unit'</td>
        <td>'chpu'</td>
        <td>'h1'</td>
        <td>'title'</td>
        <td>'description'</td>
        <td>'share'</td>
        <td>'rating'</td>
        <td>'view'</td>
    </tr>
</table>
<div>
<span>id-заполняется произвольным числом</span><br>
<span>iditem- идентификатор товара (обязательное,не должно повторяться с другими товарами)</span><br>
<span>name-имя товара </span><br>
<span>price-цена товара </span><br>
<span>linkobzor-ссылка на обзор (не обязательный параметр у товара) </span><br>
<span>linkobzortitle-ссылка на обзор (не обязательный параметр у товара) </span><br>
<span>linkotziv-ссылка на отзыв (не обязательный параметр у товара) </span><br>
<span>linkotzivtitle-ссылка на обзор (не обязательный параметр у товара) </span><br>
<span>manufekted-производитель </span><br>
<span>category-категория </span><br>
<span>deskripshn-описание товара </span><br>
<span>keywords-ключевые слова </span><br>
<span>image-ссылка на изображение </span><br>
<span>space-??? </span><br>
<span>vip-последовательность при выводе на первой странице </span><br>
<span>levl-послеедовательность при выводе на остальных страницах</span><br>
<span>filename-????</span><br>
<span>filetitle-????</span><br>
<span>public- есть ли товар в наличии(или под заказ)</span><br>
<span>unit- единица измерения</span><br>
<span>chpu- ссылка на товар (url)</span><br>
<span>h1-содержание тега h1</span><br>
<span>title-титлы на странице с товаром</span><br>
<span>description-(сео для поисковиков)характеристики товара</span><br>
<span>share-?</span><br>
<span>rating-рейтинг товара</span><br>
<span>view-отображать товар или нет(1-да,0-нет)</span><br>


</div>
<div><br><a href="controller/export/dir/res.csv">Скачать образец</a></div>
<div><br><br><span style="background:#399d73;padding:15px 20px;margin:20px 0;border-radius:5px;"><a style="text-decoration: none;" href="/admin/catalog.php?idp=16">Импорт/Экспорт CSV</a></span></div>
<br>
<br>
<br>
<div style="background:red"><form action="/admin/controller/export/index.php" method="post" enctype=multipart/form-data>
    <input type="file" name="files">
    <input type="password" name="password" placeholder="Пароль">
    <input type="submit" name="send" value="Отправить">
</form></div>