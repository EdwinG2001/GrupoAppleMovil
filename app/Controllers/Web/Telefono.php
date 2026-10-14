<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\TelefonoModel;
use App\Models\PersonaModel;

class Telefono extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TelefonoModel();
    }

    public function index()
    {
        // Obtener teléfonos con nombre de persona
        $db = \Config\Database::connect();
        $builder = $db->table('telefono t');
        $builder->select('t.*, CONCAT(p.nombres, " ", p.apellidos) as persona_nombre');
        $builder->join('persona p', 'p.idpersona = t.idpersona', 'left');
        $telefonos = $builder->get()->getResultArray();

        $data = [
            'title'     => 'Teléfonos',
            'telefonos' => $telefonos,
            'personas'  => (new PersonaModel())->findAll(),
        ];
        return view('telefono/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/telefono')->with('success', 'Teléfono creado exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/telefono')->with('success', 'Teléfono actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/telefono')->with('success', 'Teléfono eliminado exitosamente');
    }
}
