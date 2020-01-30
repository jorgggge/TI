<?php

namespace App\Http\Controllers;

use App\Area;
use App\Attribute;
use App\Concept;
use App\Test;
use App\User;
use App\Role;
use App\User_Area;
use App\Company;
use App\Role_User;
use App\MaturityLevel;
use App\History;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function foo\func;

class AdminsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        //for maturity level
        $user = auth()->user();
        $userIdenti = $user-> companyId;
        $CountMaturity = MaturityLevel::where('companyId','=',$userIdenti)->count();
        //for areas
        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();
        if ($CountMaturity == 0) {
            return view('admins.maturity.addML', compact('areas'));
        }
        else {
            return view('admins.index', compact('areas'));
        }
    }

    public function viewResults(Request $request,$areaId)
    {
        $request->user()->authorizeRoles(['admin']);
        $companyId = User::giveMeCompany(Auth::user());
        $areas = Area::where('companyId',$companyId)->get()->toArray();
        $areasId = array_column($areas,'areaId');
        $tests = Test::testFromAnAreaId($areaId);
        $testsIds=array_column($tests,'testId');

        $areaSeleccionada= Area::where('areaId',$areaId)->first();
        $maturityLevels = MaturityLevel::where('companyId',$companyId)->get()->toArray();

        abort_if(!in_array($areaId,$areasId),403);//Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla

        if(empty($areas)){//Verifica si la compania del usuario tiene areas. si no lo manda a crear un area
            return redirect('/admins/area/addArea');
        }

        $testsConcepts = Concept::ConceptsFromAnArrayOfTestsIds($testsIds);
        $testsConceptsIds = array_column((array)$testsConcepts,'testConceptId');
        $results=[];
        foreach ((array) $testsConceptsIds as $item)
        {
            $conceptsResults[] = DB::select('call p_fetch_verified_evidences(?)',array($item));
            $results[] = (array)$conceptsResults[array_search($item,$testsConceptsIds)][0];
        }
        return view('admins.viewResults.results',compact([
            'areas',
            'areaSeleccionada',
            'tests',
            'testsConcepts',
            'maturityLevels',
            'results'
        ]));
    }

    public function indexUser(Request $request)
    {
        $request->user()->authorizeRoles(['superAdmin','admin']);
        $role = Role_User::all();
        $companies = Company::all();
        $admins = User::all();
        return view('admins.user.index', compact('admins', 'companies', 'role'));
    }

    public function createUser(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = User::giveMeCompany(Auth::user());//Me regresa el company id del usuario actualmete loggeado
        $areas = Area::where('companyId',$userCompany)->get()->toArray();
        $roles = Role::all(['id', 'name']);

        $countAreas = Area::where('companyId','=',$userCompany)->count();
        if($countAreas == 0){
            return redirect('/admins/area/addArea');
        }
        else{
            return view('admins.user.addUser.create', compact('roles','areas', 'userCompany'));
        }
    }

    public function storeUser(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $companyId = $user->companyId;
        $areas = $request->input('areas');

        $data = $this->validatorUser();
        $userAdd = User::create([
            'username' => $data['username'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'companyId' => $companyId
        ]);

        foreach ($areas as $area) {
            $userAdd->areas()->attach($area);
        }

        Role_User::create([
            'role_id' => $data['role'],
            'user_id' => $userAdd->id
        ]);

        return redirect('/admins/user/index');
    }

    public function show(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin']);
        $User = User::find($id)->toArray();
        $Areas = Area::where('companyId',$User['companyId'])
            ->get();
        $User_Area = Area::join('user_areas','user_areas.areaId','=','areas.areaId')
            ->where('userId',$id)
            ->get();
        $Validar = false;
        $Array_Areas = array();
        foreach ($Areas as $A) {
            foreach ($User_Area as $UA) {
                if($A->areaId == $UA->areaId){
                    $Validar = true;
                }
            }
            $Array_Areas[] = array('validar' => $Validar,'name' => $A->name,'areaId' => $A->areaId );
            $Validar = false;
        }
        return view('admins/user/update' ,compact('User','Areas','User_Area','Array_Areas'));
    }

    public function storeMaturityLevel(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $descriptions = $request->input('description');
        $data = $this->validatorMaturityLevel();
        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();

        $i = 1;
        do{
        foreach ($data as $description) {
             //dd($description[0]);
                MaturityLevel::create([
                    'description' => $description[$i -1],
                    'companyId' => $companyId,
                    'level' => $i
                ]);
                $i++;
        }
        }while ($i < 6);

        return view('admins.index', compact('areas'));
    }

    public function validatorUser()
    {
        return request()->validate([
            'username' => ['required', 'string','max:255', 'unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'role' => ['required'],
            'areas' => ['required']
        ]);
    }

    public function validatorMaturityLevel()
    {
        return request()->validate([
            'description' => ['required','max:255']
        ]);
    }

    public function editMaturityLevel(Request $request)
    {
        $id = Auth::user()->companyId;
        $Mad = DB::table('maturity_levels') ->where('companyId',$id)->orderby('level')->get();
        $Comp = DB::table('companies') ->where('companyId',$id)->get();

        return view('admins/maturity/editML',compact('Mad','Comp'));
    }

    protected function validator()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
    }

    public function createArea(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('admins.area.addArea');
    }

    public function storeArea(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $attributes = $this->validator();
        $attributes['companyId'] = Auth::user()->companyId;
        $area = Area::create($attributes);

        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();
        return view('admins.index', compact('areas'));
    }

    public function showUsers(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $id = Auth::user()->companyId;

        $Users = User::join('role_user','role_user.user_id','users.id')
            ->select('users.*','role_user.role_id')
            ->where('users.companyId',$id)
            ->where('role_user.role_id','>',2)->get();

        return view('admins/user/index',compact('Users'));

    }

    public function DeleteUsers(Request $request, $id)
    {
        /*DB::table('user_areas') ->where('userId',$id)->delete();
        DB::table('evidences') ->where('userId',$id)->delete();
        DB::table('test_user') ->where('userId',$id)->delete();
        $DeleteUser = User::findOrFail($id);
        $DeleteUser->delete();*/
        $t = DB::table('test_user') ->where('userId',$id)->value('testId');
        //dd($t);
        Test::DeleteTest($t);
        DB::table('user_areas') ->where('userId',$id)->delete();
        $DeleteUser = User::findOrFail($id);
        $DeleteUser->delete();

        return redirect('/admins/user/index');
    }

    public function UpdateUsers(Request $request, $id)
    {

        User_Area::where('userId',$id)->delete();

        //return view('admins/users/update');
        User::find($id)->update([
            'username' => $request->username,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'email' => $request->emailuser

        ]);

        $A = $request->toArray();
        $Count = 1;
        foreach ($A as $Value) {

            if($Count > 6){
                User_Area::insert([
                    'userId' => $id,
                    'areaId' => $Value
                ]);
            }
            $Count++;
        }

        return back()->with('status','kk');
    }

    public function UpdateMaturity(Request $request)
    {
        $id = Auth::user()->companyId;
        $Cant = DB::table('maturity_levels') ->where('companyId',$id)->get();
        foreach ($Cant as $T)
        {
            DB::table('maturity_levels')
            ->where([['companyId','=',$id], ['maturityLevelId','=',$T->maturityLevelId]])
            ->update(['description' =>$request->maturityName[$T->maturityLevelId]]);
        }
        return back();
    }

    public function history()
    {

        $C = Company::find(Auth::user()->companyId)->toArray();

        $Historial = History::all()->where('company',$C['name']);

        return view('admins.history',compact('Historial'));
    }

     public function historydelete()
    {
        $C = Company::find(Auth::user()->companyId)->toArray();

        History::where('id','>','0')
                ->where('company',$C['name'])
                ->delete();
        return back();
    }

    public function EditTest()
    {
        $id = Auth::user()->companyId;
        $Comp = DB::table('companies') ->where('companyId',$id)->get();
        $Area = DB::table('areas') ->where('companyId',$id)->get();
        return view('admins/area/test/edit',compact('Area','Comp'));
    }

    public function showArea($id)
    {
         $TestId  = DB::table('tests') ->where('areaId',$id)->get();
         return $TestId->toJson();
    }

    public function showtest($id)
    {
         $TestId  = DB::table('tests') ->where('areaId',$id)->get();
         return $TestId->toJson();
    }

    public function showconcept($id)
    {
        $test_concept = Concept::join('test_concept','concepts.conceptId','test_concept.conceptId');
        $test_concept = $test_concept->where('testId',$id)->get();

        $list_users = User::join('role_user','users.id','role_user.user_id')
                            ->where([
                                ['companyId',Auth::user()->companyId],
                                ['role_id','4']
                            ])->select('users.*')->get();

        $test_user = User::join('test_user','users.id','test_user.userId')->where('testId',$id)->get();

        return array($test_concept->toJson(),$list_users->toJson(),$test_user->toJson());
    }

    public function showLevelM($id)
    {

        $MLevel = DB::table('concept_maturity_level as CML')
        ->select('ML.description','ML.maturityLevelId')
        ->join('maturity_levels as ML','ML.maturityLevelId','CML.maturityLevelId')
        ->where('conceptId',$id)->get();

        return  $MLevel->toJson();
    }

    public function showAtributtes($id)
    {
        $Attributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
                        ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
                        ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
                        ->select('attributes.attributeId','attributes.description as AD','ML.description as ML')
                        ->where('CML.conceptId',$id)->orderBy('ML.description')->get();
        return  $Attributes->toJson();
    }
}
