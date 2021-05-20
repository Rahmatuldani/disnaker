<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPK3 extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'ipk3s';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ipk3_id';
}
