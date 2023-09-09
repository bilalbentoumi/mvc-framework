<div class="container">
    @component(navbar)
    @component(sidebar)
    <div class="main">
        <div class="page-header">
            @component(breadcrumb)
        </div>
        <div class="page-content">
            <div class="panel">
                <a class="btn btn-primary" href="@{BASE_URL}categories/create">@lang(create_category)</a>
                <table>
                    <thead>
                        <tr>
                            <th>@lang(category_name)</th>
                            <th>@lang(category_link)</th>
                            <th>@lang(status)</th>
                            <th>@lang(create_date)</th>
                            <th>@lang(last_update)</th>
                            <th>@lang(actions)</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>@{$category->category_name}</td>
                        <td>@{$category->category_link}</td>
                        <td>@if($category->category_status) @lang(active) @else @lang(inactive) @endif</td>
                        <td>@{$category->category_create_date}</td>
                        <td>@{$category->category_update_date}</td>
                        <td>
                            <a title="@lang(edit)" class="action-btn" href=" @{BASE_URL}categories/update/@{$category->category_id}"><i class="material-icons">edit</i></a>
                            <a title="@lang(delete)" class="action-btn" href="@{BASE_URL}categories/delete/@{$category->category_id}"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    @empty
                    No data
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@component(alerts)