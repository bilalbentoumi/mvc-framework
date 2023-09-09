<div class="cat-field numeric">
    <input type="hidden" value="@{$id}" name="numericfield_id">
    <div class="cat-field-header">
        <span class="title">Numeric Field</span>
        <div class="delete-field">
            <i class="material-icons">delete</i>
            Delete
        </div>
    </div>
    <div class="cat-field-body">
        <input name="fields[@{$id}][type]" value="numeric" type="hidden">
        <div class="field col-25">
            <label class="field-label">Label</label>
            <input name="fields[@{$id}][label]" type="text">
        </div>
        <div class="field col-25">
            <label class="field-label">Unit</label>
            <input name="fields[@{$id}][unit]" type="text">
        </div>
        <div class="field col-25">
            <label class="field-label">Name</label>
            <input name="fields[@{$id}][name]" type="text">
        </div>
        <div class="field col-25">
            <label class="field-label">Required</label>
            <select name="fields[@{$id}][required]">
                <option value="1">@lang(yes)</option>
                <option value="0">@lang(no)</option>
            </select>
        </div>
    </div>
</div>