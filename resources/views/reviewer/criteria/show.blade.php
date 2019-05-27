@extends('layouts.admin.conference_layout')
@section('title','Create Reviewer Criteria')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Reviewer Criteria</h3>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('reviewer_criteria_store', ['conference_id' => $conference->id]) }}">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('slot') ? 'has-error' : ''}}">
                        <label for="slot">Number of paper wanted</label>
                        @if ($criteria != null)
                            <input id="slot" type="number" class="form-control" placeholder="Enter Title" name="slot" required value="{{ $criteria->slot }}">
                        @else
                            <input id="slot" type="number" class="form-control" placeholder="Enter Title" name="slot" required value="{{ old('slot') }}">
                        @endif
                        @if ($errors->has('slot'))
                            <span class="help-block">{{ $errors->first('slot') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keywords">Keywords:</label>
                        <select id="keywords" name="keywords[]" class="form-control" multiple="multiple" data-placeholder="Fill keywords and Press Enter" style="width: 100%;">
                            @if ($criteria != null)
                                @if (isset($criteria->keywords) && count($criteria->keywords))
                                    @foreach($criteria->keywords as $keyword)
                                        <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/reviewer/criteria/show.js') }}"></script>
@endsection