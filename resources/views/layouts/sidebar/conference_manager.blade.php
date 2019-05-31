<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">ADMIN Conference: {{ $conference->title }}</li>
    <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i> <span>Set Up Conference</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view-conference-timeline')
                <li><a href="{{ route('admin_timeline_view', ["conference_id" => $conference->id]) }}"><i class="fa fa-clock-o"></i> Conference Timeline</a></li>
            @endcan
            @can('view-announcement')
                <li><a href="{{ route('admin_announcements_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-newspaper-o"></i> Announcement</a></li>
            @endcan
            @can('view-review-form')
                <li><a href="{{ route('admin_review_form_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-link"></i> Review Form</a></li>
            @endcan
            @can('view-track')
                <li><a href="{{ route('admin_track_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-code-fork"></i> Track</a></li>
            @endcan
            @can('view-session-type')
                <li><a href="{{ route('admin_session_type_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-asterisk"></i> Session Types</a></li>
            @endcan
            @can('view-speaker')
                <li><a href="{{ route('admin_speakers_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-users"></i> Keynote Speakers</a></li>
            @endcan
            @can('view-conference-partner-sponser')
                <li><a href="{{ route('admin_conference_partners_sponsers_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-star"></i>Partner Sponser</a></li>
            @endcan
            @can('view-fee')
                <li><a href="{{ route('admin_fee_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-money"></i> Fee</a></li>
            @endcan
            @can('view-prepair-email')
                <li><a href="#"><i class="fa fa-envelope-o"></i> Prepaired email</a></li>
            @endcan
        </ul>
    </li>

    <li class="treeview">
        <a href="#"><i class="fa fa-hacker-news"></i> <span>Paper Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view-paper')
                <li><a href="{{ route('admin_paper_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-newspaper-o"></i> List Paper</a></li>
            @endcan
            @can('view-paper-author')
                <li><a href="{{ route('admin_author_paper_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-user"></i> Paper author</a></li>
            @endcan
            @can('view-paper-file')
                <li><a href="{{ route('admin_paper_file_managerment_view', ['conference_id' => $conference->id]) }}"><i class="fa fa-file-text-o"></i>Paper File</a></li>
            @endcan
        </ul>
    </li>

    <li class="treeview">
        <a href="#"><i class="fa fa-calendar-o"></i> <span>Schedule Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view-schedule')
                <li><a href="{{ route('admin_schedule_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-calendar"></i> Schedule</a></li>
            @endcan
            @can('view-time-block')
                <li><a href="{{ route('admin_time_block_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-clock-o"></i> Time Block</a></li>
            @endcan
            @can('view-building')
                <li><a href="{{ route('admin_buildings_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-building"></i> Building & Room</a></li>
            @endcan
            @can('view-special-event')
                <li><a href="{{ route('admin_special_event_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-star-half-full"></i>  Special Event</a></li>
            @endcan
        </ul>
    </li>

    <li class="treeview">
        <a href="#"><i class="fa fa-calendar-o"></i> <span>Calendar</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view-calendar-for-paper')
                <li><a href="{{ route('admin_calendar_list', ["conference_id" => $conference->id]) }}"><i class="fa fa-calendar"></i> Calendar for paper</a></li>
            @endcan
            @can('view-calendar-for-conference')
                <li><a href="{{ route('admin_calendar_calendarConference', ["conference_id" => $conference->id]) }}"><i class="fa fa-calendar"></i> Calendar for conference</a></li>
            @endcan
        </ul>
    </li>

    <li class="treeview">
        <a href="#"><i class="fa fa-lock"></i> <span>Conference Role</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('view-user-conference-role')
                <li><a href="{{ route('admin_user_conference_roles_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-user-circle"></i> User Conference Roles</a></li>
            @endcan
            @can('view-conference-role')
                <li><a href="{{ route('admin_conference_roles_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-unlock-alt"></i>List Conference Roles</a></li>
            @endcan
            @can('view-set-up-conference-permission')
                <li><a href="{{ route('conference_acl_access_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-unlock-alt"></i>Set Up Permission</a></li>
            @endcan
            @can('view-conference-permission')
                <li><a href="{{ route('conference_acl_permission_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-unlock-alt"></i>Permission List</a></li>
            @endcan
        </ul>
    </li>
    @can('view-register-conference')
        <li><a href="{{ route('admin_registration_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-bookmark-o"></i>List Register</a></li>
    @endcan
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>{{ $conference->title }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#">Registration</a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Payment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            @can('view-conference-gallery')
                <li><a href="{{ route('admin_conference_gallery_list', ['conference_id' => $conference->id]) }}"><i class="fa fa-link"></i> Conference Gallery</a></li>
            @endcan
        </ul>
    </li>

    <li>
        <a href="{{ route('conference_home', ['conference_path' => $conference->path]) }}"><i class="fa fa-arrow-left"></i> <span>Back to MainMenu</span>
        </a>
    </li>

</ul>
<!-- /.sidebar-menu -->
