@extends('commons.fresns')

@section('title', fs_config('channel_post_list_seo')['title'] ?: fs_config('channel_post_list_name'))
@section('keywords', fs_config('channel_post_list_seo')['keywords'])
@section('description', fs_config('channel_post_list_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row fs-top">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('hashtags.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                {{-- 帖子列表 --}}
                <article class="card clearfix" @if (fs_config('channel_post_list_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($posts as $post)
                        @component('components.posts.list', compact('post'))@endcomponent
                    @endforeach
                </article>

                {{-- 列表页码 --}}
                @if (fs_config('channel_post_list_query_state') != 1)
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
