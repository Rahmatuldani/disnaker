<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPK1Name extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'ipk1_names';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ipk1_name_id';
}
