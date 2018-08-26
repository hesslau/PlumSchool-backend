@extends('layouts.app')

@section('content')
    <script src="/js/Chart.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Attendance of {{ $student->name }}</div>
                    <div class="card-body">
                            {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
