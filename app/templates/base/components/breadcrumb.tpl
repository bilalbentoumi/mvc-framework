<h1 class="page-title">@{$str_title}</h1>
<ol class="breadcrumb">
    @isEqual(CONTROLLER, 'index')
    <li class="active">@lang(home)</li>
    @else
    <li><a href="@{BASE_URL}">@lang(home)</a></li>
    @endIsEqual

    @if(CONTROLLER != 'index' && ACTION == 'default')
    <li class="active">@{CONTROLLER}</li>
    @else @if(CONTROLLER != 'index')
        <li><a href="@{BASE_URL}@{CONTROLLER}">@{CONTROLLER}</a></li>
        <li class="active">@{ACTION}</li>
        @endif
    @endif
</ol>