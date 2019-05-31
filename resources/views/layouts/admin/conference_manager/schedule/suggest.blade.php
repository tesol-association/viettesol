@extends('layouts.admin.conference_layout')
@section('title','Suggest Schedule')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="{{ route('admin_schedule_store_suggest',['conference_id' => $conference->id]) }}" method="post">
        @csrf
         <div class="box">
            <div class="box-header with-border">
              <div class="col-md-4">
              </div>
              <div class="col-md-2 col-md-offset-6">
                <button type="submit" class="btn btn-danger">Save</button>
                @can('delete-schedule')
                    <a href="{{ route('admin_schedule_delete',['conference_id' => $conference->id]) }}" class="btn btn-info">Rearrange</a>
                @endcan
            </div>
        </div>
        <div class="box-body list">
          <div class="table-responsive">
            <table id="schedule_list" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th style="width: 600px;">Paper</th>
                  <th>Session type</th>
                  <th>Room</th>
                  <th>Time block</th>
              </tr>
          </thead>
          <tbody id="body_schedule">
            @foreach($papers as $key => $paper)
            <tr>
              <td><input type="hidden" value="{{ $paper['id'] }}" name="paper_id[]">{{ $paper['id'] }}</td>
              <td>{{ $paper['title'] }}</td>
              <td>{{ $paper['duration'] . ' min'}}</td>
              <td>
                <select style='width: 115%;height: 40px; margin-left:-7px' name="room_id[]">
                    @foreach($buildings as $building)
                    @foreach($building->rooms as $room)
                    <option value="{{ $room->id }}" @if($room->id == $paper['room_id']) {{ 'selected' }} @endif>{{ $room->name }}</option>
                    @endforeach
                    @endforeach
                </select>
            </td>
            <td>
                <select style='width: 100%;height: 40px; margin-left:-7px' name="timeblock_id[]">
                    @foreach($timeBlocks as $timeBlock)
                    <option value="{{ $timeBlock['id'] }}" @if( $timeBlock['id'] == $paper['timeblock_id']) {{ 'selected' }} @endif>{{ $timeBlock['date'] }}---{{ $timeBlock['start_time'] }}-{{ $timeBlock['end_time'] }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        @endforeach
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
</form>
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
{{-- <script src="{{ asset('js/admin/schedule/schedule.js') }}"></script> --}}
@endsection
