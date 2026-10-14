<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\EstadoCivilModel;

class EstadoCivil extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new EstadoCivilModel();
    }

    public function index()
    {
        $data = [
            'title'          => 'Estado Civil',
            'estadosciviles' => $this->model->findAll(),
        ];
        return view('estadocivil/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/estadocivil')->with('success', 'Estado civil creado exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/estadocivil')->with('success', 'Estado civil actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/estadocivil')->with('success', 'Estado civil eliminado exitosamente');
    }
}
