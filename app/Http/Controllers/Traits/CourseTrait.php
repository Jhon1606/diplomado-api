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

            $courses = Course::with('teachers')->paginate(15);

            return $this->respond(200, $courses, 'Listado de cursos.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al obtener listado de cursos.',
                $th->getMessage()
            );
        }
    }

    public function courseStore($request)
    {
        try {

            Course::create([
                'name' => $request->name,
                'hours_max' => $request->hours_max
            ]);

            return $this->respond(200, null, 'Curso creado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al crear nuevo curso.',
                $th->getMessage()
            );
        }
    }

    public function courseShow($id){
        try {

            $course = Course::where('id', $id)->with('teachers')->first();

            if(!$course){
                return $this->respond(404, null, 'Este curso no se encuentra en el sistema.');
            }

            return $this->respond(200, $course, 'Información del curso.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al visualizar curso.',
                $th->getMessage()
            );
        }
    }

    public function courseUpdate($id, $request)
    {
        try {

            $course = Course::find($id);

            if(!$course){
                return $this->respond(404, null, 'Este curso no se encuentra en el sistema.');
            }
            $course->update([
                'document' => $request->document,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'contract_type' => $request->contract_type
            ]);

            return $this->respond(200, null, 'Curso actualizado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al actualizar curso',
                $th->getMessage()
            );
        }
    }

    public function courseDelete($id){
        try {

            $course = Course::find($id);
            if(!$course){
                return $this->respond(404, null, 'Este curso no se encuentra en el sistema.');
            }

            return $this->respond(200, null, 'Curso actualizado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al eliminar curso.',
                $th->getMessage()
            );
        }
    }
}
