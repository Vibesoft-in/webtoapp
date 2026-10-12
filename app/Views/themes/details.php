<?php
/**
 * AppifyHub - Dedicated Theme Details Page
 */
$imageSrc = asset($theme['preview_image'] ?? 'images/theme_modern_minimalist.jpg');
?>
<div class="theme-details-page-wrapper">
    <div class="details-top-breadcrumb">
        <a href="<?= url('/themes') ?>">&larr; Back to Themes Marketplace</a>
    </div>

    <div class="details-main-grid">
        <!-- Left: Large Visual Phone Mockup Showcase -->
        <div class="details-visual-col">
            <div class="details-media-frame">
                <img src="<?= $imageSrc ?>" alt="<?= e($theme['name']) ?> Mobile App Theme Preview" class="details-preview-img">
                <div class="preview-overlay-btn-wrap">
                    <a href="<?= url('/themes/' . e($theme['slug']) . '/demo') ?>" class="btn-overlay-demo">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        <span>Launch Live Interactive Demo</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Information, Specs & Actions -->
        <div class="details-info-col">
            <div class="details-header-strip">
                <span class="details-cat-badge"><?= ucfirst(e($theme['category'])) ?></span>
                <?php if (!empty($theme['badge'])): ?>
                    <span class="details-badge-pill"><?= e($theme['badge']) ?></span>
                <?php endif; ?>
            </div>

            <h1 class="details-theme-title"><?= e($theme['name']) ?></h1>
            <p class="details-theme-lead"><?= e($theme['description']) ?></p>

            <div class="details-price-banner">
                <div class="price-box">
                    <span class="price-label">Theme Price</span>
                    <strong class="price-number"><?= e($theme['formatted_price']) ?></strong>
                </div>
                <div class="price-guarantee">
                    <span>One-time selection &middot; Full source &middot; Live database sync</span>
                </div>
            </div>

            <!-- Features Breakdown -->
            <div class="details-features-block">
                <h3>Included Mobile Capabilities</h3>
                <div class="details-features-grid">
                    <?php foreach ($theme['parsed_features'] as $f): ?>
                        <div class="detail-feature-item">
                            <span class="feature-tick">&check;</span>
                            <span><?= e($f) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="details-cta-actions">
                <a href="<?= url('/themes/' . e($theme['slug']) . '/demo') ?>" class="btn-details-demo">
                    <span>Live Interactive Demo &rarr;</span>
                </a>

                <form action="<?= url('/themes/select') ?>" method="POST" class="details-select-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="theme_id" value="<?= e($theme['id']) ?>">
                    <button type="submit" class="btn-details-select">
                        <span>Select Theme (<?= e($theme['formatted_price']) ?>) &rarr;</span>
                    </button>
                </form>
            </div>

            <div class="details-trust-note">
                Selecting this theme assigns it to your active project. You can customize colors, branding, logos, and features in the next steps.
            </div>
        </div>
    </div>
</div>
