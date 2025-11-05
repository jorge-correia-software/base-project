<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Primary Navigation Menu
        $menu = Menu::create([
            'name' => 'Primary Navigation',
            'slug' => 'primary-navigation',
            'location' => 'header',
            'is_active' => true,
        ]);

        // Create Menu Items
        $menuItems = [
            ['title' => 'Home', 'url' => '/', 'order' => 0],
            ['title' => 'About', 'url' => '/about', 'order' => 1],
            ['title' => 'Partners', 'url' => '/partners', 'order' => 2],
            ['title' => 'Activities', 'url' => '/activities', 'order' => 3],
            ['title' => 'Support', 'url' => '/support', 'order' => 4],
            ['title' => 'Highlights', 'url' => '/highlights', 'order' => 5],
            ['title' => 'Contact', 'url' => '/contact', 'order' => 6],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'menu_id' => $menu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'target' => '_self',
                'order' => $item['order'],
                'is_active' => true,
            ]);
        }
    }
}
