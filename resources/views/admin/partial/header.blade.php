<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin">
                <b>
                    <img src="{{ asset('static/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                </b>
                <span> Admin Panel</span> </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('static/images/admin-avatar.png') }}" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li><a href="#"><i class="ti-settings"></i> Reset Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/admin/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>


<div class="modal fade" id="modal-reset" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">修改密码</h3>
                </div>
            </div>
            <form id="reset_form" class="form-horizontal" method="post">
                <div class="block-content">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="old-password" class="col-sm-2 control-label">旧密码</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="old-password" name="old-password">
                            <div id="error_msg" class="help-block text-right"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">新密码</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="password" name="password">
                            <div id="error_msg" class="help-block text-right"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="old-password" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                            <div id="error_msg" class="help-block text-right"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">取消</button>
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-check"></i> 保存</button>
                </div>
            </form>
            <div class="overlay-wrapper">
                <div id="loading_userinfo" class="overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</div>