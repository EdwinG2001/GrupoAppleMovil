<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\SexoModel;

class Sexo extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SexoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sexo',
            'sexos' => $this->model->findAll(),
        ];
        return view('sexo/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/sexo')->with('success', 'Sexo creado exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/sexo')->with('success', 'Sexo actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/sexo')->with('success', 'Sexo eliminado exitosamente');
    }
}
