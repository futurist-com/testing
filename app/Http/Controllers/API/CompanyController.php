<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function store()
    {
      //dd(request());
        $user=auth()->user();
        Company::create(['name'=>request('name'), 'description'=>request('description')])
                ->users()->attach($user->id, ['role'=>1]);   
    }
}
