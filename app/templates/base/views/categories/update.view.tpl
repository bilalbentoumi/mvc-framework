<div class="container">
    @component(navbar)
    @component(sidebar)
    <div class="main">
        <div class="page-header">
            @component(breadcrumb)
        </div>
        <div class="page-content">
            <form method="post">
                <div class="tabbed">
                    <div class="header">
                        <div class="tab-button" data="default">General</div>
                        <div class="tab-button">Custom Fields</div>
                    </div>
                    <div class="tabs">
                        <div class="tab">
                            <div class="flex-row">
                                <div class="field col-50">
                                    <label class="field-label">@lang(category_name)</label>
                                    <input name="category_name" type="text" value="@{$category->category_name}">
                                </div>
                                <div class="field col-50">
                                    <label class="field-label">@lang(category_link)</label>
                                    <input name="category_link" type="text" value="@{$category->category_link}">
                                </div>
                                <div class="field col-100">
                                    <label class="field-label">@lang(category_description)</label>
                                    <textarea name="category_description" rows="4">@{$category->category_description}</textarea>
                                </div>
                                <div class="field col-100">
                                    <label class="field-label">@lang(status)</label>
                                    <label class="checkbox">
                                        <span class="label">@lang(active)</span>
                                        <input name="category_status" value="1" @if($category->category_status) checked @endif type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <input type="hidden" name="field_id" value="@{sizeof($fields)}">
                            <div class="field cat-fields col-100">
                                @component(fields)
                            </div>
                            <div class="field">
                                <div class="btn btn-success add-field textfield">
                                    Add Text Field
                                </div>
                                <div class="btn btn-success add-field numericfield">
                                    Add Numeric Field
                                </div>
                                <div class="btn btn-success add-field selectfield">
                                    Add Select Field
                                </div>
                                <div class="btn btn-success add-field checkboxfield">
                                    Add Checkbox Field
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <button type="submit" name="submit" class="btn btn-primary">@lang(update)</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@component(alerts)

<style>
    .add-field {
        padding: 7px 10px;
    }
    .cat-field {
        border: solid transparent 2px;
        border-radius: 3px;
        position: relative;
        margin-bottom: 40px;
    }
    .cat-field .cat-field-header {
        background: transparent;
        padding: 7px 10px;
        color: #FFF;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    .cat-field-header .title {
        flex: 1;
    }
    .cat-field-header .delete-field {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .cat-field-header .delete-field:hover {
         opacity: 0.8;
    }
    .cat-field-header .delete-field i {
         font-size: 20px;
    }
    .cat-field .cat-field-body {
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
    }

    .cat-field.text { border-color: #36dca8; }
    .cat-field.text .cat-field-header { background: #36dca8; }

    .cat-field.numeric { border-color: #dc365f; }
    .cat-field.numeric .cat-field-header { background: #dc365f; }

    .cat-field.check_box { border-color: #bb36dc; }
    .cat-field.check_box .cat-field-header { background: #bb36dc; }

    .cat-field.select { border-color: #36addc; }
    .cat-field.select .cat-field-header { background: #36addc; }

    .select-options-header {
        padding: 20px 0;
        display: flex;
        align-items: center;
        width: 100%;
        border: solid 1px #EEE;
        border-right: none;
        border-left: none;
        font-size: 16px;
        font-weight: 500;
    }

    .options {
        width: 100%;
    }

    .option div:not(:last-child) {
        padding-right: 20px;
    }


</style>