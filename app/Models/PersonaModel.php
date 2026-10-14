<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table            = 'persona';
    protected $primaryKey       = 'idpersona';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'idgenero',
        'idestadocivil',
        'idsexo',
    ];

    // Validación
    protected $validationRules = [
        'nombres'          => 'required|max_length[100]',
        'apellidos'        => 'required|max_length[100]',
        'fecha_nacimiento' => 'required|valid_date',
        'idgenero'         => 'permit_empty|integer',
        'idestadocivil'    => 'permit_empty|integer',
        'idsexo'           => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'nombres' => [
            'required'   => 'Los nombres son obligatorios.',
            'max_length' => 'Los nombres no pueden exceder 100 caracteres.',
        ],
        'apellidos' => [
            'required'   => 'Los apellidos son obligatorios.',
            'max_length' => 'Los apellidos no pueden exceder 100 caracteres.',
        ],
        'fecha_nacimiento' => [
            'required'   => 'La fecha de nacimiento es obligatoria.',
            'valid_date' => 'La fecha de nacimiento no es válida.',
        ],
    ];

    /**
     * Obtener persona con datos relacionados (genero, sexo, estado civil)
     */
    public function getPersonaConRelaciones($id = null)
    {
        $builder = $this->db->table('persona p');
        $builder->select('p.*, g.nombre as genero, s.nombre as sexo, ec.nombre as estado_civil');
        $builder->join('genero g', 'g.idgenero = p.idgenero', 'left');
        $builder->join('sexo s', 's.idsexo = p.idsexo', 'left');
        $builder->join('estadocivil ec', 'ec.idestadocivil = p.idestadocivil', 'left');

        if ($id !== null) {
            $builder->where('p.idpersona', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}
