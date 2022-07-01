<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;

class inovices extends Model
{
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(sections::class,'Section_id');
    }

}
