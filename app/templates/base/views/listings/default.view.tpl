<div class="container">
    @component(navbar)
    @component(sidebar)
    <div class="main">
        <div class="page-header">
            @component(breadcrumb)
        </div>
        <div class="page-content">
            <div class="panel">
                <a class="btn btn-primary" href="@{BASE_URL}listings/create">@lang(create_ad)</a>
                <table>
                    <thead>
                        <tr>
                            <th>@lang(listing_title)</th>
                            <th>@lang(listing_category)</th>
                            <th>@lang(listing_price)</th>
                            <th>@lang(listing_negotiable)</th>
                            <th>@lang(create_date)</th>
                            <th>@lang(last_update)</th>
                            <th>@lang(actions)</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($listings as $listing)
                    <tr>
                        <td>@{$listing->listing_title}</td>
                        <td>@{$listing->category_name}</td>
                        <td>@{$listing->listing_price} DA</td>
                        <td>@if($listing->listing_negotiable) @lang(yes) @else @lang(no) @endif</td>
                        <td>@{$listing->listing_create_date}</td>
                        <td>@{$listing->listing_update_date}</td>
                        <td>
                            <a title="@lang(edit)" class="action-btn" href="@{BASE_URL}listings/update/@{$listing->listing_id}"><i class="material-icons">edit</i></a>
                            <a title="@lang(delete)" class="action-btn" href="@{BASE_URL}listings/delete/@{$listing->listing_id}"><i class="material-icons">delete</i></a>
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