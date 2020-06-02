<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use Illuminate\Http\Request;
use App;
use App\User;
use App\Test;
use App\History;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Validator;

class SuperAdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified']);
    }

    public function Home()
    {
        return view('superAdmin.home');
    }

    public function showAdmins(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin']);

        $Admins = User::join('companies','companies.companyId','=','users.companyId')
            ->join('role_user','role_user.user_id','=','users.id')
            ->select('companies.*','users.firstName','users.lastName','users.username','users.id','users.status as S')
            ->where('role_user.role_id','2')->get();

        return view('superAdmin.index', compact('Admins'));
    }

    public function create()
    {
       $this->authorize('view');
       $countCompanies = Company::where('status','=','1')->count();

       if($countCompanies == 0){
            return view('superAdmin.addCompany.create');
       }
       else{
            return view('superAdmin.create');
       }
    }

    public function createCompany() 
    {
        $this->authorize('view');
        return view('superAdmin.addCompany.create');
    }


    public function storeCompany(Request $request)
    {

        $request->validate([
          'name' => 'required|string',
          'address' => 'required|string',
          'phoneNumber' => 'required|string|min:10|regex:/^\d+$/',
          'email' => 'required|string'
        ]);

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email
        ]);


        return redirect('/superAdmin/company')->with('successAddCompany', true);
    }

    
    public function createAdmin()
    {
        
        $companies = Company::all(['companyId', 'name']);
        return view('superAdmin.addAdmin.create', compact('companies'));
    }

    public function storeAdmin(Request $request)
    {


        $request->validate([
            'username' => 'required|string','max:255|unique:users',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'passwordc' => 'required',
            'companyId' => 'required'
        ]);


        if($request->password == $request->passwordc){

            $admins = User::create([
            'username' => $request->username,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'companyId' => $request->companyId
            ]);

            $admins->roles()->attach(Role::where('id', 2)->first());
            
            return redirect('/superAdmin/admins')->with('successAddAdmin', true);

        }else{

            return back()->with('error_pass', true);
        }
      
    }


    public function showCompany()
    {
        $Com = DB::table('companies') ->get();
        return view('superAdmin.viewCompanies.index', compact('Com'));
    }

    public function showSA($id) // Edit Company
    {
        $Admin = DB::table('companies')
        ->where('companyId',$id)
        ->get();

        return view('superAdmin.viewCompanies.editCompany', compact('Admin'));
    }

    public function editSA(Request $request,$id)
    {

        $request->validate([
          'name' => 'required|string',
          'address' => 'required|string',
          'phoneNumber' => 'required|string|regex:/^\d+$/',
          'email' => 'required|string'
        ]);


        Company::find($id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email
        ]);

        return back()->with('successUpCompany',true);

    }

    public function history()
    {

        $Historial = History::all();

        return view('superAdmin.history',compact('Historial'));
    }

    public function historydelete()
    {
        History::where('id','>', 0)->delete();
        return back()->with('success',true);
    }

    public function DeleteCompany($id)
    {
        $Areas = DB::table('areas')->where('companyId',$id)->get();

        if($Areas != null){
            foreach ($Areas as $area) {

                $Tests =  DB::table('tests')->where('areaId',$area->areaId)->get();

                if($Tests != null){
                    foreach ($Tests as $Test) {
                        echo $Test->testId;
                        Test::DeleteTest($Test->testId);
                    }
                }

                DB::table('user_areas')->where('areaId',$area->areaId)->delete();
            }
        }

        DB::table('maturity_levels')->where('companyId',$id)->delete();

        $Users = DB::table('users')->where('companyId',$id)->get();

        foreach ($Users as $User) {
             DB::table('role_user')->where('user_id',$User->id)->delete();
        }
        DB::table('areas')->where('companyId',$id)->delete();

        DB::table('users')->where('companyId',$id)->delete();
        DB::table('companies')->where('companyId',$id)->delete();


    }
}
