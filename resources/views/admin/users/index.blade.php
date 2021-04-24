@extends('layouts.app')

@section('breadcrumb')
{{__('siwei.breadcrumbUsers')}}
@stop


@section('actionBar')
<nav class="form-actions mb-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.users.createFrm')}}" type="button" class="btn btn-primary btn-sm tooltiped"
            title="{{__('siwei.toolTipsCreateUser')}}">
            <i class="icofont-plus-circle"></i> {{__('siwei.btnNew')}}
        </a>
    </div>
</nav>
@stop

@section('content')
<table class="table table-clickable tableDT display table-hover table-striped" style="width:100%;">
    <thead>
        <th>{{__('siwei.lblUserName')}}</th>
        <th>{{__('siwei.lblUserEmail')}}</th>
        <th>{{__('siwei.lblUserRoles')}}</th>
        <th>{{__('siwei.lblCreatedAt')}}</th>
        <th>{{__('siwei.lblUserLastConnectAt')}}</th>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr data-url="{{route('admin.users.edit', ['user' => $user->id])}}">
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->getRoleNames()}}</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
            <td>{{$user->lastConnect}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
