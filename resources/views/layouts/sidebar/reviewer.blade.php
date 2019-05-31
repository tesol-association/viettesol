<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header"> REVIEWER: Conference: {{ $conference->title }}</li>
    @can('view-paper')
        <li><a href="{{ route('reviewer_paper_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-newspaper-o"></i> Paper List</a></li>
    @endcan
    <li><a href="#"><i class="fa fa-star"></i> Submission Active</a></li>
    @can('view-reviewer-criterial')
        <li><a href="{{ route('reviewer_criteria_show', ['conference_id' => $conference->id]) }}"><i class="fa fa-link"></i> Reviewer Criteria</a></li>
    @endcan
    <li>
        <a href="{{ route('conference_home', ['conference_path' => $conference->path]) }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
