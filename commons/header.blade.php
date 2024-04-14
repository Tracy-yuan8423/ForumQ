<header class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-body border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ fs_route(route('fresns.home')) }}"><img src="{{ fs_config('site_logo') }}" height="24"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex me-auto my-3 my-lg-0">
                    @if (fs_config('language_status'))
                        <div class="dropdown me-3 mt-1">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-translate"></i>
                                @foreach(fs_config('language_menus') as $lang)
                                    @if (fs_theme('lang') == $lang['langTag']) {{ $lang['langName'] }} @endif
                                @endforeach
                            </button>
                            <ul class="dropdown-menu">
                                @foreach(fs_config('language_menus') as $lang)
                                    @if ($lang['isEnabled'])
                                        <li>
                                            <a class="dropdown-item @if (fs_theme('lang') == $lang['langTag']) active @endif" hreflang="{{ $lang['langTag'] }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang['langTag'], null, [], true) }}">
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="search" action="{{ fs_route(route('fresns.search.index')) }}" method="get">
                        <div class="input-group">
                            <input type="hidden" name="searchType" value="post"/>
                            <input class="form-control" type="search" name="searchKey" value="{{ request('searchKey') }}" placeholder="{{ fs_lang('search') }}" aria-label="{{ fs_lang('search') }}">
                            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="{{ fs_route(route('fresns.home')) }}"><i class="bi bi-house-door"></i> {{ fs_lang('home') }}</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="{{ fs_route(route('fresns.notification.index')) }}"><i class="bi bi-envelope"></i> {{ fs_config('channel_notifications_name') }}</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="{{ fs_route(route('fresns.hashtag.index')) }}"><i class="bi bi-compass"></i> {{ fs_lang('discover') }}</a>
                    </li>
                    <li class="nav-item ms-3 d-none d-sm-block" style="margin-top:0.6rem;">
                        <div class="vr"></div>
                    </li>

                    {{-- 登录状态 --}}
                    @if (fs_user()->check())
                        <li class="nav-item ms-4 ms-lg-5 mt-2 mt-lg-0 dropdown position-relative">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="nav-avatar rounded-circle @desktop position-absolute top-50 start-0 translate-middle @enddesktop" @desktop style="transform:translate(-100%,-50%)!important" @enddesktop>
                                {{ fs_user('detail.nickname') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end" data-bs-popper="static">
                                <li><a class="dropdown-item" href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => fs_user('detail.uid')])) }}"><i class="bi bi-person"></i> {{ fs_lang('userProfile') }}</a></li>
                                @if (fs_config('wallet_status'))
                                    <li><a class="dropdown-item" href="{{ fs_route(route('fresns.me.wallet')) }}"><i class="bi bi-wallet"></i> {{ fs_config('channel_me_wallet_name') }}</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ fs_route(route('fresns.me.settings')) }}"><i class="bi bi-gear"></i> {{ fs_config('channel_me_settings_name') }}</a></li>
                                <li><a class="dropdown-item" href="{{ fs_route(route('fresns.me.logout')) }}"><i class="bi bi-power"></i> {{ fs_lang('accountLogout') }}</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-4 mt-2 mt-lg-0">
                            <button class="btn btn-primary me-3 px-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-modal-height="700px"
                                data-title="{{ fs_lang('accountLogin') }}"
                                data-url="{{ fs_config('account_login_service') }}"
                                data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                                data-post-message-key="fresnsAccountSign">
                                {{ fs_lang('accountLogin') }}
                            </button>

                            @if (fs_config('account_register_status'))
                                <button class="btn btn-success me-3 px-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                    data-modal-height="700px"
                                    data-title="{{ fs_lang('accountRegister') }}"
                                    data-url="{{ fs_config('account_register_service') }}"
                                    data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                                    data-post-message-key="fresnsAccountSign">
                                    {{ fs_lang('accountRegister') }}
                                </button>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
