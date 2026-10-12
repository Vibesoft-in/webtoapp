<?php
/**
 * AppifyHub - Interactive Mobile App Theme Showcase & Live Simulation
 * Complete one-time phone composition that responds dynamically to all user clicks!
 */
$slug = $theme['slug'];
$brand = $demoData['brand_name'];
$colors = $demoData['colors'];
$items = $demoData['items'] ?? [];
$categories = $demoData['categories'] ?? ['All'];
$tabs = $demoData['tabs'] ?? [
    ['id' => 'home', 'label' => 'Home', 'icon' => 'home'],
    ['id' => 'shop', 'label' => 'Shop', 'icon' => 'grid'],
    ['id' => 'favorites', 'label' => 'Favorites', 'icon' => 'heart'],
    ['id' => 'cart', 'label' => 'Cart', 'icon' => 'bag'],
    ['id' => 'account', 'label' => 'Account', 'icon' => 'user']
];
?>
<div class="theme-showcase-page" style="--app-primary: <?= e($colors['primary']) ?>; --app-accent: <?= e($colors['accent']) ?>; --app-bg: <?= e($colors['bg']) ?>; --app-card: <?= e($colors['card']) ?>; --app-text: <?= e($colors['text']) ?>; --app-muted: <?= e($colors['muted']) ?>; --app-border: <?= e($colors['border']) ?>;">

    <div class="theme-showcase-container">

        <!-- LEFT: THEME SPECIFICATION & ACTION PANEL (SCROLLABLE) -->
        <aside class="theme-info-panel" id="themeInfoPanel">
            <a href="<?= url('/themes') ?>" class="btn-back-themes">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Back to Themes</span>
            </a>

            <div class="theme-header-block">
                <div class="theme-category-pill"><?= strtoupper(e($theme['category'])) ?></div>
                <h1 class="theme-title"><?= e($theme['name']) ?></h1>
                <p class="theme-desc"><?= e($theme['description']) ?></p>
            </div>

            <div class="theme-capabilities-block">
                <h4 class="capabilities-title">INCLUDED THEME CAPABILITIES</h4>
                <ul class="capabilities-list">
                    <?php 
                    $capabilities = [
                        'Clean Navigation',
                        'Hero Product Display',
                        'Product Categories',
                        'Product Search',
                        'Product Details',
                        'Cart & Checkout',
                        'Wishlist'
                    ];
                    if (!empty($theme['parsed_features']) && is_array($theme['parsed_features'])) {
                        $capabilities = array_slice($theme['parsed_features'], 0, 7);
                    }
                    ?>
                    <?php foreach ($capabilities as $cap): ?>
                        <li>
                            <span class="cap-check">&check;</span>
                            <span><?= e($cap) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Native Architecture & Sync Checklist -->
            <div class="theme-capabilities-block" style="border-bottom:none;margin-bottom:0.75rem;">
                <h4 class="capabilities-title">NATIVE SPECIFICATIONS</h4>
                <ul class="capabilities-list">
                    <li><span class="cap-check">&check;</span><span>Real-Time Two-Way REST API Bridge</span></li>
                    <li><span class="cap-check">&check;</span><span>SSL Encrypted Checkout (Apple Pay &amp; Google Pay)</span></li>
                    <li><span class="cap-check">&check;</span><span>Automated Push Notifications &amp; Alerts</span></li>
                    <li><span class="cap-check">&check;</span><span>Offline Cache Engine with Instant Image CDN</span></li>
                    <li><span class="cap-check">&check;</span><span>Direct App Store &amp; Google Play Binary Submission</span></li>
                </ul>
            </div>

            <!-- Interactivity Help Hint -->
            <div style="background:#EFEAE7;border-left:3px solid #4E522C;padding:0.6rem 0.8rem;border-radius:6px;font-size:0.75rem;color:#403A32;line-height:1.45;margin-bottom:1rem;">
                <strong>Interactive Demo:</strong> Tap anywhere inside the phone screen to test the live app experience &mdash; switch tabs, filter categories, add items to cart, or toggle dark mode!
            </div>

            <div class="theme-action-box">
                <div class="theme-price-display">
                    <span class="price-label">Price:</span>
                    <strong class="price-value"><?= e($theme['formatted_price']) ?></strong>
                </div>

                <form id="themeSelectForm" action="<?= url('/themes/select') ?>" method="POST" class="theme-select-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="theme_id" value="<?= e($theme['id']) ?>">
                    <button type="submit" id="btnSelectThemeAction" class="btn-select-theme-primary">
                        <span>Select This Theme &rarr;</span>
                    </button>
                </form>

                <div class="theme-switch-inline" style="margin-top:1.2rem;">
                    <label class="switch-inline-label" style="display:block;margin-bottom:0.4rem;font-size:0.75rem;font-weight:700;color:#403A32;text-transform:uppercase;letter-spacing:0.05em;">
                        Switch Theme Preview:
                    </label>
                    <div class="theme-switch-grid-cards">
                        <?php foreach ($allThemes as $t): ?>
                            <?php 
                            $isCurrent = ($t['slug'] === $slug);
                            $tEmoji = match($t['slug']) {
                                'modern-minimalist' => '🛋️',
                                'vibrant-commerce' => '👟',
                                'elegant-store' => '💎',
                                'restaurant' => '🍕',
                                'business-pro' => '📊',
                                default => '🛍️'
                            };
                            ?>
                            <a href="<?= url('/themes/' . e($t['slug']) . '/demo') ?>" class="theme-switch-card-item <?= $isCurrent ? 'is-current' : '' ?>" title="Preview <?= e($t['name']) ?>">
                                <span class="switch-card-emoji"><?= $tEmoji ?></span>
                                <div class="switch-card-text">
                                    <span class="switch-card-name"><?= e($t['name']) ?></span>
                                    <span class="switch-card-cat"><?= ucfirst(e($t['category'])) ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </aside>

        <!-- RIGHT: COMPLETE PHONE PREVIEW (STICKY IN VIEWPORT) -->
        <main class="theme-preview-stage" id="themePreviewStage">
            <div class="preview-stage-header">
                <span class="preview-badge-pill">
                    <span class="pulse-dot"></span>
                    <span>LIVE SIMULATION &bull; TAP TO INTERACT</span>
                </span>
                <span class="preview-aspect-hint"><?= e($demoData['badge'] ?? '100% Native Architecture') ?></span>
            </div>

            <!-- Scaled Smartphone Frame (fits within browser viewport without scrolling) -->
            <div class="showcase-smartphone-frame">
                <!-- Physical Bezel Hardware -->
                <div class="phone-speaker-bar"></div>
                <div class="phone-island-pill">
                    <span class="island-camera"></span>
                </div>

                <!-- Interactive Visual Screen Canvas -->
                <div class="showcase-screen-canvas" id="demoPhoneCanvas">
                    
                    <!-- Dynamic Island Toast Notification Banner -->
                    <div class="app-mock-toast" id="demoPhoneToast">
                        <span class="app-mock-toast-dot"></span>
                        <span id="demoPhoneToastText">Added to Bag ✓</span>
                    </div>

                    <!-- 1. Top Status Bar -->
                    <div class="app-mock-status-bar">
                        <span class="status-time" id="demoClockTime">9:41</span>
                        <div class="status-icons">
                            <span class="status-signal">&#9679;&#9679;&#9679;&#9679;</span>
                            <span class="status-wifi">&#9650;</span>
                            <span class="status-battery">100% &#128267;</span>
                        </div>
                    </div>

                    <!-- 2. App Brand Header with Interactive Search & Cart -->
                    <header class="app-mock-header">
                        <div class="app-mock-brand" style="cursor:pointer;" onclick="switchAppTab('home')" title="Go to Home">
                            <h3 class="mock-brand-name"><?= e($demoData['brand_name']) ?></h3>
                            <span class="mock-brand-sub"><?= e($demoData['brand_sub']) ?></span>
                        </div>
                        <div class="app-mock-header-icons">
                            <button type="button" class="mock-icon-btn" id="btnToggleSearch" title="Search items" onclick="toggleSearchInput()">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </button>
                            <button type="button" class="mock-icon-btn mock-cart-wrap" id="btnHeaderCart" title="View Cart" onclick="switchAppTab('cart')">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                <span class="mock-cart-badge" id="demoHeaderCartCount">2</span>
                            </button>
                        </div>
                    </header>

                    <!-- Interactive Quick In-App Search Bar (Collapsible) -->
                    <div class="app-mock-search-bar" id="demoSearchBar">
                        <input type="text" id="demoSearchInput" class="app-mock-search-input" placeholder="Search <?= e($demoData['brand_name']) ?> products..." oninput="handleSearchFilter(this.value)">
                        <span class="app-mock-search-close" onclick="toggleSearchInput(false)" title="Close Search">&times;</span>
                    </div>

                    <!-- Interactive Body Views Container -->
                    <div class="app-mock-body-views">

                        <!-- VIEW 1: HOME (Default View) -->
                        <div class="app-mock-view is-active" id="view-home">
                            
                            <!-- Hero Showcase Banner -->
                            <div class="app-mock-hero-banner" onclick="switchAppTab('shop')" title="Click to explore collection">
                                <span class="mock-hero-badge"><?= e($demoData['hero']['badge']) ?></span>
                                <h4 class="mock-hero-title"><?= e($demoData['hero']['title']) ?></h4>
                                <p class="mock-hero-subtitle"><?= e($demoData['hero']['subtitle']) ?></p>
                                <span class="mock-hero-btn"><?= e($demoData['hero']['cta']) ?> &rarr;</span>
                            </div>

                            <!-- Category Chips Row (Interactive Filter) -->
                            <div class="app-mock-categories">
                                <span class="mock-section-label">Categories (Tap to filter)</span>
                                <div class="mock-category-chips">
                                    <?php foreach ($categories as $idx => $cat): ?>
                                        <span class="mock-cat-chip <?= $idx === 0 ? 'is-active' : '' ?>" data-category="<?= strtolower(e($cat)) ?>" onclick="filterAppCategory(this, '<?= strtolower(e($cat)) ?>')">
                                            <?= e($cat) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Featured Products Grid (2 compact interactive cards) -->
                            <div class="app-mock-products-section">
                                <div class="mock-products-header">
                                    <span class="mock-section-label">Featured Products</span>
                                    <span class="mock-see-all" style="cursor:pointer;" onclick="switchAppTab('shop')">See All &rarr;</span>
                                </div>
                                <div class="mock-products-grid" id="homeProductsGrid">
                                    <?php 
                                    $sampleItems = array_slice($items, 0, 2);
                                    foreach ($sampleItems as $item): 
                                        $icon = match($slug) {
                                            'modern-minimalist' => '🛋️',
                                            'vibrant-commerce' => '👟',
                                            'elegant-store' => '💎',
                                            'restaurant' => '🍕',
                                            'business-pro' => '📊',
                                            default => '🛍️'
                                        };
                                    ?>
                                        <div class="mock-product-card" data-category="<?= strtolower(e($item['category'])) ?>" data-name="<?= strtolower(e($item['name'])) ?>" onclick="openProductSheet(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>, '<?= $icon ?>')">
                                            <div class="mock-card-media">
                                                <?php if (!empty($item['badge'])): ?>
                                                    <span class="mock-item-badge"><?= e($item['badge']) ?></span>
                                                <?php endif; ?>
                                                <div class="mock-item-artwork">
                                                    <span class="artwork-emoji"><?= $icon ?></span>
                                                </div>
                                            </div>
                                            <div class="mock-card-info">
                                                <div class="mock-card-meta">
                                                    <span class="mock-cat-sub"><?= e($item['category']) ?></span>
                                                    <span class="mock-rating">&#9733; <?= e($item['rating']) ?></span>
                                                </div>
                                                <h6 class="mock-item-name"><?= e($item['name']) ?></h6>
                                                <div class="mock-card-price-row">
                                                    <div class="mock-prices">
                                                        <span class="mock-curr-price"><?= e($item['price']) ?></span>
                                                        <?php if (!empty($item['old_price'])): ?>
                                                            <span class="mock-old-price"><?= e($item['old_price']) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span class="mock-add-btn" title="Add to Bag" onclick="event.stopPropagation(); addItemToCart('<?= addslashes(e($item['name'])) ?>', '<?= addslashes(e($item['price'])) ?>', '<?= $icon ?>', this);">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Offer / Promotion Strip -->
                            <div class="app-mock-offer-strip" onclick="applyPromoCode()" title="Tap to apply code">
                                <span class="offer-icon">&#9889;</span>
                                <span class="offer-text">Special Collection &bull; Tap to Apply 10% Off</span>
                            </div>
                        </div>

                        <!-- VIEW 2: SHOP / CATALOG -->
                        <div class="app-mock-view" id="view-shop">
                            <div style="padding:0.4rem 0.65rem 0.2rem;display:flex;justify-content:space-between;align-items:center;">
                                <span class="mock-section-label" style="margin:0;">All Products (<?= count($items) ?>)</span>
                                <span style="font-size:0.5rem;color:var(--app-muted);">&#9881; Filtered</span>
                            </div>

                            <!-- Shop Category Chips -->
                            <div class="app-mock-categories" style="padding-top:0.1rem;">
                                <div class="mock-category-chips">
                                    <?php foreach ($categories as $idx => $cat): ?>
                                        <span class="mock-cat-chip <?= $idx === 0 ? 'is-active' : '' ?>" data-category="<?= strtolower(e($cat)) ?>" onclick="filterAppCategory(this, '<?= strtolower(e($cat)) ?>', true)">
                                            <?= e($cat) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Full Products Grid -->
                            <div class="app-mock-products-section" style="padding-top:0.2rem;">
                                <div class="mock-products-grid" id="shopProductsGrid">
                                    <?php foreach ($items as $item): 
                                        $icon = match($slug) {
                                            'modern-minimalist' => '🛋️',
                                            'vibrant-commerce' => '👟',
                                            'elegant-store' => '💎',
                                            'restaurant' => '🍕',
                                            'business-pro' => '📊',
                                            default => '🛍️'
                                        };
                                    ?>
                                        <div class="mock-product-card" data-category="<?= strtolower(e($item['category'])) ?>" data-name="<?= strtolower(e($item['name'])) ?>" onclick="openProductSheet(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>, '<?= $icon ?>')">
                                            <div class="mock-card-media">
                                                <?php if (!empty($item['badge'])): ?>
                                                    <span class="mock-item-badge"><?= e($item['badge']) ?></span>
                                                <?php endif; ?>
                                                <div class="mock-item-artwork">
                                                    <span class="artwork-emoji"><?= $icon ?></span>
                                                </div>
                                            </div>
                                            <div class="mock-card-info">
                                                <div class="mock-card-meta">
                                                    <span class="mock-cat-sub"><?= e($item['category']) ?></span>
                                                    <span class="mock-rating">&#9733; <?= e($item['rating']) ?></span>
                                                </div>
                                                <h6 class="mock-item-name"><?= e($item['name']) ?></h6>
                                                <div class="mock-card-price-row">
                                                    <div class="mock-prices">
                                                        <span class="mock-curr-price"><?= e($item['price']) ?></span>
                                                        <?php if (!empty($item['old_price'])): ?>
                                                            <span class="mock-old-price"><?= e($item['old_price']) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span class="mock-add-btn" title="Add to Bag" onclick="event.stopPropagation(); addItemToCart('<?= addslashes(e($item['name'])) ?>', '<?= addslashes(e($item['price'])) ?>', '<?= $icon ?>', this);">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- VIEW 3: FAVORITES / WISHLIST -->
                        <div class="app-mock-view" id="view-favorites">
                            <div style="padding:0.4rem 0.65rem 0.2rem;display:flex;justify-content:space-between;align-items:center;">
                                <span class="mock-section-label" style="margin:0;">Wishlist &amp; Saved ❤️</span>
                                <span style="font-size:0.5rem;color:var(--app-muted);">2 Items</span>
                            </div>
                            <div style="padding:0.3rem 0.65rem;display:flex;flex-direction:column;gap:0.35rem;">
                                <?php 
                                $favItems = array_slice($items, 0, 2);
                                foreach ($favItems as $item): 
                                    $icon = match($slug) {
                                        'modern-minimalist' => '🛋️',
                                        'vibrant-commerce' => '👟',
                                        'elegant-store' => '💎',
                                        'restaurant' => '🍕',
                                        'business-pro' => '📊',
                                        default => '🛍️'
                                    };
                                ?>
                                    <div class="app-cart-item">
                                        <div class="app-cart-item-art"><?= $icon ?></div>
                                        <div class="app-cart-item-details">
                                            <h6 class="app-cart-item-name"><?= e($item['name']) ?></h6>
                                            <span class="app-cart-item-price"><?= e($item['price']) ?></span>
                                        </div>
                                        <button type="button" class="sheet-btn-add" style="padding:0.25rem 0.5rem;font-size:0.5rem;" onclick="addItemToCart('<?= addslashes(e($item['name'])) ?>', '<?= addslashes(e($item['price'])) ?>', '<?= $icon ?>'); showToast('Moved to Bag ✓');">
                                            + Bag
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- VIEW 4: CART / ORDERS -->
                        <div class="app-mock-view" id="view-cart">
                            <div class="app-cart-view">
                                <div class="app-cart-header">
                                    <h4 class="app-cart-title">Your Bag (<span id="cartViewCount">2</span>)</h4>
                                    <span style="font-size:0.48rem;color:#10B981;font-weight:700;">🚚 Free Shipping</span>
                                </div>

                                <div class="app-cart-items-container" id="cartItemsList" style="display:flex;flex-direction:column;gap:0.35rem;">
                                    <?php 
                                    $initialCart = array_slice($items, 0, 2);
                                    foreach ($initialCart as $cIdx => $cItem): 
                                        $icon = match($slug) {
                                            'modern-minimalist' => '🛋️',
                                            'vibrant-commerce' => '👟',
                                            'elegant-store' => '💎',
                                            'restaurant' => '🍕',
                                            'business-pro' => '📊',
                                            default => '🛍️'
                                        };
                                    ?>
                                        <div class="app-cart-item" data-id="<?= $cIdx ?>">
                                            <div class="app-cart-item-art"><?= $icon ?></div>
                                            <div class="app-cart-item-details">
                                                <h6 class="app-cart-item-name"><?= e($cItem['name']) ?></h6>
                                                <span class="app-cart-item-price"><?= e($cItem['price']) ?></span>
                                            </div>
                                            <div class="app-cart-qty-ctrl">
                                                <button type="button" class="cart-qty-btn" onclick="updateItemQty(this, -1)">&minus;</button>
                                                <span class="cart-qty-val">1</span>
                                                <button type="button" class="cart-qty-btn" onclick="updateItemQty(this, 1)">+</button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="app-cart-summary">
                                    <div class="cart-sum-row">
                                        <span>Subtotal</span>
                                        <strong id="cartSubtotalVal"><?= e($initialCart[0]['price'] ?? '₹18,400') ?></strong>
                                    </div>
                                    <div class="cart-sum-row">
                                        <span>Shipping</span>
                                        <span style="color:#10B981;font-weight:700;">FREE</span>
                                    </div>
                                    <div class="cart-sum-row total">
                                        <span>Total</span>
                                        <strong id="cartTotalVal"><?= e($initialCart[0]['price'] ?? '₹18,400') ?></strong>
                                    </div>

                                    <button type="button" class="btn-mock-checkout" onclick="performMockCheckout()">
                                        Proceed to Native Checkout &rarr;
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- VIEW 5: PROFILE / ACCOUNT -->
                        <div class="app-mock-view" id="view-profile">
                            <div class="app-profile-view">
                                <div class="profile-card">
                                    <div class="profile-avatar">AM</div>
                                    <div class="profile-info">
                                        <h5>Alex Morgan</h5>
                                        <span>Prime Member &bull; Connected</span>
                                    </div>
                                </div>

                                <div class="profile-options-list">
                                    <div class="profile-opt-row" onclick="showToast('Viewing Order History')">
                                        <span>📦 My Orders</span>
                                        <span style="font-weight:700;color:var(--app-muted);">&rarr;</span>
                                    </div>
                                    <div class="profile-opt-row" onclick="showToast('Saved Addresses synced')">
                                        <span>📍 Saved Addresses</span>
                                        <span style="font-weight:700;color:var(--app-muted);">&rarr;</span>
                                    </div>
                                    <div class="profile-opt-row">
                                        <span>🌙 Dark Mode Preview</span>
                                        <div class="profile-switch" id="toggleDarkModeSwitch" onclick="togglePhoneDarkMode()">
                                            <span class="profile-switch-handle"></span>
                                        </div>
                                    </div>
                                    <div class="profile-opt-row">
                                        <span>🔔 Push Notifications</span>
                                        <div class="profile-switch is-on" onclick="this.classList.toggle('is-on'); showToast(this.classList.contains('is-on') ? 'Notifications Enabled' : 'Notifications Paused');">
                                            <span class="profile-switch-handle"></span>
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align:center;padding:0.4rem;background:var(--app-card);border:1px solid var(--app-border);border-radius:8px;">
                                    <span style="font-size:0.5rem;font-weight:700;color:#4E522C;">100% Native Architecture</span>
                                    <p style="font-size:0.45rem;color:var(--app-muted);margin:2px 0 0;">Swift &bull; Kotlin &bull; WooCommerce / Shopify API Bridge</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Native Bottom Sheet Modal (Product Details) -->
                    <div class="app-mock-sheet-backdrop" id="demoProductSheetBackdrop" onclick="if(event.target === this) closeProductSheet()">
                        <div class="app-mock-sheet">
                            <div class="sheet-drag-handle"></div>
                            <div class="sheet-header-row">
                                <h4 class="sheet-title" id="sheetItemTitle">Product Title</h4>
                                <button type="button" class="sheet-close-btn" onclick="closeProductSheet()">&times;</button>
                            </div>
                            <div class="sheet-artwork" id="sheetItemArtwork">🛍️</div>
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <span id="sheetItemCategory" style="font-size:0.48rem;font-weight:700;color:var(--app-accent);text-transform:uppercase;">Category</span>
                                <span id="sheetItemRating" style="font-size:0.5rem;font-weight:700;color:#F59E0B;">★ 4.9 (64 reviews)</span>
                            </div>
                            <p class="sheet-desc" id="sheetItemDesc">Full product description.</p>
                            <div class="sheet-price-row">
                                <strong id="sheetItemPrice" style="font-size:0.75rem;font-weight:700;color:var(--app-primary);">₹0</strong>
                                <button type="button" class="sheet-btn-add" id="sheetBtnAddToCart">Add to Bag &rarr;</button>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Interactive Bottom Navigation Bar -->
                    <nav class="app-mock-bottom-nav">
                        <?php 
                        foreach ($tabs as $idx => $tab): 
                            $isActive = ($idx === 0);
                            $tabId = strtolower($tab['id'] ?? $tab['label']);
                            if ($tabId === 'account') $tabId = 'profile';
                            if ($tabId === 'menu') $tabId = 'shop';
                            if ($tabId === 'services') $tabId = 'shop';
                            if ($tabId === 'wishlist') $tabId = 'favorites';
                            if ($tabId === 'explore') $tabId = 'shop';
                            if ($tabId === 'projects') $tabId = 'shop';
                            if ($tabId === 'insights') $tabId = 'favorites';
                            if ($tabId === 'order') $tabId = 'cart';
                        ?>
                            <div class="mock-nav-tab <?= $isActive ? 'is-active' : '' ?>" data-tab="<?= $tabId ?>" onclick="switchAppTab('<?= $tabId ?>')" title="<?= e($tab['label']) ?>">
                                <span class="mock-tab-icon">
                                    <?php if ($tab['icon'] === 'home'): ?>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <?php elseif ($tab['icon'] === 'grid' || $tab['icon'] === 'search'): ?>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                    <?php elseif ($tab['icon'] === 'heart'): ?>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    <?php elseif ($tab['icon'] === 'bag'): ?>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                    <?php else: ?>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <?php endif; ?>
                                </span>
                                <span class="mock-tab-label"><?= e($tab['label']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </nav>

                </div>
            </div>
        </main>

    </div>

</div>

<!-- Interactive Client-side Script for Phone Simulation & Actions -->
<script>
(function() {
    let currentCartCount = 2;
    let toastTimeout = null;

    // Toast Notification Banner inside Phone Screen
    window.showToast = function(message) {
        const toast = document.getElementById('demoPhoneToast');
        const text = document.getElementById('demoPhoneToastText');
        if (!toast || !text) return;

        text.textContent = message;
        toast.classList.add('is-visible');

        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('is-visible');
        }, 1800);
    };

    // Tab Switching Logic
    window.switchAppTab = function(tabName) {
        // Normalize aliases
        let targetId = 'view-' + tabName;
        if (!document.getElementById(targetId)) {
            if (tabName === 'menu' || tabName === 'services' || tabName === 'explore' || tabName === 'projects') targetId = 'view-shop';
            else if (tabName === 'wishlist' || tabName === 'insights') targetId = 'view-favorites';
            else if (tabName === 'order') targetId = 'view-cart';
            else if (tabName === 'account') targetId = 'view-profile';
            else targetId = 'view-home';
        }

        // Hide all views, show targeted view
        document.querySelectorAll('.app-mock-view').forEach(v => v.classList.remove('is-active'));
        const targetView = document.getElementById(targetId);
        if (targetView) targetView.classList.add('is-active');

        // Update active tab in bottom nav
        document.querySelectorAll('.mock-nav-tab').forEach(tab => {
            const tData = tab.getAttribute('data-tab');
            tab.classList.toggle('is-active', (tData === tabName || 'view-' + tData === targetId));
        });

        // Close search if open
        toggleSearchInput(false);
    };

    // Add item to cart
    window.addItemToCart = function(name, price, icon, btnEl) {
        currentCartCount++;
        const badge = document.getElementById('demoHeaderCartCount');
        const countHeader = document.getElementById('cartViewCount');
        if (badge) badge.textContent = currentCartCount;
        if (countHeader) countHeader.textContent = currentCartCount;

        // Button feedback
        if (btnEl) {
            btnEl.textContent = '✓';
            btnEl.style.backgroundColor = '#10B981';
            setTimeout(() => {
                btnEl.textContent = '+';
                btnEl.style.backgroundColor = '';
            }, 800);
        }

        // Add row to Cart View
        const cartList = document.getElementById('cartItemsList');
        if (cartList) {
            const itemRow = document.createElement('div');
            itemRow.className = 'app-cart-item';
            itemRow.innerHTML = `
                <div class="app-cart-item-art">${icon || '🛍️'}</div>
                <div class="app-cart-item-details">
                    <h6 class="app-cart-item-name">${name}</h6>
                    <span class="app-cart-item-price">${price}</span>
                </div>
                <div class="app-cart-qty-ctrl">
                    <button type="button" class="cart-qty-btn" onclick="updateItemQty(this, -1)">&minus;</button>
                    <span class="cart-qty-val">1</span>
                    <button type="button" class="cart-qty-btn" onclick="updateItemQty(this, 1)">+</button>
                </div>
            `;
            cartList.prepend(itemRow);
        }

        showToast(`Added ${name} to Bag ✓`);
    };

    // Quantity update in cart
    window.updateItemQty = function(btn, change) {
        const qtyValEl = btn.parentElement.querySelector('.cart-qty-val');
        if (!qtyValEl) return;
        let qty = parseInt(qtyValEl.textContent, 10) + change;
        if (qty <= 0) {
            // Remove row
            const row = btn.closest('.app-cart-item');
            if (row) row.remove();
            currentCartCount = Math.max(0, currentCartCount - 1);
            showToast('Item removed from cart');
        } else {
            qtyValEl.textContent = qty;
        }
        const badge = document.getElementById('demoHeaderCartCount');
        const countHeader = document.getElementById('cartViewCount');
        if (badge) badge.textContent = currentCartCount;
        if (countHeader) countHeader.textContent = currentCartCount;
    };

    // Category filter logic
    window.filterAppCategory = function(chipEl, category, isShop = false) {
        const container = isShop ? document.getElementById('shopProductsGrid') : document.getElementById('homeProductsGrid');
        if (!container) return;

        // Update active chip
        const parentChips = chipEl.parentElement;
        if (parentChips) {
            parentChips.querySelectorAll('.mock-cat-chip').forEach(c => c.classList.remove('is-active'));
            chipEl.classList.add('is-active');
        }

        const cards = container.querySelectorAll('.mock-product-card');
        cards.forEach(card => {
            const cCat = card.getAttribute('data-category') || '';
            if (category === 'all' || cCat.includes(category) || category.includes(cCat)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });

        showToast(`Filtered: ${category.toUpperCase()}`);
    };

    // Search bar toggle & filtering
    window.toggleSearchInput = function(forceOpen) {
        const bar = document.getElementById('demoSearchBar');
        if (!bar) return;
        if (forceOpen === undefined) {
            bar.classList.toggle('is-open');
        } else if (forceOpen) {
            bar.classList.add('is-open');
        } else {
            bar.classList.remove('is-open');
        }

        if (bar.classList.contains('is-open')) {
            const input = document.getElementById('demoSearchInput');
            if (input) input.focus();
        }
    };

    window.handleSearchFilter = function(query) {
        query = (query || '').toLowerCase().trim();
        const activeView = document.querySelector('.app-mock-view.is-active');
        if (!activeView) return;

        const cards = activeView.querySelectorAll('.mock-product-card');
        cards.forEach(card => {
            const name = (card.getAttribute('data-name') || '');
            const cat = (card.getAttribute('data-category') || '');
            if (!query || name.includes(query) || cat.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    };

    // Promo code tap
    window.applyPromoCode = function() {
        showToast('Promo MOBILE10 Applied: 10% Off ✓');
    };

    // Mock checkout button
    window.performMockCheckout = function() {
        showToast('🎉 Apple Pay / UPI Simulation Complete!');
        setTimeout(() => {
            alert('AppifyHub Native Checkout Demo:\n\nIn your live generated app, this opens native Apple Pay or Google Pay directly synced with your live store inventory and customer accounts!');
        }, 300);
    };

    // Dark Mode Toggle on Phone Canvas
    window.togglePhoneDarkMode = function() {
        const canvas = document.getElementById('demoPhoneCanvas');
        const switchBtn = document.getElementById('toggleDarkModeSwitch');
        if (!canvas) return;

        const isDark = canvas.classList.toggle('is-dark-theme');
        if (switchBtn) switchBtn.classList.toggle('is-on', isDark);

        showToast(isDark ? 'Dark Mode Enabled 🌙' : 'Light Mode Enabled ☀️');
    };

    // Product Bottom Sheet Modal
    window.openProductSheet = function(item, icon) {
        document.getElementById('sheetItemTitle').textContent = item.name;
        document.getElementById('sheetItemArtwork').textContent = icon || '🛍️';
        document.getElementById('sheetItemCategory').textContent = item.category || 'FEATURED';
        document.getElementById('sheetItemRating').textContent = `★ ${item.rating || '4.9'} (${item.reviews || '45'} reviews)`;
        document.getElementById('sheetItemDesc').textContent = item.description || '';
        document.getElementById('sheetItemPrice').textContent = item.price || '';

        const addBtn = document.getElementById('sheetBtnAddToCart');
        addBtn.onclick = function() {
            addItemToCart(item.name, item.price, icon);
            closeProductSheet();
        };

        const sheetBackdrop = document.getElementById('demoProductSheetBackdrop');
        if (sheetBackdrop) sheetBackdrop.classList.add('is-open');
    };

    window.closeProductSheet = function() {
        const sheetBackdrop = document.getElementById('demoProductSheetBackdrop');
        if (sheetBackdrop) sheetBackdrop.classList.remove('is-open');
    };

    // AJAX Form Selection for Theme
    const selectForm = document.getElementById('themeSelectForm');
    if (selectForm) {
        selectForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSelectThemeAction');
            if (btn) {
                btn.innerHTML = '<span>Selecting... &bull;</span>';
                btn.disabled = true;
            }

            const formData = new FormData(selectForm);
            fetch(selectForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (btn) {
                    btn.style.backgroundColor = '#10B981';
                    btn.style.borderColor = '#10B981';
                    btn.innerHTML = '<span>Theme Selected ✓</span>';
                }
                showToast('<?= addslashes(e($theme['name'])) ?> Selected ✓');
                setTimeout(() => {
                    window.location.href = '<?= url('/addons') ?>';
                }, 750);
            })
            .catch(() => {
                selectForm.submit();
            });
        });
    }

    // ===================================================
    // STICKY PHONE & SCROLL ANYWHERE IN DISPLAY
    // When the user scrolls with wheel/trackpad ANYWHERE in the display,
    // the left info panel smoothly scrolls down while the phone stays sticky!
    // ===================================================
    const leftPanel = document.getElementById('themeInfoPanel');

    window.addEventListener('wheel', function(e) {
        if (window.innerWidth <= 900) return; // Allow natural document scroll on mobile
        if (!leftPanel) return;

        // If cursor is NOT inside leftPanel (e.g. over the phone, right stage, header, background)
        if (!leftPanel.contains(e.target)) {
            const maxScroll = leftPanel.scrollHeight - leftPanel.clientHeight;
            if (maxScroll > 0) {
                const atBottom = (leftPanel.scrollTop >= maxScroll - 1 && e.deltaY > 0);
                const atTop = (leftPanel.scrollTop <= 1 && e.deltaY < 0);

                if (!atBottom && !atTop) {
                    e.preventDefault();
                    leftPanel.scrollTop += e.deltaY;
                }
            }
        }
    }, { passive: false });

    // Keyboard navigation (ArrowDown / ArrowUp / PageDown / PageUp / Space)
    window.addEventListener('keydown', function(e) {
        if (window.innerWidth <= 900 || !leftPanel) return;
        if (e.target && (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT')) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            leftPanel.scrollTop += 60;
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            leftPanel.scrollTop -= 60;
        } else if (e.key === 'PageDown' || e.key === ' ') {
            e.preventDefault();
            leftPanel.scrollTop += 240;
        } else if (e.key === 'PageUp') {
            e.preventDefault();
            leftPanel.scrollTop -= 240;
        }
    });

    // Touch swipe forwarding on desktop / tablet touchscreens
    let touchYStart = 0;
    window.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) touchYStart = e.touches[0].clientY;
    }, { passive: true });

    window.addEventListener('touchmove', function(e) {
        if (window.innerWidth <= 900 || !leftPanel) return;
        if (!leftPanel.contains(e.target) && e.touches.length === 1) {
            const currentY = e.touches[0].clientY;
            const diff = touchYStart - currentY;
            touchYStart = currentY;
            leftPanel.scrollTop += diff;
        }
    }, { passive: true });

})();
</script>
