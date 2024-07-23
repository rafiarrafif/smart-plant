<div class="bg-nav"></div>
<div class="navbar">
    <a href="{{ route('home') }}" class="navbar-a">
        <i data-feather="home"
            style="stroke: {{ Request::is('/') || (Request::is('plant/*') && !Request::is('plant/*/edit')) ? '#b0a1fe' : '#848384' }}; width: 22px"></i>
        <span
            class="{{ Request::is('/') || (Request::is('plant/*') && !Request::is('plant/*/edit')) ? 'active' : '' }}">Home</span>
    </a>
    <a href="{{ route('log') }}" class="navbar-a">
        <i data-feather="file-text" style="stroke: {{ Request::is('log*') ? '#b0a1fe' : '#848384' }}; width: 22px"></i>
        <span class="{{ Request::is('log*') ? 'active' : '' }}">Logs</span>
    </a>
    <a href="{{ route('settings.index') }}" class="navbar-a">
        <i data-feather="settings"
            style="stroke: {{ Request::is('plant/*/edit') || Request::is('settings*') ? '#b0a1fe' : '#848384' }}; width: 22px"></i>
        <span class="{{ Request::is('plant/*/edit') || Request::is('settings*') ? 'active' : '' }}">Settings</span>
    </a>
</div>
