<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'writer_id' => 1,
            'image' => 'posts/sample-image.jpg',
            'video' => null,
            'title' => ['en' => 'First Post', 'ar' => 'أول منشور'],
            'description' => [
                'en' => 'This is the description of my first post in English.',
                'ar' => 'هذا هو وصف أول منشور لي باللغة العربية.'
            ],
            'short_description' => [
                'en' => 'Short description in English',
                'ar' => 'وصف مختصر بالعربية'
            ],
            'date' => now(),
        ]);

        // You can add more posts here
        Post::create([
            'writer_id' => 1,
            'image' => 'posts/another-image.jpg',
            'video' => 'posts/sample-video.mp4',
            'title' => ['en' => 'Second Post', 'ar' => 'المنشور الثاني'],
            'description' => [
                'en' => 'Another post description in English.',
                'ar' => 'وصف آخر للمنشور باللغة العربية.'
            ],
            'short_description' => [
                'en' => 'Another short description',
                'ar' => 'وصف مختصر آخر'
            ],
            'date' => now()->subDays(2),
        ]);
    }
}