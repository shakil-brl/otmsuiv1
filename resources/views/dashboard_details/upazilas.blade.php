@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Upazila List</h3>
        <x-alert />
        <table class="table table-bordered bg-white">
            <thead>
                <th>S/N</th>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach (range(1, 5) as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ mt_rand(1000, 9999) }}
                        </td>
                        <td>
                            {{ fake()->name() }}
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
