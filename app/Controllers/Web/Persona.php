<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\PersonaModel;
use App\Models\GeneroModel;
use App\Models\SexoModel;
use App\Models\EstadoCivilModel;

class Persona extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PersonaModel();
    }

    public function index()
    {
        $data = [
            'title'          => 'Personas',
            'personas'       => $this->model->getPersonaConRelaciones(),
            'generos'        => (new GeneroModel())->findAll(),
            'sexos'          => (new SexoModel())->findAll(),
            'estadosciviles' => (new EstadoCivilModel())->findAll(),
        ];
        return view('persona/index', $data);
    }

    public function crear()
    {
        $input = $this->request->getPost();

        // Limpiar campos vacíos de FK
        if (empty($input['idgenero'])) $input['idgenero'] = null;
        if (empty($input['idsexo'])) $input['idsexo'] = null;
        if (empty($input['idestadocivil'])) $input['idestadocivil'] = null;

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->insert($input);
        return redirect()->to('/persona')->with('success', 'Persona creada exitosamente');
    }

    public function actualizar($id)
    {
        $input = $this->request->getPost();

        // Limpiar campos vacíos de FK
        if (empty($input['idgenero'])) $input['idgenero'] = null;
        if (empty($input['idsexo'])) $input['idsexo'] = null;
        if (empty($input['idestadocivil'])) $input['idestadocivil'] = null;

        if (!$this->model->validate($input)) {
            return redirect()->back()->with('error', implode(', ', $this->model->errors()));
        }

        $this->model->update($id, $input);
        return redirect()->to('/persona')->with('success', 'Persona actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $this->model->delete($id);
        return redirect()->to('/persona')->with('success', 'Persona eliminada exitosamente');
    }
}
