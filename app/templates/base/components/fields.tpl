@forelse($fields as $i => $field)
    @if($field->field_type == 'text')
    <div class="cat-field text">
        <input type="hidden" value="@{$i}" name="textfield_id">
        <div class="cat-field-header">
            <span class="title">Text Field</span>
            <div class="delete-field">
                <i class="material-icons">delete</i>
                Delete
            </div>
        </div>
        <div class="cat-field-body">
            <input name="fields[@{$i}][type]" type="hidden" value="@{$field->field_type}">
            <div class="field col-33">
                <label class="field-label">Label</label>
                <input name="fields[@{$i}][label]" type="text" value="@{$field->field_label}">
            </div>
            <div class="field col-33">
                <label class="field-label">Name</label>
                <input name="fields[@{$i}][name]" type="text" value="@{$field->field_name}">
            </div>
            <div class="field col-33">
                <label class="field-label">Required</label>
                <select name="fields[@{$i}][required]">
                    <option value="1" @if($field->field_required) selected @endif>@lang(yes)</option>
                    <option value="0" @if(!$field->field_required) selected @endif>@lang(no)</option>
                </select>
            </div>
        </div>
    </div>
    @elseif($field->field_type == 'numeric')
    <div class="cat-field numeric">
    <input type="hidden" value="@{$i}" name="numericfield_id">
    <div class="cat-field-header">
        <span class="title">Numeric Field</span>
        <div class="delete-field">
            <i class="material-icons">delete</i>
            Delete
        </div>
    </div>
    <div class="cat-field-body">
        <input name="fields[@{$i}][type]" type="hidden" value="@{$field->field_type}">
        <div class="field col-25">
            <label class="field-label">Label</label>
            <input name="fields[@{$i}][label]" type="text" value="@{$field->field_label}">
        </div>
        <div class="field col-25">
            <label class="field-label">Unit</label>
            <input name="fields[@{$i}][unit]" type="text" value="@{$field->field_unit}">
        </div>
        <div class="field col-25">
            <label class="field-label">Name</label>
            <input name="fields[@{$i}][name]" type="text" value="@{$field->field_name}">
        </div>
        <div class="field col-25">
            <label class="field-label">Required</label>
            <select name="fields[@{$i}][required]">
                <option value="1" @if($field->field_required) selected @endif>@lang(yes)</option>
                <option value="0" @if(!$field->field_required) selected @endif>@lang(no)</option>
            </select>
        </div>
    </div>
</div>
    @elseif($field->field_type == 'checkbox')
    <div class="cat-field check_box">
        <input type="hidden" value="@{$i}" name="numericfield_id">
        <div class="cat-field-header">
            <span class="title">Checkbox Field</span>
            <div class="delete-field">
                <i class="material-icons">delete</i>
                Delete
            </div>
        </div>
        <div class="cat-field-body">
            <input name="fields[@{$i}][type]" type="hidden" value="@{$field->field_type}">
            <div class="field col-50">
                <label class="field-label">Label</label>
                <input name="fields[@{$i}][label]" type="text" value="@{$field->field_label}">
            </div>
            <div class="field col-50">
                <label class="field-label">Name</label>
                <input name="fields[@{$i}][name]" type="text" value="@{$field->field_name}">
            </div>
        </div>
    </div>
    @elseif($field->field_type == 'select')
    <div class="cat-field select">
        <input type="hidden" value="@{$i}" name="selectfield_id">
        <input type="hidden" value="@{sizeof($field->options)}" name="option_id">
        <div class="cat-field-header">
            <span class="title">Select Field</span>
            <div class="delete-field">
                <i class="material-icons">delete</i>
                Delete
            </div>
        </div>
        <div class="cat-field-body">
            <input name="fields[@{$i}][type]" type="hidden" value="@{$field->field_type}">
            <div class="field col-33">
                <label class="field-label">Label</label>
                <input name="fields[@{$i}][label]" type="text" value="@{$field->field_label}">
            </div>
            <div class="field col-33">
                <label class="field-label">Name</label>
                <input name="fields[@{$i}][name]" type="text" value="@{$field->field_name}">
            </div>
            <div class="field col-33">
                <label class="field-label">Required</label>
                <select name="fields[@{$i}][required]">
                    <option value="1" @if($field->field_required) selected @endif>@lang(yes)</option>
                    <option value="0" @if(!$field->field_required) selected @endif>@lang(no)</option>
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
                @forelse($field->options as $j => $option)
                <div class="option col-100 flex-row end">
                    <div class="fill">
                        <label class="field-label">Name</label>
                        <input name="fields[@{$i}][options][@{$j}][name]" type="text" value="@{$option->option_name}">
                    </div>
                    <div class="fill">
                        <label class="field-label">Value</label>
                        <input name="fields[@{$i}][options][@{$j}][value]" type="text" value="@{$option->option_value}">
                    </div>
                    <div>
                        <div class="btn btn-success add-field delete-option">
                            Delete
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @endIsEqual
@empty
    NO FIELDS
@endforelse