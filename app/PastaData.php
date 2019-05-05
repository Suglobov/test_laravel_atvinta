<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastaData extends Model
{
    protected $table = 'pasta_datas';
    protected $fillable = [
        'user_id',
        'access_id',
        'time_of_del',
        'title',
        'text',
        'short_link',
    ];
}
