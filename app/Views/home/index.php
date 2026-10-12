<!-- AppifyHub Home Page -->
<div class="home-page-wrapper">

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <span class="eyebrow-tag">WEBSITE &rarr; MOBILE APP</span>
                <h1 class="hero-heading">
                    Your Websiteeeeeeeeeee.<br>
                    Now in an <em>App</em>.
                </h1>
                <p class="hero-description">
                    Turn your WordPress, WooCommerce or Shopify website into a beautiful mobile app &mdash; quickly, easily and without coding.
                </p>
                <div class="hero-action">
                    <a href="<?= url('/convert') ?>" class="btn-action-pill">
                        <span>Convert My Website</span>
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="8" x2="13" y2="8"></line>
                            <polyline points="9 4 13 8 9 12"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. PLATFORMS & TRUST ECOSYSTEM SECTION -->
    <section class="trust-platforms-section">
        <div class="trust-platforms-container">
            
            <!-- Section Eyebrow -->
            <div class="trust-intro-bar">
                <span class="trust-eyebrow">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Supported Platforms &amp; Native Sync
                </span>
            </div>

            <!-- Platforms Row: 3 Elevated Interactive Cards -->
            <div class="platforms-cards-strip">
                <!-- WordPress Card -->
                <a href="<?= url('/convert?platform=wordpress') ?>" class="platform-pill-card platform-pill-card-wp" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="platform-main-info">
                        <div class="platform-logo-badge">
                            <img src="<?= asset('icons/wordpress.svg') ?>" alt="WordPress Logo" class="platform-logo-img platform-logo-wordpress" width="34" height="34">
                        </div>
                        <div class="platform-details">
                            <span class="platform-name">WordPress</span>
                            <span class="platform-sub">Any WordPress Website</span>
                        </div>
                    </div>
                    <span class="platform-badge-pill">Native Sync</span>
                </a>

                <!-- WooCommerce Card -->
                <a href="<?= url('/convert?platform=woocommerce') ?>" class="platform-pill-card platform-pill-card-woo" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="platform-main-info">
                        <div class="platform-logo-badge">
                            <img src="<?= asset('icons/woocommerce.svg') ?>" alt="WooCommerce Logo" class="platform-logo-img platform-logo-woocommerce" width="44" height="28">
                        </div>
                        <div class="platform-details">
                            <span class="platform-name">WooCommerce</span>
                            <span class="platform-sub">Your Online Store</span>
                        </div>
                    </div>
                    <span class="platform-badge-pill">Store Engine</span>
                </a>

                <!-- Shopify Card -->
                <a href="<?= url('/convert?platform=shopify') ?>" class="platform-pill-card platform-pill-card-shopify" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="platform-main-info">
                        <div class="platform-logo-badge">
                            <img src="<?= asset('icons/shopify.svg') ?>" alt="Shopify Logo" class="platform-logo-img platform-logo-shopify" width="30" height="36">
                        </div>
                        <div class="platform-details">
                            <span class="platform-name">Shopify</span>
                            <span class="platform-sub">Your Shopify Store</span>
                        </div>
                    </div>
                    <span class="platform-badge-pill">Direct Connect</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. WHY CHOOSE APPIFYHUB SECTION -->
    <section class="why-choose-section" id="why-choose">
        <div class="why-choose-container">
            <!-- Section Header (Clean & Compact) -->
            <div class="why-choose-header">
                <div class="why-choose-eyebrow-row">
                    <span class="why-choose-eyebrow-line"></span>
                    <span class="why-choose-eyebrow-pill">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        WHY CHOOSE US
                    </span>
                    <span class="why-choose-eyebrow-line"></span>
                </div>
                <h2 class="why-choose-title">Why Choose <em>AppifyHub</em>?</h2>
            </div>

            <!-- Content Layout: 3D Visual on Left, 6 Compact Cards Grid on Right -->
            <div class="why-choose-content-layout">
                <!-- Left Visual Showcase Column -->
                <div class="why-choose-visual-col">
                    <div class="why-visual-frame">
                        <div class="why-visual-inner">
                            <img src="<?= asset('images/why_choose_devices.jpg') ?>" alt="Seamless Website and Mobile App Synchronization" class="why-visual-img" loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Right Cards Grid: 2 columns x 3 rows (Balanced) -->
                <div class="why-choose-cards-grid">
                    <!-- Card 01 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">01</span>
                                <h3 class="why-card-title">Same Database</h3>
                            </div>
                            <p class="why-card-desc">Live database sync with zero delays.</p>
                        </div>
                    </div>

                    <!-- Card 02 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="12" rx="2"></rect>
                                <line x1="2" y1="20" x2="22" y2="20"></line>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">02</span>
                                <h3 class="why-card-title">Independent App Experience</h3>
                            </div>
                            <p class="why-card-desc">Web updates never alter your mobile app.</p>
                        </div>
                    </div>

                    <!-- Card 03 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 8h4v-2a2 2 0 1 1 4 0v2h4a2 2 0 0 1 2 2v4h-2a2 2 0 1 0 0 4h2v4a2 2 0 0 1-2 2h-4v-2a2 2 0 1 0-4 0v2H4a2 2 0 0 1-2-2v-4h2a2 2 0 1 0 0-4H2v-4a2 2 0 0 1 2-2z"></path>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">03</span>
                                <h3 class="why-card-title">Add Features Your Way</h3>
                            </div>
                            <p class="why-card-desc">Push alerts, WhatsApp, loyalty and coupons.</p>
                        </div>
                    </div>

                    <!-- Card 04 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">04</span>
                                <h3 class="why-card-title">We Check Before We Build</h3>
                            </div>
                            <p class="why-card-desc">Deep audit for seamless app compatibility.</p>
                        </div>
                    </div>

                    <!-- Card 05 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">05</span>
                                <h3 class="why-card-title">App-Ready Setup</h3>
                            </div>
                            <p class="why-card-desc">API tuning and speed optimization.</p>
                        </div>
                    </div>

                    <!-- Card 06 -->
                    <div class="why-card">
                        <div class="why-card-icon-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <div class="why-card-body">
                            <div class="why-card-header">
                                <span class="why-card-num">06</span>
                                <h3 class="why-card-title">Built Around Your Business</h3>
                            </div>
                            <p class="why-card-desc">Modern themes tailored to your brand.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. VERIFIED TRACK RECORD SECTION -->
    <section class="verified-metrics-section">
        <div class="verified-metrics-container">
            <!-- Subtle Section Divider -->
            <div class="trust-subtle-divider">
                <span class="trust-divider-line"></span>
                <span class="trust-divider-chip">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    Verified Track Record
                </span>
                <span class="trust-divider-line"></span>
            </div>

            <!-- Impact Metrics Row: 4 Balanced Cards -->
            <div class="metrics-grid">
                <!-- Stat 1 -->
                <div class="metric-box">
                    <div class="metric-icon-wrap">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                        </svg>
                    </div>
                    <span class="metric-number">2,500<span class="metric-accent">+</span></span>
                    <span class="metric-label">Mobile Apps Built</span>
                    <span class="metric-sub">Android &amp; iOS Apps</span>
                </div>

                <!-- Stat 2 -->
                <div class="metric-box">
                    <div class="metric-icon-wrap">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </div>
                    <span class="metric-number">99.8<span class="metric-accent">%</span></span>
                    <span class="metric-label">Store Approval Rate</span>
                    <span class="metric-sub">Google &amp; Apple Compliant</span>
                </div>

                <!-- Stat 3 -->
                <div class="metric-box">
                    <div class="metric-icon-wrap">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                    </div>
                    <span class="metric-number">3.4<span class="metric-accent">x</span></span>
                    <span class="metric-label">Conversion Boost</span>
                    <span class="metric-sub">Vs. Mobile Browser</span>
                </div>

                <!-- Stat 4 -->
                <div class="metric-box">
                    <div class="metric-icon-wrap">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <span class="metric-number"><span class="metric-accent">&lt;</span> 15<span class="metric-accent">m</span></span>
                    <span class="metric-label">Average Setup Time</span>
                    <span class="metric-sub">Zero Code Required</span>
                </div>
            </div>

        </div>
    </section>

    <!-- 5. HOW IT WORKS SECTION -->
    <section class="how-it-works-section" id="how-it-works">
        <div class="how-container">
            <!-- Left Lifestyle Visual -->
            <div class="how-visual">
                <div class="how-image-frame">
                    <img src="<?= asset('images/how_it_works_converter.png') ?>" alt="From Website to App illustration showing laptop converting to mobile app" class="img-responsive" loading="lazy">
                </div>
            </div>

            <!-- Right Step Process -->
            <div class="how-content">
                <span class="eyebrow-tag">HOW IT WORKS</span>
                <h2 class="section-heading">From Website to App<br>in Simple Steps</h2>

                <div class="steps-timeline">
                    <!-- Step 01 -->
                    <div class="step-card">
                        <div class="step-marker">
                            <div class="step-icon-bubble">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="step-number">01</div>
                        <div class="step-text">
                            <h3 class="step-title">Enter Website</h3>
                            <p class="step-desc">Add your existing website URL.</p>
                        </div>
                    </div>

                    <!-- Step 02 -->
                    <div class="step-card">
                        <div class="step-marker">
                            <div class="step-icon-bubble">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="step-number">02</div>
                        <div class="step-text">
                            <h3 class="step-title">Analyze</h3>
                            <p class="step-desc">We check your website's compatibility.</p>
                        </div>
                    </div>

                    <!-- Step 03 -->
                    <div class="step-card">
                        <div class="step-marker">
                            <div class="step-icon-bubble">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="13.5" cy="6.5" r=".5" fill="#78593D"></circle>
                                    <circle cx="17.5" cy="10.5" r=".5" fill="#78593D"></circle>
                                    <circle cx="8.5" cy="7.5" r=".5" fill="#78593D"></circle>
                                    <circle cx="6.5" cy="12.5" r=".5" fill="#78593D"></circle>
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="step-number">03</div>
                        <div class="step-text">
                            <h3 class="step-title">Choose Theme</h3>
                            <p class="step-desc">Select a design and features for your app.</p>
                        </div>
                    </div>

                    <!-- Step 04 -->
                    <div class="step-card">
                        <div class="step-marker">
                            <div class="step-icon-bubble">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="step-number">04</div>
                        <div class="step-text">
                            <h3 class="step-title">Make Payment</h3>
                            <p class="step-desc">Complete your order securely.</p>
                        </div>
                    </div>

                    <!-- Step 05 -->
                    <div class="step-card">
                        <div class="step-marker">
                            <div class="step-icon-bubble">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="step-number">05</div>
                        <div class="step-text">
                            <h3 class="step-title">Get Your App</h3>
                            <p class="step-desc">Receive your Android & iOS app.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. NATIVE CAPABILITIES & FEATURES GRID -->
    <section class="features-grid-section" id="features">
        <div class="features-container">
            <div class="features-header text-center">
                <span class="eyebrow-tag">BUILT FOR MOBILE PERFORMANCE</span>
                <h2 class="section-heading">Everything You Need in a Native App</h2>
                <p class="section-subheading">Don't settle for sluggish web wrappers. AppifyHub builds high-speed, native mobile experiences that elevate your brand and drive repeat purchases.</p>
            </div>

            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <span class="feature-badge">70% Open Rate</span>
                    <h3 class="feature-title">Instant Push Notifications</h3>
                    <p class="feature-desc">Re-engage cart abandoners and send personalized alerts for flash sales, back-in-stock items, and order updates straight to user lockscreens.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 004 11m0 0a8 8 0 008 8c.706 0 1.396-.062 2.064-.18"></path>
                        </svg>
                    </div>
                    <span class="feature-badge">1-Tap Login</span>
                    <h3 class="feature-title">Biometric Authentication</h3>
                    <p class="feature-desc">Frictionless FaceID and Fingerprint access allows return shoppers to browse and check out instantly without typing passwords.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg>
                    </div>
                    <span class="feature-badge">Bidirectional</span>
                    <h3 class="feature-title">Real-Time Catalog Sync</h3>
                    <p class="feature-desc">All products, inventories, pricing, discounts, and customer orders stay in synchronized lockstep with your website database.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path>
                        </svg>
                    </div>
                    <span class="feature-badge">60fps Smooth</span>
                    <h3 class="feature-title">Offline Browsing &amp; Cache</h3>
                    <p class="feature-desc">Smart client caching ensures fast navigation, smooth animations, and product catalog browsing even with intermittent mobile signals.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                    </div>
                    <span class="feature-badge">3x Conversion</span>
                    <h3 class="feature-title">Native 1-Click Checkout</h3>
                    <p class="feature-desc">Streamlined checkout with support for Apple Pay, Google Pay, Razorpay, Stripe, and saved addresses dramatically slashes checkout abandonment.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#78593D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <span class="feature-badge">99.8% Passed</span>
                    <h3 class="feature-title">App Store &amp; Play Store Ready</h3>
                    <p class="feature-desc">Receive fully compliant Google Play (.aab) and iOS (.ipa) builds with end-to-end guidance to guarantee immediate marketplace approval.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. CHOOSE A THEME SECTION -->
    <section class="theme-showcase-section" id="themes">
        <div class="theme-showcase-container">
            <div class="theme-content">
                <span class="eyebrow-tag">SAME DATA, DIFFERENT STYLES.</span>
                <h2 class="section-heading">Choose a Theme<br>That Fits Your Brand.</h2>
                <p class="theme-description">
                    Your website content, products and data remain the same. Select a design style that matches your business.
                </p>
                <div class="theme-action">
                    <a href="<?= url('/themes') ?>" class="btn-action-pill">
                        <span>Explore Themes</span>
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="8" x2="13" y2="8"></line>
                            <polyline points="9 4 13 8 9 12"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="theme-visual">
                <div class="theme-image-wrapper">
                    <img src="<?= asset('images/theme_phones_showcase.jpg') ?>" alt="Three mobile app theme styles Minimal, Modern, and Trendy" class="img-responsive theme-img" loading="lazy">
                    <!-- Clickable phone hotspots directly on the visual -->
                    <div class="theme-phones-hotspots" aria-label="Interactive Phone Themes">
                        <a href="<?= url('/themes/minimal') ?>" class="theme-phone-hotspot" aria-label="View Minimal Theme" title="View Minimal Theme"></a>
                        <a href="<?= url('/themes/modern') ?>" class="theme-phone-hotspot" aria-label="View Modern Theme" title="View Modern Theme"></a>
                        <a href="<?= url('/themes/trendy') ?>" class="theme-phone-hotspot" aria-label="View Trendy Theme" title="View Trendy Theme"></a>
                    </div>
                </div>
                <!-- Interactive Pills corresponding to the 3 themes -->
                <div class="theme-pill-tags">
                    <a href="<?= url('/themes/minimal') ?>" class="theme-pill theme-pill-interactive" aria-label="Explore Minimal Theme" title="Explore Minimal Theme">
                        <span>Minimal</span>
                    </a>
                    <a href="<?= url('/themes/modern') ?>" class="theme-pill theme-pill-interactive" aria-label="Explore Modern Theme" title="Explore Modern Theme">
                        <span>Modern</span>
                    </a>
                    <a href="<?= url('/themes/trendy') ?>" class="theme-pill theme-pill-interactive" aria-label="Explore Trendy Theme" title="Explore Trendy Theme">
                        <span>Trendy</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. NATIVE APP VS MOBILE BROWSER COMPARISON -->
    <section class="comparison-section" id="comparison">
        <div class="comparison-container">
            <div class="comparison-header text-center">
                <span class="eyebrow-tag">THE NATIVE ADVANTAGE</span>
                <h2 class="section-heading">Why Your Store Needs a Mobile App</h2>
                <p class="section-subheading">Compare standard responsive mobile browsing with an authentic native iOS and Android app built with AppifyHub.</p>
            </div>

            <div class="comparison-table-wrapper">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th class="col-feature">Key Capability</th>
                            <th class="col-web">Mobile Web Browser</th>
                            <th class="col-native">AppifyHub Native App</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="feature-name">
                                <strong>Push Notifications</strong>
                                <span>Direct promotional &amp; cart recovery messages</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Disabled or Unreliable on iOS</span></td>
                            <td class="val-native"><span class="badge-gold">✓ Unlimited Direct-to-Lockscreen</span></td>
                        </tr>
                        <tr>
                            <td class="feature-name">
                                <strong>Home Screen Real Estate</strong>
                                <span>Presence on the user's personal device</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Lost in Safari/Chrome tabs</span></td>
                            <td class="val-native"><span class="badge-gold">✓ Permanent Dedicated App Icon</span></td>
                        </tr>
                        <tr>
                            <td class="feature-name">
                                <strong>Checkout Experience</strong>
                                <span>Speed and friction during customer payment</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Multi-page slow forms (68% drop-off)</span></td>
                            <td class="val-native"><span class="badge-gold">✓ 1-Tap Biometric (Apple/Google Pay)</span></td>
                        </tr>
                        <tr>
                            <td class="feature-name">
                                <strong>Navigation Speed &amp; Gestures</strong>
                                <span>Smoothness of browsing products and categories</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Laggy 3-5s DOM reloads</span></td>
                            <td class="val-native"><span class="badge-gold">✓ Instant 60fps Native Hardware Acceleration</span></td>
                        </tr>
                        <tr>
                            <td class="feature-name">
                                <strong>Customer Retention Rate</strong>
                                <span>Likelihood of customers making a second purchase</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Low (~12% repeat rate)</span></td>
                            <td class="val-native"><span class="badge-gold">✓ 3.4x Higher Repeat Purchases</span></td>
                        </tr>
                        <tr>
                            <td class="feature-name">
                                <strong>App Store Discoverability</strong>
                                <span>Distribution across Apple App Store and Google Play</span>
                            </td>
                            <td class="val-web"><span class="badge-dim">Zero Marketplace Presence</span></td>
                            <td class="val-native"><span class="badge-gold">✓ Certified Marketplace Visibility</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 9. PRICING & PLANS SECTION -->
    <section class="pricing-section" id="pricing">
        <div class="pricing-container">
            <div class="pricing-header text-center">
                <span class="eyebrow-tag">SIMPLE &amp; TRANSPARENT PLANS</span>
                <h2 class="section-heading">Invest in Your Mobile Growth</h2>
                <p class="section-subheading">No hidden transaction percentages. Keep 100% of your sales revenue.</p>

                <!-- Billing Toggle -->
                <div class="pricing-toggle-wrap">
                    <span class="toggle-label" id="labelMonthly">Monthly</span>
                    <button type="button" class="pricing-switch" id="pricingSwitch" aria-label="Toggle annual billing" role="switch" aria-checked="false">
                        <span class="switch-handle"></span>
                    </button>
                    <span class="toggle-label" id="labelYearly">Yearly <span class="save-tag">Save 20%</span></span>
                </div>
            </div>

            <div class="pricing-cards-grid">
                <!-- Starter Plan -->
                <div class="pricing-card">
                    <div class="plan-header">
                        <h3 class="plan-name">Starter</h3>
                        <p class="plan-tagline">Ideal for personal blogs, news sites &amp; emerging shops.</p>
                        <div class="plan-price-wrap">
                            <span class="currency">$</span>
                            <span class="price-val" data-monthly="29" data-yearly="23">29</span>
                            <span class="period">/ month</span>
                        </div>
                    </div>
                    <ul class="plan-features">
                        <li><span class="check-icon">✓</span> Android App (.aab / .apk)</li>
                        <li><span class="check-icon">✓</span> Standard Clean Theme Layout</li>
                        <li><span class="check-icon">✓</span> 5,000 Push Notifications / mo</li>
                        <li><span class="check-icon">✓</span> Real-Time Product &amp; Post Sync</li>
                        <li><span class="check-icon">✓</span> Unlimited App Downloads</li>
                        <li><span class="check-icon">✓</span> Email Support (48h turnaround)</li>
                    </ul>
                    <a href="<?= url('/convert') ?>" class="btn-plan btn-plan-outline">Get Started</a>
                </div>

                <!-- Professional Plan (Featured) -->
                <div class="pricing-card featured">
                    <div class="featured-badge">MOST POPULAR</div>
                    <div class="plan-header">
                        <h3 class="plan-name">Professional</h3>
                        <p class="plan-tagline">Built for active WooCommerce &amp; Shopify merchants.</p>
                        <div class="plan-price-wrap">
                            <span class="currency">$</span>
                            <span class="price-val" data-monthly="79" data-yearly="63">79</span>
                            <span class="period">/ month</span>
                        </div>
                    </div>
                    <ul class="plan-features">
                        <li><span class="check-icon">✓</span> <strong>Both Android &amp; iOS Apps</strong></li>
                        <li><span class="check-icon">✓</span> All Premium Themes Included</li>
                        <li><span class="check-icon">✓</span> <strong>Unlimited Push Notifications</strong></li>
                        <li><span class="check-icon">✓</span> Biometric 1-Tap Login (FaceID)</li>
                        <li><span class="check-icon">✓</span> Native 1-Click Fast Checkout</li>
                        <li><span class="check-icon">✓</span> WhatsApp &amp; In-App Chat Integration</li>
                        <li><span class="check-icon">✓</span> <strong>24/7 Priority Support</strong></li>
                    </ul>
                    <a href="<?= url('/convert') ?>" class="btn-plan btn-plan-primary">Get Professional</a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card">
                    <div class="plan-header">
                        <h3 class="plan-name">Enterprise</h3>
                        <p class="plan-tagline">For established multi-brand retailers &amp; high-volume stores.</p>
                        <div class="plan-price-wrap">
                            <span class="currency">$</span>
                            <span class="price-val" data-monthly="199" data-yearly="159">199</span>
                            <span class="period">/ month</span>
                        </div>
                    </div>
                    <ul class="plan-features">
                        <li><span class="check-icon">✓</span> Multi-Brand &amp; Multi-Currency Support</li>
                        <li><span class="check-icon">✓</span> Bespoke Custom Theme Customization</li>
                        <li><span class="check-icon">✓</span> White-Glove Store Submission Guarantee</li>
                        <li><span class="check-icon">✓</span> Dedicated Technical Account Manager</li>
                        <li><span class="check-icon">✓</span> Custom ERP &amp; API Integrations</li>
                        <li><span class="check-icon">✓</span> 99.9% Uptime SLA Agreement</li>
                    </ul>
                    <a href="<?= url('/dashboard/support') ?>" class="btn-plan btn-plan-outline">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. SOCIAL PROOF & TESTIMONIALS -->
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header text-center">
                <span class="eyebrow-tag">VERIFIED RESULTS</span>
                <h2 class="section-heading">Loved by Fast-Growing E-Commerce Brands</h2>
                <p class="section-subheading">See how digital merchants unlocked explosive customer retention and revenue with AppifyHub.</p>
            </div>

            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">
                        &ldquo;Our mobile conversion rate increased by 280% within the first 3 weeks of launching our iOS and Android apps. Push notifications alone brought us $42,000 in recovered carts.&rdquo;
                    </p>
                    <div class="testimonial-footer">
                        <div class="author-details">
                            <h4 class="author-name">Elena Rostova</h4>
                            <p class="author-title">Founder, Maison Lumière &bull; WooCommerce</p>
                        </div>
                        <span class="author-metric">+280% Revenue</span>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">
                        &ldquo;Zero coding required. In less than 15 minutes our entire Shopify catalog of 1,200 products was converted into a boutique mobile experience. Customers constantly compliment how clean it feels.&rdquo;
                    </p>
                    <div class="testimonial-footer">
                        <div class="author-details">
                            <h4 class="author-name">Marcus Vance</h4>
                            <p class="author-title">Co-Founder, Artisan Leather &bull; Shopify</p>
                        </div>
                        <span class="author-metric">68% Open Rate</span>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">
                        &ldquo;AppifyHub handled our Apple App Store and Google Play publication with zero rejections on the first attempt. The real-time sync with our WordPress blog is completely seamless.&rdquo;
                    </p>
                    <div class="testimonial-footer">
                        <div class="author-details">
                            <h4 class="author-name">Sofia Chen</h4>
                            <p class="author-title">Digital Director, The Minimalist Edit &bull; WordPress</p>
                        </div>
                        <span class="author-metric">4.9 ★ App Store</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 12. READY TO GET STARTED (BOTTOM CTA) -->
    <section class="bottom-cta-section">
        <div class="bottom-cta-container">
            <div class="bottom-cta-content">
                <span class="eyebrow-tag">READY TO GET STARTED?</span>
                <h2 class="section-heading">Turn Your Website<br>into a Mobile App Today.</h2>
                <p class="bottom-cta-description">
                    No coding required. Works seamlessly with WordPress, WooCommerce and Shopify.
                </p>
                <div class="bottom-cta-action">
                    <a href="<?= url('/convert') ?>" class="btn-action-pill">
                        <span>Convert My Website</span>
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="8" x2="13" y2="8"></line>
                            <polyline points="9 4 13 8 9 12"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bottom-cta-visual">
                <div class="bottom-cta-frame">
                    <img src="<?= asset('images/bottom_cta_phone.jpg') ?>" alt="Smartphone on travertine stone displaying mobile store" class="img-responsive" loading="lazy">
                </div>
            </div>
        </div>
    </section>

</div>
