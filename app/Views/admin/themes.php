<div class="admin-themes-container">
    <div class="page-header" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.75rem;">
        <div>
            <h1 style="font-size:1.75rem;margin:0 0 0.35rem 0;">Theme Catalog & Marketplace Management</h1>
            <p style="color:var(--text-secondary);margin:0;font-size:0.9rem;">Manage mobile app visual themes, mockups, pricing, features, and live demo routes.</p>
        </div>
        <div style="display:flex;gap:0.75rem;">
            <a href="<?= url('/themes') ?>" target="_blank" class="btn btn-secondary" style="font-size:0.875rem;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                View Marketplace
            </a>
            <a href="<?= url('/admin/themes/create') ?>" class="btn btn-primary" style="font-size:0.875rem;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                + Add Theme
            </a>
        </div>
    </div>

    <?php if ($success = \App\Core\Session::flash('success')): ?>
        <div style="background:#e8f4ec;color:#1e4620;border:1px solid #c2e2cc;padding:0.85rem 1.25rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.9rem;">
            ✓ <?= e($success) ?>
        </div>
    <?php endif; ?>
    <?php if ($error = \App\Core\Session::flash('error')): ?>
        <div style="background:#fcedec;color:#7a1d1d;border:1px solid #f5c4c4;padding:0.85rem 1.25rem;border-radius:8px;margin-bottom:1.5rem;font-size:0.9rem;">
            ⚠ <?= e($error) ?>
        </div>
    <?php endif; ?>

    <div style="background:var(--bg-card);border:1px solid var(--border-color);border-radius:12px;overflow:hidden;">
        <table class="table-standard" style="width:100%;border-collapse:collapse;font-size:0.875rem;">
            <thead>
                <tr style="background:rgba(0,0,0,0.02);border-bottom:1px solid var(--border-color);text-align:left;">
                    <th style="padding:1rem;">Preview</th>
                    <th style="padding:1rem;">Theme Name & Category</th>
                    <th style="padding:1rem;">Price</th>
                    <th style="padding:1rem;">Sort</th>
                    <th style="padding:1rem;">Status</th>
                    <th style="padding:1rem;text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($themes)): ?>
                    <tr>
                        <td colspan="6" style="padding:2rem;text-align:center;color:var(--text-muted);">No themes configured yet. Click "+ Add Theme" to create one.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($themes as $t): ?>
                        <tr style="border-bottom:1px solid var(--border-color);vertical-align:middle;">
                            <td style="padding:0.85rem 1rem;width:80px;">
                                <?php 
                                    $imgName = $t['preview_image'] ?? '';
                                    if (str_starts_with($imgName, 'http') || str_starts_with($imgName, '/')) {
                                        $imgSrc = $imgName;
                                    } elseif (!empty($imgName)) {
                                        $imgSrc = asset('assets/images/' . $imgName);
                                    } else {
                                        $imgSrc = asset('assets/images/theme_modern_minimalist.jpg');
                                    }
                                ?>
                                <img src="<?= e($imgSrc) ?>" alt="<?= e($t['name']) ?>" style="width:54px;height:70px;object-fit:cover;border-radius:6px;border:1px solid var(--border-color);background:#eee;" />
                            </td>
                            <td style="padding:0.85rem 1rem;">
                                <div style="font-weight:600;font-size:0.95rem;color:var(--text-primary);"><?= e($t['name']) ?></div>
                                <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:2px;display:flex;gap:6px;align-items:center;">
                                    <span style="text-transform:uppercase;letter-spacing:0.04em;font-size:0.72rem;background:#f0ece9;padding:2px 6px;border-radius:4px;"><?= e($t['category']) ?></span>
                                    <?php if (!empty($t['badge'])): ?>
                                        <span style="font-size:0.72rem;background:#4E522C;color:#fff;padding:2px 6px;border-radius:4px;"><?= e($t['badge']) ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($t['is_featured'])): ?>
                                        <span style="font-size:0.72rem;background:#B69A78;color:#fff;padding:2px 6px;border-radius:4px;">Featured</span>
                                    <?php endif; ?>
                                </div>
                                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:3px;">
                                    Slug: <code><?= e($t['slug']) ?></code>
                                </div>
                            </td>
                            <td style="padding:0.85rem 1rem;">
                                <?php if ((float)$t['price'] == 0): ?>
                                    <span style="color:#2a6a3b;font-weight:600;">Included in Plan</span>
                                <?php else: ?>
                                    <span style="font-weight:600;color:var(--text-primary);">₹<?= number_format((float)$t['price'], 0) ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:0.85rem 1rem;">
                                <span style="background:rgba(0,0,0,0.04);padding:3px 8px;border-radius:4px;font-family:monospace;"><?= (int)$t['sort_order'] ?></span>
                            </td>
                            <td style="padding:0.85rem 1rem;">
                                <form action="<?= url('/admin/themes/' . (int)$t['id'] . '/toggle') ?>" method="POST" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background:none;border:none;cursor:pointer;padding:0;font-family:inherit;">
                                        <?php if ($t['status'] === 'active'): ?>
                                            <span style="background:#e8f4ec;color:#1e4620;border:1px solid #c2e2cc;padding:3px 8px;border-radius:20px;font-size:0.75rem;font-weight:600;display:inline-flex;align-items:center;gap:4px;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:#2e7d32;display:inline-block;"></span> Active
                                            </span>
                                        <?php else: ?>
                                            <span style="background:#fceeee;color:#8a2525;border:1px solid #f2c7c7;padding:3px 8px;border-radius:20px;font-size:0.75rem;font-weight:600;display:inline-flex;align-items:center;gap:4px;">
                                                <span style="width:6px;height:6px;border-radius:50%;background:#c62828;display:inline-block;"></span> Inactive
                                            </span>
                                        <?php endif; ?>
                                    </button>
                                </form>
                            </td>
                            <td style="padding:0.85rem 1rem;text-align:right;">
                                <div style="display:inline-flex;gap:0.4rem;align-items:center;">
                                    <a href="<?= url('/themes/' . e($t['slug']) . '/demo') ?>" target="_blank" class="btn btn-secondary" style="padding:4px 8px;font-size:0.75rem;" title="Live Interactive Demo">
                                        Demo
                                    </a>
                                    <a href="<?= url('/admin/themes/' . (int)$t['id'] . '/edit') ?>" class="btn btn-primary" style="padding:4px 8px;font-size:0.75rem;">
                                        Edit
                                    </a>
                                    <form action="<?= url('/admin/themes/' . (int)$t['id'] . '/delete') ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete theme <?= e(addslashes($t['name'])) ?>?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn" style="background:none;border:1px solid #e0c8c8;color:#a83232;padding:4px 8px;font-size:0.75rem;border-radius:6px;cursor:pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
