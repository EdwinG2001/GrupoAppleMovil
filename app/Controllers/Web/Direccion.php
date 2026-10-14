<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\DireccionModel;
use App\Models\PersonaModel;

class Direccion extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new DireccionModel();
    }

    public function index()
    {
        // Obtener direcciones con nombre de persona
        $db = \Config\Database::connect();
        $builder = $db->table('direccion d');
        $builder->select('d.*, CONCAT(p.nombres, " ", p.apellidos) as persona_nombre');
        $builder->join('persona p', 'p.idpersona = d.idpersona', 'left');
        $direcciones = $builder->get()->getResultArray();

        $data = [
            'title'       => 'Direcciones',
            'direcciones' => $direcciones,
            'personas'    => (new PersonaModel())->findAll(),
        ];
        return view('direccion/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/direccion')->with('success', 'Dirección creada exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/direccion')->with('success', 'Dirección actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/direccion')->with('success', 'Dirección eliminada exitosamente');
    }
}
