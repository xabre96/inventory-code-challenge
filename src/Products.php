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
    public const DEFAULT_STOCK_LEVEL = 20;

    public $productOrders = [];
    public $stockLevel = [
        '1' => self::DEFAULT_STOCK_LEVEL,
        '2' => self::DEFAULT_STOCK_LEVEL,
        '3' => self::DEFAULT_STOCK_LEVEL,
        '4' => self::DEFAULT_STOCK_LEVEL,
        '5' => self::DEFAULT_STOCK_LEVEL
    ];

    public function __construct()
    {
        $this->processFromJson('../orders-sample.json');
    }

    public function setProductOrders(array $productOrders): void
    {
        $this->productOrders = $productOrders;
    }

    public function getProductOrders(): array
    {
        return $this->productOrders;
    }

    public function setStockLevel(int $productId, int $stockLevel): void
    {
        $this->stockLevel["$productId"] = $stockLevel;
    }

    public function getStockLevel(int $productId): int
    {
        return $this->stockLevel["$productId"];
    }

    public function processFromJson(string $filePath): void
    {
        try {
            $productOrders = json_decode(file_get_contents($filePath));

            foreach ($productOrders as $day) {
                foreach ($day as $prodOrders) {
                    foreach ($prodOrders as $productKey => $prodOrder) {
                        $productStockLevel = $this->getStockLevel((int) $productKey);

                        if ($productStockLevel === 0) {
                            throw new Exception('Empty stock!');
                        } else if ($productStockLevel < 10) {
                            //  Generate purchase order
                        } else {
                            $this->setStockLevel((int) $productKey, $productStockLevel - $prodOrder);
                        }
                    }
                }
            }

            $this->setProductOrders($productOrders);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
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
        $soldTotal = [];
        $productOrders = $this->getProductOrders();

        foreach ($productOrders as $day) {
            foreach ($day as $orders) {
                foreach ($orders as $productKey => $productOrder) {
                    if ((int) $productKey === $productId) {
                        array_push($soldTotal, $productOrder);
                    }
                }
            }
        }

        return array_sum($soldTotal);
    }
}
