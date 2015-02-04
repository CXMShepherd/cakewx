;(function($){
    $.extend($.fn, {
        jsorder : function(setting) {
            //初始化配置
            var opts = $.extend( {}, setting);
            //读取cookeie信息
            var initdata ={};
            if(opts.savecookie && $.fn.cookie(opts.cookiename) != null && $.fn.cookie(opts.cookiename) != '') {
                initdata = eval('(' + $.fn.cookie(opts.cookiename) + ')');
            }
            //初始化购物车
            $("body").data(opts.staticname, initdata);
            //初始化页面
            var slide = {
                //增加一个订单项
                addjsorder : function(e) {
                    var obnum = $("#chbox .bnum"),
                        ototal = $("#chbox .total"),
                        ochbox = $("#chbox"),
                        bnum = FormatNum(obnum.text()),
                        total = FormatNum(ototal.text());

                    ochbox.css("display") == "none" ? $("#chbox").show() : '';
                    if($(this).next().css("display") == "none"){
                        $(this).parent().find("a, span").show();
                    }
                    $(this).next().text(FormatNum($(this).next().text())+1);
                    //分类计数更新
                    var tempcat = $(this).parent().parent().parent().attr("id"),
                        templi =  $(this).parent().parent(),
                        datajsorder = $("body").data(opts.staticname),
                        id = templi.attr('id'),
                        title = templi.attr('data-title'),
                        price = FormatNum(templi.attr('data-price')),
                        unit = templi.attr('data-unit'),
                        cat = templi.attr('data-cat'),
                        pic = templi.attr('data-pic'),
                        opaynum = $("#paynum"),
                        firstcondition = parseInt($.dstore.isfirst) && parseInt($.dstore.openfirst),
                        fromstartprice = 0,
                        realpay,
                        paynum;
                    $("#cat_"+tempcat+" .bnum").text(parseInt($("#cat_"+tempcat+" .bnum").text())+1).show();
                    //购物清单更新
                    obnum.text(FormatNum(bnum + 1));
                    ototal.text(FormatNum(total + price));
                    paynum = FormatNum(total + price);
                    //付费计算
                    if( paynum < FormatNum($.dstore.startprice)) {
                        $("#tranprice").text($.dstore.sendprice);
                        fromstartprice = FormatNum(FormatNum($.dstore.startprice) - paynum);
                        !$(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").removeClass("active") : '';
                        $(".btn-ordersub span").hide();
                        $(".ordertip i").text(fromstartprice);
                        $(".ordertip").show();
                        realpay = firstcondition && paynum > FormatNum($.dstore.firstcut) ? paynum + FormatNum($.dstore.sendprice) - FormatNum($.dstore.firstcut) : paynum + FormatNum($.dstore.sendprice);
                    } else if( FormatNum($.dstore.startprice) <= paynum && paynum < FormatNum($.dstore.freeprice) ) {
                        $("#tranprice").text($.dstore.sendprice);
                        !$(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").addClass("active") : '';
                        $(".btn-ordersub span").hide();
                        $(".orderact").show();
                        realpay = firstcondition ? paynum + FormatNum($.dstore.sendprice) - FormatNum($.dstore.firstcut) : paynum + FormatNum($.dstore.sendprice);
                    } else {
                        $("#tranprice").text('0');
                        !$(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").addClass("active") : '';
                        $(".btn-ordersub span").hide();
                        $(".orderact").show();
                        realpay = firstcondition ? paynum - FormatNum($.dstore.firstcut) : paynum;
                    }
                    opaynum.text(FormatNum(realpay));

                    if (datajsorder[id] == null || datajsorder[id]['count'] == 0) {
                        if (datajsorder[id] == null) {
                            datajsorder[id] = {};
                        }
                        datajsorder[id]['pid'] = id;
                        datajsorder[id]['count'] = 1;
                        datajsorder[id]['price'] = price;
                        datajsorder[id]['unit'] = unit;
                        datajsorder[id]['pic'] = pic;
                        datajsorder[id]['cat'] = cat;
                        datajsorder[id]['title'] = title;
                    } else {
                        datajsorder[id]['count'] += 1;
                    }
                    slide.reflash();
                },
                //增加一个订单项数量
                addjsordernum : function(name, id, price) {
                    var datajsorder = $("body").data(opts.staticname);
                    datajsorder[id]['count'] += 1;
                    $("#" + opts.jsorderpre + id + " b").html(
                        slide.info(price, datajsorder[id]['count']));
                    slide.reflash();
                },
                //减少一个订单项数量
                deljsordernum : function(name, id, price) {
                    var obnum = $("#chbox .bnum"),
                        ototal = $("#chbox .total"),
                        ochbox = $("#chbox"),
                        templi =  $(this).parent().parent(),
                        bnum = FormatNum(obnum.text()),
                        total = FormatNum(ototal.text()),
                        price = FormatNum(templi.attr('data-price')),
                        opaynum = $("#paynum"),
                        fromstartprice = 0,
                        firstcondition = parseInt($.dstore.isfirst) && parseInt($.dstore.openfirst),
                        realpay,
                        paynum;
                    if($(this).prev().text() == 1){
                        $(this).parent().find(".ac-del, .ordernum").hide();
                        if(opts.onpage == "cart"){
                            if(confirm("是否确认删除")){
                                $(this).parent().parent().remove();
                            } else{
                                return '';
                            }
                        }
                    }
                    $(this).prev().text(FormatNum($(this).prev().text())-1);
                    if($(this).prev().text() !== 0){
                        obnum.text(bnum - 1);
                        ototal.text(FormatNum(total - price));
                        paynum = FormatNum(total - price);
                        if($("#chbox .bnum").text() == 0){$("#chbox").hide();$('#cartempty').show();};
                        //付费计算
                        if( paynum < FormatNum($.dstore.startprice)) {
                            $("#tranprice").text($.dstore.sendprice);
                            fromstartprice = FormatNum(FormatNum($.dstore.startprice) - paynum);
                            $(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").removeClass("active") : '';
                            $(".btn-ordersub span").hide();
                            $(".ordertip i").text(fromstartprice);
                            $(".ordertip").show();
                            realpay = firstcondition && paynum > FormatNum($.dstore.firstcut) ? paynum + FormatNum($.dstore.sendprice) - FormatNum($.dstore.firstcut) : paynum + FormatNum($.dstore.sendprice);
                        } else if( FormatNum($.dstore.startprice) <= paynum && paynum < FormatNum($.dstore.freeprice) ) {
                            $("#tranprice").text($.dstore.sendprice);
                            !$(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").addClass("active") : '';
                            $(".btn-ordersub span").hide();
                            $(".orderact").show();
                            realpay = firstcondition ? paynum + FormatNum($.dstore.sendprice) - FormatNum($.dstore.firstcut) : paynum + FormatNum($.dstore.sendprice);
                        } else {
                            $("#tranprice").text('0');
                            !$(".btn-ordersub").hasClass("active") ? $(".btn-ordersub").addClass("active") : '';
                            $(".btn-ordersub span").hide();
                            $(".orderact").show();
                            realpay = firstcondition ? paynum - FormatNum($.dstore.firstcut) : paynum;
                        }
                        opaynum.text(FormatNum(realpay));
                    }
                    //分类计数更新
                    var tempcat = $(this).parent().parent().parent().attr("id"),
                        templi =  $(this).parent().parent();
                    if($("#cat_"+tempcat+" .bnum").text() == "1"){
                        $("#cat_"+tempcat+" .bnum").hide();
                    }
                    var tempcat = $(this).parent().parent().parent().attr("id");
                    $("#cat_"+tempcat+" .bnum").text(parseInt( $("#cat_"+tempcat+" .bnum").text())-1);
                    var datajsorder = $("body").data(opts.staticname);
                    var id = templi.attr('id');
                    datajsorder[id]['count'] -= 1;
                    datajsorder[id]['count'] > 0 ? '' : delete datajsorder[id];
                    slide.reflash();
                },
                //删除一个订单项
                deljsorder : function(id) {
                    var datajsorder = $("body").data(opts.staticname);
                    datajsorder[id]['count'] = 0;
                    $("#" + opts.jsorderpre + id).remove();
                    slide.reflash();
                },
                //刷新购物车
                reflash : function() {
                    var data = $("body").data(opts.staticname);
                    if (opts.savecookie) {
                        var date = new Date();
                        date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
                        $.fn.cookie(opts.cookiename, JSON.stringify(data), {
                            path : '/',
                            expires : date
                        });
                    }
                },
                //提交
                subm : function() {
                    if(!$.dstore.state) {
                        alert("对不起，此店铺暂停营业。");
                        return false;
                    } else {
                        if(!$(".btn-ordersub").hasClass("active")) return '';
                        var data = {},message,gettime,paytype,paynum,addr;
                        var tobj = $("body").data($.dstore.storeid);
                        addr = JSON.parse(storage.getItem("address")),
                        message = $("#message").val();
                        gettime = $(".cday").val() + ' ' + $(".ctime").val();
                        paytype = $(".paymode .on").text();
                        paynum = $("#paynum").text();
                        if(addr == null || addr == ""){
                            alert("请完善收获地址");
                            return false;
                        } else {
                            $.each(addr ,function(key, value){
                                if(value == null || value == ""){
                                    alert("请完善收获地址");
                                    return false;
                                }
                            });
                        }
                        if($(".ctime").val() == "0") {
                            alert("请选择收获时间");
                            return false;
                        }
                        data = {
                            'storeId' : $.dstore.storeid,
                            'product' : tobj,
                            'userId' :  $.dstore.userid,
                            'userName': addr.fullname,
                            'userPhone': addr.phone,
                            'userAdds': addr.address,
                            'memo' : message,
                            'userTime' : gettime,
                            'paytype' : paytype,
                            'allPrice' : paynum,
                            'isfirst' : $.dstore.isfirst,
                            'firstcut' : $.dstore.firstcut
                        };
                        data = JSON.stringify(data);
                        $.ajax({
                            type: "POST",
                            url: $.dstore.orderapi,
                            dataType: "json",
                            data: data,
                            beforeSend: function(){
                                var waithtm = '<div class="loading"><div class="loadInco"><span class="blockG" id="rotateG_01"></span><span class="blockG" id="rotateG_02"></span><span class="blockG" id="rotateG_03"></span><span class="blockG" id="rotateG_04"></span><span class="blockG" id="rotateG_05"></span><span class="blockG" id="rotateG_06"></span><span class="blockG" id="rotateG_07"></span><span class="blockG" id="rotateG_08"></span></div>正在加载...</div>';
                                ShowAttention(waithtm)
                            },
                            success: function(a) {
                                if(a.state){
                                    $("#page-ordersuc").show();
                                    $("body").data(opts.staticname, {});
                                    $.dstore.isfirst = 0;
                                    if(opts.savecookie) {
                                        var date = new Date();
                                        date.setTime(date.getTime() - (1 * 24 * 60 * 60 ));
                                        $.fn.cookie(opts.cookiename, '', { path: '/', expires: date });
                                    }
                                } else {
                                    ShowAttention("提交失败"),
                                    hideLoader()
                                }

                            },
                            error: function() {
                                ShowAttention("提交失败"),
                                hideLoader()
                            }
                        })
                    }
                }
            };
            $(".content").on("tap", opts.addbutton, slide.addjsorder);
            $(".content").on("tap", opts.subbutton, slide.deljsordernum);
            $(".content").on("tap", opts.submitbut, slide.subm);
        }
    })
})(Zepto);