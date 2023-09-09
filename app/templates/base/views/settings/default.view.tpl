<div class="container">
    @component(navbar)
    @component(sidebar)
    <div class="main">
        <div class="page-header">
            @component(breadcrumb)
        </div>
        <div class="page-content">
            <div class="panel">
                <form method="post">
                    <div class="flex-row">
                        <div class="field col-50">
                            <label class="field-label">@lang(site_name)</label>
                            <input name="site_name" type="text" value="@{SITE_NAME}">
                        </div>
                        <div class="field col-50">
                            <label class="field-label">@lang(site_email)</label>
                            <input name="site_email" type="text" value="@{SITE_EMAIL}">
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(site_language)</label>
                            <select name="site_language">
                                @forelse($languages as $lang)
                                <option @if($lang == DEFAULT_LANGUAGE) selected @endif value="@{$lang}">@{$lang}</option>
                                @empty
                                NO DATA
                                @endforelse
                            </select>
                        </div>
                        <div class="field col-100">
                            <button type="submit" name="submit" class="btn btn-primary">@lang(save)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@component(alerts)