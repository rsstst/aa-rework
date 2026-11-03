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
                'image' => 'assets/semen.webp',
            ],
            [
                'name' => 'Bata Ringan AAC 10 cm',
                'category' => 'bata ringan',
                'description' => 'Bata ringan berukuran 10 cm yang praktis untuk dinding dengan pemasangan lebih cepat dan rapi.',
                'price' => 12500,
                'slug' => 'bata-ringan-aac-10-cm',
                'image' => 'assets/bata_ringan.webp',
            ],
            [
                'name' => 'Besi Beton Polos 10 mm',
                'category' => 'besi beton',
                'description' => 'Besi beton polos sepanjang 12 meter untuk tulangan dan kebutuhan struktur bangunan.',
                'price' => 95000,
                'slug' => 'besi-beton-polos-10-mm',
                'image' => 'assets/besi_beton.webp',
            ],
            [
                'name' => 'Keramik Lantai 40 x 40 cm',
                'category' => 'keramik',
                'description' => 'Keramik lantai dengan permukaan mudah dibersihkan untuk ruang keluarga, teras, dan area komersial.',
                'price' => 68500,
                'slug' => 'keramik-lantai-40-x-40-cm',
                'image' => 'assets/keramik.webp',
            ],
            [
                'name' => 'Cat Tembok Interior 5 kg',
                'category' => 'cat',
                'description' => 'Cat tembok interior dengan hasil akhir halus untuk memperbarui dan melindungi permukaan dinding.',
                'price' => 185000,
                'slug' => 'cat-tembok-interior-5-kg',
                'image' => 'assets/cat.webp',
            ],
            [
                'name' => 'Genteng Beton Natural',
                'category' => 'genteng',
                'description' => 'Genteng beton tahan cuaca untuk penutup atap rumah dengan tampilan kokoh dan modern.',
                'price' => 12000,
                'slug' => 'genteng-beton-natural',
                'image' => 'assets/genteng.webp',
            ],
            [
                'name' => 'Pasir Pasang 1 m3',
                'category' => 'pasir',
                'description' => 'Pasir pasang bertekstur halus untuk adukan pasangan bata, plesteran, dan pekerjaan finishing.',
                'price' => 350000,
                'slug' => 'pasir-pasang-1-m3',
                'image' => 'assets/pasir.webp',
            ],
            [
                'name' => 'Pipa PVC Lesso 3/4 inci',
                'category' => 'pipa',
                'description' => 'Pipa PVC kelas AW sepanjang 4 meter untuk instalasi air bersih dan kebutuhan sanitasi.',
                'price' => 28500,
                'slug' => 'pipa-pvc-lesso-3-4-inci',
                'image' => 'assets/pipa.webp',
            ],
            [
                'name' => 'Kayu Meranti 4 x 6 x 400 cm',
                'category' => 'kayu',
                'description' => 'Kayu meranti serbaguna untuk rangka plafon, kusen, bekisting, dan berbagai pekerjaan pertukangan.',
                'price' => 85000,
                'slug' => 'kayu-meranti-4-x-6-x-400-cm',
                'image' => 'assets/kayu.webp',
            ],
            [
                'name' => 'Plywood 12 mm 122 x 244 cm',
                'category' => 'plywood',
                'description' => 'Plywood 12 mm dengan permukaan rata untuk bekisting, furnitur, dan kebutuhan interior bangunan.',
                'price' => 185000,
                'slug' => 'plywood-12-mm-122-x-244-cm',
                'image' => 'assets/plywood.webp',
            ],
            [
                'name' => 'Besi Hollow Galvanis 4 x 4 cm',
                'category' => 'besi hollow',
                'description' => 'Besi hollow galvanis untuk rangka plafon, partisi, kanopi, dan konstruksi ringan.',
                'price' => 78000,
                'slug' => 'besi-hollow-galvanis-4-x-4-cm',
                'image' => 'assets/besi_hollow.webp',
            ],
            [
                'name' => 'Wiremesh M8 Lembar',
                'category' => 'wiremesh',
                'description' => 'Wiremesh M8 untuk tulangan pelat lantai, dak beton, dan pekerjaan struktur bangunan.',
                'price' => 685000,
                'slug' => 'wiremesh-m8-lembar',
                'image' => 'assets/wiremesh.webp',
            ],
            [
                'name' => 'Papan Gypsum 9 mm',
                'category' => 'gypsum',
                'description' => 'Papan gypsum 9 mm untuk plafon dan partisi interior dengan hasil pemasangan yang rapi.',
                'price' => 92000,
                'slug' => 'papan-gypsum-9-mm',
                'image' => 'assets/papan.webp',
            ],
            [
                'name' => 'Baut Roofing  ga 2 inci',
                'category' => 'baut',
                'description' => 'Baut roofing dengan ring karet untuk pemasangan lembaran atap dan pekerjaan penutup bangunan.',
                'price' => 35000,
                'slug' => 'baut-roofing-2-inci',
                'image' => 'assets/baut.webp',
            ],
            [
                'name' => 'Mortar Instan Pasangan Bata 40 kg',
                'category' => 'mortar',
                'description' => 'Mortar instan untuk pemasangan bata ringan dengan campuran praktis dan mudah digunakan.',
                'price' => 65000,
                'slug' => 'mortar-instan-pasangan-bata-40-kg',
                'image' => 'assets/mortar.webp',
            ],
        ];

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
