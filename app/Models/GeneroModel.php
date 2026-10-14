<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneroModel extends Model
{
    protected $table            = 'genero';
    protected $primaryKey       = 'idgenero';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre'];

    // Validación
    protected $validationRules = [
        'nombre' => 'required|max_length[50]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'   => 'El nombre del género es obligatorio.',
            'max_length' => 'El nombre no puede exceder 50 caracteres.',
        ],
    ];
}
