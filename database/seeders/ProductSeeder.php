<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::query()->delete();

        $products = [
            [
                'name' => 'Semen Portland 50 kg',
                'category' => 'semen',
                'description' => 'Semen serbaguna untuk beton, pasangan bata, plesteran, dan pekerjaan konstruksi umum.',
                'price' => 75000,
                'slug' => 'semen-portland-50-kg',
            ],
            [
                'name' => 'Bata Ringan AAC 10 cm',
                'category' => 'bata ringan',
                'description' => 'Bata ringan berukuran 10 cm yang praktis untuk dinding dengan pemasangan lebih cepat dan rapi.',
                'price' => 12500,
                'slug' => 'bata-ringan-aac-10-cm',
            ],
            [
                'name' => 'Besi Beton Polos 10 mm',
                'category' => 'besi beton',
                'description' => 'Besi beton polos sepanjang 12 meter untuk tulangan dan kebutuhan struktur bangunan.',
                'price' => 95000,
                'slug' => 'besi-beton-polos-10-mm',
            ],
            [
                'name' => 'Keramik Lantai 40 x 40 cm',
                'category' => 'keramik',
                'description' => 'Keramik lantai dengan permukaan mudah dibersihkan untuk ruang keluarga, teras, dan area komersial.',
                'price' => 68500,
                'slug' => 'keramik-lantai-40-x-40-cm',
            ],
            [
                'name' => 'Cat Tembok Interior 5 kg',
                'category' => 'cat',
                'description' => 'Cat tembok interior dengan hasil akhir halus untuk memperbarui dan melindungi permukaan dinding.',
                'price' => 185000,
                'slug' => 'cat-tembok-interior-5-kg',
            ],
            [
                'name' => 'Genteng Beton Natural',
                'category' => 'genteng',
                'description' => 'Genteng beton tahan cuaca untuk penutup atap rumah dengan tampilan kokoh dan modern.',
                'price' => 12000,
                'slug' => 'genteng-beton-natural',
            ],
            [
                'name' => 'Pasir Pasang 1 m3',
                'category' => 'pasir',
                'description' => 'Pasir pasang bertekstur halus untuk adukan pasangan bata, plesteran, dan pekerjaan finishing.',
                'price' => 350000,
                'slug' => 'pasir-pasang-1-m3',
            ],
            [
                'name' => 'Pipa PVC AW 3/4 inci',
                'category' => 'pipa',
                'description' => 'Pipa PVC kelas AW sepanjang 4 meter untuk instalasi air bersih dan kebutuhan sanitasi.',
                'price' => 28500,
                'slug' => 'pipa-pvc-aw-3-4-inci',
            ],
            [
                'name' => 'Kayu Meranti 4 x 6 x 400 cm',
                'category' => 'kayu',
                'description' => 'Kayu meranti serbaguna untuk rangka plafon, kusen, bekisting, dan berbagai pekerjaan pertukangan.',
                'price' => 85000,
                'slug' => 'kayu-meranti-4-x-6-x-400-cm',
            ],
        ];

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
