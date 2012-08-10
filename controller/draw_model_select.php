<?
  require_once($_SERVER['DOCUMENT_ROOT'].'/class/Main.php');
  $kat_id = $_GET['kat_id'];
  if($kat_id) {
    $s = "select * from model where kat_id = ".$kat_id;
    $q = mysql_query($s);
    echo '<select id="model_id">';
    echo '<option value="0">- нет модели -</option>';
    $q = mysql_query($s);
    while($r = mysql_fetch_assoc($q))
    {
      echo'<option value="'.$r['id'].'">'.$r['name'].'</option>';
    }
    echo '</select>';
  }
?>