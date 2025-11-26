<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Error extends Model
{
    protected $fillable = [
        'project_name',
        'error_description',
        'error_steps',
        'reporter',
        'status',
        'assigned_to',
        'priority',
        'assigner',
        'corrective_actions_to_be_done',
        'corrective_actions_done',
    ];
    //
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'reporter');
    }
}
