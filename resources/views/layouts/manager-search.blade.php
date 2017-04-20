<div class="col-sm-6 col-xs-7">
    <div id="example-datatable_filter" class="dataTables_filter">
        <form action="" method="get" id="search-form">
            <label>
                <div class="input-group">
                    <input name="keywords" type="search" class="form-control" placeholder="Search"
                           aria-controls="example-datatable" value="{{request('keywords')}}" />
                        <span class="input-group-addon" onclick="$('#search-form').submit();">
                            <i class="fa fa-search"></i>
                        </span>
                </div>
            </label>
        </form>
    </div>
</div>