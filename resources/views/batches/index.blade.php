@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        @isset($results['data'])
            <div class="m-4">
                <div id="schedule-header">
                    <div>
                        <div class="icon">
                            <img src="{{ asset('img') }}/new_icon/schedule_header.png" alt="">
                        </div>
                    </div>
                    <div class="row row-cols-3">
                        <div class="item">
                            <div class="title">সিডিউল</div>
                            <div class="tag">ম্যানেজমেন্ট</div>
                        </div>
                        <div class="item">
                            <div class="title">{{ $results['total'] ?? 0 }}</div>
                            <div class="tag">মোট ব্যাচ সংখ্যা</div>
                        </div>
                        {{-- <div class="item">
                            <div class="title">6</div>
                            <div class="tag">মোট কোর্সের সংখ্যা</div>
                        </div> --}}
                    </div>
                </div>

                <x-alert />

                <div id="schedule-batches">
                    <div>

                        @foreach ($results['data'] ?? [] as $index => $batch)
                            @php
                                $schedule = $batch['schedule'] ?? null;
                            @endphp
                            <!-- Batch -->
                            <div class="batch">
                                <div class="info">
                                    <div class="row row-cols-6">
                                        <div>
                                            <div class="label">
                                                ব্যাচ কোড #
                                            </div>
                                            <div class="title">
                                                {{ $batch['batchCode'] ?? '' }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="label">
                                                কোর্সের নাম
                                            </div>
                                            <div class="title">
                                                {{ $batch['get_training']['title']['Name'] ?? '' }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="label">
                                                ঠিকানা
                                            </div>
                                            <div class="title">
                                                {{ $batch['GEOLocation'] ?? '' }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="label">
                                                মোট ক্লাস সময়কাল
                                            </div>
                                            <div class="title">
                                                {{ $batch['duration'] ?? 0 }} দিন
                                            </div>
                                        </div>
                                        <div>
                                            <div class="label">
                                                ক্লাস শুরু
                                            </div>
                                            <div class="title">
                                                {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="buttons">
                                                @if ($schedule == null)
                                                    <a href="{{ route('batch-schedule.create', $batch['id']) }}"
                                                        class="btn schedule-btn btn-create">
                                                        সিডিউল তৈরি করুন
                                                    </a>
                                                @else
                                                    <a href="{{ route('batch-schedule.index', [$schedule['id'], $batch['id']]) }}"
                                                        class="btn schedule-btn btn-view">সিডিউল দেখুন</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($schedule != null)
                                    <div class="schedule">
                                        <div class="row row-cols-2">
                                            <div class="col-10">
                                                <div class="d-flex">
                                                    <div class="class-days-area">
                                                        <div class="left-title">
                                                            <div class="icon">
                                                                <span class="material-icons-outlined">
                                                                    calendar_month
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <div class="tag">ক্লাস হবে</div>
                                                                <div class="title">যে দিনগুলিতে</div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $days = explode(',', $schedule['class_days']);
                                                        @endphp
                                                        <div class="week-days">
                                                            @if (in_array('Saturday', $days))
                                                                <div class="day sat">
                                                                    শনি
                                                                </div>
                                                            @endif
                                                            @if (in_array('Sunday', $days))
                                                                <div class="day sun">
                                                                    রবি
                                                                </div>
                                                            @endif
                                                            @if (in_array('Monday', $days))
                                                                <div class="day mon">
                                                                    সোম
                                                                </div>
                                                            @endif
                                                            @if (in_array('Tuesday', $days))
                                                                <div class="day tue">
                                                                    মঙ্গল
                                                                </div>
                                                            @endif
                                                            @if (in_array('Wednesday', $days))
                                                                <div class="day wed">
                                                                    বুধ
                                                                </div>
                                                            @endif
                                                            @if (in_array('Thursday', $days))
                                                                <div class="day thu">
                                                                    বৃহঃ
                                                                </div>
                                                            @endif
                                                            @if (in_array('Friday', $days))
                                                                <div class="day fri">
                                                                    শুক্র
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="class-days-area class-time">
                                                        <div class="left-title">
                                                            <div class="icon">
                                                                <span class="material-icons-outlined">
                                                                    schedule
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <div class="tag">ক্লাসের</div>
                                                                <div class="title">সময়কাল</div>
                                                            </div>
                                                        </div>
                                                        <div class="week-days">
                                                            <div class="day sat">
                                                                {{ $schedule['class_time'] }} ঘন্টা
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-2">
                                                {{-- <div class="buttons">
                                                    <a class="btn schedule-btn btn-update">সিডিউল দেখুন</a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <div class="d-flex justify-content-end mt-3">
                @php
                    $current_page = $results['current_page'];
                    $total = $results['total'];
                    $per_page = $results['per_page'];
                    $last_page = $results['last_page'];
                    $total_page = $last_page - $current_page;
                @endphp
                <nav aria-label="Page navigation example" class="bg-white p-2">
                    <ul class="pagination">

                        {{-- First Page --}}
                        @if ($current_page > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.index', ['page' => 1]) }}">{{ __('batch-list.first') }}</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">{{ __('batch-list.first') }}</span></li>
                        @endif

                        {{-- Previous Page --}}
                        @if ($current_page > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.index', ['page' => $current_page - 1]) }}">{{ __('batch-list.previous') }}</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">{{ __('batch-list.previous') }}</span></li>
                        @endif

                        {{-- Pages --}}
                        @for ($i = max(1, $current_page - 2); $i <= min($last_page, $current_page + 2); $i++)
                            <li class="page-item {{ $i == $current_page ? 'active' : '' }}"><a class="page-link"
                                    href="{{ route('batches.index', ['page' => $i]) }}">{{ $i }}</a></li>
                        @endfor

                        {{-- Next Page --}}
                        @if ($current_page < $last_page)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.index', ['page' => $current_page + 1]) }}">{{ __('batch-list.next') }}</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">{{ __('batch-list.next') }}</span></li>
                        @endif

                        {{-- Last Page --}}
                        @if ($last_page > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.index', ['page' => $last_page]) }}">{{ __('batch-list.last') }}</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">{{ __('batch-list.last') }}</span></li>
                        @endif

                    </ul>
                </nav>
            </div>
        @endisset
    </div>
@endsection
