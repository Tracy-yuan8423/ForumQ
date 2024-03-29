@extends('commons.fresns')

@section('title', $items['title'] ?? $group['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $group['description'])

@section('content')
    <main class="container-fluid">
        <div class="row">
            {{-- 左侧边栏 --}}
            @desktop
                <div class="col-sm-3">
                    @include('groups.sidebar')
                </div>
            @enddesktop

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 筛选 --}}
                @include('components.post.filter')

                {{-- 置顶帖子列表 --}}
                @if (fs_sticky_posts() || fs_sticky_posts($group['gid']))
                    <div class="bg-white rounded-bottom mb-3">
                        <ul class="list-unstyled mx-4 pt-3">
                            @foreach(fs_sticky_posts() as $sticky)
                                @component('components.post.sticky', compact('sticky'))@endcomponent
                            @endforeach

                            @foreach(fs_sticky_posts($group['gid']) as $groupSticky)
                                @component('components.post.sticky', compact('groupSticky'))@endcomponent
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 小组扩展 --}}
                <div class="clearfix">
                    @foreach($items['extensions'] as $extension)
                        <div class="float-start mb-3" style="width:20%">
                            <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                                data-title="{{ $extension['name'] }}"
                                data-url="{{ $extension['appUrl'] }}"
                                data-post-message-key="fresnsGroupExtension">
                                <div class="position-relative mx-auto" style="width:52px">
                                    <img src="{{ $extension['icon'] }}" loading="lazy" class="rounded" height="52">
                                    @if ($extension['badgeType'])
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                            {{ $extension['badgeType'] == 1 ? '' : $extension['badgeValue'] }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $extension['name'] }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- 帖子列表 --}}
                <div class="clearfix">
                    {{-- 是否有权浏览 --}}
                    @if ($group['canViewContent'])
                        {{-- 列表 --}}
                        @switch($type)
                            {{-- 帖子列表 --}}
                            @case('posts')
                                <div class="clearfix" id="fresns-list-container">
                                    @foreach($posts as $post)
                                        @component('components.post.list', compact('post'))@endcomponent

                                        @if (! $loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- 列表页码 --}}
                                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                                    {{ $posts->links() }}
                                </div>
                            @break

                            {{-- 评论列表 --}}
                            @case('comments')
                                <div class="clearfix" id="fresns-list-container">
                                    @foreach($comments as $comment)
                                        @component('components.comment.list', [
                                            'comment' => $comment,
                                            'detailLink' => true,
                                            'sectionAuthorLiked' => false,
                                        ])@endcomponent

                                        @if (! $loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- 列表页码 --}}
                                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                                    {{ $comments->links() }}
                                </div>
                            @break

                            @default
                                <div class="text-center my-5 text-muted fs-7">{{ fs_lang('listEmpty') }}</div>
                        @endswitch
                    @else
                        <div class="text-center py-5 text-danger">
                            <i class="bi bi-info-circle"></i> {{ fs_lang('contentGroupTip') }}
                        </div>
                    @endif
                </div>

                {{-- Ajax Footer --}}
                @include('commons.ajax-footer')

                <!-- next page -->
                <div class="clearfix my-4">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        @if ($posts->nextPageUrl())
                            <a class="btn btn-outline-secondary" href="{{ $posts->nextPageUrl() }}" role="button">{{ fs_lang('nextPage') }}</a>
                        @else
                            <p class="text-secondary text-center"><i class="bi bi-signpost-2"></i> {{ fs_lang('listWithoutPage') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
