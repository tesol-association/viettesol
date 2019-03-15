@extends('layouts.admin.layout')
@section('title','Advertisement Management')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('page-header')
List advertisement
@endsection
@section('content')
<section class="content">
      <div class="row">
        <div class="col-xs-12">
      
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h3 class="box-title"></h3>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="{{ route('admin_advertisement_create') }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i>Create advertisement</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($advertisements as $advertisement)
                <tr>
                	<td>{{ $advertisement->id }}</td>
                	<td>{{ $advertisement->name }}</td>
                	<td>
                     <img src="{{ $advertisement->image }}" alt="" width="200px" height="160px">
                  </td>
                  <td>
                    <form method="post" action="{{ route('admin_advertisement_delete',['id'=> $advertisement->id ]) }}">
                        @csrf
                        <div class="modal fade" id="myModal_{{ $advertisement->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure delete: {{ $advertisement->name }}</h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                    </form>
                    <!-- </div> -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal_{{ $advertisement->id }}">Delete</button>
                  </td>
                  <td>
                    <a href="{{ route('admin_advertisement_edit',['id'=> $advertisement->id ]) }}" class="btn btn-info">Edit</a>
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
@endsection