<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeExpense extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['ie_date' => 'datetime'];

    public function head()
    {
        return $this->belongsTo(Head::class, 'head_id', 'id');
    }

    public function deleteStatus()
    {
        return ($this->deleted_at) ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
    }
}
