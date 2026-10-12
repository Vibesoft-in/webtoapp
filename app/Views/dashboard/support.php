<div class="support-container">
    <div class="page-header">
        <h1>Support & Help Desk</h1>
        <p>Submit questions or technical inquiries regarding app store approvals and integrations.</p>
    </div>

    <div class="support-form-card">
        <h3>Create Support Ticket</h3>
        <form action="<?= url('/dashboard/support/ticket') ?>" method="POST" class="form-standard">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required placeholder="e.g. Question about Play Store submission">
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required placeholder="Describe your question or issue in detail..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Submit Ticket</button>
            </div>
        </form>
    </div>

    <div class="ticket-history" style="margin-top:2rem;">
        <h3>My Tickets</h3>
        <?php if (!empty($tickets)): ?>
            <table class="table-standard">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?= e($ticket['ticket_number']) ?></td>
                            <td><?= e($ticket['subject']) ?></td>
                            <td><?= ucfirst(e($ticket['priority'])) ?></td>
                            <td><span class="badge"><?= ucfirst(e($ticket['status'])) ?></span></td>
                            <td><?= e($ticket['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No active support tickets.</p>
        <?php endif; ?>
    </div>
</div>
