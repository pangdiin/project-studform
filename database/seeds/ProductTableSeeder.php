<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Product\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('products');


        $faker = Faker::create();

        $aluminium = Product::create([
            'name'          => 'Aluminium Ceillings',
            'brand_id'      => 1,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/allum.kwikloc.jpg',
            'thumbnail'     => 'img/default/product/allum.kwikloc_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $aluminiumData = collect([
            ['path'  =>  'img/default/gallery/product/aluminium/kwikloc1.jpg'],
            ['path'  =>  'img/default/gallery/product/aluminium/kwikloc2.jpg'],
        ]);

        gallerySeeder($aluminium, $aluminiumData);

        $seismic = Product::create([
            'name'          => 'Seismic Ceillings',
            'brand_id'      => 10,
            // 'description'   => $faker->sentence(),
            'image'         => 'img/default/product/seismic.kwikloc.jpg',
            // 'thumbnail'     => 'img/default/product/kwiloc.png',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);


        $seismicData = collect([
            ['path'  =>  'img/default/gallery/product/seismic-ceiling/seismic1.jpg'],
            ['path'  =>  'img/default/gallery/product/seismic-ceiling/seismic2.jpg'],
            ['path'  =>  'img/default/gallery/product/seismic-ceiling/seismic3.jpg'],
            ['path'  =>  'img/default/gallery/product/seismic-ceiling/seismic4.jpg'],
        ]);

        gallerySeeder($seismic, $seismicData);

        Product::create([
            'name'          => 'Ceilling Tiles',
            'brand_id'      => 3,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/cat-kwikloc.jpg',
            'thumbnail'     => 'img/default/product/ceiling_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $partitioning = Product::create([
            'name'          => 'Aluminium Partitioning',
            'brand_id'      => 8,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/partitioning.jpg',
            'thumbnail'     => 'img/default/product/partitioning_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $partitioningData = collect([
            ['path'  =>  'img/default/gallery/product/partitioning/korporate1.jpg'],
            ['path'  =>  'img/default/gallery/product/partitioning/korporate2.jpg'],
            ['path'  =>  'img/default/gallery/product/partitioning/korporate3.jpg'],
        ]);

        gallerySeeder($partitioning, $partitioningData);

        $acoustic = Product::create([
            'name'          => 'Acoustic Doors',
            'brand_id'      => 2,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/acoustic.jpg',
            'thumbnail'     => 'img/default/product/acoustic_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $acousticData = collect([
            ['path'  =>  'img/default/gallery/product/acoustic-door/acoulite1.jpg'],
            ['path'  =>  'img/default/gallery/product/acoustic-door/acoulite2.jpg'],
            ['path'  =>  'img/default/gallery/product/acoustic-door/acoulite3.jpg'],
            ['path'  =>  'img/default/gallery/product/acoustic-door/acoulite4.jpg'],
        ]);

        gallerySeeder($acoustic, $acousticData);

       $satellite = Product::create([
            'name'          => 'Commercial Doors',
            'brand_id'      => 9,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/commercial.jpg',
            'thumbnail'     => 'img/default/product/commercial_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $satelliteData = collect([
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite1.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite2.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite3.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite4.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite5.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite6.jpg'],
            ['path'  =>  'img/default/gallery/product/commercial-doors/satellite7.jpg'],
        ]);

        gallerySeeder($satellite, $satelliteData);

        $industrial = Product::create([
            'name'          => 'Industrial PA',
            'brand_id'      => 5,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/industrial.jpg',
            'thumbnail'     => 'img/default/product/industrial_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $industrialData = collect([
            ['path'  =>  'img/default/gallery/product/industrial/entrex1.jpg'],
            ['path'  =>  'img/default/gallery/product/industrial/entrex2.jpg'],
        ]);

        gallerySeeder($industrial, $industrialData);

        $residential = Product::create([
            'name'          => 'Residential and Aparment Doors',
            'brand_id'      => 7,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/apartment.jpg',
            'thumbnail'     => 'img/default/product/apartment_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $residentialData = collect([
            ['path'  =>  'img/default/gallery/product/residential/kingdom1.jpg'],
            ['path'  =>  'img/default/gallery/product/residential/kingdom2.jpg'],
            ['path'  =>  'img/default/gallery/product/residential/kingdom3.jpg'],
        ]);

        gallerySeeder($residential, $residentialData);

        $toiletPartition = Product::create([
            'name'          => 'Washroom cubicles / Toilet Partitions',
            'brand_id'      => 6,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/cubicle.jpg',
            'thumbnail'     => 'img/default/product/cubicle_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $toiletPartitionData = collect([
            ['path'  =>  'img/default/gallery/product/toilet-partition/imaj1.jpg'],
            ['path'  =>  'img/default/gallery/product/toilet-partition/imaj2.jpg'],
            ['path'  =>  'img/default/gallery/product/toilet-partition/imaj3.jpg'],
        ]);

        gallerySeeder($toiletPartition, $toiletPartitionData);

       $comet =  Product::create([
            'name'          => 'Access Panels',
            'brand_id'      => 4,
            'description'   => $faker->sentence(),
            'image'         => 'img/default/product/access.jpg',
            'thumbnail'     => 'img/default/product/access_head.jpg',
            'content'       => $faker->paragraph(),
            'specification' => $faker->paragraph(),
        ]);

        $cometData = collect([
            ['path'  =>  'img/default/gallery/product/panels/comet1.jpg'],
            ['path'  =>  'img/default/gallery/product/panels/comet2.jpg'],
            ['path'  =>  'img/default/gallery/product/panels/comet3.jpg'],
            ['path'  =>  'img/default/gallery/product/panels/comet4.jpg'],
            ['path'  =>  'img/default/gallery/product/panels/comet5.jpg'],
        ]);

        gallerySeeder($comet, $cometData);

 	// $table->string('name')->unique();
  //           $table->integer('brand_id')->unsigned();
  //           $table->text('description');
  //           $table->text('content');
  //           $table->text('specification')->nullable();
  //           $table->string('image');
  //           $table->string('thumbnail');
  //           $table->string('slug');
      

        $this->enableForeignKeys();
    }
}