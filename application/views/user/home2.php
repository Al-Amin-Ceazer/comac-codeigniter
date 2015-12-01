<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?=PRO_NAME?> | <?= $title?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
<!-- BEGIN THEME STYLES -->
<link href="<?=base_url()?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?=base_url()?>assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<?php $this->load->view('user/common/header');?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="container">
    <div class="page-container">
        <?php $this->load->view('user/common/sidebar');?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title">
                <?=$page_title?>
                <small><?=$page_subtitle?></small>
            </h3>

                <?php $this->load->view('user/common/breadcrumb');?>
                <?php $this->load->view('user/common/alerts');?>
                <!-- END PAGE HEADER-->
                <?php $this->load->view("user/$view");?>
            </div>
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <!--Cooming Soon...-->
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <?php $this->load->view('user/common/footer');?>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!--script src="<?=base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script-->
<script src="<?=base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/pages/scripts/components-dropdowns.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {
           // initiate layout and plugins
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
           ComponentsDropdowns.init();
        });
    </script>
<!-- END GOOGLE RECAPTCHA -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>