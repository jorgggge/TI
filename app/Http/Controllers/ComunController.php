<?php

namespace App\Http\Controllers;

use App\Area;
use App\Attribute;
use App\Concept;
use App\MaturityLevel;
use App\Test;
use App\User_Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ComunController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
   }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['comun']);
        $userId = Auth::user()->id;//Dame el id del usuario loggeado
        $testsIdFromUser = DB::table('test_user')->where('userId',$userId)->get()->toArray();
        $testsIdFromUser= array_column($testsIdFromUser,'testId');
        $tests = Test::whereIn('testId',$testsIdFromUser)->get()->toArray();
        $testsId = array_column($tests,'testId');

        $concepts = DB::table('concepts')
            ->join('test_concept',function ($join) use ($testsId) {
                $join->on('concepts.conceptId','=','test_concept.conceptId')
                    ->whereIn('test_concept.testId',$testsId);
            })
            ->get()->toArray();
        return view('comunes.index',compact('tests','concepts'));
    }

    public function test(Request $request, $testId,$conceptId)
    {
        $request->user()->authorizeRoles(['comun']);
        $userId = Auth::user()->id;
        $testsIdFromUser = DB::table('test_user')->where('userId',$userId)->get()->toArray();
        $testsIdFromUser= array_column($testsIdFromUser,'testId');
        abort_if(!in_array($testId,$testsIdFromUser),403);//Si el area seleccionada no existe dentro de las areas del usuario no lo deja verla
        $test = Test::where('testId',$testId)->get()->toArray()[0];
        $selectedConcept = Concept::where('conceptId',$conceptId)->get()->toArray()[0];

        $concepts = Concept::conceptsFromATestId($testId);

        abort_if(!in_array($conceptId,array_column($concepts,'conceptId')),403);//Si el conceptId que me estas pidiendo no esta dentro de los concepts del test no dejarlo entrar

        $maturityLevels = MaturityLevel::matLevFromAConceptId($conceptId);
        $maturityLevelsId = array_column($maturityLevels,'conceptMLId');

        $attributes = Attribute::attributesFromAnArrayOfMatLevels($maturityLevelsId);
        $attributesWithEvidences = Attribute::attributesFromAnArrayOfMatLevelsWithEvidences($maturityLevelsId);

        return view('comunes.test.test',compact('test','selectedConcept','concepts','maturityLevels','attributes','attributesWithEvidences'));
    }
}
