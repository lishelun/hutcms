<!--
  ~  +----------------------------------------------------------------------
  ~  | HUTCMS
  ~  +----------------------------------------------------------------------
  ~  | Copyright (c) 2022 http://hutcms.com All rights reserved.
  ~  +----------------------------------------------------------------------
  ~  | Licensed ( https://mit-license.org )
  ~  +----------------------------------------------------------------------
  ~  | Author: lishelun <lishelun@qq.com>
  ~  +----------------------------------------------------------------------
  -->

<script type="text/html" template>
    <link rel="stylesheet" href="{{ layui.setter.base }}style/login.css?v={{ layui.admin.v }}-1" media="all">
</script>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>HUTCMS</h2>
            <p>信息管理系统</p>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                       placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                               for="LAY-user-login-vercode"></label>
                        <input type="text" name="captcha" id="LAY-user-login-vercode" lay-verify="required"
                               placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="" class="layadmin-user-login-codeimg"
                                 id="LAY-user-get-vercode">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-normal layui-btn-fluid" lay-submit
                        lay-filter="LAY-user-login-submit">登 入
                </button>
            </div>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <a lay-href="/user/forget" class="layadmin-user-jump-change"
                   style="margin-top: 7px;color:#909399">忘记密码？</a>
            </div>
        </div>
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>©<a href="http://www.hutcms.com/">hutcms.com</a> All Rights Reserved</p>
    </div>
    <canvas id="canvas"></canvas>


<script src="/static/plugin/particle/particle-effect.js"></script>
<script>
    layui.use('user', layui.factory('user'));
</script>