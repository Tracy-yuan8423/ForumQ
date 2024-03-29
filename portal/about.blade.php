@extends('commons.fresns')

@section('title', fs_lang('accountLoginOrRegister'))

@section('content')
    <main class="container-fluid">
        <div class="row fs-top">
            <div class="card mx-auto" style="max-width:800px;">
                <div class="card-body p-5">
                    {!! Str::markdown(fs_config('site_intro')) !!}
                </div>
            </div>
        </div>
    </main>
@endsection
