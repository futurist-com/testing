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
        $user=auth()->user();
        $company=Company::create(['name'=>request('name'), 'description'=>request('description')])
                ->users()->attach($user->id, ['role_id'=>1]); 
      //dd($company);
        return ;  
    }
}
