<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perfumes = [
            [
                'name' => 'HMNS Orgasm',
                'description' => 'Parfum lokal paling fenomenal di Google. Memiliki aroma perpaduan Red Apple, Rose, Jasmine, dan Vanilla yang memberikan kesan romantis, manis, hangat, dan mewah.',
                'price' => 325000,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Dior Sauvage Eau de Parfum',
                'description' => 'Wewangian maskulin mewah kelas dunia dengan kombinasi segar dari Bergamot Calabria dan sentuhan aroma kayu berkelas (Ambroxan). Sangat karismatik.',
                'price' => 2450000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Bleu de Chanel',
                'description' => 'Parfum berkarakter Woody-Aromatic yang intens dan bersih. Menampilkan perpaduan Citrus segar, Mint, dan kayu Cedar yang memberikan impresi pria mapan dan profesional.',
                'price' => 2600000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Saff & Co. Loui',
                'description' => 'Parfum lokal dengan konsentrasi Extrait de Parfum yang sangat tahan lama. Didominasi aroma segar Floral-Fruity dari Rose, Mandarin Orange, dan White Musk.',
                'price' => 249000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Baccarat Rouge 540',
                'description' => 'Parfum super mewah bertipe Oriental-Floral. Memiliki aroma manis manis woody yang sangat ikonik dari perpaduan Saffron, Jasmine, dan Amberwood.',
                'price' => 4800000,
                'stock' => 5,
                'image' => 'https://fimgs.net/mdimg/perfume/o.46066.jpg',
            ],
            [
                'name' => 'YSL Libre Eau de Parfum',
                'description' => 'Representasi kebebasan wanita modern. Kombinasi unik antara kesegaran Lavender Prancis dengan sensualitas Orange Blossom dan kehangatan Vanilla Madagascar.',
                'price' => 2200000,
                'stock' => 10,
                'image' => 'https://sogo.co.id/cdn/shop/files/2200-32128344-1.jpg?v=1769683635',
            ],
            [
                'name' => 'Creed Aventus',
                'description' => 'Parfum legendaris idaman para pria sukses. Memiliki perpaduan aroma Fruity-Smoky yang kaya dari Blackcurrant, Nanas, Birchwood, dan Patchouli.',
                'price' => 4950000,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Jo Malone English Pear & Freesia',
                'description' => 'Membawa atmosfer musim gugur yang menenangkan. Menggabungkan kesegaran buah Pir matang yang dibungkus dengan kelembutan buket bunga Freesia putih.',
                'price' => 2300000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1595425970377-c9703cf48b6d?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'name' => 'Kahf Revered Oud',
                'description' => 'Parfum lokal pria yang menyajikan perpaduan aroma Oud (kayu gaharu) yang hangat dengan sentuhan Gourmand dan Vanilla untuk menunjang kepercayaan diri sehari-hari.',
                'price' => 75000,
                'stock' => 100,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9Lzs7EWBtMGAtMQqeVBsDHqpNvfPXYxUkCcCfh_OzbP1rpmdLQUnnFlY&s=10',
            ],
            [
                'name' => 'Onix FWB',
                'description' => 'Parfum kasual bertipe unisex yang sangat populer untuk anak muda. Kombinasi aroma manis buah dan kesegaran citrus yang cocok untuk beraktivitas bersama teman.',
                'price' => 185000,
                'stock' => 55,
                'image' => 'https://studio.femaledaily.com/_next/image?url=https%3A%2F%2Fmagento.femaledaily.com%2Fmedia%2Fcatalog%2Fproduct%2Ff%2Fw%2Ffwb.png&w=1200&q=80',
            ],
        ];

        // CARI KODE FOREACH DI PALING BAWAH FILE PRODUCTSEEDER KAMU:
// GANTI KODE FOREACH PALING BAWAH JADI SEPERTI INI:
foreach ($perfumes as $perfume) {
    Product::updateOrCreate(
        ['slug' => Str::slug($perfume['name'])], // Kunci unik patokan biar tidak duplikat
        [
            'name' => $perfume['name'],
            'description' => $perfume['description'],
            'price' => $perfume['price'],
            'stock' => $perfume['stock'],
            'tiktok_affiliate_url' => '', // Tetap string kosong bersahabat
            'image' => $perfume['image'],
        ]
    );
}
    }
}