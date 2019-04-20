@extends('layouts.admin.conference_layout')
@section('title','Fee Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <h3 class="box-title">Fee List</h3>
                    </div>
                    <div class="col-md-2 col-md-offset-6">
                        <a href="{{ route('admin_fee_create',['conference_id' => $conference->id] )}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Fee </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="fee_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Time</th>
                                    <th>Price Before Time</th>
                                    <th>Price After Time</th>
                                    <th>Descrition</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                <tr>
                                    <td>{{ $fee->id }}</td>
                                    <td>{{ $fee->category }}</td>
                                    <td>{{ $fee->time }}</td>
                                    <td>{{ $fee->price_before_time }}</td>
                                    <td>{{ $fee->price_after_time }}</td>
                                    <td>{{ $fee->description }}</td>
                                    <td>
                                        <a href="{{ route('admin_fee_edit',['conference_id' => $conference->id, 'id'=>$fee->id] )}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('admin_fee_delete',['conference_id' => $conference->id, 'id'=> $fee->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="delete_fee_{{ $fee->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure delete fee {{ $fee->category }} ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_fee_{{ $fee->id }}"><i class="fa fa-trash"></i></button>
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
</section>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('js/admin/fee/list.js') }}" ></script>
@endsection
