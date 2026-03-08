<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@devthreads.com',
        ]);

        // Categories
        $tshirts = Category::create(['name' => 'T-Shirts', 'slug' => 't-shirts', 'description' => 'Comfy dev tees for every occasion']);
        $hoodies = Category::create(['name' => 'Hoodies', 'slug' => 'hoodies', 'description' => 'Warm hoodies for late-night coding']);
        $mugs = Category::create(['name' => 'Mugs', 'slug' => 'mugs', 'description' => 'Fuel your coding sessions']);
        $stickers = Category::create(['name' => 'Stickers', 'slug' => 'stickers', 'description' => 'Deck out your laptop']);

        // T-Shirts
        $tshirtProducts = [
            ['name' => 'git push --force Friday', 'price' => 29.99, 'description' => "For the brave developer who deploys on Fridays. This soft cotton tee features the legendary command that makes your teammates nervous. Wear it proudly — you've earned it.", 'is_featured' => true],
            ['name' => 'It Works On My Machine', 'price' => 27.99, 'description' => "The universal developer excuse, now on a premium tee. Perfect for stand-ups when QA finds that bug you definitely didn't introduce.", 'is_featured' => true],
            ['name' => 'CSS Is Awesome (Overflow)', 'price' => 28.99, 'description' => "The classic CSS meme where the text overflows the box. Every frontend dev has been there. This tee says it all.", 'is_featured' => true],
            ['name' => '!false — It\'s Funny Because It\'s true', 'price' => 26.99, 'description' => "A boolean joke that evaluates to true humor. Only real programmers will get this one — which makes it even better."],
            ['name' => 'There Are 10 Types of People', 'price' => 27.99, 'description' => "Those who understand binary and those who don't. The original programmer joke, now on a comfortable crew neck tee."],
            ['name' => 'I Turned Coffee Into Code', 'price' => 25.99, 'description' => "The developer's daily miracle. Powered by caffeine, driven by deadlines. 100% cotton, 100% relatable."],
            ['name' => 'sudo rm -rf / My Problems', 'price' => 29.99, 'description' => "If only life bugs were as easy to fix as server issues. Warning: do not actually run this command. Do wear this shirt.", 'is_featured' => true],
            ['name' => 'Hello World — First Commit', 'price' => 24.99, 'description' => "Every developer's first line of code, commemorated on a tee. A great gift for bootcamp grads and CS freshmen."],
        ];

        foreach ($tshirtProducts as $p) {
            Product::create(array_merge($p, [
                'category_id' => $tshirts->id,
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'sizes' => 'S,M,L,XL,XXL',
                'is_featured' => $p['is_featured'] ?? false,
                'meta_title' => $p['name'] . ' - Developer T-Shirt | DevThreads',
                'meta_description' => \Illuminate\Support\Str::limit($p['description'], 155),
            ]));
        }

        // Hoodies
        $hoodieProducts = [
            ['name' => 'Merge Conflict Survivor', 'price' => 49.99, 'description' => "You've stared into the abyss of <<<< HEAD and lived to tell the tale. This premium hoodie is your badge of honor. Fleece-lined for those cold debugging sessions.", 'is_featured' => true],
            ['name' => 'Dark Mode Everything', 'price' => 54.99, 'description' => "Dark IDE. Dark browser. Dark hoodie. Consistency is key. A pitch-black premium hoodie for developers who live in the shadows of their monitors.", 'is_featured' => true],
            ['name' => 'Stack Overflow Driven Development', 'price' => 47.99, 'description' => "Honest about your development methodology? This hoodie is for you. Copy, paste, ship. The real senior developer move."],
            ['name' => 'localhost:3000 Hoodie', 'price' => 52.99, 'description' => "Home is where localhost runs. A minimal, clean design for developers who appreciate the beauty of a running dev server."],
        ];

        foreach ($hoodieProducts as $p) {
            Product::create(array_merge($p, [
                'category_id' => $hoodies->id,
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'sizes' => 'S,M,L,XL,XXL',
                'is_featured' => $p['is_featured'] ?? false,
                'meta_title' => $p['name'] . ' - Developer Hoodie | DevThreads',
                'meta_description' => \Illuminate\Support\Str::limit($p['description'], 155),
            ]));
        }

        // Mugs
        $mugProducts = [
            ['name' => 'console.log("coffee") Mug', 'price' => 16.99, 'description' => "Debug your morning with this 11oz ceramic mug. Dishwasher safe, microwave friendly, and guaranteed to compile your caffeine."],
            ['name' => '// TODO: Drink Coffee Mug', 'price' => 14.99, 'description' => "The most important TODO in your codebase. 11oz white ceramic mug with a comment that should never be resolved."],
        ];

        foreach ($mugProducts as $p) {
            Product::create(array_merge($p, [
                'category_id' => $mugs->id,
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'sizes' => 'Standard',
                'is_featured' => false,
                'meta_title' => $p['name'] . ' - Developer Mug | DevThreads',
                'meta_description' => \Illuminate\Support\Str::limit($p['description'], 155),
            ]));
        }

        // Stickers
        $stickerProducts = [
            ['name' => 'Vim Exit Sticker Pack', 'price' => 8.99, 'description' => "A 5-pack of stickers for people who finally figured out how to exit Vim. Features :wq, :q!, and the classic panic Ctrl+C. Waterproof vinyl."],
            ['name' => 'Bug Free Zone Laptop Sticker', 'price' => 5.99, 'description' => "Declare your laptop a bug-free zone. (Results may vary.) High-quality vinyl sticker, UV resistant, won't leave residue."],
        ];

        foreach ($stickerProducts as $p) {
            Product::create(array_merge($p, [
                'category_id' => $stickers->id,
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'sizes' => 'Standard',
                'is_featured' => false,
                'meta_title' => $p['name'] . ' - Developer Sticker | DevThreads',
                'meta_description' => \Illuminate\Support\Str::limit($p['description'], 155),
            ]));
        }
    }
}
