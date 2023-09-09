<div class="cat-field check_box">
    <input type="hidden" value="@{$id}" name="numericfield_id">
    <div class="cat-field-header">
        <span class="title">Checkbox Field</span>
        <div class="delete-field">
            <i class="material-icons">delete</i>
            Delete
        </div>
    </div>
    <div class="cat-field-body">
        <input name="fields[@{$id}][type]" value="checkbox" type="hidden">
        <div class="field col-50">
            <label class="field-label">Label</label>
            <input name="fields[@{$id}][label]" type="text">
        </div>
        <div class="field col-50">
            <label class="field-label">Name</label>
            <input name="fields[@{$id}][name]" type="text">
        </div>
    </div>
</div>