@extends('layouts.app')

@section('breadcrumb')
@if($action == 'edit')
{{__('siwei.breadcrumbUserEdit')}} {{$user->name}}
@else
{{__('siwei.breadcrumbUserCreate')}}
@endif
@stop

@section('actionBar')
<nav class="form-actions mb-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-success btn-sm tooltiped" form-validate="userFrm"
            title="{{__('siwei.toolTipsSave')}}">
            <i class="icofont-save"></i> {{__('siwei.btnSave')}}
        </button>
        <a href="{{route('admin.users.index')}}" type="button" class="btn btn-primary btn-sm tooltiped"
            title="{{__('siwei.toolTipsCancel')}}">
            <i class="icofont-ui-previous"></i> {{__('siwei.btnBack')}}
        </a>
        @if($action=="edit")
        <a href="{{route('admin.users.delete', ['user' => $user->id])}}" type="button"
            class="btn btn-danger btn-sm tooltiped" title="{{__('siwei.toolTipsDelete')}}" data-toggle="confirm">
            <i class="icofont-trash"></i> {{__('siwei.btnDelete')}}
        </a>
        @endif
    </div>
</nav>
@stop

@section('content')
<form id="userFrm" method="POST" class="form form-field-check"
    action="@if($action == 'edit'){{route('admin.users.update', ['user' => $user->id])}}@else{{route('admin.users.create')}}@endif">
    @csrf
    <div class="form-group d-flex border-bottom">
        <label for="userFirstname" class="mr-auto">{{__('siwei.lblUserFirstName')}}</label>
        <input type="text" name="firstname" id="userFirstname" value="@if($action=='edit'){{$user->firstname}}@endif"
            class="form-control field-check" required />
    </div>
    <div class="form-group d-flex border-bottom">
        <label for="userLastname" class="mr-auto">{{__('siwei.lblUserLastName')}}</label>
        <input type="text" name="lastname" id="userLastname" value="@if($action=='edit'){{$user->lastname}}@endif"
            class="form-control field-check" required />
    </div>
    <div class="form-group d-flex border-bottom">
        <label for="userEmail" class="mr-auto">{{__('siwei.lblUserEmail')}}</label>
        <input type="text" name="email" id="userEmail" value="@if($action=='edit'){{$user->email}}@endif"
            class="form-control field-check" required />
    </div>
    <div class="form-group d-flex @if($action == 'edit') border-bottom @endif">
        <label for="userRoles" class="mr-auto">{{__('siwei.lblUserRoles')}}</label>
        <select class="form-control multiselect field-check" multiple="multiple" name="roles[]">
            @foreach($roles as $role)
            <option value="{{$role}}" @if($action=='edit' && in_array($role, $user->getRoleNames()->toArray()))
                selected @endif>{{$role}}
            </option>
            @endforeach
        </select>
    </div>
    @if($action == 'edit')
    <div class="form-group d-flex">
        <label for="userPassword">{{__('siwei.lblUserPassword')}}</label>
        <a href="#" class="btn btn-sm btn-secondary mr-auto" data-toggle="modal" data-target="#changePasswordModal">
            <i class="icofont-rotation"></i> {{__('siwei.btnInitPassword')}}
        </a>
    </div>
    @endif
</form>

@if($action == 'edit')
<h5 class="mt-3">{{__('siwei.titlePermissionOnUser')}}</h5>
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
            <td class='text-center'>
                @if($user->hasPermissionTo($group.'.read'))
                <i class="icofont-check text-green"></i>
                @else
                <i class="icofont-close text-red"></i>
                @endif
            </td>
            <td class='text-center'>
                @if($user->hasPermissionTo($group.'.edit'))
                <i class="icofont-check text-green"></i>
                @else
                <i class="icofont-close text-red"></i>
                @endif
            </td>
            <td class='text-center'>
                @if($user->hasPermissionTo($group.'.delete'))
                <i class="icofont-check text-green"></i>
                @else
                <i class="icofont-close text-red"></i>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif


@if($action == 'edit')
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lgd">
        <form id="changePasswordFrm" action="{{route('admin.users.password', ['user' => $user->id])}}" method="POST"
            class="form form-field-check" style="background-color: transparent;">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('siwei.btnInitPassword')}}</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group d-flex">
                        <label for="userPassword" class="mr-auto">{{__('siwei.lblUserPassword')}}</label>
                        <input type="text" name="password" id="userPassword" value="" class="form-control field-check"
                            required />
                        <a href="#" id="generatePasswordBtn" class="btn btn-secondary">
                            {{__('siwei.btnRandom')}}
                        </a>
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
@endif
@stop

@if($action == 'edit')
@push('scripts')
<script>
    jQuery(function() {
        $('#generatePasswordBtn').on('click', function(event) {
            event.stopPropagation();
            let randomstring = Math.random().toString(36).slice(-8);
            $('#userPassword').val(randomstring);
        });
    });

</script>
@endpush
@endif
