@extends('layouts.admin.conference_layout')
@section('title','Create Criteria Review')
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create criteria of Review Form {{ $reviewForm->name }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_criteria_review_list', ["conference_id" => $conference->id, 'review_form_id' => $reviewForm->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Criteria Review List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_criteria_review_store', ["conference_id" => $conference->id, 'review_form_id' => $reviewForm->id]) }}" enctype="multipart/form-data">
                @csrf
                <input name="review_form_id" hidden value="{{ $reviewForm->id }}">
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Title" name="name" required value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div id="possible_values" class="form-group {{ $errors->first('possible_values') ? 'has-error' : ''}}">
                        <label>Possible Values*</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="add_item btn btn-info"><i class="fa fa-plus"></i> Add Value</button>
                            </div>
                            <input type="text" class="form-control possible_values" placeholder="" name="possible_values[]" required>
                        </div>
                        <template id="item_possible_value">
                            <div class="item input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="add_item btn btn-info"><i class="fa fa-plus"></i> Add Value</button>
                                </div>
                                <input type="text" class="form-control possible_values" placeholder="" name="possible_values[]" required>
                                <div class="input-group-btn">
                                    <button type="button" class="delete_item btn btn-danger">x</button>
                                </div>
                            </div>
                        </template>
                        @if ($errors->has('possible_values'))
                            <span class="help-block">{{ $errors->first('possible_values') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/js/admin/criteria_review/create.js') }}"></script>
@endsection
