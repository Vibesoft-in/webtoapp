<div class="notifications-container">
    <div class="page-header">
        <h1>Push Notifications Manager</h1>
        <p>Send broadcast push alerts to users who installed your mobile application.</p>
    </div>

    <div class="notification-compose-card">
        <h3>Compose New Push Alert</h3>
        <form action="<?= url('/dashboard/notifications/send') ?>" method="POST" class="form-standard">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="title">Notification Title</label>
                <input type="text" id="title" name="title" required placeholder="e.g. Flash Sale Alert!">
            </div>

            <div class="form-group">
                <label for="message">Notification Body</label>
                <textarea id="message" name="message" rows="3" required placeholder="e.g. Enjoy 25% off storewide today only on the mobile app!"></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Broadcast Notification</button>
            </div>
        </form>
    </div>

    <div class="notifications-history" style="margin-top:2rem;">
        <h3>Notification History</h3>
        <?php if (!empty($notifications)): ?>
            <ul class="notification-list">
                <?php foreach ($notifications as $note): ?>
                    <li>
                        <strong><?= e($note['title']) ?></strong>
                        <p><?= e($note['message']) ?></p>
                        <small>Sent: <?= e($note['created_at']) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No notifications sent yet.</p>
        <?php endif; ?>
    </div>
</div>
