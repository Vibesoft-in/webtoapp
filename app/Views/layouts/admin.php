<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Admin Panel - AppConverter') ?></title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body class="admin-layout">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <a href="<?= url('/admin') ?>">Admin Portal</a>
            </div>
            <nav class="sidebar-menu">
                <a href="<?= url('/admin') ?>">Overview</a>
                <a href="<?= url('/admin/customers') ?>">Customers</a>
                <a href="<?= url('/admin/websites') ?>">Websites</a>
                <a href="<?= url('/admin/compatibility') ?>">Compatibility</a>
                <a href="<?= url('/admin/improvement-requests') ?>">Improvements</a>
                <a href="<?= url('/admin/themes') ?>">Themes</a>
                <a href="<?= url('/admin/addons') ?>">Add-ons</a>
                <a href="<?= url('/admin/pricing') ?>">Pricing Plans</a>
                <a href="<?= url('/admin/orders') ?>">Orders</a>
                <a href="<?= url('/admin/payments') ?>">Payments</a>
                <a href="<?= url('/admin/apps') ?>">Apps</a>
                <a href="<?= url('/admin/builds') ?>">Builds</a>
                <a href="<?= url('/admin/support') ?>">Support Desk</a>
                <a href="<?= url('/logout') ?>" class="logout-link">Sign Out</a>
            </nav>
        </aside>

        <div class="admin-content-area">
            <header class="admin-header">
                <h2><?= e($title ?? 'Administration') ?></h2>
                <div class="admin-meta">
                    <span>Administrator: <?= e(\App\Core\Session::get('user_name') ?? 'Admin') ?></span>
                </div>
            </header>

            <?php if ($flashSuccess = \App\Core\Session::flash('success')): ?>
                <div class="alert alert-success"><?= e($flashSuccess) ?></div>
            <?php endif; ?>

            <?php if ($flashError = \App\Core\Session::flash('error')): ?>
                <div class="alert alert-error"><?= e($flashError) ?></div>
            <?php endif; ?>

            <main class="admin-body">
                <?= $content ?>
            </main>
        </div>
    </div>
    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
