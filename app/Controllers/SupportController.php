<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Models\SupportTicket;

class SupportController extends Controller
{
    private SupportTicket $ticketModel;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->ticketModel = new SupportTicket();
    }

    public function createTicket(): void
    {
        $userId = (int)Session::get('user_id');
        $data = $this->request->all();

        $validator = new Validator($data);
        $validator->required('subject')->min('subject', 5)
                  ->required('message')->min('message', 10);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', $data);
            $this->redirect(url('/dashboard/support'));
            return;
        }

        $ticketNumber = 'TICK-' . strtoupper(substr(uniqid(), -6));

        $this->ticketModel->create([
            'ticket_number' => $ticketNumber,
            'user_id' => $userId,
            'app_id' => !empty($data['app_id']) ? (int)$data['app_id'] : null,
            'subject' => trim($data['subject']),
            'message' => trim($data['message']),
            'priority' => in_array($data['priority'] ?? '', ['low', 'medium', 'high', 'urgent']) ? $data['priority'] : 'medium',
            'status' => 'open',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', "Support ticket #{$ticketNumber} opened successfully.");
        $this->redirect(url('/dashboard/support'));
    }
}
