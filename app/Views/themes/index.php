<?php
/**
 * AppifyHub - Premium Visual Theme Marketplace
 */
$currentSelectedId = (int)($selectedThemeId ?? 0);
?>
<div class="themes-marketplace-wrapper">

    <!-- 1. HERO SECTION -->
    <section class="themes-hero-section">
        <div class="themes-container">
            <div class="themes-hero-content">
                <div class="themes-eyebrow-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span>APP TEMPLATE MARKETPLACE</span>
                </div>
                <h1 class="themes-hero-title">
                    Choose Your <em>App Experience</em>
                </h1>
                <p class="themes-hero-subheading">
                    Select a professionally designed mobile app theme that matches your brand, business and customers.
                </p>
                <p class="themes-hero-lead">
                    Every theme is optimized for mobile and can be customized with your branding, content and selected features.
                </p>
            </div>

            <!-- Filters & Search Bar -->
            <div class="themes-filter-search-toolbar">
                <div class="themes-category-filters" id="themeCategoryFilters">
                    <button type="button" class="filter-pill is-active" data-cat="all">All Themes</button>
                    <button type="button" class="filter-pill" data-cat="minimal">Minimal</button>
                    <button type="button" class="filter-pill" data-cat="modern">Modern</button>
                    <button type="button" class="filter-pill" data-cat="trendy">Trendy</button>
                </div>

                <div class="themes-search-input-wrap">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="themeSearchInput" class="theme-search-input" placeholder="Search themes by name, style or feature...">
                </div>
            </div>
        </div>
    </section>

    <!-- 2. THEME MARKETPLACE GRID -->
    <section class="themes-grid-section" id="themeCatalog">
        <div class="themes-container">

            <div class="themes-marketplace-grid" id="themesMarketplaceGrid">
                <?php foreach ($themes as $index => $theme): ?>
                    <?php
                    $isFifthFeatured = ($index === 4);
                    $isSelected = ($currentSelectedId === (int)$theme['id']);
                    $imgSrc = asset($theme['preview_image'] ?? 'images/theme_modern_minimalist.jpg');
                    $featuresList = $theme['parsed_features'] ?? [];
                    ?>
                    <article class="theme-card-block <?= $isFifthFeatured ? 'is-featured-wide' : '' ?> <?= $isSelected ? 'is-selected' : '' ?>" data-theme-id="<?= (int)$theme['id'] ?>" data-theme-name="<?= e($theme['name']) ?>" data-category="<?= strtolower(e($theme['category'])) ?>" data-name="<?= strtolower(e($theme['name'])) ?>" data-desc="<?= strtolower(e($theme['description'])) ?>" data-features="<?= strtolower(implode(' ', $featuresList)) ?>">
                        
                        <!-- Visual Preview Frame -->
                        <div class="theme-card-media-wrap">
                            <div class="theme-preview-link" style="cursor:pointer;" onclick="openThemeLightbox(<?= htmlspecialchars(json_encode([
                                'id' => (int)$theme['id'],
                                'name' => $theme['name'],
                                'slug' => $theme['slug'],
                                'category' => $theme['category'],
                                'description' => $theme['description'],
                                'formatted_price' => $theme['formatted_price'],
                                'badge' => $theme['badge'] ?? '',
                                'image' => $imgSrc,
                                'features' => $featuresList,
                                'demo_url' => url('/themes/' . $theme['slug'] . '/demo'),
                                'details_url' => url('/themes/' . $theme['slug']),
                            ]), ENT_QUOTES, 'UTF-8') ?>)">
                                <img src="<?= $imgSrc ?>" alt="<?= e($theme['name']) ?> Mobile App Theme Preview" class="theme-preview-img" loading="<?= $index > 1 ? 'lazy' : 'eager' ?>">
                                
                                <div class="theme-preview-overlay">
                                    <div style="display:flex;gap:0.6rem;align-items:center;flex-wrap:wrap;justify-content:center;padding:0.5rem;">
                                        <span class="overlay-badge" style="cursor:pointer;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <span>Preview</span>
                                        </span>
                                        <a href="<?= url('/themes/' . e($theme['slug']) . '/demo') ?>" class="overlay-badge" style="background:#403A32;color:#FFF;text-decoration:none;" onclick="event.stopPropagation();">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                            <span>Live Demo</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($theme['badge'])): ?>
                                <span class="theme-floating-badge"><?= e($theme['badge']) ?></span>
                            <?php endif; ?>

                            <?php if ($isSelected): ?>
                                <span class="theme-selected-badge">&check; Currently Selected</span>
                            <?php endif; ?>
                        </div>

                        <!-- Card Info & Content -->
                        <div class="theme-card-body">
                            <div class="theme-card-meta-row">
                                <span class="theme-category-tag"><?= strtoupper(e($theme['category'])) ?></span>
                                <span class="theme-price-tag"><?= e($theme['formatted_price']) ?></span>
                            </div>

                            <h2 class="theme-card-title">
                                <a href="<?= url('/themes/' . e($theme['slug']) . '/demo') ?>"><?= e($theme['name']) ?></a>
                            </h2>

                            <p class="theme-card-desc"><?= e($theme['description']) ?></p>

                            <!-- Key Feature Chips -->
                            <div class="theme-features-chips">
                                <?php foreach (array_slice($featuresList, 0, 4) as $f): ?>
                                    <span class="feature-chip">&bull; <?= e($f) ?></span>
                                <?php endforeach; ?>
                            </div>

                            <!-- Card Action Buttons -->
                            <div class="theme-card-actions-row">
                                <a href="<?= url('/themes/' . e($theme['slug']) . '/demo') ?>" class="btn-theme-demo" title="Try interactive demo">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    <span>Live Demo</span>
                                </a>

                                <form action="<?= url('/themes/select') ?>" method="POST" class="theme-select-form">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="theme_id" value="<?= e($theme['id']) ?>">
                                    <button type="submit" class="btn-theme-select <?= $isSelected ? 'is-active-btn' : '' ?>">
                                        <span><?= $isSelected ? 'Selected &check;' : 'Select Theme' ?></span>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Empty Search State -->
            <div class="themes-empty-state" id="themesEmptyState" style="display: none;">
                <span class="empty-icon">&#128269;</span>
                <h3>No matching themes found</h3>
                <p>Try searching with another keyword or select "All" to view all available themes.</p>
                <button type="button" class="btn-theme-reset" onclick="resetThemeFilters()">Reset Filters</button>
            </div>

        </div>
    </section>

    <!-- 3. THEME COMPARISON SECTION -->
    <section class="themes-comparison-section">
        <div class="themes-container">
            <div class="comparison-header-center">
                <span class="comparison-eyebrow">QUICK COMPARISON</span>
                <h2 class="comparison-heading">Find the Right Theme for Your Business</h2>
                <p class="comparison-sub">Compare styles, target industries, and native capabilities across our designs.</p>
            </div>

            <div class="comparison-table-card">
                <div class="table-responsive-wrapper">
                    <table class="themes-compare-table">
                        <thead>
                            <tr>
                                <th>Theme Name</th>
                                <th>Best For</th>
                                <th>Visual Style</th>
                                <th>Key Highlights</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($themes as $t): ?>
                                <tr>
                                    <td class="theme-name-cell">
                                        <strong><?= e($t['name']) ?></strong>
                                        <span class="theme-cat-sub"><?= ucfirst(e($t['category'])) ?></span>
                                    </td>
                                    <td><?= ucfirst(e($t['category'])) ?> Stores &amp; Brands</td>
                                    <td><?= !empty($t['badge']) ? e($t['badge']) : 'Modern Minimal' ?></td>
                                    <td class="highlights-cell">
                                        <?= !empty($t['parsed_features']) ? e(implode(', ', array_slice($t['parsed_features'], 0, 3))) : 'Full native API synchronization' ?>
                                    </td>
                                    <td class="price-cell">
                                        <strong><?= e($t['formatted_price']) ?></strong>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="table-actions-wrap">
                                            <a href="<?= url('/themes/' . e($t['slug']) . '/demo') ?>" class="btn-tbl-demo">Demo</a>
                                            <form action="<?= url('/themes/select') ?>" method="POST" style="display:inline;">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="theme_id" value="<?= e($t['id']) ?>">
                                                <button type="submit" class="btn-tbl-select">Select</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. FINAL CALL TO ACTION -->
    <section class="themes-final-cta-section">
        <div class="themes-container">
            <div class="themes-cta-card">
                <span class="themes-eyebrow-accent">READY TO LAUNCH</span>
                <h2 class="themes-cta-title">Found Your Style?</h2>
                <p class="themes-cta-lead">
                    Choose a theme that fits your business, customize the features you need, and continue building your mobile app.
                </p>
                <div class="themes-cta-actions">
                    <a href="#themeCatalog" class="btn-hiw-secondary">
                        <span>Choose a Theme &uarr;</span>
                    </a>
                    <a href="<?= url('/compatibility') ?>" class="btn-hiw-primary">
                        <span>Start With My Website &rarr;</span>
                    </a>
                </div>
                <div class="themes-cta-guarantee">
                    <span>WordPress &middot; WooCommerce &middot; Shopify Compatible</span>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Quick Preview Lightbox Modal -->
<div class="theme-lightbox-modal" id="themeLightboxModal" style="display:none;" onclick="if(event.target === this) closeThemeLightbox()">
    <div class="theme-lightbox-dialog">
        <button type="button" class="lightbox-close-btn" onclick="closeThemeLightbox()" aria-label="Close Preview">&times;</button>
        <div class="theme-lightbox-body">
            <div class="theme-lightbox-media">
                <img id="lightboxImg" src="" alt="Theme Preview" class="lightbox-preview-img">
            </div>
            <div class="theme-lightbox-info">
                <div class="lightbox-badge-row">
                    <span id="lightboxCategory" class="lightbox-cat-tag">ECOMMERCE</span>
                    <span id="lightboxBadge" class="lightbox-badge-tag" style="display:none;"></span>
                </div>
                <h3 id="lightboxTitle" class="lightbox-title">Theme Name</h3>
                <p id="lightboxDesc" class="lightbox-desc">Theme Description</p>
                
                <div class="lightbox-price-box">
                    <span class="lightbox-price-label">Price</span>
                    <strong id="lightboxPrice" class="lightbox-price-val">₹0</strong>
                </div>

                <div class="lightbox-features-wrap">
                    <h4>Included Native Features</h4>
                    <ul id="lightboxFeaturesList" class="lightbox-features-list"></ul>
                </div>

                <div class="lightbox-actions-row">
                    <a id="lightboxDemoBtn" href="#" class="btn-theme-demo" style="flex:1;justify-content:center;padding:0.75rem 1rem;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        <span>Launch Live Demo</span>
                    </a>
                    <form id="lightboxSelectForm" action="<?= url('/themes/select') ?>" method="POST" style="flex:1;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="theme_id" id="lightboxThemeId" value="">
                        <button type="submit" class="btn-theme-select" style="width:100%;padding:0.75rem 1rem;justify-content:center;">
                            <span>Select Theme</span>
                        </button>
                    </form>
                </div>

                <div style="margin-top:0.75rem;text-align:center;">
                    <a id="lightboxDetailsLink" href="#" style="font-size:0.8rem;color:var(--text-secondary);text-decoration:underline;">
                        View Full Specifications &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Marketplace Toast -->
<div class="theme-market-toast" id="themeMarketToast">
    <span class="market-toast-icon">&check;</span>
    <span id="themeMarketToastText">Theme Selected</span>
</div>

<!-- Client-side Interactive Filter, Search & Card Selection Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('#themeCategoryFilters .filter-pill');
    const searchInput = document.getElementById('themeSearchInput');
    const cards = document.querySelectorAll('.theme-card-block');
    const emptyState = document.getElementById('themesEmptyState');
    const marketToast = document.getElementById('themeMarketToast');
    const marketToastText = document.getElementById('themeMarketToastText');

    let activeCategory = 'all';
    let searchQuery = '';
    let toastTimer = null;

    // Show floating feedback toast
    function showToast(msg) {
        if (!marketToast || !marketToastText) return;
        marketToastText.textContent = msg;
        marketToast.classList.add('is-show');
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            marketToast.classList.remove('is-show');
        }, 2200);
    }

    // Interactive Theme Selection via AJAX
    function selectThemeAjax(themeId, themeName, activeCard) {
        // Instant visual feedback on cards
        cards.forEach(card => {
            const isMatch = (card.getAttribute('data-theme-id') === String(themeId));
            card.classList.toggle('is-selected', isMatch);
            
            const btn = card.querySelector('.btn-theme-select');
            if (btn) {
                if (isMatch) {
                    btn.classList.add('is-active-btn');
                    btn.innerHTML = '<span>Selected &check;</span>';
                } else {
                    btn.classList.remove('is-active-btn');
                    btn.innerHTML = '<span>Select Theme</span>';
                }
            }
        });

        // Send AJAX request to preserve selection in session
        const formData = new FormData();
        formData.append('theme_id', themeId);
        const csrfToken = document.querySelector('input[name="csrf_token"]');
        if (csrfToken) formData.append('csrf_token', csrfToken.value);

        fetch('<?= url('/themes/select') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            showToast(`${themeName || 'Theme'} selected for your app ✓`);
        })
        .catch(() => {
            showToast(`${themeName || 'Theme'} selected ✓`);
        });
    }

    // Make entire theme card clickable
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            // If user clicked direct interactive link or form button, let native handler work
            if (e.target.closest('a') || e.target.closest('button') || e.target.closest('.theme-preview-overlay')) {
                return;
            }

            const themeId = card.getAttribute('data-theme-id');
            const themeName = card.getAttribute('data-theme-name');
            if (themeId) {
                selectThemeAjax(themeId, themeName, card);
            }
        });
    });

    // Intercept "Select Theme" button form submits
    document.querySelectorAll('.theme-select-form').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const idInput = form.querySelector('input[name="theme_id"]');
            const card = form.closest('.theme-card-block');
            const themeId = idInput ? idInput.value : (card ? card.getAttribute('data-theme-id') : null);
            const themeName = card ? card.getAttribute('data-theme-name') : 'Theme';
            if (themeId) {
                selectThemeAjax(themeId, themeName, card);
            }
        });
    });

    // Intercept Lightbox form submit
    const lightboxForm = document.getElementById('lightboxSelectForm');
    if (lightboxForm) {
        lightboxForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const idInput = document.getElementById('lightboxThemeId');
            const themeName = document.getElementById('lightboxTitle')?.textContent || 'Theme';
            if (idInput && idInput.value) {
                selectThemeAjax(idInput.value, themeName, null);
                closeThemeLightbox();
            }
        });
    }

    // Category filter logic
    function filterThemes() {
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category') || '';
            const cardName = card.getAttribute('data-name') || '';
            const cardDesc = card.getAttribute('data-desc') || '';
            const cardFeatures = card.getAttribute('data-features') || '';

            const matchesCategory = (activeCategory === 'all' || 
                cardCat.toLowerCase() === activeCategory || 
                cardCat.toLowerCase().includes(activeCategory));
            const matchesSearch = (!searchQuery || 
                cardName.includes(searchQuery) || 
                cardDesc.includes(searchQuery) || 
                cardFeatures.includes(searchQuery) || 
                cardCat.includes(searchQuery));

            if (matchesCategory && matchesSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    // Handle initial category from URL parameter (e.g., ?category=minimal or ?theme=modern)
    const initialUrlParams = new URLSearchParams(window.location.search);
    const initialCat = initialUrlParams.get('category') || initialUrlParams.get('cat') || initialUrlParams.get('theme');
    if (initialCat) {
        const matchingBtn = Array.from(filterButtons).find(b => b.getAttribute('data-cat') === initialCat.toLowerCase());
        if (matchingBtn) {
            filterButtons.forEach(b => b.classList.remove('is-active'));
            matchingBtn.classList.add('is-active');
            activeCategory = initialCat.toLowerCase();
            filterThemes();
        }
    }

    // Category button clicks
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            activeCategory = btn.getAttribute('data-cat') || 'all';
            filterThemes();
            showToast(`Category: ${btn.textContent.trim()}`);
        });
    });

    // Search input typing
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.trim().toLowerCase();
            filterThemes();
        });
    }

    // Reset filters
    window.resetThemeFilters = function() {
        activeCategory = 'all';
        searchQuery = '';
        if (searchInput) searchInput.value = '';
        filterButtons.forEach(b => b.classList.toggle('is-active', b.getAttribute('data-cat') === 'all'));
        filterThemes();
    };

    // Lightbox modal logic
    window.openThemeLightbox = function(data) {
        document.getElementById('lightboxImg').src = data.image;
        document.getElementById('lightboxCategory').textContent = (data.category || '').toUpperCase();
        
        const badgeEl = document.getElementById('lightboxBadge');
        if (data.badge) {
            badgeEl.textContent = data.badge;
            badgeEl.style.display = 'inline-block';
        } else {
            badgeEl.style.display = 'none';
        }
        
        document.getElementById('lightboxTitle').textContent = data.name;
        document.getElementById('lightboxDesc').textContent = data.description;
        document.getElementById('lightboxPrice').textContent = data.formatted_price;
        document.getElementById('lightboxDemoBtn').href = data.demo_url;
        document.getElementById('lightboxDetailsLink').href = data.details_url;
        document.getElementById('lightboxThemeId').value = data.id;
        
        const featList = document.getElementById('lightboxFeaturesList');
        featList.innerHTML = '';
        (data.features || []).forEach(f => {
            const li = document.createElement('li');
            li.textContent = f;
            featList.appendChild(li);
        });
        
        document.getElementById('themeLightboxModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    window.closeThemeLightbox = function() {
        const modal = document.getElementById('themeLightboxModal');
        if (modal) modal.style.display = 'none';
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeThemeLightbox();
    });
});
</script>
