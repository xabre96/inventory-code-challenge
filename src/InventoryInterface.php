<?php

interface InventoryInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getStockLevel(int $productId): int;

    /**
     * @param int $productId
     * @param int $stockLevel
     * @return void
     */
    public function setStockLevel(int $productId, int $stockLevel): void;
}
