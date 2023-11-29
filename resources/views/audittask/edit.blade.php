@extends('layouts.auth-master')

@section('template_title')
    {{ __('Update') }} Audittask
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12 m-5">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Audittask</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('audittasks.update', $audittask->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('audittask.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
