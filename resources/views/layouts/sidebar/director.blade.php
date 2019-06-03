<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">DIRECTOR Conference: {{ $conference->title }}</li>
    @can('view-track')
        <li><a href="{{ route('director_track_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-code-fork"></i> Track List</a></li>
    @endcan
    @can('view-session-type')
        <li><a href="{{ route('director_session_type_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-asterisk"></i> Session Type List</a></li>
    @endcan
    @can('view-paper')
        <li><a href="{{ route('admin_paper_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-newspaper-o"></i> Paper List</a></li>
    @endcan
    @can('view-paper-un-schedule')
        <li><a href="{{ route('director_paper_un_schedule_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-newspaper-o"></i> Paper Unschedule List</a></li>
    @endcan
    <li><a href="#"><i class="fa fa-star"></i> Submission active</a></li>
    @can('view-reviewer')
        <li><a href="{{ route('director_user_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-user-circle-o"></i> Reviewer list</a></li>
    @endcan
    <li>
        <a href="{{ route('conference_home', ['conference_path' => $conference->path]) }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
