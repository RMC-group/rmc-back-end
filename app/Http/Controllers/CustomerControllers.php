<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerControllers extends Controller
{

    // save customer
    public function saveCustomer(Request $request)
    {
        $validator = validator::make($request->all(), [
            'cust_name' => 'required|string|max:191',
            'cust_contact' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'nic' => 'required|string|max:191',
            'emill' => 'required|string|max:191'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $userId = Auth::id();
            $customer = new Customer();
            $customer->cust_name = $request->cust_name;
            $customer->cust_contact = $request->cust_contact;
            $customer->address = $request->address;
            $customer->nic = $request->nic;
            $customer->emill = $request->emill;
            $customer->user_id = $userId;

            $result = $customer->save();
            return response()->json([
                'status' => 200,
                'message' => "customer saved successfully",
                'result' => $result,
            ], 200);
        }
    }


    // update Customer
    public function updateCustomer(Request $request, string $id)
    {
        $validator = validator::make($request->all(), [
            'cust_name' => 'required|string|max:191',
            'cust_contact' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'nic' => 'required|string|max:191',
            'emill' => 'required|string|max:191'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $customer = Customer::find($id);
            $customer->cust_name = $request->cust_name;
            $customer->cust_contact = $request->cust_contact;
            $customer->address = $request->address;
            $customer->nic = $request->nic;
            $customer->emill = $request->emill;
            $customer->user_id = $request->user_id;

            $result = $customer->save();
            return response()->json([
                'status' => 200,
                'message' => "customer update successfully",
                'result' => $result,
            ], 200);
        }
    }


    // search Customer
    public function searchCustomer(string $input)
    {
        $company = Customer::select()
            ->where('cust_name', 'LIKE', '%' . $input . '%')
            ->orWhere('cust_contact', 'LIKE', '%' . $input . '%')
            ->orWhere('nic', 'LIKE', '%' . $input . '%')
            ->orWhere('emill', 'LIKE', '%' . $input . '%')
            ->get();
        return response()->json($company, 201);
    }


    // getAll Customer
    public function getAllCustomer()
    {
        $data = Customer::with([
            'users'
        ])->get();
        return response()->json($data, 200);
    }


    // delete Customer
    public function delete(int $id)
    {
        $company = Customer::find($id);
        $company->delete();
        return response()->json($company, 201);
    }
}
