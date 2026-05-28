<?php
use App\Models\Product;

$products = [
    [
        'name' => 'Baju Koko IPNU Premium',
        'description' => 'Baju koko exclusive edisi PAC IPNU IPPNU Kemiri. Bahan katun premium, adem, nyaman dipakai sehari-hari. Tersedia ukuran M, L, XL, XXL.',
        'category' => 'Fashion',
        'price' => 135000,
        'discount' => 15,
        'condition' => 'Baru',
        'stock' => 50,
        'location' => 'Kemiri, Purworejo',
        'sold_count' => 127,
        'rating' => 4.8,
        'wa_link' => 'https://wa.me/6288902864846?text=Halo min, saya mau pesan Baju Koko IPNU',
    ],
    [
        'name' => 'Jaket Almamater NU',
        'description' => 'Jaket almamater resmi Nahdlatul Ulama. Bahan parasut tebal waterproof, bordir logo NU depan-belakang. Cocok untuk kegiatan organisasi.',
        'category' => 'Fashion',
        'price' => 175000,
        'discount' => 10,
        'condition' => 'Baru',
        'stock' => 35,
        'location' => 'Kemiri, Purworejo',
        'sold_count' => 89,
        'rating' => 4.9,
        'wa_link' => 'https://wa.me/6288902864846?text=Halo min, saya mau pesan Jaket Almamater NU',
    ],
    [
        'name' => 'Peci Songkok Hitam',
        'description' => 'Peci songkok hitam polos kualitas terbaik. Bahan beludru halus, jahitan rapi. Cocok untuk ibadah dan acara formal.',
        'category' => 'Aksesoris',
        'price' => 45000,
        'discount' => 0,
        'condition' => 'Baru',
        'stock' => 100,
        'location' => 'Kemiri, Purworejo',
        'sold_count' => 256,
        'rating' => 4.7,
        'wa_link' => 'https://wa.me/6288902864846?text=Halo min, saya mau pesan Peci Songkok',
    ],
    [
        'name' => 'Buku Aswaja An-Nahdliyah',
        'description' => 'Buku panduan lengkap Ahlussunnah Wal Jamaah An-Nahdliyah. Cocok untuk kader IPNU-IPPNU dan santri. Penulis: Tim PP IPNU.',
        'category' => 'Buku',
        'price' => 55000,
        'discount' => 20,
        'condition' => 'Baru',
        'stock' => 75,
        'location' => 'Kemiri, Purworejo',
        'sold_count' => 184,
        'rating' => 4.9,
        'wa_link' => 'https://wa.me/6288902864846?text=Halo min, saya mau pesan Buku Aswaja',
    ],
    [
        'name' => 'Stiker dan Pin IPNU IPPNU',
        'description' => 'Paket stiker dan pin eksklusif IPNU IPPNU Kemiri. Isi 10 stiker + 2 pin metal premium. Cocok untuk koleksi dan tempel di laptop/motor.',
        'category' => 'Aksesoris',
        'price' => 25000,
        'discount' => 0,
        'condition' => 'Baru',
        'stock' => 200,
        'location' => 'Kemiri, Purworejo',
        'sold_count' => 342,
        'rating' => 4.6,
        'wa_link' => 'https://wa.me/6288902864846?text=Halo min, saya mau pesan Stiker Pin IPNU',
    ],
];

foreach ($products as $p) {
    Product::create($p);
}

echo "Selesai! Total produk: " . Product::count() . "\n";
