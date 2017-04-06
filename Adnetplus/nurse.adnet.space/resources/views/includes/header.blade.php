<div id="top-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <h2 class="bold top-header">@yield('title')</h2>
            </div>
            <div class="col-sm-3 text-center">
                <h5>@lang('messages.app.username', ['name' => session('user.name')])</h5>
                <a href="{{ url('/logout') }}">@lang('messages.app.logout')</a>
            </div>
        </div>
    </div>
</div>