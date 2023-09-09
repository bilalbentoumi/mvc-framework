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
                        <div class="field col-100">
                            <label class="field-label">@lang(listing_title)</label>
                            <input name="listing_title" type="text">
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(listing_category)</label>
                            <select name="category_id">
                                @forelse($categories as $category)
                                    @if($category->category_status)
                                    <option value="@{$category->category_id}">@{$category->category_name}</option>
                                    @endif
                                @empty
                                NO DATA
                                @endforelse
                            </select>
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(listing_description)</label>
                            <textarea name="listing_description" rows="4"></textarea>
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(listing_price)</label>
                            <input name="listing_price" type="text">
                        </div>
                        <div class="field col-100">
                            <label class="field-label">@lang(listing_negotiable)</label>
                            <label class="checkbox">
                                <span class="label">@lang(yes)</span>
                                <input name="listing_negotiable" value="1" checked type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="field col-100">
                            <button type="submit" name="submit" class="btn btn-primary">@lang(create)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@component(alerts)