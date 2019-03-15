@extends('layouts.admin.layout')
@section('title','Contact Form Management')
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
                        <h3 class="box-title">Contact Form List</h3>
                    </div>
                </div>
                <div class="box-body">
                    <table id="contact_form_manager" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Send Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contactForms as $contactForm)
                            <tr>
                                <td>{{ $contactForm->name }}</td>
                                <td>{{ $contactForm->email }}</td>
                                <td>{{ $contactForm->subject }}</td>
                                <td>{{ $contactForm->message }}</td>
                                <td>{{ $contactForm->created_at }}</td>
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
    <script>
        $(document).ready(function() {
            $('#contact_form_manager').DataTable();
        });
    </script>
@endsection