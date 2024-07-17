<div class="sticky-lg-top" style="background: #f5f7f8;padding-top: 4.8rem;">
    <div class="bg-white rounded-top">
        <div class="d-lg-flex mx-4 border-bottom">
            <div class="flex-grow-1 pt-3">
                <ul class="nav fs-filter">
                    <li class="nav-item">
                        <a class="nav-link px-0 pt-2 pb-1 me-4 @if (count(request()->all()) == 0 || request()->only(['page', 'pageSize'])) border-bottom border-primary border-3 text-primary @endif" href="{{ request()->url() }}">{{ fs_lang('contentAllList') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-0 pt-2 pb-1 me-4 @if (request('digestState')) border-bottom border-primary border-3 text-primary @endif" href="{{ request()->url().'?'.http_build_query(['digestState' => 3]) }}">{{ fs_lang('contentRecommend') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-0 pt-2 pb-1 me-4 @if (request('allDigest')) border-bottom border-primary border-3 text-primary @endif" href="{{ request()->url().'?'.http_build_query(['allDigest' => 1]) }}">{{ fs_lang('contentDigest') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-0 pt-2 pb-1 me-4 @if (request('following')) border-bottom border-primary border-3 text-primary @endif" href="{{ request()->url().'?'.http_build_query(['following' => 1]) }}">{{ fs_lang('userFollowing') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        @foreach (fs_content_types('post') as $type)
                            @if (empty(request('contentType')) && $type['fskey'] == 'All')
                                <a class="nav-link px-0 pt-2 pb-1 me-4 dropdown-toggle @if (request('contentType')) border-bottom border-primary border-3 text-primary @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $type['name'] }}</a>
                            @endif

                            @if (request('contentType') == $type['fskey'])
                                <a class="nav-link px-0 pt-2 pb-1 me-4 dropdown-toggle border-bottom border-primary border-3 text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $type['name'] }}</a>
                            @endif
                        @endforeach
                        <ul class="dropdown-menu">
                            @foreach (fs_content_types('post') as $type)
                                <li><a class="dropdown-item" href="{{ request()->url().'?'.http_build_query(['contentType' => $type['fskey']]) }}">{{ $type['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-0 pt-2 pb-1 me-4 dropdown-toggle @if (request('orderType')) border-bottom border-primary border-3 text-primary @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ fs_lang('sortOrder') }}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ request()->url().'?'.http_build_query(['orderType' => 'createdTime']) }}">{{ fs_lang('contentNewList') }}</a></li>
                            <li><a class="dropdown-item" href="{{ request()->url().'?'.http_build_query(['orderType' => 'comment']) }}">{{ fs_lang('contentActive') }}</a></li>
                            <li><a class="dropdown-item" href="{{ request()->url().'?'.http_build_query(['orderType' => 'like']) }}">{{ fs_lang('contentHotList') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-between align-items-start py-3">
                @mobile
                    <button type="button" class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#groupsModal" style="background-color: var(--bs-orange);border: var(--bs-btn-border-width) solid var(--bs-orange);">{{ fs_config('group_name') }}</button>
                @endmobile

                @if (fs_user()->check())
                    @if (fs_config('forumq_quick_publish'))
                        <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#createModal">{{ fs_config('publish_post_name') }}</button>
                    @else
                        <a class="btn btn-primary px-4" href="{{ route('fresns.editor.post') }}">{{ fs_config('publish_post_name') }}</a>
                    @endif
                @else
                    <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal" data-bs-target="#postTipModal">{{ fs_config('publish_post_name') }}</button>
                @endif
            </div>
        </div>
    </div>
</div>
