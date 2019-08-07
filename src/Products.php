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
  public $productOrders = [];

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

  public function processFromJson(string $filePath): void
  {
    $productOrders = json_decode(file_get_contents($filePath));
    $this->setProductOrders($productOrders);
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
    $soldTotal = [];
    $productOrders = $this->getProductOrders();

    foreach ($productOrders as $day) {
      foreach ($day as $orders) {
        foreach ($orders as $productKey => $productOrder) {
          if ((int)$productKey === $productId) {
            array_push($soldTotal, $productOrder);
          }
        }
      }
    }

    return array_sum($soldTotal);
  }
}

