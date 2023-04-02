@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Dashboard</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Orders</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Total Orders"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> {{ $noOfOrders }}
                            </span>
                            <span class="change up text-danger"></span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">{{  $currentMonthOrder }} </div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">{{ $currentWeekOrder }} </div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Credit</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Total Credit Amount"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> 
                            </span>
                            <span class="change down text-danger"></span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">{{ currency($creditMonthTransaction) }} <span class="currency currency-usd">USD</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">{{ currency($creditWeekTransaction) }} <span class="currency currency-usd">USD</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-4">
                <div class="card card-bordered  card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Debit</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Total Debit Amount"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> {{ currency($totalDebit) }}
                            </span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount"> <span class="currency currency-usd">USD</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount"><span class="currency currency-usd">USD</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalBalance"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            {{-- chart --}}

            <div class="col-md-12">
                <div class="card card-preview">
                    <div class="card-inner">
                        <div class="card-head">
                            <h6 class="title">Rounded Chart</h6>
                        </div>
                        <div class="nk-ck-sm">
                            <canvas class="line-chart" id="filledLineChart"></canvas>
                        </div>
                    </div>
                </div><!-- .card-preview -->
            </div>
        </div>
    </div>
@endsection
