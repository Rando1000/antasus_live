<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailCampaign;
use Illuminate\Http\Request;

class EmailTrackingController extends Controller
{
    public function open($token)
{
    $mail = \App\Models\EmailCampaign::where('tracking_token', $token)->first();
    if ($mail && !$mail->opened_at) {
        $mail->opened_at = now();
        $mail->save();
    }
    return response(
        base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAAWgmWQ0AAAAASUVORK5CYII='),
        200, ['Content-Type' => 'image/png']
    );
}

public function click(Request $request, $token)
{
    $mail = \App\Models\EmailCampaign::where('tracking_token', $token)->first();
    $url = $request->query('url', '/');
    if ($mail) {
        $clicked = $mail->clicked_links ?? [];
        $clicked[$url] = now()->toDateTimeString();
        $mail->clicked_links = $clicked;
        $mail->save();
    }
    return redirect()->away($url);
}
}
