<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filterfile extends Model
{
    use HasFactory;
    protected $fillable = [
     'id',
     'FilterName',
      'Status',
      'ClassifyTypeOne',
      'ClassifyTypeTwo',
      'FolderNameOne',
      'FolderNameTwo',
      'Guest',
    ];
}
