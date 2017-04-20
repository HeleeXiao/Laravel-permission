@extends("layouts.manager")

@section("title","编辑用户 - ".config('app.name'))

@section("content")
    <form id="validation-wizard" action="{{ url('users/'.$id) }}" method="post" class="form-horizontal form-bordered ui-formwizard" novalidate="novalidate">
        <!-- First Step -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="user_id" value="{{ $info->id }}">
        <div id="validation-first" class="step ui-formwizard-content" style="display: block;">
            <!-- Step Info -->
            <div class="form-group">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified">
                        <li class="active disabled">
                            <a href="javascript:void(0)" class="text-muted">
                                {{--<i class="fa fa-user"></i>--}}
                                <i class="fa fa-info-circle"></i>
                                <strong>编辑用户</strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Step Info -->
            <div class="form-group @if($errors->has("name")) has-error @endif">
                <label class="col-md-4 control-label" for="example-validation-username">名称 <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" id="example-validation-username" name="name"
                               class="form-control ui-wizard-content" placeholder="请输入名称"
                               required="" aria-required="true" aria-describedby="example-validation-username-error"
                               aria-invalid="true" value="{{ $info->name }}">
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
                               class="form-control ui-wizard-content" placeholder="请输入权限别称"
                               required="" aria-required="true" aria-describedby="example-validation-email-error"
                               aria-invalid="true" value="{{ $info->email }}">
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
            <div class="form-group @if($errors->has("role_id")) has-error @endif">
                <label class="col-md-4 control-label" for="example-validation-confirm-password">
                    归属
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <select id="val-skill" name="role_id" class="form-control">
                        <option value="">请选择</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                    @if(old('role_id') == $role->id) selected @endif
                                    @if($info->roles->count())
                                        @if($info->roles[0]->id == $role->id) selected @endif
                                    @endif
                            >
                                {{ $role->name }}
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
            <?php $name = config('app.'.session('laravel-gettext-locale'))?>
            <div class="form-group">
                <label class="col-md-4 control-label" for="example-validation-confirm-password">
                    状态
                    <span class="text-danger">&nbsp;&nbsp;</span>
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select id="val-skill" name="status" class="form-control">
                            <option value="0" @if($info->status == 0) selected @endif>
                                {{ config('manage.user.status.'.$name)[0] }}
                            </option>
                            <option value="1" @if($info->status == 1) selected @endif>
                                {{ config('manage.user.status.'.$name)[1] }}
                            </option>
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
                    <input type="submit" class="btn btn-sm btn-primary ui-wizard-content ui-formwizard-button" id="next3" value="修改">
                </div>
            </div>
            <!-- END Form Buttons -->
    </form>
@stop
