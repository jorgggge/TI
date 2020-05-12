<?php


namespace App\Http\Controllers;

use App\Area;
use App\Test;
use App\Attribute;
use App\Role;
use App\Role_User;
use App\User;
use App\Concept;
use App\User_Area;
use App\Company;
use App\MaturityLevel;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateTestController
{
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = $user->companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$userCompany)->get()->toArray();
        $roles = Role::all(['id']);
        $users = User::all(['id', 'firstName', 'lastName', 'companyId']);
        $role_user = Role_User::all();
        $tests = Test::all();
        $maturity_levels = DB::table('maturity_levels')->where('maturity_levels.companyId','=',$userCompany)->get()->toArray();

        $List_User = DB::table('user_areas')->join('users','user_areas.userId','users.Id')
                                                                    ->join('areas','user_areas.areaId','areas.areaId')
                                                                    ->join('role_user','users.id','role_user.user_id')
                                                                    ->where([
                                                                            ['users.companyId',Auth::user()->companyId],
                                                                            ['role_user.role_id','4']
                                                                        ])->select('users.Id as userId','users.firstName','users.lastName','areas.name as area','user_areas.areaId as ua')
                                                                    ->orderby('user_areas.areaId')->get();

        return view('admins.area.test.create', compact('areas', 'userCompany', 'roles', 'role_user', 'users', 'maturity_levels', 'tests','List_User') );
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $companyId = $user->companyId;
//        $areaId = $request->input('area');
//        $userId = $request->input('user');
        $muy_bajos = $request->input('muy_bajo');
        $bajos = $request->input('bajo');
        $intermedios = $request->input('intermedio');
        $altos = $request->input('alto');
        $muy_altos = $request->input('muy_alto');
        $dataConcept = $this->validatorConcept();
        $dataArea = $this->validatorArea();
        //$dataUser = $this->validatorUser();
        $maturity = DB::table('maturity_levels')->where('maturity_levels.companyId','=',$companyId)->get()->toArray();
        $addTest = Test::create([
            'startedAt' => date('Y-m-d'),
            'areaId' => $dataArea['area'],
            'name' => $request['name']
        ]);
        //$addTest->test_user()->attach($dataUser);

        $conceptAdd = Concept::create([
            'description' => $dataConcept['concept']
        ]);
        $addTest->test_concept()->attach($conceptAdd->conceptId);

        $i = 0;
        foreach ($muy_bajos as $muy_bajo)
        {
            if ($i == 0){
            $conceptAdd->concept_maturity_level()->attach($maturity[0]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_bajo
                ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);
        }

        $i = 0;
        foreach ($bajos as $bajo)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[1]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $bajo
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($intermedios as $intermedio)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[2]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $intermedio
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($altos as $alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[3]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $alto
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        $i = 0;
        foreach ($muy_altos as $muy_alto)
        {
            if ($i == 0){
                $conceptAdd->concept_maturity_level()->attach($maturity[4]->maturityLevelId);
            } $i++;

            $addAttribute = Attribute::create([
                'description'=> $muy_alto
            ]);
            $concept_maturity_level = DB::table('concept_maturity_level')->get()->toArray();
            $addAttribute->concept_maturity_level_attribute()->attach(end($concept_maturity_level)->conceptMLId);        }

        return redirect('/admin/pruebas')->with('Test',true);
    }

    public function validatorConcept()
    {
        return request()->validate([
            'concept' => ['required', 'string','max:255']]);
    }

    public function validatorArea()
    {
        return request()->validate([
            'area' => 'required','max:255']);
    }

    public function validatorUser()
    {
        return request()->validate([
            'user' => 'required']);
    }

    public function DeleteTest(Request $request, $id)
    {
        Test::DeleteTest($id);
        return redirect("/admin/pruebas");
    }


    public function EditarPrueba($TestId,$ConceptId)
    {
        $test  = DB::table('tests') ->where('testId',$TestId)->get();

        $concept = DB::table('concepts') ->where('conceptId',$ConceptId)->get();

        $mlevel = DB::table('concept_maturity_level as CML')
        ->select('ML.description','ML.maturityLevelId')
        ->join('maturity_levels as ML','ML.maturityLevelId','CML.maturityLevelId')
        ->where('conceptId',$ConceptId)->get();

        $attributes = Attribute::join('concept_maturity_level_attribute as CMLA','attributes.attributeId','CMLA.attributeId')
        ->join('concept_maturity_level as CML','CMLA.conceptMLId','CML.conceptMLId')
        ->join('maturity_levels as ML','CML.maturityLevelId','ML.maturityLevelId')
        ->select('attributes.attributeId','attributes.description as AD','ML.description as ML')
        ->where('CML.conceptId',$ConceptId)->orderBy('attributes.attributeId')->get();

        return view('admins.area.test.beta',compact('test','concept','mlevel','attributes'));
    }

    public function PruebaEdit(Request $request)
    {

        $request->validate([
            'testname' => 'required|string',
            'concept' => 'required|string',
            'Id1' => 'required|string',
            'Attribute1' => 'required|string',
            'Attribute2' => 'required|string',
            'Attribute3' => 'required|string',
            'Attribute4' => 'required|string',
            'Attribute5' => 'required|string',
            'Attribute6' => 'required|string',
            'Attribute7' => 'required|string',
            'Attribute8' => 'required|string',
            'Attribute9' => 'required|string',
            'Attribute10' => 'required|string',
            'Attribute11' => 'required|string',
            'Attribute12' => 'required|string',
            'Attribute13' => 'required|string',
            'Attribute14' => 'required|string',
            'Attribute15' => 'required|string'
        ]);

        

        Test::find($request->testId)->update(['name' => $request->testname]);
        Concept::find($request->conceptId)->update(['description' => $request->concept]);

        // DB::table('test_user')->where('testId',$request->testId)->update(['userId' => $request->user]);        

        for ($i=1; $i < 16; $i++) { 
            Attribute::find($request->{"Id".$i})->update(['description' => $request->{"Attribute".$i}]);
        }

    }

}
