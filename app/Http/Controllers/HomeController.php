<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __invoke()
    {
        $defaults = [
            'home_site_brand' => 'AMAZON LEO',
            'home_phone' => '+254 704 991 492',
            'home_hero_title' => "Very Fast\nAmazon Leo Internet\nwith No Downtime\nin Kenya.",
            'home_hero_description' => '400Mbps for Ksh 6,500',
            'home_price_label' => 'High-speed home and business internet',
            'home_price_amount' => '6,500',
            'home_price_unit' => 'KES/mo',
            'home_primary_cta' => 'Request For Installation',
            'home_provider_cta' => 'View Packages',
            'home_whatsapp_cta' => 'Call/WhatsApp Us',
            'home_whatsapp_url' => 'https://wa.me/254704991492?text=Hello%2C%20I%20want%20Amazon%20Leo%20Internet%20Kenya%20installation.',
            'home_services_title' => "AMAZON LEO KENYA\nKITS",
            'home_services_subtitle' => 'End-to-end Amazon Leo installation for places fiber and mobile data do not serve well.',
            'home_kit_title_1' => 'AMAZON LEO STANDARD KIT',
            'home_kit_text_1' => 'High-speed Amazon Leo internet kit for homes, offices, lodges, farms, and remote sites in Kenya.',
            'home_kit_price_1' => 'KES 55,000.00',
            'home_kit_title_2' => 'AMAZON LEO MINI KIT',
            'home_kit_text_2' => 'Compact portable kit for travel, field work, events, and backup internet connections.',
            'home_kit_price_2' => 'KES 30,000.00',
            'home_kit_title_3' => 'AMAZON LEO HIGH PERFORMANCE',
            'home_kit_text_3' => 'Mounting, clean cabling, signal alignment, router setup, and handover support.',
            'home_kit_price_3' => 'KES 250,000.00',
            'home_feature_title' => "Internet for travel,\nroad trips, and\ncommutes",
            'home_feature_text' => 'High-speed Amazon Leo Internet that moves with you, even in dead zones. In-motion use available in select areas.',
            'home_how_title_1' => 'Assess',
            'home_how_text_1' => 'We confirm location, roof access, power, coverage needs, and the best line of sight.',
            'home_how_title_2' => 'Install',
            'home_how_text_2' => 'The terminal is mounted securely, aligned, and cabled neatly to the indoor network point.',
            'home_how_title_3' => 'Configure',
            'home_how_text_3' => 'Router and Wi-Fi settings are configured for the property layout and user needs.',
            'home_how_title_4' => 'Test',
            'home_how_text_4' => 'We verify connection quality, obstruction status, and basic device performance.',
            'home_why_title' => 'Good signal starts with correct placement.',
            'home_why_text' => 'Amazon Leo Internet is sensitive to obstruction, mounting angle, power stability, and cable routing. A professional install reduces downtime, weak Wi-Fi zones, and messy repairs later.',
            'home_areas_title' => 'Need Amazon Leo Internet installed?',
            'home_areas_text' => 'Send your location and site type. We will help you plan the cleanest installation route.',
            'home_testimonials_title' => 'Installation support for reliable satellite internet',
            'home_empty_testimonials' => '<h1>Amazon Leo Internet Kenya: The Ultimate Guide to Satellite Internet in Kenya</h1><h2>Introduction</h2><p><strong>Amazon Leo Internet Kenya</strong> helps homes, businesses, schools, farms, construction sites, and remote communities get fast, reliable, low-latency internet where fiber and mobile networks struggle to reach.</p>',
            'home_footer_text' => 'Satellite internet kits, installation, support, and connectivity planning across Kenya.',
            'home_hero_image' => 'https://satelliteinternetinstallers.com/wp-content/uploads/2026/05/rectangular-dish-installation-hero.png',
            'home_feature_image' => 'https://satelliteinternetinstallers.com/wp-content/uploads/2026/05/starlink-inspired-travel-hero.png',
        ];

        $content = collect($defaults)->mapWithKeys(fn ($default, $key) => [$key => Setting::valueFor($key, $default)]);
        $content['home_hero_image_url'] = $this->imageUrl($content['home_hero_image']);
        $content['home_feature_image_url'] = $this->imageUrl($content['home_feature_image']);
        $content['home_phone_href'] = 'tel:'.preg_replace('/\D+/', '', (string) $content['home_phone']);

        return view('home', [
            'content' => $content,
        ]);
    }

    private function imageUrl(?string $image): string
    {
        $image = trim((string) $image);

        if ($image === '') {
            return 'https://via.placeholder.com/1800x900?text=Homepage';
        }

        return Str::startsWith($image, ['http://', 'https://', '//'])
            ? $image
            : asset(Str::startsWith($image, ['/storage/', 'storage/'])
                ? ltrim($image, '/')
                : 'storage/'.ltrim($image, '/'));
    }
}
