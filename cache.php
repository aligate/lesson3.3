<?php
require_once 'conf.php';

class Cache
{
	
private $path;	
private $data;

public function __construct(Conf $conf, $data)
{
	
	$this->path = new Conf;
	$this->data = $data;

}

public function setCache($file_key, $seconds=3600)
{
	$file = $this -> path-> getPath ($this).'/'.$file_key.'.txt';
	$content['data'] = $this -> data;
	$content['end_time'] = time() + $seconds;
	file_put_contents ( $file, serialize($content ));
}

public function getCache($file_key)
{
	$file = $this -> path -> getPath ($this).'/'.$file_key.'.txt';
	if(file_exists($file))
	{
		$content = unserialize(file_get_contents($file));
		
		if ( time() < $content ['end_time'] ) 
		{
			return $content ['data'];
		} 
		else {
			unlink($file);
			}
		return false;	
		}
	}
}






