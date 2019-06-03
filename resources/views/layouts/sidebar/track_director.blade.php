<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">TRACK DIRECTOR Conference: {{ $conference->title }}</li>
    @can('view-session-type')
        <li><a href="{{ route('track_director_session_type_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-asterisk"></i> Session Type List</a></li>
    @endcan
    @can('view-paper')
        <li><a href="{{ route('track_director_paper_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-newspaper-o"></i> Paper In Track</a></li>
    @endcan
    <li><a href="#"><i class="fa fa-star"></i> Submission active</a></li>
    @can('view-reviewer')
        <li><a href="{{ route('track_director_user_list', ['conference_id'=>$conference->id]) }}"><i class="fa fa-user-circle-o"></i> Reviewer list</a></li>
    @endcan

    <li>
        <a href="{{ route('conference_home', ['conference_path' => $conference->path]) }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
