<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\KYCStatus;
use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Traits\ImageUpload;
use App\Traits\NotifyTrait;
use Illuminate\Http\Request;
use Validator;

class KycController extends Controller
{
    use ImageUpload, NotifyTrait;

    public function kyc()
    {
        $kycs = Kyc::where('status', true)->get();
        return view('frontend::user.kyc.index', compact('kycs'));
    }

    public function kycData($id)
    {
        $fields = Kyc::find($id)->fields;
        return view('frontend::user.kyc.data', compact('fields'))->render();
    }

    public function submit(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'kyc_id' => 'required',
            'kyc_credential' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }

        $kyc = Kyc::find($input['kyc_id']);
        $kycCredential = array_merge($input['kyc_credential'], ['kyc_type_of_name' => $kyc->name, 'kyc_time_of_time' => now()]);

        $user = \Auth::user();

        // Deleting old KYC credentials if they exist
        if ($user->kyc_credential) {
            foreach (json_decode($user->kyc_credential, true) as $key => $value) {
                if (is_string($value) && file_exists(public_path($value))) {
                    unlink(public_path($value));
                }
            }
        }

        // Processing and uploading new files
        foreach ($kycCredential as $key => $value) {
            if (is_file($value)) {
                $kycCredential[$key] = self::imageUploadTrait($value);
            }
        }

        // Updating user's KYC credential and status
        $user->update([
            'kyc_credential' => json_encode($kycCredential),
            'kyc' => KYCStatus::Pending,
        ]);

        // Setting up shortcodes for notification
        $shortcodes = [
            '[[full_name]]' => $user->full_name,
            '[[email]]' => $user->email,
            '[[site_title]]' => setting('site_title', 'global'),
            '[[site_url]]' => route('home'),
            '[[kyc_type]]' => $kyc->name,
            '[[status]]' => 'Pending',
        ];

        // Sending notifications
        $this->mailNotify(setting('site_email', 'global'), 'kyc_request', $shortcodes);
        $this->pushNotify('kyc_request', $shortcodes, route('admin.kyc.pending'), $user->id);

        notify()->success(__('KYC Updated'));
        return redirect()->route('user.kyc');
    }
}
