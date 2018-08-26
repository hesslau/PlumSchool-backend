@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Courses</div>

                <div class="card-body">
                    @foreach ($courses as $course)
                        <li><a href="/course/{{ $course->id }}/attendance">
                                {{ \App\CourseName::find($course->course_name_id)->name }}
                            </a></li>
                    @endforeach
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">Students</div>

                <div class="card-body">
                    @foreach ($students as $student)
                        <li><a href="/student/{{ $student->id }}/attendance">
                            {{ $student->name }}
                        </a></li>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
