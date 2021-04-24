@extends('layouts.app')

@section('breadcrumb')
{{__('siwei.breadcrumbRolesEdit')}} {{$role->name}}
@stop

@section('actionBar')
<nav class="form-actions mb-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-success btn-sm tooltiped" form-validate="roleFrm"
            title="{{__('siwei.toolTipsSave')}}">
            <i class="icofont-save"></i> {{__('siwei.btnSave')}}
        </button>
        <a href="{{route('admin.roles.index')}}" type="button" class="btn btn-primary btn-sm tooltiped"
            title="{{__('siwei.toolTipsCancel')}}">
            <i class="icofont-ui-previous"></i> {{__('siwei.btnBack')}}
        </a>
        <a href="{{route('admin.roles.delete', ['role' => $role->id])}}" type="button"
            class="btn btn-danger btn-sm tooltiped" title="{{__('siwei.toolTipsDelete')}}" data-toggle="confirm">
            <i class="icofont-trash"></i> {{__('siwei.btnDelete')}}
        </a>
    </div>
</nav>
@stop

@section('content')
<form id="roleFrm" method="POST" class="form" action="{{route('admin.roles.update', ['role' => $role->id])}}">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Permission</th>
                <th class='text-center'>{{__('siwei.lblPermissionRead')}}</th>
                <th class='text-center'>{{__('siwei.lblPermissionEdit')}}</th>
                <th class='text-center'>{{__('siwei.lblPermissionDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissionsGroups as $group)
            <tr>
                <td>{{__('siwei.permName-'.$group)}}</td>
                <td class='text-center bg-white'>
                    <input type="checkbox" name="perm_{{$group.'.read'}}"
                        @if($roleSpartie->hasPermissionTo($group.'.read'))
                    checked @endif />
                </td>
                <td class='text-center bg-white'>
                    <input type="checkbox" name="perm_{{$group.'.edit'}}"
                        @if($roleSpartie->hasPermissionTo($group.'.edit'))
                    checked @endif />
                </td>
                <td class='text-center bg-white'>
                    <input type="checkbox" name="perm_{{$group.'.delete'}}"
                        @if($roleSpartie->hasPermissionTo($group.'.delete'))
                    checked @endif />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

<h5 class="mt-3">{{__('siwei.titleUserHavingRole')}}</h5>
<table class="table display table-hover table-striped" style="width:100%;">
    <thead>
        <th>{{__('siwei.lblUserName')}}</th>
        <th>{{__('siwei.lblUserEmail')}}</th>
        <th>{{__('siwei.lblUserRoles')}}</th>
        <th>{{__('siwei.lblCreatedAt')}}</th>
        <th>{{__('siwei.lblUserLastConnectAt')}}</th>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
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
