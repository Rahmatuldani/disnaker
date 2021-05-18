<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPK1 extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'ipk1s';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ipk1_id';
}
