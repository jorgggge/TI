<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use Illuminate\Http\Request;
use App;
use App\User;
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
    	$user = User::all();
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


    public function storeCompany()
    {
       $this->authorize('view');

        $attributes = $this->validatorCompany();
        $companies = Company::create($attributes);

        return redirect('/superAdmin');
    }

    protected function validatorCompany()
    {
       $this->authorize('view');

        return request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'address' => ['required', 'string', 'max:255','unique:companies'],
            'phoneNumber' => ['required', 'numeric','digits:10' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
    public function createAdmin()
    {
       $this->authorize('view');

        $companies = Company::all(['companyId', 'name']);
        return view('superAdmin.addAdmin.create', compact('companies'));
    }
    public function storeAdmin()
    {
       $this->authorize('view');

        $data = $this->validatorAdmin();
        $admins = User::create([
            'username' => $data['username'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'companyId' => $data['companyId']
        ]);


        $admins->roles()->attach(Role::where('id', 2)->first());

        return redirect('/superAdmin');
    }

    protected function validatorAdmin()
    {
       $this->authorize('view');

        return request()->validate([
            'username' => ['required', 'string','max:255', 'unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'companyId' => ['required']
        ]);
    }

    public function showCompany()
    {
        $Com = DB::table('companies') ->get();

        return view('/superAdmin/viewCompanies/create', compact('Com'));
    }

    public function showSA($id)
    {
        $Admin = DB::table('companies')
        ->where('companyId',$id)
        ->get();

        return view('superAdmin/viewCompanies/editCompany', compact('Admin'));
    }

    public function editSA(Request $request,$id)
    {
        Company::find($id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email
        ]);

        return back()->with('mensaje', 'Datos Actualizados');
    }

    public function DatosAdmin($id){
        $Admin = User::join('companies','companies.companyId','users.companyId')
        ->select('users.*','companies.*','users.email as emailuser','companies.email as emailcompany')
        ->where('users.id',$id)->get();

        return $Admin->toJson();
    }


    public function history()
    {

        $Historial = History::all();

        return view('superAdmin.history',compact('Historial'));
    }
}
