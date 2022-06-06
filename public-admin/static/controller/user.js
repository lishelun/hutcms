/*
 *  +----------------------------------------------------------------------
 *  | HUTCMS
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2022 http://hutcms.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://mit-license.org )
 *  +----------------------------------------------------------------------
 *  | Author: lishelun <lishelun@qq.com>
 *  +----------------------------------------------------------------------
 */

layui.define('form', function (exports) {

    var $body = $('body');

    //自定义验证
    form.verify({
        nickname: function (value, item) { //value：表单的值、item：表单的DOM对象
            if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                return '用户名不能有特殊字符';
            }
            if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                return '用户名首尾不能出现下划线\'_\'';
            }
            if (/^\d+\d+\d$/.test(value)) {
                return '用户名不能全为数字';
            }
        }

        //我们既支持上述函数式的方式，也支持下述数组的形式
        //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
        , pass: [
            /^[\S]{6,12}$/
            , '密码必须6到12位，且不能出现空格'
        ]
    });

    function getCaptcha() {
        request({url: "user/captcha?t=" + new Date().getTime()}).then((res) => {
            if (res.code === 0) $("#LAY-user-get-vercode").attr("src", res.data.captcha);
        });
    }

    getCaptcha();
    //更换图形验证码
    $body.on('click', '#LAY-user-get-vercode', function () {
        getCaptcha();
    });
    layui.use(['form','setter','admin'],function(){
        const form=layui.form,setter=layui.setter,admin=layui.admin  ,router = layui.router()
        ,search = router.search;
        form.render();
        form.on('submit(LAY-user-login-submit)', function (obj) {
            request({url: "user/login", method: "post", data: obj.field}).then(
                (res) => {
                    if (res.code === 0) {
                        layui.data(setter.tableName, {
                            key: setter.request.tokenName
                            , value: res.data.token
                        });
                        layer.msg('登入成功', {
                            offset: '20px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            location.hash = search.redirect ? decodeURIComponent(search.redirect) : '/';
                            getCaptcha();
                        });
                    } else {
                        getCaptcha();
                        layer.msg(res.msg, {offset: '20px', icon: 2, time: 3000});
                    }
                }
            );
        });
    })
    ParticleEffect.run({});
    //对外暴露的接口
    exports('user', {});
});