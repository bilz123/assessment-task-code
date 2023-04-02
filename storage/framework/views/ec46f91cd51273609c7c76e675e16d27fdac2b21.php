<!DOCTYPE html>
<html lang="en" class="js">

<>
    <meta charset="utf-8">
    <meta name="author" content="The Right Software">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>">

    <!-- Page Title  -->
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <link id="skin-default" rel="stylesheet" href="<?php echo e(asset('/css/theme.css?ver=2.9.1')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/custom.css')); ?>">
    

    <?php echo $__env->yieldPushContent('page-styles'); ?>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s  -->
        <div class="nk-main ">
            <!-- sidebar @s  -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="javascript:void(0);" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="javascript:void(0);" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="<?php echo e(asset('/images/logo.png')); ?>" srcset="<?php echo e(asset('/images/logo2x.png')); ?> 2x" alt="logo">
                            <img class="logo-dark logo-img" src="<?php echo e(asset('/images/logo-dark.png')); ?>" srcset="<?php echo e(asset('/images/logo-dark2x.png')); ?> 2x" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <?php echo $__env->make('layouts.includes.sidemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e  -->
            <!-- wrap @s  -->
            <div class="nk-wrap ">
                <?php echo $__env->make('layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- content @s  -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e  -->
                <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- wrap @e  -->
        </div>
        <!-- main @e  -->
    </div>

    <!-- Ajax modal -->
    <div class="modal fade zoom bd-example-modal-lg" id="ajax-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close" modal-close>
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-lg">
                    <div id="content"></div>
                    <div id="spinner">
                        <div class="modal-body text-center">
                            <div class="spinner spinner-border text-center" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script src="<?php echo e(mix('/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bundle.js?ver=2.9.1')); ?>"></script>
    <script src="<?php echo e(asset('/js/scripts.js?ver=2.9.1')); ?>"></script>
    <script src="<?php echo e(asset('/js/charts/gd-default.js?ver=2.9.1')); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>"></script>
    <script src="<?php echo e(asset('js/example-chart.js?ver=2.9.1')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php echo $__env->yieldPushContent('page-scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\NorthBankApp\resources\views/layouts/app.blade.php ENDPATH**/ ?>