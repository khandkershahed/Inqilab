<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        foreach ($categories as $parent) {
            // Add 5 news for parent category only
            $this->createNewsForCategory($parent);

            foreach ($parent->children as $child) {
                // Add 5 news for subcategory
                $this->createNewsForCategory($parent, $child);

                // if ($child->children && $child->children->count()) {
                //     foreach ($child->children as $subChild) {
                //         // Add 5 news for sub-subcategory
                //         $this->createNewsForCategory($parent, $child, $subChild);
                //     }
                // }
            }
        }
    }

    private function createNewsForCategory($parent, $sub = null, $subSub = null)
    {
        for ($i = 1; $i <= 5; $i++) {
            $title = 'Sample News ' . Str::random(6);

            News::create([
                'category_id'        => $parent->id,
                'sub_category_id'    => $sub?->id,
                'title'              => $title,
                'bangla_title'       => 'বাংলা শিরোনাম ' . $i,
                'slug'               => Str::slug($title . '-' . Str::random(4)),
                'summary'            => 'This is a summary for ' . $title,
                'bangla_summary'     => 'বাংলা সারাংশ',
                'content'            => '<p>This is sample content for ' . $title . '</p>',
                'bangla_content'     => '<p>বাংলা কনটেন্ট</p>',
                'thumbnail'          => 'images/news/thumb-default.jpg',
                'banner_image'       => 'images/news/banner-default.jpg',
                'video_url'          => null,
                'tags'               => 'news, sample, test',
                'meta_title'         => $title . ' | Weekly Inqilab',
                'meta_description'   => 'Meta description for ' . $title,
                'meta_keywords'      => 'news, demo, sample',
                'type'               => 'standard',
                'is_featured'        => rand(0, 1),
                'is_most_read'       => rand(0, 1),
                'is_breaking'        => rand(0, 1),
                'show_on_homepage'   => rand(0, 1),
                'show_in_slider'     => rand(0, 1),
                'is_trending'        => rand(0, 1),
                'status'             => 'published',
                'published_at'       => Carbon::now()->subDays(rand(0, 10)),
                'author'             => 'Admin',
                'view_count'         => rand(10, 200),
                'share_count'        => rand(0, 20),
                'comment_count'      => rand(0, 10),
                'created_by'         => 1,
                'updated_by'         => 1,
            ]);
        }
    }
}
