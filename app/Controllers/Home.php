<?php

namespace App\Controllers;

use App\Models\GeneroModel;
use App\Models\SexoModel;
use App\Models\EstadoCivilModel;
use App\Models\PersonaModel;
use App\Models\TelefonoModel;
use App\Models\DireccionModel;
use App\Models\CorreoModel;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $personaModel = new PersonaModel();

        // 1. Conteos generales
        $counts = [
            'genero'      => (new GeneroModel())->countAll(),
            'sexo'        => (new SexoModel())->countAll(),
            'estadocivil' => (new EstadoCivilModel())->countAll(),
            'persona'     => $personaModel->countAll(),
            'telefono'    => (new TelefonoModel())->countAll(),
            'direccion'   => (new DireccionModel())->countAll(),
            'correo'      => (new CorreoModel())->countAll(),
        ];

        // 2. Estadísticas de Distribución por Género
        $generoStats = [];
        try {
            $generoQuery = $db->table('genero')
                ->select('genero.nombre, COUNT(persona.idpersona) as total')
                ->join('persona', 'persona.idgenero = genero.idgenero', 'left')
                ->groupBy('genero.idgenero, genero.nombre')
                ->get()
                ->getResultArray();

            foreach ($generoQuery as $row) {
                $generoStats[] = [
                    'nombre' => $row['nombre'],
                    'total'  => (int)$row['total'],
                ];
            }
        } catch (\Throwable $e) {
            $generoStats = [];
        }

        // 3. Estadísticas de Distribución por Estado Civil
        $estadoCivilStats = [];
        try {
            $ecQuery = $db->table('estadocivil')
                ->select('estadocivil.nombre, COUNT(persona.idpersona) as total')
                ->join('persona', 'persona.idestadocivil = estadocivil.idestadocivil', 'left')
                ->groupBy('estadocivil.idestadocivil, estadocivil.nombre')
                ->get()
                ->getResultArray();

            foreach ($ecQuery as $row) {
                $estadoCivilStats[] = [
                    'nombre' => $row['nombre'],
                    'total'  => (int)$row['total'],
                ];
            }
        } catch (\Throwable $e) {
            $estadoCivilStats = [];
        }

        // 4. Estadísticas de Distribución por Sexo
        $sexoStats = [];
        try {
            $sexoQuery = $db->table('sexo')
                ->select('sexo.nombre, COUNT(persona.idpersona) as total')
                ->join('persona', 'persona.idsexo = sexo.idsexo', 'left')
                ->groupBy('sexo.idsexo, sexo.nombre')
                ->get()
                ->getResultArray();

            foreach ($sexoQuery as $row) {
                $sexoStats[] = [
                    'nombre' => $row['nombre'],
                    'total'  => (int)$row['total'],
                ];
            }
        } catch (\Throwable $e) {
            $sexoStats = [];
        }

        // 5. Últimas personas registradas
        $ultimasPersonas = [];
        try {
            $ultimasPersonas = $personaModel->getPersonaConRelaciones();
            $ultimasPersonas = array_slice($ultimasPersonas, 0, 5);
        } catch (\Throwable $e) {
            $ultimasPersonas = [];
        }

        // 6. Cálculo de ratio de contactabilidad (% de personas con al menos un teléfono o correo)
        $contactabilidad = 0;
        if ($counts['persona'] > 0) {
            try {
                $personasConContacto = $db->table('persona')
                    ->select('persona.idpersona')
                    ->join('telefono', 'telefono.idpersona = persona.idpersona', 'left')
                    ->join('correo', 'correo.idpersona = persona.idpersona', 'left')
                    ->where('telefono.idtelefono IS NOT NULL OR correo.idcorreo IS NOT NULL', null, false)
                    ->groupBy('persona.idpersona')
                    ->countAllResults();

                $contactabilidad = round(($personasConContacto / $counts['persona']) * 100);
            } catch (\Throwable $e) {
                $contactabilidad = 0;
            }
        }

        $data = [
            'title'            => 'Dashboard de Gestión de Personas - Grupo Apple',
            'counts'           => $counts,
            'generoStats'      => $generoStats,
            'estadoCivilStats' => $estadoCivilStats,
            'sexoStats'        => $sexoStats,
            'ultimasPersonas'  => $ultimasPersonas,
            'contactabilidad'  => $contactabilidad,
        ];

        return view('dashboard', $data);
    }
}
