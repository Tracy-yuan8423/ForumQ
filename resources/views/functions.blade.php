@extends('WebEngine::layout')

@section('body')
    <form action="{{ route('forumq.admin.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        {{-- 加载动效 --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ForumQ::fresns.loadingConfig') }}</label>
            <div class="col-lg-6 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="forumq_loading" id="loading_true" value="true" {{ ($params['forumq_loading']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="forumq_loading" id="loading_false" value="false" {{ ! ($params['forumq_loading']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                </div>
            </div>
        </div>

        {{-- 快速发帖 --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ForumQ::fresns.quickPublishConfig') }}</label>
            <div class="col-lg-6 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="forumq_quick_publish" id="quick_publish_true" value="true" {{ ($params['forumq_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="forumq_quick_publish" id="quick_publish_false" value="false" {{ ! ($params['forumq_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                </div>
            </div>
        </div>

        {{-- 消息页是否显示 --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ForumQ::fresns.notificationConfig') }}</label>
            <div class="col-lg-10 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_systems" name="forumq_notifications[]" value="systems" {{ in_array('systems', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_systems">{{ __('ForumQ::fresns.notification_systems') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_recommends" name="forumq_notifications[]" value="recommends" {{ in_array('recommends', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_recommends">{{ __('ForumQ::fresns.notification_recommends') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_likes" name="forumq_notifications[]" value="likes" {{ in_array('likes', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_likes">{{ __('ForumQ::fresns.notification_likes') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_dislikes" name="forumq_notifications[]" value="dislikes" {{ in_array('dislikes', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_dislikes">{{ __('ForumQ::fresns.notification_dislikes') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_follows" name="forumq_notifications[]" value="follows" {{ in_array('follows', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_follows">{{ __('ForumQ::fresns.notification_follows') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_blocks" name="forumq_notifications[]" value="blocks" {{ in_array('blocks', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_blocks">{{ __('ForumQ::fresns.notification_blocks') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_mentions" name="forumq_notifications[]" value="mentions" {{ in_array('mentions', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_mentions">{{ __('ForumQ::fresns.notification_mentions') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_comments" name="forumq_notifications[]" value="comments" {{ in_array('comments', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_comments">{{ __('ForumQ::fresns.notification_comments') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_quotes" name="forumq_notifications[]" value="quotes" {{ in_array('quotes', $params['forumq_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_quotes">{{ __('ForumQ::fresns.notification_quotes') }}</label>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-2"></div>
            <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ __('FsLang::panel.button_save') }}</button></div>
        </div>
    </form>
@endsection

@push('script')
    <script src="/assets/ForumQ/js/functions.js"></script>
@endpush
