@extends('commons.fresns')

@section('title', fs_config('channel_group_seo')['title'] ?: fs_config('channel_group_name'))
@section('keywords', fs_config('channel_group_seo')['keywords'])
@section('description', fs_config('channel_group_seo')['description'])

@section('content')
    <main class="container-fluid">
        <div class="row fs-top">
            {{-- 左侧边栏 --}}
            <div class="col-sm-3">
                @include('groups.sidebar')
            </div>

            {{-- 中间内容 --}}
            <div class="col-sm-6">
                @if (fs_config('channel_group_type') == 'tree')
                    {{-- 小组树结构列表 --}}
                    @foreach($groupTree ?? [] as $tree)
                        <h3 class="fs-5">{{ $tree['name'] }}</h3>
                        <div class="card mb-5 py-4">
                            @foreach($tree['groups'] ?? [] as $group)
                                @component('components.groups.list', compact('group'))@endcomponent
                                @if (! $loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @else
                    {{-- 小组列表 --}}
                    <div class="card mb-5 py-4" @if (fs_config('channel_group_query_state') != 1) id="fresns-list-container" @endif>
                        @foreach($groups ?? [] as $group)
                            @component('components.groups.list', compact('group'))@endcomponent
                            @if (! $loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>

                    {{-- 列表页码 --}}
                    @if (fs_config('channel_group_query_state') != 1)
                        <div class="my-3 table-responsive d-none">
                            {{ $groups->links() }}
                        </div>

                        {{-- Ajax Footer --}}
                        @include('commons.ajax-footer')

                        <!-- next page -->
                        <div class="clearfix my-4">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                @if ($groups->nextPageUrl())
                                    <a class="btn btn-outline-secondary" href="{{ $groups->nextPageUrl() }}" role="button">{{ fs_lang('nextPage') }}</a>
                                @else
                                    <p class="text-secondary text-center"><i class="bi bi-signpost-2"></i> {{ fs_lang('listWithoutPage') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- 右侧边栏 --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
