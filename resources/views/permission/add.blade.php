@extends("layouts.manager")

@section("title","Permissions - UR Manager")

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
                <div class="form-group @if($errors->has("name")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">名称 <span class="text-danger">*</span></label>
                    <div class="col-xs-6">
                        <input type="text" name="name" class="form-control" value="{{ old("name") }}" placeholder="请输入权限名称">

                        @if($errors->has("name"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name") }}！
                            </span>
                        @endif
                    </div>

                </div>
                <div class="form-group @if($errors->has("display_name")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-email">
                        别称
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
                <div class="form-group @if($errors->has("description")) has-error @endif">
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
                </div>
                <div class="form-group @if($errors->has("role_id")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        归属
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-xs-5">
                        <select id="val-skill" name="role_id" class="form-control">
                            <option value="">请选择</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"  @if(old('role_id') == $role->id) selected @endif>
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
                    <div class="col-xs-1">
                        <a type="submit" class="btn btn-effect-ripple btn-primary"
                                style="overflow: hidden; position: relative;">
                            <span class="btn-ripple animate"
                                  style="height: 71px; width: 71px; top: -20.5px; left: -14.2812px;">
                            </span>
                            添加
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        状态
                        <span class="text-danger">&nbsp;&nbsp;</span>
                    </label>
                    <div class="col-xs-6">
                        <select id="val-skill" name="status" class="form-control">
                            <option value="0" @if(old('status') == 0) selected @endif>正常</option>
                            <option value="1" @if(old('status') == 1) selected @endif>待开放</option>
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
                            <option value="0" @if(old('type') == 0) selected @endif>菜单</option>
                            <option value="1" @if(old('type') == 0) selected @endif>功能</option>
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
                                <option value="{{ $permission->id }}" @if(old('pid') == $permission->id) selected @endif>{{ $permission->name }}</option>
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
