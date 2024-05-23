@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <!-- <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <i class="nc-icon nc-single-02"></i>
                                    <p class="card-category" style="color: black;">Employees</p>
                                    <p class="card-title">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                    <i class="nc-icon nc-paper"></i>
                                    <p class="card-category" style="color: black;">Leave Type</p>
                                    <p class="card-title">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                <i class="nc-icon nc-check-2"></i>
                                    <p class="card-category" style="color: black;">Approved</p>
                                    <p class="card-title">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                <i class="nc-icon nc-alert-circle-i"></i>
                                    <p class="card-category">Pending</p>
                                    <p class="card-title">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection -->

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush




