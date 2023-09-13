<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personalGoal extends Model
{
    use HasFactory;
    protected $table = 'personal_goal';
    protected $primaryKey = 'id';
    protected $fillable = [
         'name',
     ];
}
