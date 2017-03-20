<?php

require_once 'conf.php';

class Logger{
	
private $path;
public $product;
	
	public function __construct(Conf $conf, $product){
	
	$this->path = new Conf;
	$this->product = $product;


}

 function __call($method_name, $args) 
 {
      	 $methodToLog =  date('m-d-Y H:i').' Method: '.$method_name;
	  $file = $this->path->getPath($this).'/'.time().'.txt';
	  file_put_contents($file, $methodToLog);
	 return call_user_func_array(array($this->product, $method_name), $args);
 }
}



?>
