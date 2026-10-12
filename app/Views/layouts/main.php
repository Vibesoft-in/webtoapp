<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'AppifyHub - Turn Your Website into an App') ?></title>
    <?php if (!empty($metaDescription)): ?>
        <meta name="description" content="<?= e($metaDescription) ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= file_exists(PUBLIC_PATH . '/assets/css/app.css') ? filemtime(PUBLIC_PATH . '/assets/css/app.css') : time() ?>">
</head>
<body class="site-layout">
    <!-- Top Global Header -->
    <header class="app-header">
        <div class="header-inner">
            <a href="<?= url('/') ?>" class="brand-logo" aria-label="AppifyHub Home">
                <svg class="brand-icon" width="26" height="26" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 3L3 27H11L16 17L21 27H29L16 3Z" fill="#78593D"/>
                    <path d="M16 11L11.5 20H20.5L16 11Z" fill="#C2A88F"/>
                </svg>
                <span class="brand-text">AppifyHub</span>
            </a>

            <?php
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            $isHome = $uri === '/' || str_ends_with($uri, 'public/') || str_ends_with($uri, 'public');
            $isHowItWorks = str_contains($uri, 'how-it-works');
            $isThemes = str_contains($uri, 'themes');
            $isPricing = str_contains($uri, 'pricing');
            $isSupport = str_contains($uri, 'support');
            ?>
            <nav class="main-nav" aria-label="Main Navigation">
                <a href="<?= url('/') ?>" class="nav-link <?= $isHome ? 'active' : '' ?>">Home</a>
                <a href="<?= url('/how-it-works') ?>" class="nav-link <?= $isHowItWorks ? 'active' : '' ?>">How It Works</a>
                <a href="<?= url('/themes') ?>" class="nav-link <?= $isThemes ? 'active' : '' ?>">Themes</a>
                <a href="<?= url('/pricing') ?>" class="nav-link <?= $isPricing ? 'active' : '' ?>">Pricing</a>
                <a href="<?= url('/#faq') ?>" class="nav-link <?= $isSupport ? 'active' : '' ?>">Support</a>
            </nav>

            <div class="header-actions">
                <?php if (\App\Core\Session::has('user_id')): ?>
                    <a href="<?= url('/convert') ?>" class="btn-text" style="font-weight: 600;">Convert</a>
                    <a href="<?= url('/dashboard') ?>" class="btn-text">Dashboard</a>
                    <a href="<?= url('/logout') ?>" class="btn-outline">Sign Out</a>
                <?php else: ?>
                    <a href="<?= url('/login') ?>" class="btn-text">Login</a>
                    <a href="<?= url('/register?redirect=' . urlencode(url('/convert'))) ?>" class="btn-outline">
                        <span>Get Started</span>
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="8" x2="13" y2="8"></line>
                            <polyline points="9 4 13 8 9 12"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

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

    <!-- Main Page Content -->
    <main class="page-body">
        <?= $content ?>
    </main>

    <!-- Global AppifyHub Footer -->
    <footer class="app-footer">
        <div class="footer-inner">
            <div class="footer-top-grid">
                <!-- Brand Info -->
                <div class="footer-col footer-col-brand">
                    <a href="<?= url('/') ?>" class="brand-logo" aria-label="AppifyHub Home">
                        <svg class="brand-icon" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 3L3 27H11L16 17L21 27H29L16 3Z" fill="#78593D"/>
                            <path d="M16 11L11.5 20H20.5L16 11Z" fill="#C2A88F"/>
                        </svg>
                        <span class="brand-text">AppifyHub</span>
                    </a>
                    <p class="brand-tagline">Turn your website into a powerful mobile experience.</p>
                </div>

                <!-- Product Links -->
                <div class="footer-col">
                    <h4 class="footer-title">Product</h4>
                    <ul class="footer-links">
                        <li><a href="<?= url('/how-it-works') ?>">How It Works</a></li>
                        <li><a href="<?= url('/#features') ?>">Features</a></li>
                        <li><a href="<?= url('/themes') ?>">Themes</a></li>
                        <li><a href="<?= url('/pricing') ?>">Pricing</a></li>
                    </ul>
                </div>

                <!-- Platform Links -->
                <div class="footer-col">
                    <h4 class="footer-title">Platform</h4>
                    <ul class="footer-links">
                        <li><a href="<?= url('/convert') ?>">WordPress</a></li>
                        <li><a href="<?= url('/convert') ?>">WooCommerce</a></li>
                        <li><a href="<?= url('/convert') ?>">Shopify</a></li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div class="footer-col footer-col-social">
                    <div class="social-icons">
                        <!-- Facebook -->
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"/>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#F5F1EB"/>
                            </svg>
                        </a>
                        <!-- LinkedIn -->
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="LinkedIn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 2a2 2 0 1 1-2 2 2 2 0 0 1 2-2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom-bar">
                <p class="copyright">&copy; <?= date('Y') ?> AppifyHub. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="#privacy">Privacy Policy</a>
                    <span class="sep">|</span>
                    <a href="#terms">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
