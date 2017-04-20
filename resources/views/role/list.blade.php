@extends("layouts.manager")

@section("title","角色预览 - ".config('app.name'))

@section("content")
<?php $name = config('app.'.session('laravel-gettext-locale'))?>
    <!-- 首页内容下方 -->
    <div class="block full">
        <div class="block-title">
            <h2>角色列表</h2>
        </div>
        @foreach($roles as $role)
            <div class="list-group">
                <a href="javascript:void(0)" style="cursor: default" class="list-group-item active">
                    <h4 class="list-group-item-heading"><strong>{{ $role->$name }}</strong></h4>
                </a>

                <!-- **************分配权限***************-->
                <div class="block">
                    <form action="{{ url('roles/'.$role->id) }}" id="form-{{ $role->id }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="patch">
                        <div class="form-group">
                            <div class="col-md-12">
                                <select id="example-chosen-multiple" name="permissions[]" class="select-chosen" data-placeholder="请点击选择包含权限" style="width: 250px; display: none;" multiple="">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                        @if($role->perms)
                                            @if( in_array( $permission->id,$role->perms->pluck('id')->toArray() ) ) selected @endif
                                        @endif
                                        >
                                            {{ $permission->$name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary"
                                    onclick="layer.confirm('即将修改角色组，是否继续？',{
                                        btn:['取消', '继续'],
                                        title:'警告',
                                        icon:0
                                        },function(index, layero){
                                            layer.closeAll()
                                        }
                                        ,function(index, layero){
                                            $('#form-{{ $role->id }}').submit()
                                        }); return false;"
                                    style="overflow: hidden; position: relative;">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@stop