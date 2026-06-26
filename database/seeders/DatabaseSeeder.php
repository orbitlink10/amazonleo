<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Review;
use App\Models\Role;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = collect([
            ['name' => 'admin', 'label' => 'Admin'],
            ['name' => 'customer', 'label' => 'Customer'],
            ['name' => 'provider', 'label' => 'Service Provider'],
            ['name' => 'dispatcher', 'label' => 'Staff/Dispatcher'],
        ])->mapWithKeys(fn ($role) => [$role['name'] => Role::updateOrCreate(['name' => $role['name']], $role)]);

        $admin = User::updateOrCreate(['email' => 'admin@demo.com'], [
            'role_id' => $roles['admin']->id,
            'name' => 'Lasafi Admin',
            'phone' => '0711000000',
            'county' => 'Nairobi',
            'location' => 'Westlands',
            'password' => Hash::make('admin123'),
        ]);

        User::updateOrCreate(['email' => 'dispatcher@lasafi.co.ke'], [
            'role_id' => $roles['dispatcher']->id,
            'name' => 'Operations Dispatcher',
            'phone' => '0711000001',
            'county' => 'Nairobi',
            'location' => 'CBD',
            'password' => Hash::make('password'),
        ]);

        $customer = User::updateOrCreate(['email' => 'customer@example.com'], [
            'role_id' => $roles['customer']->id,
            'name' => 'Amina Otieno',
            'phone' => '0712345678',
            'county' => 'Nairobi',
            'location' => 'Kilimani',
            'password' => Hash::make('password'),
        ]);

        $providerUser = User::updateOrCreate(['email' => 'provider@example.com'], [
            'role_id' => $roles['provider']->id,
            'name' => 'Kamau Home Pros',
            'phone' => '0722000000',
            'county' => 'Nairobi',
            'location' => 'Roysambu',
            'password' => Hash::make('password'),
        ]);

        $categoryNames = [
            'Cleaning', 'Movers', 'Handyman', 'Pest Control', 'Laundry', 'Gardening',
            'Appliance Repair', 'Security & CCTV', 'Wi-Fi & Networking', 'Office Maintenance',
        ];

        $categories = collect($categoryNames)->mapWithKeys(function ($name) {
            return [$name => Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $name.' services across Nairobi and major Kenyan towns.', 'is_active' => true]
            )];
        });

        $spacelinkCategories = [
            ['Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/starlink-1752131960.png'],
            ['ISP Billing Software', 'https://spacelinkkenya.co.ke/storage/uploads/images/ISP%20Billing%20Software-1752131843.jpg'],
            ['Starlink Extension', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink-Mini-1752131743.webp'],
            ['Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/starlink%20Accesories-1752219513.jpg'],
            ['Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Price%20Kenya-1752131573.png'],
            ['Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/strlink%20kenya-1752131423.jpg'],
        ];

        $productCategories = collect($spacelinkCategories)->mapWithKeys(function ($category) {
            [$name, $image] = $category;

            return [Str::slug($name) => Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $name,
                    'icon' => $image,
                    'is_active' => true,
                ]
            )];
        });

        $services = [
            ['Cleaning', 'Deep House Cleaning', 3500, 'fixed'],
            ['Cleaning', 'Post Construction Cleaning', 6500, 'fixed'],
            ['Movers', 'Apartment Moving', 5000, 'per km'],
            ['Handyman', 'General Repairs', 1800, 'hourly'],
            ['Pest Control', 'Cockroach and Bedbug Control', 4500, 'fixed'],
            ['Laundry', 'Wash and Fold', 700, 'per item'],
            ['Gardening', 'Lawn Care Visit', 2500, 'fixed'],
            ['Appliance Repair', 'Fridge and Cooker Repair', 2500, 'fixed'],
            ['Security & CCTV', 'CCTV Installation', 12000, 'per item'],
            ['Wi-Fi & Networking', 'Home Wi-Fi Setup', 3500, 'fixed'],
            ['Office Maintenance', 'Monthly Office Maintenance', 15000, 'fixed'],
        ];

        $serviceModels = collect($services)->map(function ($service) use ($categories) {
            [$category, $name, $price, $unit] = $service;

            return Service::updateOrCreate(['slug' => Str::slug($name)], [
                'category_id' => $categories[$category]->id,
                'name' => $name,
                'description' => 'Reliable '.$name.' by vetted Lasafi professionals.',
                'base_price' => $price,
                'unit_type' => $unit,
                'is_active' => true,
            ]);
        });

        $products = [
            ['Starlink Flat High-Performance Kit', 'starlink-flat-high-performance-kit', 350000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Flat%20High%20Performance%20Kit%20:.%20%20-1752321323.webp'],
            ['Starlink Enterprise Kit', 'starlink-enterprise-kit', 180000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Enterprise%20Kit%20in%20Kenya.%20-1752321115.png'],
            ['Starlink High Performance Kit', 'starlink-high-performance-kit', 230000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20High%E2%80%91Performance%20Kit%20%20%20%20-1752320420.jpg'],
            ['Starlink Mini KIT', 'starlink-mini-kit', 30000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini-1752219026.webp'],
            ['Starlink Standard Kit V4', 'starlink-standard-kit-v4', 55000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Kit%20V4-1752215788.jpeg'],
            ['Starlink Standard Actuated Gen 2', 'starlink-standard-actuated-gen-2', 45000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Actuated%20Gen%202-1752215212.png'],
            ['Starlink Gen 3 Kit', 'starlink-gen-3-kit', 50000, 'Starlink Kenya Price', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Gen%E2%80%AF3%20Kit-1752214947.jpg'],
            ['Starlink Mini Car Adapter', 'starlink-mini-car-adapter', 12000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Car%20Adapter%20%20++-1781687302.png'],
            ['Starlink Router Mini', 'starlink-router-mini', 15000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Router%20Mini-1752214424.jpg'],
            ['Starlink Mini Power Cable Direct to Cigarette Adapter', 'starlink-mini-power-cable-direct-to-cigarette-adapter', 13000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Power%20Cable%20%E2%80%93%20Direct%20to%20Cigarette%20Adapter-1752214152.png'],
            ['Starlink Mini USB-C Cable 5 m', 'starlink-mini-usb-c-cable-5-m', 7000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20USB-C%20Cable%20%205%20m%20(16.4%20ft)-1752213940.jpg'],
            ['Starlink Mini Case for Travel and Outdoor Camping', 'starlink-mini-case-for-travel-and-outdoor-camping', 28000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Case%20for%20Travel%20and%20Outdoor%20Camping-1752213692.jpg'],
            ['Starlink Mini Adventure Bag', 'starlink-mini-adventure-bag', 24000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Adventure%20Bag-1752213450.jpg'],
            ['Starlink Standard Kit V4 Mount', 'starlink-standard-kit-v4-mount', 17000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Kit%20V4%20Mount-1752152281.jpg'],
            ['Starlink Mini Pivot Mount', 'starlink-mini-pivot-mount', 19000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Pivot%20Mount-1752149884.jpg'],
            ['15 m Starlink Mini DC Power Cable', '15-m-starlink-mini-dc-power-cable', 16000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/30%E2%80%AFm%20Starlink%20Mini%20DC%20Power%20Cable-1752147562.jpg'],
            ['30 m Starlink Mini DC Power Cable', '30-m-starlink-mini-dc-power-cable', 18000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Standard%20Starlink%20Cable%2030m%20-1752176073.jpg'],
            ['Starlink Mini Mobility Mount', 'starlink-mini-mobility-mount', 14000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Mobility%20Mount-1752145902.jpg'],
            ['Starlink Mini Roof Rack Mount', 'starlink-mini-roof-rack-mount', 14000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Roof%20Rack%20Mount-1752144343.jpg'],
            ['Portable Power Backup for Starlink High Performance Kit', 'portable-power-backup-for-starlink-high-performance-kit', 350000, 'Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20High%20Performance%20Kit%20+%20Portable%20Power%20Backup-1752144352.webp'],
            ['Efficient Power Backup for Starlink Enterprise Kit', 'efficient-power-backup-for-starlink-enterprise-kit', 300000, 'Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Power%20Backup%20for%20Starlink%20Enterprise%20Kit%20%20-1752144165.jpg'],
            ['5 m Starlink Mini USB-C Cable', '5-m-starlink-mini-usb-c-cable', 13000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/5%E2%80%AFm%20Starlink%20Mini%20USB%E2%80%91C%20Cable-1752143268.jpg'],
            ['Starlink Mini Pipe Adapter and Flat Mount', 'starlink-mini-pipe-adapter-and-flat-mount', 14000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Pipe%20Adapter%20and%20Flat%20Mount-1752141686.jpg'],
            ['Starlink Mini Travel Kit', 'starlink-mini-travel-kit', 28000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Travel%20Kit-1752141362.jpg'],
            ['Starlink Masonry Routing Kit', 'starlink-masonry-routing-kit', 23500, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Masonry%20Routing%20Kit-1752140883.jpg'],
            ['Reliable Power Backup for Starlink Flat High-Performance Kit', 'reliable-power-backup-for-starlink-flat-high-performance-kit', 550000, 'Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Flat%20High%20Performance%20Kit%20+%20Portable%20Power%20Backup%20-1752140914.webp'],
            ['Starlink Cable Routing Kit', 'starlink-cable-routing-kit', 19000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Cable%20Routing%20Kit-1752140672.jpg'],
            ['Starlink Mounts', 'starlink-mounts', 17000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mounts-1752140461.jpg'],
            ['Portable Power Backup for Starlink Mini Kit', 'portable-power-backup-for-starlink-mini-kit', 550000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Kit%20+%20Portable%20Power%20Backup%20-1752140263.jpg'],
            ['Portable Power Backup for Starlink Gen 2', 'portable-power-backup-for-starlink-gen-2', 155000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Actuated%20Kit%20Gen%202%20+%20Portable%20Power%20Backup%20-1752139942.jpg'],
            ['Portable Power Backup for Starlink Gen 3', 'portable-power-backup-for-starlink-gen-3', 190000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Gen%203%20+%20Portable%20Power%20Backup.%20%20-1752139021.webp'],
            ['Starlink Standard Pipe Adapter', 'starlink-standard-pipe-adapter', 21000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Pipe%20Adapter-1752138427.jpg'],
            ['Starlink Standard Wall Mount', 'starlink-standard-wall-mount', 26000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Wall%20Mount-1752138066.jpg'],
            ['Starlink Standard Pivot Mount', 'starlink-standard-pivot-mount', 27000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Pivot%20Mount-1752137673.jpg'],
            ['Portable Power Backup for Starlink V4', 'portable-power-backup-for-starlink-v4', 200000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20V4%20+%20Portable%20Power%20Backup%20-1752137601.jpg'],
            ['Starlink Standard Mobility Mount', 'starlink-standard-mobility-mount', 35000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Mobility%20Mount-1752137010.jpeg'],
            ['Starlink Ridgeline Mount', 'starlink-ridgeline-mount', 82000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Ridgeline%20Mount-1752136753.png'],
            ['Starlink Standard Roof Rack Mount', 'starlink-standard-roof-rack-mount', 22000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard%20Roof%20Rack%20Mount-1752136531.png'],
            ['Starlink Standard X-Frame Base', 'starlink-standard-x-frame-base', 28000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Standard%20X-Frame%20Base%20-1752136526.png'],
            ['Starlink Standard-to-Standard Actuated Mount Adapter', 'starlink-standard-to-standard-actuated-mount-adapter', 19000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Standard-to-Standard%20Actuated%20Mount%20Adapter-1752136309.jpg'],
            ['Standard-to-Standard Actuated Mount Adapter', 'standard-to-standard-actuated-mount-adapter', 24000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Standard-to-Standard%20Actuated%20Mount%20Adapter-1752136135.jpg'],
            ['Starlink Mini Wall Mount', 'starlink-mini-wall-mount', 28000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Mini%20Wall%20Mount%20-1752136011.jpg'],
            ['Starlink Gen 3 Router Mount', 'starlink-gen-3-router-mount', 36000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Gen%203%20Router%20Mount-1752135949.jpg'],
            ['Starlink Ethernet Adapter', 'starlink-ethernet-adapter', 12000, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Ethernet%20Adapter-1752135679.jpeg'],
            ['Standard Starlink Cable 30m', 'standard-starlink-cable-30m', 28000, 'Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Standard%20Starlink%20Cable%2030m-1752134366.jpg'],
            ['Standard Starlink Cable 15m', 'standard-starlink-cable-15m', 24000, 'Starlink Accesories', 'https://spacelinkkenya.co.ke/storage/uploads/images/Standard%20Starlink%20Cable%2015m-1752134175.png'],
            ['Starlink Gen 3 Mounting Stand', 'starlink-gen-3-mounting-stand', 7500, 'Where to buy Starlink in Kenya', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Gen%203%20Mounting%20Stand-1752133908.webp'],
            ['Starlink Gen 3 Mesh Router', 'starlink-gen-3-mesh-router', 350000, 'Starlink Kenya Packages', 'https://spacelinkkenya.co.ke/storage/uploads/images/Starlink%20Gen%203%20Mesh%20Router-1752135174.png'],
        ];

        collect($products)->each(function ($product) use ($productCategories) {
            [$name, $slug, $price, $category, $image] = $product;

            Product::updateOrCreate(['slug' => $slug], [
                'category_id' => $productCategories[Str::slug($category)]->id,
                'name' => $name,
                'price' => $price,
                'google_merchant' => false,
                'image' => $image,
                'description' => $name,
            ]);
        });

        $provider = Provider::updateOrCreate(['email' => 'provider@example.com'], [
            'user_id' => $providerUser->id,
            'category_id' => $categories['Cleaning']->id,
            'name' => 'Kamau Home Pros',
            'phone' => '0722000000',
            'county' => 'Nairobi',
            'location' => 'Roysambu',
            'availability_status' => 'available',
            'rating' => 4.8,
            'verification_status' => 'approved',
        ]);
        $provider->services()->sync($serviceModels->take(4)->pluck('id'));

        $booking = Booking::updateOrCreate(['booking_number' => 'LAS-DEMO-001'], [
            'customer_id' => $customer->id,
            'category_id' => $categories['Cleaning']->id,
            'service_id' => $serviceModels->first()->id,
            'provider_id' => $provider->id,
            'location' => 'Kilimani, Nairobi',
            'preferred_date' => now()->addDay()->toDateString(),
            'preferred_time' => '09:00',
            'description' => 'Two-bedroom apartment deep clean.',
            'urgency' => 'normal',
            'estimated_price' => 3500,
            'status' => 'assigned',
            'provider_status' => 'accepted',
            'assigned_at' => now(),
        ]);

        Payment::updateOrCreate(['booking_id' => $booking->id], [
            'customer_id' => $customer->id,
            'phone_number' => '254712345678',
            'amount' => 3500,
            'status' => 'pending',
        ]);

        Review::updateOrCreate(['booking_id' => $booking->id, 'customer_id' => $customer->id], [
            'provider_id' => $provider->id,
            'rating' => 5,
            'comment' => 'Fast, professional and easy to book.',
        ]);

        Setting::updateOrCreate(['key' => 'support_phone'], ['value' => '+254 711 000 000']);
        Setting::updateOrCreate(['key' => 'support_whatsapp'], ['value' => '254711000000']);
        Setting::updateOrCreate(['key' => 'service_areas'], ['value' => 'Nairobi, Kiambu, Machakos, Kajiado, Mombasa, Nakuru, Kisumu, Eldoret']);
    }
}
