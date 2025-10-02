<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDirector extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['date_of_join' => 'datetime', 'installment_start_date' => 'datetime'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function ctype()
    {
        return $this->belongsTo(Extra::class, 'type', 'id');
    }

    public function deleteStatus()
    {
        return ($this->deleted_at) ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
    }
}
