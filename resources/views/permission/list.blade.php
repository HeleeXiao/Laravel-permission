@extends("layouts.manager")

@section("title","权限列表 - ".config('app.name'))

@section("content")
    <!-- 首页内容下方 -->
    <div class="block full">
        <div class="block-title">
            <h2>权限列表</h2>
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
                            colspan="1" aria-label="User: activate to sort column ascending" style="width: 221px;">名称</th>

                        <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                            colspan="1" aria-label="Email: activate to sort column ascending" style="width: 16%;">别称</th>

                        {{--<th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"--}}
                            {{--colspan="1" aria-label="User: activate to sort column ascending" style="width: 16%;">说明</th>--}}

                        <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                            colspan="1" aria-label="User: activate to sort column ascending" style="width: 8%;">类型</th>

                        <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                            colspan="1" aria-label="User: activate to sort column ascending" style="width: 30%;">所属组</th>

                        <th class="sorting" tabindex="0" aria-controls="example-datatable" rowspan="1"
                            colspan="1" aria-label="Email: activate to sort column ascending" style="width: 8%;">父级</th>

                        <th style="width: 173px;" class="sorting" tabindex="0" aria-controls="example-datatable"
                            rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">状态</th>

                        <th class="text-center sorting_disabled" style="width: 174px;" rowspan="1" colspan="1" aria-label="">
                            <i class="fa fa-flash"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $button_class = [
                            'btn btn-xs btn-warning',
                            'btn btn-xs btn-primary',
                            'btn btn-xs btn-success',
                            'btn btn-xs btn-info',
                        ];
                    ?>
                    <?php $name = config('app.'.session('laravel-gettext-locale'))?>
                    @foreach($list as $info)
                        <tr role="row" class="odd">
                            <td class="text-center sorting_1">{{ $info->id }}</td>
                            <td><strong>{{ $info->$name }}</strong></td>
                            <td>{{ $info->display_name }}</td>
                            {{--<td><strong>{{ $info->description }}</strong></td>--}}
                            <td>
                                <button class="{{ $button_class[$info->type +2] }}"
                                        onclick="window.location.href='{{
                                        $info->type ?
                                            $request->url().($request->getQueryString()? '?'.$request->getQueryString().'&type=1':'?type=1' )
                                            :$request->url().($request->getQueryString()? '?'.$request->getQueryString().'&type=0':'?type=0' )
                                        }}'"
                                >
                                    {{ config('manage.permission.type.'.$name)[$info->type] }}
                                </button>
                            </td>
                            <td>
                                @if($info->role)
                                    @foreach($info->role as $r)
                                        <button class="{{ $button_class[$r->id % 4] }}">{{ $r->$name }}</button>
                                    @endforeach
                                @endif
                            </td>
                            <?php
                            $label_class = [
                                'label label-warning',
                                'label label-primary',
                                'label label-success',
                                'label label-info',
                            ];
                            ?>
                            <td>
                                @if($info->parent)
                                    <span class="{{ $label_class[$info->parent ? ($info->parent->id+2) % 4 : 3] }}">
                                        {{ $info->parent ? $info->parent->$name : ""}}
                                    </span>
                                @endif
                            </td>
                            <td align="center">
                                <span class="label label-info">
                                    {{ config('manage.permission.status.'.$name)[$info->status] }}
                                </span>
                            </td>
                            <td class="text-center">

                                    <a href="{{ url('permissions/'.$info->id.'/edit') }}" data-toggle="tooltip" title=""
                                       class="btn btn-effect-ripple btn-xs btn-success" style="overflow: hidden; position: relative;"
                                       data-original-title="Edit" >
                                            <i class="fa fa-pencil"></i>
                                    </a>

                                <form style="display:inline-block" action="{{ url('permissions/'.$info->id) }}" method="post"
                                      id="destroy-{{ $info->id }}">
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
                                                    $('#destroy-{{ $info->id }}').submit()
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
                            <strong>{{ $list->perPage() * ($list->currentPage()-1) + 1 }}</strong>-
                            <strong>{{ $list->currentPage() == $list->lastPage() ? $list->total() :
                            $list->perPage() * $list->currentPage() }}</strong> of
                            <strong>{{ $list->total() }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-12 clearfix">
                        <div class="dataTables_paginate paging_bootstrap" id="example-datatable_paginate">
                            {!! $list->appends(['l'=>request('l')?:config('project.list.limit')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop