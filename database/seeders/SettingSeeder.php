<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            // Branding
            'website_name' => 'Weekly Inqilab',
            'site_title' => 'Weekly Inqilab - Your Trusted News Source',
            'site_motto' => 'Empowering Your Ideas with Truth',
            'site_logo_white' => 'images/settings/logo-white.png',
            'site_logo_black' => 'images/settings/logo-black.png',
            'site_favicon' => 'images/settings/favicon.ico',
            'login_background_image' => 'images/settings/login-bg.jpg',

            // Contact Information
            'primary_email' => 'news@weeklyinqilab.com',
            'support_email' => 'support@weeklyinqilab.com',
            'info_email' => 'info@weeklyinqilab.com',
            'news_email' => 'news@weeklyinqilab.com',
            'primary_phone' => '+1 (929) 328-5971',
            'fax' => '201 4898035',
            'alternative_phone' => '9293285971',
            'whatsapp_number' => '+1 (929) 328-5971',

            // Address
            'address_one' => '86-11 101 AVENUE, OZONE PARK, NY, 11416, USA',
            'address_two' => '৫০/এফ ইনার সার্কুলার রোড নয়া পল্টন ঢাকা-১০০০',

            // Timezone & Language
            'default_language' => 'bn',
            'default_currency' => 'BDT',
            'system_timezone' => 'Asia/Dhaka',

            // SEO & Analytics
            'site_url' => 'https://weeklyinqilab.com/',
            'meta_title' => 'Weekly Inqilab - Your Trusted News Source',
            'meta_keyword' => 'Weekly Inqilab, Bangla News, Politics, Sports, Entertainment',
            'meta_tags' => 'Weekly Inqilab, Bangla News, Politics, Sports, Entertainment',
            'meta_description' => 'Weekly Inqilab is your trusted source for the latest news in politics, sports, entertainment, and more.',
            'google_analytics' => null,
            'google_adsense' => null,
            'facebook_pixel_id' => null,
            'og_image' => 'uploads/settings/og-image.jpg',
            'og_title' => 'Weekly Inqilab - Your Trusted News Source',
            'og_description' => 'Stay updated with the latest news from Weekly Inqilab.',
            'canonical_url' => 'https://weeklyinqilab.com/',

            // Copyright
            'copyright_title' => 'কপিরাইট © ২০২৫ সাপ্তাহিক ইনকিলাব কর্তৃক সর্বসত্ব ® সংরক্ষিত',
            'copyright_url' => 'https://weeklyinqilab.com/',

            // Social Media URLs
            'facebook_url' => 'https://facebook.com/weeklyinqilab',
            'instagram_url' => 'https://instagram.com/weeklyinqilab',
            'linkedin_url' => 'https://linkedin.com/company/weeklyinqilab',
            'whatsapp_url' => 'https://wa.me/9293285971',
            'twitter_url' => 'https://twitter.com/weeklyinqilab',
            'youtube_url' => 'https://youtube.com/@weeklyinqilab',
            'pinterest_url' => 'https://pinterest.com/weeklyinqilab',
            'reddit_url' => 'https://reddit.com/r/weeklyinqilab',
            'tumblr_url' => 'https://weeklyinqilab.tumblr.com',
            'tiktok_url' => 'https://tiktok.com/@weeklyinqilab',
            'website_url' => 'https://weeklyinqilab.com/',

            // Feature Toggles
            'maintenance_mode' => false,
            'enable_user_registration' => true,
            'enable_email_verification' => true,
            'enable_api_access' => false,
            'enable_multilanguage' => true,
            'is_demo' => false,

            // Business Settings
            'company_name' => 'Inqilab Enterprise and Publications Ltd.',
            'minimum_order_amount' => 50,

            // Business Hours
            'business_hours' => json_encode([
                'saturday' => ['start' => '09:00', 'end' => '18:00'],
                'sunday' => ['start' => '09:00', 'end' => '18:00'],
                'monday' => ['start' => '09:00', 'end' => '18:00'],
                'tuesday' => ['start' => '09:00', 'end' => '18:00'],
                'wednesday' => ['start' => '09:00', 'end' => '18:00'],
                'thursday' => ['start' => '09:00', 'end' => '18:00'],
                'friday' => ['start' => null, 'end' => null],
            ]),

            // Email Settings
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => 'user@example.com',
            'mail_password' => 'secret',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'noreply@weeklyinqilab.com',
            'mail_from_name' => 'Weekly Inqilab',

            // Security & Compliance
            'captcha_enabled' => false,
            'captcha_site_key' => null,
            'captcha_secret_key' => null,
            'cookie_consent_enabled' => true,
            'cookie_consent_text' => 'This website uses cookies to ensure you get the best experience.',
            'privacy_policy_url' => 'https://weeklyinqilab.com/privacy-policy',
            'terms_conditions_url' => 'https://weeklyinqilab.com/terms-conditions',

            // Advanced Settings
            'theme_color' => '#3490dc',
            'dark_mode' => false,
            'custom_css' => null,
            'custom_js' => null,

            // Custom Settings (JSON object for dynamic config)
            'custom_settings' => json_encode([
                'some_plugin_enabled' => true,
                'max_upload_size_mb' => 20,
                'notifications_enabled' => true,
            ]),

            // Auditing
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
