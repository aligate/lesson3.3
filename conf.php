<?php

class Conf{

private $pathArr = ['Cache' => 'tmp/cache', 'Logger' => 'tmp/logs'];

private $pathTo;

public function getPath($obj){
	
	$this->pathTo = $obj;
	
	foreach($this->pathArr as $key =>$path){
		
		if(get_class($this->pathTo) == $key) return $path;
	}
}
								
}



?>
