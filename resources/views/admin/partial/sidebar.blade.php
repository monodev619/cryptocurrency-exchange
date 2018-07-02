<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li> <a class="waves-effect waves-dark {{ strcmp(Request::path(), 'admin') == 0 ? 'active' : '' }}" href="{{ url('/admin') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Home</span></a></li>
                <li> <a class="waves-effect waves-dark {{ str_contains(Request::path(), 'admin/user') ? 'active' : '' }}" href="{{ url('/admin/users') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-store"></i><span class="hide-menu">Market</span></a>
                    <ul aria-expanded="{{ str_contains(Request::path(), 'admin/trade') ? 'true' : 'false' }}" class="{{ str_contains(Request::path(), 'admin/trade') ? 'collapse in' : 'collapse' }}">
                        <li><a class="{{ str_contains(Request::path(), 'admin/trade/orders') ? 'active' : '' }}" href="{{ url('/admin/trade/orders') }}">Order</a></li>
                        <li><a class="{{ str_contains(Request::path(), 'admin/trade/transactions') ? 'active' : '' }}" href="{{ url('/admin/trade/transactions') }}">Transaction</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Wallet</span></a>
                    <ul aria-expanded="{{ str_contains(Request::path(), 'admin/wallet') ? 'true' : 'false' }}" class="{{ str_contains(Request::path(), 'admin/wallet') ? 'collapse in' : 'collapse' }}">
                        <li><a class="{{ str_contains(Request::path(), 'admin/wallet/deposits') ? 'active' : '' }}" href="{{ url('/admin/wallet/deposits') }}">Deposit</a></li>
                        <li><a class="{{ str_contains(Request::path(), 'admin/wallet/withdrawals') ? 'active' : '' }}" href="{{ url('/admin/wallet/withdrawals') }}">Withdrawal</a></li>
                    </ul>
                </li>
                {{--<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-box"></i><span class="hide-menu">其他设置</span></a>--}}
                    {{--<ul aria-expanded="{{ str_contains(Request::path(), 'admin/other') ? 'true' : 'false' }}" class="{{ str_contains(Request::path(), 'admin/other') ? 'collapse in' : 'collapse' }}">--}}
                        {{--<li><a class="{{ str_contains(Request::path(), 'admin/other/app') ? 'active' : '' }}" href="{{ url('/admin/other/app') }}">App设置</a></li>--}}
                        {{--<li><a class="{{ str_contains(Request::path(), 'admin/other/home') ? 'active' : '' }}" href="{{ url('/admin/other/home') }}">首页设置</a></li>--}}
                        {{--<li><a class="{{ str_contains(Request::path(), 'admin/other/project') ? 'active' : '' }}" href="{{ url('/admin/other/project') }}">项目设置</a></li>--}}
                        {{--<li><a class="{{ str_contains(Request::path(), 'admin/other/article') ? 'active' : '' }}" href="{{ url('/admin/other/article') }}">文章设置</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--@if(admin()->role == 0)--}}
                {{--<li> <a class="waves-effect waves-dark {{ str_contains(Request::path(), 'admin/manager') ? 'active' : '' }}" href="{{ url('/admin/manager') }}" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">管理员目录</span></a></li>--}}
                {{--@endif--}}

            </ul>
        </nav>
    </div>
</aside>