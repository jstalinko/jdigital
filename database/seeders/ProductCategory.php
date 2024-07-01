<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategory extends Seeder
{
    public function run()
    {
        // Data kategori dan produk
        $softwareSales = [
            [
                'category_name' => 'Productivity Software',
                'products' => [
                    [
                        'name' => 'Microsoft Office',
                        'price' => 9999,
                        'description' => 'Microsoft Office is a suite of productivity software applications including Word, Excel, PowerPoint, and more.',
                        'tags' => ['office', 'word', 'excel', 'powerpoint'],
                    ],
                    [
                        'name' => 'Google Workspace',
                        'price' => 4999,
                        'description' => 'Google Workspace (formerly G Suite) is a suite of cloud computing, productivity and collaboration tools, software and products developed by Google.',
                        'tags' => ['collaboration', 'docs', 'sheets', 'gmail'],
                    ],
                    [
                        'name' => 'Adobe Acrobat Pro',
                        'price' => 14999,
                        'description' => 'Adobe Acrobat Pro is a powerful PDF editor and converter software.',
                        'tags' => ['pdf', 'editing', 'documents'],
                    ],
                    // Tambah produk dengan deskripsi di sini
                ],
            ],
            [
                'category_name' => 'Design Software',
                'products' => [
                    [
                        'name' => 'Adobe Photoshop',
                        'price' => 19999,
                        'description' => 'Adobe Photoshop is a raster graphics editor developed and published by Adobe Inc. for Windows and macOS.',
                        'tags' => ['photo editing', 'graphic design'],
                    ],
                    [
                        'name' => 'Sketch',
                        'price' => 9999,
                        'description' => 'Sketch is a vector graphics editor for macOS developed by the Dutch company Sketch B.V.',
                        'tags' => ['ui design', 'prototyping'],
                    ],
                    // Tambah produk dengan deskripsi di sini
                ],
            ],
            [
                'category_name' => 'Development Tools',
                'products' => [
                    [
                        'name' => 'PHPStorm',
                        'price' => 19999,
                        'description' => 'PhpStorm is a cross-platform IDE for PHP, built on JetBrains\' IntelliJ IDEA platform.',
                        'tags' => ['php', 'ide', 'development'],
                    ],
                    [
                        'name' => 'Visual Studio Code',
                        'price' => 0,
                        'description' => 'Visual Studio Code is a free source-code editor made by Microsoft for Windows, Linux and macOS.',
                        'tags' => ['javascript', 'typescript', 'code editor'],
                    ],
                    // Tambah produk dengan deskripsi di sini
                ],
            ],
            [
                'category_name' => 'Database Management',
                'products' => [
                    [
                        'name' => 'MySQL Workbench',
                        'price' => 0,
                        'description' => 'MySQL Workbench is a unified visual tool for database architects, developers, and DBAs.',
                        'tags' => ['mysql', 'database', 'management'],
                    ],
                    [
                        'name' => 'phpMyAdmin',
                        'price' => 0,
                        'description' => 'phpMyAdmin is a free software tool written in PHP, intended to handle the administration of MySQL over the Web.',
                        'tags' => ['php', 'mysql', 'web interface'],
                    ],
                    // Tambah produk dengan deskripsi di sini
                ],
            ],
        ];

        // Insert data kategori dan produk ke dalam database
        foreach ($softwareSales as $categoryData) {
            // Insert kategori dan ambil ID kategori
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $categoryData['category_name'],
                'slug' => Str::slug($categoryData['category_name']),
                'active'=>true
            ]);

            // Insert produk dengan kategori yang sesuai
            foreach ($categoryData['products'] as $product) {
                $productId = DB::table('products')->insertGetId([
                    'category_id' => $categoryId,
                    'name' => $product['name'],
                    'price' => $product['price']+rand(500000,1000000), // Simpan harga sebagai integer
                    'description' => $product['description'], // Tambah deskripsi produk,
                    'discount'=>rand(0,10),
                    'slug'=> Str::slug($product['name']),
                    'image'=> 'https://placehold.co/600x400?text=No+Image',
                    'tags' => json_encode($product['tags']),
                    'active'=>true
                ]);

                
            }
        }
    }
}
