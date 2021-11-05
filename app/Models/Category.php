<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'color',
        'created_by',
        'updated_by',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, "tasks_categories");
    }
}
