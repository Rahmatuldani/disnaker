<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'job_positions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'job_position_id';
}
