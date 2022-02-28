<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'NAMA_BARANG' => 'RICE',
            'KATEGORI' => 'MASAK',
            'HARGA' => 9999,
            'KETERANGAN' => 9999,
        ]);

        Barang::create([
            'NAMA_BARANG' => 'RICE',
            'KATEGORI' => 'MASAK',
            'HARGA' => 9999,
            'KETERANGAN' => 9999,
        ]);
    }
}
