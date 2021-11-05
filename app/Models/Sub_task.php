<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sub_task extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'sub_tasks';

    protected $fillable = [
        'description',
        'task_id',
        'created_by',
        'updated_by',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, "task_id");
    }
}
