<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\GeneroModel;

class Genero extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GeneroModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Géneros',
            'generos' => $this->model->findAll(),
        ];
        return view('genero/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/genero')->with('success', 'Género creado exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/genero')->with('success', 'Género actualizado exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/genero')->with('success', 'Género eliminado exitosamente');
    }
}
