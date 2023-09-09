<div class="cat-field text">
    <input type="hidden" value="@{$id}" name="textfield_id">
    <div class="cat-field-header">
        <span class="title">Text Field</span>
        <div class="delete-field">
            <i class="material-icons">delete</i>
            Delete
        </div>
    </div>
    <div class="cat-field-body">
        <input name="fields[@{$id}][type]" value="text" type="hidden">
        <div class="field col-33">
            <label class="field-label">Label</label>
            <input name="fields[@{$id}][label]" type="text">
        </div>
        <div class="field col-33">
            <label class="field-label">Name</label>
            <input name="fields[@{$id}][name]" type="text">
        </div>
        <div class="field col-33">
            <label class="field-label">Required</label>
            <select name="fields[@{$id}][required]">
                <option value="1">@lang(yes)</option>
                <option value="0">@lang(no)</option>
            </select>
        </div>
    </div>
</div>