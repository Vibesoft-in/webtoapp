<?php
/**
 * AppifyHub - How It Works Page
 * Dedicated Editorial Product-Explanation Guide
 * Scroll-Driven Step-by-Step Experience
 */
?>
<div class="hiw-page-wrapper">

    <!-- 1. HERO SECTION -->
    <section class="hiw-hero-section">
        <div class="hiw-container">
            <div class="hiw-hero-content">
                <div class="hiw-eyebrow-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>HOW APPIFYHUB WORKS</span>
                </div>
                <h1 class="hiw-hero-title">
                    From Your Website to <em>Your App</em>
                </h1>
                <p class="hiw-hero-subtitle">
                    See how AppifyHub analyzes your existing website, connects your business data, prepares your website for app integration, and turns it into a dedicated mobile experience.
                </p>
                <div class="hiw-hero-actions">
                    <a href="<?= url('/compatibility') ?>" class="btn-hiw-primary">
                        <span>Start With Your Website &rarr;</span>
                    </a>
                    <a href="#process-start" class="btn-hiw-secondary">
                        <span>Explore the Process &darr;</span>
                    </a>
                </div>
            </div>

            <!-- Hero Visual Showcase -->
            <div class="hiw-hero-visual-wrap">
                <div class="hiw-hero-media-frame">
                    <img src="<?= asset('images/how_it_works_hero.jpg') ?>" alt="From Website to API to Mobile App Architecture" class="hiw-hero-media-img" loading="eager">
                </div>
                <div class="hiw-hero-caption-strip">
                    <div class="hiw-caption-node">
                        <span class="caption-dot"></span>
                        <span class="caption-text">1. Existing Website</span>
                    </div>
                    <div class="hiw-caption-arrow">&rarr;</div>
                    <div class="hiw-caption-node">
                        <span class="caption-dot"></span>
                        <span class="caption-text">2. API Connection Layer</span>
                    </div>
                    <div class="hiw-caption-arrow">&rarr;</div>
                    <div class="hiw-caption-node">
                        <span class="caption-dot"></span>
                        <span class="caption-text">3. Dedicated Mobile App</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. INTRODUCTION: THE FOUNDATION -->
    <section class="hiw-intro-section" id="process-start">
        <div class="hiw-container">
            <div class="hiw-intro-box">
                <div class="hiw-section-badge">HOW IT WORKS</div>
                <h2 class="hiw-section-heading">Your Website Already Has the Foundation.</h2>
                <p class="hiw-intro-lead">
                    Your website already contains your products, content, customers, business information and workflows. AppifyHub connects the right parts of that existing system to a dedicated mobile app instead of forcing you to rebuild your business from scratch.
                </p>
                
                <div class="hiw-clarification-card">
                    <div class="clarification-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </div>
                    <div class="clarification-content">
                        <strong>Architecture Principle:</strong>
                        <span>The mobile app and website have separate, specialized user interfaces while sharing supported business data through secure APIs and integrations.</span>
                    </div>
                </div>

                <!-- Editorial Pipeline Diagram -->
                <div class="hiw-foundation-pipeline">
                    <div class="pipeline-card">
                        <span class="pipeline-step-num">01</span>
                        <h3 class="pipeline-title">Your Existing Website</h3>
                        <p class="pipeline-desc">Stores, catalog, articles, customers, and active orders.</p>
                    </div>
                    <div class="pipeline-connector">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                    <div class="pipeline-card highlight-card">
                        <span class="pipeline-step-num">02</span>
                        <h3 class="pipeline-title">AppifyHub Integration</h3>
                        <p class="pipeline-desc">Secure REST API bridge, credential auth &amp; schema mapping.</p>
                    </div>
                    <div class="pipeline-connector">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                    <div class="pipeline-card">
                        <span class="pipeline-step-num">03</span>
                        <h3 class="pipeline-title">Your Mobile App</h3>
                        <p class="pipeline-desc">High-performance iOS and Android native experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. INTRODUCTORY CONTENT BEFORE SCROLL WORKFLOW -->
    <section class="hiw-workflow-intro-section" id="workflow-start">
        <div class="hiw-container">
            <div class="hiw-workflow-intro-box">
                <span class="hiw-step-tag">END-TO-END CONVERSION WORKFLOW</span>
                <h2 class="hiw-workflow-heading">From Website to App</h2>
                <p class="hiw-workflow-desc">
                    Follow the complete process as AppifyHub takes your existing website through compatibility, integration, customization and app preparation.
                </p>
            </div>
        </div>
    </section>

    <!-- 4. STEP-BY-STEP SCROLL-DRIVEN EXPERIENCE -->
    <div class="hiw-scroll-story-wrapper" id="processStoryWrapper">
        
        <!-- 13 Invisible / Structural Scroll Triggers defining the vertical scroll track -->
        <div class="hiw-triggers-track" aria-hidden="true">
            <div class="hiw-scroll-trigger" id="step-01" data-step-index="0"></div>
            <div class="hiw-scroll-trigger" id="step-02" data-step-index="1"></div>
            <div class="hiw-scroll-trigger" id="step-03" data-step-index="2"></div>
            <div class="hiw-scroll-trigger" id="step-04" data-step-index="3"></div>
            <div class="hiw-scroll-trigger" id="step-05" data-step-index="4"></div>
            <div class="hiw-scroll-trigger" id="step-06" data-step-index="5"></div>
            <div class="hiw-scroll-trigger" id="step-07" data-step-index="6"></div>
            <div class="hiw-scroll-trigger" id="step-08" data-step-index="7"></div>
            <div class="hiw-scroll-trigger" id="step-09" data-step-index="8"></div>
            <div class="hiw-scroll-trigger" id="step-10" data-step-index="9"></div>
            <div class="hiw-scroll-trigger" id="step-11" data-step-index="10"></div>
            <div class="hiw-scroll-trigger" id="step-12" data-step-index="11"></div>
            <div class="hiw-scroll-trigger" id="step-13" data-step-index="12"></div>
        </div>

        <!-- Sticky Viewport Stage (Desktop: 30-35% Left, 65-70% Right) -->
        <div class="hiw-sticky-viewport">
            <div class="hiw-container hiw-sticky-grid">
                
                <!-- LEFT: PROCESS FLOW (Progress & Navigation Indicator) -->
                <aside class="hiw-process-nav" aria-label="Process Step Navigation">
                    <div class="hiw-nav-sticky-box">
                        <div class="hiw-nav-header-row">
                            <span class="nav-title">PROCESS FLOW</span>
                            <span class="nav-active-name-mobile" id="mobileStepName">01 — Enter Website</span>
                            <span class="nav-step-badge" id="navStepProgressBadge">01 / 13</span>
                        </div>
                        <ul class="hiw-nav-list" id="hiwNavList">
                            <li><a href="#step-01" class="hiw-nav-link active" data-step="0"><span>01</span> Enter Website</a></li>
                            <li><a href="#step-02" class="hiw-nav-link" data-step="1"><span>02</span> Platform Selection</a></li>
                            <li><a href="#step-03" class="hiw-nav-link" data-step="2"><span>03</span> Compatibility</a></li>
                            <li><a href="#step-04" class="hiw-nav-link" data-step="3"><span>04</span> Secure Connect</a></li>
                            <li><a href="#step-05" class="hiw-nav-link" data-step="4"><span>05</span> Technical Help</a></li>
                            <li><a href="#step-06" class="hiw-nav-link" data-step="5"><span>06</span> Choose Theme</a></li>
                            <li><a href="#step-07" class="hiw-nav-link" data-step="6"><span>07</span> Add Features</a></li>
                            <li><a href="#step-08" class="hiw-nav-link" data-step="7"><span>08</span> Data Connection</a></li>
                            <li><a href="#step-09" class="hiw-nav-link" data-step="8"><span>09</span> Independent App</a></li>
                            <li><a href="#step-10" class="hiw-nav-link" data-step="9"><span>10</span> Checkout</a></li>
                            <li><a href="#step-11" class="hiw-nav-link" data-step="10"><span>11</span> App Build</a></li>
                            <li><a href="#step-12" class="hiw-nav-link" data-step="11"><span>12</span> Testing</a></li>
                            <li><a href="#step-13" class="hiw-nav-link" data-step="12"><span>13</span> Launch</a></li>
                        </ul>
                    </div>
                </aside>

                <!-- RIGHT: SINGLE STAGE CONTENT WINDOW -->
                <main class="hiw-stage-column">
                    <div class="hiw-single-stage-window" id="hiwStageWindow" aria-live="polite">
                        
                        <!-- STEP 01: Enter Website -->
                        <article class="hiw-stage-panel is-active" data-index="0" id="panel-01">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">01</span>
                                <span class="hiw-step-tag">DISCOVERY &amp; INITIATION</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Start With the Website You Already Have</h2>
                                    <p class="hiw-step-desc">
                                        Enter your existing website URL and select the platform your business uses. We use your existing website as the starting point instead of asking you to build a completely new digital system.
                                    </p>
                                    <div class="hiw-step-bullets">
                                        <div class="bullet-item"><span class="bullet-check">&bull;</span><span>Supported platforms: <strong>WordPress</strong>, <strong>WooCommerce</strong>, and <strong>Shopify</strong>.</span></div>
                                        <div class="bullet-item"><span class="bullet-check">&bull;</span><span>Zero disruption to your live storefront or existing customer web traffic.</span></div>
                                    </div>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/compatibility') ?>" class="btn-step-action">
                                            <span>Check Compatibility &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-ui-mockup-card">
                                        <div class="mockup-header-row">
                                            <span class="mockup-dot"></span>
                                            <span class="mockup-dot"></span>
                                            <span class="mockup-dot"></span>
                                            <span class="mockup-title-sub">Website Analyzer</span>
                                        </div>
                                        <div class="mockup-input-box">
                                            <span class="mockup-icon">&#127760;</span>
                                            <span class="mockup-url-val">https://yourstore.com</span>
                                            <span class="mockup-pill-verified">HTTPS</span>
                                        </div>
                                        <div class="mockup-btn-preview">
                                            <span>Analyze Compatibility &rarr;</span>
                                        </div>
                                        <div class="mockup-footer-note">
                                            Instant server-side SSL check &amp; CMS platform detection.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 02: Platform Selection -->
                        <article class="hiw-stage-panel" data-index="1" id="panel-02">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">02</span>
                                <span class="hiw-step-tag">PLATFORM SELECTION</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-platform-triad">
                                        <a href="<?= url('/compatibility?platform=wordpress') ?>" class="hiw-platform-card">
                                            <div class="triad-logo-box">
                                                <img src="<?= asset('icons/wordpress.svg') ?>" alt="WordPress" width="32" height="32">
                                            </div>
                                            <div class="triad-info">
                                                <h4>WordPress</h4>
                                                <span>Any WordPress Website</span>
                                            </div>
                                            <span class="triad-badge">Native Sync</span>
                                        </a>
                                        <a href="<?= url('/compatibility?platform=woocommerce') ?>" class="hiw-platform-card">
                                            <div class="triad-logo-box">
                                                <img src="<?= asset('icons/woocommerce.svg') ?>" alt="WooCommerce" width="38" height="26">
                                            </div>
                                            <div class="triad-info">
                                                <h4>WooCommerce</h4>
                                                <span>Your Online Store</span>
                                            </div>
                                            <span class="triad-badge">Store Engine</span>
                                        </a>
                                        <a href="<?= url('/compatibility?platform=shopify') ?>" class="hiw-platform-card">
                                            <div class="triad-logo-box">
                                                <img src="<?= asset('icons/shopify.svg') ?>" alt="Shopify" width="28" height="34">
                                            </div>
                                            <div class="triad-info">
                                                <h4>Shopify</h4>
                                                <span>Your Shopify Store</span>
                                            </div>
                                            <span class="triad-badge">Direct Connect</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Choose Your Platform</h2>
                                    <p class="hiw-step-desc">
                                        AppifyHub supports tailored integration flows depending on how your website is built. Whether you run a content site on WordPress, an eCommerce catalog on WooCommerce, or a direct Shopify storefront, each engine uses its native API pipeline.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        The exact same verified compatibility engine is used throughout AppifyHub to ensure seamless authentication and schema continuity.
                                    </p>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/compatibility') ?>" class="btn-step-action">
                                            <span>Select Your Engine &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 03: Compatibility -->
                        <article class="hiw-stage-panel" data-index="2" id="panel-03">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">03</span>
                                <span class="hiw-step-tag">COMPATIBILITY VERIFICATION</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">We Check Before We Build</h2>
                                    <p class="hiw-step-desc">
                                        We don't simply wrap your website in an app container. First, our automated analyzer evaluates whether your website has the necessary technical foundation for a reliable, fast native mobile application.
                                    </p>
                                    <div class="hiw-audit-params-list">
                                        <div class="audit-param-pill"><span>Platform Architecture</span></div>
                                        <div class="audit-param-pill"><span>HTTPS / SSL Encryption</span></div>
                                        <div class="audit-param-pill"><span>REST API Availability</span></div>
                                        <div class="audit-param-pill"><span>API Authentication</span></div>
                                        <div class="audit-param-pill"><span>Mobile Viewport &amp; Layout</span></div>
                                        <div class="audit-param-pill"><span>Data Accessibility</span></div>
                                        <div class="audit-param-pill"><span>Product &amp; Content Taxonomy</span></div>
                                        <div class="audit-param-pill"><span>Navigation Integrity</span></div>
                                    </div>
                                    <p class="hiw-step-disclaimer">
                                        <em>Process guarantee:</em> Every compatibility parameter is diagnosed live against standard Web &amp; REST protocols.
                                    </p>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-report-card-preview">
                                        <div class="report-top-banner">
                                            <span class="report-badge">LIVE EVALUATION</span>
                                            <h4>Technical Readiness Checklist</h4>
                                        </div>
                                        <div class="report-items-table">
                                            <div class="report-row"><span class="item-name">Platform</span><span class="item-val is-good">&check; WordPress / WooCommerce / Shopify</span></div>
                                            <div class="report-row"><span class="item-name">SSL / HTTPS</span><span class="item-val is-good">&check; Active &amp; Valid Certificate</span></div>
                                            <div class="report-row"><span class="item-name">API Access</span><span class="item-val is-good">&check; Available &amp; Accessible</span></div>
                                            <div class="report-row"><span class="item-name">Mobile Responsiveness</span><span class="item-val is-good">&check; Compatible Viewport</span></div>
                                            <div class="report-row"><span class="item-name">Data Access</span><span class="item-val is-good">&check; Live Sync Ready</span></div>
                                            <div class="report-row"><span class="item-name">App Readiness</span><span class="item-val is-good">&check; Ready for Native Build</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 04: Secure Connect -->
                        <article class="hiw-stage-panel" data-index="3" id="panel-04">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">04</span>
                                <span class="hiw-step-tag">CREDENTIAL INTEGRATION</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-api-accordion-box">
                                        <div class="api-preview-card">
                                            <div class="acc-summary">
                                                <span class="acc-platform">WordPress REST API</span>
                                                <span class="acc-badge">Application Passwords</span>
                                            </div>
                                            <p class="acc-desc">Connects via standard application credentials. Does not store your master login password.</p>
                                        </div>
                                        <div class="api-preview-card">
                                            <div class="acc-summary">
                                                <span class="acc-platform">WooCommerce REST API</span>
                                                <span class="acc-badge">Read / Write Keys</span>
                                            </div>
                                            <p class="acc-desc">Direct Consumer Key &amp; Secret authentication generated in WooCommerce settings.</p>
                                        </div>
                                        <div class="api-preview-card">
                                            <div class="acc-summary">
                                                <span class="acc-platform">Shopify Admin API</span>
                                                <span class="acc-badge">Scoped Access</span>
                                            </div>
                                            <p class="acc-desc">Connects using custom app tokens with scoped access to products, orders and customers.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Connect Your Website Securely</h2>
                                    <p class="hiw-step-desc">
                                        Once your website passes initial checks, AppifyHub securely connects to the platform using its supported APIs and authentication methods.
                                    </p>
                                    <p class="hiw-step-desc">
                                        All credentials are encrypted server-side with AES-256-CBC, never exposed in frontend code, and only minimum necessary scopes are requested.
                                    </p>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/compatibility') ?>" class="btn-step-action">
                                            <span>View Compatibility Setup &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 05: Technical Help -->
                        <article class="hiw-stage-panel" data-index="4" id="panel-05">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">05</span>
                                <span class="hiw-step-tag hiw-tag-warning">NOT READY YET?</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">We Don't Just Say "Not Compatible."</h2>
                                    <p class="hiw-step-desc">
                                        If your website needs technical improvements before an app can be built, our analyzer pinpoints exactly what needs attention instead of leaving you with a dead end.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        Whether your store needs REST API endpoints enabled, SSL certificate installation, or viewport optimization, we provide specific guidance and an improvement request flow to prepare your site for app integration.
                                    </p>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/compatibility') ?>" class="btn-step-action btn-step-warning">
                                            <span>Request Website Improvements &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-needs-attention-card">
                                        <div class="attention-header">
                                            <span class="attention-icon">&excl;</span>
                                            <h4>Technical Diagnostics Sample</h4>
                                        </div>
                                        <div class="attention-items">
                                            <div class="attention-row is-warn"><span class="row-label">API Access</span><span class="row-status">&Delta; Needs configuration in admin</span></div>
                                            <div class="attention-row is-warn"><span class="row-label">Mobile Experience</span><span class="row-status">&Delta; Viewport meta tag needs tuning</span></div>
                                            <div class="attention-row is-ok"><span class="row-label">Required Data</span><span class="row-status">&check; Products &amp; inventory available</span></div>
                                        </div>
                                        <div class="attention-footer">
                                            We assist you in configuring requirements without forcing full rebuilds.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 06: Choose Theme -->
                        <article class="hiw-stage-panel" data-index="5" id="panel-06">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">06</span>
                                <span class="hiw-step-tag">DESIGN &amp; THEMES</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-theme-showcase-frame">
                                        <img src="<?= asset('images/theme_phones_showcase.jpg') ?>" alt="Native Mobile App Themes Showcase" class="hiw-theme-showcase-img" loading="lazy">
                                    </div>
                                    <div class="hiw-theme-badges-row">
                                        <span class="theme-pill">MINIMAL</span>
                                        <span class="theme-pill">MODERN</span>
                                        <span class="theme-pill">TRENDY</span>
                                        <span class="theme-pill">COMMERCE</span>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Choose How Your App Should Look</h2>
                                    <p class="hiw-step-desc">
                                        Once your website is ready, choose a professionally designed app theme that matches your brand identity, product presentation, and business aesthetics.
                                    </p>
                                    <div class="hiw-step-bullets">
                                        <div class="bullet-item"><span class="bullet-check">&bull;</span><span>Customizable brand colors, typography and logo assets.</span></div>
                                        <div class="bullet-item"><span class="bullet-check">&bull;</span><span>Native tab bars, smooth category sliders and curated hero banners.</span></div>
                                        <div class="bullet-item"><span class="bullet-check">&bull;</span><span>Optimized layouts tailored for eCommerce conversions and reading.</span></div>
                                    </div>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/themes') ?>" class="btn-step-action">
                                            <span>Explore Themes &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 07: Add Features -->
                        <article class="hiw-stage-panel" data-index="6" id="panel-07">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">07</span>
                                <span class="hiw-step-tag">MODULAR CAPABILITIES</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Your App. Your Features.</h2>
                                    <p class="hiw-step-desc">
                                        Every business needs different functionality. Choose only the features that make sense for your customers, keeping your app fast, lightweight, and clutter-free.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        Start with essential catalog synchronization and add push marketing, direct messaging, or loyalty systems whenever your business requires them.
                                    </p>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-features-editorial-grid">
                                        <div class="feature-editorial-item">
                                            <span class="feature-icon">&#128276;</span>
                                            <div><h4>Push Notifications</h4><p>Send instant order updates, flash deals, and cart reminders directly to device lock screens.</p></div>
                                        </div>
                                        <div class="feature-editorial-item">
                                            <span class="feature-icon">&#128172;</span>
                                            <div><h4>WhatsApp Chat</h4><p>Enable one-tap customer support and inquiry chats straight from the product screen.</p></div>
                                        </div>
                                        <div class="feature-editorial-item">
                                            <span class="feature-icon">&#128200;</span>
                                            <div><h4>Analytics &amp; Metrics</h4><p>Track in-app conversions, user journeys, retention rates, and active screens.</p></div>
                                        </div>
                                        <div class="feature-editorial-item">
                                            <span class="feature-icon">&#127991;</span>
                                            <div><h4>Coupons &amp; Offers</h4><p>Redeem exclusive in-app discount vouchers and flash sale codes at native checkout.</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 08: Data Connection -->
                        <article class="hiw-stage-panel" data-index="7" id="panel-08">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">08</span>
                                <span class="hiw-step-tag">DATA ARCHITECTURE</span>
                            </div>
                            <div class="hiw-architecture-header-center">
                                <h2 class="hiw-step-heading">One Business. Connected Data.</h2>
                                <p class="hiw-step-desc">
                                    Your website and app do not need completely separate business databases. The app connects to existing business data through APIs and integrations, avoiding duplicate data systems.
                                </p>
                            </div>
                            <div class="hiw-data-diagram-card">
                                <div class="diagram-top-node">
                                    <div class="diagram-badge-title"><span class="db-icon">&#128452;</span><strong>EXISTING BUSINESS DATA</strong></div>
                                    <div class="diagram-entities-chips"><span>Products</span><span>Orders</span><span>Customers</span><span>Categories</span><span>Inventory</span></div>
                                </div>
                                <div class="diagram-conduit-bridge">
                                    <span class="conduit-line"></span>
                                    <div class="conduit-label-box"><span class="conduit-pulse"></span><span>SECURE REST API &amp; WEBHOOK BRIDGE</span></div>
                                    <span class="conduit-line"></span>
                                </div>
                                <div class="diagram-destinations-row">
                                    <div class="dest-col">
                                        <div class="dest-card"><span class="dest-type">BROWSER DESKTOP &amp; MOBILE</span><h4>Website Storefront</h4><p>Continues operating normally without schema changes or database migration.</p></div>
                                    </div>
                                    <div class="dest-sync-indicator"><span>&harr; Live Sync &harr;</span></div>
                                    <div class="dest-col">
                                        <div class="dest-card highlight-dest"><span class="dest-type">NATIVE IOS &amp; ANDROID</span><h4>AppifyHub Mobile App</h4><p>Accesses identical inventory, user accounts, and order histories directly via API.</p></div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 09: Independent App -->
                        <article class="hiw-stage-panel" data-index="8" id="panel-09">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">09</span>
                                <span class="hiw-step-tag">INDEPENDENT INTERFACES</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Your Website Can Change Without Rebuilding Your App</h2>
                                    <p class="hiw-step-desc">
                                        Your website and mobile app are designed as separate user experiences. Frontend changes to your website generally do not change the app's UI because the two interfaces are decoupled.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        Redesigning your website's header, banner images, or landing page layout will not disrupt your app's native navigation or mobile performance.
                                    </p>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-decoupled-ui-card">
                                        <div class="decoupled-box">
                                            <div class="ui-panel left-panel">
                                                <div class="panel-header">Website UI</div>
                                                <p class="panel-desc">Desktop &amp; Mobile Responsive Web Frontend</p>
                                            </div>
                                            <div class="decoupled-vs-divider">
                                                <span>&ne;</span>
                                                <small>Separate UI</small>
                                            </div>
                                            <div class="ui-panel right-panel">
                                                <div class="panel-header">Mobile App UI</div>
                                                <p class="panel-desc">Native Swift &amp; Kotlin Mobile Interface</p>
                                            </div>
                                        </div>
                                        <div class="decoupled-bridge-footer">
                                            <span class="bridge-check">&check;</span>
                                            <span>Both connected to the same live product &amp; order data via REST APIs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 10: Checkout -->
                        <article class="hiw-stage-panel" data-index="9" id="panel-10">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">10</span>
                                <span class="hiw-step-tag">ORDER &amp; CHECKOUT</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-checkout-mockup-card">
                                        <div class="checkout-mockup-header">
                                            <span class="cart-icon">&#128722;</span>
                                            <h4>Configuration Summary</h4>
                                        </div>
                                        <div class="checkout-line-items">
                                            <div class="checkout-row"><span>Selected Platform (WooCommerce / Shopify)</span><span class="row-price">Connected</span></div>
                                            <div class="checkout-row"><span>App Theme (Modern Minimalist)</span><span class="row-price">Included</span></div>
                                            <div class="checkout-row"><span>Push Notifications &amp; WhatsApp Integration</span><span class="row-price">Selected</span></div>
                                            <div class="checkout-row is-total"><span>Total App Package</span><span class="row-total-val">Transparent Plan</span></div>
                                        </div>
                                        <div class="checkout-note">
                                            Prices dynamically calculated from our database-driven pricing tier.
                                        </div>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Transparent Ordering &amp; Secure Checkout</h2>
                                    <p class="hiw-step-desc">
                                        Before completing your order, review every detail: selected platform, native theme, configured feature set, add-ons, publishing options, and total price.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        Complete payment securely via integrated gateways (Razorpay / Stripe) with server-side HMAC verification. No surprise fees or hidden sales commissions.
                                    </p>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/pricing') ?>" class="btn-step-action">
                                            <span>View Pricing Plans &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 11: App Build -->
                        <article class="hiw-stage-panel" data-index="10" id="panel-11">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">11</span>
                                <span class="hiw-step-tag">BUILD &amp; PACKAGING</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-build-pipeline-card">
                                        <div class="pipeline-flow-vertical">
                                            <div class="flow-stage is-done"><span class="stage-num">&check;</span><span class="stage-name">Configuration Validation</span></div>
                                            <div class="flow-stage is-done"><span class="stage-num">&check;</span><span class="stage-name">API Integration &amp; Secrets Injected</span></div>
                                            <div class="flow-stage is-active"><span class="stage-num">&bull;</span><span class="stage-name">Native Binary Compilation (Android &amp; iOS)</span></div>
                                            <div class="flow-stage"><span class="stage-num">&bull;</span><span class="stage-name">Automated Quality Checks</span></div>
                                            <div class="flow-stage"><span class="stage-num">&bull;</span><span class="stage-name">Artifact Delivery &amp; Publishing Prep</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">We Prepare Your App</h2>
                                    <p class="hiw-step-desc">
                                        After payment and configuration, the selected setup enters our preparation and compilation pipeline.
                                    </p>
                                    <p class="hiw-step-desc">
                                        Depending on your selected package, this includes generating Android APK / AAB binaries, compiling iOS release packages, injecting app icons, branding splash screens, and binding push notification keys.
                                    </p>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 12: Testing -->
                        <article class="hiw-stage-panel" data-index="11" id="panel-12">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">12</span>
                                <span class="hiw-step-tag">QUALITY ASSURANCE</span>
                            </div>
                            <div class="hiw-step-grid">
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Test Before You Go Live</h2>
                                    <p class="hiw-step-desc">
                                        Every generated app is rigorously tested against your live website integration and selected features before final delivery or submission to Google Play and Apple App Store.
                                    </p>
                                    <div class="hiw-qa-checklist">
                                        <div class="qa-item"><span class="qa-mark">&check;</span><span>Smooth native bottom navigation &amp; deep linking</span></div>
                                        <div class="qa-item"><span class="qa-mark">&check;</span><span>Real-time catalog synchronization &amp; image caching</span></div>
                                        <div class="qa-item"><span class="qa-mark">&check;</span><span>Cart, checkout, and payment gateway functionality</span></div>
                                        <div class="qa-item"><span class="qa-mark">&check;</span><span>Push notification delivery on physical devices</span></div>
                                    </div>
                                </div>
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-qa-pipeline-card">
                                        <div class="qa-stages-row">
                                            <div class="qa-stage-box"><span class="qa-stage-label">BUILD</span><strong>Compiled</strong></div>
                                            <span class="qa-arrow">&rarr;</span>
                                            <div class="qa-stage-box"><span class="qa-stage-label">TEST</span><strong>Verified</strong></div>
                                            <span class="qa-arrow">&rarr;</span>
                                            <div class="qa-stage-box"><span class="qa-stage-label">REVIEW</span><strong>Approved</strong></div>
                                            <span class="qa-arrow">&rarr;</span>
                                            <div class="qa-stage-box is-highlight"><span class="qa-stage-label">FINALIZE</span><strong>Ready</strong></div>
                                        </div>
                                        <div class="qa-badge-note">
                                            Full quality assurance guarantee prior to store publication.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- STEP 13: Launch -->
                        <article class="hiw-stage-panel" data-index="12" id="panel-13">
                            <div class="hiw-step-meta">
                                <span class="hiw-step-num">13</span>
                                <span class="hiw-step-tag">STORE PUBLICATION</span>
                            </div>
                            <div class="hiw-step-grid hiw-grid-reversed">
                                <div class="hiw-step-visual-col">
                                    <div class="hiw-launch-showcase-card">
                                        <div class="launch-icon-badge">&#128640;</div>
                                        <h4>Published to Your Store Accounts</h4>
                                        <p>Google Play Store &amp; Apple App Store listings are published under your company developer account for 100% brand ownership.</p>
                                        <div class="launch-badges-row">
                                            <span class="launch-pill">Google Play Ready</span>
                                            <span class="launch-pill">Apple App Store Ready</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hiw-step-text-col">
                                    <h2 class="hiw-step-heading">Launch &amp; Scale Your Mobile Channel</h2>
                                    <p class="hiw-step-desc">
                                        Your app is delivered, signed, and ready for deployment. Your customers can download your native app directly from the App Store and Google Play.
                                    </p>
                                    <p class="hiw-step-subtext">
                                        Enjoy higher conversion rates, instant push notifications, and loyal returning customers—all powered by your existing website foundation.
                                    </p>
                                    <div class="hiw-step-action-row">
                                        <a href="<?= url('/compatibility') ?>" class="btn-step-action">
                                            <span>Begin With Your Website &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </main>

            </div>
        </div>

    </div>

    <!-- 5. FINAL RESULT FULL-WIDTH SHOWCASE -->
    <section class="hiw-final-result-section">
        <div class="hiw-container">
            <div class="hiw-result-showcase-box">
                <span class="hiw-eyebrow-accent">THE OUTCOME</span>
                <h2 class="hiw-result-heading">Your Website. Now in an App.</h2>
                <p class="hiw-result-lead">
                    You already built your business online. AppifyHub helps turn that existing foundation into a dedicated mobile experience without rebuilding everything from scratch.
                </p>
                
                <div class="hiw-result-diagram-row">
                    <div class="result-node">
                        <span class="node-tag">FOUNDATION</span>
                        <h4>Existing Website</h4>
                        <p>WordPress &middot; WooCommerce &middot; Shopify</p>
                    </div>
                    <div class="result-divider-arrow">&rarr;</div>
                    <div class="result-node highlight-node">
                        <span class="node-tag">TECHNOLOGY</span>
                        <h4>API Data Bridge</h4>
                        <p>Real-Time REST Synchronization</p>
                    </div>
                    <div class="result-divider-arrow">&rarr;</div>
                    <div class="result-node">
                        <span class="node-tag">EXPERIENCE</span>
                        <h4>Dedicated Mobile App</h4>
                        <p>iOS &middot; Android &middot; High Conversion</p>
                    </div>
                </div>

                <div class="hiw-result-cta-wrap">
                    <a href="<?= url('/compatibility') ?>" class="btn-hiw-primary btn-large">
                        <span>Check Website Compatibility &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Sensitive, Zero-Overlap Step-by-Step Experience Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('processStoryWrapper');
    if (!wrapper) return;

    const navLinks = Array.from(document.querySelectorAll('#hiwNavList .hiw-nav-link'));
    const panels = Array.from(document.querySelectorAll('.hiw-stage-panel'));
    const progressBadge = document.getElementById('navStepProgressBadge');
    const mobileStepName = document.getElementById('mobileStepName');

    const totalSteps = panels.length; // 13 steps
    if (totalSteps === 0) return;

    let currentStepIndex = 0;
    let isTransitioning = false;
    let wheelCooldown = false;
    let wheelDeltaAccumulator = 0;
    const WHEEL_THRESHOLD = 30; // High sensitivity: 1 gentle wheel tick advances 1 step

    function getStickyTopOffset() {
        return window.innerWidth <= 1024 ? 70 : 75;
    }

    // Activate a step cleanly with zero ghost overlap
    function activateStep(nextIdx, direction = 'down') {
        if (nextIdx < 0 || nextIdx >= totalSteps || nextIdx === currentStepIndex) return;
        if (isTransitioning) return;

        isTransitioning = true;
        const prevIdx = currentStepIndex;
        currentStepIndex = nextIdx;

        // Perform clean, solid transition between the two steps
        panels.forEach((panel, i) => {
            if (i === prevIdx) {
                panel.classList.remove('is-active');
                panel.classList.add(direction === 'down' ? 'is-exiting-up' : 'is-exiting-down');
            } else if (i === nextIdx) {
                panel.classList.remove('is-exiting-up', 'is-exiting-down');
                panel.classList.add('is-active');
                panel.style.visibility = 'visible';
                panel.style.opacity = '1';
                panel.style.pointerEvents = 'auto';
            } else {
                panel.classList.remove('is-active', 'is-exiting-up', 'is-exiting-down');
                panel.style.visibility = 'hidden';
                panel.style.opacity = '0';
                panel.style.pointerEvents = 'none';
            }
        });

        // Update left navigation UI
        updateNavUI(nextIdx);

        // After animation completes (280ms), clean up exiting state
        setTimeout(() => {
            panels.forEach((panel, i) => {
                if (i !== currentStepIndex) {
                    panel.classList.remove('is-exiting-up', 'is-exiting-down');
                    panel.style.visibility = 'hidden';
                    panel.style.opacity = '0';
                    panel.style.pointerEvents = 'none';
                }
            });
            isTransitioning = false;
        }, 290);
    }

    // Update left process navigation links and progress badge
    function updateNavUI(stepIdx) {
        navLinks.forEach((link, idx) => {
            link.classList.toggle('active', idx === stepIdx);
        });

        const padNum = String(stepIdx + 1).padStart(2, '0');
        if (progressBadge) progressBadge.textContent = padNum + ' / 13';
        if (mobileStepName) {
            const linkText = navLinks[stepIdx]?.innerText || '';
            mobileStepName.textContent = linkText.replace(/^\s*(\d{2})\s*/, '$1 — ');
        }

        // Keep hash in sync
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', '#step-' + padNum);
        }
    }

    // Initial setup: activate step 0 cleanly
    panels.forEach((panel, i) => {
        if (i === 0) {
            panel.classList.add('is-active');
            panel.style.visibility = 'visible';
            panel.style.opacity = '1';
            panel.style.pointerEvents = 'auto';
        } else {
            panel.classList.remove('is-active', 'is-exiting-up', 'is-exiting-down');
            panel.style.visibility = 'hidden';
            panel.style.opacity = '0';
            panel.style.pointerEvents = 'none';
        }
    });
    updateNavUI(0);

    // HIGH SENSITIVITY WHEEL EVENT LISTENER
    // Automatically intercepts wheel scroll when the stage is in view
    window.addEventListener('wheel', function(e) {
        const rect = wrapper.getBoundingClientRect();
        const topOffset = getStickyTopOffset();

        // Stage is active when its top is at/near sticky position and still in view
        const isStageInView = rect.top <= (topOffset + 30) && rect.bottom >= (window.innerHeight - 30);

        if (!isStageInView) {
            wheelDeltaAccumulator = 0;
            return;
        }

        // Scrolling DOWN
        if (e.deltaY > 0) {
            if (currentStepIndex < totalSteps - 1) {
                // Advance 1 step
                e.preventDefault();
                wheelDeltaAccumulator += e.deltaY;

                if (wheelDeltaAccumulator >= WHEEL_THRESHOLD && !isTransitioning && !wheelCooldown) {
                    wheelDeltaAccumulator = 0;
                    wheelCooldown = true;
                    activateStep(currentStepIndex + 1, 'down');
                    setTimeout(() => { wheelCooldown = false; }, 300);
                }
            } else {
                // At final step (13): let user scroll down naturally past the stage
                wheelDeltaAccumulator = 0;
            }
        }
        // Scrolling UP
        else if (e.deltaY < 0) {
            if (currentStepIndex > 0) {
                // Reverse 1 step
                e.preventDefault();
                wheelDeltaAccumulator += e.deltaY;

                if (wheelDeltaAccumulator <= -WHEEL_THRESHOLD && !isTransitioning && !wheelCooldown) {
                    wheelDeltaAccumulator = 0;
                    wheelCooldown = true;
                    activateStep(currentStepIndex - 1, 'up');
                    setTimeout(() => { wheelCooldown = false; }, 300);
                }
            } else {
                // At first step (01): let user scroll up naturally to previous sections
                wheelDeltaAccumulator = 0;
            }
        }
    }, { passive: false });

    // Click on left process flow links: directly jump to clicked step
    navLinks.forEach((link, idx) => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            if (idx !== currentStepIndex) {
                activateStep(idx, idx > currentStepIndex ? 'down' : 'up');
            }
        });
    });

    // Touch swipe support for mobile
    let touchStartY = 0;
    wrapper.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            touchStartY = e.touches[0].clientY;
        }
    }, { passive: true });

    wrapper.addEventListener('touchend', function(e) {
        if (e.changedTouches.length === 1) {
            const touchEndY = e.changedTouches[0].clientY;
            const diff = touchStartY - touchEndY;
            if (Math.abs(diff) > 35 && !isTransitioning) {
                if (diff > 0 && currentStepIndex < totalSteps - 1) {
                    activateStep(currentStepIndex + 1, 'down');
                } else if (diff < 0 && currentStepIndex > 0) {
                    activateStep(currentStepIndex - 1, 'up');
                }
            }
        }
    }, { passive: true });

    // Keyboard navigation (ArrowDown / ArrowUp)
    window.addEventListener('keydown', function(e) {
        const rect = wrapper.getBoundingClientRect();
        const topOffset = getStickyTopOffset();
        const isStageInView = rect.top <= (topOffset + 40) && rect.bottom >= (window.innerHeight - 40);

        if (!isStageInView) return;

        if (e.key === 'ArrowDown' || e.key === 'PageDown') {
            if (currentStepIndex < totalSteps - 1) {
                e.preventDefault();
                activateStep(currentStepIndex + 1, 'down');
            }
        } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
            if (currentStepIndex > 0) {
                e.preventDefault();
                activateStep(currentStepIndex - 1, 'up');
            }
        }
    });

    // Deep linking URL hash check (e.g. #step-06)
    const initialHash = window.location.hash.replace('#', '');
    const hashMatch = initialHash.match(/^step-(\d{2})$/);
    if (hashMatch) {
        const stepNum = parseInt(hashMatch[1], 10);
        if (stepNum >= 1 && stepNum <= totalSteps) {
            setTimeout(() => activateStep(stepNum - 1, 'down'), 150);
        }
    }
});
</script>
