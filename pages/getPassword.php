<?php
echo'<h1 id="pagename">Авторизация на сайте</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
// запрашиваем данные пользователя
?>
<fieldset>
  <legend>Если Вы уже совершали покупки, то введите адрес  своей электронной почты</legend>

  <label class="inputLabel" for="login-email-address">Email:</label>
  <input type="text" id="login-email-address"  size="41" maxlength="96" value="" onkeypress="javascript: return login_user13(event);"><br style="clear:both;"/>
  <br/>
  <input name="but1" type="button"  value="Войти" onclick="javascript: login_user();"/>
  <input name="but2" type="button"  value="Регистрация" onclick="javascript: reg_user();"/>
</fieldset>
<br style="clear:both;"/>
<?
echo'</div></div></div>';
?>                