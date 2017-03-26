<?php 

require_once 'logger.php';
require_once 'cache.php';
// Абстрактный клвсс Продукт
abstract class Product
{

protected $price;
protected $weight;
protected $delivery = 250;
protected $discount = null;

public function __construct($price, $weight)
{
	
	$this->price = $price;
	if ( $price == 0 )
	{
		throw new Exception ("Цена должна быть больше нуля");
	}
	
	$this->weight = $weight;
	}

}
// Создаем Класс сумок
class Handbag extends Product
{
	use Delivery;
	
	protected $discount = 10;

	private $cache;
	
	public function __construct($price, $weight)
	{
		
		parent::__construct($price, $weight);
		
		$this->price = round($this->price -($this->price * $this->discount /100));
		
		$this->cache = new Cache(new Conf, $this->price);
	
	}
	
	public function priceCache($file_key)
	{
		
		if ( ! $this->cache->getCache( $file_key ) ){
		 $this -> cache -> setCache ( $file_key );
		}
		return $this -> cache -> getCache ( $file_key );
	}
	
	
	public function getSummary($file_key)
	{
		echo 'Цена за сумку: '.$this->priceCache($file_key).' Доставка: '.$this->getDelivery();
	}
}


// Трейт
trait Delivery
{
	
	public function getDelivery()
	{
		if ( isset ( $this->discount ) ) $this->delivery = 300;
		return $this->delivery;
	}
}
// Конец описания классов

// Создаем объект
try
{
	$logger = new Logger ( new Conf, new Handbag(100, 1 ) );
}
catch ( Exception $e )
{
	echo 'Ошибка: '.$e->getMessage();
}

$logger ->getSummary('new');



?>
