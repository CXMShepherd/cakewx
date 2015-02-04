(function($) {
    var reg = {
            'int': /^\d+$/,
            'date': /^\d{4}-\d{2}-\d{2}$/,
            'datetime': /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$/,
            'phone': /((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/,
            'chinese': /^[\u4e00-\u9fa5]+$/,
            'address':  /^\d+$/
        },

        def = {
            e: '不能为空！',
            w: '',
            r: '',
            type: 'text',
            cerror: 'check-error'
        };
    
    function tips($elem) {
        //判断提示直接写入下一个同级元素
        var $tips = $elem.eq(-1).next();
        return $tips.removeClass(def.cpass).removeClass(def.cerror);
    }
    //判断空值或者错误格式给与相映提示
    function text() {
        var $elem = $(this).eq(0),
            o = $elem.data('checkform'),
            val = $elem.val(),
            $tips = tips($elem);

        if(o.e && !val) {
            $tips.addClass(def.cerror).text(o.e);
            return false;
        }

        if(val && o.w && o.r && !reg[o.r].test(val)) {
            $tips.addClass(def.cerror).text(o.w);
            return false;
        }
        
        $tips.text('');
        return true;
    }
    function checked() {
        var $elem = this.filter(':checked'),
            o = this.eq(0).data('checkform'),
            val,
            i = 0,
            $tips = tips($elem, o.t);

        if(o.e && $elem.length === 0) {
            $tips.addClass(def.cerror).text(o.e);
            return false;
        }
        
        if(o.w && o.r) {
            for(; i < $elem.length; i++) {
                val = $elem.eq(i).val();
                if(val && !o.r.test(val)) {
                    $tips.addClass(def.cerror).text(o.w);
                    return false;
                }
            }
        }
        $tips.text('');
        return true;
    }
    
    function submit(e) {
        var i,
            $elem,
            o = e.data,
            sign = 0;
        for(i in o) {
            $elem = $(i);
            if(o[i].type == 'text' || o[i].type == 'select') {
                $elem[0] && !text.call($elem[0]) && sign++;
            } else if(o[i].type == 'radio' || o[i].type == 'checkbox') {
                $elem[0] && !checked.call($elem) && sign++;
            }
        }
        return false;
        return sign > 0 ? false : true;
    }
    
    function setup(options) {
        var i;
        for(i in def) {
            if(options[i]) {
                def[i] = options[i];
            }
        }
        return def;
    }
    
    function init(options) {
        var i, o, $elem;

        if(typeof options === 'undefined') {
            return;
        }
        for(i in options) {
            $elem = $(i);
            o = options[i];
            o.r = o.r || reg[o.r] || def.r;
            o.w = o.w || def.w;
            o.e = o.e || def.e;
            o.t = o.t || def.t;
            o.type = o.type || def.type;
            
            $elem.eq(0).data('checkform', o)
            if(o.type == 'text') {
                $elem.eq(0).on('blur', text);
            }
        }

        this.eq(0).on('submit', options, submit);
    }

    $.fn.checkForm = init;
    $.checkFormSetup = setup;
})(Zepto);