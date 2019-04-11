<!-- Box Comment -->
<div class="box box-widget">
    <!-- /.box-body -->
    <div class="box-footer box-comments">
        @foreach ($histories as $history)
            <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="{{ asset('/storage/' . $history->user->image) }}" alt="User Image">
                <div class="comment-text">
                      <span class="username">
                        {{ $history->user->full_name }}
                        <span class="text-muted pull-right">{{ date('H:i d/m/Y', strtotime($history->created_at)) }}</span>
                      </span><!-- /.username -->
                      {!! $history->message !!}
                </div>
                <!-- /.comment-text -->
            </div>
        @endforeach
    </div>
</div>
<!-- /.box -->
