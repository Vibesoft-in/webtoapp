<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Customer Dashboard - AppConverter') ?></title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body class="dashboard-layout">
    <div class="dashboard-wrapper">
        <aside class="dashboard-sidebar">
            <div class="sidebar-brand">
                <a href="<?= url('/dashboard') ?>">AppConverter</a>
            </div>
            <nav class="sidebar-menu">
                <a href="<?= url('/dashboard') ?>">Overview</a>
                <a href="<?= url('/dashboard/my-app') ?>">My App</a>
                <a href="<?= url('/dashboard/app-settings') ?>">App Settings</a>
                <a href="<?= url('/dashboard/features') ?>">Features</a>
                <a href="<?= url('/dashboard/notifications') ?>">Notifications</a>
                <a href="<?= url('/dashboard/analytics') ?>">Analytics</a>
                <a href="<?= url('/dashboard/builds') ?>">Builds</a>
                <a href="<?= url('/dashboard/updates') ?>">Updates</a>
                <a href="<?= url('/dashboard/billing') ?>">Billing</a>
                <a href="<?= url('/dashboard/support') ?>">Support</a>
                <a href="<?= url('/logout') ?>" class="logout-link">Sign Out</a>
            </nav>
        </aside>

        <div class="dashboard-content-area">
            <header class="dashboard-header">
                <h2><?= e($title ?? 'Dashboard') ?></h2>
                <div class="user-meta">
                    <span><?= e(\App\Core\Session::get('user_name') ?? 'Customer') ?></span>
                </div>
            </header>

            <?php if ($flashSuccess = \App\Core\Session::flash('success')): ?>
                <div class="alert alert-success"><?= e($flashSuccess) ?></div>
            <?php endif; ?>

            <?php if ($flashError = \App\Core\Session::flash('error')): ?>
                <div class="alert alert-error"><?= e($flashError) ?></div>
            <?php endif; ?>

            <main class="dashboard-body">
                <?= $content ?>
            </main>
        </div>
    </div>
    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
