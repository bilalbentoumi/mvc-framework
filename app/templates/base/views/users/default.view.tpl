<div class="container">
    @component(navbar)
    @component(sidebar)
    <div class="main">
        <div class="page-header">
            @component(breadcrumb)
        </div>
        <div class="page-content">
            <div class="panel">
                <a class="btn btn-primary" href="@{BASE_URL}users/create">@lang(create_user)</a>
                <table>
                    <thead>
                        <tr>
                            <th>@lang(username)</th>
                            <th>@lang(email)</th>
                            <th>@lang(status)</th>
                            <th>@lang(create_date)</th>
                            <th>@lang(last_update)</th>
                            <th>@lang(actions)</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>@{$user->username}</td>
                        <td>@{$user->user_email}</td>
                        <td>@isEqual($user->user_status, true) @lang(active) @else @lang(inactive) @endIsEqual</td>
                        <td>@{$user->user_create_date}</td>
                        <td>@{$user->user_update_date}</td>
                        <td>
                            <a title="@lang(edit)" class="action-btn" href="@{BASE_URL}users/update/@{$user->user_id}"><i class="material-icons">edit</i></a>
                            <a title="@lang(delete)" class="action-btn" href="@{BASE_URL}users/delete/@{$user->user_id}"><i class="material-icons">delete</i></a>
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