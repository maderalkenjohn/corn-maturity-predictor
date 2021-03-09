@extends('base')
@section('content')
<div class="container body">
		<div class="main_container">
			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
				<div class="page-title">
					<div class="title_left">
						<h3>Corn Maturity Predictor</h3>
					</div>
				</div>
					
				<div class="clearfix"></div>
				
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="x_panel">
							<div class="x_title">
								<div class="x_content">
									@csrf
									<form class="form-label-left input_mask">
										<div class="form-group row">
											<label class="col-form-label col-md-1 col-sm-1">Select Batch:</label>
											<div class="col-md-1 col-sm-1">
												<select type="text" class="form-control" placeholder="Batch Number" name="batch_number_filter" id="batch_number_filter"></select>
											</div>
											<div style="margin-bottom: 1em"></div>
											<button type="button" id="modal-search" class="btn btn-secondary "><i class="glyphicon glyphicon-search"></i> Go</button>
											<!-- <a href="{{ route('testButton') }}" class="ml-4 text-sm text-gray-700 underline">All Batch Corn Lists</a> -->
										</div>
								
										<div class="form-group row">
											<label class="col-form-label col-md-1 col-sm-1">Date Started:</label>
											<div class="col-md-1 col-sm-1">
												<input type="text" class="form-control" readonly="readonly" placeholder="yyyy-mm-dd" id="batch-date-started">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-1 col-sm-1">Date Ended:</label>
											<div class="col-md-1 col-sm-1">
												<input type="text" class="form-control" readonly="readonly" placeholder="yyyy-mm-dd" id="batch-date-ended">
											</div>
										</div>
									</form>
								</div>
								<button class="btn btn-primary" style="margin:10px; float:left" data-toggle="modal" id="add-batch"><i class="glyphicon glyphicon-plus"></i> Create New Batch</button>
								<button class="btn btn-primary" style="margin:10px; float:left" data-toggle="modal" id="upload-new-image"><i class="glyphicon glyphicon-upload"></i> Upload New Image</button>
								
								<div class="modal fade" role="dialog" aria-hidden="true" tabindex="-1" role="dialog" id="batch-form-modal">
									<div class="modal-dialog" role="document">  
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Create New Batch</h4>
											</div>
											<div class="modal-body">
												@csrf
												<form id="batch-form">
													<div class="form-group">    
														<input type="hidden" class="form-control" name="id" id="id">
														<span class="help-block"></span>
													</div> 
													<div class="form-group">
														<label for="batch_number">Batch No:</label>
														<input type="text" class="form-control" name="batch_number" id="batch_number" placeholder="Input Batch Number">
														<span class="text-danger">
																<strong id="batch-number-error"></strong>
														</span>
													</div>
													<div class="form-group">
														<label for="date_started">Date Started:</label>
														<input type="date" class="form-control" id="date_started" name="date_started" placeholder="yyyy-mm-dd">
														<span class="text-danger">
																<strong id="date-started-error"></strong>
														</span>
													</div>          
													
												</form>
											</div>
											<div class="modal-footer">
												<button type="submit" id="modal-save-batch" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
												<button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
											</div>  
										</div>
									</div>
								</div>
								
								<div class="modal fade" role="dialog" aria-hidden="true" tabindex="-1" role="dialog" id="upload-form-modal">
									<div class="modal-dialog" role="document">  
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Upload New Image</h4>
											</div>
											<div class="modal-body">
												@csrf
												<form method="post" id="upload-form" action="" enctype="multipart/form-date"> 
													<div class="col-md-12 col-sm-12">	
														<label for="file">Choose Image...</label>
														<input class="form-control" type="file" name="file" id="file">
														<span class="text-danger">
																<strong id="file-error"></strong>
														</span>
														<div style="margin-bottom: 1em"></div>
													</div>
													<div class="col-md-4 col-sm-4">	
														<label for="batch_number_upload">Select Batch</label>
														<select type="text" class="form-control" placeholder="Batch Number" name="batch_number_upload" id="batch_number_upload"></select>
														<span class="text-danger">
																<strong id="batch-number-list-upload-error"></strong>
														</span>
													</div>
													<div class="col-md-8 col-sm-8">
														<div class="form-group">
															<label for="day_number">Crop Age in Days</label>
															<input type="text" class="form-control" name="day_number" id="day_number" placeholder="Input Crop Age">
															<span class="text-danger">
																	<strong id="day-number-error"></strong>
															</span>
														</div>
													</div>
												</form>
												<div class="modal-footer">
													<button type="submit" name="submit" id="modal-save-crop" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
													<button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
												</div> 
											</div>
										</div>
									</div>
								
								</div>
							
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									<li><a class="close-link"><i class="fa fa-close"></i></a> </li>
								</ul>
								
								<div class="clearfix"></div>
							</div>
							
							<div class="x_content">
								<div class="row">
									<div class="col-sm-12">
										<div class="card-box table-responsive">
											<table id="crop-batch-table" class="table table-striped table-bordered" style="width:100%"></table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
@endsection
   