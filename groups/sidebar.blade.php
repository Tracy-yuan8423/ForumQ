@php
    $parentGid = $group['parentGid'] ?? null;
    $groupGid = $group['gid'] ?? null;

    $treeData = collect(fs_content_list('group', 'home'));
    $totalPostCount = $treeData->flatMap(function ($item) {
        return $item['groups'] ?? [];
    })->sum('postCount');
@endphp

<div class="p-3 rounded shadow-sm bg-white ms-lg-3 sticky-top sticky-top-offset">
    <div class="flex-shrink-0">
        <ul class="list-unstyled ps-0 mb-0">
            <li class="border-bottom mb-2 pb-3 ps-4 pe-1">
                <a href="{{ route('fresns.home') }}" class="link-dark text-decoration-none rounded d-flex justify-content-between align-items-start">
                    {{ fs_lang('contentAllList') }}
                    <span class="text-secondary fs-7">{{ $totalPostCount }}</span>
                </a>
            </li>
            @foreach(fs_content_list('group', 'home') as $tree)
                <li @if (! $loop->last) class="border-bottom mb-2 pb-2" @endif>
                    <div class="d-flex justify-content-between align-items-start">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#{{ $tree['gid'] }}-collapse" @if ($tree['gid'] == $parentGid) aria-expanded="true" @else aria-expanded="false" @endif>
                            {{ $tree['name'] }}
                        </button>
                        <span class="text-secondary fs-7 pt-2 pe-1">{{ array_sum(array_column($tree['groups'] ?? [], 'postCount')) }}</span>
                    </div>

                    <div class="collapse @if ($tree['gid'] == $parentGid) show @endif" id="{{ $tree['gid'] }}-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @foreach($tree['groups'] ?? [] as $treeGroup)
                                <li class="d-flex justify-content-between align-items-start">
                                    <a href="{{ route('fresns.group.detail', ['gid' => $treeGroup['gid']]) }}" class="link-dark d-inline-flex text-decoration-none rounded py-2 @if ($treeGroup['gid'] == $groupGid) active @endif">{{ $treeGroup['name'] }}</a>
                                    <span class="text-secondary fs-7 pt-2 pe-1">{{ $treeGroup['postCount'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
