@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if(session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('Edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('Error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif



				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Products Table</h4>
								</div>
	                        </div>
                            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">@can(' Add Product ')
                                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8">Add Product</a> @endcan
                            </div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Product Name</th>
												<th class="border-bottom-0">Section Name</th>
												<th class="border-bottom-0">Notes</th>
												<th class="border-bottom-0">Operations</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $r=0; ?>
                                            @foreach ($inovices as $inovice)
                                            <?php $r++; ?>

                                            <tr>
                                                <td>{{$r}}</td>
                                                <td>{{ $inovice->Invoice_Name }}</td>
                                                <td>{{ $inovice->section->Section_name}}</td>
                                                <td>{{ $inovice->Description }}</td>
                                                <td>
                                                    @can(' Modify Product')
                                                    <button class="modal-effect btn btn-sm btn-info"
                                                    data-name="{{ $inovice->Invoice_Name }}"
                                                    data-pro_id="{{ $inovice->id }}"
                                                    data-section_name="{{ $inovice->section->Section_name }}"
                                                    data-description="{{ $inovice->Description }}" data-toggle="modal"
                                                    data-target="#edit_Product"><i class="las la-pen"></i></button> @endcan

                                                    @can(' Delete Product')
                                                <button class="modal-effect btn btn-sm btn-danger" data-pro_id="{{ $inovice->id }}"
                                                    data-product_name="{{ $inovice->Invoice_Name }}" data-toggle="modal"
                                                    data-target="#modaldemo9"><i class="las la-trash"></i></a></button>
                                                    @endcan
                                            </td>
                                            </tr>
                                            @endforeach
									</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
                                        <!-- delete -->

                                        <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Product </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="invoice/destroy" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>Are You Sure?</p><br>
                                                        <input type="hidden" name="pro_id" id="pro_id" value="">
                                                        <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cansel</button>
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                        <!-- add -->
                <div class="modal" id="modaldemo8">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Add Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                        <form action="{{route('invoice.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input class="form-control form-control-lg" placeholder=" Product Name " type="text" name="Invoice_Name" required>
                                            </div>
                                            <div class="mb-4">
                                                <p class="mg-b-10">Section :</p>
                                                <select  onchange="console.log($(this).children(':selected').length)" class="selectsum1" name="Section_id" id="section_id" required>
                                                @foreach ($sections as $section)
                                                    <option value={{ $section->id }}>{{ $section->Section_name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <textarea  class="form-control" placeholder="Notes" name="Description" rows="3"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info-gradient btn-block">Confirm</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-danger-gradient btn-block">Cancel</button>
                                            </div>
                                            </form>
                                        </div>
                    </div>
                </div>


                <!-- row closed -->
			</div>
                                <!-- edit -->
        <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action='invoice/update' method="post">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title"> Product Name :</label>
                            <input type="hidden" class="form-control" name="pro_id" id="pro_id" value="">
                            <input type="text" class="form-control" name="Invoice_Name" id="Product_name">
                        </div>

                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Section</label>
                        <select name="Section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                            @foreach ($sections as $section)
                                <option>{{ $section->Section_name }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="des">Notea :</label>
                            <textarea name="Description" cols="20" rows="5" id='description'
                                class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>

<script>
    $('#edit_Product').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var Product_name = button.data('name')
        var section_name = button.data('section_name')
        var pro_id = button.data('pro_id')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #Product_name').val(Product_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #pro_id').val(pro_id);
    })

    $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })


</script>

@endsection
