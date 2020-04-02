<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompany;
use App\Model\Company;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
  //
  public function show()
  {
    return $company = auth()->user()->companies()->get();
  }
  public function store(StoreCompany $request)
  {
    //dd(request('name'));
    $validated=$request->validated();
    $user = auth()->user();
    $company = Company::create(['name' => request('name'), 'description' => request('description')])
      ->users()->attach($user->id, ['role_id' => 1]);
    //dd($company);
    return response()->json([
      'status' => 200
    ]);
  }
  public function  getCompany($id){
       $company=Company::find($id);
       return response()->json([
        'company'=>$company,
        'status' => 200
      ]);
  }
  
  public function uploadLogo($id, Request $request){
    dd($request);
    $patch=$request->file('logo')->store('logo');
    dd($patch);
  }
  
  public function update($id, Request $request){
      $company=Company::find($id);
      $company->name=$request->name;
      $company->description=$request->description;
      $company->save();
  }

}
