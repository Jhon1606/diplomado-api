<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\RestActions;
use App\Models\Teacher;

trait TeacherTrait
{
    use RestActions;

    public function teacherList()
    {
        try {

            $teachers = Teacher::with('courses')->get();

            return $this->respond(200, $teachers, 'Listado de profesores.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al obtener listado de profesores.',
                $th->getMessage()
            );
        }
    }

    public function teacherStore($request)
    {
        try {

            Teacher::create([
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

    public function teacherShow($id){
        try {

            $teacher = Teacher::where('id', $id)->with('courses', 'assigment')->first();

            if(!$teacher){
                return $this->respond(404, null, 'Este profesor no se encuentra en el sistema.');
            }

            return $this->respond(200, $teacher, 'Información del profesor.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al visualizar profesor.',
                $th->getMessage()
            );
        }
    }

    public function teacherUpdate($id, $request)
    {
        try {

            $teacher = Teacher::find($id);

            if(!$teacher){
                return $this->respond(404, null, 'Este profesor no se encuentra en el sistema.');
            }
            $teacher->update([
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

    public function teacherDelete($id){
        try {

            $teacher = Teacher::find($id);
            if(!$teacher){
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
