<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    public function userTransactions(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function userCurrency(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('currency')) {
            $data = $this->transactionService->userCurrency($request->query('currency'), $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function statusCode(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('statusCode')) {
            $data =  $this->transactionService->statusCode($request->query('statusCode'), $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function transactionCurrency(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('currency')) {
            $data = $this->transactionService->currency($request->query('currency'), $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function userDate(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('created_at')) {
            $data = $this->transactionService->userDate($request->query('created_at'), $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function amountRange(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('amounteMin') && $request->query('amounteMax')) {
            $data =  $this->transactionService->amountRange($request, $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }
    public function dateRange(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($request->query('startDate') && $request->query('endDate')) {
            $data =  $this->transactionService->dateRange($request, $data);
        }
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this search');
        }
    }



}
