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
All Members
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With All Members</h3>
                </div>
                <div class="box-body">

                    <form method="get" action="{{ route('admin_membership_create') }}">
                        <button type="submit" class="btn btn-primary"> New Membership </button>
                    </form>

                    <br/>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td> ID </td>
                                <td> Contact ID </td>
                                <td> Name </td>
                                <td> Secret Code </td>

                                <td> Membership Type </td>

                                <td> View </td>
                                <td> Edit </td>
                                <td> Delete </td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $members as $member )
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->contact_id }}</td>
                                <td>
                                    @if( $member->contact->contactType->name === "Individual" )
                                    <p> {{ $member->contact->first_name }} {{ $member->contact->middle_name }} {{ $member->contact->last_name }} </p>
                                    @else
                                    <p> {{ $member->contact->organize_name }} </p>
                                    @endif
                                </td>
                                <td> {{ $member->mscode }} </td>
                                <td><b> {{ $member->msType->name }} </b></td>
                                <td>
                                    <!--
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view_membership{{ $member->id }}"> <i class="fa fa-eye">  </i>  </button>

                                    <form method="post" action="#">
                                            @csrf
                                            <div class="modal fade" id="view_membership{{ $member->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        @if( $member->contact->contactType->name === "Individual" )
                                                        <h4 class="modal-title"> Membership Details: Contact ID {{ $member->contact->id }}, {{ $member->contact->first_name }} {{ $member->contact->middle_name }} {{ $member->contact->last_name }}
                                                        </h4>
                                                        @else
                                                        <h4 class="modal-title"> Membership Details: Contact ID {{ $member->contact->id }}, {{ $member->contact->organize_name }} </h4>
                                                        @endif
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="width: 30%; text-align: left;"> Start Date: </td>
                                                                <td> {{ $member->start_date }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 30%; text-align: left;"> End Date: </td>
                                                                <td> {{ $member->end_date }} </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                </div>

                                              </div>
                                            </div>
                                        </form>
                                    -->
                                    <a href="{{ route('admin_membership_show', ["id" => $member->id]) }}" class="btn btn-primary"> <i class="fa fa-eye"> </i> </a>
                                </td>
                                <td><a href="{{ route('admin_membership_edit', ["id" => $member->id]) }}" class="btn btn-primary"> <i class="fa fa-edit"> </i> </a></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_membership{{ $member->id }}"> <i class="fa fa-trash">  </i> </button>

                                    <form method="post" action="{{ route('admin_membership_delete',['id'=> $member->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="delete_membership{{ $member->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure you want to remove this membership ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger"> Remove </button>
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
