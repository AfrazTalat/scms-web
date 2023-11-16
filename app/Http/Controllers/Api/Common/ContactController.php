<?php

namespace App\Http\Controllers\Api\Common;

use App\Models\Setting;
use App\Support\Http\CrudController;
use Illuminate\Http\Request;
use Mail;

class ContactController extends CrudController
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'address' => 'nullable|string',
            'message' => 'required|string',
        ]);
        $contactEmail = Setting::findKey('contact_form_email');
        if (!$contactEmail || !filter_var($contactEmail->value, FILTER_VALIDATE_EMAIL)) {
            return res()->error("Contact email were not set, if you're an admin please add contact_form_email to your panel settings.");
        }
        $appName = config('app.name');
        Mail::send(
            [],
            [],
            fn($message) => $message->to($contactEmail->value)
                ->subject("{$appName} - {$request->name} Contacted you")
                ->setBody(
                    "<strong>name:</strong> {$request->name} <br>" .
                    "<strong>email:</strong> {$request->email} <br>" .
                    "<strong>phone:</strong> {$request->phone} <br>" .
                    "<strong>address:</strong> {$request->address} <br>" .
                    "<strong>message:</strong><br> {$request->message} <br>",
                    'text/html'
                )
        );
        return res()->success('Message was sent.');
    }
}
