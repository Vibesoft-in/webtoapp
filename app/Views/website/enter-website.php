<?php
/**
 * AppifyHub - Website Compatibility Analyzer
 * Interactive Onboarding Wizard
 */
?>
<div class="analyzer-wizard-page">
    <div class="analyzer-wizard-container">

        <!-- Header -->
        <header class="analyzer-hero-header">
            <div class="analyzer-eyebrow-pill">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Compatibility Analyzer</span>
            </div>
            <h1 class="analyzer-main-title">Website Compatibility <em>Analyzer</em></h1>
            <p class="analyzer-subtitle">
                Verify whether your WordPress, WooCommerce, or Shopify store is ready for native iOS &amp; Android app compilation.
            </p>
        </header>

        <!-- Stepper (Desktop Horizontal / Mobile Vertical) -->
        <nav class="analyzer-stepper" aria-label="Analysis Progress">
            <div class="stepper-track">
                <div class="step-node active" data-step="1">
                    <span class="step-num">1</span>
                    <span class="step-label">Select Platform</span>
                </div>
                <div class="step-connector"></div>
                <div class="step-node" data-step="2">
                    <span class="step-num">2</span>
                    <span class="step-label">Connect API</span>
                </div>
                <div class="step-connector"></div>
                <div class="step-node" data-step="3">
                    <span class="step-num">3</span>
                    <span class="step-label">Verify Connection</span>
                </div>
                <div class="step-connector"></div>
                <div class="step-node" data-step="4">
                    <span class="step-num">4</span>
                    <span class="step-label">Analyze Website</span>
                </div>
                <div class="step-connector"></div>
                <div class="step-node" data-step="5">
                    <span class="step-num">5</span>
                    <span class="step-label">Compatibility Result</span>
                </div>
            </div>
        </nav>

        <!-- Hidden CSRF and Session Metadata -->
        <input type="hidden" id="csrfToken" value="<?= csrf_token() ?>">
        <input type="hidden" id="activeWebsiteId" value="<?= (int)($currentWebsiteId ?? 0) ?>">
        <input type="hidden" id="activePlatform" value="<?= e($currentPlatform ?? '') ?>">
        <input type="hidden" id="activeWebsiteName" value="<?= e($currentWebsiteName ?? '') ?>">
        <input type="hidden" id="appBaseUrl" value="<?= url('') ?>">
        <input type="hidden" id="assetsBaseUrl" value="<?= asset('') ?>">

        <!-- STAGE 1: URL Analyzer Input Card -->
        <section class="analyzer-card url-analyzer-card" id="urlCard">
            <div class="card-inner">
                <div class="url-input-heading-row">
                    <h2 class="card-heading">Enter Website URL</h2>
                    <span class="badge-subtle">HTTPS Required</span>
                </div>
                <p class="card-instruction">
                    Provide your website or store address to detect your CMS and initiate compatibility verification.
                </p>

                <?php if (!empty($currentUrl)): ?>
                    <div class="prefilled-details-banner" id="prefilledBanner">
                        <div class="prefilled-banner-left">
                            <span class="prefilled-icon-check">✓</span>
                            <div class="prefilled-banner-text">
                                <span class="prefilled-label">Pre-filled from your registration:</span>
                                <span class="prefilled-val">Website: <strong><?= e($currentUrl) ?></strong> <?= !empty($currentPlatform) ? '&middot; Platform: <strong>' . ucfirst(e($currentPlatform)) . '</strong>' : '' ?></span>
                            </div>
                        </div>
                        <div class="prefilled-banner-action">
                            <span class="prefilled-editable-badge" title="You can edit the URL or switch platforms at any time">Modifiable Below</span>
                        </div>
                    </div>
                <?php endif; ?>

                <form id="urlAnalyzerForm" class="url-input-form" onsubmit="return false;">
                    <div class="url-input-wrapper">
                        <div class="url-icon-prefix">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="websiteUrlInput" 
                            name="url" 
                            value="<?= e($currentUrl ?? '') ?>" 
                            placeholder="https://yourstore.com" 
                            autocomplete="url"
                            required
                        >
                        <button type="submit" id="btnAnalyzeUrl" class="btn-analyze-pill">
                            <span class="btn-text">Analyze Compatibility</span>
                            <span class="btn-spinner" style="display:none;"></span>
                            <svg class="btn-arrow" width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="8" x2="13" y2="8"></line>
                                <polyline points="9 4 13 8 9 12"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div id="urlFeedback" class="form-feedback-message" style="display:none;"></div>
                </form>
            </div>
        </section>

        <!-- STAGE 2: Supported Platform Selector -->
        <section class="analyzer-card platform-selector-section" id="platformSelectorSection">
            <div class="card-inner">
                <div class="section-title-row">
                    <div>
                        <span class="eyebrow-accent">STEP 1 OF 5</span>
                        <h2 class="card-heading">Select Your Platform</h2>
                        <p class="card-instruction">
                            Choose the eCommerce or CMS engine your website runs on to load the corresponding API setup guide.
                        </p>
                    </div>
                    <div id="suggestedPlatformBadge" class="suggested-badge-box" style="display:none;">
                        <span class="pulse-dot-green"></span>
                        <span class="suggested-text">Platform Auto-Detected</span>
                    </div>
                </div>

                <!-- 3 Platform Selectable Cards -->
                <div class="platforms-selector-grid">
                    <?php foreach ($platforms as $p): ?>
                        <div 
                            class="platform-select-card" 
                            data-platform="<?= e($p['key']) ?>"
                            tabindex="0"
                            role="button"
                            aria-pressed="false"
                        >
                            <div class="card-top-row">
                                <div class="platform-icon-wrap platform-icon-<?= e($p['key']) ?>">
                                    <?php if ($p['key'] === 'wordpress'): ?>
                                        <img src="<?= asset('icons/wordpress.svg') ?>" alt="WordPress" width="30" height="30">
                                    <?php elseif ($p['key'] === 'woocommerce'): ?>
                                        <img src="<?= asset('icons/woocommerce.svg') ?>" alt="WooCommerce" width="38" height="24">
                                    <?php elseif ($p['key'] === 'shopify'): ?>
                                        <img src="<?= asset('icons/shopify.svg') ?>" alt="Shopify" width="28" height="32">
                                    <?php endif; ?>
                                </div>
                                <div class="selection-indicator">
                                    <span class="radio-dot"></span>
                                </div>
                            </div>

                            <div class="platform-meta">
                                <h3 class="platform-heading"><?= e($p['name']) ?></h3>
                                <span class="platform-auth-type"><?= e($p['subtitle']) ?></span>
                            </div>

                            <div class="card-bottom-row">
                                <span class="badge-time">⏱ <?= e($p['setup_time']) ?></span>
                                <span class="platform-cta-arrow">&rarr;</span>
                            </div>

                            <!-- Suggestion Ribbon -->
                            <div class="suggested-ribbon" style="display:none;">
                                <span>Suggested</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- STAGE 3: Platform-Specific Setup Panel (Only One Platform Shown at a Time) -->
        <section class="analyzer-card setup-guide-section" id="setupGuideSection" style="display:none;">
            <div class="card-inner">
                
                <!-- Setup Header Bar with "Change Platform" -->
                <div class="setup-header-bar">
                    <button type="button" id="btnChangePlatform" class="btn-change-platform">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="13" y1="8" x2="3" y2="8"></line>
                            <polyline points="7 12 3 8 7 4"></polyline>
                        </svg>
                        <span>Change Platform</span>
                    </button>
                    <div class="setup-time-pill" id="guideSetupTime">
                        <span>⏱ Estimated: 2–5 minutes</span>
                    </div>
                </div>

                <div class="guide-banner-row">
                    <div>
                        <h2 class="guide-platform-title" id="guideTitle">Connect Your Website</h2>
                        <p class="guide-platform-desc" id="guideDescription"></p>
                    </div>
                </div>

                <!-- Platform Mismatch Warning Alert -->
                <div id="platformMismatchAlert" class="platform-mismatch-banner" style="display:none;"></div>

                <!-- Step-by-Step Accordion / Sequence -->
                <div class="guide-steps-container" id="guideStepsContainer">
                    <!-- Dynamic Steps Rendered by JS or PHP -->
                </div>

                <!-- API Credentials Input Form -->
                <div class="credentials-input-card">
                    <div class="credentials-header">
                        <div class="cred-icon-box">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="credentials-title">Enter API Credentials</h3>
                            <p class="credentials-sub">All credentials are encrypted and verified server-side. AppifyHub never asks for your normal admin password.</p>
                        </div>
                    </div>

                    <form id="credentialsForm" class="credentials-form" onsubmit="return false;">
                        <div id="dynamicFieldsContainer" class="dynamic-fields-grid">
                            <!-- Dynamic fields inserted by JS based on platform config -->
                        </div>

                        <!-- Verification Action Row -->
                        <div class="verification-action-row">
                            <button type="button" id="btnVerifyConnection" class="btn-verify-primary">
                                <span class="btn-verify-text">Verify Connection &rarr;</span>
                                <span class="btn-verify-spinner" style="display:none;"></span>
                            </button>
                            <button type="button" id="btnViewGuideAgain" class="btn-text-link" style="display:none;">
                                View Setup Guide Again
                            </button>
                        </div>

                        <!-- Verification Result Alert Box -->
                        <div id="verificationResultBox" class="verification-alert-box" style="display:none;">
                            <div class="alert-icon-box"></div>
                            <div class="alert-content-box">
                                <h4 class="alert-heading"></h4>
                                <p class="alert-message"></p>
                            </div>
                        </div>

                        <!-- Proceed to Compatibility Analysis Row -->
                        <div id="proceedAnalysisRow" class="proceed-analysis-row" style="display:none;">
                            <div class="verified-status-banner">
                                <span class="verified-check-circle">✓</span>
                                <div class="verified-banner-text">
                                    <strong>Connection Verified</strong>
                                    <span>API communication established. Ready for comprehensive website compatibility analysis.</span>
                                </div>
                            </div>
                            <button type="button" id="btnStartAnalysis" class="btn-analyze-site-pill">
                                <span>Analyze Website &rarr;</span>
                                <span class="btn-analyze-spinner" style="display:none;"></span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Security Note -->
                <div class="security-notice-callout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <span><strong>Enterprise-grade security:</strong> Your credentials are encrypted using AES-256-CBC and used exclusively for real-time app data synchronization.</span>
                </div>
            </div>
        </section>

        <!-- STAGE 4: Interactive Compatibility Analyzing Screen (Loading checks) -->
        <section class="analyzer-card analysis-running-section" id="analysisRunningSection" style="display:none;">
            <div class="card-inner text-center">
                <div class="analyzing-spinner-ring"></div>
                <h2 class="card-heading">Analyzing Website Compatibility</h2>
                <p class="card-instruction">Performing deep technical evaluation across SSL security, API endpoints, mobile responsiveness, and store data...</p>

                <div class="analysis-checklist-box">
                    <div class="check-item" id="checkSSL">
                        <span class="check-status-dot"></span>
                        <span class="check-title">HTTPS / SSL Encryption</span>
                    </div>
                    <div class="check-item" id="checkAPI">
                        <span class="check-status-dot"></span>
                        <span class="check-title">REST API Authentication &amp; Scope Access</span>
                    </div>
                    <div class="check-item" id="checkMobile">
                        <span class="check-status-dot"></span>
                        <span class="check-title">Mobile Viewport &amp; Layout Compatibility</span>
                    </div>
                    <div class="check-item" id="checkData">
                        <span class="check-status-dot"></span>
                        <span class="check-title">Content &amp; Product Data Structure</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- STAGE 5: Compatibility Result Report Card -->
        <section class="analyzer-card result-report-section" id="resultReportSection" style="display:none;">
            <div class="card-inner">
                
                <!-- Status Banner: Compatible vs Incompatible -->
                <div id="resultStatusBanner" class="result-status-banner">
                    <div class="score-circle-wrap">
                        <svg class="score-ring-svg" width="90" height="90" viewBox="0 0 100 100">
                            <circle class="ring-bg" cx="50" cy="50" r="42" fill="transparent" stroke="#E6DFD5" stroke-width="7"/>
                            <circle class="ring-progress" id="scoreRingProgress" cx="50" cy="50" r="42" fill="transparent" stroke="#B69A78" stroke-width="7" stroke-dasharray="264" stroke-dashoffset="30"/>
                        </svg>
                        <span class="score-display-number" id="resultScoreNum">95%</span>
                    </div>
                    <div class="status-copy">
                        <span class="status-eyebrow" id="resultStatusEyebrow">AUDIT COMPLETE</span>
                        <h2 class="status-heading" id="resultStatusTitle">Your Website Is Ready for an App ✓</h2>
                        <p class="status-summary" id="resultStatusSummary">All security, API, and mobile layout checks passed with flying colors.</p>
                    </div>
                </div>

                <!-- Parameters Metrics Grid -->
                <div class="result-metrics-grid" id="resultMetricsGrid">
                    <!-- Populated dynamically: Platform, SSL, API Connection, Data Access, Mobile Compatibility, App Readiness -->
                </div>

                <!-- Incompatible Issues Box (Shown only if not compatible) -->
                <div id="resultIssuesBox" class="result-issues-box" style="display:none;">
                    <div class="issues-box-header">
                        <h3 class="issues-heading">What We Found &amp; Recommended Solutions</h3>
                        <p class="issues-sub">Your website needs a few improvements before we can build your app:</p>
                    </div>
                    <div class="issues-list" id="resultIssuesList">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Final Call to Action Row -->
                <div class="result-cta-row" id="resultCtaRow">
                    <!-- Compatible CTA -->
                    <div id="compatibleCtaGroup" style="display:none;">
                        <a href="<?= url('/themes') ?>" id="btnProceedThemes" class="btn-cta-primary">
                            <span>Continue to Choose Your Theme &rarr;</span>
                        </a>
                    </div>

                    <!-- Incompatible CTA -->
                    <div id="incompatibleCtaGroup" style="display:none;">
                        <a href="<?= url('/website/improvement-form') ?>" id="btnRequestImprovements" class="btn-cta-warning">
                            <span>Request Website Improvements &rarr;</span>
                        </a>
                    </div>

                    <button type="button" id="btnRestartAudit" class="btn-secondary-link">
                        Analyze Another Website
                    </button>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Embedded Platform Configuration Data for Client-Side Interactivity -->
<script id="platformConfigsJson" type="application/json">
    <?= json_encode($platforms, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
</script>

<script src="<?= asset('js/analyzer.js') ?>?v=<?= file_exists(PUBLIC_PATH . '/assets/js/analyzer.js') ? filemtime(PUBLIC_PATH . '/assets/js/analyzer.js') : time() ?>"></script>
