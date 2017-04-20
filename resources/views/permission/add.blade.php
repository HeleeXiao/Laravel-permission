@extends("layouts.manager")

@section("title","新增权限 - ".config('app.name'))
<?php $name = config('app.'.session('laravel-gettext-locale'))?>
@section("content")
    <form id="validation-wizard" action="{{ url('permissions') }}" method="post" class="form-horizontal form-bordered ui-formwizard" novalidate="novalidate">
            <!-- First Step -->
            {{ csrf_field() }}
            <div id="validation-first" class="step ui-formwizard-content" style="display: block;">
                <!-- Step Info -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="active disabled">
                                <a href="javascript:void(0)" class="text-muted">
                                    {{--<i class="fa fa-user"></i>--}}
                                    <i class="fa fa-info-circle"></i>
                                    <strong>添加权限</strong>
                                </a>
                            </li>
                            {{--<li class="disabled">--}}
                                {{--<a href="javascript:void(0)">--}}
                                    {{--<i class="fa fa-info-circle"></i> <strong>Info</strong>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <!-- END Step Info -->
                <div class="form-group @if($errors->has("name_zh")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">中文名称 <span class="text-danger">*</span></label>
                    <div class="col-xs-6">
                        <input type="text" name="name_zh" class="form-control" value="{{ old("name_zh") }}" placeholder="请输入权限中文名称">

                        @if($errors->has("name_zh"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name_zh") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has("name_jp")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">日文名称 <span class="text-danger">*</span></label>
                    <div class="col-xs-6">
                        <input type="text" name="name_jp" class="form-control" value="{{ old("name_jp") }}" placeholder="请输入权限日文名称">

                        @if($errors->has("name_jp"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name_jp") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has("display_name")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-email">
                        别称（路由）
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-xs-6">
                        <input type="text" id="example-validation-email" name="display_name"
                                   class="form-control ui-wizard-content" placeholder="请输入权限别称"
                                   required="" aria-required="true" aria-describedby="example-validation-email-error"
                               aria-invalid="true"  value="{{ old("display_name") }}">

                        @if($errors->has("display_name"))
                            <span id="example-validation-email-error" class="help-block animation-slideDown">
                                {{ $errors->first("display_name") }}！
                            </span>
                        @endif
                    </div>
                </div>
                {{--<div class="form-group @if($errors->has("description")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-password">
                        说明
                        <span class="text-danger">&nbsp;&nbsp;</span>
                    </label>
                    <div class="col-xs-6">
                            <input type="text" id="example-validation-password" name="description"
                                   class="form-control ui-wizard-content" placeholder="请输入权限说明" required=""
                                   aria-required="true" aria-describedby="example-validation-password-error"
                                   aria-invalid="true"  value="{{ old("description") }}">

                        @if($errors->has("description"))
                            <span id="example-validation-password-error" class="help-block animation-slideDown">
                                {{ $errors->first("description") }}！
                            </span>
                        @endif
                    </div>
                </div>--}}
                <div class="form-group @if($errors->has("role_id")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        角色
                        <span class="text-danger">*</span>
                    </label>
                    <?php $name = config('app.'.session('laravel-gettext-locale'))?>
                    <div class="col-md-6">
                        <select id="example-chosen-multiple" name="role_id[]" class="select-chosen"
                                data-placeholder="请点击选择所属角色" style="width: 250px; display: none;" multiple="">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        @if(old('role_id'))
                                        @if(in_array($role->id,old('role_id'))) selected @endif
                                        @endif
                                        >
                                    {{ $role->$name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has("role_id"))
                            <span id="example-validation-email-error" class="help-block animation-slideDown">
                                {{ $errors->first("role_id") }}！
                            </span>
                        @endif
                    </div>

                </div>
                {{--**************************************************************--}}
                <div class="form-group">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        状态
                        <span class="text-danger">&nbsp;&nbsp;</span>
                    </label>
                    <div class="col-xs-6">
                        <select id="val-skill" name="status" class="form-control">
                            @foreach(config('manage.role.status.'.$name) as $key=>$status)
                                <option value="{{ $key }}" @if(old('status') == $key) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        类型
                        <span class="text-danger">&nbsp;&nbsp;</span>
                    </label>
                    <div class="col-xs-6">
                        <select id="val-skill" name="type" class="form-control">
                            @foreach(config('manage.role.type.'.$name) as $key=>$status)
                                <option value="{{ $key }}" @if(old('type') == $key) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group @if($errors->has("pid")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        父级
                        <span class="text-danger">&nbsp;*</span>
                    </label>
                    <div class="col-xs-6">
                        <select id="val-skill" name="pid" required class="form-control">
                            <option value="">请选择</option>
                            <option value="0" @if(old('pid') == 0) selected @endif>无</option>
                            @foreach($parentPermission as $permission)
                                <option value="{{ $permission->id }}" @if(old('pid') == $permission->id) selected @endif>{{ $permission->$name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has("pid"))
                            <span id="example-validation-password-error" class="help-block animation-slideDown">
                                {{ $errors->first("pid") }}！
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END First Step -->

            <!-- Form Buttons -->
            <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    {{--<input type="reset" class="btn btn-sm btn-warning ui-wizard-content ui-formwizard-button" id="back3" value="Back" disabled="disabled">--}}
                    <button type="submit" class="btn btn-effect-ripple btn-primary"
                            style="overflow: hidden; position: relative;">
                            <span class="btn-ripple animate"
                                  style="height: 71px; width: 71px; top: -20.5px; left: -14.2812px;">

                            </span>
                        提 交
                    </button>
                </div>
            </div>
            <!-- END Form Buttons -->
        </form>
@stop
