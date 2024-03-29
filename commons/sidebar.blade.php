<div class="sticky-top sticky-top-offset">
    <aside class="bg-white rounded">
        <h4 class="fs-5 mx-3 py-3 border-bottom">{{ fs_lang('contentRecommend') }}</h4>

        <ul class="list-group-numbered px-3 pb-3">
            @foreach(fs_content_list('post', 'list') as $topPost)
                <li class="list-group-item border-bottom py-2 text-nowrap text-truncate overflow-hidden mb-1">
                    <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $topPost['pid']])) }}" class="text-decoration-none link-dark">
                        {{ $topPost['title'] ?? Str::limit(strip_tags($topPost['content']), 40) }}<br>
                        <span class="d-flex justify-content-between align-items-start mt-1">
                            <span class="text-secondary mt-1" style="font-size: 0.6rem;"><i class="bi bi-chat-square-dots"></i> {{ $topPost['commentCount'] }}</span>
                            @if ($topPost['digestState'] != 1)
                                <span class="fs-tag">{{ fs_lang('contentDigest') }}</span>
                            @endif
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
</div>
