<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Users\UserSession;

class UserSessionsService
{
    public function __construct(
        public readonly UserSession $userSession
    )
    {}

    public function getList($limit = null)
    {
        $sessions = $this->userSession->query()->with('user')->orderBy('id', 'DESC');

        if ($limit)
        {
            $sessions = $sessions->limit($limit);
        }

        return $sessions->get();
    }

    public function getByUserId($userId)
    {
        $sessions = $this->userSession->query()->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        return $sessions;
    }

    public function startSession($data)
    {
        $session = $this->userSession->query()->create([
            'session_no'    => strtoupper(Str::random(10)),
            'signin_at'     => now(),
            'user_id'       => $data['user_id'],
            'ip_address'    => $data['ip_address']
        ]);

        return $session->session_no;
    }

    public function endSession($sessionId)
    {
        $session = $this->userSession->query()->where('session_no', $sessionId)->first();

        $session->update([
            'signout_at'    => now(),
            'duration'      => abs(now()->diffInSeconds($session->signin_at))
        ]);
    }
}
