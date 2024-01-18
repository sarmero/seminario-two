<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherService
{
    public function getTeacher($id){
        return Teacher::find($id);
    }

    public function createTeacher($data)
    {
        return Teacher::create([
            'program_id' => $data->program,
            'person_id' => $data->id,
        ]);
    }

    public function updateTeacher(Teacher $teacher, $data)
    {
        return $teacher->updated([
            'program_id' => $data->program,
            'person_id' => $data->id,
        ]);
    }

    public function destroy(Teacher $teacher){
        $teacher->delete();
    }
}
