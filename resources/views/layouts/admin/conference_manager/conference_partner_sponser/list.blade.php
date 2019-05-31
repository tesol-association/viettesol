@extends('layouts.admin.conference_layout')
@section('title','Conference Partners Sponsers Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Conference Partners Sponsers List</h3>
                        </div>
                        @can('create-conference-partner-sponser')
                            <div class="col-md-3 col-md-offset-5">
                                <a href="{{ route('admin_conference_partners_sponsers_create', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Conference Partners Sponsers</a>
                            </div>
                        @endcan
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="conference_partners_sponsers_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($conferencePartnersSponsers as $conferencePartnersSponser)
                                    <tr>
                                        <td>{{ $conferencePartnersSponser->id }}</td>
                                        <td>{{ $conferencePartnersSponser->name }}</td>
                                        <td>
                                            <img class="img-circle" src="{{ asset('/storage/' . $conferencePartnersSponser->logo) }}" alt="Logo" height="100" width="100">
                                        </td>
                                        <td>{{ $conferencePartnersSponser->type }}</td>
                                        <td>{{ $conferencePartnersSponser->description }}</td>
                                        <td>
                                            @can('update-conference-partner-sponser')
                                                <a href="{{ route('admin_conference_partners_sponsers_edit', ['conference_id' => $conference->id, 'id' => $conferencePartnersSponser->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete-conference-partner-sponser')
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_conference_partners_sponsers_{{ $conferencePartnersSponser->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal ConferencePartnersSponsers -->
                                    <div class="modal fade" id="delete_conference_partners_sponsers_{{ $conferencePartnersSponser->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_conference_partners_sponsers_delete', ['conference_id' => $conference->id, 'id'=> $conferencePartnersSponser->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $conferencePartnersSponser->name }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    <!-- End:: Delete Modal ConferencePartnersSponsers -->
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/conference_partner_sponser/list.js') }}"></script>
@endsection
