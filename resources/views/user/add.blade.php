@extends("layouts.manager")

@section("title","添加用户 - ".config('app.name'))
<?php $name = config('app.'.session('laravel-gettext-locale'))?>
@section("content")
    <form id="validation-wizard" action="{{ url('users') }}" method="post" class="form-horizontal form-bordered ui-formwizard" novalidate="novalidate">
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
                                    <strong>添加用户</strong>
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
                <div class="form-group @if($errors->has("name")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">姓名 <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="example-validation-username" name="name"
                                   class="form-control ui-wizard-content" placeholder="请输入权限名称"
                                   required="" aria-required="true" aria-describedby="example-validation-username-error"
                                   aria-invalid="true" value="{{ old('name') }}"
                            >
                            <span class="input-group-addon">
                                <i class="gi gi-asterisk"></i>
                            </span>
                        </div>
                        @if($errors->has("name"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has("email")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-email">
                        邮箱
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="example-validation-email" name="email"
                                   class="form-control ui-wizard-content" placeholder="请输入email"
                                   required="" aria-required="true" aria-describedby="example-validation-email-error"
                                   aria-invalid="true" value="{{ old('email') }}">
                            <span class="input-group-addon">
                                <i class="gi gi-asterisk"></i>
                            </span>
                        </div>
                        @if($errors->has("email"))
                            <span id="example-validation-email-error" class="help-block animation-slideDown">
                                {{ $errors->first("email") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has("password")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-password">
                        密码
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="password" id="example-validation-password" name="password"
                                   class="form-control ui-wizard-content" placeholder="不填写则默认123456" required=""
                                   aria-required="true" aria-describedby="example-validation-password-error"
                                   aria-invalid="true" >
                            <span class="input-group-addon">
                                <i class="gi gi-asterisk"></i>
                            </span>
                        </div>
                        @if($errors->has("password"))
                            <span id="example-validation-password-error" class="help-block animation-slideDown">
                                {{ $errors->first("password") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        角色
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select id="val-skill" name="role_id" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->$name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-addon">
                                <i class="gi gi-asterisk"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        状态
                        <span class="text-danger">&nbsp;&nbsp;</span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select id="val-skill" name="status" class="form-control">
                                @foreach(config('manage.user.status.'.$name) as $key=>$status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-addon">
                                <i class="gi gi-asterisk"></i>
                            </span>
                        </div>
                </div>
            </div>
            <!-- END First Step -->

            <!-- Form Buttons -->
            <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    {{--<input type="reset" class="btn btn-sm btn-warning ui-wizard-content ui-formwizard-button" id="back3" value="Back" disabled="disabled">--}}
                    <input type="submit" class="btn btn-sm btn-primary ui-wizard-content ui-formwizard-button" id="next3" value="添加">
                </div>
            </div>
            <!-- END Form Buttons -->
        </form>
@stop
