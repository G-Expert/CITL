<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    use HasFactory;
    protected $fillable = ['type','nature','conteneur','pays_destination','poids','voie','arrive','tel','mail','Nom','codeDevis'];
}
