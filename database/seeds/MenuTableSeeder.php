<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Menu\Menu;
use App\Models\Menu\Node;
use App\Models\Product\Product;
use App\Models\Page;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
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
        $this->truncate('menus');
        $this->truncate('nodes');

        $this->mainMenu();
       

        $this->enableForeignKeys();
    }

    public function mainMenu()
    {
        $menu = Menu::create([
            'name' => 'Main Menu',
            'position' => 'top-center',
            'depth'     => 2,
        ]);

        $node = Node::create([
            'menu_id'       => $menu->id,
            'title'         => 'Home',
            'type'          => 'custom-link',
            'target'        => 'not-self',
            'sort_order'    => 1,
            'url'           => env('APP_DEV_URL')
        ]);

        $model = Page::where('id', 3)->first();
        $node = Node::create([
            'menu_id'       => $menu->id,
            'related_id'    => $model->id,
            'title'         => $model->name,
            'type'          => 'page',
            'related_type'  => 'page',
            'target'        => 'not-self',
            'sort_order'    => 2
        ]);
	        $model = Page::where('id', 5)->first();
        	$menuNode = Node::create([
                'parent_id'     => $node->id,
                'menu_id'       => $menu->id,
                'related_id'    => $model->id,
                'title'         => $model->name,
                'type'          => 'page',
                'related_type'  => 'page',
                'target'        => 'not-self',
                'sort_order'    => 0
            ]);

            $model = Page::where('id', 4)->first();
        	$menuNode = Node::create([
                'parent_id'     => $node->id,
                'menu_id'       => $menu->id,
                'related_id'    => $model->id,
                'title'         => $model->name,
                'type'          => 'page',
                'related_type'  => 'page',
                'target'        => 'not-self',
                'sort_order'    => 0
            ]);

            $model = Page::where('id', 3)->first();
        	$menuNode = Node::create([
                'parent_id'     => $node->id,
                'menu_id'       => $menu->id,
                'related_id'    => $model->id,
                'title'         => $model->name,
                'type'          => 'page',
                'related_type'  => 'page',
                'target'        => 'not-self',
                'sort_order'    => 0
            ]);

        $node = Node::create([
            'menu_id'       => $menu->id,
            'title'         => 'Products',
            'type'          => 'custom-link',
            'target'        => 'not-self',
            'sort_order'    => 3,
            'url'           => env('APP_DEV_URL') . 'products'
        ]);
            foreach (Product::all() as $key => $model) {
                 $menuNode = Node::create([
                    'parent_id'     => $node->id,
                    'menu_id'       => $menu->id,
                    'related_id'    => $model->id,
                    'title'         => $model->name,
                    'type'          => 'product',
                    'related_type'  => 'product',
                    'target'        => 'not-self',
                    'sort_order'    => $key
                ]);
            }

        $node = Node::create([
            'menu_id'       => $menu->id,
            'title'         => 'Products by Brand',
            'type'          => 'custom-link',
            'target'        => 'not-self',
            'sort_order'    => 4,
            'url'           => env('APP_DEV_URL') . 'products'
        ]);
            foreach (Product::all() as $key => $model) {
                $menuNode = Node::create([
                    'parent_id'     => $node->id,
                    'menu_id'       => $menu->id,
                    'related_id'    => $model->id,
                    'title'         => $model->brand->name,
                    'type'          => 'product',
                    'related_type'  => 'product',
                    'target'        => 'not-self',
                    'sort_order'    => $key
                ]);
            }

            

        $node = Node::create([
            'menu_id'       => $menu->id,
            'title'         => 'Projects',
            'type'          => 'custom-link',
            'target'        => 'not-self',
            'sort_order'    => 5,
            'url'           => env('APP_DEV_URL') . 'projects'
        ]);

        $model = Page::where('id', 2)->first();
        $node = Node::create([
            'menu_id'       => $menu->id,
            'related_id'    => $model->id,
            'title'         => $model->name,
            'type'          => 'page',
            'related_type'  => 'page',
            'target'        => 'not-self',
            'sort_order'    => 6
        ]);


        $menu = Menu::create([
            'name' => 'Pages',
            'position' => 'bottom-center',
            'depth'     => 1,
        ]);
            foreach (Page::where('id', '>', 2)->get() as $key => $model) {
                $menuNode = Node::create([
                    'menu_id'       => $menu->id,
                    'related_id'    => $model->id,
                    'title'         => $model->name,
                    'type'          => 'page',
                    'related_type'  => 'page',
                    'target'        => 'not-self',
                    'sort_order'    => 0
                ]);
            }

        $menu = Menu::create([
            'name' => 'Products',
            'position' => 'bottom-right',
            'depth'     => 1,
        ]);
            foreach (Product::all() as $key => $model) {
                $menuNode = Node::create([
                    'menu_id'       => $menu->id,
                    'related_id'    => $model->id,
                    'title'         => $model->name,
                    'type'          => 'product',
                    'related_type'  => 'product',
                    'target'        => 'not-self',
                    'sort_order'    => $key
                ]);
            }
    }
}