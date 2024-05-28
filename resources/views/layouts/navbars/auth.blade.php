@php
    $user = auth()->user();
@endphp
<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo text-center">
        <a href="#" class="simple-text logo-normal">
            {{ auth()->user()->name }} {{ auth()->user()->role == 'admin' ? '(admin)': '(employee)' }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index') }}">
                    @if ($user->role == 'admin')
                    <i class="nc-icon nc-shop"></i>
                    <p>{{ __('Dashboard') }}</p>
                    @else
                    <p>{{ __('Leave History') }}</p>
                    @endif
                </a>
            </li>
            @if ($user->role == 'employee')
                <li class="{{ $elementActive == 'fileleave' ? 'active' : '' }}">
                    <a href="{{ route('fileleave') }}">
                        {{-- <i class="nc-icon nc-shop"></i> --}}
                        <p>{{ __('File Leave') }}</p>
                    </a>
                </li>
            @endif
            @if ($user->role == 'admin')
                <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                        <i class="nc-icon nc-basket"></i>
                                {{ __('Department') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExamples">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'editDepartment' ? 'active' : '' }}">
                                <a href="{{ route('departments') }}">
                                    <span class="sidebar-mini-icon">{{ __('M') }}</span>
                                    <span class="sidebar-normal">{{ __(' Manage Department ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'leavetype' ? 'active' : '' }}">
                    <a href="{{ route('leavetype') }}">
                        <i class="nc-icon nc-badge"></i>
                        <p>{{ __('Leave Type') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'employees' ? 'active' : '' }}">
                    <a href="{{ route('employee') }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>{{ __('Employees') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'leaves' ? 'active' : '' }}">
                    <a href="{{ route('leaves') }}">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>{{ __('Leave Management') }}</p>
                    </a>
                </li>
                @endif
                <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                    <a href="{{ route('logout', 'tables') }}">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>{{ __('Log out') }}</p>
                    </a>
                </li>
    </div>
</div>




                        {{-- <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <!-- <span class="sidebar-mini-icon">{{ __('U') }}</span> -->
                                <!-- <span class="sidebar-normal">{{ __(' User Management ') }}</span> -->
                            </a>
                        </li> --}}