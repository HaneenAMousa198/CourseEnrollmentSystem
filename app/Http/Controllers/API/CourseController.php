<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::with('teacher')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        return Course::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return $course->load('teacher', 'students');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'       => 'sometimes|required|string',
            'description' => 'nullable|string',
            'teacher_id'  => 'sometimes|required|exists:teachers,id',
        ]);

        $course->update($request->all());

        return $course;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);

    }

        // ✅ تسجيل طالب في دورة
        public function enrollStudent(Request $request, $courseId)
        {
            $request->validate([
                'student_id' => 'required|exists:students,id',
            ]);
    
            $course = Course::findOrFail($courseId);
            $course->students()->syncWithoutDetaching([$request->student_id]);
    
            return response()->json(['message' => 'Student enrolled successfully']);
        }
    
        // ✅ عرض كل الطلاب المسجلين في دورة
        public function getEnrolledStudents($courseId)
        {
            $course = Course::with('students')->findOrFail($courseId);
            return $course->students;
        }
}
