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
            ['coin' => 'Bitcoin (BTC)', 'network' => 'TRC-20', 'address' => '7653925ojwkfh22fr92u8fg873892091'],
            ['coin' => 'Bitcoin (BTC)', 'network' => 'BEP20', 'address' => '0073857348965ghd2u8fg873892091'],
            ['coin' => 'Ethereum (ETH)', 'network' => 'BEP20', 'address' => '36675904-w2yertura'],
            ['coin' => 'Ethereum (ETH)', 'network' => 'TRC-20', 'address' => 'hhjw273827t6gff8f79tyufwfywu'],
            ['coin' => 'Tether (USDT)', 'network' => 'TRC-20', 'address' => '637239fgg827392r3r2389ty839'],
        ];

        foreach ($wallets as $wallet) {
            Wallet::create($wallet);
        }
    }
}
