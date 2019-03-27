<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Conference: {{ $conference->title }}</li>
    <li><a href="#"><i class="fa fa-asterisk"></i> Session Type List</a></li>
    <li><a href="#"><i class="fa fa-newspaper-o"></i> Paper In Track</a></li>
    <li><a href="#"><i class="fa fa-star"></i> Submission active</a></li>
    <li><a href="#"><i class="fa fa-user-circle-o"></i> Reviewer list</a></li>

    <li>
        <a href="{{ route('admin_conference_list') }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
