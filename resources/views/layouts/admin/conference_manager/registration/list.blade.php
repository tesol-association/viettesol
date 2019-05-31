@extends('layouts.admin.conference_layout')
@section('title','Registration Management')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <h3 class="box-title">Register List</h3>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="register_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Full name</th>
                                    <th>organization</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>payment_file</th>
                                    <th>affiliation</th>
                                    <th>Role</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registers as $register)
                                <tr>
                                    <td>{{ $register->id }}</td>
                                    <td>{{ $register->full_name }}</td>
                                    <td>{{ $register->organization }}</td>
                                    <td>{{ $register->email }}</td>
                                    <td>{{ $register->phone }}</td>
                                    <td>
                                        <img src="{{ asset('/storage/'.$register->payment_file_id) }}" alt="" width="60%">
                                    </td>
                                    <td>
                                        {{ $register->affiliation }}
                                    </td>
                                    <td>
                                        {{ $register->role_id }}
                                    </td>
                                    <td>
                                        @can('update-register-conference')
                                            <select class="form-group" onchange="updateStatus(this)">
                                                @foreach($status as $_status)
                                                    <option value="{{ $_status }}" @if($_status== $register->status) {{ 'selected' }} @endif>{{ $_status }}</option>
                                                @endforeach
                                            </select>
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
</section>
@endsection
@section('js')
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script>
  $(function () {
    $('#register_list').DataTable()
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
<script src="{{ asset('js/admin/registration/registration.js') }}"></script>
@endsection
