

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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
                                <h6 class="subtitle">Total Active Vendors</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Total Orders"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> 
                            </span>
                            <span class="change up text-danger"></span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">Pending vendors</div>
                                    <div class="amount"> </div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">Suspended vendors</div>
                                    <div class="amount"></div>
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
                                <h6 class="subtitle">Total Commission</h6>
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
                                    <div class="amount"><span class="currency currency-usd">USD</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount"><span class="currency currency-usd">USD</span></div>
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
                            <span class="amount">
                            </span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount"><span class="currency currency-usd">USD</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount"> <span class="currency currency-usd">USD</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalBalance"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NorthBankApp\resources\views/admindashboard/dashboard.blade.php ENDPATH**/ ?>