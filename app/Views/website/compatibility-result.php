<div class="compatibility-result-container">
    <div class="result-header">
        <h1>Audit Results for <?= e($website['domain']) ?></h1>
        <p class="target-url"><?= e($website['url']) ?></p>
    </div>

    <?php if ($report): ?>
        <div class="score-card <?= $isCompatible ? 'status-compatible' : 'status-incompatible' ?>">
            <div class="score-badge">
                <span class="score-number"><?= (int)$report['overall_score'] ?>%</span>
                <span class="score-label">Readiness Score</span>
            </div>
            <div class="score-details">
                <h3><?= $isCompatible ? 'Website is Mobile-App Compatible' : 'Website Requires Improvements Before Conversion' ?></h3>
                <p><?= e($report['report_summary']) ?></p>
            </div>
        </div>

        <div class="metrics-grid">
            <div class="metric-item">
                <span class="label">Detected Platform:</span>
                <span class="val"><?= ucfirst(e($report['platform_status'])) ?></span>
            </div>
            <div class="metric-item">
                <span class="label">SSL Certificate:</span>
                <span class="val"><?= ucfirst(e($report['ssl_status'])) ?></span>
            </div>
            <div class="metric-item">
                <span class="label">REST API Status:</span>
                <span class="val"><?= ucfirst(e($report['api_status'])) ?></span>
            </div>
            <div class="metric-item">
                <span class="label">Mobile Viewport:</span>
                <span class="val"><?= (int)$report['mobile_score'] ?>%</span>
            </div>
        </div>

        <?php 
            $recommendations = json_decode((string)$report['recommendations'], true) ?: [];
            if (!empty($recommendations)): 
        ?>
            <div class="recommendations-box">
                <h4>Engine Recommendations</h4>
                <ul>
                    <?php foreach ($recommendations as $rec): ?>
                        <li><?= e($rec) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="result-actions">
            <?php if ($isCompatible): ?>
                <a href="<?= url('/themes') ?>" class="btn btn-primary">Proceed to Theme Selection</a>
            <?php else: ?>
                <a href="<?= url('/website/improvement-form?website_id=' . $website['id']) ?>" class="btn btn-warning">Request Assistance / Submit Improvement Request</a>
            <?php endif; ?>
            <a href="<?= url('/convert') ?>" class="btn btn-secondary">Analyze Another Website</a>
        </div>
    <?php else: ?>
        <p>No report found. <a href="<?= url('/convert') ?>">Start a new scan</a></p>
    <?php endif; ?>
</div>
