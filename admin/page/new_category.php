<form action="controller/new_category.php" method="post" ENCTYPE="multipart/form-data">
    <div class="new_cait">
        <div class="left">
            <div class="remark">
                <div class="text">Название категории:</div>
                <div class="text1">Максимальный размер - 100 символов</div>
                <div class="name">
                    <input name="name" type="text">
                </div>
            </div>
            <div class="remark">
                <div class="text">Ключевые слова:</div>
                <div class="text1">Максимальный размер - 255 символов</div>
                <div class="name">
                    <input name="keywords" type="text">
                </div>
            </div>
            <div class="remark">
                <div class="text">Изображение:</div>
                <div class="text1">Рекомендуемый размер 90px на 90px</div>
                <div class="name1">
                    <input name="image" type="file">
                </div>
            </div>
            <div class="remark">
                <div class="text">Изображение для меню</div>
                <div class="text1">Рекомендуемый размер 450px на 600px</div>
                <div class="name1">
                    <input name="menu" type="file">
                </div>
            </div>
            <div class="add_image"><img src="../categoryimages/no_image.png" /></div>
        </div>
        <div class="right">
            <div class="remark">
                <div class="text">Описание категории:</div>
                <div class="text1">Максимальный размер 2000 символов</div>
                <div class="edit">
                    <textarea name="deskripshn"></textarea>
                </div>
            </div>
            <div class="remark">
                <div class="text">Родительская категория:</div>
                <div class="text1">Товар отображается также в родительских категориях</div>
                <div class="name">
                    <select name="parent">
                        <?php 
include("controller/selectcatshop2.php");
?>
                    </select>
                </div>
            </div>
            <div class="remark">
                <div class="text">Уровень категории:</div>
                <div class="text1">Максимально 3 символа</div>
                <div class="name">
                    <input name="levl" type="text">
                </div>
            </div>
            <div class="remark">
                <div class="text">Спецификация(короткое описание)</div>
                <div class="text1">Максимальный размер - 70 символов</div>
                <div class="name">
                    <input name="specification" type="text" value="">
                </div>
            </div>

        </div>
        <div class="update">
            <input name="submit" type="submit" value="Добавить">
        </div>
</form>