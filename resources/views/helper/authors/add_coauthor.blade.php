<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_author_for_paper_{{ $paper->id }}"><i class="fa fa-plus">{{ $name }}</i></button>
<div class="modal fade" id="add_author_for_paper_{{ $paper->id }}" role="dialog">
    <form method="post" action="{{ route('author_for_paper_add', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="box-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="box-title">Add New Author</h3>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group {{ $errors->first('first_name') ? 'has-error' : ''}}">
                                <label for="first_name">First Name*</label>
                                <input id="first_name" type="text" class="form-control" name="first_name" required placeholder="Enter First Name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('middle_name') ? 'has-error' : ''}}">
                                <label for="middle_name">Middle Name</label>
                                <input id="middle_name" type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name" value="{{ old('middle_name') }}">
                                @if ($errors->has('middle_name'))
                                    <span class="help-block">{{ $errors->first('middle_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('last_name') ? 'has-error' : ''}}">
                                <label for="last_name">Last Name*</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" required placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('email') ? 'has-error' : ''}}">
                                <label for="email">Email*</label>
                                <input id="email" type="email" class="form-control" name="email" required placeholder="Enter Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('affiliation') ? 'has-error' : ''}}">
                                <label for="affiliation">Affiliation*</label>
                                <input id="affiliation" type="text" class="form-control" name="affiliation" required placeholder="Enter Affiliation" value="{{ old('affiliation') }}">
                                @if ($errors->has('affiliation'))
                                    <span class="help-block">{{ $errors->first('affiliation') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('site_url') ? 'has-error' : ''}}">
                                <label for="site_url">Site URL</label>
                                <input id="site_url" type="text" class="form-control" name="site_url" value="{{ old('site_url') }}" placeholder="Enter Site url">
                                @if ($errors->has('site_url'))
                                    <span class="help-block">{{ $errors->first('site_url') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="country form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" data-value="{{ old('country') }}" style="width: 100%" placeholder="Select Country">
                                    @include('helper.country')
                                </select>

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
