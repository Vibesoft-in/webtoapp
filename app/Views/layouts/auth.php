<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'AppifyHub - Turn Your Website into an App') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= file_exists(PUBLIC_PATH . '/assets/css/app.css') ? filemtime(PUBLIC_PATH . '/assets/css/app.css') : time() ?>">
</head>
<body class="auth-layout">
    <div class="auth-page-wrapper">
        <!-- Top Auth Nav Bar -->
        <header class="auth-nav-bar">
            <div class="auth-nav-inner">
                <a href="<?= url('/') ?>" class="brand-logo" aria-label="AppifyHub Home">
                    <svg class="brand-icon" width="26" height="26" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 3L3 27H11L16 17L21 27H29L16 3Z" fill="#78593D"/>
                        <path d="M16 11L11.5 20H20.5L16 11Z" fill="#C2A88F"/>
                    </svg>
                    <span class="brand-text">AppifyHub</span>
                </a>

                <a href="<?= url('/') ?>" class="auth-back-link">
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="13" y1="8" x2="3" y2="8"></line>
                        <polyline points="7 12 3 8 7 4"></polyline>
                    </svg>
                    <span>Back to Website</span>
                </a>
            </div>
        </header>

        <!-- Flash Notifications -->
        <div class="auth-flash-wrapper">
            <?php if ($flashSuccess = \App\Core\Session::flash('success')): ?>
                <div class="global-alert alert-success">
                    <div class="alert-content"><?= e($flashSuccess) ?></div>
                </div>
            <?php endif; ?>

            <?php if ($flashError = \App\Core\Session::flash('error')): ?>
                <div class="global-alert alert-error">
                    <div class="alert-content"><?= e($flashError) ?></div>
                </div>
            <?php endif; ?>

            <?php if ($flashInfo = \App\Core\Session::flash('info')): ?>
                <div class="global-alert alert-info">
                    <div class="alert-content"><?= e($flashInfo) ?></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Authentication Content -->
        <main class="auth-main-content">
            <?= $content ?>
        </main>

        <!-- Auth Footer -->
        <footer class="auth-footer">
            <p>&copy; <?= date('Y') ?> AppifyHub Platform. Native iOS &amp; Android App Compilation Suite.</p>
        </footer>
    </div>
    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
