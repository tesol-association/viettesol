@extends('layouts.admin.layout')
@section('title','Contact Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('page-header')
All Contact Types
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
      
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With All Contact Types</h3>
                </div>
                <div class="box-body">

                    <form method="get" action="{{ route('admin_contact_type_create') }}">
                        <button type="submit" class="btn btn-primary"> New </button>
                    </form>

                    <br/>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td> ID </td>
                                <td> Name </td>
                                <td> Description </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($contactTypes as $contactType)
                            <tr>
                                <td>{{ $contactType->id }}</td>
                                <td>{{ $contactType->name }}</td>
                                <td>{{ $contactType->description }}</td>
                                <td><a href="{{ route('admin_contact_type_edit', $contactType->id) }}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_contact_type{{ $contactType->id }}">Delete</button>
                                    <form method="post" action="{{ route('admin_contact_type_delete',['id'=> $contactType->id ]) }}">
                                        @csrf
                                        <div class="modal fade" id="delete_contact_type{{ $contactType->id }}" role="dialog">
                                          <div class="modal-dialog">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure you want to delete: {{ $contactType->name }}</h4>
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
                            </tr>
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
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
@endsection