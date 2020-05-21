<?php
namespace App\Http\Controllers\Test;
use App\Concept;
use App\Http\Controllers\Controller;
use App\MaturityLevel;
use App\Test;
use Illuminate\Http\Request;
use App\Evidences;
use App\Attribute;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth',]);  //'verified'
    }
    //
    public function index(Request $request)
    {
        
        $v =  $request->valor;

        $request->validate([
            'file'.$v => 'required'
        ]);


        $f = 'file'.$v;
        if ($request->hasFile($f)) {

            $file = $request->file($f);
            $name = time().$file->getClientOriginalName();
            $file->storeAs('public/upload', $name);

            $Existe = Evidences::where([ 
                                'attributeId' => $request->{'attributeId'.$v},
                                'userId' => auth()->user()->id
                                ])->count();
            
            if($Existe != 0){
                Evidences::where([ 'attributeId' => $request->{'attributeId'.$v},'userId' => auth()->user()->id])->delete();
            }

            $Evidence = Evidences::create([
                'link' => $name,
                'attributeId' => $request->{'attributeId'.$v},
                'verified' => 0,
                'userId' => auth()->user()->id,
                'companyId' => auth()->user()->companyId,
                'comment' => ""
            ]);

            $Evidence->save();
            
            $A = json_decode(Attribute::where('attributeId',$request->{'attributeId'.$v})->get()->toJson());
            $A = $A[0];
            # $pathTofile =  public_path().'/evidences/'.$name;
            // return $request->download('/public/evidences/'.$name);
        }

        return back()->with('success',true);
    }


    public function down($evidenceId)
    {
        $Evidence = json_decode(Evidences::where("evidenceId",$evidenceId)->get()->toJson());
        $Evidence = $Evidence[0];

        $archivo = $Evidence->link;
        // return  Storage::url("app/public/upload/$archivo");
        return response()->download(storage_path("app/public/upload/$archivo"));
    }

    public function view($archivo)
    {
        // $archivo = storage_path("app/public/upload/$archivo");
        return view('file',compact('archivo'));
    }


}

