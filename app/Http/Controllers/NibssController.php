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

    /**
     * @OA\Post(
     *     path="/api/bvn/verify",
     *     tags={"NIBSS"},
     *     summary="Verify BVN",
     *     description="Checks validity of a BVN and returns customer details",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"bvn"},
     *             @OA\Property(property="bvn", type="string", example="22123456789")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="BVN verified successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/direct-debit",
     *     tags={"NIBSS"},
     *     summary="Initiate Direct Debit",
     *     description="Creates a direct debit mandate",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"account_number","amount","frequency"},
     *             @OA\Property(property="account_number", type="string", example="1234567890"),
     *             @OA\Property(property="amount", type="number", example=5000),
     *             @OA\Property(property="frequency", type="string", example="monthly")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Direct debit mandate created"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/transfer",
     *     tags={"NIBSS"},
     *     summary="Fund Transfer",
     *     description="Send money from one bank account to another",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"from_account","to_account","amount","bank_code"},
     *             @OA\Property(property="from_account", type="string", example="1234567890"),
     *             @OA\Property(property="to_account", type="string", example="0987654321"),
     *             @OA\Property(property="amount", type="number", example=2500),
     *             @OA\Property(property="bank_code", type="string", example="044"),
     *             @OA\Property(property="reference", type="string", example="TXN-0012345")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transfer successful"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
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
