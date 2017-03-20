<?php

class Conf{

private $pathArr = ['Cache' => 'tmp/cache', 'Logger' => 'tmp/logs'];

public function getPath($obj){
	
	foreach($this->pathArr as $key =>$path){
		
		if($obj instanceof $key) return $path;
	}
}
								
				

}



?>