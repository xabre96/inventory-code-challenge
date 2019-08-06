<?php

require 'OrderProcessorInterface.php';
require 'InventoryInterface.php';
require 'ProductsPurchasedInterface.php';
require 'ProductsSoldInterface.php';

class Products implements OrderProcessorInterface, InventoryInterface, ProductsPurchasedInterface, ProductsSoldInterface
{
    public const BROWNIE = 1;
    public const LAMINGTON = 2;
    public const BLUEBERRY_MUFFIN = 3;
    public const CROISSANT = 4;
    public const CHOCOLATE_CAKE = 5;
    public $orders = [];

    public function __construct()
    {
        $this->processFromJson('../orders-sample.json');
        print_r($this->orders);
        print_r($this->getSoldTotal(1));
    }

    public function processFromJson(string $filePath): void
    {
        $this->orders = json_decode(file_get_contents($filePath));
    }

    public function getStockLevel(int $productId): int
    {
        return 0;
    }

    public function getPurchasedReceivedTotal(int $productId): int
    {
        return 0;
    }

    public function getPurchasedPendingTotal(int $productId): int
    {
        return 0;
    }

    public function getSoldTotal(int $productId): int
    {
        $w = array_map(function ($order) use ($productId) {
            return array_filter($order, function ($o) use ($productId) {
                echo $o;
                return $o == $productId;
            }, ARRAY_FILTER_USE_KEY);
        }, $this->orders);
        var_dump($w);
        return 0;
    }
}
