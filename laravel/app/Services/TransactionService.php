<?php

namespace App\Services;

use App\Enums\DataTransactionStatusEnum;
use App\Enums\StatusCodeTypeEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class TransactionService
{
    // function return all the available providerDataProvider(W/X/Y).
    public function readProviders(): array
    {
        $jsonFilePaths = glob(public_path('*.json'));
        $combinedData = [];
        foreach ($jsonFilePaths as $jsonFilePath) {
            // Read the JSON file contents into a string
            $jsonString = file_get_contents($jsonFilePath);

            // Convert the JSON string to an array using the json_decode function
            $jsonData = json_decode($jsonString, true);

            // Merge the current JSON data into the combined data array
            $combinedData = array_merge($combinedData, $jsonData);
        }
        return $combinedData;
    }

    // return all data with search statusCode in all json files like(/api/v1/transactions?statusCode=auth)
    public function statusCode($status, $data): \Illuminate\Http\JsonResponse|array
    {
        $searchResults = [];
        $statusValues = array();
        if ($status == StatusCodeTypeEnum::AUTHORIZED->value) {
            $statusValues = array(
                DataTransactionStatusEnum::AUTHORIZED->value
            );
        } elseif ($status == StatusCodeTypeEnum::DECLINE->value) {
            $statusValues = array(
                DataTransactionStatusEnum::DECLINE->value
            );
        } elseif($status == StatusCodeTypeEnum::REFUNDED->value) {
            $statusValues = array(
                DataTransactionStatusEnum::REFUNDED->value
            );
        } else {
            return response()->json('No data is available for this search');
        }

        foreach ($data['transactions'] as $item) {
            if (array_key_exists('statusCode', $item)  && in_array($item['statusCode'], $statusValues)) {

                $searchResults[] = $item;
            }
        }
        return $searchResults;
    }

    // return all data with search amountRange in all json files like( /api/v1/transactions?currency=EGP)
    #[NoReturn] public function currency($search, $data): array
    {
        return array_filter($data['transactions'], function ($item) use ($search) {
            return (array_key_exists('Currency', $item) && $item['Currency'] == $search
            );
        });
    }

    // return all data with search amountRange in all json files like(/api/v1/transactions?amounteMin=10&amounteMax=100 iwith including 10 and 100.)
    public function amountRange(Request $request, $data): array
    {

        $results = array_filter($data['transactions'], function ($item) use ($request) {
            return (
            (
                array_key_exists('paidAmount', $item) && $item['paidAmount'] >= $request->amounteMin && $item['paidAmount'] <= $request->amounteMax)
            );
        });
        return $results;
    }

    // return all data with search amountRange in all json files like(/api/v1/transactions?startDate=2021-11-30&endDate=2022-09-07
    public function dateRange(Request $request, $data): array
    {

        $results = array_filter($data['transactions'], function ($item) use ($request) {
            return (
            (
                array_key_exists('paymentDate', $item) &&
                $item['paymentDate'] >= Carbon::createFromFormat('Y-m-d',$request->startDate) &&
                $item['paymentDate'] <= Carbon::createFromFormat('Y-m-d',$request->endDate))
            );
        });
        return $results;
    }
}

if(!function_exists('public_path'))
{
    /**
     * Return the path to public dir
     * @param string|null $path
     * @return string
     */
    function public_path(string $path = ''): string
    {
        return base_path('public') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
