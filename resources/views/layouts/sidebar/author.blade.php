<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Conference: {{ $conference->title }}</li>
    <li><a href="#"><i class="fa fa-newspaper-o"></i> My Paper</a></li>
    <li><a href="#"><i class="fa fa-send"></i> New Submission</a></li>

    <li>
        <a href="{{ route('admin_conference_list') }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->