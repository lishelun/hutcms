<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UI颜色</title>
    <link rel="stylesheet" href="http://static.24en.com/layui/css/layui.css">
    <script src="http://static.24en.com/layui/layui.js"></script>
    <script src="http://static.24en.com/js/jquery.min.js"></script>
    <style>
.site-h1 {
    margin-bottom: 20px;
    line-height: 60px;
    padding-bottom: 10px;
    color: #393D49;
    border-bottom: 1px solid #eee;
    font-size: 28px;
    font-weight: 300;
}

.site-title {
    margin: 30px 0 20px;
}

.site-doc-color {
    font-size: 0;
}

.site-doc-color li {
    display: inline-block;
    vertical-align: middle;
    width: 185px;
    margin-left: 20px;
    margin-bottom: 20px;
    padding: 20px 10px;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    line-height: 22px;
    font-size: 14px;
}

.site-doc-color li p[tips] {
    opacity: 0.8;
    font-size: 12px;
}

.site-doc-necolor li {
    width: 108px;
    margin-top: 15px;
    margin-left: 0;
    border-radius: 0;
}

.site-doc-bgcolor li {
    padding: 10px;
}

.site-text {
    position: relative;
}
    </style>
</head>

<body>
    <div class="layui-container">
        <h1 class="site-h1">颜色设计感</h1>
        <blockquote class="layui-elem-quote">视觉疲劳的形成往往是由于颜色过于丰富或过于单一形成的麻木感，而 layui 提供的颜色，清新而不乏深沉，互相柔和，不过分刺激大脑皮层的神经反应，形成越久越耐看的微妙影像。合理搭配，可与各式各样的网站避免违和，从而使你的Web平台看上去更为融洽。</blockquote>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">常用主色</a>
            </legend>
        </fieldset>
        <ul class="site-doc-color">
            <li style="background-color: #009688;">
                <p>#009688</p>
                <p></p>
                <p tips="">通常用于按钮、及任何修饰元素</p>
            </li>
            <li style="background-color: #5FB878;">
                <p>#5FB878</p>
                <p></p>
                <p tips="">一般用于选中状态</p>
            </li>
            <li style="background-color: #393D49;">
                <p>#393D49</p>
                <p></p>
                <p tips="">通常用于导航</p>
            </li>
            <li style="background-color: #1E9FFF;">
                <p>#1E9FFF</p>
                <p></p>
                <p tips="">比较适合一些鲜艳色系的页面</p>
            </li>
        </ul>
        <div class="site-text">
            <p>layui 主要是以象征包容的墨绿作为主色调，由于它给人以深沉感，所以通常会以浅黑色的作为其陪衬，又会以蓝色这种比较鲜艳的色调来弥补它的色觉疲劳，整体让人清新自然，愈发耐看。【取色意义】：我们执着于务实，不盲目攀比，又始终不忘绽放活力。这正是 layui 所追求的价值。</p>
        </div>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">场景色</a>
            </legend>
        </fieldset>
        <ul class="site-doc-color">
            <li style="background-color: #FFB800;">
                <p>#FFB800</p>
                <p></p>
                <p tips="">暖色系，一般用于提示性元素</p>
            </li>
            <li style="background-color: #FF5722;">
                <p>#FF5722</p>
                <p></p>
                <p tips="">比较引人注意的颜色</p>
            </li>
            <li style="background-color: #01AAED;">
                <p>#01AAED</p>
                <p></p>
                <p tips="">用于文字着色，如链接文本</p>
            </li>
            <li style="background-color: #2F4056;">
                <p>#2F4056</p>
                <p></p>
                <p tips="">侧边或底部普遍采用的颜色</p>
            </li>
        </ul>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">中性色</a>
            </legend>
        </fieldset>
        <p>他们一般用于背景、边框等</p>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #fbfbfb; color: #000;">
                <p>#F0F0F0</p>
                <p></p>
            </li>
            <li style="background-color: #f2f2f2; color: #000;">
                <p>#f2f2f2</p>
                <p></p>
            </li>
            <li style="background-color: #eeeeee; color: #000;">
                <p>#eeeeee</p>
                <p></p>
            </li>
            <li style="background-color: #e2e2e2; color: #000;">
                <p>#e2e2e2</p>
                <p></p>
            </li>
            <li style="background-color: #dddddd; color: #000;">
                <p>#dddddd</p>
                <p></p>
            </li>
            <li style="background-color: #d2d2d2; color: #000;">
                <p>#d2d2d2</p>
                <p></p>
            </li>
            <li style="background-color: #c2c2c2;">
                <p>#c2c2c2</p>
                <p></p>
            </li>
        </ul>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">Layui背景色</a>
            </legend>
        </fieldset>
        <ul class="site-doc-bgcolor">
            <li class="layui-bg-red">赤色：class="layui-bg-red" #FF5722</li>
            <li class="layui-bg-orange">橙色：class="layui-bg-orange" #FFB800</li>
            <li class="layui-bg-green">墨绿：class="layui-bg-green" #009688</li>
            <li class="layui-bg-cyan">藏青：class="layui-bg-cyan" #2F4056</li>
            <li class="layui-bg-blue">蓝色：class="layui-bg-blue" #1E9FFF</li>
            <li class="layui-bg-black">雅黑：class="layui-bg-black" #393D49</li>
            <li class="layui-bg-gray">银灰：class="layui-bg-gray" #eee</li>
        </ul>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">BOOTSTRAP COLORS</a>
            </legend>
        </fieldset>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #e6e6e6; color: #000;">
                <p>#e6e6e6</p>
            </li>
            <li style="background-color: #adadad; color: #000;">
                <p>#adadad</p>
            </li>
            <li style="background-color: #f5f5f5; color: #000;">
                <p>#f5f5f5</p>
            </li>
            <li style="background-color: #c7254e; color: #000;">
                <p>#c7254e</p>
            </li>
            <li style="background-color: #f7f7f9; color: #000;">
                <p>#f7f7f9</p>
            </li>
            <li style="background-color: #23527c;">
                <p>#23527c link</p>
                <p></p>
            </li>
        </ul>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #5cb85c;">
                <p>#5cb85c</p>
                <p></p>
            </li>
            <li style="background-color: #4cae4c;">
                <p>#4cae4c</p>
                <p></p>
            </li>
            <li style="background-color: #2b542c;">
                <p>#2b542c</p>
                <p></p>
            </li>
        </ul>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #337ab7; color: #fff;">
                <p>#337ab7</p>
            </li>
            <li style="background-color: #2e6da4; color: #fff;">
                <p>#2e6da4</p>
            </li>
            <li style="background-color: #286090; color: #fff;">
                <p>#286090</p>
            </li>
            <li style="background-color: #31b0d5;">
                <p>#31b0d5</p>
                <p></p>
            </li>
            <li style="background-color: #269abc;">
                <p>#269abc</p>
                <p></p>
            </li>
            <li style="background-color: #245269;">
                <p>#245269</p>
                <p></p>
            </li>
        </ul>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #f0ad4e;">
                <p>#f0ad4e</p>
                <p></p>
            </li>
            <li style="background-color: #eea236;">
                <p>#eea236</p>
                <p></p>
            </li>
            <li style="background-color: #ec971f;">
                <p>#ec971f</p>
                <p></p>
            </li>
            <li style="background-color: #d9534f;">
                <p>#d9534f</p>
                <p></p>
            </li>
            <li style="background-color: #d43f3a;">
                <p>#d43f3a</p>
                <p></p>
            </li>
            <li style="background-color: #c9302c;">
                <p>#c9302c</p>
                <p></p>
            </li>
        </ul>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">ALIYUN COLORS</a>
            </legend>
        </fieldset>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #00b7d3;">
                <p>#00b7d3</p>
            </li>
            <li style="background-color: #08c;">
                <p>#08c</p>
            </li>
            <li style="background-color: #00C1DE;">
                <p>#00C1DE</p>
            </li>
            <li style="background-color: #1996e6;">
                <p>#1996e6</p>
            </li>
            <li style="background-color: #33cde5;">
                <p>#33cde5</p>
            </li>
            <li style="background-color: #24B1FF;">
                <p>#24B1FF</p>
            </li>
            <li style="background-color: #373d41;">
                <p>#373d41</p>
            </li>
            <li style="background-color: #42485b;">
                <p>#42485b</p>
            </li>
            <li style="background-color: #f90;">
                <p>#f90</p>
            </li>
            <li style="background-color: #8a6d3b;">
                <p>#8a6d3b</p>
            </li>
        </ul>
        <fieldset class="layui-elem-field layui-field-title site-title">
            <legend><a name="color-design">OUR COLORS</a>
            </legend>
        </fieldset>
        <ul class="site-doc-color site-doc-necolor">
            <li style="background-color: #4194ca;color:#000">
                <p>#4194ca</p>
            </li>
            <li style="background-color: #31adb9;color:#000">
                <p>#31adb9</p>
            </li>
            <li style="background-color: #75d9b5; color:#000">
                <p>#75d9b5</p>
            </li>
            <li style="background-color: #bae3c3; color:#000">
                <p>#bae3c3</p>
            </li>
            <li style="background-color: #efffd0; color:#000">
                <p>#efffd0</p>
            </li>
            <li style="background-color: #25c7a4; color:#000">
                <p>#25c7a4</p>
            </li>
            <li style="background-color: #f6f6f6; color:#000">
                <p>#f6f6f6</p>
            </li>
            <li style="background-color: #F5F6FA; color:#000">
                <p>#F5F6FA</p>
            </li>
            <li style="background-color: #e1e6eb; color:#000">
                <p>#e1e6eb</p>
            </li>
            <li style="background-color: #373d41; color:#000">
                <p>#373d41</p>
            </li>
            <li style="background-color: #06C; color:#000">
                <p>#06C</p>
            </li>
            <li style="background-color: #1170CF; color:#000">
                <p>#1170CF</p>
            </li>
            <li style="background-color: #428bca; color:#000">
                <p>#428bca</p>
            </li>

            <li style="background-color: #4BECBC; color:#000">
                <p>#4BECBC</p>
            </li>
            <li style="background-color: #00D8BF; color:#000">
                <p>#00D8BF</p>
            </li>
            <li style="background-color: #FF634C; color:#000">
                <p>#FF634C</p>
            </li>
            <li style="background-color: #F00; color:#000">
                <p>#F00</p>
            </li>

            <li style="background-color: #FF9D29; color:#000">
                <p>#FF9D29</p>
            </li>
            <li style="background-color: #ff9900; color:#000">
                <p>#ff9900</p>
            </li>
            <li style="background-color: #ff6600; color:#000">
                <p>#ff6600</p>
            </li>
            <li style="background-color: #ff9600; color:#000">
                <p>#ff9600</p>
            </li>



            <li style="background-color: #00a0c7; color:#000">
                <p>#00a0c7</p>
            </li>
            <li style="background-color: #00c1de; color:#000">
                <p>#00c1de</p>
            </li>
            <li style="background-color: #3CF; color:#000">
                <p>#3CF</p>
            </li>
            <li style="background-color: #47A6E9; color:#000">
                <p>#47A6E9</p>
            </li>

            <li style="background-color: #23CBFF; color:#000">
                <p>#23CBFF</p>
            </li>
            <li style="background-color: #66C7DF; color:#000">
                <p>#66C7DF</p>
            </li>
            <li style="background-color: #00a2ca; color:#000">
                <p>#00a2ca</p>
            </li>
            <li style="background-color: #9cddf5; color:#000">
                <p>#9cddf5</p>
            </li>
            <li style="background-color: #00a2ca; color:#000">
                <p>#33b5d4</p>
            </li>

        </ul>
    </div>
</body>

</html>