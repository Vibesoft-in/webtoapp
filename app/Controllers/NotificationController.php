<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Notification;
use App\Services\AddonEngine\PushNotification;

class NotificationController extends Controller
{
    private Notification $notificationModel;
    private PushNotification $pushService;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->notificationModel = new Notification();
        $this->pushService = new PushNotification();
    }

    public function send(): void
    {
        $userId = (int)Session::get('user_id');
        $appId = (int)$this->request->input('app_id');
        $title = trim((string)$this->request->input('title'));
        $message = trim((string)$this->request->input('message'));

        if ($title === '' || $message === '') {
            Session::flash('error', 'Title and message are required.');
            $this->redirect(url('/dashboard/notifications'));
            return;
        }

        // Dispatch via Push Notification Engine
        $this->pushService->sendBroadcast($appId, $title, $message);

        // Record in Database
        $this->notificationModel->create([
            'user_id' => $userId,
            'app_id' => $appId ?: null,
            'title' => $title,
            'message' => $message,
            'type' => 'push',
            'status' => 'unread',
            'sent_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'Push notification dispatched successfully.');
        $this->redirect(url('/dashboard/notifications'));
    }

    public function markAsRead(): void
    {
        $id = (int)$this->request->input('id');
        $notification = $this->notificationModel->find($id);

        if ($notification && (int)$notification['user_id'] === (int)Session::get('user_id')) {
            $this->notificationModel->update($id, ['status' => 'read']);
        }

        if ($this->request->isJson()) {
            $this->json(['success' => true]);
            return;
        }

        $this->redirect(url('/dashboard/notifications'));
    }
}
