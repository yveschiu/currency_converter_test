<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConvertRequest;
use App\Services\CurrencyConvertService;
use Exception;

class CurrencyConverterController extends Controller
{
    public function convert(CurrencyConvertRequest $request, CurrencyConvertService $currencyConvertService)
    {
        $data = $request->validated();
        $sourceCurrency = $data['source'];
        $targetCurrency = $data['target'];
        $amount = (float) str_replace('$', '', str_replace(',', '', $data['amount']));

        try {
            $convertedAmount = $currencyConvertService->convert($amount, $sourceCurrency, $targetCurrency);
        } catch (Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }

        return response()->json([
            'msg' => 'success',
            'amount' => '$' . number_format($convertedAmount, 2, '.', ',')
        ]);
    }
}
