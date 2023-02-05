<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\RestActions;
use App\Models\Course;

trait CourseTrait
{
    use RestActions;

    public function courseList()
    {
        try {

            $coursers = Course::with('courses')->paginate(15);

            return $this->respond(200, $coursers, 'Listado de profesores.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al obtener listado de profesores.',
                $th->getMessage()
            );
        }
    }

    public function courseStore($request)
    {
        try {

            Course::create([
                'document' => $request->document,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'contract_type' => $request->contract_type
            ]);

            return $this->respond(200, null, 'Profesor creado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al crear nuevo profesor.',
                $th->getMessage()
            );
        }
    }

    public function courseShow($id){
        try {

            $courser = Course::where('id', $id)->with('courses')->first();

            if(!$courser){
                return $this->respond(404, null, 'Este profesor no se encuentra en el sistema.');
            }

            return $this->respond(200, $courser, 'Información del profesor.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al visualizar profesor.',
                $th->getMessage()
            );
        }
    }

    public function courseUpdate($id, $request)
    {
        try {

            $courser = Course::find($id);

            if(!$courser){
                return $this->respond(404, null, 'Este profesor no se encuentra en el sistema.');
            }
            $courser->update([
                'document' => $request->document,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'contract_type' => $request->contract_type
            ]);

            return $this->respond(200, null, 'Profesor actualizado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al actualizar profesor',
                $th->getMessage()
            );
        }
    }

    public function courserDelete($id){
        try {

            $courser = Course::find($id);
            if(!$courser){
                return $this->respond(404, null, 'Este profesor no se encuentra en el sistema.');
            }

            return $this->respond(200, null, 'Profesor actualizado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al eliminar profesor',
                $th->getMessage()
            );
        }
    }
}
