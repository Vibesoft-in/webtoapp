<?php
$isEdit = $isEdit ?? false;
$actionUrl = $isEdit ? url('/admin/themes/' . (int)$theme['id'] . '/update') : url('/admin/themes/store');

// Parse features for textarea if it's JSON
$featuresRaw = $theme['features'] ?? '';
$featuresText = '';
if (!empty($featuresRaw)) {
    $decoded = json_decode($featuresRaw, true);
    if (is_array($decoded)) {
        $featuresText = implode("\n", $decoded);
    } else {
        $featuresText = $featuresRaw;
    }
}
?>

<div class="admin-section" style="max-width:850px;margin:0 auto;padding-bottom:3rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <div>
            <h1 style="font-size:1.75rem;margin:0 0 0.35rem 0;"><?= $isEdit ? 'Edit Theme: ' . e($theme['name']) : 'Create New Theme' ?></h1>
            <p style="color:var(--text-secondary);margin:0;font-size:0.9rem;">Configure appearance, database pricing, mobile previews, and marketplace settings.</p>
        </div>
        <a href="<?= url('/admin/themes') ?>" class="btn btn-secondary" style="font-size:0.875rem;">
            ← Back to Themes
        </a>
    </div>

    <div style="background:var(--bg-card);border:1px solid var(--border-color);border-radius:12px;padding:2rem;">
        <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data" class="form-standard">
            <?= csrf_field() ?>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Theme Name *</label>
                    <input type="text" name="name" value="<?= e($theme['name'] ?? '') ?>" required placeholder="e.g. Modern Minimalist" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                </div>

                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">URL Slug (Optional, auto-generated)</label>
                    <input type="text" name="slug" value="<?= e($theme['slug'] ?? '') ?>" placeholder="e.g. modern-minimalist" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Category *</label>
                    <select name="category" required style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;background:#fff;">
                        <?php 
                            $cats = ['ecommerce' => 'Ecommerce', 'fashion' => 'Fashion', 'restaurant' => 'Restaurant', 'business' => 'Business', 'lifestyle' => 'Lifestyle', 'services' => 'Services'];
                            $currentCat = strtolower($theme['category'] ?? 'ecommerce');
                            foreach ($cats as $val => $lbl):
                        ?>
                            <option value="<?= $val ?>" <?= $currentCat === $val ? 'selected' : '' ?>><?= $lbl ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Price (₹) *</label>
                    <input type="number" step="0.01" min="0" name="price" value="<?= e($theme['price'] ?? '0.00') ?>" required placeholder="0.00" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                    <small style="color:var(--text-muted);font-size:0.75rem;">Set to 0 for "Included in Plan".</small>
                </div>

                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Sort Order</label>
                    <input type="number" name="sort_order" value="<?= (int)($theme['sort_order'] ?? 1) ?>" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Badge Label (Optional)</label>
                    <input type="text" name="badge" value="<?= e($theme['badge'] ?? '') ?>" placeholder="e.g. Popular, Trending, Food & Drink" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                </div>

                <div class="form-group">
                    <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Demo URL Route</label>
                    <input type="text" name="demo_url" value="<?= e($theme['demo_url'] ?? '') ?>" placeholder="e.g. /themes/modern-minimalist/demo" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom:1.25rem;">
                <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Short Description *</label>
                <textarea name="description" rows="3" required placeholder="A brief, compelling overview of the design style and target merchants..." style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;"><?= e($theme['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom:1.25rem;">
                <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:0.4rem;">Key Features (One feature per line)</label>
                <textarea name="features" rows="4" placeholder="Minimalist Product Grid&#10;Slide-out Cart & Checkout&#10;Editorial Lookbook&#10;Sticky Quick Action Bar" style="width:100%;padding:0.65rem 0.85rem;border:1px solid var(--border-color);border-radius:8px;font-size:0.9rem;font-family:monospace;"><?= e($featuresText) ?></textarea>
                <small style="color:var(--text-muted);font-size:0.75rem;">Enter one feature per line. They will be displayed as badge tags on the marketplace card.</small>
            </div>

            <!-- Preview Image Options -->
            <div style="background:rgba(0,0,0,0.02);border:1px solid var(--border-color);border-radius:8px;padding:1.25rem;margin-bottom:1.5rem;">
                <h4 style="margin:0 0 0.75rem 0;font-size:0.9rem;color:var(--text-primary);">Preview Mockup Image</h4>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;align-items:start;">
                    <div>
                        <label style="display:block;font-weight:600;font-size:0.8rem;margin-bottom:0.35rem;">Image Asset Filename or URL</label>
                        <input type="text" name="preview_image" value="<?= e($theme['preview_image'] ?? '') ?>" placeholder="e.g. theme_modern_minimalist.jpg" style="width:100%;padding:0.6rem 0.75rem;border:1px solid var(--border-color);border-radius:6px;font-size:0.85rem;">
                        <small style="color:var(--text-muted);font-size:0.75rem;">Located in <code>public/assets/images/</code> or external URL.</small>
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:0.8rem;margin-bottom:0.35rem;">Or Upload New Preview Mockup</label>
                        <input type="file" name="preview_image_file" accept="image/jpeg,image/png,image/webp" style="font-size:0.85rem;">
                    </div>
                </div>
                <?php if (!empty($theme['preview_image'])): ?>
                    <div style="margin-top:1rem;display:flex;align-items:center;gap:1rem;">
                        <span style="font-size:0.8rem;color:var(--text-secondary);">Current Image:</span>
                        <img src="<?= asset('assets/images/' . $theme['preview_image']) ?>" alt="Preview" style="height:60px;width:45px;object-fit:cover;border-radius:4px;border:1px solid var(--border-color);">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Toggles & Status -->
            <div style="display:flex;gap:2rem;align-items:center;padding:1rem 0;border-top:1px solid var(--border-color);border-bottom:1px solid var(--border-color);margin-bottom:1.5rem;">
                <label style="display:inline-flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.9rem;font-weight:500;">
                    <input type="checkbox" name="is_featured" value="1" <?= !empty($theme['is_featured']) ? 'checked' : '' ?>>
                    Featured Theme (Displays in wide block)
                </label>

                <label style="display:inline-flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.9rem;font-weight:500;">
                    <input type="checkbox" name="is_premium" value="1" <?= !empty($theme['is_premium']) ? 'checked' : '' ?>>
                    Mark as Premium (Paid Addon)
                </label>

                <div style="margin-left:auto;display:inline-flex;align-items:center;gap:0.5rem;">
                    <label style="font-size:0.85rem;font-weight:600;">Status:</label>
                    <select name="status" style="padding:0.4rem 0.75rem;border:1px solid var(--border-color);border-radius:6px;font-size:0.85rem;background:#fff;">
                        <option value="active" <?= ($theme['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active (Visible)</option>
                        <option value="inactive" <?= ($theme['status'] ?? 'active') === 'inactive' ? 'selected' : '' ?>>Inactive (Hidden)</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:1rem;justify-content:flex-end;">
                <a href="<?= url('/admin/themes') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" style="padding:0.75rem 1.75rem;font-weight:600;">
                    <?= $isEdit ? 'Save Theme Changes' : 'Create Theme' ?>
                </button>
            </div>
        </form>
    </div>
</div>
