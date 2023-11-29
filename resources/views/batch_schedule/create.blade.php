@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Create Schedule</h3>
        <x-alert />



        @isset($batch)
            <div>
                <h4>Batch Code: {{ $batch['batchCode'] }}</h4>
                <div>Training Title:
                    {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    Start Date: {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                </div>
                <div>
                    Total Class: {{ $batch['totalTrainees'] ?? '' }}
                </div>
                <div>
                    Location: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
            <br>

            @if ($error)
                @if (is_string($error))
                    <span class="text-danger">
                        <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong>
                            {{ $error ?? '' }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </span>
                @else
                    <ul class="m-0 text-danger">
                        @foreach ($error ?? [] as $err)
                            @foreach ($err as $e)
                                <li>
                                    {{ $e }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
            @endif

            @isset($error['training_batch_id'])
                <span class="text-danger">
                    <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error : </strong>
                        {{ $error['training_batch_id'][0] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </span>
            @endisset
            <div class="bg-white p-5 rounded">
                <form action="{{ route('batch-schedule.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="training_batch_id" value="{{ $batch['id'] }}">

                    <div class="row row-cols-4 g-3">
                        <div>
                            <label for="">Class Time</label>
                            <input type="time" value="{{ old('class_time') }}" class="form-control" name="class_time">
                            @isset($error['class_time'])
                                <span class="text-danger">
                                    {{ $error['class_time'][0] }}
                                </span>
                            @endisset
                        </div>
                        <div>
                            <label for="">Class Duration</label>
                            <div class="input-group">
                                <input value="{{ old('class_duration') }}" type="text" class="form-control"
                                    name="class_duration">
                                <span class="input-group-text">Hours</span>
                            </div>

                            @isset($error['class_duration'])
                                <span class="text-danger">
                                    {{ $error['class_duration'][0] }}
                                </span>
                            @endisset
                        </div>
                        <div class="w-100">
                            <label for="">Select Days</label>
                            <div class="row row-cols-4 g-3">
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Saturday"
                                        {{ in_array('Saturday', old('class_days', [])) ? 'checked' : '' }}> Saturday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Sunday"
                                        {{ in_array('Sunday', old('class_days', [])) ? 'checked' : '' }}> Sunday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Monday"
                                        {{ in_array('Monday', old('class_days', [])) ? 'checked' : '' }}> Monday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Tuesday"
                                        {{ in_array('Tuesday', old('class_days', [])) ? 'checked' : '' }}> Tuesday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Wednesday"
                                        {{ in_array('Wednesday', old('class_days', [])) ? 'checked' : '' }}> Wednesday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Thursday"
                                        {{ in_array('Thursday', old('class_days', [])) ? 'checked' : '' }}> Thursday
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Friday"
                                        {{ in_array('Friday', old('class_days', [])) ? 'checked' : '' }}> Friday
                                </div>
                            </div>
                            @isset($error['class_days'])
                                <span class="text-danger">
                                    {{ $error['class_days'][0] }}
                                </span>
                            @endisset
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Create Schedule</button>
                    </div>
                </form>
            </div>
        @endisset

    </div>
@endsection
