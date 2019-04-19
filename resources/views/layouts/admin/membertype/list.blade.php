@extends('layouts.admin.layout')
@section('title','Membership Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<style type="text/css">
    td{
        text-align: center;
    }
</style>
@endsection

@section('page-header')
All Membership Type
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With All Membership Types</h3>
                </div>
                <div class="box-body">

                    <form method="get" action="{{ route('admin_membertype_create') }}">
                        <button type="submit" class="btn btn-primary"> New Membership Type </button>
                    </form>

                    <br/>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td> ID </td>
                                <td> Name </td>
                                <td> Description </td>
                                <td> Edit </td>
                                <td> Delete </td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $memberTypes as $type )
                            <tr>
                                <td> {{ $type->id }} </td>
                                <td> {{ $type->name }} </td>
                                <td> {{ $type->description }} </td>
                                <td>
                                    @if ( ( $type->name != "Premium" ) && ( $type->name != "Normal" ) )
                                    <a class="btn btn-primary" href="{{ route('admin_membertype_edit', ["id" => $type->id]) }}"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                </td>
                                <td>
                                    @if ( ( $type->name != "Premium" ) && ( $type->name != "Normal" ) )
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_membertype{{ $type->id }}"> <i class="fa fa-trash">  </i> </button>
                                    @endif

                                    <form method="post" action="{{ route('admin_membertype_delete',['id'=> $type->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="delete_membertype{{ $type->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure you want to delete Membership Type: {{ $type->name }} ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                        </form>
                                </td>
                            @endforeach
                        </tbody>

                    </table>

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
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            responsive: true,
        });
    })
</script>
@endsection
