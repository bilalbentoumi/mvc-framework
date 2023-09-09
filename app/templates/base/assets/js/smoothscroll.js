$.fn.smooth = function(action) {
    if (action === 'start') {

        var $gal = $(this);
        var content = $gal.children().first();
        var galH = $gal.outerHeight();
        var galSH = $gal[0].scrollHeight;
        var hDiff = (galSH / galH) - 1;
        var mPadd = 100;
        var damp = 1;
        var mY = 0;
        var mY2 = 0;
        var posY = 0;
        var mmAA = galH - (mPadd * 2);
        var mmAAr = (galH / mmAA);

        $gal.mousemove(function(e) {
            mY = e.pageY - $(this).parent().offset().top - this.offsetTop;
            mY2 = Math.min(Math.max(0, mY - mPadd), mmAA) * mmAAr;
            posY += (mY2 - posY) / damp; // zeno's paradox equation "catching delay"
            content.css('top', -(posY * hDiff));
        });

        $gal.mouseover(function () {
            if ($gal.outerHeight() != galH) {
                galH = $gal.outerHeight();
                galSH = $gal[0].scrollHeight;
                hDiff = (galSH / galH) - 1;
                mmAA = galH - (mPadd * 2);
                mmAAr = (galH / mmAA);
            }
        });

    } else if (action === 'stop') {
        $(this).unbind();
        $(this).children().first().css('top', 0);
    }
}