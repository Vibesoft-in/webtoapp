<div class="auth-card-wrapper">
    <div class="auth-card">

        <!-- Card Header -->
        <div class="auth-card-header">
            <div class="auth-eyebrow-pill">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <span>Account Setup</span>
            </div>
            <h1 class="auth-main-title">Create Your <em>Account</em></h1>
            <p class="auth-subtitle">
                Register to run the website compatibility check and begin compiling your native mobile application.
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
                    <strong>Ready to Analyze Your Website</strong>
                    <span>Once registered, you'll immediately proceed to the Compatibility Analyzer.</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="<?= url('/register') ?>" method="POST" class="auth-form" novalidate>
            <?= csrf_field() ?>
            <input type="hidden" name="redirect" value="<?= e($redirect ?? '') ?>">

            <!-- Full Name Field -->
            <div class="auth-field-group">
                <label for="name" class="auth-label">Full Name</label>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required 
                        autocomplete="name" 
                        placeholder="John Doe" 
                        value="<?= e(\App\Core\Session::flash('old')['name'] ?? '') ?>"
                        class="auth-input"
                    >
                </div>
            </div>

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

            <!-- Phone Number Field (Optional) -->
            <div class="auth-field-group">
                <div class="auth-label-row">
                    <label for="phone" class="auth-label">Phone Number</label>
                    <span class="auth-badge-optional">Optional</span>
                </div>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </span>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        autocomplete="tel" 
                        placeholder="+1 (555) 000-0000" 
                        value="<?= e(\App\Core\Session::flash('old')['phone'] ?? '') ?>"
                        class="auth-input"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="auth-field-group">
                <label for="password" class="auth-label">Password</label>
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
                        autocomplete="new-password" 
                        placeholder="At least 6 characters"
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

            <!-- Section Divider: Website & Store Details -->
            <div class="auth-section-divider">
                <div class="divider-line"></div>
                <span class="divider-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    Website Details for Conversion
                </span>
                <div class="divider-line"></div>
            </div>

            <!-- Website / Store URL Field -->
            <div class="auth-field-group">
                <div class="auth-label-row">
                    <label for="website_url" class="auth-label">Website / Store URL <span class="required-star">*</span></label>
                    <span class="auth-badge-required">Auto-Analyzed</span>
                </div>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </span>
                    <input 
                        type="url" 
                        id="website_url" 
                        name="website_url" 
                        required 
                        autocomplete="url" 
                        placeholder="https://yourstore.com" 
                        value="<?= e(\App\Core\Session::flash('old')['website_url'] ?? \App\Core\Session::flash('old')['url'] ?? '') ?>"
                        class="auth-input"
                    >
                </div>
                <p class="auth-field-hint">Your website address to be scanned and converted into a native app.</p>
            </div>

            <!-- Platform Selection Field -->
            <div class="auth-field-group">
                <div class="auth-label-row">
                    <label class="auth-label">Website Platform <span class="required-star">*</span></label>
                    <span class="auth-badge-required" id="platformBadgeStatus">Auto-Detect</span>
                </div>
                <?php 
                    $selectedPlatform = \App\Core\Session::flash('old')['platform'] ?? ''; 
                ?>
                <div class="auth-platform-options">
                    <label class="auth-platform-radio-card <?= $selectedPlatform === 'woocommerce' ? 'is-active' : '' ?>">
                        <input type="radio" name="platform" value="woocommerce" <?= $selectedPlatform === 'woocommerce' ? 'checked' : '' ?> style="display:none;">
                        <div class="platform-radio-header">
                            <span class="platform-icon-tag icon-woo">Woo</span>
                            <span class="radio-custom-dot"></span>
                        </div>
                        <div class="platform-radio-body">
                            <span class="platform-opt-title">WooCommerce</span>
                            <span class="platform-opt-desc">WordPress Store</span>
                        </div>
                    </label>

                    <label class="auth-platform-radio-card <?= $selectedPlatform === 'shopify' ? 'is-active' : '' ?>">
                        <input type="radio" name="platform" value="shopify" <?= $selectedPlatform === 'shopify' ? 'checked' : '' ?> style="display:none;">
                        <div class="platform-radio-header">
                            <span class="platform-icon-tag icon-shopify">Shopify</span>
                            <span class="radio-custom-dot"></span>
                        </div>
                        <div class="platform-radio-body">
                            <span class="platform-opt-title">Shopify</span>
                            <span class="platform-opt-desc">Cloud eCommerce</span>
                        </div>
                    </label>

                    <label class="auth-platform-radio-card <?= $selectedPlatform === 'wordpress' ? 'is-active' : '' ?>">
                        <input type="radio" name="platform" value="wordpress" <?= $selectedPlatform === 'wordpress' ? 'checked' : '' ?> style="display:none;">
                        <div class="platform-radio-header">
                            <span class="platform-icon-tag icon-wp">WordPress</span>
                            <span class="radio-custom-dot"></span>
                        </div>
                        <div class="platform-radio-body">
                            <span class="platform-opt-title">WordPress</span>
                            <span class="platform-opt-desc">Content &amp; Blog CMS</span>
                        </div>
                    </label>
                </div>
                <!-- Live Platform & URL Verification Feedback -->
                <div id="urlPlatformFeedback" class="platform-match-feedback" style="display:none;"></div>
            </div>

            <!-- Website / Store Name (Optional) -->
            <div class="auth-field-group">
                <div class="auth-label-row">
                    <label for="website_name" class="auth-label">Store / Brand Name</label>
                    <span class="auth-badge-optional">Optional</span>
                </div>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        id="website_name" 
                        name="website_name" 
                        autocomplete="organization" 
                        placeholder="e.g. Maison Lumière" 
                        value="<?= e(\App\Core\Session::flash('old')['website_name'] ?? '') ?>"
                        class="auth-input"
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <div class="auth-actions">
                <button type="submit" class="btn-auth-submit">
                    <span>Create Account &amp; Proceed</span>
                    <svg class="btn-arrow" width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="8" x2="13" y2="8"></line>
                        <polyline points="9 4 13 8 9 12"></polyline>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Divider & Switch to Login -->
        <div class="auth-footer-switch">
            <span class="switch-prompt">Already have an account?</span>
            <a href="<?= url('/login' . (!empty($redirect) ? '?redirect=' . urlencode($redirect) : '')) ?>" class="switch-link">
                <span>Sign In</span>
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

function switchRegistrationPlatform(targetPlatform) {
    const radio = document.querySelector(`.auth-platform-radio-card input[value="${targetPlatform}"]`);
    if (radio) {
        const card = radio.closest('.auth-platform-radio-card');
        if (card) {
            card.click();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const platformCards = document.querySelectorAll('.auth-platform-radio-card');
    const urlInput = document.getElementById('website_url');
    const feedbackBox = document.getElementById('urlPlatformFeedback');
    const badgeStatus = document.getElementById('platformBadgeStatus');
    const csrfToken = document.querySelector('input[name="csrf_token"]')?.value || '';
    const registerForm = document.querySelector('form.auth-form');

    let debounceTimer = null;
    let activeAbortController = null;
    let isManualUserSelection = false;
    let latestCheckStatus = { checked: false, isCustom: false, isSupported: true, matched: true, detectedPlatform: null };

    function getSelectedPlatform() {
        const checked = document.querySelector('input[name="platform"]:checked');
        return checked ? checked.value : '';
    }

    function autoSelectPlatform(platformKey) {
        platformCards.forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            const isMatch = (radio && radio.value === platformKey);
            card.classList.toggle('is-active', isMatch);
            if (radio) {
                radio.checked = isMatch;
            }
        });
        if (badgeStatus) {
            badgeStatus.textContent = 'Auto-Selected';
            badgeStatus.style.borderColor = '#B8E0A6';
            badgeStatus.style.color = '#235817';
            badgeStatus.style.background = '#F2F8ED';
        }
    }

    function clearPlatformSelection() {
        platformCards.forEach(card => {
            card.classList.remove('is-active');
            const radio = card.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = false;
            }
        });
        if (badgeStatus) {
            badgeStatus.textContent = 'Custom Platform';
            badgeStatus.style.borderColor = '#F2B9B0';
            badgeStatus.style.color = '#8C2517';
            badgeStatus.style.background = '#FDF3F1';
        }
    }

    platformCards.forEach(card => {
        const radio = card.querySelector('input[type="radio"]');
        card.addEventListener('click', () => {
            isManualUserSelection = true;
            platformCards.forEach(c => c.classList.remove('is-active'));
            card.classList.add('is-active');
            if (radio) {
                radio.checked = true;
            }
            if (badgeStatus) {
                badgeStatus.textContent = 'Manual Selection';
                badgeStatus.style.borderColor = '';
                badgeStatus.style.color = '';
                badgeStatus.style.background = '';
            }
            if (urlInput && urlInput.value.trim().length >= 4) {
                schedulePlatformCheck(80);
            }
        });
    });

    if (urlInput) {
        urlInput.addEventListener('input', () => {
            isManualUserSelection = false;
            schedulePlatformCheck(500);
        });
        urlInput.addEventListener('blur', () => {
            schedulePlatformCheck(50);
        });
    }

    function schedulePlatformCheck(delay = 500) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            runPlatformCheck();
        }, delay);
    }

    async function runPlatformCheck() {
        if (!urlInput || !feedbackBox) return;
        const rawUrl = urlInput.value.trim();

        if (!rawUrl || rawUrl.length < 4 || !rawUrl.includes('.')) {
            feedbackBox.style.display = 'none';
            feedbackBox.innerHTML = '';
            latestCheckStatus = { checked: false, isCustom: false, isSupported: true, matched: true, detectedPlatform: null };
            if (badgeStatus) {
                badgeStatus.textContent = 'Auto-Detect';
                badgeStatus.style.borderColor = '';
                badgeStatus.style.color = '';
                badgeStatus.style.background = '';
            }
            return;
        }

        const currentSelectedPlatform = getSelectedPlatform();

        if (activeAbortController) {
            activeAbortController.abort();
        }
        activeAbortController = new AbortController();

        feedbackBox.style.display = 'block';
        feedbackBox.innerHTML = `
            <div class="feedback-inner is-checking">
                <span class="feedback-spinner"></span>
                <span>Detecting website platform from URL...</span>
            </div>
        `;

        try {
            const checkUrl = '<?= url('/check-platform-match') ?>';
            const response = await fetch(checkUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                signal: activeAbortController.signal,
                body: JSON.stringify({
                    url: rawUrl,
                    platform: currentSelectedPlatform,
                    manual: isManualUserSelection,
                    csrf_token: csrfToken
                })
            });

            const data = await response.json();
            if (!data.success) {
                feedbackBox.style.display = 'none';
                return;
            }

            const isCustom = Boolean(data.is_custom || data.detected_platform === 'custom' || data.is_supported === false);

            latestCheckStatus = {
                checked: true,
                isCustom: isCustom,
                isSupported: !isCustom,
                matched: Boolean(data.matched),
                detectedPlatform: data.detected_platform
            };

            if (isCustom) {
                // Clear any selected platform radio
                clearPlatformSelection();

                feedbackBox.innerHTML = `
                    <div class="feedback-inner is-unsupported">
                        <span class="feedback-badge-icon">✕</span>
                        <div class="feedback-text-wrap">
                            <strong>Custom Platform Detected</strong>
                            <p>${data.message || 'This website appears to be built on a custom platform. We currently only convert websites built on WooCommerce, Shopify, or WordPress.'}</p>
                        </div>
                    </div>
                `;
            } else if (data.auto_platform) {
                // Automatically select detected platform!
                autoSelectPlatform(data.auto_platform);

                const detectedName = data.auto_platform.charAt(0).toUpperCase() + data.auto_platform.slice(1);
                feedbackBox.innerHTML = `
                    <div class="feedback-inner is-matched">
                        <span class="feedback-badge-icon">✓</span>
                        <div class="feedback-text-wrap">
                            <strong>Platform Automatically Selected</strong>
                            <p>Website verified: Automatically detected and selected <strong>${detectedName}</strong>.</p>
                        </div>
                    </div>
                `;
            } else if (data.matched === false) {
                // User manually clicked another platform that does not match
                const detectedName = data.detected_platform 
                    ? (data.detected_platform.charAt(0).toUpperCase() + data.detected_platform.slice(1)) 
                    : '';
                const canQuickSwitch = data.detected_platform && ['woocommerce', 'shopify', 'wordpress'].includes(data.detected_platform);

                feedbackBox.innerHTML = `
                    <div class="feedback-inner is-mismatched">
                        <div class="mismatch-msg-wrap">
                            <span class="feedback-badge-icon">⚠️</span>
                            <div class="feedback-text-wrap">
                                <strong>Platform Mismatch</strong>
                                <p>${data.message}</p>
                            </div>
                        </div>
                        ${canQuickSwitch ? `
                            <button type="button" class="btn-quick-switch" onclick="switchRegistrationPlatform('${data.detected_platform}')">
                                Switch to ${detectedName}
                            </button>
                        ` : ''}
                    </div>
                `;
            } else {
                feedbackBox.innerHTML = `
                    <div class="feedback-inner is-matched">
                        <span class="feedback-badge-icon">✓</span>
                        <div class="feedback-text-wrap">
                            <strong>Platform Verified</strong>
                            <p>${data.message || 'Website URL matches selected platform.'}</p>
                        </div>
                    </div>
                `;
            }
        } catch (err) {
            if (err.name !== 'AbortError') {
                console.warn('URL platform check error:', err);
                feedbackBox.style.display = 'none';
            }
        }
    }

    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            if (latestCheckStatus.checked && (latestCheckStatus.isCustom || !latestCheckStatus.isSupported)) {
                e.preventDefault();
                alert('Custom Platform Error: This website appears to be built on a custom platform. We currently only convert websites built on WooCommerce, Shopify, or WordPress.');
                urlInput.focus();
                return;
            }
            if (!getSelectedPlatform()) {
                e.preventDefault();
                alert('Please enter a valid website URL built on WooCommerce, Shopify, or WordPress to detect your platform.');
                urlInput.focus();
                return;
            }
            if (latestCheckStatus.checked && !latestCheckStatus.matched && latestCheckStatus.detectedPlatform) {
                const proceed = confirm(`The website appears to be built on ${latestCheckStatus.detectedPlatform.toUpperCase()}, but you have selected a different platform. Do you want to switch to ${latestCheckStatus.detectedPlatform.toUpperCase()}?`);
                if (proceed) {
                    e.preventDefault();
                    switchRegistrationPlatform(latestCheckStatus.detectedPlatform);
                }
            }
        });
    }

    // Auto-check on load if URL is pre-filled
    if (urlInput && urlInput.value.trim().length >= 4) {
        schedulePlatformCheck(250);
    }
});
</script>
