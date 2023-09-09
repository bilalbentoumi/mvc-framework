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
                            <label class="field-label">@lang(username)</label>
                            <input name="username" type="text" value="@{$user->username}">
                        </div>
                        <div class="field col-50">
                            <label class="field-label">@lang(password)</label>
                            <input name="password" type="password" value="@{$user->password}">
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(email)</label>
                            <input name="email" type="text" value="@{$user->user_email}">
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(status)</label>
                            <label class="checkbox">
                                <span class="label">@lang(active)</span>
                                <input name="status" value="1" @if($user->user_status) checked @endif type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="field col-100">
                            <button type="submit" name="submit" class="btn btn-primary">@lang(update)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@component(alerts)