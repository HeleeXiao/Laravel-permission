@extends("layouts.manager")
@section("title","UR Manager")

@section("content")
    <div id="page-content">
        <!-- First Row -->
        <div class="row">
            <!-- Simple Stats Widgets -->
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background">
                            <i class="gi gi-cardio text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3">
                            <strong><span data-toggle="counter" data-to="2835"></span></strong>
                        </h2>
                        <span class="text-muted">SALES</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-success">
                            <i class="gi gi-user text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-success">
                            <strong>+ <span data-toggle="counter" data-to="2862"></span></strong>
                        </h2>
                        <span class="text-muted">NEW USERS</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-warning">
                            <i class="gi gi-briefcase text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-warning">
                            <strong>+ <span data-toggle="counter" data-to="75"></span></strong>
                        </h2>
                        <span class="text-muted">PROJECTS</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-danger">
                            <i class="gi gi-wallet text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-danger">
                            <strong>$ <span data-toggle="counter" data-to="5820"></span></strong>
                        </h2>
                        <span class="text-muted">EARNINGS</span>
                    </div>
                </a>
            </div>
            <!-- END Simple Stats Widgets -->
        </div>
        <!-- END First Row -->

        <!-- Second Row -->
        <div class="row">
            <div class="col-sm-6 col-lg-8">
                <!-- Chart Widget -->
                <div class="widget">
                    <div class="widget-content border-bottom">
                        <span class="pull-right text-muted">2013</span>
                        Last Year's Data
                    </div>
                    <div class="widget-content border-bottom themed-background-muted">
                        <!-- Flot Charts (initialized in js/pages/readyDashboard.js), for more examples you can check out http://www.flotcharts.org/ -->
                        <div id="chart-classic-dash" style="height: 393px;"></div>
                    </div>
                    <div class="widget-content widget-content-full">
                        <div class="row text-center">
                            <div class="col-xs-4 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-wallet text-dark push-bit"></i> <br><small>$ 41k</small></h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-cardio text-dark push-bit"></i> <br><small>17k Sales</small></h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom border-left">
                                <h3 class="widget-heading"><i class="gi gi-life_preserver text-dark push-bit"></i> <br><small>3k+ Tickets</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Chart Widget -->
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Stats User Widget -->
                <a href="page_ready_profile.html" class="widget">
                    <div class="widget-content border-bottom text-dark">
                        <span class="pull-right text-muted">This week</span>
                        Featured Author
                    </div>
                    <div class="widget-content border-bottom text-center themed-background-muted">
                        <img src="img/placeholders/avatars/avatar13@2x.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                        <h2 class="widget-heading h3 text-dark">Anna Wigren</h2>
                        <span class="text-muted">
                                            <strong>Logo Designer</strong>, Sweden
                                        </span>
                    </div>
                    <div class="widget-content widget-content-full-top-bottom">
                        <div class="row text-center">
                            <div class="col-xs-6 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-briefcase text-dark push-bit"></i> <br><small>35 Projects</small></h3>
                            </div>
                            <div class="col-xs-6 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-heart_empty text-dark push-bit"></i> <br><small>5.3k Likes</small></h3>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- END Stats User Widget -->

                <!-- Mini Widgets Row -->
                <div class="row">
                    <div class="col-xs-6">
                        <a href="javascript:void(0)" class="widget">
                            <div class="widget-content themed-background-info text-light-op text-center">
                                <div class="widget-icon">
                                    <i class="fa fa-facebook"></i>
                                </div>
                            </div>
                            <div class="widget-content text-dark text-center">
                                <strong>98k</strong><br>Followers
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="javascript:void(0)" class="widget">
                            <div class="widget-content themed-background-danger text-light-op text-center">
                                <div class="widget-icon">
                                    <i class="fa fa-database"></i>
                                </div>
                            </div>
                            <div class="widget-content text-dark text-center">
                                <strong>15</strong><br>
                                Active Servers
                            </div>
                        </a>
                    </div>
                </div>
                <!-- END Mini Widgets Row -->
            </div>
        </div>
        <!-- END Second Row -->
        <!-- 首页内容下方 -->
        <div class="block full">
            <div class="block-title">
                <h2>Datatables</h2>
            </div>
            <div class="table-responsive">
                <div id="example-datatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                    <div class="row">
                        <div class="col-sm-6 col-xs-5">
                            <div class="dataTables_length" id="example-datatable_length">
                                <label><select name="example-datatable_length" aria-controls="example-datatable" class="form-control"><option value="5">5</option><option value="10">10</option><option value="20">20</option></select></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-7">
                            <div id="example-datatable_filter" class="dataTables_filter">
                                <label>
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search" aria-controls="example-datatable" />
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    </div></label>
                            </div>
                        </div>
                    </div>
                    <table id="example-datatable" class="table table-striped table-bordered table-vcenter dataTable no-footer" role="grid" aria-describedby="example-datatable_info">
                        <thead>
                        <tr role="row">
                            <th class="text-center sorting_asc" style="width: 49px;" tabindex="0" aria-controls="example-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 221px;">User</th>
                            <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 486px;">Email</th>
                            <th style="width: 119px;" class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                            <th class="text-center sorting_disabled" style="width: 74px;" rowspan="1" colspan="1" aria-label=""><i class="fa fa-flash"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">1</td>
                            <td><strong>AppUser1</strong></td>
                            <td>app.user1@example.com</td>
                            <td><span class="label label-info">On hold..</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="text-center sorting_1">2</td>
                            <td><strong>AppUser2</strong></td>
                            <td>app.user2@example.com</td>
                            <td><span class="label label-warning">Pending..</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">3</td>
                            <td><strong>AppUser3</strong></td>
                            <td>app.user3@example.com</td>
                            <td><span class="label label-success">Active</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="text-center sorting_1">4</td>
                            <td><strong>AppUser4</strong></td>
                            <td>app.user4@example.com</td>
                            <td><span class="label label-info">On hold..</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">5</td>
                            <td><strong>AppUser5</strong></td>
                            <td>app.user5@example.com</td>
                            <td><span class="label label-danger">Disabled</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="text-center sorting_1">6</td>
                            <td><strong>AppUser6</strong></td>
                            <td>app.user6@example.com</td>
                            <td><span class="label label-danger">Disabled</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">7</td>
                            <td><strong>AppUser7</strong></td>
                            <td>app.user7@example.com</td>
                            <td><span class="label label-danger">Disabled</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="text-center sorting_1">8</td>
                            <td><strong>AppUser8</strong></td>
                            <td>app.user8@example.com</td>
                            <td><span class="label label-success">Active</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">9</td>
                            <td><strong>AppUser9</strong></td>
                            <td>app.user9@example.com</td>
                            <td><span class="label label-warning">Pending..</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="text-center sorting_1">10</td>
                            <td><strong>AppUser10</strong></td>
                            <td>app.user10@example.com</td>
                            <td><span class="label label-warning">Pending..</span></td>
                            <td class="text-center"> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;" data-original-title="Edit User"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;" data-original-title="Delete User"><i class="fa fa-times"></i></a> </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-5 hidden-xs">
                            <div class="dataTables_info" id="example-datatable_info" role="status" aria-live="polite">
                                <strong>1</strong>-
                                <strong>10</strong> of
                                <strong>30</strong>
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-12 clearfix">
                            <div class="dataTables_paginate paging_bootstrap" id="example-datatable_paginate">
                                <ul class="pagination pagination-sm remove-margin">
                                    <li class="prev disabled"><a href="javascript:void(0)"><i class="fa fa-chevron-left"></i> </a></li>
                                    <li class="active"><a href="javascript:void(0)">1</a></li>
                                    <li><a href="javascript:void(0)">2</a></li>
                                    <li><a href="javascript:void(0)">3</a></li>
                                    <li class="next"><a href="javascript:void(0)"> <i class="fa fa-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop