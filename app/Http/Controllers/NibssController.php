<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\NibssService;
use Illuminate\Support\Facades\Validator;

class NibssController extends Controller
{
    use ApiResponse;
    protected $nibss;

    public function __construct(NibssService $nibss)
    {
        $this->nibss = $nibss;
    }

    public function verifyBVN(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bvn' => 'required|digits:11'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', $validator->errors(), 422);
        }

        $result = $this->nibss->verifyBVN($request->bvn);

        return $this->success($result, 'BVN verification successful');
    }

    public function directDebit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|digits_between:10,12',
            'amount' => 'required|numeric|min:1',
            'frequency' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', $validator->errors(), 422);
        }

        $result = $this->nibss->initiateDirectDebit($request->all());

        return $this->success($result, 'Direct debit mandate initiated');
    }

    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account' => 'required|digits_between:10,12',
            'to_account' => 'required|digits_between:10,12',
            'amount' => 'required|numeric|min:1',
            'bank_code' => 'required|string|max:6',
            'reference' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', $validator->errors(), 422);
        }

        $result = $this->nibss->transferFunds($request->all());

        return $this->success($result, 'Transfer successful');
    }
}
