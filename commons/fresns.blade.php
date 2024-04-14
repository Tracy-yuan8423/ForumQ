<!doctype html>
<html lang="{{ fs_theme('lang') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Fresns" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') - {{ fs_config('site_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ fs_config('site_name') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ fs_config('site_icon') }}">
    <link rel="icon" href="{{ fs_config('site_icon') }}">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/atwho.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/prism.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/fresns.css') }}">
    <script src="/static/js/jquery.min.js"></script>
    @stack('style')
    @if (fs_config('website_stat_position') == 'head')
        {!! fs_config('website_stat_code') !!}
    @endif
</head>

<body>
    {{-- Header --}}
    @include('commons.header')

    {{-- Private mode user status handling --}}
    @if (fs_user()->check() && fs_user('detail.expired'))
        <div class="mt-5 pt-5">
            <div class="alert alert-warning mx-3" role="alert">
                <i class="bi bi-info-circle"></i>
                @if (fs_config('site_private_end_after') == 1)
                    {{ fs_lang('privateContentHide') }}
                @else
                    {{ fs_lang('privateContentShowOld') }}
                @endif

                <button class="btn btn-primary btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ fs_lang('renewal') }}"
                    data-url="{{ fs_config('site_public_service') }}"
                    data-post-message-key="fresnsRenewal">
                    {{ fs_lang('renewal') }}
                </button>
            </div>
        </div>
    @endif

    {{-- Main --}}
    @yield('content')

    {{-- Fresns Extensions Modal --}}
    <div class="modal fade" id="fresnsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fresnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fresnsModalLabel">Fresns Title</h5>
                    <button type="button" class="btn-close btn-done-extensions" id="done-extensions" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:0"></div>
            </div>
        </div>
    </div>

    {{-- Image Zoom Modal --}}
    <div class="modal fade image-zoom" id="imageZoom" tabindex="-1" aria-labelledby="imageZoomLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="mx-auto text-center">
                <img class="img-fluid" loading="lazy">
            </div>
        </div>
    </div>

    {{-- Quick Post Box --}}
    @if (fs_user()->check() && ! Route::is('fresns.editor.*'))
        @component('components.editor.quick-publish-post', [
            'group' => $group ?? null
        ])@endcomponent
    @endif

    {{-- Tip Toasts --}}
    <div class="fresns-tips">
        @include('commons.tips')
    </div>

    {{-- Footer --}}
    @include('commons.footer')

    {{-- Loading --}}
    @if (fs_config('forumq_loading'))
        <div id="loading" class="position-fixed top-50 start-50 translate-middle bg-light bg-opacity-75 rounded p-4" style="z-index:2048;display:none;">
            <div class="ping"></div>
        </div>
    @endif

    {{-- User Auth --}}
    @include('commons.user-auth')

    {{-- No login post tip --}}
    @if (fs_user()->guest())
        <div class="modal fade" id="postTipModal" tabindex="-1" aria-labelledby="postTipModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="postTipModalLabel">{{ fs_config('publish_post_name') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4 pb-5 text-center">
                        <p class="mt-2 mb-4 text-secondary">{{ fs_lang('errorNoLogin') }}</p>

                        <button class="btn btn-outline-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                            data-modal-height="700px"
                            data-title="{{ fs_lang('accountLogin') }}"
                            data-url="{{ fs_config('account_login_service') }}"
                            data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                            data-post-message-key="fresnsAccountSign">
                            {{ fs_lang('accountLogin') }}
                        </button>

                        @if (fs_config('account_register_status'))
                            <button class="btn btn-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-modal-height="700px"
                                data-title="{{ fs_lang('accountRegister') }}"
                                data-url="{{ fs_config('account_register_service') }}"
                                data-redirect-url="{{ fs_theme('login', request()->fullUrl()) }}"
                                data-post-message-key="fresnsAccountSign">
                                {{ fs_lang('accountRegister') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @mobile
        <div class="modal fade" id="groupsModal" tabindex="-1" aria-labelledby="groupsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="groupsModalLabel">{{ fs_config('group_name') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('groups.sidebar')
                    </div>
                </div>
            </div>
        </div>
    @endmobile

    {{-- Stat Code --}}
    @if (fs_config('website_stat_position') == 'body')
        <div style="display:none;">{!! fs_config('website_stat_code') !!}</div>
    @endif
    <script src="/static/js/bootstrap.bundle.min.js"></script>
    <script src="/static/js/js-cookie.min.js"></script>
    <script src="/static/js/fresns-callback.js"></script>
    <script>
        window.ajaxGetList = false;
        window.siteName = "{{ fs_config('site_name') }}";
        window.siteIcon = "{{ fs_config('site_icon') }}";
        window.langTag = "{{ fs_theme('lang') }}";
        window.cookiePrefix = "{{ fs_config('website_cookie_prefix') }}";
        window.userIdentifier = "{{ fs_config('user_identifier') }}";
        window.mentionStatus = {{ fs_config('mention_status') ? 1 : 0 }};
        window.hashtagStatus = {{ fs_config('hashtag_status') ? 1 : 0 }};
        window.hashtagFormat = {{ fs_config('hashtag_format') }};

        $('.dropdown').hover(function() {
            $(this).find('.dropdown-menu').addClass('show')
        }, function() {
            $(this).find('.dropdown-menu').removeClass('show')
        });
    </script>
    <script src="{{ fs_theme('assets', 'js/fresns-extensions.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/jquery.caret.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/atwho.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/prism.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/fresns.js') }}"></script>
    @stack('script')
</body>

</html>
