<?php
namespace App\Http\Controllers\Auth;
use App\Company;
use App\User;
use App\Role;
use App\History;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    public function username()
{
    return 'username';
}
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated($request, $user)
    {
        $companyStatus = Company::where('companyId',$user->companyId)->get();
        if ($companyStatus[0]->status == 1){
                if ($user->status !=  0) {
                        if($user->hasRole('superadmin')) {
                            return redirect('/superAdmin/company');
                        } elseif ($user->hasRole('admin')) {
                            History::Logs('Inicio de Sesión Admin');
                            return redirect('/admin');
                        } elseif ($user->hasRole('analista')) {
                            History::Logs('Inicio de Sesión Analista');
                            return redirect('/analista');
                        }
                        elseif ($user->hasRole('comun')){
                            History::Logs('Inicio de Sesión Común');
                            return redirect('/comun');
                        }
                        else{
                            return redirect('/login');
                        }
                }else{
                        Auth::logout();
                        return view('sorry')->with('User',true);
                }
        }
        else{
            Auth::logout();
            return view('sorry')->with('Company',true);
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
