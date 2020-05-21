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


        return view('analistas.index', compact('areas'));
    }

    public function areasFromAnalista($userId)
    {
        $areasIdFromAnalista = User_Area::join('areas','user_areas.areaId','areas.areaId')
                                          ->where('userId',$userId)->get();
        return $areasIdFromAnalista;
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

    public function test($testId,$userId)
    {


           $User = json_decode(User::where('id',$userId)->get()->toJson());
           $User = $User[0];

           $Test = json_decode(Test::where('testId',$testId)->get()->toJson());
           $Test = $Test[0];
           $Concepts = Concept::conceptsFromATestId($testId);
           
           

        return view('analistas.test.test',compact('User','Concepts','Test'));
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

    public function Pruebahome()
    {

        $_areas = DB::table('user_areas')->where('userId',auth()->user()->id)->select('areaId')->get();
        foreach($_areas as $a)  $areas[] = $a->areaId;

        $Pruebas = Test::join('test_user','tests.testId','test_user.testId')
                        ->join('users','test_user.userId','users.id')
                        ->select('tests.name','users.firstName','users.lastName','users.id','tests.testId')
                        ->whereIn('tests.areaId',$areas)->get();

        return view('analistas.test.index',compact ('Pruebas','areas'));
    }

    public function Attributes($conceptId)
    {
        $A = Attribute::get($conceptId);
        return json_encode($A);     
    }

    public function Evidences($conceptId,$userId)
    {
        $E = Attribute::Evidences($conceptId,$userId);
        return json_encode($E);
    }

    public function ValidarEvidencia($evidenceId,$validar)
    {
        DB::table('evidences')->where('evidenceId',$evidenceId)->update(['verified' => $validar]);
    }

    public function ComentarioEvidencia($evidenceId,$texto)
    {
        DB::table('evidences')->where('evidenceId',$evidenceId)->update(['comment' => $texto]);
    }
}
