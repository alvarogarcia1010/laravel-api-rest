<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'book_start',
        'book_end',
        'husband_name',
        'husband_age',
        'husband_father',
        'husband_mother',
        'husband_birthplace',
        'husband_address',
        'wife_name',
        'wife_age',
        'wife_father',
        'wife_mother',
        'wife_address',
        'wife_birthplace',
        'organization_id',
    ];
}
