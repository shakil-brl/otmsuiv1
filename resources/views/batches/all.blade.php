@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-list.batch_list') }}</h3>
        <x-alert />
        @isset($results['data'])
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="batch_search" value="{{ request('batch_search') }}" class="form-control w-75"
                            placeholder="search by batch code">
                        <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{__('batch-list.sl')}}</th>
                    <th>{{__('batch-list.batch_code')}}</th>
                    <th>{{__('batch-list.training_title')}}</th>
                    <th>{{__('batch-list.location')}}</th>
                    <th>{{__('batch-list.start_date')}}</th>
                    <th>{{__('batch-list.class_days')}}</th>
                    <th>{{__('batch-list.class_schedule')}}</th>
                    <th>{{__('batch-list.action')}}</th>
                </thead>
                <tbody>
                    @foreach ($results['data'] ?? [] as $index => $batch)
                        @php
                            $schedule = $batch['schedule'] ?? null;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
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
                                    <span> {{__('batch-list.days')}}: {{ $schedule['class_days'] }}</span><br>
                                    <div class="mt-1 d-flex justify-content-between align-item-center">
                                        <span>{{__('batch-list.time')}}: {{ $schedule['class_time'] }}</span>
                                        <span>{{__('batch-list.duration')}}: {{ $schedule['class_duration'] }} {{__('batch-list.hours')}}</span>
                                    </div>
                                @else
                                @endif
                            </td>
                            <td>
                                @if ($schedule == null)
                                    <button href="" class="btn btn-sm btn-info" disabled>
                                        View Schedule
                                    </button>
                                @else
                                    <a href="{{ route('batch-schedule.office', [$schedule['id'], $batch['id']]) }}"
                                        class="btn btn-sm btn-info">
                                        View Schedule
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                                    href="{{ route('batches.all', ['page' => 1]) }}">First</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">First</span></li>
                        @endif

                        {{-- Previous Page --}}
                        @if ($current_page > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.all', ['page' => $current_page - 1]) }}">Previous</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @endif

                        {{-- Pages --}}
                        @for ($i = max(1, $current_page - 2); $i <= min($last_page, $current_page + 2); $i++)
                            <li class="page-item {{ $i == $current_page ? 'active' : '' }}"><a class="page-link"
                                    href="{{ route('batches.all', ['page' => $i]) }}">{{ $i }}</a></li>
                        @endfor

                        {{-- Next Page --}}
                        @if ($current_page < $last_page)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.all', ['page' => $current_page + 1]) }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif

                        {{-- Last Page --}}
                        @if ($last_page > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ route('batches.all', ['page' => $last_page]) }}">Last</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Last</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endisset
    </div>
@endsection
