@extends('layouts.app')

@section('breadcrumb')
{{__('siwei.breadcrumbRoles')}}
@stop


@section('actionBar')
<nav class="form-actions mb-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button class="btn btn-primary btn-sm tooltiped" title="{{__('siwei.toolTipsCreateUser')}}" data-toggle="modal"
            data-target="#addRoleModal">
            <i class="icofont-plus-circle"></i> {{__('siwei.btnNew')}}
        </button>
    </div>
</nav>
@stop

@section('content')
<table class="table table-clickable tableDT display table-hover table-striped" style="width:100%;">
    <thead>
        <th>{{__('siwei.lblRoleName')}}</th>
        <th>{{__('siwei.lblRolePermissionsCount')}}</th>
        <th>{{__('siwei.lblCreatedAt')}}</th>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr data-url="{{route('admin.roles.edit', ['role' => $role->id])}}">
            <td>{{$role->name}}</td>
            <td>{{$role->permissionsCount}}</td>
            <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lgd">
        <form id="addRoleFrm" action="{{route('admin.roles.create')}}" method="POST" class="form form-field-check"
            style="background-color: transparent;">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('siwei.titleCreateRole')}}</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group d-flex">
                        <label for="roleName" class="mr-auto">{{__('siwei.lblRoleName')}}</label>
                        <input type="text" name="name" id="roleName" value="" class="form-control field-check"
                            required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="icofont-close"></i> {{__('siwei.btnCancel')}}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="icofont-save"></i> {{__('siwei.btnSave')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
