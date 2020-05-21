<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attribute extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'attributeId';

    protected $fillable = [
        'description'
    ];

    public function concept_maturity_level()
    {
        return $this->belongsToMany(Concept::class, 'concept_maturity_level', 'conceptId','maturityLevelId');
    }

    public function concept_maturity_level_attribute()
    {
        return $this->belongsToMany(Concept::class, 'concept_maturity_level_attribute', 'attributeId','conceptMLId');
    }
    public static function attributesFromAnArrayOfMatLevels($maturityLevelsId)
    {
        return $attributes = DB::table('attributes')
            ->join('concept_maturity_level_attribute','concept_maturity_level_attribute.attributeId','=','attributes.attributeId')
            ->whereIn('concept_maturity_level_attribute.conceptMLId',$maturityLevelsId)
            ->get()->toArray();
    }

    public static function attributesFromAnArrayOfMatLevelsWithEvidences($maturityLevelsId)
    {
        return $attributes = DB::table('attributes')
            ->join('evidences','evidences.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level_attribute','concept_maturity_level_attribute.attributeId','=','attributes.attributeId')
            ->whereIn('concept_maturity_level_attribute.conceptMLId',$maturityLevelsId)
            ->get()->toArray();
    }

    static function Evidences($conceptId,$userId)
    {
        return $attributes = DB::table('attributes')
            ->join('evidences','evidences.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level_attribute as cma','cma.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level as cm','cma.conceptMLId','cm.conceptMLId')
            ->join('maturity_levels','cm.maturityLevelId','maturity_levels.maturityLevelId')
            ->where([
            	'cm.conceptId' => $conceptId,
            	'evidences.userId' => $userId
            ])
            ->select('evidences.*')->get();
    }
    
    static function get($conceptId)
    {
        return $attributes = DB::table('attributes')
            ->join('concept_maturity_level_attribute as cma','cma.attributeId','=','attributes.attributeId')
            ->join('concept_maturity_level as cm','cma.conceptMLId','cm.conceptMLId')
            ->join('maturity_levels','cm.maturityLevelId','maturity_levels.maturityLevelId')
            ->where('cm.conceptId',$conceptId)
            ->select('attributes.*','maturity_levels.description as Nivel')->get();
    }
}
