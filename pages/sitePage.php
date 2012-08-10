<?php
if ($_REQUEST['id']) {
  $p = $_REQUEST['id'];
} else {
  $p = 1;
}
$q = mysql_query("select * from pages where id = " . $p);
while ($r = mysql_fetch_assoc($q)) {
  $pagename = $r['name'];
  $pagecontent = $r['content'];
  $p = 'page';
}
echo'<h1 id="pagename">' . $pagename . '</h1>';
echo'<div class="tie text2">';
echo'<div class="tie-indent">';
echo'<div id="maincontent">';
echo($pagecontent);
echo'</div></div></div>';
?>
