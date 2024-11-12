<?php

namespace App\Http\Controllers\Backend;

use App\Enums\KYCStatus;
use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Models\User;
use App\Traits\NotifyTrait;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Validator;

class KycController extends Controller
{
    use NotifyTrait;

    public function __construct()
    {
        $this->middleware('permission:kyc-form-manage', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->middleware('permission:kyc-list', ['only' => ['KycPending', 'kycAll', 'KycRejected']]);
        $this->middleware('permission:kyc-action', ['only' => ['depositAction', 'actionNow']]);
    }

    public function index()
    {
        $kycs = Kyc::all();
        return view('backend.kyc.index', compact('kycs'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:kycs,name',
            'status' => 'required',
            'fields' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }

        $data = [
            'name' => $input['name'],
            'status' => $input['status'],
            'fields' => json_encode($input['fields']),
        ];

        $kyc = Kyc::create($data);
        notify()->success($kyc->name . ' ' . __(' KYC Created'));
        return redirect()->route('admin.kyc-form.index');
    }

    public function create()
    {
        return view('backend.kyc.create');
    }

    public function show(Kyc $kyc)
    {
        return view('backend.kyc.edit', compact('kyc'));
    }

    public function edit($id)
    {
        $kyc = Kyc::find($id);
        return view('backend.kyc.edit', compact('kyc'));
    }

    public function destroy($id)
    {
        Kyc::find($id)->delete();
        notify()->success(__('KYC Deleted Successfully'));
        return redirect()->route('admin.kyc-form.index');
    }

    public function KycPending(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('kyc', KYCStatus::Pending->value)->latest('updated_at');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', 'backend.kyc.include.__time')
                ->addColumn('user', 'backend.kyc.include.__user')
                ->addColumn('type', 'backend.kyc.include.__type')
                ->addColumn('status', 'backend.kyc.include.__status')
                ->addColumn('action', 'backend.kyc.include.__action')
                ->rawColumns(['time', 'user', 'type', 'status', 'action'])
                ->make(true);
        }
        return view('backend.kyc.pending');
    }

    public function KycRejected(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('kyc', KYCStatus::Failed->value)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', 'backend.kyc.include.__time')
                ->addColumn('user', 'backend.kyc.include.__user')
                ->addColumn('type', 'backend.kyc.include.__type')
                ->addColumn('status', 'backend.kyc.include.__status')
                ->addColumn('action', 'backend.kyc.include.__action')
                ->rawColumns(['time', 'user', 'type', 'status', 'action'])
                ->make(true);
        }
        return view('backend.kyc.rejected');
    }

    public function depositAction($id)
    {
        $user = User::find($id);
        $kycCredential = json_decode($user->kyc_credential, true);

        if (isset($kycCredential['kyc_type_of_name'])) {
            unset($kycCredential['kyc_type_of_name']);
        }
        if (isset($kycCredential['kyc_time_of_time'])) {
            unset($kycCredential['kyc_time_of_time']);
        }

        foreach ($kycCredential as $key => $value) {
            if (is_array($value)) {
                $kycCredential[$key] = json_encode($value);
            }
        }

        $kycStatus = $user->kyc;
        return view('backend.kyc.include.__kyc_data', compact('kycCredential', 'id', 'kycStatus'))->render();
    }

    public function actionNow(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['id']);
        $kycCredential = json_decode($user->kyc_credential, true);
        $kycCredential = array_merge($kycCredential, ['Action Message' => $input['message']]);

        $user->update([
            'kyc' => $input['status'],
            'kyc_credential' => json_encode($kycCredential),
        ]);

        $shortcodes = [
            '[[full_name]]' => $user->full_name,
            '[[email]]' => $user->email,
            '[[site_title]]' => setting('site_title', 'global'),
            '[[site_url]]' => route('home'),
            '[[kyc_type]]' => $kycCredential['kyc_type_of_name'] ?? 'N/A',
            '[[message]]' => $input['message'],
            '[[status]]' => $input['status'],
        ];

        $this->mailNotify($user->email, 'kyc_action', $shortcodes);
        $this->smsNotify('kyc_action', $shortcodes, $user->phone);
        $this->pushNotify('kyc_action', $shortcodes, route('user.kyc'), $user->id);

        notify()->success(__('KYC Update Successfully'));
        return redirect()->route('admin.kyc.all');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:kycs,name,' . $id,
            'status' => 'required',
            'fields' => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }

        $data = [
            'name' => $input['name'],
            'status' => $input['status'],
            'fields' => json_encode($input['fields']),
        ];

        $kyc = Kyc::find($id);
        $kyc->update($data);
        notify()->success($kyc->name . ' ' . __(' KYC Updated'));
        return redirect()->route('admin.kyc-form.index');
    }

    public function kycAll(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereNotNull('kyc_credential')->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', 'backend.kyc.include.__time')
                ->addColumn('user', 'backend.kyc.include.__user')
                ->addColumn('type', 'backend.kyc.include.__type')
                ->addColumn('status', 'backend.kyc.include.__status')
                ->addColumn('action', 'backend.kyc.include.__action')
                ->rawColumns(['time', 'user', 'type', 'status', 'action'])
                ->make(true);
        }
        return view('backend.kyc.all');
    }
}