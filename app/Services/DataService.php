<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Stock;
use App\Models\CustomerTotalPayApp;
use Illuminate\Http\Request;

class DataService
{
    public function fetchCustomers(Request $request)
    {
        $searchTerm = $request->input("term");
        $query = Customer::select('id', 'companycode', 'companyname', 'contactperson', 'terms_id')
            ->orderBy('companycode', 'asc');

        if (strlen($searchTerm) > 5) {
            $query->where('companyname', 'like', '%' . $searchTerm . '%');
        } else {
            $query->where('companycode', 'like', '%' . $searchTerm . '%');
        }

        $data = $query->get();

        $arr_return = $data->map(function ($customer) {
            return [
                "id" => $customer->id,
                "text" => "{$customer->companycode} - {$customer->companyname}",
            ];
        })->toArray();


        return $arr_return;
    }

    public function fetchStocks(Request $request)
    {
        $searchTerm = $request->input("q");

        $data = Stock::select('id', 'stockcode', 'stockname')
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('stockname', 'like', '%' . $searchTerm . '%')
                                ->orWhere('stockcode', 'like', '%' . $searchTerm . '%');
                        })
                        ->get();

        $arr_return = $data->map(function ($rdt) {
            return [
                "id" => $rdt->id,
                "text" => $rdt->stockname,
            ];
        })->toArray();

        return $arr_return;
    }
}
