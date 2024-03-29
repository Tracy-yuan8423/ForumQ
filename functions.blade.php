@extends('ThemeFunctions::layout')

@section('body')
    <header class="border-bottom mb-3 pt-5 ps-5 pb-3">
        <h3>{{ $lang['name'] }}</h3>
        <p class="text-secondary"><i class="bi bi-palette"></i> {{ $lang['description'] }}</p>
    </header>

    <main class="my-5">
        <form action="{{ route('fresns.api.functions', ['fskey' => 'ForumQ']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- 加载动效 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['loadingConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumq_loading" id="loading_true" value="true" {{ $params['forumq_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumq_loading" id="loading_false" value="false" {{ ! $params['forumq_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- 快速发帖 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['quickPublishConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumq_quick_publish" id="quick_publish_true" value="true" {{ $params['forumq_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="forumq_quick_publish" id="quick_publish_false" value="false" {{ ! $params['forumq_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- 消息页是否显示 --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['notificationConfig'] }}</label>
                <div class="col-lg-10 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_systems" name="forumq_notifications[]" value="systems" {{ in_array('systems', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_systems">{{ $lang['notification_systems'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_recommends" name="forumq_notifications[]" value="recommends" {{ in_array('recommends', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_recommends">{{ $lang['notification_recommends'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_likes" name="forumq_notifications[]" value="likes" {{ in_array('likes', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_likes">{{ $lang['notification_likes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_dislikes" name="forumq_notifications[]" value="dislikes" {{ in_array('dislikes', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_dislikes">{{ $lang['notification_dislikes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_follows" name="forumq_notifications[]" value="follows" {{ in_array('follows', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_follows">{{ $lang['notification_follows'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_blocks" name="forumq_notifications[]" value="blocks" {{ in_array('blocks', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_blocks">{{ $lang['notification_blocks'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_mentions" name="forumq_notifications[]" value="mentions" {{ in_array('mentions', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_mentions">{{ $lang['notification_mentions'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_comments" name="forumq_notifications[]" value="comments" {{ in_array('comments', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_comments">{{ $lang['notification_comments'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_quotes" name="forumq_notifications[]" value="quotes" {{ in_array('quotes', $params['forumq_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_quotes">{{ $lang['notification_quotes'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ $lang['save'] }}</button></div>
            </div>
        </form>
    </main>

    <footer class="copyright text-center">
        <p class="my-5 text-muted">&copy; <span class="copyright-year"></span> Fresns</p>
    </footer>
@endsection
