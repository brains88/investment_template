<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\wallet;
class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallets = [
            [
                'coin' => 'Bitcoin (BTC)',
                'network' => 'BTC',
                'address' => '7653925ojwkfh22fr92u8fg873892091',
                'image_path' => 'btc.jpeg',
                'min_amount' =>300,
                'max_amount'=>100000,
            ],
            [
                'coin' => 'Ethereum (ETH)',
                'network' => 'Eth',
                'address' => '36675904-w2yertura',
                'image_path' => 'eth.png',
                'min_amount' =>300,
                'max_amount'=>100000,
            ],
            [
                'coin' => 'Tether (USDT)',
                'network' => 'ERC-20',
                'address' => '637239fgg827392r3r2389ty839',
                'image_path' => 'usdt.png',
                'min_amount' =>300,
                'max_amount'=>100000,
            ],
            [
                'coin' => 'Tether (USDT)',
                'network' => 'TRC-20',
                'address' => '637239fgg827392r3r2389ty839',
                'image_path' => 'usdt.png',
                'min_amount' =>300,
                'max_amount'=>100000,
            ],
        ];


        foreach ($wallets as $wallet) {
            Wallet::create($wallet);
        }
    }
}
