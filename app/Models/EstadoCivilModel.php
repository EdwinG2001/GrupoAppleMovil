<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoCivilModel extends Model
{
    protected $table            = 'estadocivil';
    protected $primaryKey       = 'idestadocivil';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre'];

    // Validación
    protected $validationRules = [
        'nombre' => 'required|max_length[50]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'   => 'El nombre del estado civil es obligatorio.',
            'max_length' => 'El nombre no puede exceder 50 caracteres.',
        ],
    ];
}
