<?php

$isget = $_POST['act'];
$iscode = (int)$_POST['iscode'];
function get_code($str , $label = 'item' , $display = 'block' , $word = '' , $must = '' , $pla = '')
{
    $display = $word ? 'inline' : $display;
    $display = $display ? $display : 'block';
    $label = $label ? $label : 'item';
    $word = $word ? '<div class="layui-form-mid layui-word-aux">' . $word . '</div>' : '';
    $html = '
                <div class="layui-form-item">
                    <label class="layui-form-label">' . $label . '</label>
                    <div class="layui-input-' . $display . '">
                        ' . $str . '
                    </div>' . $word . '			    
                </div>
';
    $html = str_replace('[ismust]' , $must ? ' required lay-verify="required"' : '' , $html);
    $html = str_replace('[pla]' , $pla ? ' placeholder="' . $pla . '"' : '' , $html);
    return $html;
}

function fomart_value($type , $name , $value)
{
    $value = str_replace("\n" , '&' , $value);
    $r = explode('&' , $value);
    $c = count($r);
    $str = '';
    $c = $c == 0 ? 1 : $c;
    for ( $i = 0 ; $i < $c ; $i++ ) {
        $rr = explode('==' , $r[$i]);
        $d_val = $rr[0];
        $v_val = $d_val;
        $vr = explode(':' , $rr[1]);
        $v_name = $vr[0];
        // $v_name=$v_name?$v_name:$v_val;
        $vmod = $vr[1];
        $v_default = $vmod == 'default' ? ' checked' : '';
        $v_disabled = $vmod == 'disable' ? ' disabled' : '';
        if ( $type == 'input.text' || $type == 'input.password' ) {
            $v_val = '{$r.' . $name . '??\'' . $d_val . '\'}';
            $stype = $type == 'input.text' ? 'text' : 'password';
            $str .= '<input type="' . $stype . '" name="' . $name . '" id="' . $name . '" value="' . $v_val . '" class="layui-input" [pla] [ismust] />';
        }

        if ( $type == 'radio' || $type == 'input.radio' ) {
            $v_default = '{:isset($r[\'' . $name . '\'])?($r[\'' . $name . '\']==\'' . $d_val . '\'?\' checked\':\'\'):\'' . $v_default . '\'}';
            $str .= '<input type="radio" name="' . $name . '" id="' . $name . '" value="' . $v_val . '" ' . $v_default . '' . $v_disabled . ' title="' . $v_name . '">';
        } elseif ( $type == 'checkbox' || $type == 'checkbox.switch' || $type == 'input.checkbox' || $type == 'checkbox.primary' ) {
            $v_default = '{:isset($r[\'' . $name . '\'])?($r[\'' . $name . '\']==\'' . $d_val . '\'?\' checked\':\'\'):\'' . $v_default . '\'}';
            if ( $type == 'checkbox.switch' ) {
                $laytext = ' lay-text="' . $v_name . '"';
                $laytitle = ' title="' . $v_name . '"';
                $switch = ' lay-skin="switch"';
            } else {
                $laytext = ' lay-text="' . $v_name . '"';
                $laytitle = ' title="' . $v_name . '"';
                $switch = '';
            }
            if ( $type == 'checkbox.primary' ) {
                $primary = ' lay-skin="primary"';
            }
            $str .= '<input type="checkbox" name="' . $name . '" id="' . $name . '" value="' . $v_val . '" ' . $v_default . '' . $v_disabled . ' ' . $laytitle . $laytext . '' . $switch . $primary . '>';
        } elseif ( $type == 'select' || $type == 'select.search' ) {
            $v_default = $v_default ? ' selected' : '';
            $v_default = '{:isset($r[\'' . $name . '\'])?($r[\'' . $name . '\']==\'' . $d_val . '\'?\' selected\':\'\'):\'' . $v_default . '\'}';
            $str .= '<option value="' . $v_val . '" ' . $v_default . '' . $v_disabled . '>' . $v_name . '</option>';
        } elseif ( $type == 'textarea' ) {
            $v_val = '{$r.' . $name . '??\'' . $d_val . '\'}';
            $str .= '<textarea name="' . $name . '" id="' . $name . '" [pla] [ismust] class="layui-textarea">' . $v_val . '</textarea>';
        }


    }
    return $str;
}

function exe_code($line = '')
{
    if ( !$line ) return '';
    //??????>?????????>label>??????>display>word?????????
    $m = explode('@' , $line);
    if ( $m[1] == 'r' || $m[1] == 'required' || $m[1] == 'must' ) {
        $muststr = ' required lay-verify="required"';
        $ismust = true;
        $line = $m[0];
    }
    $p = explode('#' , $line);
    if ( $p[1] ) {
        $pla = $p[1];
        $line = $p[0];
    }
    $r = explode('>' , $line);
    $rr = explode('.' , $r[0]);
    $sel = trim($r[0]);
    $mode = trim($rr[0]);
    $type = trim($rr[1]);

    $name = $item = $r[1];
    $label = $r[2];
    $value = $r[3];
    $display = $r[4];
    $word = $r[5];
    if ( $mode == 'input' ) {
        $type = $type ? $type : 'text';
        if ( $type == 'text' || $type == 'password' ) {
            $stype = $type == 'text' ? 'input.text' : 'input.password';
            return get_code(fomart_value($stype , $name , $value) , $label , $display , $word , $ismust , $pla);
        } elseif ( $type == 'hidden' ) {
//            $value = $value ? ' value="' . $value . '"' : '';
            $value = '{$r.' . $item . '??\'' . $value . '\'}';
            // return '<input type="'.$type.'" name="'.$item.'" id="'.$item.'"'.$value.' class="layui-input"'.$muststr.'/>';
            return '			  <input type="' . $type . '" name="' . $item . '" id="' . $item . '" value="' . $value . '" />' . "\n";
        } elseif ( $type == 'radio' ) {
            return get_code(fomart_value('radio' , $name , $value) , $label , $display , $word , $ismust , $pla);
        } elseif ( $type == 'checkbox' ) {
            return get_code(fomart_value($sel , $name , $value) , $label , $display , $word , $ismust , $pla);
        } elseif ( $type == 'textarea' ) {
            return get_code(fomart_value('textarea' , $name , $value) , $label , $display , $word , $ismust , $pla);
        }

    } elseif ( $mode == 'radio' ) {
        return get_code(fomart_value('radio' , $name , $value) , $label , $display , $word , $ismust , $pla);
    } elseif ( $mode == 'select' ) {
        $option = fomart_value('select' , $name , $value);
        $laysearch = $type == 'search' ? ' lay-search' : '';
        $ignore = $type == 'ignore' ? ' lay-ignore' : '';
        return get_code('<select name="' . $name . '" id="' . $name . '" lay-filter="' . $name . '"' . $laysearch . '' . $ignore . $muststr . '>' . $option . '</select>' , $label , $display , $word);

    } elseif ( $mode == 'checkbox' ) {
        return get_code(fomart_value($sel , $name , $value) , $label , $display , $word , $ismust , $pla);
    } elseif ( $mode == 'textarea' ) {
        return get_code(fomart_value('textarea' , $name , $value) , $label , $display , $word , $ismust , $pla);
    }

}

if ( $iscode == 1 ) {

    $code = $_POST['code'];
    $lr = explode("\n" , $code);
    $count = count($lr);
    $str = '';
    for ( $i = 0 ; $i <= $count ; $i++ ) {
        $str .= exe_code(trim($lr[$i]));
    }
    $str = !$str ? '????????????????????????????????????' : $str;

    $res = array();
    $res['html'] = $str;
    $res['linenum'] = $count;
    echo json_encode($res);
    die;


}

if ( $isget == 'getlayui' ) {
    $name = $_POST['item'] ? $_POST['item'] : 'item';
    $type = $_POST['type'];
    $ismust = $_POST['ismust'];
    $pla = $_POST['pla'];
    $value = $_POST['value'];
//    $value = '{$' . $name . '??\'' . $value . '\'}';
    $display = $_POST['display'] == 'block' ? 'block' : 'inline';
    $label = $_POST['label'] ? $_POST['label'] : 'field';
    $must = '';
    $isword = $_POST['isword'];
    $word = $isword ? '' . $_POST['word'] . '' : '';
    $display = $isword ? 'inline' : $display;
    $laysearch = $_POST['islaysearch'] ? ' lay-search' : '';
    $ignore = $_POST['ignore'] ? ' lay-ignore' : '';


    if ( $ismust ) {
        $must = 'required lay-verify="required"';
    }
    if ( $pla ) {
        $pla = 'placeholder="' . $pla . '"';
    }

    if ( $type == 'text' || $type == 'password' ) {
        $value = '{$r[\'' . $name . '\']??\'' . $value . '\'}';
        $str = '<input type="' . $type . '" name="' . $name . '" id="' . $name . '" ' . $must . ' ' . $pla . ' value="' . $value . '" class="layui-input" />';
    }
    if ( $type == 'select' ) {
        $option = fomart_value('select' , $name , $value);
        $str = '<select name="' . $name . '" id="' . $name . '" ' . $must . ' lay-filter="' . $name . '"' . $laysearch . '' . $ignore . '>' . $option . '</select>';
    }
    if ( $type == 'radio' ) {
        $str = fomart_value('radio' , $name , $value);
    }
    if ( $type == 'checkbox' ) {
        if ( $_POST['isswitch'] ) $checkbox = 'checkbox.switch';
        else if ( $_POST['isprimary'] ) $checkbox = 'checkbox.primary';
        else $checkbox = 'checkbox';
        $str = fomart_value($checkbox , $name , $value);
    }
    if ( $type == 'button' ) {
        $btn_size = $_POST['btn_size'] == 'btn' ? '' : ' layui-btn-' . $_POST['btn_size'];
        $btn_style = $_POST['btn_style'] == 'btn' ? '' : ' layui-btn-' . $_POST['btn_style'];
        $btn_type = $_POST['btn_type'];
        $btn_fluid = (int)$_POST['btn_fluid'] ? ' layui-btn-fluid' : '';
        $btn_radius = (int)$_POST['btn_radius'] ? ' layui-btn-radius' : '';

        $btn_temp = '';
        if ( $btn_type == 'a' ) {
            $btn_temp = '<a href="javascript:void(0)" id="[item]" class="layui-btn[btn_style][btn_size][btn_fluid][btn_radius][btn_disable]">[bname]</a>';
        } elseif ( $btn_type == 'button' ) {
            $btn_temp = '<button onclick="javascript:void(0)" name="[item]" id="[item]" class="layui-btn[btn_style][btn_size][btn_fluid][btn_radius][btn_disable]">[bname]</button>';
        } else {
            $btn_temp = '<input type="button" name="[item]" id="[item]" onclick="javascript:void(0)" class="layui-btn[btn_style][btn_size][btn_fluid][btn_radius][btn_disable]" value="[bname]">';
        }
        function get_btn_temp($btn_temp , $item = '' , $bname = '' , $btn_isdisable = 0)
        {
            $btn_disable = $btn_isdisable ? ' layui-btn-disabled' : '';
            global $btn_size , $btn_type , $btn_style , $btn_fluid , $btn_radius , $name;
            $item = $item ? $item : $name;
            $bname = $bname ? $bname : $name;
            $temp = str_replace('[btn_size]' , $btn_size , $btn_temp);
            $temp = str_replace('[btn_style]' , $btn_style , $temp);
            $temp = str_replace('[btn_fluid]' , $btn_fluid , $temp);
            $temp = str_replace('[btn_radius]' , $btn_radius , $temp);
            $temp = str_replace('[btn_disable]' , $btn_disable , $temp);
            $temp = str_replace('[item]' , $item , $temp);
            $temp = str_replace('[bname]' , $bname , $temp);
//            $temp = str_replace('[value]' , $val , $temp);
            return $temp;
        }

        //item==?????????
        if ( !empty($value) ) {
            $vr = explode("\n" , $value);
            $c = count($vr);
            for ( $i = 0 ; $i < $c ; $i++ ) {
                $rr = explode('==' , $vr[$i]);
                $btn_isdisable = strstr($rr[1] , 'disable') ? 1 : 0;
                $vrr = explode(':' , $rr[1]);
                $item = $rr[0];
                $btn_name = $vrr[0];
                $str .= get_btn_temp($btn_temp , $item , $btn_name , $btn_isdisable);

            }
        } else {
            $bname = $label;
            $item = $name;
            $btn_isdisable=0;
            $str .= get_btn_temp($btn_temp , $item , $bname , $btn_isdisable);
        }


    }
    $html = get_code($str , $label , $display , $word , $ismust , $pla);
    if ( $type == 'button' ) $html = $str;
    if ( $type == 'textarea' ) {
        $html = get_code(fomart_value('textarea' , $name , $value) , $label , $display , $word , $ismust , $pla);;
    }
    if ( $type == 'captcha' ) {
        $html = '
			  <div class="layui-form-item">
			    <label class="layui-form-label">' . $label . '</label>
			    <div class="layui-input-inline">
			      <input type="text" name="' . $name . '" id="' . $name . '" ' . $pla . ' ' . $must . ' autocomplete="off" class="layui-input">			      
			    </div>
			    <img src="/ShowKey?v=checkkey" name="KeyImg" id="KeyImg" align="bottom" onclick="KeyImg.src=\'/ShowKey?v=checkkey&t=\'+Math.random()" alt="????????????,????????????" style="height:38px;width:150px;">
			  </div>

';
    }
    if ( $type == 'form' ) {
        $pane = $_POST['ispane'] ? ' layui-form-pane' : '';
        $html = '
<form class="layui-form' . $pane . '" name="' . $name . '" id="' . $name . '" action=""  method="POST">
  <div class="layui-form-item" pane>
    <label class="layui-form-label">?????????</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="???" title="???">
      <input type="radio" name="sex" value="???" title="???" checked>
    </div>
  </div>
</form>';
    }
    $res = array();
    $res['html'] = $html;
    echo json_encode($res);
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta id="viewport" name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <title>LayUI???????????????????????? - ????????????</title>
    <link rel="stylesheet" href="https://www.layuicdn.com/layui/css/layui.css">
    <script src="https://www.layuicdn.com/layui/layui.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="description"
          content="??????LAYUI??????????????????,????????????????????????????????????????????????????????????input,select,textarea,button????????????????????????????????????,??????????????????????????????."/>
    <meta name="keywords" content="layui,layui??????,layui????????????,layui??????????????????,????????????,????????????"/>

    <style>
        .btn_mode_hide {
            display: none;
        }

        .layui-btn.layui-this {
            background: #5FB878;
            border-color: #5FB878;
            color: #fff;
        }

        .layui-input-block p {
            line-height: 36px;
        }

        .footer {
            margin-top: 50px;
            clear: both;
            overflow: hidden;
            padding: 20px 0;
            background-color: #2F4056;
            height: auto;
            position: relative;
            bottom: 0;
            margin-bottom: 0;
            width: 100%;
        }

        .footer.logo {
            margin-top: 20px;
            text-align: center;
        }

        .footer.text {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #486080;
        }

        .footer.text P {
            line-height: 20px;
        }

        .footer.text p a {
            color: #486080;
        }

        .footer.text p a:hover {
            color: #01AAED;
        }

        .footer.logo.layui-icon {
            font-size: 30px;
            color: #668dc1;
        }

        .line {
            width: 100%;
            border-bottom: 1px solid #d2d2d2;
            height: 1px;
            margin: 20px 0;
        }

        .main {
        }

        #tool-base {
            display: block;
        }

        #tool-code {
            display: none;
        }
    </style>
</head>
<body>
<div class="layui-container main">
    <div class="layui-row" style="margin-top:20px">
        <div class="layui-col-md4 layui-col-md-offset4">
            <h1>LayUI????????????????????????</h1>
        </div>
    </div>
    <div class="line"></div>
    <div class="layui-row layui-col-space20">
        <div class="layui-col-md7">
            <form class="layui-form" action="layui.php" method="POST" id="tool-code">
                <div class="layui-form-item" id="value_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
			      <textarea type="text" name="code" id="code"
                            placeholder="
???:?????????????????????
???????????????????????????form????????????
??????????????????,????????????
??????>?????????>???????????????
?????????????????????#???@?????????input.text input.password???textarea???????????????????????????????????????,??????#?????????@??????,??????????????????.
???
input.text>id>a
input.text>id>a#???????????????????????????@must
???????????????<input type='text' name='id' id='id' value='a' />???layui??????????????????,???????????????
???:
input>id>??????
input.text>title>??????
input.password>password>??????
select.search>keyword>??????>1==???:default&2==???&3=??????:disable
radio>gender>??????>1==??????:default&2==??????
checkbox.switch>sex>??????>1==??????:default&2==??????

????????????????????????:
input
input.text
input.password
input.radio
input.hidden

select
select.search
select.ignore

radio ???input.radio?????????

checkbox
checkbox.switch
checkbox.primary

textarea#???????????????@r
" autocomplete="off" class="layui-textarea" style="height:600px;">
input
input.hidden>id>ID>0
input>username>?????????#??????????????????@r
input.password>password>??????#???????????????@r
input.password>repassword>??????#?????????????????????@r
select>gourpid>?????????>1==?????????:disable&2==?????????:default
select>gourpid>????????????>
input>phone>??????#????????????????????????????????????
input>email>??????#?????????????????????
input>qq>QQ#?????????QQ??????
input>cardid>?????????#??????????????????
checkbox.switch>isdevice>????????????>1==???|???
checkbox.switch>checked>??????>1==??????|??????
</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <input type="hidden" name="iscode" value="1"/>
                        <button class="layui-btn" lay-submit lay-filter="code-submit">????????????</button>
                        <a type="reset" class="layui-btn layui-btn-primary" id="tool-base-btn">????????????</a>
                    </div>
                </div>
            </form>
            <form class="layui-form" action="layui.php" method="POST" id="tool-base">
                <input type="hidden" name="act" id="act" value="getlayui"/>
                <div class="layui-form-item">
                    <label class="layui-form-label">??????</label>
                    <div class="layui-input-block">
                        <select name="type" lay-verify="required" lay-filter="type" lay-search>
                            <option value="text">text ????????????</option>
                            <option value="password">password ????????????</option>
                            <option value="select">select ??????</option>

                            <option value="radio">radio ??????</option>
                            <option value="checkbox">checkbox ??????</option>
                            <option value="textarea">textarea ?????????</option>

                            <option value="button">button ??????</option>
                            <option value="form">form ??????</option>
                            <option value="captcha">captcha ?????????</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">?????????</label>
                    <div class="layui-input-block">
                        <input type="text" name="item" placeholder="?????? name id:item" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">??????</label>
                    <div class="layui-input-block">
                        <input type="text" name="label" placeholder="?????? label:filed" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item" id="pla_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="text" name="pla" id="pla" placeholder="???????????????????????????????????????" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" id="value_item">
                    <label class="layui-form-label">?????????</label>
                    <div class="layui-input-block">
			      <textarea type="text" name="value" id="value"
                            placeholder="
???
?????? 
???==???:default
???==???:disable
???==???
" autocomplete="off" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item" id="isignore_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="ignore" id="ignore" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="islaysearch_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="islaysearch" id="islaysearch" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="ispane_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="ispane" id="ispane" lay-skin="switch" value="1">
                    </div>
                </div>


                <div class="layui-form-item" id="ismust_item">
                    <label class="layui-form-label">??????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="ismust" id="ismust" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="isswitch_item">
                    <label class="layui-form-label">??????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="isswitch" id="isswitch" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="isprimary_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="isprimary" id="isprimary" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="btn_style_item">
                    <label class="layui-form-label">????????????</label>
                    <input type="hidden" name="btn_style" id="btn_style" value="btn"/>
                    <div class="layui-input-block">
                        <p class="btn-style-list">
                            <a class="layui-btn layui-btn-sm layui-btn-primary" data-value='primary'>????????????</a>
                            <a class="layui-btn layui-btn-sm layui-this" data-value='btn'>????????????</a>
                            <a class="layui-btn layui-btn-sm layui-btn-normal" data-value='normal'>????????????</a>
                            <a class="layui-btn layui-btn-sm layui-btn-warm" data-value='warm'>????????????</a>
                            <a class="layui-btn layui-btn-sm layui-btn-danger" data-value='danger'>????????????</a>
                            <a class="layui-btn layui-btn-sm layui-btn-disabled" data-value='disabled'>????????????</a>
                        </p>
                    </div>
                </div>
                <div class="layui-form-item" id="btn_size_item">
                    <label class="layui-form-label">????????????</label>
                    <input type="hidden" name="btn_size" id="btn_size" value="btn"/>
                    <div class="layui-input-block">
                        <p class="btn-size-list">
                            <a class="layui-btn layui-btn-lg" data-value='lg'>??????</a>
                            <a class="layui-btn layui-this" data-value='btn'>??????</a>
                            <a class="layui-btn layui-btn-sm" data-value='sm'>??????</a>
                            <a class="layui-btn layui-btn-xs" data-value='xs'>??????</a>
                        </p>
                    </div>
                </div>
                <div class="layui-form-item" id="btn_type_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="radio" name="btn_type" value="a" title="&lt; a &gt;" checked>
                        <input type="radio" name="btn_type" value="button" title="&lt; button &gt;">
                        <input type="radio" name="btn_type" value="input" title="&lt; input &gt;">
                    </div>
                </div>
                <!-- 			  <div class="layui-form-item" id="buttiontype_item">
                                <label class="layui-form-label">????????????</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="btn_mode" value="a" title="onclick" checked>
                                    <input type="radio" name="btn_mode" value="submit" title="submit" class="btn_mode_hide">
                                    <input type="radio" name="btn_mode" value="reset" title="reset" class="btn_mode_hide">
                                </div>
                              </div> -->
                <div class="layui-form-item" id="btn_fluid_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="btn_fluid" id="btn_fluid" lay-skin="switch" value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="btn_radius_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="btn_radius" id="btn_radius" lay-skin="switch" value="1">
                    </div>
                </div>

                <div class="layui-form-item" id="isword_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="isword" id="isword" lay-filter="isword" lay-skin="switch"
                               value="1">
                    </div>
                </div>
                <div class="layui-form-item" id="word_item">
                    <label class="layui-form-label">????????????</label>
                    <div class="layui-input-block">
                        <input type="text" name="word" id="word" lay-filter="word" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" id="display_item">
                    <label class="layui-form-label">??????</label>
                    <div class="layui-input-block">
                        <input type="radio" name="display" value="block" title="block" checked>
                        <input type="radio" name="display" value="inline" title="inline">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="submit">????????????</button>
                        <a type="reset" class="layui-btn layui-btn-primary" id="tool-code-btn">????????????</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- md end -->

        <div class="layui-col-md5">
            <div class="layui-row " style="display:none;" id="showcode">
                <form class="layui-form">
                    <div style="border-bottom: 1px solid #ebebeb ;padding:10px;margin-bottom: 15px;">??????:</div>
                    <div class="layui-form-item">
                        <textarea name="codearea" id="codearea" lay-filter="codearea" class="layui-textarea"
                                  style="height:258px"></textarea>
                    </div>
                </form>
            </div>


            <div class="layui-row " style="display:none;margin-top:20px" id="showdemo">
                <!-- <form class="layui-form"> -->
                <div class="layui-demo-text"
                     style="border-bottom: 1px solid #ebebeb ;padding:10px;margin-bottom: 15px;">????????????:
                </div>
                <div class="layui-demo" id="layui-demo">
                </div>
                <!-- </form> -->
            </div>
        </div> <!--md5-->
    </div>
    <!-- row -->
</div>
<!-- <div class="layui-container footer">
        <div class="logo"><i class="layui-icon">???</i>
        </div>
        <div class="text">
            <p>???????????????<a id="scanstart">????????????</a></p>
            <p>?? <a>2018</a> <a href="http://www.24en.com/">24en.com</a> powered by <a href="http://layui.com/">LayUI</a></p>
            <p><a>SLUM</a></p>
        </div>
</div> -->
</body>
<script>
    layui.use(['element', 'layer', 'form', 'code'], function () {
        var element = layui.element;
        var layer = layui.layer;
        var form = layui.form;
        $('#tool-code-btn').click(function () {
            $('#tool-base').hide(), $('#tool-code').fadeIn();
        });
        $('#tool-base-btn').click(function () {
            $('#tool-code').hide(), $('#tool-base').fadeIn();
        });
        typeinit();
        $('#pla_item').show();
        $('#isword_item').show();
        $('#ismust_item').show();
        $('#display_item').show();
        $('#value_item').show();
        form.on('switch(isword)', function (data) {
            if (data.elem.checked == true) {
                $('#word_item').show(), $('#display_item').hide();
            } else $('#word_item').hide(), $('#display_item').show();
        });
        form.on('select(type)', function (data) {
            typeinit();
            if (data.value == 'text' || data.value == 'password' || data.value == 'textarea') {
                $('#pla_item').show();
                $('#ismust_item').show();
                $('#isword_item').show();
                $('#value_item').show();
            }
            if (data.value == 'checkbox') {
                $('#isswitch_item').show();
                $('#value_item').show();
                $('#isprimary_item').show();
                $('#isword_item').show();
            }
            if (data.value == 'radio') {
                $('#value_item').show();
                $('#isword_item').show();
            }
            if (data.value == 'select') {
                $('#value_item').show();
                $('#islaysearch_item').show();
                $('#isignore_item').show();
                $('#ismust_item').show();
                $('#isword_item').show();
            }
            if (data.value == 'captcha') {
                $('#pla_item').show();
            }
            if (data.value == 'form') {
                $('#ispane_item').show();
            }
            if (data.value == 'button') {
                $('#value_item').show();
                $('#btn_fluid_item').show();
                $('#btn_radius_item').show();
                $('#btn_size_item').show();
                $('#btn_style_item').show();
                $('#btn_type_item').show();
                $('#display_item').hide();
            }

        });
        $(".btn-style-list a").click(function (index) {
            $(this).addClass('layui-this').siblings().removeClass('layui-this');
            $('#btn_style').val($(this).attr('data-value'));

        })
        $(".btn-size-list a").click(function (index) {
            $(this).addClass('layui-this').siblings().removeClass('layui-this');
            $('#btn_size').val($(this).attr('data-value'));

        })

        function typeinit() {
            $('#pla_item').hide();
            $('#pla').val('');
            $('#value_item').hide();
            $('#isswitch_item').hide();
            $('#word_item').hide();
            $('#islaysearch_item').hide();
            $('#isignore_item').hide();
            $('#ispane_item').hide();
            $('#isprimary_item').hide();
            $('#btn_fluid_item').hide();
            $('#btn_radius_item').hide();
            $('#btn_size_item').hide();
            $('#btn_style_item').hide();
            $('#btn_type_item').hide();
            $('#display_item').show();
            $('#isword_item').hide();
            $('#ismust_item').hide();

        }

        form.on("submit(code-submit)", function (data) {
            console.log(data.field);
            $.post('layui.php', data.field, function (res) {
                if (res.html) {
                    $('#showcode').fadeIn();
                    $('#showdemo').fadeIn();
                    $('#codearea').val(res.html);
                    $('#layui-demo').html('<form class="layui-form" lay-filter="layui-demo">' + res.html + '</form>');
                    form.render(null, "layui-demo");
                }

            }, 'json')
            return false;
        });
        form.on("submit(submit)", function (data) {

            $.post('layui.php', data.field, function (res) {
                if (res.html) {
                    $('#showcode').fadeIn();
                    $('#showdemo').fadeIn();
                    $('#codearea').val(res.html);
                    if (data.field.type == 'form') {
                        $('#layui-demo').html(res.html);
                        ;form.render();
                    } else {
                        $('#layui-demo').html('<form class="layui-form" lay-filter="layui-demo">' + res.html + '</form>');
                        form.render(null, "layui-demo");
                    }

                }

            }, 'json')
            return false;
        });


    });
</script>
</html>