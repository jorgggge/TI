<?php

namespace App\Http\Controllers;

use App\Area;
use App\Attribute;
use App\Concept;
use App\MaturityLevel;
use App\Test;
use App\User;
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
        $userId = Auth::user()->id;
        $tests = Test::join('test_user','tests.testId','test_user.testId')
                        ->where('userId',$userId)
        				->select('tests.*')->get();
        $Test = null; 

        foreach ($tests as  $value){
            
            $Concepts = Concept::conceptsFromATestId($value->testId);
            foreach ($Concepts as $v) {
                
                $Count_Evidences = User::CountEvidencesRegular($userId,$value->testId,$v->conceptId);
                $Progress = round(($Count_Evidences/15 * 100),2); 

                echo $Progress."<br>";
                $Test[] = array("TestId" => $value->testId,"Test" => $value->name,"Concept" => $v->description,"ConceptId" => $v->conceptId,"Progress" => $Progress);
                $Progress = 0;
            }
            // $Count_Concepts = DB::table('test_concept')->where('testId',$value->testId)->count();


        }

        return view('comunes.index',compact('Test'));
    }	

    public function test($testId,$conceptId)
    {
    //     $request->user()->authorizeRoles(['comun']);

           $User = json_decode(User::where('id',Auth::user()->id)->get()->toJson());
           $User = $User[0];

           $Test = json_decode(Test::where('testId',$testId)->get()->toJson());
           $Test = $Test[0];
           $Evidences = Attribute::Evidences($conceptId,Auth::user()->id);
           $Atributos = DB::table('attributes')
            ->join('concept_maturity_level_attribute as cma','cma.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level as cm','cma.conceptMLId','cm.conceptMLId')
            ->join('maturity_levels','cm.maturityLevelId','maturity_levels.maturityLevelId')
            ->where('cm.conceptId',$conceptId)
            ->select('attributes.*','maturity_levels.description as Nivel')->get();


           foreach ($Atributos as $value) {
                
                $verified = 0;
                $evidenceId = 0;
                $comment = "";
               foreach ($Evidences as $v) {
                    
                    if($v->attributeId == $value->attributeId){
                        
                        $verified = 2;
                        
                        if($v->verified == 1) $verified = 1; 
                        
                        $evidenceId = $v->evidenceId;
                        $comment = $v->comment;
                    }

               }

               $Datos[] = array('AtributoName' => $value->description,'Nivel' => $value->Nivel,'AtributoId' => $value->attributeId,'Comment' => $comment,'Verifica' => $verified,'evidenceId' => $evidenceId );
           }


           $i  = 0;
           
        return view('comunes.test.test',compact('i','Test','Datos','User'));
    }
}
