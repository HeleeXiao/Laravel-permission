@extends("layouts.manager")

@section("title","用户列表 - ".config('app.name'))

@section("content")
        <!-- 首页内容下方 -->
        <div class="block full">
            <div class="block-title">
                <h2>用户列表</h2>
            </div>
            <div class="table-responsive">
                <div id="example-datatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                    <div class="row">
                        <div class="col-sm-6 col-xs-5">
                            <div class="dataTables_length" id="example-datatable_length">
                                <label>
                                    <select name="example-datatable_length" aria-controls="example-datatable"
                                            onchange="
                                                    var queryString = '{{ $request->getQueryString() }}',
                                                    limit = $(this).val(),
                                                    url = '{{ $request->url() }}';
                                                    window.location.href=url + ( queryString ? '?'+queryString+'&l='+limit : '?l='+limit )"
                                            class="form-control">
                                        <option value="5"
                                                @if(request('l') == 5)
                                                selected
                                                @endif
                                                >
                                            5
                                        </option>
                                        <option value="10"
                                                @if(request()->has('l') && request('l') == 10)
                                                selected
                                                @elseif( ( ! request()->has('l') || !in_array(request('l'),[5,10,20]) ) && config('list.limit',10) == 10)
                                                selected
                                                @endif
                                                >
                                            10
                                        </option>
                                        <option value="20"
                                                @if(request('l') == 20)
                                                selected
                                                @endif
                                                >
                                            20
                                        </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        @include('layouts.manager-search')
                    </div>
                    <table id="example-datatable" class="table table-striped table-bordered table-vcenter dataTable no-footer" role="grid" aria-describedby="example-datatable_info">
                        <thead>
                        <tr role="row">
                            <th class="text-center sorting_asc" style="width: 49px;" tabindex="0" aria-controls="example-datatable"
                                rowspan="1" colspan="1" aria-sort="ascending" >ID</th>

                            <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                                colspan="1" aria-label="User: activate to sort column ascending" style="width: 10%;">名称</th>

                            <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                                colspan="1" aria-label="Email: activate to sort column ascending" style="width: 12%;">Email（账号）</th>

                            <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                                colspan="1" aria-label="Email: activate to sort column ascending" style="width: 10%;">角色</th>

                            <th style="width: 10%;" class="sorting" tabindex="0" aria-controls="example-datatable"
                                rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">状态</th>
                            <th style="width: 10%;" class="sorting" tabindex="0" aria-controls="example-datatable"
                                rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">登录数</th>
                            <th style="width: 12%;" class="sorting" tabindex="0" aria-controls="example-datatable"
                                rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">最近上线时间</th>
                            <th style="width: 10%;" class="sorting" tabindex="0" aria-controls="example-datatable"
                                rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">最近IP</th>

                            <th class="text-center sorting_disabled" style="width: 74px;" rowspan="1" colspan="1" aria-label="">
                                <i class="fa fa-flash"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $name = config('app.'.session('laravel-gettext-locale'))?>
                        @foreach($users as $user)
                            <tr role="row" class="odd">
                                <td class="text-center sorting_1">{{ $user->id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles)
                                        @foreach($user->roles as $role)
                                            <span class="label label-info">{{ $role->$name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <span class="label label-info">
                                        {{ config('manage.user.status.'.$name)[$user->status] }}
                                    </span>
                                </td>
                                <td>
                                        {{ $user->landing_number }}
                                </td>
                                <td>
                                        {{ $user->updated_at }}
                                </td>
                                <td>
                                        {{ $user->landing_ip }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit',['id'=>$user->id]) }}"
                                       class="btn btn-effect-ripple btn-xs btn-success"
                                       style="overflow: hidden; position: relative;" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form style="display:inline-block" action="{{ url('users/'.$user->id) }}" method="post"
                                          id="destroy-{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title=""
                                           class="btn btn-effect-ripple btn-xs btn-danger" style="overflow: hidden; position: relative;"
                                           data-original-title="Delete"
                                           onclick="layer.confirm('即将删除该权限，是否继续？',{
                                                btn:['取消', '继续'],
                                                title:'警告',
                                                icon:0
                                                },function(index, layero){
                                                    layer.closeAll()
                                                }
                                                ,function(index, layero){
                                                    $('#destroy-{{ $user->id }}').submit()
                                                }); return false;">
                                            <i class="fa fa-times" ></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-5 hidden-xs">
                            <div class="dataTables_info" id="example-datatable_info" role="status" aria-live="polite">
                                <strong>{{ $users->perPage() * ($users->currentPage()-1) + 1 }}</strong>-
                                <strong>{{ $users->currentPage() == $users->lastPage() ? $users->total() : $users->perPage() * $users->currentPage() }}</strong> of
                                <strong>{{ $users->total() }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-12 clearfix">
                            <div class="dataTables_paginate paging_bootstrap" id="example-datatable_paginate">
                                {!! $users->appends(['l'=>request('l')?:10])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop