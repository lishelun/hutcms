<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>后台管理 - HUTCMS</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="./static/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="./static/style/admin.css" media="all">
  <link rel="stylesheet" href="./static/hutcms/css/admin.css" media="all">
  <link rel="stylesheet" href="./static/iconfont/iconfont.css" media="all">
</head>
<body>
  <div id="LAY_app"></div>
  <script src="./static/layui/layui.js"></script>
  <script src="./static/plugin/axios/axios.min.js"></script>
  <script src="./static/plugin/require/require.min.js"></script>
  <script src="./static/hutcms/js/admin.js"></script>
  <script>
  layui.config({
    base: window.baseRoot //指定 layuiAdmin 项目路径，本地开发用 src，线上用 dist
    ,version: '1.7.2'
  }).use('index');
  </script>
</body>
</html>