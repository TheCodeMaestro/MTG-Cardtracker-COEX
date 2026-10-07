<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            [
                'card_name' => 'Gate Smasher',
                'set' => 'dtk',
                'set_name' => 'Dragons of Tarkir',
                'small_image_url' => 'https://cards.scryfall.io/small/front/0/0/001e8222-8dea-4767-8c13-21fb7ba556d7.jpg?1783938568',
                'normal_image_url' => 'https://cards.scryfall.io/normal/front/0/0/001e8222-8dea-4767-8c13-21fb7ba556d7.jpg?1783938568',
                'usd_price' => '0.13',
                'eur_price' => '0.11',
            ],
            [
                'card_name' => 'Rite of the Serpent',
                'set' => 'ktk',
                'set_name' => 'Khans of Tarkir',
                'small_image_url' => 'https://cards.scryfall.io/small/front/0/0/005b9fec-66de-4079-88e0-c7de7e22d18e.jpg?1783939079',
                'normal_image_url' => 'https://cards.scryfall.io/normal/front/0/0/005b9fec-66de-4079-88e0-c7de7e22d18e.jpg?1783939079',
                'usd_price' => '0.04',
                'eur_price' => '0.09',
            ],
            [
                'card_name' => 'Lightning Shrieker',
                'set' => 'frf',
                'set_name' => 'Fate Reforged',
                'small_image_url' => 'https://cards.scryfall.io/small/front/0/0/0071bf6e-a78b-4286-b3e7-acf44631a001.jpg?1783938687',
                'normal_image_url' => 'https://cards.scryfall.io/normal/front/0/0/0071bf6e-a78b-4286-b3e7-acf44631a001.jpg?1783938687',
                'usd_price' => '2.00',
                'eur_price' => '1.80',
            ],
            [
                'card_name' => 'Fierce Invocation',
                'set' => 'frf',
                'set_name' => 'Fate Reforged',
                'small_image_url' => 'https://cards.scryfall.io/small/front/0/1/0137de04-9fd7-41b0-b497-163e6e93432b.jpg?1783938688',
                'normal_image_url' => 'https://cards.scryfall.io/normal/front/0/1/0137de04-9fd7-41b0-b497-163e6e93432b.jpg?1783938688',
                'usd_price' => '19.00',
                'eur_price' => '17.71',
            ],
            [
                'card_name' => 'Secret Plans',
                'set' => 'ktk',
                'set_name' => 'Khans of Tarkir',
                'small_image_url' => 'https://cards.scryfall.io/small/front/0/1/01589046-a969-400f-b4ac-90cbbb814504.jpg?1783939054',
                'normal_image_url' => 'https://cards.scryfall.io/normal/front/0/1/01589046-a969-400f-b4ac-90cbbb814504.jpg?1783939054',
                'usd_price' => '0.20',
                'eur_price' => '0.20',
            ],

        ];

        foreach ($cards as $card) {
            Card::create($card);
        }
    }
}
