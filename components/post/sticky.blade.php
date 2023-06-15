@php
    use \App\Utilities\ArrUtility;

    $title = null;
    $decorate = null;

    $sticky = $sticky ?? $groupSticky;
@endphp

@if ($sticky['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<li class="pb-3 fs-sticky-link text-nowrap overflow-hidden">
    <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $sticky['pid']])) }}" class="text-decoration-none">
        <span class="text-secondary me-2">{{ fs_lang('contentSticky') }}</span>
        @if ($title)
            <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" style="height: 24px">
        @endif
        {{ $sticky['title'] ?? Str::limit(strip_tags($sticky['content']), 40) }}
    </a>
</li>
