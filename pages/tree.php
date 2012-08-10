<?
//Рисуем каталоги
$s1="SELECT * FROM katalog";
$q1 = mysql_query($s1);
while($r1 = mysql_fetch_assoc($q1)) {
    echo '<li><a href="#" style="border: none;"><img src="/images/'.$r1['image'].'" alt="Мини-погрузчики"></a>';
		if($r1['id'] == $katalog) {
			$class = 'class="active"';
		}
		else {
			$class = '';
		}
		//Рисуем категории
		echo '<ul>';
		$s2 = "SELECT * FROM kategoriya WHERE katalog_id = ".$r1['id'];
		$q2 = mysql_query($s2);
		while($r2 = mysql_fetch_assoc($q2)) {
			//Категория --->
			echo '<li ' . $class . '><a href="/katalog/'.$r2['id'].'/1/'.$r2['id'].'/'.$katalog.'/">' . $r2['name'] . '</a>';	
				//Проверяем открыта категория или нет --->
				if($ko == $r2['id']) {
					$class = 'class="active"';
				}
				else {
					$class = '';
				}
				//--------------------------------------->

				//Если есть у категории модели рисуем их
				$sk1 = "SELECT COUNT(*) AS kol FROM model WHERE kat_id = ".$r2['id'];
				$qk1 = mysql_query($sk1);
				while($rk1 = mysql_fetch_assoc($qk1)) {
					$kol1 = $rk1['kol'];
				}
				if($kol1 > 0) {
					//Модель в категории ------------------>
						echo '<ul>';
							$s3 = "SELECT * FROM model WHERE kat_id = ".$r2['id'];
							$q3 = mysql_query($s3);
							while($r3 = mysql_fetch_assoc($q3)) {
								echo '<li ' . $class . '><a href="/model/'.$r3['id'].'/1/'.$r2['id'].'/'.$r3['id'].'/'.$katalog.'/">' . $r3['name'] . '</a>';
									//Проверяем открыта ли модель--->
									if($mo == $r3['id']) {
										$class = 'class="active"';
									}
									else {
										$class = '';
									}	
									//------------------------------>
									//Рисуем продукцию в моделе если есть --->
									$sk3 = "SELECT COUNT(*) AS kol FROM product WHERE model_id = ".$r3['id'];
									$qk3 = mysql_query($sk3);
									while($rk3 = mysql_fetch_assoc($qk3)) {
										$kol3 = $rk3['kol'];
									}
									if($kol3 > 0) {
										echo '<ul>';
											$s5 = "SELECT * FROM product WHERE model_id = ".$r3['id'];
											$q5 = mysql_query($s5);
											while($r5 = mysql_fetch_assoc($q5)) {
												echo '<li ' . $class . '><a href="/product/'.$r5['id'].'/1/'.$r2['id'].'/'.$r3['id'].'/'.$katalog.'/">' . $r5['name'] . '</a></li>';
											}
										echo '</ul>';
									}
								// Конец продукта в модели----------------->
								echo '</li>';
							}
						echo '</ul>';
					//Конец модели в категории -------------->
				}	
				//Если есть у категории продукция то ричуем ее --->
				$sk2 = "SELECT COUNT(*) AS kol FROM product WHERE kat_id = ".$r2['id'];
				$qk2 = mysql_query($sk2);
				while($rk2 = mysql_fetch_assoc($qk2)) {
					$kol2 = $rk2['kol'];
				}
				if($kol2 > 0) {
					//Проверяем открыта ли категория -->
					if($ko == $r2['id']) {
						$class = 'class="active"';
					}
					else {
						$class = '';
					}
					//--------------------------------->
					echo '<ul>';
						$s4 = "SELECT * FROM product WHERE kat_id = ".$r2['id'];
						$q4 = mysql_query($s4);
						while($r4 = mysql_fetch_assoc($q4)) {
							echo '<li ' . $class . '><a href="/product/'.$r4['id'].'/1/'.$ko.'/'.$katalog.'/'.$mo.'/">' . $r4['name'] . '</a></li>';
						}
					echo '</ul>';
				}	
				// Конец продукта в категории---------------------->	
			echo '</li>';	
		}		
		echo '</ul>';					
		//Конец категории------------->
	echo '</li>';					
}							
?>
