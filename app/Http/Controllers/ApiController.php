<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class ApiController extends Controller
{
    public function getPing() {
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $ping = "Ping@ " .date("d M Y") . "  " .date("H:i:s");
      return response($ping, 200);
    }
    
    public function getAllAccounts() {
      $accounts = Account::get()->toJson(JSON_PRETTY_PRINT);
      return response($accounts, 200);
    }

    public function createAccount(Request $request) {
      $account = new Account;
      $account->acct_owner = $request->acct_owner;
      $account->acct_no = $request->acct_no;
      $account->acct_nric = $request->acct_nric;
      $account->acct_balance = $request->acct_balance;
      $account->save();

    return response()->json([
        "message" => "account record created"
    	], 201);
    }

    public function getAccount($id) {
      if (Account::where('id', $id)->exists()) {
        $account = Account::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($account, 200);
      } else {
        return response()->json([
          "message" => "Account not found"
        ], 404);
      }
    }

    public function getAccountByNRIC($nric) {
      if (Account::where('acct_nric', $nric)->exists()) {
        $account = Account::where('acct_nric', $nric)->get()->toJson(JSON_PRETTY_PRINT);
        return response($account, 200);
      } else {
        return response()->json([
          "message" => "Account not found"
        ], 404);
      }
    }

    public function updateAccount(Request $request, $id) {
      if (Account::where('id', $id)->exists()) {
        $account = Account::find($id);
        $account->acct_owner = is_null($request->acct_owner) ? $account->acct_owner : $request->acct_owner;
        $account->acct_no = is_null($request->acct_no) ? $account->acct_no : $request->acct_no;
        $account->acct_nric = is_null($request->acct_nric) ? $account->acct_nric : $request->acct_nric;
        $account->acct_balance = is_null($request->acct_balance) ? $account->acct_balance : $request->acct_balance;
        $account->save();

        return response()->json([
            "message" => "records updated successfully"
        ], 200);
        } else {
        return response()->json([
            "message" => "Account not found"
        ], 404);
      
    }
    }

    public function updateAccountBalanceByNRIC(Request $request, $nric) {
      if (Account::where('acct_nric', $nric)->exists()) {
        $account = Account::where('acct_nric', $nric)->first();
        $account->acct_balance = is_null($request->acct_balance) ? $account->acct_balance : $request->acct_balance;
        $account->save();

        return response()->json([
            "message" => "records updated successfully"
        ], 200);
        } else {
        return response()->json([
            "message" => "Account not found"
        ], 404);
        
    }
    }

    public function deleteAccount ($id){ 
      if(Account::where('id', $id)->exists()) {
        $account = Account::find($id);
        $account->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Account not found"
        ], 404);
      }
    }
}
