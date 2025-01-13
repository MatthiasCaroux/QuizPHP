<?php
declare(strict_types=1);

interface Warehouse {
    public function getWarehouse();
}

abstract class Product implements Warehouse // Le mot clé abstract permet d'empécher l'instanciation de cette class
{
    public string $title;

    private float $price;

    protected string $warehouse = '';

    public function __construct(string $title, float $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function getTitle(): string
    {
        return sprintf(
            '%s (available in %s) for %s€',
            $this->title,
            $this->getWarehouse(),
            number_format($this->price, 2)
        );
    }

    public function getWarehouse(): string
    {
        return $this->warehouse;
    }
}

final class Notebook extends Product // le mot clé final permet que cette classe ne soit pas étendable
{
    protected string $warehouse = 'notebook_warehouse_code';
    
}
final class Phone extends Product
{
    protected string $warehouse = 'phone_warehouse_code';
}

$p = new Notebook('macbook', 1099.90);
var_dump($p->getTitle());

$p = new Phone('iphone', 890);
var_dump($p->getTitle());
?>