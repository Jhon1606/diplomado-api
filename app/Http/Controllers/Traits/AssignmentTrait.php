<?php
namespace App\Http\Controllers\Traits;

use App\Http\Controllers\RestActions;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Teacher;

trait AssignmentTrait {
    use RestActions;

    public function assignmentTeacherCourse($teacher_id,$course_id){

        try {
            
            $course = Course::find($course_id);
            $teacher = Teacher::find($teacher_id);
            $assignment = Assignment::where('course_id',$course_id)
            ->where('teacher_id',$teacher_id)->first();

            if($teacher && $course){
                if(!$assignment){
                    $course_hours = $course->hours_max;
                    $teacher_validation_hours = $teacher->laboral_hours + $course_hours;

                    if($teacher->contract_type == 1){
                        
                        if($teacher_validation_hours<=40){
                            $teacher->update([
                                'laboral_hours' => $teacher_validation_hours
                            ]);
                            Assignment::create([
                                'course_id' => $course_id,
                                'teacher_id' => $teacher_id
                            ]);
                            return $this->respond(200, $course_hours, 'Asignación exitosa.');
                        } else{
                            return $this->respond(400, $teacher_validation_hours, 'Tiempo de horas asignadas ha sido excedido.');
                        }
                    } else{
                        if($teacher_validation_hours<=20){
                            $teacher->update([
                                'laboral_hours' => $teacher_validation_hours
                            ]);
                            Assignment::create([
                                'course_id' => $course_id,
                                'teacher_id' => $teacher_id
                            ]);
                            return $this->respond(200, $course_hours, 'Asignación exitosa.');
                        } else{
                            return $this->respond(400, $teacher_validation_hours, 'Tiempo de horas asignadas ha sido excedido.');
                        }
                    }
                }
                return $this->respond(404, null, 'Este profesor ya ha sido asignado a este curso.');
            }
            return $this->respond(404, null, 'Profesor o curso no encontrado.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al obtener listado de cursos.',
                $th->getMessage()
            );
        }
    }
}