<div class="auth-card-wrapper">
    <div class="auth-card">

        <!-- Card Header -->
        <div class="auth-card-header">
            <div class="auth-eyebrow-pill">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                <span>Welcome Back</span>
            </div>
            <h1 class="auth-main-title">Sign In to Your <em>Account</em></h1>
            <p class="auth-subtitle">
                Enter your credentials to access your app builds, analytics, and compatibility analysis.
            </p>
        </div>

        <?php if (!empty($redirect) && (str_contains($redirect, 'convert') || str_contains($redirect, 'compatibility'))): ?>
            <!-- Context Banner for Converter Redirect -->
            <div class="auth-context-banner">
                <div class="auth-context-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="auth-context-text">
                    <strong>Resume Website Conversion</strong>
                    <span>Signing in will immediately take you to the Compatibility Analyzer.</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Sign In Form -->
        <form action="<?= url('/login') ?>" method="POST" class="auth-form" novalidate>
            <?= csrf_field() ?>
            <input type="hidden" name="redirect" value="<?= e($redirect ?? '') ?>">

            <!-- Email Address Field -->
            <div class="auth-field-group">
                <label for="email" class="auth-label">Email Address</label>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        autocomplete="email" 
                        placeholder="you@company.com" 
                        value="<?= e(\App\Core\Session::flash('old')['email'] ?? '') ?>"
                        class="auth-input"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="auth-field-group">
                <div class="auth-label-row">
                    <label for="password" class="auth-label">Password</label>
                    <a href="<?= url('/forgot-password') ?>" class="auth-forgot-link">Forgot password?</a>
                </div>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        placeholder="Enter your password"
                        class="auth-input auth-password-input"
                    >
                    <button type="button" class="auth-toggle-pwd" aria-label="Toggle password visibility" onclick="togglePasswordVisibility('password', this)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="auth-actions">
                <button type="submit" class="btn-auth-submit">
                    <span>Sign In &amp; Continue</span>
                    <svg class="btn-arrow" width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="8" x2="13" y2="8"></line>
                        <polyline points="9 4 13 8 9 12"></polyline>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Divider & Switch to Register -->
        <div class="auth-footer-switch">
            <span class="switch-prompt">Don't have an account yet?</span>
            <a href="<?= url('/register' . (!empty($redirect) ? '?redirect=' . urlencode($redirect) : '')) ?>" class="switch-link">
                <span>Create an Account</span>
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="8" x2="13" y2="8"></line>
                    <polyline points="9 4 13 8 9 12"></polyline>
                </svg>
            </a>
        </div>

    </div>
</div>

<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    }
}
</script>
