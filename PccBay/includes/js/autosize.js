! function(e, t) {
    "use strict";
    "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? module.exports = t() : e.autosize = t()
}(this, function() {
    function e(e) {
        function t() {
            var t = window.getComputedStyle(e, null);
            "vertical" === t.resize ? e.style.resize = "none" : "both" === t.resize && (e.style.resize = "horizontal"), e.style.wordWrap = "break-word";
            var i = e.style.width;
            e.style.width = "0px", e.offsetWidth, e.style.width = i, n = "none" !== t.maxHeight ? parseFloat(t.maxHeight) : !1, r = "content-box" === t.boxSizing ? -(parseFloat(t.paddingTop) + parseFloat(t.paddingBottom)) : parseFloat(t.borderTopWidth) + parseFloat(t.borderBottomWidth), o()
        }

        function o() {
            var t = e.style.height,
                o = document.documentElement.scrollTop,
                i = document.body.scrollTop;
            e.style.height = "auto";
            var s = e.scrollHeight + r;
            if (n !== !1 && s > n ? (s = n, "scroll" !== e.style.overflowY && (e.style.overflowY = "scroll")) : "hidden" !== e.style.overflowY && (e.style.overflowY = "hidden"), e.style.height = s + "px", document.documentElement.scrollTop = o, document.body.scrollTop = i, t !== e.style.height) {
                var d = document.createEvent("Event");
                d.initEvent("autosize.resized", !0, !1), e.dispatchEvent(d)
            }
        }
        if (e && e.nodeName && "TEXTAREA" === e.nodeName && !e.hasAttribute("data-autosize-on")) {
            var n, r;
            "onpropertychange" in e && "oninput" in e && e.addEventListener("keyup", o), window.addEventListener("resize", o), e.addEventListener("input", o), e.addEventListener("autosize.update", o), e.addEventListener("autosize.destroy", function(t) {
                window.removeEventListener("resize", o), e.removeEventListener("input", o), e.removeEventListener("keyup", o), e.removeEventListener("autosize.destroy"), Object.keys(t).forEach(function(o) {
                    e.style[o] = t[o]
                }), e.removeAttribute("data-autosize-on")
            }.bind(e, {
                height: e.style.height,
                overflow: e.style.overflow,
                overflowY: e.style.overflowY,
                wordWrap: e.style.wordWrap,
                resize: e.style.resize
            })), e.setAttribute("data-autosize-on", !0), e.style.overflow = "hidden", e.style.overflowY = "hidden", t()
        }
    }
    return "function" != typeof window.getComputedStyle ? function(e) {
        return e
    } : function(t) {
        return t && t.length ? Array.prototype.forEach.call(t, e) : t && t.nodeName && e(t), t
    }
});