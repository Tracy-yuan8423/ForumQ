<nav class="navbar navbar-expand-lg navbar-light py-lg-0 mb-4 mx-3 mx-lg-0" style="background-color: #e3f2fd;">
    <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_lang('discover') }}</span>
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-signpost-2"></i>
    </button>
    <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
        {{-- 话题主页 --}}
        @if (fs_db_config('menu_hashtag_status'))
            <a href="{{ fs_route(route('fresns.hashtag.index')) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.hashtag.*') ? 'active' : '' }}">
                <img class="img-fluid" src="/assets/themes/ForumQ/images/menu-hashtag-list.png" loading="lazy" width="36" height="36">
                {{ fs_db_config('menu_hashtag_name') }}
            </a>
        @endif

        {{-- 用户主页 --}}
        @if (fs_db_config('menu_user_status'))
            <a href="{{ fs_route(route('fresns.user.index')) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.user.*') ? 'active' : '' }}">
                <img class="img-fluid" src="/assets/themes/ForumQ/images/menu-user-home.png" loading="lazy" width="36" height="36">
                {{ fs_db_config('menu_user_name') }}
            </a>
        @endif

        {{-- 帖子列表 --}}
        @if (fs_db_config('menu_post_list_status'))
            <a href="{{ fs_route(route('fresns.post.list')) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.*') ? 'active' : '' }}">
                <img class="img-fluid" src="/assets/themes/ForumQ/images/menu-post-list.png" loading="lazy" width="36" height="36">
                {{ fs_db_config('menu_post_list_name') }}
            </a>
        @endif
    </div>
</nav>
