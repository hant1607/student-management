<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Admin</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(isset($user_infor))
                    <li><a href="{{route('users.profile', $user_infor->id)}}"><i
                                    class="fa fa-user fa-fw"></i> {{$user_infor->username}}
                            <i>{{$user_infor->getRoleNames()}}</i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> {{__('Settings')}}</a>
                    </li>
                    <li class="divider"></li>
                    <li>{!! Form::open(['method'=>'POST', 'route'=>'logout']) !!}
                        <i class="fa fa-sign-out fa-fw" style="margin-left: 20px"></i>
{{--                        {!! Form::submit('Logout', ['style'=> 'display: inline;border: none;background: none']) !!}--}}
                        <input style="display: inline;border: none;background: none" type="submit" value="{{__('Logout')}}">
                        {!! Form::close() !!}
                    </li>
                @else
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>{{__('You are not logged in')}}</a>
                    </li>
                    <li><a href="{{route('login')}}"><i class="fa fa-sign-in fa-fw"></i> {{__('Login')}}</a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                </li>
                <li>
                    <a href="#"><i class="fa fa-dashboard fa-fw"></i> {{__('Dashboard')}}</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{__('Faculties')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('faculty.index')}}">{{__('List Faculties')}}</a>
                        </li>
                        <li>
                            <a href="{{route('faculty.create')}}">{{__('Add Faculty')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> {{__('Classes')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('class.index')}}">{{__('List Classes')}}</a>
                        </li>
                        <li>
                            <a href="{{route('class.create')}}">{{__('Add Class')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> {{__('Students')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('students.index')}}">{{__('List Students')}}</a>
                        </li>
                        <li>
                            <a href="{{route('students.create')}}">{{__('Add Student')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> {{__('Subjects')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('subjects.index')}}">{{__('List Subjects')}}</a>
                        </li>
                        <li>
                            <a href="{{route('subjects.create')}}">{{__('Add Subject')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> {{__('Results')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('results.index')}}">{{__('List Results')}}</a>
                        </li>
                        <li>
                            <a href="{{route('results.create')}}">{{__('Add Result')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> {{__('User')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('users.index')}}">{{__('List Users')}}</a>
                        </li>
                        <li>
                            <a href="{{route('users.create')}}">{{__('Add User')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> {{__('Role')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('roles.index')}}">{{__('List Role')}}</a>
                        </li>
                        <li>
                            <a href="{{route('roles.create')}}">{{__('Add Role')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="far fa-comment"></i> {{__('Chat')}}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('chat')}}">{{__('Chat Room')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="float: right; margin-right: 4%">
    <a href="{!! route('change-lang', ['en']) !!}">English</a>
    <a href="{!! route('change-lang', ['vi']) !!}">Vietnam</a>
</div>