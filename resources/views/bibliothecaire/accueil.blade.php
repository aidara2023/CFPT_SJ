@extends('layouts.app')
@section('fonction')
Bibliothecaire
@endsection
@section('content')
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Dashboard</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
										href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Dashboard</li>
							</ol>
						</div>
					</div>
					<!-- start widget -->
					<div class="row ">
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Total Students</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">4,586</h3>
											<div class="progress">
												<div class="progress-bar l-bg-purple" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline7"><canvas
													style="display: inline-block; width: 267px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Total book</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">589</h3>
											<div class="progress">
												<div class="progress-bar l-bg-red" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline12"><canvas
													style="display: inline-block; width: 367px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Livre emprunter</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">48</h3>
											<div class="progress">
												<div class="progress-bar l-bg-green" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline9"><canvas
													style="display: inline-block; width: 167px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<div class="col mt-0">
												<h4 class="info-box-title">Visitors</h4>
											</div>
											<h3 class="mt-1 mb-3 info-box-title col-green">2,479</h3>
											<div class="progress">
												<div class="progress-bar l-bg-orange" style="width: 45%"></div>
											</div>
										</div>
										<div class="col-auto">
											<div id="sparkline16" class="text-center"><canvas
													style="display: inline-block; width: 215px; height: 70px; vertical-align: top;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end widget -->
					<!-- chart start -->
					<div class="row">
						<div class="col-12 col-sm-12 col-lg-6">
							<div class="card">
								<div class="card-head">
									<header>Chart</header>
								</div>
								<div class="card-body">
									<div id="chart2"></div>
									<div class="row">
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Target</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$15.3k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Last
												week</p>
											<h5>
												<i class="fa fa-arrow-circle-down col-red ms-1 me-1"></i>$2.8k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted text-truncate">Last
												Month</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$12.5k
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-lg-6">
							<div class="card">
								<div class="card-head">
									<header>Chart</header>
								</div>
								<div class="card-body">
									<div id="schart3"></div>
									<div class="row">
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Target</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$15.3k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted font-15 text-truncate">Last
												week</p>
											<h5>
												<i class="fa fa-arrow-circle-down col-red ms-1 me-1"></i>$2.8k
											</h5>
										</div>
										<div class="col-4">
											<p class="text-muted text-truncate">Last
												Month</p>
											<h5>
												<i class="fa fa-arrow-circle-up col-green ms-1 me-1"></i>$12.5k
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Assign Task</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30" id="support_table">
												<thead>
													<tr>
														<th>#</th>
														<th>Task</th>
														<th>Assigned Professors</th>
														<th>status</th>
														<th>Progress</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Preparation for cricket team</td>
														<td>Kenny Josh</td>
														<td>
															<span class="label label-sm label-success">Done</span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-success progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:100%;"> <span class="sr-only">100%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Annual function preparation</td>
														<td> Mark</td>
														<td>
															<span class="label label-sm label-warning"> Pending </span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-warning progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:70%;"> <span class="sr-only">70%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Final year exam paper set</td>
														<td>Felix </td>
														<td>
															<span class="label label-sm label-danger">Suspended</span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-danger progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:50%;"> <span class="sr-only">50%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Placement report</td>
														<td>Beryl</td>
														<td>
															<span class="label label-sm label-success ">Done</span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-success progress-bar-striped active"
																	role="progressbar" aria-valuenow="100"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:100%;"> <span class="sr-only">100%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>6</td>
														<td>Fees collection report</td>
														<td>Jayesh</td>
														<td>
															<span class="label label-sm label-success ">Done</span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-success progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:100%;"> <span class="sr-only">100%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>7</td>
														<td>Library book status</td>
														<td>Sharma</td>
														<td>
															<span class="label label-sm label-danger">Suspended</span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-danger progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:20%;"> <span class="sr-only">20%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
													<tr>
														<td>8</td>
														<td>Exam Paper set</td>
														<td>John Deo</td>
														<td>
															<span class="label label-sm label-warning"> Pending </span>
														</td>
														<td>
															<div class="progress">
																<div class="progress-bar progress-bar-warning progress-bar-striped active"
																	role="progressbar" aria-valuenow="90"
																	aria-valuemin="0" aria-valuemax="100"
																	style="width:80%;"> <span class="sr-only">80%
																		Complete</span> </div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>Notifications</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body no-padding height-9">
									<div class="row">
										<div class="noti-information notification-menu">
											<div class="notification-list mail-list not-list small-slimscroll-style">
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-primary"> <i class="fa fa-user-o"></i>
													</span> <span class="text-purple">Abhay Jani</span> Added you as
													friend
													<span class="notificationtime">
														<small>Just Now</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon blue-bgcolor"> <i class="fa fa-envelope-o"></i>
													</span> <span class="text-purple">John Doe</span> send you a mail
													<span class="notificationtime">
														<small>Just Now</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-success"> <i class="fa fa-check-square-o"></i>
													</span> Success Message
													<span class="notificationtime">
														<small> 2 Days Ago</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-warning"> <i class="fa fa-warning"></i>
													</span> <strong>Database Overloaded Warning!</strong>
													<span class="notificationtime">
														<small>1 Week Ago</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-primary"> <i class="fa fa-user-o"></i>
													</span> <span class="text-purple">Abhay Jani</span> Added you as
													friend
													<span class="notificationtime">
														<small>Just Now</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon blue-bgcolor"> <i class="fa fa-envelope-o"></i>
													</span> <span class="text-purple">John Doe</span> send you a mail
													<span class="notificationtime">
														<small>Just Now</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-success"> <i class="fa fa-check-square-o"></i>
													</span> Success Message
													<span class="notificationtime">
														<small> 2 Days Ago</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-warning"> <i class="fa fa-warning"></i>
													</span> <strong>Database Overloaded Warning!</strong>
													<span class="notificationtime">
														<small>1 Week Ago</small>
													</span>
												</a>
												<a href="javascript:;" class="single-mail"> <span
														class="icon bg-danger"> <i class="fa fa-times"></i>
													</span> <strong>Server Error!</strong>
													<span class="notificationtime">
														<small>10 Days Ago</small>
													</span>
												</a>
											</div>
											<div class="full-width text-center p-t-10">
												<button type="button"
													class="btn purple btn-outline btn-circle margin-0">View All</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- start new student list -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>New Student List</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30">
												<thead>
													<tr>
														<th>No</th>
														<th>Name</th>
														<th>Assigned Professor</th>
														<th>Date Of Admit</th>
														<th>Fees</th>
														<th>Branch</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Jens Brincker</td>
														<td>Kenny Josh</td>
														<td>27/05/2016</td>
														<td>
															<span class="label label-sm label-success">paid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Mark Hay</td>
														<td> Mark</td>
														<td>26/05/2017</td>
														<td>
															<span class="label label-sm label-warning">unpaid </span>
														</td>
														<td>Science</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Anthony Davie</td>
														<td>Cinnabar</td>
														<td>21/05/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>Commerce</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>4</td>
														<td>David Perry</td>
														<td>Felix </td>
														<td>20/04/2016</td>
														<td>
															<span class="label label-sm label-danger">unpaid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Anthony Davie</td>
														<td>Beryl</td>
														<td>24/05/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>M.B.A.</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>6</td>
														<td>Alan Gilchrist</td>
														<td>Joshep</td>
														<td>22/05/2016</td>
														<td>
															<span class="label label-sm label-warning ">unpaid</span>
														</td>
														<td>Science</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>7</td>
														<td>Mark Hay</td>
														<td>Jayesh</td>
														<td>18/06/2016</td>
														<td>
															<span class="label label-sm label-success ">paid</span>
														</td>
														<td>Commerce</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
													<tr>
														<td>8</td>
														<td>Sue Woodger</td>
														<td>Sharma</td>
														<td>17/05/2016</td>
														<td>
															<span class="label label-sm label-danger">unpaid</span>
														</td>
														<td>Mechanical</td>
														<td>
															<a href="javascript:void(0)" class="tblEditBtn">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="javascript:void(0)" class="tblDelBtn">
																<i class="fa fa-trash-o"></i>
															</a>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end new student list -->
				</div>
			</div>
			<!-- end page content -->
			@endsection