<?php

require_once 'conf.php';

class Logger{
	
public $path;
public $product;
public $method;
	
	public function __construct(Conf $conf, Product $product){
	
	$this->path = new Conf;
	$this->product = $product;


}

 function __call($method_name, $args) {
       $this->method =  date('m-d-Y H:i').' Method: '.$method_name;
	   $file = $this->path->getPath($this).'/'.time().'.txt';
	   file_put_contents($file, $this->method);
 }

 
}



?>