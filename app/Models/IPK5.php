<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPK5 extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'ipk5s';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ipk5_id';
}
