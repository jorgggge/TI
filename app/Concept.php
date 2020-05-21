<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Concept extends Model
{
    public $timestamps = false;

    protected $primaryKey = "conceptId";

    protected $fillable = [
        'description'
    ];

    public function concept_maturity_level()
    {
        return $this->belongsToMany(Attribute::class, 'concept_maturity_level', 'conceptId','maturityLevelId');
    }

    public static function ConceptsFromAnArrayOfTestsIds($testsIds)
    {
        return $concepts = DB::table('concepts')
            ->join('test_concept',function ($join) use ($testsIds) {
                $join->on('concepts.conceptId','=','test_concept.conceptId')
                    ->whereIn('test_concept.testId',$testsIds);
            })
            ->get()->toArray();
    }
    public static function conceptsFromATestId($testId)
    {
        return $concepts = DB::table('concepts')
            ->join('test_concept',function ($join) use ($testId) {
                $join->on('concepts.conceptId','=','test_concept.conceptId')
                    ->where('test_concept.testId','=',$testId);
            })
            ->get();
    }
}
