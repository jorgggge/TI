<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
use App\Company;

class ViewCustomerSuperAController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

    }

    public function show(Request $request,$id)
    {
        $request->user()->authorizeRoles(['superAdmin']);
    	$Admin = User::join('companies','companies.companyId','users.companyId')
        ->select('users.*','companies.*','users.email as emailuser','companies.email as emailcompany')
        ->where('users.id',$id)->get();

    	return view('superAdmin/viewCostumers/viewcustomersuperadmin' ,compact('Admin'));
    	//return view('superAdmin/viewcustomersuperadmin');
    }

    public function update(Request $request,$uid,$cid)
    {
        // $this->authorize('update', $request, $cid, $uid);

        User::find($uid)->update([
            'username' => $request->username,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'email' => $request->emailuser
        ]);

        Company::find($cid)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->emailcompany
        ]);

        return back()->with('mensaje', 'Datos Actualizados');

    }

    public function delete($Id,$A)
    {
        
        User::find($Id)->update(['status' => intval($A)]);

        return redirect("/superAdmin/admins");
    }

    public function Companydelete($Id,$A)
    {
        
        Company::find($Id)->update(['status' => intval($A)]);

        return redirect("/superAdmin/company");
    }
    

}
