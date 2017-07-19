<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
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
        $this->truncate('tags');


        $faker = Faker::create();

        Tag::create([
            'name'          => 'Kwiloc',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/kwiloc.png',
            'type'          => config('tag.type.brand.key')
        ]);


        Tag::create([
            'name'          => 'Acoulite',
            'description'   => 'Designed to enhance the image and environment of today&rquo;s ',
            'image'         => 'img/default/brand/acoulite.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'AMF Ceiling Tiles',
            'description'   => 'Designed to enhance the image and environment of today&rquo;s ',
            'image'         => 'img/default/brand/amf-premium.jpg',
            'type'          => config('tag.type.brand.key')
        ]);


        Tag::create([
            'name'          => 'Comet',
            'description'   => 'Comet Access hatches are a continuation of many years of quality under the kwikloc brand. ',
            'image'         => 'img/default/brand/comet.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Entrex',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/entrex.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Imaj',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/imaj.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Kingdom',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/kingdom.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Korporate',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/korporate.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Satellite',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/satellite.png',
            'type'          => config('tag.type.brand.key')
        ]);

        Tag::create([
            'name'          => 'Kwiloc Seismic',
            'description'   => 'Designed to enhance the image and environment of today&rquos;s office interior.',
            'image'         => 'img/default/brand/kwiloc.png',
            'type'          => config('tag.type.brand.key')
        ]);


        $this->enableForeignKeys();
    }
}
