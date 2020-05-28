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

    public function VR(Request $request,$areaId)
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

        $request->validate([
            'username' => ['required', 'string','max:255', 'unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'role' => ['required'],
            'areas' => ['required']
        ]);
        $user = auth()->user();
        $companyId = $user->companyId;
        $areas = $request->input('areas');


        $userAdd = User::create([
            'username' => $request['username'],
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'companyId' => $companyId,
            'status' => 1
        ]);
        foreach ($areas as $area) {
            $userAdd->areas()->attach($area);
        }

        Role_User::create([
            'role_id' => $request['role'],
            'user_id' => $userAdd->id
        ]);

        return redirect('/admins/user')->with('success', true);
    }

    public function show(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin']);
        $User = User::where('id',$id)->get()->toArray();

        $Areas = Area::where('companyId',$User[0]['companyId'])
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

        return redirect('/admin')->with('success',true);
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

    public function storeArea($name)
    {
        if ($name != "null") {
            $attributes['name'] = $name;
        $attributes['companyId'] = Auth::user()->companyId;
        $area = Area::create($attributes);

        $userId = Auth::id();
        $companyId = User::giveMeCompany(Auth::user());
        $areas = DB::table('areas')->where('areas.companyId','=',$companyId)->get()->toArray();
        }
        return redirect('/admin');
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

        $request->validate([
          'username' => 'required|string',
          'lastName' => 'required|string',
          'firstName' => 'required|string',
          'emailuser' => 'required|string'
        ]);

        User::find($id)->update([
            'username' => $request->username,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'email' => $request->emailuser

        ]);

        return back()->with('success',true);
    }

    public function UpdateMaturity(Request $request)
    {
        $request->validate([
            'maturityName1' => 'required|string',
            'maturityName2' => 'required|string',
            'maturityName3' => 'required|string',
            'maturityName4' => 'required|string',
            'maturityName5' => 'required|string',
        ]);

        $id = Auth::user()->companyId;

        $Cant = DB::table('maturity_levels')->where('companyId',$id)->get();
        $c = 1;
        foreach ($Cant as $T)
        {
            DB::table('maturity_levels')
            ->where([['companyId','=',$id], ['maturityLevelId','=',$T->maturityLevelId]])
            ->update(['description' => $request->{"maturityName".$c}]);
            $c++;
        }
        return back();
    }

    public function history()
    {
        $id = Auth::user()->companyId;

        $C = DB::table('companies')->where('companyId',$id)->get(); 
        $v ="";
        foreach ($C as $T)
        {
            $v = $T->name;
        }

        $Historial = History::all()->where('company',$v);

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

    public function Pruebahome()
    {

        $user = auth()->user();
        $userId = $user->companyId;

        $Pruebas = Area::join('tests','areas.areaId','tests.areaId')
                        ->join('test_concept','tests.testId','test_concept.testId')
                        ->join('concepts','test_concept.conceptId','concepts.conceptId')
                        ->select('areas.name as area','areas.areaId','tests.name as test','concepts.description as concept','tests.testId as testId','concepts.conceptId as conceptId')
                        ->where('areas.companyId',$userId )->get();

        $Concepts = Area::join('tests','areas.areaId','tests.areaId')
                        ->select('areas.name as area','areas.areaId','tests.name as test','tests.testId as testId')
                        ->where('areas.companyId',$userId )->get();



        return view('admins.area.test.index',compact ('Pruebas','Concepts'));
    }

    public function PruebaCreate()
    {
        return view('admins.area.test.add');
    }
    

    public function Userdelete($Id,$A)
    {
        
        User::find($Id)->update(['status' => intval($A)]);
    }


    public function viewResults(Request $request,$areaId)
    {

        $Tests = Test::all()->where('areaId',$areaId);

        foreach ($Tests as $T) {

            $Concepts = DB::table('test_concept')->where('testId',$T->testId)->get();

            $Acu = 0;

            foreach ($Concepts as $value) {
                
                $Valores = Concept::join('concept_maturity_level', 'concepts.conceptId','concept_maturity_level.conceptId')
                       ->join('concept_maturity_level_attribute','concept_maturity_level.conceptMLId','concept_maturity_level_attribute.conceptMLId')
                       ->join('evidences','concept_maturity_level_attribute.attributeid','evidences.attributeid')
                       ->where(
                        ['concepts.conceptId' => $value->conceptId],
                        ['evidences.verified'=> 1])
                       ->select(DB::raw('Count(evidences.evidenceId) as Puntaje'))->get();

                foreach ($Valores as $v) {
                    $R = $v->Puntaje;

                }

                $Acu += $R;
            }

            $Count_Users = DB::table('test_user')->where('testId',$T->testId)->count();


            $Count_Concepts = DB::table('test_concept')->where('testId',$T->testId)->count();

            $companyId = User::giveMeCompany(Auth::user());

            $Levels = MaturityLevel::all()->where('companyId',$companyId);


            if ($Count_Users != 0 && $Count_Concepts != 0) {
                $Res = round(( $Acu /($Count_Concepts * $Count_Users * 15)*100),2);
            }else{
                $Res = 0;
            }
            

            $X = 20;
            $L = "";

            foreach ($Levels as $Level) {
                
                if($X >= $Res){
                    $L = $Level->description;
                    break;
                }else{
                    $X += 20;
                }
            }

            $Resultados[] = array("Test" => $T->testId." ".$T->name,"Resultado" => $Res,"Nivel" => $L);

        }


         

        return json_encode($Resultados);
    }


    public function test_update($testId,$areasId)
    {

        $users = User::join('user_areas','users.id','user_areas.userId')
                     ->join('role_user','users.id','role_user.user_id')
                     ->where('user_areas.areaId', $areasId)
                     ->where('role_user.role_id', 4)
                    ->get();

        $test_users = DB::table('test_user')->where('testId',$testId)->get();

        $test = Test::all()->where('testId',$testId);

        foreach ($test as $value) {
            $testname = $value->name;
        }

        return view('admins.area.test.edit', compact('users','testname','testId','test_users'));
    }
}
