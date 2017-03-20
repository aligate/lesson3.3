<?php 

require_once 'logger.php';
require_once 'cache.php';

abstract class Product{

protected $price;
protected $weight;
protected $delivery = 250;
protected $discount = null;


public function __construct($price, $weight){
	
	$this->price = $price;
	
	$this->weight = $weight;
	}

}
// Создаем Класс сумок
class Handbag extends Product
{
	use Delivery;
	
	protected $discount = 10;

	public $cache;
	
	public function __construct($price, $weight){
		
		parent::__construct($price, $weight);
		
		$this->price = round($this->price -($this->price * $this->discount /100));
		
		$this->cache = new Cache(new Conf, $this->price);
	
		
	}
	
	
	
	public function priceCache($key){
		
	
		if(!$this->cache->getCache($key)){
		 $this->cache->setCache($key);
		}
		return $this->cache->getCache($key);
	}
	
	
	public function getSummary($key){
		
		echo 'цена: '.$this->priceCache($key).' доставка: '.$this->getDelivery();
	
	}
}


// Трейт
trait Delivery{
	
	public function getDelivery(){
		if(isset($this->discount)) $this->delivery = 300;
		return $this->delivery;
	}
}

// Создаем объекты

$conf = new Conf();
$handbag = new Handbag(100, 1);
$logger = new Logger($conf, $handbag);
$logger ->getSummary('new');



?>