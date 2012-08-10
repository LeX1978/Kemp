<?php
echo'<h1 id="pagename">Регистрация на сайте</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
?>
<br style="clear:both;"/>
<form name="create_account" action="" method="post">
  <fieldset>
    <legend>Введите необходимую информацию для оформления заказа</legend>
    <label class="inputLabel" for="name">Вы:</label>
    <select id="type" onchange="javascript: seltype();">
      <option>Юридическое лицо</option>
      <option>Физическое лицо</option>
    </select><br style="clear:both;"/>
    <label class="inputLabel" for="name">Пполное наименование:</label>
    <input type="text"  size="41" maxlength="64" id="name"><br style="clear:both;"/>
    <label class="inputLabel" for="new_email">Email:</label>
    <input type="text"  size="41" maxlength="64" id="new_email"><br style="clear:both;"/>
    <label class="inputLabel" for="new_inn">ИНН:</label>
    <input type="text"  size="41" maxlength="12" id="new_inn"><br style="clear:both;"/>
    <label class="inputLabel" for="new_kpp">КПП:</label>
    <input type="text"  size="41" maxlength="20" id="new_kpp"><br style="clear:both;"/>
    <label class="inputLabel" for="new_uadres">Юридический адрес:</label>
    <textarea  id="new_uadres" cols="31" rows="3"></textarea><br/><br style="clear:both;"/>
    <label class="inputLabel" for="new_padres">Почтовый адрес:</label>
    <textarea  id="new_padres" cols="31" rows="3"></textarea><br/><br style="clear:both;"/>
    <label class="inputLabel" for="new_bank">Банк:</label>
    <textarea  id="new_bank" cols="31" rows="2"></textarea><br/><br style="clear:both;"/>
    <label class="inputLabel" for="new_rschet">Рассчетный счет:</label>
    <input type="text"  size="41" maxlength="20" id="new_rschet" onchange="javascript: chek2();"><br style="clear:both;"/>
    <label class="inputLabel" for="new_kschet">Корреспондентский счет:</label>
    <input type="text"  size="41" maxlength="20" id="new_kschet" onchange="javascript: chek1();"><br style="clear:both;"/>
    <label class="inputLabel" for="new_bik">БИК:</label>
    <input type="text"  size="41" maxlength="9" id="new_bik" onchange="javascript: chek9();"><br style="clear:both;"/>
    <label class="inputLabel" for="new_kontact">Контакное лицо:</label>
    <input type="text"  size="41" maxlength="64" id="new_kontact"><br style="clear:both;"/>
    <label class="inputLabel" for="new_phone">Телефон:</label>
    <input type="text"  size="41" maxlength="64" id="new_phone">
    <br style="clear:both;"/>
    <input name="but3" type="button"  value="Зарегистрироваться" onclick="javascript: save_user();"/>
  </fieldset>
</form>
<?
echo'</div></div></div>';
?>
