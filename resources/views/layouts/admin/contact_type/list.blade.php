@extends('layouts.admin.layout')
@section('title','Contact Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
    td{
        text-align: center;
    }
</style>
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
                        <button type="submit" class="btn btn-primary"> New Contact Type </button>
                    </form>

                    <br/>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td> ID </td>
                                <td> Name </td>
                                <td> Description </td>
                                <td> Number of contacts </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $contactTypes as $contactType )
                            <tr>
                                <td>{{ $contactType->id }}</td>
                                <td>{{ $contactType->name }}</td>
                                <td>{{ $contactType->description }}</td>
                                <td>{{ count($contactType->contacts) }}</td>
                                <td>
                                    @if( $contactType->name != "Individual" )
                                    <a href="{{ route('admin_contact_type_edit', $contactType->id) }}" class="btn btn-primary">Edit</a>
                                    @else
                                    <i> disabled </i>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_contact_type{{ $contactType->id }}">Delete</button>
                                    @if ($contactType->name != "Individual")

                                        @if( count($contactType->contacts)==0 )
                                        <form method="post" action="{{ route('admin_contact_delete',['id'=> $contactType->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="delete_contact_type{{ $contactType->id }}" role="dialog">
                                              <div class="modal-dialog">
                                              
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure you want to delete contact type: {{ $contactType->name }} ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </form>
                                        @elseif( count($contactType->contacts)==1 )
                                        <form method="post" action="#">
                                            @csrf
                                            <div class="modal fade" id="delete_contact_type{{ $contactType->id }}" role="dialog">
                                              <div class="modal-dialog">
                                              
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> This Contact Type cannot be removed. </h4>
                                                    <h4 class="modal-title"> There is 1 contact with this type existing. </h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </form>
                                        @else
                                        <form method="post" action="#">
                                            @csrf
                                            <div class="modal fade" id="delete_contact_type{{ $contactType->id }}" role="dialog">
                                              <div class="modal-dialog">
                                              
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> This Contact Type cannot be removed. </h4>
                                                    <h4 class="modal-title"> There are {{ count($contactType->contacts) }} contacts with this type existing. </h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </form>
                                        @endif
                                    @else
                                    <form method="post" action="#">
                                            @csrf
                                            <div class="modal fade" id="delete_contact_type{{ $contactType->id }}" role="dialog">
                                              <div class="modal-dialog">
                                              
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> This Contact Type is fundamental and cannot be deleted. </h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </form>
                                    @endif
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