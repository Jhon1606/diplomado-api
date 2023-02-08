<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\RestActions;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Teacher;

trait AssignmentTrait
{
    use RestActions;

    public function assignmentTeacherCourse($teacher_id, $course_id)
    {
        try {

            $course = Course::find($course_id);
            $teacher = Teacher::find($teacher_id);

            if ($teacher && $course) {
                $assignment = Assignment::where('course_id', $course_id)->where('teacher_id', $teacher_id)->first();

                if (!$assignment) {
                    $teacher_validation_hours = $teacher->laboral_hours + $course->hours_max;
                    return $this->updateTeacherLaboralHours($teacher, $course, $teacher_validation_hours);
                }
                return $this->respond(400, null, 'Este profesor, ya ha sido asignado a este curso.');
            }

            return $this->respond(404, null, 'Profesor o curso no encontrado.');
        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al asignar prefesor a curso.',
                $th->getMessage()
            );
        }
    }

    private function updateTeacherLaboralHours(Teacher $teacher, Course $course, $newHours)
    {

        $max_hours_contract_type = 40;
        if ($teacher->contract_type == 2) {
            $max_hours_contract_type = 20;
        }

        if ($newHours <= $max_hours_contract_type) {
            $teacher->update([
                'laboral_hours' => $newHours
            ]);
            Assignment::create([
                'course_id' => $course->id,
                'teacher_id' => $teacher->id
            ]);
            return $this->respond(200, null, 'Asignación exitosa.');
        }

        return $this->respond(400, null, 'Tiempo de horas asignadas ha sido excedido.');
    }
}
