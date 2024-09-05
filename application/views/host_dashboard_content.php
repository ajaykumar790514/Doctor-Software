<!-- <div style="width: 180px;"></div> -->
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">
            
            
            <!-- eCommerce statistic -->
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card ">
                        <div class="card-header bg-hexagons">
                            <h4 class="card-title ">Statistics</h4>
                            <div class="heading-elements">
                                <ul class="list-inline d-block mb-0">
                                    <li>
                                        <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right" href="#">
                                            <span class="white">Earnings For <?=$_month?></span>
                                            <i class="ft-bar-chart pl-1 white"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show bg-hexagons">
                            <div class="card-body pt-0 pb-1">
                                <div class="media d-flex">
                                    <div class="align-self-center width-100">
                                        
                                    </div>
                                    <div class="media-body text-right mt-2">
                                        <h3 class=" font-large-2 blue-grey lighten-1 ">₹ <?=$totalEarnings?>
                                        </h3>
                                        <h6 class="mt-1">
                                            <span class="text-muted">Bookings
                                                <a href="#" class="darken-2"><?=$totalBookings?></a>
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <h5 class="card-title text-bold-700 my-2">
                        <?=$monthDateStr?>
                        <a href="#" style="color: white;" onclick="page_content()"><i class="ft-rotate-cw"></i></a>
                        <a class="btn btn-primary btn-sm mr-1" href="<?=base_url()?>?content=today">Today</a>
                        <a class="btn btn-primary btn-sm mr-1" href="<?=base_url()?>?content=tomorrow">Tomorrow</a>
                        <a class="btn btn-primary btn-sm mr-1" href="<?=base_url()?>?content=all">All</a>
                    </h5>

                    
                </div>



                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Check In Remaining" data-url="<?=base_url()?>check_in_remaining?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Check In Remaining</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($check_in_remaining)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Checked In" data-url="<?=base_url()?>checked_in?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Checked In</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($checked_in)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Check Out Remaining" data-url="<?=base_url()?>check_out_remaining?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Check Out Remaining</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($check_out_remaining)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Checked Out" data-url="<?=base_url()?>checked_out?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Checked Out</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($checked_out)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Staying" data-url="<?=base_url()?>staying?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Staying</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($staying)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-info border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="Upcoming Booking" data-url="<?=base_url()?>upcoming_booking?date=<?=$date?>">
                        <div class="card-header">
                            <h4 class="card-title">Upcoming Booking</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400"><?=count($upcoming_booking)?><i class="ft-users float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-danger border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="OCCUPIED" data-url="<?=base_url()?>occupied-property-host" >
                        <div class="card-header">
                            <h4 class="card-title text-danger">OCCUPIED</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-danger text-bold-400"><?=count($occupied)?><i class="la la-building float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-primary border-top-3 rounded-1 cursor-pointer" data-toggle="modal" data-target="#showModal-xl" data-whatever="AVAILABlLE" data-url="<?=base_url()?>availabile-property-host">
                        <div class="card-header">
                            <h4 class="card-title text-primary">AVAILABlLE</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400 text-primary"><?=count($available)?><i class="la la-building float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card pull-up border-top-primary border-top-3 rounded-1 cursor-pointer">
                        <div class="card-header">
                            <h4 class="card-title text-primary">BOOKINGS</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-1">
                                <h4 class="font-large-1 text-bold-400 text-primary"><?=$todayBookings?><i class="la la-building float-right"></i></h4>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--/ eCommerce statistic -->
        </div>






    </div>

<script type="text/javascript">
    setTimeout(function() {
        if (!$('body').hasClass('menu-collapsed')) {
            sidebar_hide();
        }
    }, 1000);
</script>
