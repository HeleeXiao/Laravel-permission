@extends("layouts.manager")

@section("title","新增角色 - ".config('app.name'))

@section("content")
    <form id="validation-wizard" action="{{ url('roles') }}" method="post" class="form-horizontal form-bordered ui-formwizard" novalidate="novalidate">
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
                                    <strong>添加角色</strong>
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
                <div class="form-group @if($errors->has("name")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">英文名称 <span class="text-danger">*</span></label>
                    <div class="col-xs-6">
                        <input type="text" name="name" class="form-control" value="{{ old("name") }}" placeholder="请输入角色英文名称">

                        @if($errors->has("name"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <!-- END Step Info -->
                <div class="form-group @if($errors->has("name_zh")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-username">中文名称 <span class="text-danger">*</span></label>
                    <div class="col-xs-6">
                        <input type="text" name="name_zh" class="form-control" value="{{ old("name_zh") }}" placeholder="请输入角色中文名称">

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
                        <input type="text" name="name_jp" class="form-control" value="{{ old("name_jp") }}" placeholder="请输入角色日文名称">

                        @if($errors->has("name_jp"))
                            <span id="example-validation-username-error" class="help-block animation-slideDown">
                                {{ $errors->first("name_jp") }}！
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has("permission_id")) has-error @endif">
                    <label class="col-md-4 control-label" for="example-validation-confirm-password">
                        权限
                        <span class="text-danger">*</span>
                    </label>
                    <?php $name = config('app.'.session('laravel-gettext-locale'))?>
                    <div class="col-md-6">
                        <select id="example-chosen-multiple" name="permission_id[]" class="select-chosen"
                                data-placeholder="请点击选择其包含的权限" style="width: 250px; display: none;" multiple="">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}"
                                        @if(old('permission_id'))
                                            @if( in_array($permission->id,old('permission_id')) )) selected @endif
                                        @endif
                                        >
                                    {{ $permission->$name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has("permission_id"))
                            <span id="example-validation-email-error" class="help-block animation-slideDown">
                                {{ $errors->first("permission_id") }}！
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
                                   class="form-control ui-wizard-content" placeholder="请输入角色说明" required=""
                                   aria-required="true" aria-describedby="example-validation-password-error"
                                   aria-invalid="true"  value="{{ old("description") }}">

                        @if($errors->has("description"))
                            <span id="example-validation-password-error" class="help-block animation-slideDown">
                                {{ $errors->first("description") }}！
                            </span>
                        @endif
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
