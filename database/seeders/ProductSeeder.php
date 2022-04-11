<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'code' => "blusa-br-m-ma", 'name' => "Blusa branca masculina media", 'amount' => 23, 'price' => '21.00', 'brand' => 'Lorem Clothes'],
            ['id' => 2, 'code' => "berm-rosa-p-fem", 'name' => "Bermuda rosa feminina pequena", 'amount' => 35, 'price' => '35.00', 'brand' => 'Ipsum shorts'],
            ['id' => 3, 'code' => "camiseta-preta-g-fem", 'name' => "Camiseta preta feminina grande", 'amount' => 1, 'price' => '99.00', 'brand' => 'Lorem Clothes'],
            ['id' => 4, 'code' => "camiseta-branca-g-ma", 'name' => "Camiseta branca masculina grande", 'amount' => 7, 'price' => '99.00', 'brand' => 'Lorem Clothes'],
            ['id' => 5, 'code' => "blusa-preta-m-ma", 'name' => "Blusa preta masculina media", 'amount' => 33, 'price' => '21.00', 'brand' => 'Lorem Clothes'],
            ['id' => 6, 'code' => "meia-branca-m-fem", 'name' => "Meia branca feminina media", 'amount' => 47, 'price' => '12.00', 'brand' => 'Lorem Clothes'],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
