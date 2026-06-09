<?php

namespace App\Traits;

trait NormalizePriceTrait
{
    protected function normalizePrice($price)
    {
        $price = str_replace('R$', '', $price);
        $price = trim($price);

        if (strpos($price, ',') !== false) {
            $price = str_replace('.', '', $price);
            $price = str_replace(',', '.', $price);
        }

        return $price;
    }
}
