<?php

namespace App\Http\Controllers\v1\session\teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getTeacher($id)
    {
        $teacher = Teacher::with('program:id,name')->where('person_id', $id)->get()->first();
        return new TeacherResource($teacher);
    }
}
