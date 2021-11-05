<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'tasks';

    protected $fillable = [
        'description',
        'deadline',
        'assign',
        'end_flag',
        'created_by',
        'updated_by',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, "tasks_categories");
    }

    public function subTasks()
    {
        return $this->hasMany(Sub_task::class, "task_id");
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, "assign");
    }

}
