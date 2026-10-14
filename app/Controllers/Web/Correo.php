<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\CorreoModel;
use App\Models\PersonaModel;

class Correo extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CorreoModel();
    }

    public function index()
    {
        // Obtener correos con nombre de persona
        $db = \Config\Database::connect();
        $builder = $db->table('correo c');
        $builder->select('c.*, CONCAT(p.nombres, " ", p.apellidos) as persona_nombre');
        $builder->join('persona p', 'p.idpersona = c.idpersona', 'left');
        $correos = $builder->get()->getResultArray();

        $data = [
            'title'    => 'Correos',
            'correos'  => $correos,
            'personas' => (new PersonaModel())->findAll(),
        ];
        return view('correo/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/correo')->with('success', 'Correo creado exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/correo')->with('success', 'Correo actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/correo')->with('success', 'Correo eliminado exitosamente');
    }
}
