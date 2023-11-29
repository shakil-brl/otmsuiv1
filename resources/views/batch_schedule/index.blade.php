@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <!--begin::Content-->

    <div class="m-4">
        <div id="batch-header">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $batch['batchCode'] ?? '' }}</div>
                    <div class="tag">ব্যাচ কোড #</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                    <div class="tag">কোর্সের নাম</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                    <div class="tag">ঠিকানা</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['duration'] ?? '' }} দিন</div>
                    <div class="tag">মোট ক্লাস সময়কাল</div>
                </div>
            </div>
        </div>

        @isset($schedule_details)
            <div id="class-days">
                @foreach (collect($schedule_details) as $schedule_detail)
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                        $start_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['start_time']);
                        $end_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['end_time']);
                    @endphp
                    <div class="day">
                        <div class="day-no">
                            <div class="label">
                                দিন #
                            </div>
                            <div class="title">
                                {{ $loop->iteration }}
                            </div>
                        </div>
                        <div class="day-name">
                            <div class="label">
                                {{ $date->format('l') }}
                            </div>
                            <div class="title">
                                {{ $date->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="class-time-detail">
                            <div class="left">
                                <div class="icon">
                                    <span class="material-icons-outlined">
                                        schedule
                                    </span>
                                </div>
                                <div class="border-right">
                                    <div class="label">ক্লাসের</div>
                                    <div class="text">সময়কাল</div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="time">
                                    {{ $start_time->format('h:i:s A') }} - {{ $end_time->format('h:i:s A') ?? '' }} টা
                                </div>
                                <div class="d-flex">
                                    @isset($schedule_detail['status'])
                                        @if ($schedule_detail['status'] == 1)
                                            <div class="icon waiting">
                                                <span class="material-icons-outlined">
                                                    event
                                                </span>
                                            </div>
                                            <div>
                                                <div class="label">ক্লাস স্টেটাস</div>
                                                <div class="text">অপেক্ষারত</div>
                                            </div>
                                        @elseif ($schedule_detail['status'] == 2)
                                            <div class="icon running">
                                                <span class="material-icons-outlined">
                                                    directions_run
                                                </span>
                                            </div>
                                            <div>
                                                <div class="label">ক্লাস স্টেটাস</div>
                                                <div class="text">চলমান</div>
                                            </div>
                                        @elseif ($schedule_detail['status'] == 3)
                                            <div class="icon complete">
                                                <span class="material-icons-outlined">
                                                    done
                                                </span>
                                            </div>
                                            <div>
                                                <div class="label">ক্লাস স্টেটাস</div>
                                                <div class="text">সম্পন্ন</div>
                                            </div>
                                        @endif
                                    @endisset


                                </div>
                            </div>
                        </div>
                        <div class="button-area">
                            @isset($schedule_detail['status'])
                                @if ($schedule_detail['status'] == 1)
                                    @if ($date <= \Carbon\Carbon::now())
                                        <a href="{{ route('attendance.start', $schedule_detail['id']) }}"
                                            class="btn btn-detail  update">
                                            শুরু
                                            করুন
                                        </a>
                                    @else
                                        <a class="btn disabled btn-detail  update">
                                            শুরু
                                            করুন
                                        </a>
                                    @endif
                                @elseif ($schedule_detail['status'] == 2)
                                    <a href="{{ route('attendance.form', [$schedule_detail['id']]) }}" class="btn btn-detail ">
                                        জয়েন করুন
                                    </a>
                                @elseif ($schedule_detail['status'] == 3)
                                    <a href="{{ route('attendance.form', [$schedule_detail['id']]) }}"
                                        class="btn btn-detail complete">
                                        বিস্তারিত
                                        দেখুন</a>
                                @endif
                            @endisset


                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>

@endsection
