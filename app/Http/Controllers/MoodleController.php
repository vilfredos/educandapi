<?php

namespace App\Http\Controllers;

use App\Services\MoodleService;

class MoodleController extends Controller
{
    protected $moodleService;

    public function __construct(MoodleService $moodleService)
    {
        $this->moodleService = $moodleService;
    }

    public function showCourse($courseId)
    {
        $course = $this->moodleService->getCourse($courseId);
        return view('course.show', compact('course'));
    }
}