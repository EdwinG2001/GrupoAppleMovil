<?php

namespace App\Models;

use CodeIgniter\Model;

class SexoModel extends Model
{
    protected $table            = 'sexo';
    protected $primaryKey       = 'idsexo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre'];

    // Validación
    protected $validationRules = [
        'nombre' => 'required|max_length[50]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'   => 'El nombre del sexo es obligatorio.',
            'max_length' => 'El nombre no puede exceder 50 caracteres.',
        ],
    ];
}
