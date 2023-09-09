<div class="cat-field select">
    <input type="hidden" value="@{$id}" name="selectfield_id">
    <input type="hidden" value="1" name="option_id">
    <div class="cat-field-header">
        <span class="title">Select Field</span>
        <div class="delete-field">
            <i class="material-icons">delete</i>
            Delete
        </div>
    </div>
    <div class="cat-field-body">
        <input name="fields[@{$id}][type]" value="select" type="hidden">
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
        <div class="field col-100">
            <div class="select-options-header">
                <span class="fill">Select Options</span>
                <div class="btn btn-success add-field option">
                    Add Option
                </div>
            </div>
        </div>
        <div class="field flex-row options">
            <div class="option col-100 flex-row end">
                <div class="fill">
                    <label class="field-label">Name</label>
                    <input name="fields[@{$id}][options][0][name]" type="text">
                </div>
                <div class="fill">
                    <label class="field-label">Value</label>
                    <input name="fields[@{$id}][options][0][value]" type="text">
                </div>
                <div>
                    <div class="btn btn-success add-field delete-option">
                        Delete
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>