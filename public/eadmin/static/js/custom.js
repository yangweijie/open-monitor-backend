// line-highlight
	! function () {
	    if ("undefined" != typeof Prism && "undefined" != typeof document && document.querySelector) {
	        var t, o = "line-numbers",
	            s = "linkable-line-numbers",
	            l = function () {
	                if (void 0 === t) {
	                    var e = document.createElement("div");
	                    e.style.fontSize = "13px", e.style.lineHeight = "1.5", e.style.padding = "0", e.style.border = "0",
	                        e.innerHTML = "&nbsp;<br />&nbsp;", document.body.appendChild(e), t = 38 === e.offsetHeight,
	                        document.body.removeChild(e)
	                }
	                return t
	            },
	            a = !0;
	        Prism.plugins.lineHighlight = {
	            highlightLines: function (u, e, c) {
	                var t = (e = "string" == typeof e ? e : u.getAttribute("data-line") || "").replace(/\s+/g, "").split(
	                        ",").filter(Boolean),
	                    d = +u.getAttribute("data-line-offset") || 0,
	                    h = (l() ? parseInt : parseFloat)(getComputedStyle(u).lineHeight),
	                    f = Prism.util.isActive(u, o),
	                    i = u.querySelector("code"),
	                    p = f ? u : i || u,
	                    g = [],
	                    m = i && p != i ? function (e, t) {
	                        var i = getComputedStyle(e),
	                            n = getComputedStyle(t);
	                        function r(e) {
	                            return +e.substr(0, e.length - 2)
	                        }
	                        return t.offsetTop + r(n.borderTopWidth) + r(n.paddingTop) - r(i.paddingTop)
	                    }(u, i) : 0;
	                t.forEach(function (e) {
	                    var t = e.split("-"),
	                        i = +t[0],
	                        n = +t[1] || i,
	                        r = u.querySelector('.line-highlight[data-range="' + e + '"]') || document.createElement(
	                            "div");
	                    if (g.push(function () {
	                            r.setAttribute("aria-hidden", "true"), r.setAttribute("data-range", e),
	                                r.className = (c || "") + " line-highlight"
	                        }), f && Prism.plugins.lineNumbers) {
	                        var o = Prism.plugins.lineNumbers.getLine(u, i),
	                            s = Prism.plugins.lineNumbers.getLine(u, n);
	                        if (o) {
	                            var l = o.offsetTop + m + "px";
	                            g.push(function () {
	                                r.style.top = l
	                            })
	                        }
	                        if (s) {
	                            var a = s.offsetTop - o.offsetTop + s.offsetHeight + "px";
	                            g.push(function () {
	                                r.style.height = a
	                            })
	                        }
	                    } else g.push(function () {
	                        r.setAttribute("data-start", String(i)), i < n && r.setAttribute(
	                                "data-end", String(n)), r.style.top = (i - d - 1) * h + m +
	                            "px", r.textContent = new Array(n - i + 2).join(" \n")
	                    });
	                    g.push(function () {
	                        r.style.width = u.scrollWidth + "px"
	                    }), g.push(function () {
	                        p.appendChild(r)
	                    })
	                });
	                var n = u.id;
	                if (f && Prism.util.isActive(u, s) && n) {
	                    y(u, s) || g.push(function () {
	                        u.classList.add(s)
	                    });
	                    var r = parseInt(u.getAttribute("data-start") || "1");
	                    v(".line-numbers-rows > span", u).forEach(function (e, t) {
	                        var i = t + r;
	                        e.onclick = function () {
	                            var e = n + "." + i;
	                            a = !1, location.hash = e, setTimeout(function () {
	                                a = !0
	                            }, 1)
	                        }
	                    })
	                }
	                return function () {
	                    g.forEach(b)
	                }
	            }
	        };
	        var u = 0;
	        Prism.hooks.add("before-sanity-check", function (e) {
	            var t = e.element.parentElement;
	            if (c(t)) {
	                var i = 0;
	                v(".line-highlight", t).forEach(function (e) {
	                    i += e.textContent.length, e.parentNode.removeChild(e)
	                }), i && /^(?: \n)+$/.test(e.code.slice(-i)) && (e.code = e.code.slice(0, -i))
	            }
	        }), Prism.hooks.add("complete", function e(t) {
	            var i = t.element.parentElement;
	            if (c(i)) {
	                clearTimeout(u);
	                var n = Prism.plugins.lineNumbers,
	                    r = t.plugins && t.plugins.lineNumbers;
	                if (y(i, o) && n && !r) Prism.hooks.add("line-numbers", e);
	                else Prism.plugins.lineHighlight.highlightLines(i)(), u = setTimeout(d, 1)
	            }
	        }), window.addEventListener("hashchange", d), window.addEventListener("resize", function () {
	            v("pre").filter(c).map(function (e) {
	                return Prism.plugins.lineHighlight.highlightLines(e)
	            }).forEach(b)
	        })
	    }
	    function v(e, t) {
	        return Array.prototype.slice.call((t || document).querySelectorAll(e))
	    }
	    function y(e, t) {
	        return e.classList.contains(t)
	    }
	    function b(e) {
	        e()
	    }
	    function c(e) {
	        return !(!e || !/pre/i.test(e.nodeName)) && (!!e.hasAttribute("data-line") || !(!e.id || !Prism.util.isActive(e,
	            s)))
	    }
	    function d() {
	        var e = location.hash.slice(1);
	        v(".temporary.line-highlight").forEach(function (e) {
	            e.parentNode.removeChild(e)
	        });
	        var t = (e.match(/\.([\d,-]+)$/) || [, ""])[1];
	        if (t && !document.getElementById(e)) {
	            var i = e.slice(0, e.lastIndexOf(".")),
	                n = document.getElementById(i);
	            if (n) n.hasAttribute("data-line") || n.setAttribute("data-line", ""), Prism.plugins.lineHighlight.highlightLines(
	                n, t, "temporary ")(), a && document.querySelector(".temporary.line-highlight").scrollIntoView()
	        }
	    }
	}();