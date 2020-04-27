<?php

namespace App\Http\Controllers;

use App\Area;
use App\Attribute;
use App\Concept;
use App\Evidence;
use App\Evidences;
use App\Mail\EvidenceSuggestion;
use App\MaturityLevel;
use App\Test;
use App\TestUser;
use App\User;
use App\User_Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Mail;

class AnalistaController extends Controller
{
    public function __construct(Request $request)
    {
       $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['analista']);
        //Tenemos que regresarle las areas del analista
        $userId = Auth::user()->id;//Dame el id del usuario loggeado
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $tests = Test::whereIn('areaId',$areasId)->get()->toArray();
        $testsId = array_column($tests,'testId');

        $concepts = DB::table('concepts')
            ->join('test_concept','test_concept.conceptId','=','concepts.conceptId')
            ->join('tests','tests.testId','=','test_concept.testId')
            ->join('areas','areas.areaId','=','tests.areaId')
            ->select('areas.areaId','areas.name as areaName','tests.testId','tests.name as testName','concepts.conceptId','concepts.description')
            ->whereIn('test_concept.testId',$testsId)
            ->get()->toArray();

        return view('analistas.index', compact('areas','concepts'));
    }

    public function areasFromAnalista($userId)
    {
        $areasIdFromAnalista = User_Area::where('userId',$userId)->get()->toArray();
        $areasIdFromAnalista = array_column($areasIdFromAnalista,'areaId');
        $areasFromAnalista = Area::whereIn('areaId',$areasIdFromAnalista)->get()->toArray();
        $areas = $areasFromAnalista;
        return $areas;
    }

    public function viewResults(Request $request,$areaId)
    {
        $request->user()->authorizeRoles(['analista']);//Solo los analistas pueden acceder a este metodo
        $userId = Auth::user()->id;
        $companyId = User::giveMeCompany(Auth::user());
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $tests = Test::testFromAnAreaId($areaId);
        $testsIds=array_column($tests,'testId');

        $areaSeleccionada= Area::where('areaId',$areaId)->first();  //Me regresa el objeto del area que elegi
        $maturityLevels = MaturityLevel::where('companyId',$companyId)->get()->toArray();

        abort_if(!in_array($areaId,$areasId),403);//Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla

        $testsConcepts = Concept::ConceptsFromAnArrayOfTestsIds($testsIds);
        $testsConceptsIds = array_column((array)$testsConcepts,'testConceptId');
        $results = [];
        foreach ((array) $testsConceptsIds as $item)
        {
            $conceptsResults[] = DB::select('call p_fetch_verified_evidences(?)',array($item));
            $results[] = (array)$conceptsResults[array_search($item,$testsConceptsIds)][0];
        }
        return view('analistas.viewResults.results',compact([
            'areas',
            'areaSeleccionada',
            'tests',
            'testsConcepts',
            'maturityLevels',
            'results'
        ]));
    }

    public function test(Request $request, $testId,$conceptId)
    {
        $request->user()->authorizeRoles(['analista']);
        $userId = Auth::user()->id;
        $areas = $this->areasFromAnalista($userId);
        $areasId = array_column($areas,'areaId');
        $testFromAreasOfTheUser = Test::whereIn('areaId',$areasId)->get()->toArray();
        $testsIdFromAreasOfTheUser = array_column($testFromAreasOfTheUser,'testId');
        $testFromUser = TestUser::where('testId',$testId)->get()->toArray()[0];
        $commonUserId = $testFromUser['userId'];
        $dataFromCommonUser = User::where('id', $commonUserId)->get()->toArray()[0];
        $email = $dataFromCommonUser['email'];
        $name = $dataFromCommonUser['firstName'];
        $lastName = $dataFromCommonUser['lastName'];
        $count = 0;

        $request->attributes->add(['testId' => $request->testId]);

        abort_if(!in_array($testId,$testsIdFromAreasOfTheUser),403);//Si el area seleccionada no existe dentro de las areas de la compania
        $test = Test::where('testId',$testId)->get()->toArray()[0];
        $testName = $test['name'];

        $concepts = Concept::conceptsFromATestId($testId);
        $conceptsIds = array_column($concepts,'conceptId');

        abort_if(!in_array($conceptId,$conceptsIds),403);//Si el conceptId que me estas pidiendo no esta dentro de los concepts del test no dejarlo entrar
        $selectedConcept = Concept::where('conceptId',$conceptId)->get()->toArray()[0];

        $maturityLevels = MaturityLevel::matLevFromAConceptId($conceptId);
        $maturityLevelsId = array_column($maturityLevels,'conceptMLId');

        $attributes = Attribute::attributesFromAnArrayOfMatLevels($maturityLevelsId);
        $attributesWithEvidences = Attribute::attributesFromAnArrayOfMatLevelsWithEvidences($maturityLevelsId);

        return view('analistas.test.test',compact('test','selectedConcept','concepts','maturityLevels','attributes','attributesWithEvidences','email', 'name', 'lastName', 'count', 'commonUserId', 'testName'));
    }

    public function storeTest(Request $request)
    {
        $email = $request->input('email');
        $commonUserId = $request->input('commonUserId');
        $username = $request->input('username');
        $testName = $request->input('testName');
        $myCheckboxes = $request->input('attributeCheck');
        $myAttributes = $request->input('attribute-name');
        $verify = array();
        $unverify = array();
        $empty = array();

        foreach($myCheckboxes as $key => $value)
        {
            if ($value === 'on'){
                DB::table('evidences')
                    ->where('attributeId',$key)
                    ->update(['verified'=>true]);
            }
            else{
                DB::table('evidences')
                    ->where('attributeId',$key)
                    ->update(['verified'=>false]);
            }
        }

        foreach ($myAttributes as $attribute)
        {
            $evidenceFromUser = Evidences::where('userId', $commonUserId)->where('attributeId', $attribute)->first();
            if($evidenceFromUser['verified'] == 1){
                $getAttributeDescription = Attribute::where('attributeId', $attribute)->first();
                $description = $getAttributeDescription->description;
                $verify[] = $description;
            }
            elseif ($evidenceFromUser['verified'] == 0){
                $getAttributeDescription = Attribute::where('attributeId', $attribute)->first();
                $description = $getAttributeDescription->description;
                $unverify[] = $description;
            }
        }

        // Mail::to($email)->queue(new EvidenceSuggestion($verify, $unverify, $username, $testName));

        /*this line is used to create and return a new instance of the email view, can be used for testing how the email view looks like.

        return new EvidenceSuggestion($verify,$unverify,$username,$testName);

        comment the return redirect and the Email::to lines when used */

        return redirect('/analista');
    }
}
