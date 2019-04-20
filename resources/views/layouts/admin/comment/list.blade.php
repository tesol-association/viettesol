@extends('layouts.admin.layout')
@section('title','Comment Management')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('page-header')
List comment
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Body</th>
                  <th>Create by</th>
                  <th>News</th>
                  <th>Select all
                     <input type="checkbox" id="all" onclick="getAll()">
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($comments as $comment)
                <tr>
                	<td>{{ $comment->id }}</td>
                	<td>{{ $comment->body }}</td>
                	<td>{{ $comment->createdBy->user_name }}</td>
                	<td>{{ $comment->news->title }}</td>
                	<td>
                    <div class="form-group">
		                {{-- <select class="form-control select2 select2-hidden-accessible" id="status_{{ $comment->id }}" style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="updateStatus(this)">
		                @foreach($status as $_status)
		                  <option value="{{ $_status }}" @if($_status == $comment->status) {{ 'selected' }} @endif>{{ $_status }}</option>
		                @endforeach
                  </select> --}}
                  <input type="checkbox" id="status_{{ $comment->id }}" name="status[]" value="{{ $comment->status }}" @if($comment->status=='approved') {{ 'checked' }} @endif onchange="updateStatus(this)"><br>
                </div>
              </td>
            </tr>
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
<script src="{{ asset('js/admin/comment/comment.js') }}"></script>
@endsection
