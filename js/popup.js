jQuery( document ).ready(function() {
    function createCookie(name, value, minutes) {
        var expires;
        if (minutes) {
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = escape(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return unescape(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    if(sw_overlay_settings['showAlways'] != 'true' && readCookie('sw_overlay_close') == 1) {
        return;
    }

    var wrapper = jQuery('#sw_overlay');
    wrapper.addClass('activated');

    var contentDiv  = jQuery('<div id="sw_overlay_content">');

    //add the close link
    var closeLink = jQuery('<a>');
    closeLink.html(sw_overlay_settings['close']);
    closeLink.attr('href','#closeOverlay');
    closeLink.attr('id'  ,'sw_overlay_close'  );

    //clicking the close link will hide the overlay and write a cookie
    closeLink.click(
            function(event){
                jQuery('#sw_overlay').removeClass('activated');
                jQuery('#sw_overlay').hide();
                createCookie('sw_overlay_close', 1, sw_overlay_settings['repeatDuration']);
            }
            );

    contentDiv.append(closeLink);

    //add the image in a separate div
    var imgDiv = jQuery('<div id="sw_overlay_image_div">');
    imgDiv.html('<a href="'+ sw_overlay_settings['link'] +'"><img src="'+ sw_overlay_settings['image'] +'" class="sw_overlay_img"></a>');
    contentDiv.append(imgDiv);

    wrapper.append(contentDiv);
});
