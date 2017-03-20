<?php

require_once 'conf.php';

class Logger{
	
private $path;
public $product;
	
	public function __construct(Conf $conf, Product $product){
	
	$this->path = new Conf;
	$this->product = $product;


}

 function __call($method_name, $args) 
 {
       $method =  date('m-d-Y H:i').' Method: '.$method_name;
	   $file = $this->path->getPath($this).'/'.time().'.txt';
	   file_put_contents($file, $method);
 }
}



?>
