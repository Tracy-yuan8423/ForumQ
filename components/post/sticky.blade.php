@php
    $title = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
        'key' => 'code',
        'values' => 'title',
        'asArray' => false,
    ]);
    $decorate = fs_helpers('Arr', 'pull', $sticky['operations']['diversifyImages'], [
        'key' => 'code',
        'values' => 'decorate',
        'asArray' => false,
    ]);

    $sticky = $sticky ?? $groupSticky;
@endphp

<li class="pb-3 fs-sticky-link text-nowrap overflow-hidden">
    <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $sticky['pid']])) }}" class="text-decoration-none">
        <span class="text-secondary me-2">{{ fs_lang('contentSticky') }}</span>
        @if ($title)
            <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" style="height: 24px">
        @endif
        {{ $sticky['title'] ?? Str::limit(strip_tags($sticky['content']), 40) }}
    </a>
</li>
