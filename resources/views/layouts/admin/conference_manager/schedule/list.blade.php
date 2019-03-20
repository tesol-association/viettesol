@extends('layouts.admin.conference_layout')
@section('title','Schedule Management')
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
                      <h3 class="box-title">Select Room</h3>
                      <select style="width: 50%;height: 30px; margin-left:20px" id="room">
                        <option>room</option>
                        @foreach($buildings as $building)
                        <option disabled>{{ $building->name }}</option>
                        @foreach($building->rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-md-offset-6">
                      <a href="{{ route('admin_schedule_delete',['conference_id' => $conference->id]) }}" class="btn btn-info">Rearrange</a>
                </div>
            </div>
            <div class="box-body list">
                <div class="table-responsive">
                    <table id="schedule_list" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 600px;">Paper</th>
                                <th>Time block</th>
                            </tr>
                        </thead>
                        <tbody id="body_schedule">
                        </tbody>
                        <input type="hidden" id="conferenceId">
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
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
{{-- <script src="{{ asset('js/admin/schedule/list.js') }}"></script>--}}
<script src="{{ asset('js/admin/schedule/schedule.js') }}"></script>
@endsection