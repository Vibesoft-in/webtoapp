<?php
/**
 * AppifyHub - Dedicated Pricing Page
 * Editorial & Interactive Investment Guide
 */
?>
<div class="pricing-page-wrapper">

    <!-- 1. HERO SECTION -->
    <section class="pricing-hero-section">
        <div class="pricing-page-container">
            <div class="pricing-hero-content">
                <div class="pricing-eyebrow-pill">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span>TRANSPARENT &amp; PREDICTABLE PRICING</span>
                </div>
                <h1 class="pricing-hero-title">
                    Simple Investment, <em>Limitless Mobile Growth</em>
                </h1>
                <p class="pricing-hero-subheading">
                    Turn your WordPress, WooCommerce, or Shopify store into high-converting native iOS &amp; Android apps. No recurring sales commissions, no hidden publishing penalties.
                </p>


                <!-- Billing Cycle Selector Switch -->
                <div class="pricing-billing-switch-wrap">
                    <span class="billing-label is-active" id="labelOneTime">One-Time License</span>
                    <button type="button" class="pricing-billing-toggle" id="pricingBillingToggle" aria-label="Toggle annual support plan" role="switch" aria-checked="false">
                        <span class="billing-toggle-thumb"></span>
                    </button>
                    <span class="billing-label" id="labelAnnual">Annual Care Plan <span class="billing-save-tag">Save 20%</span></span>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. CORE PLANS GRID -->
    <section class="pricing-cards-section" id="plansCatalog">
        <div class="pricing-page-container">
            <div class="pricing-grid-cards">
                <?php foreach ($plans as $index => $plan): ?>
                    <?php
                    $isFeatured = (int)($plan['is_featured'] ?? 0) === 1;
                    $features = $plan['parsed_features'] ?? [];
                    $planSlug = $plan['slug'] ?? 'starter-app';
                    $basePrice = (float)$plan['price'];
                    $annualPrice = round($basePrice * 0.8);
                    ?>
                    <article class="pricing-card-box <?= $isFeatured ? 'is-featured' : '' ?>">
                        <?php if ($isFeatured): ?>
                            <div class="pricing-featured-badge">MOST POPULAR</div>
                        <?php endif; ?>

                        <div class="card-head">
                            <span class="card-plan-tier"><?= strtoupper(e($plan['slug'])) ?></span>
                            <h2 class="card-plan-name"><?= e($plan['name']) ?></h2>
                            <p class="card-plan-desc"><?= e($plan['description']) ?></p>

                            <div class="card-price-display">
                                <span class="price-currency">₹</span>
                                <span class="price-amount" data-onetime="<?= number_format($basePrice, 0, '', '') ?>" data-annual="<?= number_format($annualPrice, 0, '', '') ?>">
                                    <?= number_format($basePrice, 0) ?>
                                </span>
                                <span class="price-billing-period" data-period-onetime="one-time license" data-period-annual="/ year (billed annually)">
                                    one-time license
                                </span>
                            </div>
                            <div class="price-usd-equivalent">
                                Approx. <?= e($plan['formatted_usd']) ?> USD &middot; Lifetime App Files
                            </div>
                        </div>

                        <div class="card-divider"></div>

                        <ul class="card-features-list">
                            <?php foreach ($features as $f): ?>
                                <li>
                                    <span class="feat-check-icon">✓</span>
                                    <span><?= e($f) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="card-action-wrap">
                            <a href="<?= url('/convert?plan=' . urlencode($planSlug)) ?>" class="btn-pricing-action <?= $isFeatured ? 'btn-pricing-primary' : 'btn-pricing-outline' ?>">
                                <span>Get Started With <?= e($plan['name']) ?> &rarr;</span>
                            </a>
                            <span class="card-sub-guarantee">Instant project setup &middot; Full source delivery</span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 3. INTERACTIVE CUSTOM APP CONFIGURATOR & CALCULATOR -->
    <section class="pricing-calculator-section" id="appCalculator">
        <div class="pricing-page-container">
            <div class="calculator-header text-center">
                <span class="pricing-eyebrow-pill">INTERACTIVE CONFIGURATOR</span>
                <h2 class="calc-section-title">Customize Your Exact App Package</h2>
                <p class="calc-section-sub">
                    Select your base plan and combine powerful growth add-ons to see your transparent final cost immediately.
                </p>
            </div>

            <div class="pricing-calc-box-layout" data-calculator>
                <!-- Left: Interactive Selectors -->
                <div class="calc-controls-pane">
                    
                    <!-- 1. Base Plan Choice -->
                    <div class="calc-group">
                        <label class="calc-group-label">
                            <span class="calc-step-num">1</span>
                            <span>Choose Base Architecture Plan</span>
                        </label>
                        <div class="calc-plan-pills-grid">
                            <?php foreach ($plans as $p): ?>
                                <label class="calc-plan-pill-item">
                                    <input type="radio" name="calc_plan_id" value="<?= (int)$p['id'] ?>" data-price="<?= (float)$p['price'] ?>" data-name="<?= e($p['name']) ?>" <?= ((int)$p['is_featured'] === 1) ? 'checked' : '' ?>>
                                    <div class="plan-pill-content">
                                        <div class="plan-pill-header">
                                            <strong class="plan-pill-name"><?= e($p['name']) ?></strong>
                                            <span class="plan-pill-price">₹<?= number_format((float)$p['price'], 0) ?></span>
                                        </div>
                                        <p class="plan-pill-brief"><?= e($p['description']) ?></p>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 2. Visual Theme Choice -->
                    <div class="calc-group">
                        <label class="calc-group-label">
                            <span class="calc-step-num">2</span>
                            <span>Select Design Theme</span>
                        </label>
                        <div class="calc-themes-selector-grid">
                            <label class="calc-theme-choice-item">
                                <input type="radio" name="calc_theme_id" value="0" data-price="0" data-name="Default Theme" checked>
                                <div class="theme-choice-box">
                                    <strong>Default Theme</strong>
                                    <span>Included with Plan (₹0)</span>
                                </div>
                            </label>
                            <?php foreach ($themes as $th): ?>
                                <label class="calc-theme-choice-item">
                                    <input type="radio" name="calc_theme_id" value="<?= (int)$th['id'] ?>" data-price="<?= (float)$th['price'] ?>" data-name="<?= e($th['name']) ?>">
                                    <div class="theme-choice-box">
                                        <strong><?= e($th['name']) ?></strong>
                                        <span><?= (float)$th['price'] > 0 ? '+₹' . number_format((float)$th['price'], 0) : 'Free Included' ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 3. Add-Ons Selection -->
                    <div class="calc-group">
                        <label class="calc-group-label">
                            <span class="calc-step-num">3</span>
                            <span>Select Growth &amp; Engagement Add-Ons</span>
                        </label>
                        <div class="calc-addons-list">
                            <?php foreach ($addons as $addon): ?>
                                <label class="calc-addon-check-card">
                                    <input type="checkbox" name="calc_addon_ids[]" value="<?= (int)$addon['id'] ?>" data-price="<?= (float)$addon['price'] ?>" data-name="<?= e($addon['name']) ?>">
                                    <div class="addon-check-body">
                                        <div class="addon-info">
                                            <strong class="addon-title"><?= e($addon['name']) ?></strong>
                                            <p class="addon-desc"><?= e($addon['description']) ?></p>
                                        </div>
                                        <div class="addon-price-badge">
                                            +₹<?= number_format((float)$addon['price'], 0) ?>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

                <!-- Right: Real-Time Summary Receipt -->
                <div class="calc-summary-pane">
                    <div class="calc-receipt-card">
                        <div class="receipt-header">
                            <h3 class="receipt-title">Package Summary</h3>
                            <span class="receipt-sub">Real-Time Configuration</span>
                        </div>

                        <div class="receipt-items-list" id="receiptItemsList">
                            <div class="receipt-row" id="receiptPlanRow">
                                <span class="row-label">Base Plan: <strong id="receiptPlanName">Pro Combo</strong></span>
                                <span class="row-amount" id="receiptPlanAmount">₹8,999</span>
                            </div>
                            <div class="receipt-row" id="receiptThemeRow" style="display:none;">
                                <span class="row-label">Theme: <strong id="receiptThemeName">Modern Minimalist</strong></span>
                                <span class="row-amount" id="receiptThemeAmount">₹0</span>
                            </div>
                            <div id="receiptAddonsList">
                                <!-- Dynamic Add-On Rows injected here -->
                            </div>
                        </div>

                        <div class="receipt-divider"></div>

                        <div class="receipt-calc-totals">
                            <div class="totals-subrow">
                                <span>Subtotal</span>
                                <strong id="receiptSubtotal">₹8,999</strong>
                            </div>
                            <div class="totals-subrow">
                                <span>Taxes &amp; GST (18%)</span>
                                <span id="receiptTax">₹1,620</span>
                            </div>
                            <div class="totals-main-row">
                                <span>Estimated Total</span>
                                <strong class="total-big-val" id="receiptTotalAmount" data-total-amount>₹10,619</strong>
                            </div>
                        </div>

                        <div class="receipt-action-wrap">
                            <a href="<?= url('/convert?plan=pro-combo') ?>" id="btnLockConfiguration" class="btn-receipt-checkout">
                                <span>Proceed With This Configuration &rarr;</span>
                            </a>
                            <p class="receipt-guarantee-note">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                <span>14-Day Store Acceptance Guarantee Included</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. DETAILED FEATURE COMPARISON TABLE -->
    <section class="pricing-comparison-table-section">
        <div class="pricing-page-container">
            <div class="comparison-header text-center">
                <span class="pricing-eyebrow-pill">FULL CAPABILITIES MATRIX</span>
                <h2 class="comp-title">Compare All Plan Specifications</h2>
                <p class="comp-sub">A clear, side-by-side feature comparison to help you choose with confidence.</p>
            </div>

            <div class="pricing-matrix-card">
                <div class="table-responsive-wrap">
                    <table class="pricing-matrix-table">
                        <thead>
                            <tr>
                                <th class="col-feature-spec">Features &amp; Capabilities</th>
                                <th class="col-plan text-center">
                                    <div class="th-plan-name">Starter App</div>
                                    <div class="th-plan-price">₹4,999</div>
                                </th>
                                <th class="col-plan text-center th-highlight">
                                    <div class="th-featured-pill">POPULAR</div>
                                    <div class="th-plan-name">Pro Combo</div>
                                    <div class="th-plan-price">₹8,999</div>
                                </th>
                                <th class="col-plan text-center">
                                    <div class="th-plan-name">Enterprise Suite</div>
                                    <div class="th-plan-price">₹14,999</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Category: Platforms & Builds -->
                            <tr class="matrix-cat-row">
                                <td colspan="4">1. Mobile Platforms &amp; Application Builds</td>
                            </tr>
                            <tr>
                                <td>Android Production App (.aab / .apk)</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>iOS Production App (.ipa / TestFlight)</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Tablet &amp; iPad Optimized Viewport</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Supported Stores / Brands Connected</td>
                                <td class="text-center">1 Store</td>
                                <td class="text-center highlight-cell">1 Store</td>
                                <td class="text-center">Up to 3 Stores</td>
                            </tr>

                            <!-- Category: Design & Mobile UX -->
                            <tr class="matrix-cat-row">
                                <td colspan="4">2. Design, Themes &amp; Native UX</td>
                            </tr>
                            <tr>
                                <td>Curated Mobile Theme Selection</td>
                                <td class="text-center">Standard Minimalist</td>
                                <td class="text-center highlight-cell">All 5 Premium Themes</td>
                                <td class="text-center">All Themes + Bespoke Styling</td>
                            </tr>
                            <tr>
                                <td>Custom Splash Screen &amp; App Icon Design</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Biometric Login (FaceID &amp; TouchID)</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Offline Caching &amp; Fast Re-engagement</td>
                                <td class="text-center">Basic</td>
                                <td class="text-center highlight-cell">Advanced</td>
                                <td class="text-center">Enterprise Local Sync</td>
                            </tr>

                            <!-- Category: Commerce & Sync -->
                            <tr class="matrix-cat-row">
                                <td colspan="4">3. E-Commerce &amp; Real-Time Data Sync</td>
                            </tr>
                            <tr>
                                <td>Real-Time Two-Way Product &amp; Order Sync</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Native In-App 1-Click Fast Checkout</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Payment Gateways (Razorpay, Stripe, PayPal, COD)</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Customer Wishlist &amp; Saved Items</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>

                            <!-- Category: Marketing & Growth -->
                            <tr class="matrix-cat-row">
                                <td colspan="4">4. Retention, Marketing &amp; Add-Ons</td>
                            </tr>
                            <tr>
                                <td>Push Notification Quota</td>
                                <td class="text-center">5,000 / mo</td>
                                <td class="text-center highlight-cell"><strong>Unlimited</strong></td>
                                <td class="text-center"><strong>Unlimited</strong> + Priority Delivery</td>
                            </tr>
                            <tr>
                                <td>Automated Abandoned Cart Push Triggers</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>WhatsApp Direct Customer Support Floating Chat</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span> (Optional Add-on)</td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span> Included</td>
                                <td class="text-center"><span class="matrix-check">✓</span> Included</td>
                            </tr>
                            <tr>
                                <td>Advanced In-App Analytics &amp; User Drop-off</td>
                                <td class="text-center"><span class="matrix-cross">&times;</span></td>
                                <td class="text-center highlight-cell">Standard Analytics</td>
                                <td class="text-center"><span class="matrix-check">✓</span> Full Telemetry Included</td>
                            </tr>

                            <!-- Category: Publishing & Support -->
                            <tr class="matrix-cat-row">
                                <td colspan="4">5. Publishing, Updates &amp; Support</td>
                            </tr>
                            <tr>
                                <td>App Store &amp; Play Store Submission Guidance</td>
                                <td class="text-center">Step-by-step Guides</td>
                                <td class="text-center highlight-cell">Assisted Submission</td>
                                <td class="text-center"><strong>White-Glove Submission</strong></td>
                            </tr>
                            <tr>
                                <td>Apple &amp; Google Review Approval Guarantee</td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                                <td class="text-center highlight-cell"><span class="matrix-check">✓</span></td>
                                <td class="text-center"><span class="matrix-check">✓</span></td>
                            </tr>
                            <tr>
                                <td>Support Window &amp; Updates Included</td>
                                <td class="text-center">3 Months Email Support</td>
                                <td class="text-center highlight-cell">6 Months Priority Support</td>
                                <td class="text-center">1 Year Dedicated Manager &amp; SLA</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td class="text-center">
                                    <a href="<?= url('/convert?plan=starter-app') ?>" class="btn-matrix-action">Choose Starter</a>
                                </td>
                                <td class="text-center highlight-cell">
                                    <a href="<?= url('/convert?plan=pro-combo') ?>" class="btn-matrix-action is-primary">Choose Pro Combo</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= url('/convert?plan=enterprise-suite') ?>" class="btn-matrix-action">Choose Enterprise</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. APPIFYHUB VS TRADITIONAL DEVELOPMENT -->
    <section class="pricing-comparison-agency-section">
        <div class="pricing-page-container">
            <div class="agency-header text-center">
                <span class="pricing-eyebrow-pill">COST VS VALUE COMPARISON</span>
                <h2 class="agency-title">Why Smart Brands Choose AppifyHub</h2>
                <p class="agency-sub">See how AppifyHub compares against mobile development agencies and basic webview wrappers.</p>
            </div>

            <div class="agency-comparison-cards-grid">
                
                <!-- Card 1: Traditional Agency -->
                <div class="agency-compare-card is-disadvantaged">
                    <div class="agency-card-tag">TRADITIONAL AGENCY</div>
                    <h3 class="agency-card-cost">$25,000+</h3>
                    <p class="agency-card-timing">4 to 6 months turnaround</p>
                    <ul class="agency-points-list">
                        <li class="negative">&times; Massive upfront engineering budgets</li>
                        <li class="negative">&times; Costly ongoing monthly retainers ($1,500/mo+)</li>
                        <li class="negative">&times; Complex custom code that breaks on store updates</li>
                        <li class="negative">&times; Lengthy delays before initial release</li>
                    </ul>
                </div>

                <!-- Card 2: AppifyHub (Highlighted Hero) -->
                <div class="agency-compare-card is-appifyhub-highlight">
                    <div class="agency-card-tag highlight-tag">APPIFYHUB PLATFORM</div>
                    <h3 class="agency-card-cost">Starting at ₹4,999</h3>
                    <p class="agency-card-timing">Ready in 48 hours</p>
                    <ul class="agency-points-list">
                        <li class="positive">&check; Transparent one-time investment with zero commissions</li>
                        <li class="positive">&check; Native, 60fps smooth iOS and Android performance</li>
                        <li class="positive">&check; Seamless automatic 2-way sync with your existing store</li>
                        <li class="positive">&check; 100% store approval guarantee &amp; full app ownership</li>
                    </ul>
                    <a href="<?= url('/convert') ?>" class="btn-agency-cta">Start Converting Now &rarr;</a>
                </div>

                <!-- Card 3: Generic Webview Wrappers -->
                <div class="agency-compare-card is-disadvantaged">
                    <div class="agency-card-tag">GENERIC WEBVIEW WRAPPERS</div>
                    <h3 class="agency-card-cost">$19 - $49 / mo</h3>
                    <p class="agency-card-timing">Recurring subscription</p>
                    <ul class="agency-points-list">
                        <li class="negative">&times; Sluggish web frames that feel like a browser window</li>
                        <li class="negative">&times; High rejection rates by Apple App Store (Guideline 4.2)</li>
                        <li class="negative">&times; No native biometrics, push reliability, or fluid UI</li>
                        <li class="negative">&times; Cancel your subscription and your app shuts down</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. FREQUENTLY ASKED QUESTIONS -->
    <section class="pricing-faq-section" id="faq">
        <div class="pricing-page-container">
            <div class="faq-header text-center">
                <span class="pricing-eyebrow-pill">HAVE QUESTIONS?</span>
                <h2 class="faq-heading">Frequently Asked Questions</h2>
                <p class="faq-sub">Clear answers to common questions about pricing, app publishing, and store ownership.</p>
            </div>

            <div class="faq-accordion-list">
                <!-- FAQ 1 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>Do you take any percentage or commission from our sales?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>No. Never. We believe your revenue belongs entirely to your business. AppifyHub charges zero transaction fees and zero sales commissions. All customer payments pass directly through your existing payment processors (Stripe, Razorpay, PayPal, etc.).</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>Will the mobile apps be published under my own developer accounts?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes. Your apps are published under your company's own Apple Developer Program and Google Play Console accounts. You retain 100% ownership, brand credibility, and direct control over customer reviews and store presence.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>What happens when I update products, prices, or inventory on my website?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>All catalog data, prices, descriptions, and stock quantities sync automatically in real time using our live API connection layer. You never need to duplicate content or manually update your app.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>What if Apple or Google requires modifications during review?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>Our team includes store approval assistance with every plan. If Apple or Google requests any metadata adjustments, screenshots revisions, or technical compliance modifications, our engineers make the necessary updates at no additional charge until your app is live.</p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>Can I start with the Starter Plan and upgrade to Pro Combo later?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>Absolutely. You can start with Starter (Android) and easily upgrade to Pro Combo whenever you are ready to expand to iOS devices. You only pay the difference between the two plan tiers.</p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="faq-item">
                    <button type="button" class="faq-question" aria-expanded="false">
                        <span>Do I need any programming or coding experience to manage the app?</span>
                        <span class="faq-chevron">&darr;</span>
                    </button>
                    <div class="faq-answer">
                        <p>Zero coding knowledge is needed. AppifyHub provides an intuitive visual dashboard where you can trigger push notifications, preview themes, view analytics, and manage configurations with simple point-and-click controls.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FINAL CALL TO ACTION -->
    <section class="pricing-final-cta-section">
        <div class="pricing-page-container">
            <div class="pricing-cta-card">
                <span class="pricing-eyebrow-pill" style="background:#FFFFFF;">READY TO EXPAND</span>
                <h2 class="pricing-cta-title">Turn Your Store Into an App Today</h2>
                <p class="pricing-cta-lead">
                    Test your website compatibility in under 30 seconds, select your favorite theme, and start converting your mobile visitors into loyal app buyers.
                </p>
                <div class="pricing-cta-buttons">
                    <a href="<?= url('/compatibility') ?>" class="btn-pricing-cta-primary">
                        <span>Analyze My Website Free &rarr;</span>
                    </a>
                    <a href="#plansCatalog" class="btn-pricing-cta-secondary">
                        <span>View Plans Again &uarr;</span>
                    </a>
                </div>
                <div class="pricing-cta-trust-strip">
                    <span>WordPress &middot; WooCommerce &middot; Shopify Compatible</span>
                    <span class="dot-sep">&bull;</span>
                    <span>No Credit Card Required For Compatibility Test</span>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Inline JavaScript for Pricing Interactions & Real-Time Calculation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. One-Time vs Annual Billing Switcher
    const billingToggle = document.getElementById('pricingBillingToggle');
    const labelOneTime = document.getElementById('labelOneTime');
    const labelAnnual = document.getElementById('labelAnnual');
    const priceAmounts = document.querySelectorAll('.card-price-display .price-amount');
    const pricePeriods = document.querySelectorAll('.card-price-display .price-billing-period');

    if (billingToggle) {
        billingToggle.addEventListener('click', function() {
            const isAnnual = billingToggle.classList.toggle('active');
            billingToggle.setAttribute('aria-checked', isAnnual ? 'true' : 'false');

            if (labelOneTime && labelAnnual) {
                labelOneTime.classList.toggle('is-active', !isAnnual);
                labelAnnual.classList.toggle('is-active', isAnnual);
            }

            priceAmounts.forEach(function(amountElem) {
                const target = isAnnual ? amountElem.getAttribute('data-annual') : amountElem.getAttribute('data-onetime');
                if (target) {
                    amountElem.style.opacity = '0';
                    setTimeout(function() {
                        amountElem.textContent = Number(target).toLocaleString('en-IN');
                        amountElem.style.opacity = '1';
                    }, 120);
                }
            });

            pricePeriods.forEach(function(periodElem) {
                const text = isAnnual ? periodElem.getAttribute('data-period-annual') : periodElem.getAttribute('data-period-onetime');
                if (text) {
                    periodElem.textContent = text;
                }
            });
        });
    }

    // 2. Interactive Calculator Logic
    const planRadios = document.querySelectorAll('input[name="calc_plan_id"]');
    const themeRadios = document.querySelectorAll('input[name="calc_theme_id"]');
    const addonCheckboxes = document.querySelectorAll('input[name="calc_addon_ids[]"]');

    const receiptPlanName = document.getElementById('receiptPlanName');
    const receiptPlanAmount = document.getElementById('receiptPlanAmount');
    const receiptThemeRow = document.getElementById('receiptThemeRow');
    const receiptThemeName = document.getElementById('receiptThemeName');
    const receiptThemeAmount = document.getElementById('receiptThemeAmount');
    const receiptAddonsList = document.getElementById('receiptAddonsList');
    const receiptSubtotal = document.getElementById('receiptSubtotal');
    const receiptTax = document.getElementById('receiptTax');
    const receiptTotalAmount = document.getElementById('receiptTotalAmount');
    const btnLockConfig = document.getElementById('btnLockConfiguration');

    function recalculatePackage() {
        let selectedPlanPrice = 8999;
        let selectedPlanName = 'Pro Combo';
        let selectedPlanSlug = 'pro-combo';

        planRadios.forEach(function(radio) {
            if (radio.checked) {
                selectedPlanPrice = parseFloat(radio.dataset.price) || 0;
                selectedPlanName = radio.dataset.name || 'Plan';
                selectedPlanSlug = selectedPlanName.toLowerCase().replace(/\s+/g, '-');
            }
        });

        if (receiptPlanName) receiptPlanName.textContent = selectedPlanName;
        if (receiptPlanAmount) receiptPlanAmount.textContent = '₹' + selectedPlanPrice.toLocaleString('en-IN');

        let selectedThemePrice = 0;
        let selectedThemeName = 'Default Theme';
        themeRadios.forEach(function(radio) {
            if (radio.checked) {
                selectedThemePrice = parseFloat(radio.dataset.price) || 0;
                selectedThemeName = radio.dataset.name || 'Default Theme';
            }
        });

        if (receiptThemeRow) {
            if (selectedThemePrice > 0) {
                receiptThemeRow.style.display = 'flex';
                if (receiptThemeName) receiptThemeName.textContent = selectedThemeName;
                if (receiptThemeAmount) receiptThemeAmount.textContent = '₹' + selectedThemePrice.toLocaleString('en-IN');
            } else {
                receiptThemeRow.style.display = 'none';
            }
        }

        let selectedAddonsTotal = 0;
        let addonsHtml = '';
        addonCheckboxes.forEach(function(cb) {
            if (cb.checked) {
                const addPrice = parseFloat(cb.dataset.price) || 0;
                const addName = cb.dataset.name || 'Add-on';
                selectedAddonsTotal += addPrice;
                addonsHtml += '<div class="receipt-row addon-row">' +
                    '<span class="row-label">+ ' + addName + '</span>' +
                    '<span class="row-amount">₹' + addPrice.toLocaleString('en-IN') + '</span>' +
                    '</div>';
            }
        });

        if (receiptAddonsList) {
            receiptAddonsList.innerHTML = addonsHtml;
        }

        const subtotal = selectedPlanPrice + selectedThemePrice + selectedAddonsTotal;
        const tax = Math.round(subtotal * 0.18);
        const grandTotal = subtotal + tax;

        if (receiptSubtotal) receiptSubtotal.textContent = '₹' + subtotal.toLocaleString('en-IN');
        if (receiptTax) receiptTax.textContent = '₹' + tax.toLocaleString('en-IN');
        if (receiptTotalAmount) receiptTotalAmount.textContent = '₹' + grandTotal.toLocaleString('en-IN');

        if (btnLockConfig) {
            btnLockConfig.href = '<?= url('/convert') ?>?plan=' + encodeURIComponent(selectedPlanSlug);
        }
    }

    planRadios.forEach(function(r) { r.addEventListener('change', recalculatePackage); });
    themeRadios.forEach(function(r) { r.addEventListener('change', recalculatePackage); });
    addonCheckboxes.forEach(function(cb) { cb.addEventListener('change', recalculatePackage); });

    // Initial calculation trigger
    recalculatePackage();
});
</script>
