<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class PlatformConfig extends Model
{
    protected string $table = 'platform_configs';
    protected array $fillable = [
        'key',
        'name',
        'subtitle',
        'badge',
        'description',
        'setup_time',
        'api_type',
        'required_fields',
        'api_scopes',
        'setup_steps',
        'validation_rules',
        'compatibility_rules',
        'is_active',
        'sort_order',
    ];

    /**
     * Get all active platform configurations ordered by sort_order.
     */
    public function getAllActive(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($rows)) {
                return array_map([$this, 'formatPlatformRow'], $rows);
            }
        } catch (\Throwable $e) {
            // Log or ignore and return defaults
        }

        return $this->getDefaultPlatforms();
    }

    /**
     * Get single platform by key.
     */
    public function getByKey(string $key): ?array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE `key` = :key LIMIT 1");
            $stmt->execute(['key' => $key]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $this->formatPlatformRow($row);
            }
        } catch (\Throwable $e) {
            // Ignore and check defaults
        }

        $defaults = $this->getDefaultPlatforms();
        foreach ($defaults as $p) {
            if ($p['key'] === $key) {
                return $p;
            }
        }

        return null;
    }

    /**
     * Update a platform config by key.
     */
    public function updateByKey(string $key, array $data): bool
    {
        $platform = $this->getByKey($key);
        if (!$platform || empty($platform['id'])) {
            return false;
        }

        if (isset($data['required_fields']) && is_array($data['required_fields'])) {
            $data['required_fields'] = json_encode($data['required_fields']);
        }
        if (isset($data['api_scopes']) && is_array($data['api_scopes'])) {
            $data['api_scopes'] = json_encode($data['api_scopes']);
        }
        if (isset($data['setup_steps']) && is_array($data['setup_steps'])) {
            $data['setup_steps'] = json_encode($data['setup_steps']);
        }

        return $this->update((int)$platform['id'], $data);
    }

    /**
     * Parse JSON fields into PHP arrays.
     */
    private function formatPlatformRow(array $row): array
    {
        $jsonFields = ['required_fields', 'api_scopes', 'setup_steps', 'validation_rules', 'compatibility_rules'];
        foreach ($jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $decoded = json_decode($row[$field], true);
                $row[$field] = is_array($decoded) ? $decoded : [];
            } elseif (!isset($row[$field])) {
                $row[$field] = [];
            }
        }
        return $row;
    }

    /**
     * Fallback configuration if DB is offline or empty.
     */
    public function getDefaultPlatforms(): array
    {
        return [
            [
                'id' => 1,
                'key' => 'wordpress',
                'name' => 'WordPress',
                'subtitle' => 'REST API / Application Password',
                'badge' => 'Native Sync',
                'description' => 'To connect your WordPress website with AppifyHub, you need to enable API access and create an Application Password.',
                'setup_time' => '2–5 minutes',
                'api_type' => 'WordPress REST API',
                'required_fields' => [
                    [
                        'name' => 'url',
                        'label' => 'Website URL',
                        'type' => 'url',
                        'placeholder' => 'https://yourwebsite.com',
                        'required' => true,
                        'help' => 'Must use HTTPS with a valid SSL certificate.'
                    ],
                    [
                        'name' => 'username',
                        'label' => 'Administrator Username',
                        'type' => 'text',
                        'placeholder' => 'admin',
                        'required' => true,
                        'help' => 'The WordPress user must possess administrator-level permissions.'
                    ],
                    [
                        'name' => 'application_password',
                        'label' => 'Application Password',
                        'type' => 'password',
                        'placeholder' => 'xxxx xxxx xxxx xxxx',
                        'required' => true,
                        'sensitive' => true,
                        'help' => 'Generated unique application password (different from your regular account password).'
                    ]
                ],
                'api_scopes' => ['Posts', 'Pages', 'Media', 'Users', 'Taxonomies'],
                'setup_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Log in to WordPress',
                        'instruction' => 'Open your WordPress administrative dashboard. Ensure you log in with an administrator account.',
                        'example' => 'https://yourwebsite.com/wp-admin',
                        'where_to_find' => 'Where to find this → Open your browser and navigate to your website\'s /wp-admin login page.',
                        'screenshot' => 'api-guides/wordpress/step-01-login.svg'
                    ],
                    [
                        'step' => 2,
                        'title' => 'Open Your User Profile',
                        'instruction' => 'From the WordPress dashboard left sidebar, navigate to Users → Profile (or Users → Your Profile depending on your WordPress version).',
                        'example' => 'WordPress Dashboard → Users → Profile',
                        'where_to_find' => 'Where to find this → Left-hand navigation menu under the "Users" heading.',
                        'screenshot' => 'api-guides/wordpress/step-02-profile.svg'
                    ],
                    [
                        'step' => 3,
                        'title' => 'Find Application Passwords',
                        'instruction' => 'Scroll down to the "Application Passwords" section. Note that Application Passwords allow secure external authentication without exposing your normal account password.',
                        'example' => 'Section: Application Passwords',
                        'where_to_find' => 'Where to find this → Scroll down past the Name, Contact Info, and About Yourself sections to Application Passwords.',
                        'screenshot' => 'api-guides/wordpress/step-03-application-password.svg'
                    ],
                    [
                        'step' => 4,
                        'title' => 'Create an Application Password',
                        'instruction' => 'Enter "AppifyHub" into the "New Application Password Name" field and click the "Add New Application Password" button.',
                        'example' => 'Application Name: AppifyHub',
                        'where_to_find' => 'Where to find this → Type "AppifyHub" into the text input and click the blue button.',
                        'screenshot' => 'api-guides/wordpress/step-04-create-password.svg'
                    ],
                    [
                        'step' => 5,
                        'title' => 'Copy the Generated Credentials',
                        'instruction' => 'Copy the 16-character generated application password immediately. WordPress will only display this password once.',
                        'example' => 'Format: abcd efgh ijkl mnop',
                        'where_to_find' => 'Where to find this → Highlight and copy the highlighted password in the green notice banner.',
                        'screenshot' => 'api-guides/wordpress/step-04-create-password.svg'
                    ]
                ],
                'sort_order' => 1
            ],
            [
                'id' => 2,
                'key' => 'woocommerce',
                'name' => 'WooCommerce',
                'subtitle' => 'REST API',
                'badge' => 'Store Engine',
                'description' => 'Connect your WooCommerce store using its REST API so AppifyHub can securely access the required store data.',
                'setup_time' => '3–5 minutes',
                'api_type' => 'WooCommerce REST API v3',
                'required_fields' => [
                    [
                        'name' => 'url',
                        'label' => 'Store URL',
                        'type' => 'url',
                        'placeholder' => 'https://yourstore.com',
                        'required' => true,
                        'help' => 'Your WooCommerce storefront URL.'
                    ],
                    [
                        'name' => 'consumer_key',
                        'label' => 'Consumer Key',
                        'type' => 'text',
                        'placeholder' => 'ck_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                        'required' => true,
                        'help' => 'Starts with ck_.'
                    ],
                    [
                        'name' => 'consumer_secret',
                        'label' => 'Consumer Secret',
                        'type' => 'password',
                        'placeholder' => 'cs_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                        'required' => true,
                        'sensitive' => true,
                        'help' => 'Starts with cs_. Treat your Consumer Secret as sensitive information.'
                    ]
                ],
                'api_scopes' => ['Products', 'Orders', 'Customers', 'Coupons', 'Categories'],
                'setup_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Open WordPress Admin',
                        'instruction' => 'Log in to your WordPress administrative dashboard where WooCommerce is installed.',
                        'example' => 'https://yourstore.com/wp-admin',
                        'where_to_find' => 'Where to find this → Enter your store admin URL in your browser.',
                        'screenshot' => 'api-guides/woocommerce/step-01-login.svg'
                    ],
                    [
                        'step' => 2,
                        'title' => 'Open WooCommerce Settings',
                        'instruction' => 'In the left sidebar, click WooCommerce → Settings. Next, click on the "Advanced" tab at the top right of the settings tabs, then select "REST API".',
                        'example' => 'WooCommerce → Settings → Advanced → REST API',
                        'where_to_find' => 'Where to find this → Left sidebar: WooCommerce > Settings, then top tab "Advanced", sub-link "REST API".',
                        'screenshot' => 'api-guides/woocommerce/step-02-settings.svg'
                    ],
                    [
                        'step' => 3,
                        'title' => 'Add API Key',
                        'instruction' => 'Click the "Add key" or "Create an API key" button. Set the Description to "AppifyHub", select an administrator or store manager user, and set Permissions to "Read/Write".',
                        'example' => 'Description: AppifyHub | Permissions: Read/Write',
                        'where_to_find' => 'Where to find this → Blue "Add key" button in the REST API list.',
                        'screenshot' => 'api-guides/woocommerce/step-03-rest-api.svg'
                    ],
                    [
                        'step' => 4,
                        'title' => 'Generate API Credentials',
                        'instruction' => 'Click "Generate API key". WooCommerce will display your Consumer Key and Consumer Secret. Copy both values now before leaving the page.',
                        'example' => 'ck_... (Consumer Key) & cs_... (Consumer Secret)',
                        'where_to_find' => 'Where to find this → Key details page displayed immediately after creation.',
                        'screenshot' => 'api-guides/woocommerce/step-04-create-key.svg'
                    ]
                ],
                'sort_order' => 2
            ],
            [
                'id' => 3,
                'key' => 'shopify',
                'name' => 'Shopify',
                'subtitle' => 'Storefront / Admin API',
                'badge' => 'Direct Connect',
                'description' => 'Connect your Shopify store using Shopify\'s supported APIs and the permissions required by AppifyHub.',
                'setup_time' => '5–10 minutes',
                'api_type' => 'Shopify Admin API',
                'required_fields' => [
                    [
                        'name' => 'url',
                        'label' => 'Shopify Store URL',
                        'type' => 'url',
                        'placeholder' => 'https://your-store.myshopify.com',
                        'required' => true,
                        'help' => 'Your .myshopify.com domain or custom storefront URL.'
                    ],
                    [
                        'name' => 'access_token',
                        'label' => 'Admin API Access Token',
                        'type' => 'password',
                        'placeholder' => 'shpat_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                        'required' => true,
                        'sensitive' => true,
                        'help' => 'Starts with shpat_. Generated in your Shopify custom app.'
                    ]
                ],
                'api_scopes' => ['Products', 'Orders', 'Customers', 'Store data'],
                'setup_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Open Shopify Admin',
                        'instruction' => 'Log in to your Shopify administrative dashboard as a store owner or staff member with app development permissions.',
                        'example' => 'https://admin.shopify.com/store/your-store',
                        'where_to_find' => 'Where to find this → Log in at admin.shopify.com or your myshopify.com address.',
                        'screenshot' => 'api-guides/shopify/step-01-admin.svg'
                    ],
                    [
                        'step' => 2,
                        'title' => 'Open Apps / App Development',
                        'instruction' => 'Open your Shopify admin and navigate to the area where custom/development apps are managed (Settings → Apps and sales channels → Develop apps).',
                        'example' => 'Settings → Apps and sales channels → Develop apps',
                        'where_to_find' => 'Where to find this → Bottom left "Settings" gear, then "Apps and sales channels", then click "Develop apps".',
                        'screenshot' => 'api-guides/shopify/step-02-app-development.svg'
                    ],
                    [
                        'step' => 3,
                        'title' => 'Create or Select the App',
                        'instruction' => 'Click "Create an app". Enter "AppifyHub Integration" as the App name and assign your store administrator as the App developer.',
                        'example' => 'App Name: AppifyHub Integration',
                        'where_to_find' => 'Where to find this → Green "Create an app" button at the top right of the App Development page.',
                        'screenshot' => 'api-guides/shopify/step-03-api-access.svg'
                    ],
                    [
                        'step' => 4,
                        'title' => 'Configure API Access & Install App',
                        'instruction' => 'Under Configuration → Admin API integration, grant only the required permissions: Products (read), Orders (read), Customers (read), Store content (read). Save and click "Install app".',
                        'example' => 'Scopes: read_products, read_orders, read_customers, read_content',
                        'where_to_find' => 'Where to find this → "Configuration" tab, Admin API access scopes, then "Install app".',
                        'screenshot' => 'api-guides/shopify/step-03-api-access.svg'
                    ],
                    [
                        'step' => 5,
                        'title' => 'Generate & Copy Access Token',
                        'instruction' => 'Click "Reveal token once" under API credentials to copy your Admin API access token (starts with shpat_). Note: Shopify displays this token only once.',
                        'example' => 'shpat_... (Admin API access token)',
                        'where_to_find' => 'Where to find this → Under "API credentials" section after installing the app.',
                        'screenshot' => 'api-guides/shopify/step-04-token.svg'
                    ]
                ],
                'sort_order' => 3
            ]
        ];
    }
}
