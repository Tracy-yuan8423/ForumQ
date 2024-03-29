@extends('commons.fresns')

@section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags($post['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($post['content']), 140))

@section('content')
    <main class="container-fluid">
        <div class="row fs-top">
            {{-- 左侧边栏 --}}
            @desktop
                <div class="col-sm-3">
                    @include('groups.sidebar')
                </div>
            @enddesktop

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-4">
                    @component('components.post.detail', compact('post'))@endcomponent
                </div>

                <article class="card clearfix" id="commentList" name="commentList">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_config('comment_name') }}</h5>
                    </div>

                    {{-- 置顶评论列表 --}}
                    @if (fs_sticky_comments($post['pid']))
                        <div class="card-body bg-primary bg-opacity-10 mb-4">
                            @foreach(fs_sticky_comments($post['pid']) as $sticky)
                                @component('components.comment.sticky', [
                                    'sticky' => $sticky,
                                    'detailLink' => true,
                                    'sectionAuthorLiked' => true,
                                ])@endcomponent
                            @endforeach
                        </div>
                    @endif

                    {{-- 暂无评论 --}}
                    @if ($comments->isEmpty())
                        <div class="text-center my-5 text-muted fs-7"><i class="bi bi-chat-square-text"></i> {{ fs_lang('listEmpty') }}</div>
                    @endif

                    {{-- 评论列表 --}}
                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => true,
                            'sectionAuthorLiked' => true,
                        ])@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach

                    {{-- 评论页码 --}}
                    <div class="my-3 table-responsive d-none">
                        {{ $comments->links() }}
                    </div>

                    {{-- Ajax Footer --}}
                    @include('commons.ajax-footer')

                    <!-- next page -->
                    <div class="clearfix my-4">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            @if ($comments->nextPageUrl())
                                <a class="btn btn-outline-secondary" href="{{ $comments->nextPageUrl() }}" role="button">{{ fs_lang('nextPage') }}</a>
                            @else
                                <p class="text-secondary text-center"><i class="bi bi-signpost-2"></i> {{ fs_lang('listWithoutPage') }}</p>
                            @endif
                        </div>
                    </div>
                </article>
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
