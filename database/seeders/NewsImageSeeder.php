<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = News::all();

        foreach ($newsItems as $news) {
            $imageCount = rand(1, 3); // each news gets 1-3 images

            for ($i = 1; $i <= $imageCount; $i++) {
                NewsImage::create([
                    'news_id'     => $news->id,
                    'photo'       => 'images/news/sample-image-' . rand(1, 5) . '.jpg',
                    'created_by'  => 1,
                    'updated_by'  => 1,
                ]);
            }
        }
    }
}
