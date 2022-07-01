<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sections;

class fatora extends Model
{
    protected $guarded =[];
    use SoftDeletes;

    public function section()
    {
        return $this->belongsTo(sections::class,'section_id');
    }

}
