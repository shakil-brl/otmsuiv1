@extends('layouts.auth-master')
@push('css')
<link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
@endpush
@section('content')
@php
$userAuth = Session::get('authUser');
$userRole = $userAuth['userRole'];
@endphp
<div class="m-5">
    <div id="main-content bg-warning">
        <div class="page-content" style="background-color: transparent;">
            <div class="m-4">
                <div class="row g-4 row-cols-3 cards" id="dashboard-card">

                    @php
                    $userRoleList=[
                    'SuperAdmin',
                    'superAdmin',
                    'Admin',
                    'admin',
                    'DC',
                    'dc',
                    'UNO',
                    'uno',
                    'Provider',
                    'provider',
                    'Trainer',
                    'trainer',
                    'DPD',
                    'dpd',
                    'DG',
                    'dg',
                    ];
                    @endphp
                    @if (in_array($userRole, $userRoleList))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.total_batches')" :totalBatch="$totalBatch ?? 0"
                            :icon="asset('img/new_icon/total_batch.png')" :title="__('dashboard.total_batch')"
                            :class="'card-item purple'" />

                    </div>
                    @endif

                    @if (in_array($userRole, $userRoleList))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.running_batches')"
                            :totalBatch="$runningBatch ?? 0" :icon="asset('img/new_icon/current_batch.png')"
                            :title="__('dashboard.running_batch')" :class="'card-item yellow'" />
                    </div>
                    @endif

                    @if (in_array($userRole, $userRoleList))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.complete_batches')"
                            :totalBatch="$runningBatch ?? 0" :icon="asset('img/new_icon/completed_batch.png')"
                            :title="__('dashboard.complete_batch')" :class="'card-item green'" />
                    </div>
                    @endif

                    @if (in_array($userRole, ['SuperAdmin', 'superAdmin', 'Admin', 'admin', 'DPD', 'dpd','DG',
                    'dg',]))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.districts')" :totalBatch="$totalDistrict ?? 0"
                            :icon="asset('img/new_icon/district.png')" :title=" __('dashboard.district')"
                            :class="'card-item green-white'" />
                    </div>
                    @endif

                    @if (in_array($userRole, ['SuperAdmin', 'superAdmin', 'Admin', 'admin', 'DPD', 'dpd','DG',
                    'dg',]))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.upazilas')" :totalBatch="$totalUpazila ?? 0"
                            :icon="asset('img/new_icon/upazila.png')" :title="__('dashboard.upazila')"
                            :class="'card-item info'" />
                    </div>
                    @endif

                    @if (in_array($userRole, ['SuperAdmin', 'superAdmin', 'Admin', 'admin', 'DPD', 'dpd','DG',
                    'dg',]))
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.partners')" :totalBatch="$totalProvider ?? 0"
                            :icon="asset('img/new_icon/partner.png')" :title="__('dashboard.partner')"
                            :class="'card-item red'" />
                    </div>
                    @endif
                </div>

                @if (in_array($userRole, $userRoleList))
                <div id="dashboard-attendance">
                    <div class="row align-items-stretch">
                        <div class="col-7">
                            <div id="attendance-summery">
                                <div class="header">
                                    <div class="left menu">
                                        <a class="link active" href="#">{{ __('dashboard.todays') }}</a>
                                        <a class="link" href="#">{{ __('dashboard.weekly') }}</a>
                                        <a class="link" href="#">{{ __('dashboard.monthly') }}</a>
                                    </div>
                                    <div class="right menu">
                                        <a class="link" href="#">{{ __('dashboard.details') }}</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="content">
                                        <div class="icon">
                                            <img src="{{ asset('img/new_icon') }}/attendance.png" alt="">
                                        </div>
                                        <div class="attendance">
                                            <div class="items">
                                                <div class="item">
                                                    <div class="digit">{{ $totalPresentToday ?? 0 }}</div>
                                                    <div class="label">{{ __('dashboard.total_present') }}</div>
                                                </div>
                                                <div class="item">
                                                    <div class="digit">66%</div>
                                                    <div class="label">{{ __('dashboard.percentage_attendance') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="items">
                                                <div class="item">
                                                    <div class="digit">20000</div>
                                                    <div class="label">{{ __('dashboard.average_attendance') }}
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="digit">7</div>
                                                    <div class="label">{{ __('dashboard.dropout_trainee') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div id="attendance-chart" class="h-100">
                                <div class="chart-item">
                                    <div class="bar" style="height: 70%;">
                                        <span class="bar-text">75%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_sat') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar danger" style="height: 0%;">
                                        <span class="bar-text">25%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_sun') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 95%;">
                                        <span class="bar-text">100%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_mon') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 35%;">
                                        <span class="bar-text">35%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_tue') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 90%;">
                                        <span class="bar-text">100%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_wed') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 50%;">
                                        <span class="bar-text">55%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_thu') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div id="allownce">
                    <div class="row  align-items-stretch">
                        @if (in_array($userRole, $userRoleList))
                        <div class="col-7">
                            <a href="{{route('dashboard_details.trainers')}}">
                                <div class="trainer-info">
                                    <div id="attendance-summery">
                                        <div>
                                            <div class="content">
                                                <div class="icon">
                                                    <img src="{{ asset('img/new_icon') }}/trainer.png" alt="">
                                                </div>
                                                <div class="attendance">
                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">{{ $totalTrainer ?? 0 }}</div>
                                                            <div class="label">{{ __('dashboard.total_trainer') }}
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="digit">66%</div>
                                                            <div class="label">{{ __('dashboard.top_trainer') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">20000</div>
                                                            <div class="label">{{ __('dashboard.reserve_trainer') }}
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="digit">7</div>
                                                            <div class="label">{{ __('dashboard.lack_trainer') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{route('traineeEnroll.index')}}">
                                <div class="student-info">
                                    <div id="attendance-summery">
                                        <div>
                                            <div class="content">
                                                <div class="icon">
                                                    <img src="{{ asset('img/new_icon') }}/student_info.png" alt="">
                                                </div>
                                                <div class="attendance">
                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">{{ $totalStudent ?? 0 }}</div>
                                                            <div class="label">{{ __('dashboard.total_trainee') }}
                                                            </div>
                                                        </div>

                                                        <div class="item">
                                                            <div class="digit">66%</div>
                                                            <div class="label">
                                                                {{ __('dashboard.successful_freelancer') }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">20000</div>
                                                            <div class="label">{{ __('dashboard.dropout_trainee') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if (in_array($userRole, $userRoleList))
                        <div class="col-5">
                            <div id="py-chart">
                                <div id="attendance-summery">
                                    <div>
                                        <div class="content">
                                            <div class="icon">
                                                <img src="{{ asset('img/new_icon') }}/alownce.png" alt="">
                                            </div>
                                            <div class="attendance">
                                                <div class="items d-block">
                                                    <div class="item">
                                                        <div class="digit">{{ $totalStudent ?? 0 }}</div>
                                                        <div class="label">{{ __('dashboard.total_trainee') }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div>
                                            <canvas id="allownceChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let traineePaid = "{{ __('dashboard.trainee_paid') }}";
        let traineeUnpaid = "{{ __('dashboard.trainee_unpaid') }}";
        let traineeAllowance = "{{ __('dashboard.trainee_allowance') }}";
        const ctx = document.getElementById('allownceChart');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    traineePaid,
                    traineeUnpaid,
                ],
                datasets: [{
                    label: traineeAllowance,
                    data: [2238576, 3197964],
                    backgroundColor: [
                        '#F97885',
                        '#4ADE80',
                    ],
                    hoverOffset: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'right', // Set the legend position to the right
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const value = data.datasets[0].data[i];
                                        return {
                                            text: `${label} : ${value}`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: isNaN(value) || value === 0,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                },
            },
        });




        const ctx2 = document.getElementById('attendance');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [
                    traineePaid,
                    traineeUnpaid,
                ],
                datasets: [{
                    label: traineeAllowance,
                    data: [50, 100, 150, 80, 300, 25, 120, 150, 44],
                    backgroundColor: [
                        '#F97885',
                        '#4ADE80',
                    ],
                    hoverOffset: 0
                }]
            },
            // data: data,

        });
</script>
@endpush