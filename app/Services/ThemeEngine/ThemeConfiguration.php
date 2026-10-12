<?php

declare(strict_types=1);

namespace App\Services\ThemeEngine;

class ThemeConfiguration
{
    /**
     * Get simulated mobile app store/service demo data for each theme
     */
    public static function getThemeDemoContent(string $slug): array
    {
        $configs = [
            'modern-minimalist' => [
                'brand_name' => 'LUMIÈRE',
                'brand_sub' => 'Modern Living',
                'tagline' => 'Curated Design for Warm Interiors',
                'theme_name' => 'Modern Minimalist',
                'category' => 'Ecommerce',
                'badge' => 'Clean & Neutral',
                'colors' => [
                    'primary' => '#252525',
                    'accent' => '#B69A78',
                    'bg' => '#FBF9F7',
                    'card' => '#FFFFFF',
                    'text' => '#1C1917',
                    'muted' => '#78716C',
                    'border' => '#E7E5E4',
                ],
                'hero' => [
                    'title' => 'New Autumn Arrivals',
                    'subtitle' => 'Sculpted furniture and warm ceramic lighting.',
                    'badge' => 'Curated 2026',
                    'cta' => 'Explore Collection',
                ],
                'categories' => ['All', 'Sofas', 'Lighting', 'Decor', 'Tables'],
                'items' => [
                    [
                        'id' => 101,
                        'name' => 'Nordic Lounge Chair',
                        'category' => 'Sofas',
                        'price' => '₹18,400',
                        'old_price' => '₹22,000',
                        'rating' => '4.9',
                        'reviews' => 64,
                        'description' => 'Solid white-oak frame tailored with textured bouclé wool upholstery. Ergonomic low-slung comfort.',
                        'badge' => 'Bestseller',
                    ],
                    [
                        'id' => 102,
                        'name' => 'Amara Ceramic Lamp',
                        'category' => 'Lighting',
                        'price' => '₹6,800',
                        'old_price' => '₹8,500',
                        'rating' => '4.8',
                        'reviews' => 42,
                        'description' => 'Hand-turned stoneware base with speckled sand glaze and oatmeal linen shade. Warm dimmable LED.',
                        'badge' => 'New',
                    ],
                    [
                        'id' => 103,
                        'name' => 'Travertine Coffee Table',
                        'category' => 'Tables',
                        'price' => '₹24,500',
                        'old_price' => '₹29,000',
                        'rating' => '5.0',
                        'reviews' => 28,
                        'description' => 'Natural Italian travertine stone with bullnose honed edges and balanced pillar pedestal base.',
                        'badge' => 'Limited',
                    ],
                    [
                        'id' => 104,
                        'name' => 'Minimalist Stoneware Vase',
                        'category' => 'Decor',
                        'price' => '₹3,200',
                        'old_price' => '₹4,000',
                        'rating' => '4.7',
                        'reviews' => 53,
                        'description' => 'Sculptural organic silhouette designed for dry botanical arrangements and architectural centerpieces.',
                        'badge' => '',
                    ],
                ],
                'tabs' => [
                    ['id' => 'home', 'label' => 'Home', 'icon' => 'home'],
                    ['id' => 'shop', 'label' => 'Shop', 'icon' => 'grid'],
                    ['id' => 'favorites', 'label' => 'Favorites', 'icon' => 'heart'],
                    ['id' => 'cart', 'label' => 'Cart', 'icon' => 'bag'],
                    ['id' => 'account', 'label' => 'Account', 'icon' => 'user'],
                ],
                'cta_label' => 'Add to Bag',
            ],

            'vibrant-commerce' => [
                'brand_name' => 'NOVA',
                'brand_sub' => 'Streetwear & Apparel',
                'tagline' => 'High-Energy Fashion for the Fearless',
                'theme_name' => 'Vibrant Commerce',
                'category' => 'Fashion',
                'badge' => 'Bold & Energetic',
                'colors' => [
                    'primary' => '#111827',
                    'accent' => '#E11D48',
                    'bg' => '#FFFFFF',
                    'card' => '#F9FAFB',
                    'text' => '#111827',
                    'muted' => '#6B7280',
                    'border' => '#E5E7EB',
                ],
                'hero' => [
                    'title' => 'MID-SEASON DROP: 30% OFF',
                    'subtitle' => 'Limited edition apparel, oversized layers, and fresh footwear.',
                    'badge' => 'Flash Sale',
                    'cta' => 'Shop The Drop',
                ],
                'categories' => ['All', 'Women', 'Men', 'Shoes', 'Accessories'],
                'items' => [
                    [
                        'id' => 201,
                        'name' => 'Urban Leather Moto Jacket',
                        'category' => 'Women',
                        'price' => '₹5,499',
                        'old_price' => '₹7,999',
                        'rating' => '4.9',
                        'reviews' => 128,
                        'description' => 'Butter-soft genuine textured leather with polished metallic hardware and cropped oversized silhouette.',
                        'badge' => 'Trending',
                    ],
                    [
                        'id' => 202,
                        'name' => 'Streetstyle Chunky Sneakers',
                        'category' => 'Shoes',
                        'price' => '₹4,299',
                        'old_price' => '₹5,999',
                        'rating' => '4.8',
                        'reviews' => 95,
                        'description' => 'Multi-panel mesh and suede construction with shock-absorbing platform midsole and reflective heel tab.',
                        'badge' => 'Hot',
                    ],
                    [
                        'id' => 203,
                        'name' => 'Silk Slip Midi Dress',
                        'category' => 'Women',
                        'price' => '₹3,899',
                        'old_price' => '₹4,999',
                        'rating' => '4.7',
                        'reviews' => 74,
                        'description' => 'Bias-cut champagne mulberry silk with cowl neckline and adjustable cross-back straps.',
                        'badge' => 'Sale',
                    ],
                    [
                        'id' => 204,
                        'name' => 'Relaxed Tapered Indigo Denim',
                        'category' => 'Men',
                        'price' => '₹2,999',
                        'old_price' => '₹3,999',
                        'rating' => '4.6',
                        'reviews' => 88,
                        'description' => '13oz Japanese selvedge denim with vintage wash whiskers and reinforced double-needle stitching.',
                        'badge' => '',
                    ],
                ],
                'tabs' => [
                    ['id' => 'home', 'label' => 'Home', 'icon' => 'home'],
                    ['id' => 'shop', 'label' => 'Shop', 'icon' => 'search'],
                    ['id' => 'wishlist', 'label' => 'Wishlist', 'icon' => 'heart'],
                    ['id' => 'cart', 'label' => 'Cart', 'icon' => 'bag'],
                    ['id' => 'profile', 'label' => 'Profile', 'icon' => 'user'],
                ],
                'cta_label' => 'Add to Bag',
            ],

            'elegant-store' => [
                'brand_name' => 'AURA',
                'brand_sub' => 'Atelier de Luxe',
                'tagline' => 'Haute Parfumerie & Precious Adornments',
                'theme_name' => 'Elegant Store',
                'category' => 'Fashion / Lifestyle',
                'badge' => 'Editorial & Refined',
                'colors' => [
                    'primary' => '#2E282A',
                    'accent' => '#9A8262',
                    'bg' => '#F8F6F4',
                    'card' => '#FFFFFF',
                    'text' => '#2E282A',
                    'muted' => '#78716C',
                    'border' => '#DDD8D3',
                ],
                'hero' => [
                    'title' => 'Aromas & Adornments',
                    'subtitle' => 'An editorial symphony of rare amber, iris, and 18k goldsmithing.',
                    'badge' => 'Private Reserve',
                    'cta' => 'View Collection',
                ],
                'categories' => ['All', 'Fragrance', 'Fine Jewelry', 'Silk & Cashmere', 'Home Scent'],
                'items' => [
                    [
                        'id' => 301,
                        'name' => 'Golden Amber Extrait (100ml)',
                        'category' => 'Fragrance',
                        'price' => '₹14,500',
                        'old_price' => '₹16,000',
                        'rating' => '5.0',
                        'reviews' => 34,
                        'description' => 'Top notes of bergamot and saffron unfolding into bourbon vanilla, incense and aged cedar.',
                        'badge' => 'Exclusive',
                    ],
                    [
                        'id' => 302,
                        'name' => 'Rivière Solitaire Choker (18k Gold)',
                        'category' => 'Fine Jewelry',
                        'price' => '₹42,000',
                        'old_price' => '₹48,000',
                        'rating' => '4.9',
                        'reviews' => 19,
                        'description' => 'Handcrafted recycled yellow gold setting featuring bezel-set round brilliant cut lab-grown diamonds.',
                        'badge' => 'Bespoke',
                    ],
                    [
                        'id' => 303,
                        'name' => 'Hand-Rolled Mulberry Silk Scarf',
                        'category' => 'Silk & Cashmere',
                        'price' => '₹8,200',
                        'old_price' => '₹9,500',
                        'rating' => '4.8',
                        'reviews' => 41,
                        'description' => 'Botanical pigment prints onto heavyweight silk twill with artisan hand-rolled edges.',
                        'badge' => '',
                    ],
                    [
                        'id' => 304,
                        'name' => 'Smoked Santal Brass Candle',
                        'category' => 'Home Scent',
                        'price' => '₹5,400',
                        'old_price' => '₹6,200',
                        'rating' => '4.9',
                        'reviews' => 52,
                        'description' => 'Hand-poured coconut wax infused with Australian sandalwood and spiced cardamom inside cast brass vessel.',
                        'badge' => '',
                    ],
                ],
                'tabs' => [
                    ['id' => 'home', 'label' => 'Atelier', 'icon' => 'home'],
                    ['id' => 'shop', 'label' => 'Shop', 'icon' => 'grid'],
                    ['id' => 'explore', 'label' => 'Explore', 'icon' => 'search'],
                    ['id' => 'wishlist', 'label' => 'Wishlist', 'icon' => 'heart'],
                    ['id' => 'account', 'label' => 'Account', 'icon' => 'user'],
                ],
                'cta_label' => 'Reserve Piece',
            ],

            'restaurant' => [
                'brand_name' => 'CASA',
                'brand_sub' => 'Trattoria & Bar',
                'tagline' => 'Fresh. Simple. Delicious.',
                'theme_name' => 'Restaurant & Dining',
                'category' => 'Restaurant',
                'badge' => 'Food & Dining',
                'colors' => [
                    'primary' => '#831843',
                    'accent' => '#F59E0B',
                    'bg' => '#FFFBEB',
                    'card' => '#FFFFFF',
                    'text' => '#292524',
                    'muted' => '#78716C',
                    'border' => '#FDE68A',
                ],
                'hero' => [
                    'title' => 'Fresh Woodfired Pizza & Pasta',
                    'subtitle' => 'Handcrafted sourdough crusts and handmade pasta from heirloom flour.',
                    'badge' => 'Chef Table',
                    'cta' => 'Order For Pickup',
                ],
                'categories' => ['All', 'Starters', 'Mains', 'Desserts', 'Beverages'],
                'items' => [
                    [
                        'id' => 401,
                        'name' => 'Artisan Truffle Tagliatelle',
                        'category' => 'Mains',
                        'price' => '₹850',
                        'old_price' => '₹950',
                        'rating' => '4.9',
                        'reviews' => 140,
                        'description' => 'Fresh egg pasta tossed with black summer truffles, organic butter, parmigiano reggiano and thyme.',
                        'badge' => 'Chef Special',
                    ],
                    [
                        'id' => 402,
                        'name' => 'Woodfired Margherita Bufala',
                        'category' => 'Mains',
                        'price' => '₹720',
                        'old_price' => '₹800',
                        'rating' => '4.8',
                        'reviews' => 210,
                        'description' => 'San Marzano tomatoes, fresh campania buffalo mozzarella, basil leaves and extra virgin olive oil.',
                        'badge' => 'Popular',
                    ],
                    [
                        'id' => 403,
                        'name' => 'Burrata Caprese & Basil Pesto',
                        'category' => 'Starters',
                        'price' => '₹560',
                        'old_price' => '₹620',
                        'rating' => '4.9',
                        'reviews' => 88,
                        'description' => 'Creamy burrata cheese served with heirloom cherry tomatoes, cold-pressed olive oil and grilled focaccia.',
                        'badge' => '',
                    ],
                    [
                        'id' => 404,
                        'name' => 'Classic Venetian Tiramisu',
                        'category' => 'Desserts',
                        'price' => '₹390',
                        'old_price' => '₹450',
                        'rating' => '5.0',
                        'reviews' => 175,
                        'description' => 'Savoiardi ladyfingers dipped in espresso and amaretto, layered with mascarpone cream and Valrhona cocoa.',
                        'badge' => '',
                    ],
                ],
                'tabs' => [
                    ['id' => 'home', 'label' => 'Home', 'icon' => 'home'],
                    ['id' => 'menu', 'label' => 'Menu', 'icon' => 'grid'],
                    ['id' => 'search', 'label' => 'Search', 'icon' => 'search'],
                    ['id' => 'cart', 'label' => 'Order', 'icon' => 'bag'],
                    ['id' => 'profile', 'label' => 'Profile', 'icon' => 'user'],
                ],
                'cta_label' => 'Add to Order',
            ],

            'business-pro' => [
                'brand_name' => 'STUDIO',
                'brand_sub' => 'Consulting & Design',
                'tagline' => 'Digital Innovation & Enterprise Advisory',
                'theme_name' => 'Business Pro',
                'category' => 'Business',
                'badge' => 'Professional Services',
                'colors' => [
                    'primary' => '#1E293B',
                    'accent' => '#0284C7',
                    'bg' => '#F8FAFC',
                    'card' => '#FFFFFF',
                    'text' => '#1E293B',
                    'muted' => '#64748B',
                    'border' => '#E2E8F0',
                ],
                'hero' => [
                    'title' => 'Accelerate Your Digital Presence',
                    'subtitle' => 'We help modern companies design high-performing mobile and web experiences.',
                    'badge' => 'Certified Partners',
                    'cta' => 'Book Free Consultation',
                ],
                'categories' => ['All', 'Brand Strategy', 'UX Design', 'Engineering', 'Growth Marketing'],
                'items' => [
                    [
                        'id' => 501,
                        'name' => 'Brand Strategy & Identity System',
                        'category' => 'Brand Strategy',
                        'price' => '₹45,000',
                        'old_price' => '₹55,000',
                        'rating' => '5.0',
                        'reviews' => 24,
                        'description' => 'Complete brand positioning, visual design language, typographic hierarchy and logo guidelines.',
                        'badge' => 'Featured',
                    ],
                    [
                        'id' => 502,
                        'name' => 'Mobile App UX/UI Prototyping',
                        'category' => 'UX Design',
                        'price' => '₹65,000',
                        'old_price' => '₹75,000',
                        'rating' => '4.9',
                        'reviews' => 38,
                        'description' => 'Figma design tokens, user persona journey mapping, 60+ interactive screens, and developer handoff.',
                        'badge' => 'Popular',
                    ],
                    [
                        'id' => 503,
                        'name' => 'Custom API & Application Build',
                        'category' => 'Engineering',
                        'price' => '₹95,000',
                        'old_price' => '₹1,20,000',
                        'rating' => '5.0',
                        'reviews' => 19,
                        'description' => 'Native iOS and Android application build with high-throughput backend APIs and database indexing.',
                        'badge' => 'Enterprise',
                    ],
                    [
                        'id' => 504,
                        'name' => 'Growth & Conversion Optimization',
                        'category' => 'Growth Marketing',
                        'price' => '₹38,000',
                        'old_price' => '₹45,000',
                        'rating' => '4.8',
                        'reviews' => 45,
                        'description' => 'Multi-channel acquisition funnels, retention notifications, analytics setup and conversion rate audit.',
                        'badge' => '',
                    ],
                ],
                'tabs' => [
                    ['id' => 'home', 'label' => 'Home', 'icon' => 'home'],
                    ['id' => 'services', 'label' => 'Services', 'icon' => 'grid'],
                    ['id' => 'projects', 'label' => 'Projects', 'icon' => 'search'],
                    ['id' => 'insights', 'label' => 'Insights', 'icon' => 'heart'],
                    ['id' => 'profile', 'label' => 'Profile', 'icon' => 'user'],
                ],
                'cta_label' => 'Book Consultation',
            ]
        ];

        // Aliases for Minimal, Modern, Trendy
        $configs['minimal'] = $configs['modern-minimalist'];
        $configs['minimal']['theme_name'] = 'Minimal';
        $configs['minimal']['category'] = 'Minimal';
        $configs['minimal']['badge'] = 'Minimal Style';

        $configs['modern'] = $configs['elegant-store'];
        $configs['modern']['theme_name'] = 'Modern';
        $configs['modern']['category'] = 'Modern';
        $configs['modern']['badge'] = 'Modern Style';

        $configs['trendy'] = $configs['vibrant-commerce'];
        $configs['trendy']['theme_name'] = 'Trendy';
        $configs['trendy']['category'] = 'Trendy';
        $configs['trendy']['badge'] = 'Trendy Style';

        $aliasMap = [
            'minimal' => 'minimal',
            'modern-minimalist' => 'minimal',
            'modern' => 'modern',
            'elegant-store' => 'modern',
            'trendy' => 'trendy',
            'vibrant-commerce' => 'trendy',
        ];

        $targetSlug = $aliasMap[$slug] ?? $slug;

        return $configs[$targetSlug] ?? $configs[$slug] ?? $configs['minimal'];
    }
}