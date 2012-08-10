<?php
   //Проверяем пустой каталог или нет
    $s = "Select count(*) as kol from kategoriya where katalog_id = ".$katalog;
    $q = mysql_query($s);
    while($res = mysql_fetch_assoc($q)) {
      $kol = $res['kol'];
    }
  if($kol > 0) {

      //категории
      $s = "Select * from kategoriya where katalog_id = ".$katalog;
      $q = mysql_query($s);
        $ko = $_REQUEST['ko'];
        $mo = $_REQUEST['mo'];
        $class = 'class="closed"';
        while($r = mysql_fetch_assoc($q)) {
            if($ko == $r['id']) {
              $class = '';
            }
            else {
                $class = 'class="closed"';
            }
            //продукты относящиеся к категории
            $s2 = "select count(*) as kol from product where kat_id = ".$r['id'];
            $q2 = mysql_query($s2);
            while($r2 = mysql_fetch_assoc($q2)) {
                $kol = $r2['kol'];
            }
            if($kol > 0){
                echo'<li '.$class.'>
                     <span class="folder">
                        <a href="/kategoriya/'.$r['id'].'/1/'.$r['id'].'/'.$katalog.'/">'.$r['name'].'</a>
                     </span>';
                $s3 = "select * from product where kat_id = ".$r['id'];
                $q3 = mysql_query($s3);
                while($r3 = mysql_fetch_assoc($q3)){
                    if($mo == $r3['id']){
                        $class1 = '';
                    }
                    else{
                        $class1 = 'class="closed"';
                    }
                    echo'<ul>
                        <li '.$class1.'>
                        <span class="file">
                            <a href="/product/'.$r3['id'].'/1/'.$ko.'/'.$katalog.'/'.$mo.'/">'.$r3['name'].'</a>
                        </span>';
                    echo'</li>';
                    echo'</ul>';
                }
            }
        //модели
        $s2 = "select count(*) as kol from model where kat_id = ".$r['id'];
        $q2 = mysql_query($s2);
        while($r2 = mysql_fetch_assoc($q2)){
            $kol = $r2['kol'];
        }
        if($kol > 0){
            echo'<li '.$class.'>
                 <span class="folder">
                    <a href="/katalog/'.$r['id'].'/1/'.$r['id'].'/'.$katalog.'/">'.$r['name'].'</a>
                 </span>';
            $s3 = "select * from model where kat_id = ".$r['id'];
            $q3 = mysql_query($s3);
            while($r3 = mysql_fetch_assoc($q3)){
                if($mo == $r3['id']){
                    $class1 = '';
                }
                else{
                $class1 = 'class="closed"';
                }
                echo'<ul>
                    <li '.$class1.'>
                    <span class="folder">
                    <a href="/model/'.$r3['id'].'/1/'.$r['id'].'/'.$r3['id'].'/'.$katalog.'/">'.$r3['name'].'</a>
                    </span>';
                //Продукция относящаяся к модели
                $s4 = "select * from product where model_id = ".$r3['id'];
                $q4 = mysql_query($s4);
                echo'<ul id="'.$r3['name'].'">';
                while($r4 = mysql_fetch_assoc($q4)){
                    echo'<li>
                        <span class="file">
                        <a href="/product/'.$r4['id'].'/1/'.$r['id'].'/'.$r3['id'].'/'.$katalog.'/">'.$r4['name'].'</a>
                        </span>
                        </li>';
                }
                echo'</ul>';
                echo'</li>';
                echo'</ul>';
            }
        }
    //
        echo'</li>';
        }
  }
?>
