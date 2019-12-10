<?php

function saveMoney($value)
{
  // 10.000,20 -> 10000,20
  $price = str_replace('.', '', $value);
  // 10000,20 -> 10000.20
  $price = str_replace(',', '.', $price);
  $price = (float) number_format($price, 2, '.', '');
  return $price;
}