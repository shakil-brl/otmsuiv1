@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Batch List</h3>
        <table class="table table-bordered bg-white">
            <thead>
                <th>SL</th>
                <th>Batch Code</th>
                <th>Traiting Title</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>Class Days</th>
                <th>Class Schedule</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($results ?? [] as $index => $batch)
                    @php
                        $schedule = $batch['schedule'] ?? null;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $batch['batchCode'] }}</td>
                        <td>
                            {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                        </td>
                        <td>{{ $batch['GEOLocation'] }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                        </td>
                        <td>{{ $batch['duration'] }}</td>
                        <td>
                            @if ($schedule !== null)
                                <span> Days: {{ $schedule['class_days'] }}</span><br>
                                <div class="mt-1 d-flex justify-content-between align-item-center">
                                    <span>Time: {{ $schedule['class_time'] }}</span>
                                    <span>Time: {{ $schedule['class_duration'] }} Hours</span>
                                </div>
                            @else
                            @endif
                        </td>
                        <td>
                            @if ($schedule == null)
                                <a href="{{ route('batch-schedule.create', $batch['id']) }}"
                                    class="btn btn-sm btn-primary">Create
                                    Schedule</a>
                            @else
                                <a href="{{ route('batch-schedule.index', [$schedule['id'], $batch['id']]) }}"
                                    class="btn btn-sm btn-info">View
                                    Schedule</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
