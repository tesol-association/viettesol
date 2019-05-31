<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">AUTHOR:  Conference: {{ $conference->title }}</li>
    @can('view-paper')
        <li><a href="{{ route('author_paper_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-newspaper-o"></i> My Paper</a></li>
    @endcan
    @can('send-paper')
        <li><a href="{{ route('author_paper_create', ['conference_id' => $conference->id]) }}"><i class="fa fa-send"></i> New Submission</a></li>
    @endcan
    <li>
        <a href="{{ route('conference_home', ['conference_path' => $conference->path]) }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
