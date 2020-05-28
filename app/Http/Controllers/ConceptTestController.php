<?php
/**
 * Created by PhpStorm.
 * User: Yo
 * Date: 11/11/2019
 * Time: 01:42 PM
 */

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

class ConceptTestController
{
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $userCompany = $user-> companyId;
        $areas = DB::table('areas')->where('areas.companyId','=',$userCompany)->get()->toArray();
        $roles = Role::all(['id']);
        $users = User::all(['id', 'firstName', 'lastName', 'companyId']);
        $role_user = Role_User::all();
        $tests = Area::join('tests','areas.areaId','tests.areaId')
                    ->select('tests.*')
                        ->where('areas.companyId',$userCompany )->get();

        $maturity_levels = DB::table('maturity_levels')->where('maturity_levels.companyId','=',$userCompany)->get()->toArray();

        $countAreas = Area::where('companyId','=',$userCompany)->count();
        if($countAreas == 0){
            return redirect('/admins/area/addArea');
        }
        else{
            return view('admins.area.concept_test.create', compact('areas', 'userCompany', 'roles', 'role_user', 'users', 'maturity_levels', 'tests') );
        }
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user = auth()->user();
        $companyId = $user->companyId;
        $areaId = $request->input('area');
        $userId = $request->input('user');
        $muy_bajos = $request->input('muy_bajo');
        $bajos = $request->input('bajo');
        $intermedios = $request->input('intermedio');
        $altos = $request->input('alto');
        $muy_altos = $request->input('muy_alto');
        $dataConcept = $this->validatorConcept();
        $maturity = DB::table('maturity_levels')->where('maturity_levels.companyId','=',$companyId)->get()->toArray();

        $dataTest = $this->validatorTest();

        $test = Test::find($dataTest['test']);

        $conceptAdd = Concept::create([
            'description' => $dataConcept['concept']
        ]);

        $test->test_concept()->attach($conceptAdd->conceptId);

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

        return redirect('/admin/pruebas')->with('Concept',true);
    }

    public function validatorConcept()
    {
        return request()->validate([
            'concept' => ['required', 'string','max:255',]]);
    }

    public function validatorTest()
    {
        return request()->validate([
            'test' => 'required']);
    }
}
