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

/*! 数组兼容处理 */
if (typeof Array.prototype.some !== 'function') {
    Array.prototype.some = function (callable) {
        for (var i in this) if (callable(this[i], i, this) === true) {
            return true;
        }
        return false;
    };
}
if (typeof Array.prototype.every !== 'function') {
    Array.prototype.every = function (callable) {
        for (var i in this) if (callable(this[i], i, this) === false) {
            return false;
        }
        return true;
    };
}
if (typeof Array.prototype.forEach !== 'function') {
    Array.prototype.forEach = function (callable, context) {
        typeof context === "undefined" ? context = window : null;
        for (var i in this) callable.call(context, this[i], i, this)
    };
}

/*! 应用根路径，静态插件库路径，动态插件库路径 */
const srcs = document.scripts[document.scripts.length - 1].src.split('/');
window.appRoot = srcs.slice(0, -4).join('/') + '/';
window.baseRoot = srcs.slice(0, -3).join('/') + '/';
window.tapiRoot = window.tapiRoot || window.appRoot + "admin";
console.log('baseroot:',baseRoot);
/*! 挂载 layui & jquery 对象 */
// layui.config({base: baseRoot + 'plugin/layui_exts/'});
window.form = layui.form;
window.layer = layui.layer;
window.laytpl = layui.laytpl;
window.laydate = layui.laydate;
window.jQuery = window.$ = window.jQuery || window.$ || layui.$;
require.config({
    baseUrl: baseRoot,
    waitSeconds: 60,
    map: {'*': {css: baseRoot + 'plugin/require/css.js'}},
    paths: {
        'vue': ['plugin/vue/vue.min'],
        // 'axios': ['plugin/axios/axios.min'],
        'md5': ['plugin/jquery/md5.min'],
        'json': ['plugin/jquery/json.min'],
        'xlsx': ['plugin/jquery/xlsx.min'],
        'excel': ['plugin/jquery/excel.xlsx'],
        'base64': ['plugin/jquery/base64.min'],
        'upload': [tapiRoot + '/api.upload/index?'],
        'notify': ['plugin/notify/notify.min'],
        'angular': ['plugin/angular/angular.min'],
        'cropper': ['plugin/cropper/cropper.min'],
        'echarts': ['plugin/echarts/echarts.min'],
        'ckeditor4': ['plugin/ckeditor4/ckeditor'],
        'ckeditor5': ['plugin/ckeditor5/ckeditor'],
        'websocket': ['plugin/socket/websocket'],
        'pcasunzips': ['plugin/jquery/pcasunzips'],
        'sortablejs': ['plugin/sortable/sortable.min'],
        'vue.sortable': ['plugin/sortable/vue.draggable.min'],
        'jquery.ztree': ['plugin/ztree/ztree.all.min'],
        'jquery.masonry': ['plugin/jquery/masonry.min'],
        'jquery.cropper': ['plugin/cropper/cropper.min'],
        'jquery.autocompleter': ['plugin/jquery/autocompleter.min'],
    }, shim: {
        'excel': {deps: [baseRoot + 'plugin/layui_exts/excel.js']},
        'notify': {deps: ['css!' + baseRoot + 'plugin/notify/light.css']},
        'cropper': {deps: ['css!' + baseRoot + 'plugin/cropper/cropper.min.css']},
        'websocket': {deps: [baseRoot + 'plugin/socket/swfobject.min.js']},
        'ckeditor5': {deps: ['jquery', 'upload', 'css!' + baseRoot + 'plugin/ckeditor5/ckeditor.css']},
        'vue.sortable': {deps: ['vue', 'sortablejs']},
        'jquery.ztree': {deps: ['jquery', 'css!' + baseRoot + 'plugin/ztree/zTreeStyle/zTreeStyle.css']},
        'jquery.autocompleter': {deps: ['jquery', 'css!' + baseRoot + 'plugin/jquery/autocompleter.css']},
    }
});


/*! 注册 jquery 组件 */
define('jquery', [], function () {
    return layui.$;
});

/*! 注册 ckeditor 组件 */
define('ckeditor', (function (type) {
    if (/^ckeditor[45]$/.test(type)) return [type];
    return [Object.fromEntries ? 'ckeditor5' : 'ckeditor4'];
})(window.taEditor || 'ckeditor4'), function (ckeditor) {
    return ckeditor;
});



