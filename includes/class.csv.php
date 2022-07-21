<?php
class CSV{
	static function export($datas,$filename){
		header('Content-Type: text/csv;');
		header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
		$i=0;
		foreach($datas as $v){
			if($i==0){
				echo "\n".'"'.utf8_decode(implode('";"',array_keys($v))).'"'."\n";
			}
			echo '"'.utf8_decode(implode('";"',$v)).'"'."\n";
			$i++;
		}
	}
}