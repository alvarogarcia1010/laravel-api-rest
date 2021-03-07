<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_number',
        'folio_number',
        'record_number',
        'date',
        'name',
        'gender',
        'birth_date',
        'father_name',
        'godfather_name',
        'mother_name',
        'godmother_name',
        'organization_id',
    ];
}
