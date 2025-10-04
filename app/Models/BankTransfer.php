<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankTransfer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['transfer_date' => 'datetime'];

    public function deleteStatus()
    {
        return ($this->deleted_at) ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
    }
}
