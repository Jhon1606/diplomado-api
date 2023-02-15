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

            $courses = Course::with('teachers')->get();

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

            $course = Course::where('id', $id)->with('teachers', 'assigment')->first();

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

            $course = Course::where('id', $id)->with('teachers')->first();

            if(!$course){
                return $this->respond(404, null, 'Este curso no se encuentra en el sistema.');
            }

            $this->updateInfoTeachers($course->hours_max, $course->teachers, $request->hours_max);

            $course->update([
                'name' => $request->name,
                'hours_max' => $request->hours_max
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

            $course = Course::where('id', $id)->with('teachers')->first();

            if(!$course){
                return $this->respond(404, null, 'Este curso no se encuentra en el sistema.');
            }

            $this->updateInfoTeachers($course->hours_max, $course->teachers);
            $course->delete();

            return $this->respond(200, null, 'Curso eliminado correctamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al eliminar curso.',
                $th->getMessage()
            );
        }
    }

    private function updateInfoTeachers($course_hours, $teachers, $new_course_hours = 0){
        foreach ($teachers as $teacher) {
            $teacher->update([
                'laboral_hours' => (($teacher->laboral_hours - $course_hours) + $new_course_hours)
            ]);
        }
    }
}
