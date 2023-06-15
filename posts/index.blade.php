@extends('commons.fresns')

@section('title', fs_db_config('menu_post_title'))
@section('keywords', fs_db_config('menu_post_keywords'))
@section('description', fs_db_config('menu_post_description'))

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
                @if (fs_sticky_posts())
                    <div class="bg-white rounded-bottom mb-2">
                        <ul class="list-unstyled mx-4 pt-3">
                            @foreach(fs_sticky_posts() as $sticky)
                                @component('components.post.sticky', compact('sticky'))@endcomponent
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 帖子列表 --}}
                <div class="clearfix" @if (fs_db_config('menu_post_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent
                    @endforeach
                </div>

                {{-- 列表页码 --}}
                @if (fs_db_config('menu_post_query_state') != 1)
                    <div class="my-3 table-responsive d-none">
                        {{ $posts->links() }}
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
                @endif
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
