<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?=$title?> - <?=$comp?></title>
    <link rel="apple-touch-icon" href="<?=base_url()?>static/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>static/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/timeline/vertical-timeline.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/forms/toggle/switchery.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/tables/datatable/datatables.min.css"> -->
    <!-- BEGIN:  fullcalendar  -->
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/calendars/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/plugins/calendars/fullcalendar.css"> -->
    <!-- END:  fullcalendar  -->

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/extensions/toastr.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/forms/selects/select2.min.css">
    <!-- END: Page CSS-->
    <!-- image -->

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/pages/gallery.css">



<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->

<!--  -->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if(@$pAssets) : //Start page assets
    if(in_array('daterangepicker', $pAssets)): ?>
    <script type="text/javascript" src="<?=base_url()?>static/app-assets/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>static/app-assets/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/daterangepicker/daterangepicker.css" />
    <?php endif;  if(in_array('chart', $pAssets)): ?>
    <script src="<?=base_url()?>static/app-assets/js/scripts/charts/Chart.bundle.min.js"></script>
    <?php endif; ?>


    <?php endif; //End page assets ?>

    <script type="text/javascript" src="<?=base_url()?>static/app-assets/vendors/js/jquery-validation/jquery.validate.js"></script>

</head>
<!-- END: Head -->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="2-columns" style="opacity: 0.7;">

<style type="text/css">
[class*="col-"]{
    float: left;
}

[data-toggle="modal"]{
    cursor: pointer;
}
.white-space-nowrap{
    white-space: nowrap;
}

.pagination {
    margin-top:0; 
    float: right;
}
.dataTables_filter{
    text-align: right;
}
.ajaxloder {
    visibility: visible;
    position: fixed;
    z-index: 99999999;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 85px;
    height: 85px;
    margin: auto;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 50 50'%3E%3Cpath d='M28.43 6.378C18.27 4.586 8.58 11.37 6.788 21.533c-1.791 10.161 4.994 19.851 15.155 21.643l.707-4.006C14.7 37.768 9.392 30.189 10.794 22.24c1.401-7.95 8.981-13.258 16.93-11.856l.707-4.006z'%3E%3CanimateTransform attributeType='xml' attributeName='transform' type='rotate' from='0 25 25' to='360 25 25' dur='0.6s' repeatCount='indefinite'/%3E%3C/path%3E%3C/svg%3E") center / contain no-repeat;
}
.changeStatus,.changeStatusDispaly{
    font-size: 20px;
    font-weight: bolder;
    cursor: pointer;
}
.changeStatus .icon-close, .changeStatusDispaly .icon-close{
    color: red;
}
.changeStatus .la-check-circle, .changeStatusDispaly .la-check-circle{
    color: green;
}
.change-indexing{
    width: 60px;
}
.btn-sm{
    float: left;
}
.btn-tb-f{
    width: 300px;
    float: left;
    margin-left: 15px;
}
.modal-body {
    max-height: 85vh;
    overflow-x: hidden;
    overflow-y: scroll;
    padding-top: 0;
}

.modal-body .table th, .modal-body .table td {
    padding: 0.4rem 0.5rem;
}
/* width */
.modal-body::-webkit-scrollbar {
  width: 5px;
}

/* Track */
.modal-body::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.modal-body::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
.modal-body::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
.modal .form-body{
    float: left;
}
.modal form .form-actions {
    border-top: 1px solid #d1d5ea;
    padding: 15px 0px 15px 0;
    margin-top: 0;
    float: left;
    width: 100%;
}
.la-check-circle-o{
    cursor: auto;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance: textfield;
/* Firefox */
}
form sup{
    color: var(--danger);
}
.is-invalid{
    color: var(--danger);
}

.is-valid{
    color: var(--success);
}

  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: right;
    margin-top: -35px;
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 3vw;
    color: var(--warning);
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}
form .form-group {
    margin-bottom: 0.6rem;
}
label {
    display: inline-block;
    margin-bottom: 0.4rem;
}
.form-control{
  /*  height: -webkit-calc(2.2rem + 2px);
    height: -moz-calc(2.2rem + 2px);
    height: calc(2.2rem + 2px);
    padding: 0.7rem 1rem;*/
}


/**/
.border-none{
    border: none!important;
}
.m-sm{
    margin: 2px;
}
.icons { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}
.icons + img {
  cursor: pointer;
  width: 60px;
  max-height: 60px;
}
.icons:checked + img {
  outline: 2px solid #f00;
}
.pag-link{
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    line-height: 1;
    border-radius: 0.21rem;
    margin: 5px;
    background: var(--primary);
    color: #fff;
    transition: .2s;
}
.pag-link:hover{
    -webkit-box-shadow: 0 1px 2px 0 rgb(105 103 206 / 45%), 0 1px 3px 1px rgb(105 103 206 / 30%);
    box-shadow: 0 1px 2px 0 rgb(105 103 206 / 45%), 0 1px 3px 1px rgb(105 103 206 / 30%);
    color: #fff;
}
/*website properties*/

table ol {
    padding-left: 5px;
}
table ol li{
    list-style: decimal;
}
table ol li::marker{
    margin-right: 10px;
}



ul li label {
    cursor: pointer!important;
}

table .sr_no{
    width: 100px;
}
/*website properties*/



.filter{
    width: 30%;
    height: 30px;
}
.icon-sm{
    max-width: 60px;
    max-height: 60px;
}
.img-sm,
.image-sm{
    max-width: 120px;
    max-height: 120px;
}
.img-md{
    max-width: 280px;
    max-height: 280px;
}
.switchery[data-size="sm"]{
    height: 17px;
    width: 17px;
}
.inline-block{
    display: inline-block!important;
}
tbody tr.checked{
    background-color: #e5e7e8!important;
}
.status-0{
    color: #fa626b;
}
.modal-xl {
    max-width: 90%;
    margin-left: 5%;
    margin-right: 5%;
}


  .extra-action-btns{
    box-shadow: 0px 0px 9px -1px black;
    border-radius: 5px;
    border-top-left-radius: 0px;
    background: white;
    padding: 5px;
    float: left;
    position: absolute;
    margin: -20px 0px 0px 40px;
    /*display: none;*/
  }
  .extra-action-btns::before {
    content: "\f233";
    font-family: 'LineAwesome';
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
    position: absolute;
    color: white;
    text-shadow: 0px 1px 1px black;
    margin: -8px 0px 0px -14px;
  }
  [int]{
    text-align: right;
  }

/*.doc{
    
}*/

/*calender*/
:root {
    --cal_border: #939090;
}


[date]{
    font-weight: bolder;
}
/*calender*/
.no-bordered td,
.no-bordered th{
    border: 0px;
    vertical-align: middle;
}
</style>
    <div class="ajaxloder"></div>
    <?php
    load_view('header');
    load_view('main_menu');
    load_view($contant);
    load_view('footer');
    ?>
    


<div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true" style="z-index: 999999;">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>

<div class="modal fade text-left" id="showModal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-body" style="overflow:hidden;">
              
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
      $('#showModal').on('show.bs.modal', function (event) {
            $('#showModal .modal-body').html('Loading........');

            var button = $(event.relatedTarget); 
            var recipient = button.data('whatever'); 
            var data_url  = button.data('url'); 
            var modal = $(this);
            console.log(button.className);
            $('#showModal .modal-title').text(recipient);
            $('#showModal .modal-body').load(data_url);
        })

        $('#showModal-xl').on('show.bs.modal', function (event) {
            // $('.navbar-header').removeClass('expanded');
            // $('.main-menu').removeClass('expanded');
            $('#showModal-xl .modal-body').html('Loading........');
            var button = $(event.relatedTarget) 
            var recipient = button.data('whatever') 
            var data_url  = button.data('url') 
            var modal = $(this)
            $('#showModal-xl .modal-title').text(recipient)
            $('#showModal-xl .modal-body').load(data_url);
        })

        $('#showModal-sm').on('show.bs.modal', function (event) {
            $('#showModal-sm .modal-body').html('Loading........');

            var button = $(event.relatedTarget) 
            var data_url  = button.data('url') 
            var modal = $(this)
            $('#showModal-sm .modal-body').load(data_url);
        })
</script>
<style type="text/css">
    .zoom-img{
        cursor: zoom-in;
    }
    .zoom-out-img{
        cursor: zoom-out;

    }
    .full-img{
        position: fixed;
        height: 100vh;
        width: 100vw;
        background: #00000047;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999999;
        display: none;
        user-select: none;
        /*transform: translate(-50%, -50%);*/
       
    }
    .blur-bg{
        /*background: red;*/
        height: 100vh;
        width: 100vw;
        position: absolute;
        z-index: 999999;
        filter: blur(20px);
        -webkit-filter: blur(20px);
        background-repeat: no-repeat;
        background-size: cover;
        opacity: .2;
    }
    .full-img .image{
        position: relative;
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        z-index: 9999999;
    }
    .full-img .image img{
        max-width: 100vw;
        height: auto;
        max-height: 100vh;
    }

    .noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
}
.custom-file-input.input-sm{
    cursor: pointer!important;
}
.custom-file-label.input-sm {
    height: -webkit-calc(1.98rem + 2px);
    height: -moz-calc(1.98rem + 2px);
    height: calc(1.98rem + 2px); 
    padding: 0.25rem 1.2rem;
}
.custom-file-label.input-sm::after {
    height: 1.98rem;
    padding: 0.3rem 1.2rem;
}

</style>
<!-- eyM6KP9LauzZd6K5AdEk -->
<div class="full-img zoom-out-img noselect">
    <div class="blur-bg"></div>
    <div class="image">
        <img src="" >
    </div>
</div>
<script type="text/javascript">
    $(document).on('click','.zoom-img',function(event) {
        var img = $(this).attr('src');
        console.log(img);
        $('.full-img').css('display','table');
        $('.full-img .image img').attr('src',img);
        $('.blur-bg').css('background-image','url('+img+')');
    })

    $(document).on('click','.zoom-out-img',function(event) {
        $('.full-img').css('display','none');
        $('.full-img .image img').attr('src','');
    })
</script>



    

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="<?=base_url()?>static/app-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script> -->
    <!-- <script src="<?=base_url()?>static/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script> -->
    <!-- <script src="<?=base_url()?>static/app-assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script> -->
    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/dropzone.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>static/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- <script src="<?=base_url()?>static/app-assets/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script> -->

    <script src="<?=base_url()?>static/app-assets/js/scripts/modal/components-modal.js" type="text/javascript"></script>
    <input type="hidden" name="tb" value="<?=$tb_url?>">
    <input type="hidden" name="page_content" value="<?=(@$page_content_url) ? $page_content_url : '' ?>">
    <!-- END: Page JS-->

    <!-- for images -->
    <script src="<?=base_url()?>static/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js" type="text/javascript"></script>


    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/extensions/toastr.js" type="text/javascript"></script>


    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
     <script src="<?=base_url()?>static/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
        
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script src="<?=base_url()?>static/app-assets/js/scripts/tooltip/tooltip.js"></script>
     

    <!-- BEGIN:  fullcalendar  -->
    <!-- <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/extensions/fullcalendar.js" type="text/javascript"></script> -->
    <!-- END:  fullcalendar  -->
    <!-- for images -->
    





    <script type="text/javascript">
jQuery.fn.exists = function(){return this.length>0;}
      

        function loadtb(url=null){
            if (url!=null) {
                var tbUrl = url;
            }
            else{
                var tbUrl = $('[name="tb"]').val();
            }
            
            if (tbUrl!='') {
                $('#tb').load(tbUrl);
            }
        }

        function page_content(url=null){
            if (url!=null) {
                var pageUrl = url;
            }
            else{
                var pageUrl = $('[name="page_content"]').val();
            }
            
            if (pageUrl!='') {
                $('#page_content').load(pageUrl);
            }
        }

        page_content();


        loadtb();

        function url_content(url){
            $.post(url,function(data) {
                return data;
            })
        }

        $(document).on('click', '.pag-link', function(event){
            document.body.scrollTop = 0; 
            document.documentElement.scrollTop = 0;
            // var search = $('#tb-search').val();
            var FormData = $('.dynamic-tb-search').serialize();
            $.post($(this).attr('href'),FormData)
            .done(function(data){
                $('#tb').html(data);
            })
            return false;
        })

        var timer;
        var timeout = 800;
        $(document).on('keyup', '#tb-search', function(event){
            clearTimeout(timer);
            timer = setTimeout(function(){
                var search  = $('#tb-search').val();
                // console.log(search);
                var tbUrl = $('[name="tb"]').val();
                $.post(tbUrl,{search:search})
                .done(function(data){
                    $('#tb').html(data);
                })
            }, timeout);

            return false;
        })

// $(document).ready(function(){
//   $("#myInput").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// }); 
function sidebar_hide() {
    // alert('skjdf');
    $('.modern-nav-toggle').click();
}

$(document).on('keyup change','.static-tb-search',function(event) {
     var value = $(this).val().toLowerCase();
     var tbtarget  = $(this).attr('tbtarget');
     $(tbtarget+" tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
})

$(document).on('keyup','.static-li-search',function(event) {
    var value = $(this).val().toLowerCase();
    var tbtarget  = $(this).attr('litarget');
    $(tbtarget+" li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });


})

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).on('change input','.dynamic-tb-search',function(event) {
    $(this).submit();
});

$(document).on('click','.dynamic-tb-search [type=reset]',function(event) {
    $('.dynamic-tb-search')[0].reset();
    setTimeout(function() {
        $('.dynamic-tb-search').submit();
    }, 100);
    
});

$(document).on('submit','.dynamic-tb-search',function(event) {
    $this = $(this);

    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      processData: false,
      contentType: false,
      success: function(data){
        console.log(data);
        // return false;
        // data = JSON.parse(data);
        $($this.attr("tagret-tb")).html(data);
        
        // alert_toastr(data.res,data.msg);
      }
    })
    return false;
})

var timer;
$(document).on('input','.sumbit-input',function (event) {
    clearInterval(timer);
    t = $(this);
    timer = setTimeout(function() {
        $(t.attr('tagret-form')).submit();
    }, 1000);
})
$(document).on('change','.sumbit-change',function (event) {
     t = $(this);
    $(t.attr('tagret-form')).submit();
})



        


        $ajaxloder = $('.ajaxloder');
        $body = $('body');
            $(document).on({
            ajaxStart: function() { 
                $ajaxloder.css('visibility','visible');
                // $body.css('opacity','0.7');

                // setTimeout(function() {
                //     $ajaxloder.css('visibility','hidden'); 
                //     // $body.css('opacity','1');
                // }, 5000);
            },
             ajaxStop: function() { 
                 setTimeout(function() {
                    $ajaxloder.css('visibility','hidden'); 
                    // $body.css('opacity','1');
                }, 250);
            }    
        });
        loder();
        function loder() {
            $ajaxloder.css('visibility','hidden'); 
            $body.css('opacity','1');
        };


        $(document).on('click','[data-action="reload"]',function(event) {
        // $('[data-action="reload"]').click(function(){
            // alert()
            if ($(this).hasClass('reload-page')) {
                window.location.href = window.location.href;
            }
            else{
              loadtb();  
            }
            
        })


        function changeStatus(e) {
            Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to change status ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    if(result.value==true){
                    var t = $(e).parent();
                    var data =  $(e).attr('data');
                    var value =  $(e).attr('value');
                    if($(e).attr('column')) {
                        var column =  $(e).attr('column');
                        var url    = '<?=base_url()?>changeStatus/'+column;
                    } else {
                        var url    = '<?=base_url()?>changeStatus';
                    }

                    $.post(url,{data:data,value:value})
                     .done(function(data){
                        t.html(data);
                    })
                     .fail(function() {
                     alert_toastr("error","error");
                    })
                    }
                }).catch(swal.noop);
            return false;



        }

        function changeVisibility(e) {
            Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to change status ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    if(result.value==true){
                    var t = $(e).parent();
                    var data =  $(e).attr('data');
                    var value =  $(e).attr('value');
                    if($(e).attr('column')) {
                        var column =  $(e).attr('column');
                        var url    = '<?=base_url()?>changeVisibility/'+column;
                    } else {
                        var url    = '<?=base_url()?>changeVisibility';
                    }

                    $.post(url,{data:data,value:value})
                     .done(function(data){
                        t.html(data);
                    })
                     .fail(function() {
                     alert_toastr("error","error");
                    })
                    }
                }).catch(swal.noop);
            return false;



        }

       
        $(document).on('click','[data-toggle="change-status"]', function(event) {
            var t = $(this).parent();
            var data =  $(this).attr('data');
            var value =  $(this).attr('value');
            Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to change status ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    if(result.value==true){

                         $.post('<?=base_url()?>change_status/',{data:data,value:value})
                         .done(function(data){
                                console.log(data);

                                t.html(data);
                            })
                        .fail(function() {
                            alert_toastr("error","error");
                          })
                    }
                }).catch(swal.noop);
            return false;




            
        })
        var timer;
        $(document).on('input','.change-indexing',function (event) {
            clearInterval(timer);
            t = $(this);
            timer = setTimeout(function() {
                var data =  t.attr('data');
                var value = t.val();
                 $.post('<?=base_url()?>changeIndexing/',{data:data,value:value})
                 .done(function() {
                    alert_toastr("success","Saved.");
                 })
                .fail(function() {
                    alert_toastr("error","error");
                  })
            }, 1000);
        })
        // indexing
          $(document).on('click','.change-indexing-left',function(event) {
                  var t = $(this);
                  var input = t.siblings('.change-indexing');
                  var indexing = parseInt(input.val())+1;
                  input.val(indexing);
                  changeIndexing(t);
              })

              $(document).on('click','.change-indexing-right',function(event) {
                  var t = $(this);
                  var input = t.siblings('.change-indexing');
                  var indexing = parseInt(input.val())-1;
                  if (indexing<0) {
                    var indexing = 0;
                  }
                  input.val(indexing);
                  changeIndexing(t);
              })

              function changeIndexing(t) {
                
                  clearInterval(timer);
                  timer = setTimeout(function() {
                      var input = t.siblings('.change-indexing');
                      var data =  input.attr('data');
                      var value = input.val();
                       $.post('<?=base_url()?>changeIndexing/',{data:data,value:value})
                       .done(function() {
                          alert_toastr("success","Saved.");
                       })
                      .fail(function() {
                          alert_toastr("error","error");
                        })
                  }, 1000); 
              }
        // indexing


        // $( document ).ready(function() {
        //     $('.changeStatus').click(function(e) {
        //         var t = $(this).parent();
        //         var data =  $(this).attr('data');
        //         var value =  $(this).attr('value');
        //         $.post('<?=base_url()?>changeStatus',{data:data,value:value})
        //         .done(function(data){
                    
        //             // data = JSON.parse(data);
        //             // console.log(data);
        //             t.html(data);
        //         })
        //         .fail(function() {
        //             alert( "error" );
        //           })
        //     })
        // });

        function test() {
            alert('d');
        }

$(document).on("submit", '.ajaxsubmit', function(event) {
    event.preventDefault(); 
    $this = $(this);
    if ($this.hasClass("append")) {
        var append_data = $($this.attr('append-data')).val();
        $(this).append('<input type="hidden" name="append" value="'+append_data+'" /> ');

    }
    var form_data = new FormData(this);
    form_valid = true;

    if ($this.hasClass("validate-form")) {
        if ($this.valid()) {
            form_valid = true;
        }
        else{
            form_valid = true;
        }
    }

    setTimeout(function() {
        if (form_valid == true) {
            $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if (data.res=='success') {
                        if(!$this.hasClass("load-tb")) {
                            $('#tb').html(data.htmlContent);
                        }
                        if(!$this.hasClass("update-form")) {
                            $('[type="reset"]').click();
                        }
                        if ($this.hasClass("reload-tb")) {
                            loadtb();
                        }
                        if ($this.hasClass("reload-page")) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                        if ($this.hasClass("reload-page-content")) {
                            page_content();
                        }
                        if ($this.hasClass("load-receipt")) {
                            window.open(data.receipt_url, '_blank');
                        }
                        if ($this.hasClass("load-cal")) {
                            load_cal();
                        }
                        if ($this.hasClass('close-win')) {
                            setTimeout(function() {
                                window.close();
                            }, 500);
                        }
                        if($this.hasClass("reload-calendar")) {
                            $('.property').change();
                        }
                    }
                    alert_toastr(data.res,data.msg);
                }
            })
        }
    }, 100);

    return false;
})

        $(document).on("submit", 'form.load-content', function(event) {
            event.preventDefault(); 
            $this = $(this);
            $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data:  new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    var target = $this.data('target');
                    $(target).html(data);
                    }
                })
            return false;
        })

        $(document).on('click','[data-toggle="show-hide"]', function(event){
            var dataTarget = $(this).attr('data-target');
            $('.show-'+dataTarget).toggle(100);
            $('.hide-'+dataTarget).toggle(100);
        })

        $(document).on('click','.changeStatusDispaly', function(){
            $this = $(this);
            var t = $this.parent();
            var data =  $this.attr('data');
            var value =  $this.attr('value');
            var url    = '<?=base_url()?>changeStatusDispaly';
            Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to change status ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    if(result.value==true){

                        $.post(url,{data:data,value:value})
                         .done(function(data){
                                t.html(data);
                            })
                         .fail(function() {
                                alert_toastr("error","error");
                            })
                        
                    }
                }).catch(swal.noop);
            return false;
        })


      

   
        function _duplicate(e){
            var r = confirm("You want to duplicate ? ");
            if (r == true) {
              var $this = $(e);
                url = $this.attr('url');
                $.post(url,function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    if (data.res=='success') {
                        loadtb();
                    }
                    alert_toastr(data.res,data.msg);
                })
                return false;
            } 
        }



        function _delete(e){
            
                Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to delete ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    var $this = $(e);
                    url = $this.attr('url');
                    if(result.value==true){
                    $.post(url,function(data){
                        data = JSON.parse(data);
                        if (data.res=='success') {
                            $this.parent().parent().remove();
                        }
                        alert_toastr(data.res,data.msg);
                    })
                    }
                }).catch(swal.noop);
            return false;
          }

$(document).on('change','.onchange-submit', function(event) {
    $(this).parents('form').submit();
})

$(document).on('change','#uploadimg', function(event) {
    $('#uploadfiles').submit();
})

$(document).on('submit','#uploadfiles', function(event) {
    event.preventDefault();
    $this = $(this);
    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        console.log(data);
        data = JSON.parse(data);
        
        if (data.res=='success') {
          reset_modal();
          $this[0].reset();
        }
        alert_toastr(data.res,data.msg);
      }

    });
  return false;
})

$(document).on('click','[data-toggle="copy"]',function(event) {
    var text = $(this).attr('data-target');
   var temp = $("<textarea></textarea>");
      $("body").append(temp);
      temp.val(text).select();
    if(document.execCommand("copy")){
      alert_toastr('success','copied to clipboard');
    }
    else{
      alert_toastr('error','copy to clipboard failed');
    }
    temp.remove();
})


// website properties



// website properties
$(document).on('click','.js-click',function(event) {
    var $this = $(this);
    url = $this.attr('href');
    $.post(url,function(data){
        
        if ($this.hasClass('no-alert')) {
            var data_target = $this.attr('data-target');
            $(data_target).html(data);
            return ; 
        }
        // console.log(data);
        data = JSON.parse(data);

        alert_toastr(data.res,data.msg);
        if (data.res=='success') {
          if ($this.hasClass('tb-reload')) {
            loadtb();
          }
          if ($this.hasClass('load')) {
              var data_target = $this.attr('data-target');
              // console.log(data_target);
              $(data_target).html(data.content);
          }
        }
    })
    return false;
})






$(document).on('click','.inc',function(event) {
        var t = $(this);
        var target = t.attr('data-target');
        var max    = parseInt($(target).attr('max'));
        var value = parseInt($(target).val())+1;
        if (value>max) {
            var value = max;
        }
        $(target).val(value);
    })

    $(document).on('click','.dec',function(event) {
        var t = $(this);
        var target = t.attr('data-target');
        var min    = parseInt($(target).attr('min'));
        var value = parseInt($(target).val())-1;

        if (value<min) {
            var value = min;
        }
        $(target).val(value);
    })



function userDeatils(id) {
    $.ajax({
        type: "POST",
        url: "<?=base_url()?>appUser/detailes",
        data:'id='+id,
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            console.log(data);
            var data = JSON.parse(data);
            $('#cname').val(data.name);
            $('#cdob').val(data.dob);
            $('#cgender').val(data.gender);
            $('#cemail').val(data.email);
            console.log(data);
        }
    });
}




$(document).on("submit", '.filterTb', function(event) {
    event.preventDefault(); 
    $this = $(this);

    if ($('input[name="daterange"]').val()=='' || $('input[name="daterange"]').val()=='undefined') {
        alert_toastr('error','Select Booking From Date');
        $('input[name="daterange"]').focus();
        return false;
    }
    // else if ($('input[name="b_to"]').val()=='' || $('input[name="b_to"]').val()=='undefined') {
    //     alert_toastr('error','Select Booking To Date');
    //     $('input[name="b_to"]').focus();
    //     return false;
    // }
    else if($('input[name="daterange"]').val()!=''){

        if (new Date($('input[name="b_from"]').val()) > new Date($('input[name="b_to"]').val()) ) {
            alert_toastr('error','From date should be less than To date');
            $('input[name="b_from"]').focus();
            return false;
        }
        else{
           $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data:  new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    $('#tb').html(data);
                }
            }) 
        }
    }
    
    return false;
})



    $(document).on('click','[data-toggle="extra-action-btns"]',function(event) {
        var data_target = $(this).data("target");
        $('.btns .collapse').not(data_target).removeClass('show');
        $(data_target).toggleClass('show');
        // alert(data_target);
    })

 
$(document).on('change','[name=state_id]',function(){
    var $this = $(this);
    if ($this.parents('form').find('[name=city_id]')) {
        $this.parents('form').find('[name=city_id]').load('<?=base_url()?>getCities/'+$this.val());
    }
})

$(document).on('change','[name=state]',function(){
    var $this = $(this);
    if ($this.parents('form').find('[name=city]')) {
        $this.parents('form').find('[name=city]').load('<?=base_url()?>getCities/'+$this.val());
    }
})


$(document).on('change','[name=parent_cat_id]',function(){
    var $this = $(this);
    if ($this.parents('form').find('[name=sub_cat_id]')) {
        $this.parents('form').find('[name=sub_cat_id]').load('<?=base_url()?>sub_categories/'+$this.val());
    }

    if ($this.parents('form').find('[name=product_id]')) {
        $this.parents('form').find('[name=product_id]').load('<?=base_url()?>getProducts/'+$this.val());
    }
    
})

$(document).on('change','[name=sub_cat_id]',function(){
    var $this = $(this);

    if ($this.parents('form').find('[name=product_id]')) {
        var parent_cat_id = $this.parents('form').find('[name=parent_cat_id]').val();
        $this.parents('form').find('[name=product_id]').load('<?=base_url()?>getProducts/'+parent_cat_id+'/'+$this.val());
    }
    
})
  // alert_toastr('success','I do not think that word means what you think it means');
    </script>
<style type="text/css">
.toast-top-center {
    top: 48%;
    right: 0;
    width: 100%;
}
</style>
</body>
<!-- END: Body-->

</html>