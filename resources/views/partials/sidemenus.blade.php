<ul class="nav-menu custom-scrollbar">
    <li class="back-btn">
      <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
    </li>
    <li class="sidebar-main-title">
      <div>
        <h6>Menus             </h6>
      </div>
    </li>
    <li><a class="nav-link" href="/staff/dashboard"><i data-feather="home"></i><span>Dashboard</span></a></li>
    @if(auth('staff')->user()->role == 'super_admin')
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Admin Section</span></a>
      <ul class="nav-submenu menu-content">
        <li><a href="/staff/configurations">Configurations</a></li>
        <li><a href="/staff/sections">Sections</a></li>
        <li><a href="/staff/classes">Classes</a></li>
        <li><a href="/staff/arms">Arms</a></li>
        <li><a href="/staff/subjects">Subjects</a></li>
        <li><a href="/staff/grades">Grades</a></li>
        <li><a href="/staff/grade-remarks">Grade Remarks</a></li>
        <li><a href="/staff/remarks">General Remarks</a></li>
        <li><a href="/staff/class-subjects">Class Subjects</a></li>
        <li><a href="/staff/cards">Cards</a></li>
        <li><a href="/staff/announcements">Announcements</a></li>
      </ul>
    </li>
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="credit-card"></i><span>Manage Payments</span></a>
        <ul class="nav-submenu menu-content">
          <li><a href="/staff/payments/invoice-types">Invoice Types</a></li>
          <li><a href="/staff/payments/invoice/confirm">Confirm Payments</a></li>
        </ul>
      </li>
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Manage Applicants</span></a>
        <ul class="nav-submenu menu-content">
          <li><a href="/staff/applicants">View Applicants</a></li>
        </ul>
      </li>
    @endif
    @if (auth('staff')->user()->role == 'super_admin' || auth('staff')->user()->role == 'class_teacher')
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Manage Students</span></a>
      <ul class="nav-submenu menu-content">
        <li><a href="/staff/students/add">Add Student</a></li>
        <li><a href="/staff/students/view">View Students</a></li>
        <li><a href="/staff/students/promote">Promotions</a></li>
      </ul>
    </li>
    @endif
    @if(auth('staff')->user()->role == 'super_admin')
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Manage Staff</span></a>
        <ul class="nav-submenu menu-content">
          <li><a href="/staff/staff/add">Add Staff</a></li>
          <li><a href="/staff/staff/view">View Staff</a></li>
        </ul>
    </li>
    @endif
    @if (auth('staff')->user()->role == 'super_admin' || auth('staff')->user()->role == 'class_teacher')
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="check-circle"></i><span>Attendance</span></a>
        <ul class="nav-submenu menu-content">
          <li><a href="/staff/attendance/mark">Mark Attendance</a></li>
          <li><a href="/staff/attendance/view">View Attendance</a></li>
        </ul>
    </li>
    @endif
    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file"></i><span>Manage Results</span></a>
        <ul class="nav-submenu menu-content">
          <li><a href="/staff/result/upload">Input Result</a></li>
          <li><a href="/staff/result/print">Print Result</a></li>
        </ul>
    </li>
    <li><a class="nav-link" href="/staff/logout"><i data-feather="log-out"></i><span>Logout</span></a></li>
</ul>
