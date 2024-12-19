<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankDetails;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function bankDetail()
    {
        $bank = BankDetails::get();
        return view('admin.bankdetails.bankDetails', compact('bank'));
    }
    public function addBankDetail()
    {
        return view('admin.bankdetails.addBankDetails');
    }
    public function uploadBankDetail(Request $request)
    {
        $request->validate
        ([
            'account_holder_name' => ['required'],
            'bank_name' => ['required'],
            'account_number' => ['required'],
            'branch' => ['required'],
            'iban' => ['required'],
            'bic' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $bank = new BankDetails();

            $bank->account_holder_name = $data['account_holder_name'];
            $bank->bank_name = $data['bank_name'];
            $bank->account_number = $data['account_number'];
            $bank->branch = $data['branch'];
            $bank->iban = $data['iban'];
            $bank->bic = $data['bic'];
            $bank->swift_code = $data['swift_code'];
            
            $bank->save();

            return back()->with('message', 'Bank detail uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The Bank detail failed to add');
        }
    }
    public function editBankDetail($id)
    {
        $bank = BankDetails::find($id);
        return view('admin.bankdetails.editBankDetails', compact('bank'));
    }
    public function updateBankDetail($id, Request $request)
    {
        $request->validate
        ([
            'account_holder_name' => ['required'],
            'bank_name' => ['required'],
            'account_number' => ['required'],
            'branch' => ['required'],
            'iban' => ['required'],
            'bic' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $bank = BankDetails::find($id);

            $bank->account_holder_name = $request->account_holder_name;
            $bank->bank_name = $request->bank_name;
            $bank->account_number = $request->account_number;
            $bank->branch = $request->branch;
            $bank->iban = $request->iban;
            $bank->bic = $request->bic;
            $bank->swift_code = $request->swift_code;
            
            $bank->update();

            return back()->with('message', 'Bank detail update successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The Bank detail failed to update');
        }
    }
    public function deleteBankDetail($id)
    {
        $bank = BankDetails::find($id);
        $bank->delete();
        return back()->with('message', 'Bank details delete successfully!');
    }
    public function updateBankDetailStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $item = BankDetails::find($id);
        if ($item) {
            $item->status = $request->input('status');
            $item->save();
            
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found.'], 404);
    }
}
