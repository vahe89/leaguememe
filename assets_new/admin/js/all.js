
/*!
 * jQuery UI 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */
(function (a)
{
    a.effects.bounce = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right"],
                h = a.effects.setMode(c, d.options.mode || "effect"),
                g = d.options.direction || "up",
                i = d.options.distance || 20,
                b = d.options.times || 5,
                f = d.duration || 250;
            /show|hide/.test(h) && e.push("opacity");
            a.effects.save(c, e);
            c.show();
            a.effects.createWrapper(c);
            var j = g == "up" || g == "down" ? "top" : "left";
            g = g == "up" || g == "left" ? "pos" : "neg";
            i = d.options.distance || (j == "top" ? c.outerHeight(
            {
                margin: true
            }) / 3 : c.outerWidth(
            {
                margin: true
            }) / 3);
            if (h == "show") c.css("opacity", 0).css(j, g == "pos" ? -i : i);
            if (h == "hide") i /= b * 2;
            h != "hide" && b--;
            if (h == "show")
            {
                var l = {
                    opacity: 1
                };
                l[j] = (g == "pos" ? "+=" : "-=") + i;
                c.animate(l, f / 2, d.options.easing);
                i /= 2;
                b--
            }
            for (l = 0; l < b; l++)
            {
                var o = {},
                    n = {};
                o[j] = (g == "pos" ? "-=" : "+=") + i;
                n[j] = (g == "pos" ? "+=" : "-=") + i;
                c.animate(o, f / 2, d.options.easing).animate(n, f / 2, d.options.easing);
                i = h == "hide" ? i * 2 : i / 2
            }
            if (h == "hide")
            {
                l = {
                    opacity: 0
                };
                l[j] = (g == "pos" ? "-=" : "+=") + i;
                c.animate(l, f / 2, d.options.easing, function ()
                {
                    c.hide();
                    a.effects.restore(c, e);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(this, arguments)
                })
            }
            else
            {
                o = {};
                n = {};
                o[j] = (g == "pos" ? "-=" : "+=") + i;
                n[j] = (g == "pos" ? "+=" : "-=") + i;
                c.animate(o, f / 2, d.options.easing).animate(n, f / 2, d.options.easing, function ()
                {
                    a.effects.restore(c, e);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(this, arguments)
                })
            }
            c.queue("fx", function ()
            {
                c.dequeue()
            });
            c.dequeue()
        })
    }
})(jQuery);
(function (a)
{
    a.effects.clip = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right", "height", "width"],
                h = a.effects.setMode(c, d.options.mode || "hide"),
                g = d.options.direction || "vertical";
            a.effects.save(c, e);
            c.show();
            var i = a.effects.createWrapper(c).css(
            {
                overflow: "hidden"
            });
            i = c[0].tagName == "IMG" ? i : c;
            var b = {
                size: g == "vertical" ? "height" : "width",
                position: g == "vertical" ? "top" : "left"
            };
            g = g == "vertical" ? i.height() : i.width();
            if (h == "show")
            {
                i.css(b.size, 0);
                i.css(b.position, g / 2)
            }
            var f = {};
            f[b.size] = h == "show" ? g : 0;
            f[b.position] = h == "show" ? 0 : g / 2;
            i.animate(f, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    h == "hide" && c.hide();
                    a.effects.restore(c, e);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(c[0], arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.drop = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right", "opacity"],
                h = a.effects.setMode(c, d.options.mode || "hide"),
                g = d.options.direction || "left";
            a.effects.save(c, e);
            c.show();
            a.effects.createWrapper(c);
            var i = g == "up" || g == "down" ? "top" : "left";
            g = g == "up" || g == "left" ? "pos" : "neg";
            var b = d.options.distance || (i == "top" ? c.outerHeight(
            {
                margin: true
            }) / 2 : c.outerWidth(
            {
                margin: true
            }) / 2);
            if (h == "show") c.css("opacity", 0).css(i, g == "pos" ? -b : b);
            var f = {
                opacity: h == "show" ? 1 : 0
            };
            f[i] = (h == "show" ? g == "pos" ? "+=" : "-=" : g == "pos" ? "-=" : "+=") + b;
            c.animate(f, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    h == "hide" && c.hide();
                    a.effects.restore(c, e);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(this, arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.explode = function (d)
    {
        return this.queue(function ()
        {
            var c = d.options.pieces ? Math.round(Math.sqrt(d.options.pieces)) : 3,
                e = d.options.pieces ? Math.round(Math.sqrt(d.options.pieces)) : 3;
            d.options.mode = d.options.mode == "toggle" ? a(this).is(":visible") ? "hide" : "show" : d.options.mode;
            var h = a(this).show().css("visibility", "hidden"),
                g = h.offset();
            g.top -= parseInt(h.css("marginTop"), 10) || 0;
            g.left -= parseInt(h.css("marginLeft"), 10) || 0;
            for (var i = h.outerWidth(true), b = h.outerHeight(true), f = 0; f < c; f++) for (var j = 0; j < e; j++) h.clone().appendTo("body").wrap("<div></div>").css(
            {
                position: "absolute",
                visibility: "visible",
                left: -j * (i / e),
                top: -f * (b / c)
            }).parent().addClass("ui-effects-explode").css(
            {
                position: "absolute",
                overflow: "hidden",
                width: i / e,
                height: b / c,
                left: g.left + j * (i / e) + (d.options.mode == "show" ? (j - Math.floor(e / 2)) * (i / e) : 0),
                top: g.top + f * (b / c) + (d.options.mode == "show" ? (f - Math.floor(c / 2)) * (b / c) : 0),
                opacity: d.options.mode == "show" ? 0 : 1
            }).animate(
            {
                left: g.left + j * (i / e) + (d.options.mode == "show" ? 0 : (j - Math.floor(e / 2)) * (i / e)),
                top: g.top + f * (b / c) + (d.options.mode == "show" ? 0 : (f - Math.floor(c / 2)) * (b / c)),
                opacity: d.options.mode == "show" ? 1 : 0
            }, d.duration || 500);
            setTimeout(function ()
            {
                d.options.mode == "show" ? h.css(
                {
                    visibility: "visible"
                }) : h.css(
                {
                    visibility: "visible"
                }).hide();
                d.callback && d.callback.apply(h[0]);
                h.dequeue();
                a("div.ui-effects-explode").remove()
            }, d.duration || 500)
        })
    }
})(jQuery);
(function (a)
{
    a.effects.fade = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = a.effects.setMode(c, d.options.mode || "hide");
            c.animate(
            {
                opacity: e
            }, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    d.callback && d.callback.apply(this, arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.fold = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right"],
                h = a.effects.setMode(c, d.options.mode || "hide"),
                g = d.options.size || 15,
                i = !! d.options.horizFirst,
                b = d.duration ? d.duration / 2 : a.fx.speeds._default / 2;
            a.effects.save(c, e);
            c.show();
            var f = a.effects.createWrapper(c).css(
            {
                overflow: "hidden"
            }),
                j = h == "show" != i,
                l = j ? ["width", "height"] : ["height", "width"];
            j = j ? [f.width(), f.height()] : [f.height(), f.width()];
            var o = /([0-9]+)%/.exec(g);
            if (o) g = parseInt(o[1], 10) / 100 * j[h == "hide" ? 0 : 1];
            if (h == "show") f.css(i ? {
                height: 0,
                width: g
            } : {
                height: g,
                width: 0
            });
            i = {};
            o = {};
            i[l[0]] = h == "show" ? j[0] : g;
            o[l[1]] = h == "show" ? j[1] : 0;
            f.animate(i, b, d.options.easing).animate(o, b, d.options.easing, function ()
            {
                h == "hide" && c.hide();
                a.effects.restore(c, e);
                a.effects.removeWrapper(c);
                d.callback && d.callback.apply(c[0], arguments);
                c.dequeue()
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.highlight = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["backgroundImage", "backgroundColor", "opacity"],
                h = a.effects.setMode(c, d.options.mode || "show"),
                g = {
                    backgroundColor: c.css("backgroundColor")
                };
            if (h == "hide") g.opacity = 0;
            a.effects.save(c, e);
            c.show().css(
            {
                backgroundImage: "none",
                backgroundColor: d.options.color || "#ffff99"
            }).animate(g, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    h == "hide" && c.hide();
                    a.effects.restore(c, e);
                    h == "show" && !a.support.opacity && this.style.removeAttribute("filter");
                    d.callback && d.callback.apply(this, arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.pulsate = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = a.effects.setMode(c, d.options.mode || "show");
            times = (d.options.times || 5) * 2 - 1;
            duration = d.duration ? d.duration / 2 : a.fx.speeds._default / 2;
            isVisible = c.is(":visible");
            animateTo = 0;
            if (!isVisible)
            {
                c.css("opacity", 0).show();
                animateTo = 1
            }
            if (e == "hide" && isVisible || e == "show" && !isVisible) times--;
            for (e = 0; e < times; e++)
            {
                c.animate(
                {
                    opacity: animateTo
                }, duration, d.options.easing);
                animateTo = (animateTo + 1) % 2
            }
            c.animate(
            {
                opacity: animateTo
            }, duration, d.options.easing, function ()
            {
                animateTo == 0 && c.hide();
                d.callback && d.callback.apply(this, arguments)
            });
            c.queue("fx", function ()
            {
                c.dequeue()
            }).dequeue()
        })
    }
})(jQuery);
(function (a)
{
    a.effects.puff = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = a.effects.setMode(c, d.options.mode || "hide"),
                h = parseInt(d.options.percent, 10) || 150,
                g = h / 100,
                i = {
                    height: c.height(),
                    width: c.width()
                };
            a.extend(d.options, {
                fade: true,
                mode: e,
                percent: e == "hide" ? h : 100,
                from: e == "hide" ? i : {
                    height: i.height * g,
                    width: i.width * g
                }
            });
            c.effect("scale", d.options, d.duration, d.callback);
            c.dequeue()
        })
    };
    a.effects.scale = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = a.extend(true, {}, d.options),
                h = a.effects.setMode(c, d.options.mode || "effect"),
                g = parseInt(d.options.percent, 10) || (parseInt(d.options.percent, 10) == 0 ? 0 : h == "hide" ? 0 : 100),
                i = d.options.direction || "both",
                b = d.options.origin;
            if (h != "effect")
            {
                e.origin = b || ["middle", "center"];
                e.restore = true
            }
            b = {
                height: c.height(),
                width: c.width()
            };
            c.from = d.options.from || (h == "show" ? {
                height: 0,
                width: 0
            } : b);
            g = {
                y: i != "horizontal" ? g / 100 : 1,
                x: i != "vertical" ? g / 100 : 1
            };
            c.to = {
                height: b.height * g.y,
                width: b.width * g.x
            };
            if (d.options.fade)
            {
                if (h == "show")
                {
                    c.from.opacity = 0;
                    c.to.opacity = 1
                }
                if (h == "hide")
                {
                    c.from.opacity = 1;
                    c.to.opacity = 0
                }
            }
            e.from = c.from;
            e.to = c.to;
            e.mode = h;
            c.effect("size", e, d.duration, d.callback);
            c.dequeue()
        })
    };
    a.effects.size = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
                h = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
                g = ["width", "height", "overflow"],
                i = ["fontSize"],
                b = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
                f = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
                j = a.effects.setMode(c, d.options.mode || "effect"),
                l = d.options.restore || false,
                o = d.options.scale || "both",
                n = d.options.origin,
                k = {
                    height: c.height(),
                    width: c.width()
                };
            c.from = d.options.from || k;
            c.to = d.options.to || k;
            if (n)
            {
                n = a.effects.getBaseline(n, k);
                c.from.top = (k.height - c.from.height) * n.y;
                c.from.left = (k.width - c.from.width) * n.x;
                c.to.top = (k.height - c.to.height) * n.y;
                c.to.left = (k.width - c.to.width) * n.x
            }
            var m = {
                from: {
                    y: c.from.height / k.height,
                    x: c.from.width / k.width
                },
                to: {
                    y: c.to.height / k.height,
                    x: c.to.width / k.width
                }
            };
            if (o == "box" || o == "both")
            {
                if (m.from.y != m.to.y)
                {
                    e = e.concat(b);
                    c.from = a.effects.setTransition(c, b, m.from.y, c.from);
                    c.to = a.effects.setTransition(c, b, m.to.y, c.to)
                }
                if (m.from.x != m.to.x)
                {
                    e = e.concat(f);
                    c.from = a.effects.setTransition(c, f, m.from.x, c.from);
                    c.to = a.effects.setTransition(c, f, m.to.x, c.to)
                }
            }
            if (o == "content" || o == "both") if (m.from.y != m.to.y)
            {
                e = e.concat(i);
                c.from = a.effects.setTransition(c, i, m.from.y, c.from);
                c.to = a.effects.setTransition(c, i, m.to.y, c.to)
            }
            a.effects.save(c, l ? e : h);
            c.show();
            a.effects.createWrapper(c);
            c.css("overflow", "hidden").css(c.from);
            if (o == "content" || o == "both")
            {
                b = b.concat(["marginTop", "marginBottom"]).concat(i);
                f = f.concat(["marginLeft", "marginRight"]);
                g = e.concat(b).concat(f);
                c.find("*[width]").each(function ()
                {
                    child = a(this);
                    l && a.effects.save(child, g);
                    var p = {
                        height: child.height(),
                        width: child.width()
                    };
                    child.from = {
                        height: p.height * m.from.y,
                        width: p.width * m.from.x
                    };
                    child.to = {
                        height: p.height * m.to.y,
                        width: p.width * m.to.x
                    };
                    if (m.from.y != m.to.y)
                    {
                        child.from = a.effects.setTransition(child, b, m.from.y, child.from);
                        child.to = a.effects.setTransition(child, b, m.to.y, child.to)
                    }
                    if (m.from.x != m.to.x)
                    {
                        child.from = a.effects.setTransition(child, f, m.from.x, child.from);
                        child.to = a.effects.setTransition(child, f, m.to.x, child.to)
                    }
                    child.css(child.from);
                    child.animate(child.to, d.duration, d.options.easing, function ()
                    {
                        l && a.effects.restore(child, g)
                    })
                })
            }
            c.animate(c.to, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    c.to.opacity === 0 && c.css("opacity", c.from.opacity);
                    j == "hide" && c.hide();
                    a.effects.restore(c, l ? e : h);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(this, arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.shake = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right"];
            a.effects.setMode(c, d.options.mode || "effect");
            var h = d.options.direction || "left",
                g = d.options.distance || 20,
                i = d.options.times || 3,
                b = d.duration || d.options.duration || 140;
            a.effects.save(c, e);
            c.show();
            a.effects.createWrapper(c);
            var f = h == "up" || h == "down" ? "top" : "left",
                j = h == "up" || h == "left" ? "pos" : "neg";
            h = {};
            var l = {},
                o = {};
            h[f] = (j == "pos" ? "-=" : "+=") + g;
            l[f] = (j == "pos" ? "+=" : "-=") + g * 2;
            o[f] = (j == "pos" ? "-=" : "+=") + g * 2;
            c.animate(h, b, d.options.easing);
            for (g = 1; g < i; g++) c.animate(l, b, d.options.easing).animate(o, b, d.options.easing);
            c.animate(l, b, d.options.easing).animate(h, b / 2, d.options.easing, function ()
            {
                a.effects.restore(c, e);
                a.effects.removeWrapper(c);
                d.callback && d.callback.apply(this, arguments)
            });
            c.queue("fx", function ()
            {
                c.dequeue()
            });
            c.dequeue()
        })
    }
})(jQuery);
(function (a)
{
    a.effects.slide = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = ["position", "top", "bottom", "left", "right"],
                h = a.effects.setMode(c, d.options.mode || "show"),
                g = d.options.direction || "left";
            a.effects.save(c, e);
            c.show();
            a.effects.createWrapper(c).css(
            {
                overflow: "hidden"
            });
            var i = g == "up" || g == "down" ? "top" : "left";
            g = g == "up" || g == "left" ? "pos" : "neg";
            var b = d.options.distance || (i == "top" ? c.outerHeight(
            {
                margin: true
            }) : c.outerWidth(
            {
                margin: true
            }));
            if (h == "show") c.css(i, g == "pos" ? isNaN(b) ? "-" + b : -b : b);
            var f = {};
            f[i] = (h == "show" ? g == "pos" ? "+=" : "-=" : g == "pos" ? "-=" : "+=") + b;
            c.animate(f, {
                queue: false,
                duration: d.duration,
                easing: d.options.easing,
                complete: function ()
                {
                    h == "hide" && c.hide();
                    a.effects.restore(c, e);
                    a.effects.removeWrapper(c);
                    d.callback && d.callback.apply(this, arguments);
                    c.dequeue()
                }
            })
        })
    }
})(jQuery);
(function (a)
{
    a.effects.transfer = function (d)
    {
        return this.queue(function ()
        {
            var c = a(this),
                e = a(d.options.to),
                h = e.offset();
            e = {
                top: h.top,
                left: h.left,
                height: e.innerHeight(),
                width: e.innerWidth()
            };
            h = c.offset();
            var g = a('<div class="ui-effects-transfer"></div>').appendTo(document.body).addClass(d.options.className).css(
            {
                top: h.top,
                left: h.left,
                height: c.innerHeight(),
                width: c.innerWidth(),
                position: "absolute"
            }).animate(e, d.duration, d.options.easing, function ()
            {
                g.remove();
                d.callback && d.callback.apply(c[0], arguments);
                c.dequeue()
            })
        })
    }
})(jQuery);
(function (a)
{
    a.widget("ui.accordion", {
        options: {
            active: 0,
            animated: "slide",
            autoHeight: true,
            clearStyle: false,
            collapsible: false,
            event: "click",
            fillSpace: false,
            header: "> li > :first-child,> :not(li):even",
            icons: {
                header: "ui-icon-triangle-1-e",
                headerSelected: "ui-icon-triangle-1-s"
            },
            navigation: false,
            navigationFilter: function ()
            {
                return this.href.toLowerCase() === location.href.toLowerCase()
            }
        },
        _create: function ()
        {
            var d = this,
                c = d.options;
            d.running = 0;
            d.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix");
            d.headers = d.element.find(c.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion", function ()
            {
                c.disabled || a(this).addClass("ui-state-hover")
            }).bind("mouseleave.accordion", function ()
            {
                c.disabled || a(this).removeClass("ui-state-hover")
            }).bind("focus.accordion", function ()
            {
                c.disabled || a(this).addClass("ui-state-focus")
            }).bind("blur.accordion", function ()
            {
                c.disabled || a(this).removeClass("ui-state-focus")
            });
            d.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
            if (c.navigation)
            {
                var e = d.element.find("a").filter(c.navigationFilter).eq(0);
                if (e.length)
                {
                    var h = e.closest(".ui-accordion-header");
                    d.active = h.length ? h : e.closest(".ui-accordion-content").prev()
                }
            }
            d.active = d._findActive(d.active || c.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");
            d.active.next().addClass("ui-accordion-content-active");
            d._createIcons();
            d.resize();
            d.element.attr("role", "tablist");
            d.headers.attr("role", "tab").bind("keydown.accordion", function (g)
            {
                return d._keydown(g)
            }).next().attr("role", "tabpanel");
            d.headers.not(d.active || "").attr(
            {
                "aria-expanded": "false",
                "aria-selected": "false",
                tabIndex: -1
            }).next().hide();
            d.active.length ? d.active.attr(
            {
                "aria-expanded": "true",
                "aria-selected": "true",
                tabIndex: 0
            }) : d.headers.eq(0).attr("tabIndex", 0);
            a.browser.safari || d.headers.find("a").attr("tabIndex", -1);
            c.event && d.headers.bind(c.event.split(" ").join(".accordion ") + ".accordion", function (g)
            {
                d._clickHandler.call(d, g, this);
                g.preventDefault()
            })
        },
        _createIcons: function ()
        {
            var d = this.options;
            if (d.icons)
            {
                a("<span></span>").addClass("ui-icon " + d.icons.header).prependTo(this.headers);
                this.active.children(".ui-icon").toggleClass(d.icons.header).toggleClass(d.icons.headerSelected);
                this.element.addClass("ui-accordion-icons")
            }
        },
        _destroyIcons: function ()
        {
            this.headers.children(".ui-icon").remove();
            this.element.removeClass("ui-accordion-icons")
        },
        destroy: function ()
        {
            var d = this.options;
            this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");
            this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("tabIndex");
            this.headers.find("a").removeAttr("tabIndex");
            this._destroyIcons();
            var c = this.headers.next().css("display", "").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");
            if (d.autoHeight || d.fillHeight) c.css("height", "");
            return a.Widget.prototype.destroy.call(this)
        },
        _setOption: function (d, c)
        {
            a.Widget.prototype._setOption.apply(this, arguments);
            d == "active" && this.activate(c);
            if (d == "icons")
            {
                this._destroyIcons();
                c && this._createIcons()
            }
            if (d == "disabled") this.headers.add(this.headers.next())[c ? "addClass" : "removeClass"]("ui-accordion-disabled ui-state-disabled")
        },
        _keydown: function (d)
        {
            if (!(this.options.disabled || d.altKey || d.ctrlKey))
            {
                var c = a.ui.keyCode,
                    e = this.headers.length,
                    h = this.headers.index(d.target),
                    g = false;
                switch (d.keyCode)
                {
                case c.RIGHT:
                case c.DOWN:
                    g = this.headers[(h + 1) % e];
                    break;
                case c.LEFT:
                case c.UP:
                    g = this.headers[(h - 1 + e) % e];
                    break;
                case c.SPACE:
                case c.ENTER:
                    this._clickHandler(
                    {
                        target: d.target
                    }, d.target);
                    d.preventDefault()
                }
                if (g)
                {
                    a(d.target).attr("tabIndex", -1);
                    a(g).attr("tabIndex", 0);
                    g.focus();
                    return false
                }
                return true
            }
        },
        resize: function ()
        {
            var d = this.options,
                c;
            if (d.fillSpace)
            {
                if (a.browser.msie)
                {
                    var e = this.element.parent().css("overflow");
                    this.element.parent().css("overflow", "hidden")
                }
                c = this.element.parent().height();
                a.browser.msie && this.element.parent().css("overflow", e);
                this.headers.each(function ()
                {
                    c -= a(this).outerHeight(true)
                });
                this.headers.next().each(function ()
                {
                    a(this).height(Math.max(0, c - a(this).innerHeight() + a(this).height()))
                }).css("overflow", "auto")
            }
            else if (d.autoHeight)
            {
                c = 0;
                this.headers.next().each(function ()
                {
                    c = Math.max(c, a(this).height("").height())
                }).height(c)
            }
            return this
        },
        activate: function (d)
        {
            this.options.active = d;
            d = this._findActive(d)[0];
            this._clickHandler(
            {
                target: d
            }, d);
            return this
        },
        _findActive: function (d)
        {
            return d ? typeof d === "number" ? this.headers.filter(":eq(" + d + ")") : this.headers.not(this.headers.not(d)) : d === false ? a([]) : this.headers.filter(":eq(0)")
        },
        _clickHandler: function (d, c)
        {
            var e = this.options;
            if (!e.disabled) if (d.target)
            {
                d = a(d.currentTarget || c);
                c = d[0] === this.active[0];
                e.active = e.collapsible && c ? false : this.headers.index(d);
                if (!(this.running || !e.collapsible && c))
                {
                    var h = this.active;
                    f = d.next();
                    i = this.active.next();
                    b = {
                        options: e,
                        newHeader: c && e.collapsible ? a([]) : d,
                        oldHeader: this.active,
                        newContent: c && e.collapsible ? a([]) : f,
                        oldContent: i
                    };
                    var g = this.headers.index(this.active[0]) > this.headers.index(d[0]);
                    this.active = c ? a([]) : d;
                    this._toggle(f, i, b, c, g);
                    h.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(e.icons.headerSelected).addClass(e.icons.header);
                    if (!c)
                    {
                        d.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(e.icons.header).addClass(e.icons.headerSelected);
                        d.next().addClass("ui-accordion-content-active")
                    }
                }
            }
            else if (e.collapsible)
            {
                this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(e.icons.headerSelected).addClass(e.icons.header);
                this.active.next().addClass("ui-accordion-content-active");
                var i = this.active.next(),
                    b = {
                        options: e,
                        newHeader: a([]),
                        oldHeader: e.active,
                        newContent: a([]),
                        oldContent: i
                    },
                    f = this.active = a([]);
                this._toggle(f, i, b)
            }
        },
        _toggle: function (d, c, e, h, g)
        {
            var i = this,
                b = i.options;
            i.toShow = d;
            i.toHide = c;
            i.data = e;
            var f = function ()
                {
                    if (i) return i._completed.apply(i, arguments)
                };
            i._trigger("changestart", null, i.data);
            i.running = c.size() === 0 ? d.size() : c.size();
            if (b.animated)
            {
                e = {};
                e = b.collapsible && h ? {
                    toShow: a([]),
                    toHide: c,
                    complete: f,
                    down: g,
                    autoHeight: b.autoHeight || b.fillSpace
                } : {
                    toShow: d,
                    toHide: c,
                    complete: f,
                    down: g,
                    autoHeight: b.autoHeight || b.fillSpace
                };
                if (!b.proxied) b.proxied = b.animated;
                if (!b.proxiedDuration) b.proxiedDuration = b.duration;
                b.animated = a.isFunction(b.proxied) ? b.proxied(e) : b.proxied;
                b.duration = a.isFunction(b.proxiedDuration) ? b.proxiedDuration(e) : b.proxiedDuration;
                h = a.ui.accordion.animations;
                var j = b.duration,
                    l = b.animated;
                if (l && !h[l] && !a.easing[l]) l = "slide";
                h[l] || (h[l] = function (o)
                {
                    this.slide(o, {
                        easing: l,
                        duration: j || 700
                    })
                });
                h[l](e)
            }
            else
            {
                if (b.collapsible && h) d.toggle();
                else
                {
                    c.hide();
                    d.show()
                }
                f(true)
            }
            c.prev().attr(
            {
                "aria-expanded": "false",
                "aria-selected": "false",
                tabIndex: -1
            }).blur();
            d.prev().attr(
            {
                "aria-expanded": "true",
                "aria-selected": "true",
                tabIndex: 0
            }).focus()
        },
        _completed: function (d)
        {
            this.running = d ? 0 : --this.running;
            if (!this.running)
            {
                this.options.clearStyle && this.toShow.add(this.toHide).css(
                {
                    height: "",
                    overflow: ""
                });
                this.toHide.removeClass("ui-accordion-content-active");
                if (this.toHide.length) this.toHide.parent()[0].className = this.toHide.parent()[0].className;
                this._trigger("change", null, this.data)
            }
        }
    });
    a.extend(a.ui.accordion, {
        version: "1.8.16",
        animations: {
            slide: function (d, c)
            {
                d = a.extend(
                {
                    easing: "swing",
                    duration: 300
                }, d, c);
                if (d.toHide.size()) if (d.toShow.size())
                {
                    var e = d.toShow.css("overflow"),
                        h = 0,
                        g = {},
                        i = {},
                        b;
                    c = d.toShow;
                    b = c[0].style.width;
                    c.width(parseInt(c.parent().width(), 10) - parseInt(c.css("paddingLeft"), 10) - parseInt(c.css("paddingRight"), 10) - (parseInt(c.css("borderLeftWidth"), 10) || 0) - (parseInt(c.css("borderRightWidth"), 10) || 0));
                    a.each(["height", "paddingTop", "paddingBottom"], function (f, j)
                    {
                        i[j] = "hide";
                        f = ("" + a.css(d.toShow[0], j)).match(/^([\d+-.]+)(.*)$/);
                        g[j] = {
                            value: f[1],
                            unit: f[2] || "px"
                        }
                    });
                    d.toShow.css(
                    {
                        height: 0,
                        overflow: "hidden"
                    }).show();
                    d.toHide.filter(":hidden").each(d.complete).end().filter(":visible").animate(i, {
                        step: function (f, j)
                        {
                            if (j.prop == "height") h = j.end - j.start === 0 ? 0 : (j.now - j.start) / (j.end - j.start);
                            d.toShow[0].style[j.prop] = h * g[j.prop].value + g[j.prop].unit
                        },
                        duration: d.duration,
                        easing: d.easing,
                        complete: function ()
                        {
                            d.autoHeight || d.toShow.css("height", "");
                            d.toShow.css(
                            {
                                width: b,
                                overflow: e
                            });
                            d.complete()
                        }
                    })
                }
                else d.toHide.animate(
                {
                    height: "hide",
                    paddingTop: "hide",
                    paddingBottom: "hide"
                }, d);
                else d.toShow.animate(
                {
                    height: "show",
                    paddingTop: "show",
                    paddingBottom: "show"
                }, d)
            },
            bounceslide: function (d)
            {
                this.slide(d, {
                    easing: d.down ? "easeOutBounce" : "swing",
                    duration: d.down ? 1E3 : 200
                })
            }
        }
    })
})(jQuery);
(function (a)
{
    var d = 0;
    a.widget("ui.autocomplete", {
        options: {
            appendTo: "body",
            autoFocus: false,
            delay: 300,
            minLength: 1,
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            source: null
        },
        pending: 0,
        _create: function ()
        {
            var c = this,
                e = this.element[0].ownerDocument,
                h;
            this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off").attr(
            {
                role: "textbox",
                "aria-autocomplete": "list",
                "aria-haspopup": "true"
            }).bind("keydown.autocomplete", function (g)
            {
                if (!(c.options.disabled || c.element.propAttr("readOnly")))
                {
                    h = false;
                    var i = a.ui.keyCode;
                    switch (g.keyCode)
                    {
                    case i.PAGE_UP:
                        c._move("previousPage", g);
                        break;
                    case i.PAGE_DOWN:
                        c._move("nextPage", g);
                        break;
                    case i.UP:
                        c._move("previous", g);
                        g.preventDefault();
                        break;
                    case i.DOWN:
                        c._move("next", g);
                        g.preventDefault();
                        break;
                    case i.ENTER:
                    case i.NUMPAD_ENTER:
                        if (c.menu.active)
                        {
                            h = true;
                            g.preventDefault()
                        }
                    case i.TAB:
                        if (!c.menu.active) return;
                        c.menu.select(g);
                        break;
                    case i.ESCAPE:
                        c.element.val(c.term);
                        c.close(g);
                        break;
                    default:
                        clearTimeout(c.searching);
                        c.searching = setTimeout(function ()
                        {
                            if (c.term != c.element.val())
                            {
                                c.selectedItem = null;
                                c.search(null, g)
                            }
                        }, c.options.delay);
                        break
                    }
                }
            }).bind("keypress.autocomplete", function (g)
            {
                if (h)
                {
                    h = false;
                    g.preventDefault()
                }
            }).bind("focus.autocomplete", function ()
            {
                if (!c.options.disabled)
                {
                    c.selectedItem = null;
                    c.previous = c.element.val()
                }
            }).bind("blur.autocomplete", function (g)
            {
                if (!c.options.disabled)
                {
                    clearTimeout(c.searching);
                    c.closing = setTimeout(function ()
                    {
                        c.close(g);
                        c._change(g)
                    }, 150)
                }
            });
            this._initSource();
            this.response = function ()
            {
                return c._response.apply(c, arguments)
            };
            this.menu = a("<ul></ul>").addClass("ui-autocomplete").appendTo(a(this.options.appendTo || "body", e)[0]).mousedown(function (g)
            {
                var i = c.menu.element[0];
                a(g.target).closest(".ui-menu-item").length || setTimeout(function ()
                {
                    a(document).one("mousedown", function (b)
                    {
                        b.target !== c.element[0] && b.target !== i && !a.ui.contains(i, b.target) && c.close()
                    })
                }, 1);
                setTimeout(function ()
                {
                    clearTimeout(c.closing)
                }, 13)
            }).menu(
            {
                focus: function (g, i)
                {
                    i = i.item.data("item.autocomplete");
                    false !== c._trigger("focus", g, {
                        item: i
                    }) && /^key/.test(g.originalEvent.type) && c.element.val(i.value)
                },
                selected: function (g, i)
                {
                    var b = i.item.data("item.autocomplete"),
                        f = c.previous;
                    if (c.element[0] !== e.activeElement)
                    {
                        c.element.focus();
                        c.previous = f;
                        setTimeout(function ()
                        {
                            c.previous = f;
                            c.selectedItem = b
                        }, 1)
                    }
                    false !== c._trigger("select", g, {
                        item: b
                    }) && c.element.val(b.value);
                    c.term = c.element.val();
                    c.close(g);
                    c.selectedItem = b
                },
                blur: function ()
                {
                    c.menu.element.is(":visible") && c.element.val() !== c.term && c.element.val(c.term)
                }
            }).zIndex(this.element.zIndex() + 1).css(
            {
                top: 0,
                left: 0
            }).hide().data("menu");
            a.fn.bgiframe && this.menu.element.bgiframe()
        },
        destroy: function ()
        {
            this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete").removeAttr("role").removeAttr("aria-autocomplete").removeAttr("aria-haspopup");
            this.menu.element.remove();
            a.Widget.prototype.destroy.call(this)
        },
        _setOption: function (c, e)
        {
            a.Widget.prototype._setOption.apply(this, arguments);
            c === "source" && this._initSource();
            if (c === "appendTo") this.menu.element.appendTo(a(e || "body", this.element[0].ownerDocument)[0]);
            c === "disabled" && e && this.xhr && this.xhr.abort()
        },
        _initSource: function ()
        {
            var c = this,
                e, h;
            if (a.isArray(this.options.source))
            {
                e = this.options.source;
                this.source = function (g, i)
                {
                    i(a.ui.autocomplete.filter(e, g.term))
                }
            }
            else if (typeof this.options.source === "string")
            {
                h = this.options.source;
                this.source = function (g, i)
                {
                    c.xhr && c.xhr.abort();
                    c.xhr = a.ajax(
                    {
                        url: h,
                        data: g,
                        dataType: "json",
                        autocompleteRequest: ++d,
                        success: function (b)
                        {
                            this.autocompleteRequest === d && i(b)
                        },
                        error: function ()
                        {
                            this.autocompleteRequest === d && i([])
                        }
                    })
                }
            }
            else this.source = this.options.source
        },
        search: function (c, e)
        {
            c = c != null ? c : this.element.val();
            this.term = this.element.val();
            if (c.length < this.options.minLength) return this.close(e);
            clearTimeout(this.closing);
            if (this._trigger("search", e) !== false) return this._search(c)
        },
        _search: function (c)
        {
            this.pending++;
            this.element.addClass("ui-autocomplete-loading");
            this.source(
            {
                term: c
            }, this.response)
        },
        _response: function (c)
        {
            if (!this.options.disabled && c && c.length)
            {
                c = this._normalize(c);
                this._suggest(c);
                this._trigger("open")
            }
            else this.close();
            this.pending--;
            this.pending || this.element.removeClass("ui-autocomplete-loading")
        },
        close: function (c)
        {
            clearTimeout(this.closing);
            if (this.menu.element.is(":visible"))
            {
                this.menu.element.hide();
                this.menu.deactivate();
                this._trigger("close", c)
            }
        },
        _change: function (c)
        {
            this.previous !== this.element.val() && this._trigger("change", c, {
                item: this.selectedItem
            })
        },
        _normalize: function (c)
        {
            if (c.length && c[0].label && c[0].value) return c;
            return a.map(c, function (e)
            {
                if (typeof e === "string") return {
                    label: e,
                    value: e
                };
                return a.extend(
                {
                    label: e.label || e.value,
                    value: e.value || e.label
                }, e)
            })
        },
        _suggest: function (c)
        {
            var e = this.menu.element.empty().zIndex(this.element.zIndex() + 1);
            this._renderMenu(e, c);
            this.menu.deactivate();
            this.menu.refresh();
            e.show();
            this._resizeMenu();
            e.position(a.extend(
            {
                of: this.element
            }, this.options.position));
            this.options.autoFocus && this.menu.next(new a.Event("mouseover"))
        },
        _resizeMenu: function ()
        {
            var c = this.menu.element;
            c.outerWidth(Math.max(c.width("").outerWidth(), this.element.outerWidth()))
        },
        _renderMenu: function (c, e)
        {
            var h = this;
            a.each(e, function (g, i)
            {
                h._renderItem(c, i)
            })
        },
        _renderItem: function (c, e)
        {
            return a("<li></li>").data("item.autocomplete", e).append(a("<a></a>").text(e.label)).appendTo(c)
        },
        _move: function (c, e)
        {
            if (this.menu.element.is(":visible")) if (this.menu.first() && /^previous/.test(c) || this.menu.last() && /^next/.test(c))
            {
                this.element.val(this.term);
                this.menu.deactivate()
            }
            else this.menu[c](e);
            else this.search(null, e)
        },
        widget: function ()
        {
            return this.menu.element
        }
    });
    a.extend(a.ui.autocomplete, {
        escapeRegex: function (c)
        {
            return c.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")
        },
        filter: function (c, e)
        {
            var h = new RegExp(a.ui.autocomplete.escapeRegex(e), "i");
            return a.grep(c, function (g)
            {
                return h.test(g.label || g.value || g)
            })
        }
    })
})(jQuery);
(function (a)
{
    a.widget("ui.menu", {
        _create: function ()
        {
            var d = this;
            this.element.addClass("ui-menu ui-widget ui-widget-content ui-corner-all").attr(
            {
                role: "listbox",
                "aria-activedescendant": "ui-active-menuitem"
            }).click(function (c)
            {
                if (a(c.target).closest(".ui-menu-item a").length)
                {
                    c.preventDefault();
                    d.select(c)
                }
            });
            this.refresh()
        },
        refresh: function ()
        {
            var d = this;
            this.element.children("li:not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "menuitem").children("a").addClass("ui-corner-all").attr("tabindex", -1).mouseenter(function (c)
            {
                d.activate(c, a(this).parent())
            }).mouseleave(function ()
            {
                d.deactivate()
            })
        },
        activate: function (d, c)
        {
            this.deactivate();
            if (this.hasScroll())
            {
                var e = c.offset().top - this.element.offset().top,
                    h = this.element.scrollTop(),
                    g = this.element.height();
                if (e < 0) this.element.scrollTop(h + e);
                else e >= g && this.element.scrollTop(h + e - g + c.height())
            }
            this.active = c.eq(0).children("a").addClass("ui-state-hover").attr("id", "ui-active-menuitem").end();
            this._trigger("focus", d, {
                item: c
            })
        },
        deactivate: function ()
        {
            if (this.active)
            {
                this.active.children("a").removeClass("ui-state-hover").removeAttr("id");
                this._trigger("blur");
                this.active = null
            }
        },
        next: function (d)
        {
            this.move("next", ".ui-menu-item:first", d)
        },
        previous: function (d)
        {
            this.move("prev", ".ui-menu-item:last", d)
        },
        first: function ()
        {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        last: function ()
        {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        move: function (d, c, e)
        {
            if (this.active)
            {
                d = this.active[d + "All"](".ui-menu-item").eq(0);
                d.length ? this.activate(e, d) : this.activate(e, this.element.children(c))
            }
            else this.activate(e, this.element.children(c))
        },
        nextPage: function (d)
        {
            if (this.hasScroll()) if (!this.active || this.last()) this.activate(d, this.element.children(".ui-menu-item:first"));
            else
            {
                var c = this.active.offset().top,
                    e = this.element.height(),
                    h = this.element.children(".ui-menu-item").filter(function ()
                    {
                        var g = a(this).offset().top - c - e + a(this).height();
                        return g < 10 && g > -10
                    });
                h.length || (h = this.element.children(".ui-menu-item:last"));
                this.activate(d, h)
            }
            else this.activate(d, this.element.children(".ui-menu-item").filter(!this.active || this.last() ? ":first" : ":last"))
        },
        previousPage: function (d)
        {
            if (this.hasScroll()) if (!this.active || this.first()) this.activate(d, this.element.children(".ui-menu-item:last"));
            else
            {
                var c = this.active.offset().top,
                    e = this.element.height();
                result = this.element.children(".ui-menu-item").filter(function ()
                {
                    var h = a(this).offset().top - c + e - a(this).height();
                    return h < 10 && h > -10
                });
                result.length || (result = this.element.children(".ui-menu-item:first"));
                this.activate(d, result)
            }
            else this.activate(d, this.element.children(".ui-menu-item").filter(!this.active || this.first() ? ":last" : ":first"))
        },
        hasScroll: function ()
        {
            return this.element.height() < this.element[a.fn.prop ? "prop" : "attr"]("scrollHeight")
        },
        select: function (d)
        {
            this._trigger("selected", d, {
                item: this.active
            })
        }
    })
})(jQuery);
(function (a)
{
    var d, c, e, h, g = function ()
        {
            var b = a(this).find(":ui-button");
            setTimeout(function ()
            {
                b.button("refresh")
            }, 1)
        },
        i = function (b)
        {
            var f = b.name,
                j = b.form,
                l = a([]);
            if (f) l = j ? a(j).find("[name='" + f + "']") : a("[name='" + f + "']", b.ownerDocument).filter(function ()
            {
                return !this.form
            });
            return l
        };
    a.widget("ui.button", {
        options: {
            disabled: null,
            text: true,
            label: null,
            icons: {
                primary: null,
                secondary: null
            }
        },
        _create: function ()
        {
            this.element.closest("form").unbind("reset.button").bind("reset.button", g);
            if (typeof this.options.disabled !== "boolean") this.options.disabled = this.element.propAttr("disabled");
            this._determineButtonType();
            this.hasTitle = !! this.buttonElement.attr("title");
            var b = this,
                f = this.options,
                j = this.type === "checkbox" || this.type === "radio",
                l = "ui-state-hover" + (!j ? " ui-state-active" : "");
            if (f.label === null) f.label = this.buttonElement.html();
            if (this.element.is(":disabled")) f.disabled = true;
            this.buttonElement.addClass("ui-button ui-widget ui-state-default ui-corner-all").attr("role", "button").bind("mouseenter.button", function ()
            {
                if (!f.disabled)
                {
                    a(this).addClass("ui-state-hover");
                    this === d && a(this).addClass("ui-state-active")
                }
            }).bind("mouseleave.button", function ()
            {
                f.disabled || a(this).removeClass(l)
            }).bind("click.button", function (o)
            {
                if (f.disabled)
                {
                    o.preventDefault();
                    o.stopImmediatePropagation()
                }
            });
            this.element.bind("focus.button", function ()
            {
                b.buttonElement.addClass("ui-state-focus")
            }).bind("blur.button", function ()
            {
                b.buttonElement.removeClass("ui-state-focus")
            });
            if (j)
            {
                this.element.bind("change.button", function ()
                {
                    h || b.refresh()
                });
                this.buttonElement.bind("mousedown.button", function (o)
                {
                    if (!f.disabled)
                    {
                        h = false;
                        c = o.pageX;
                        e = o.pageY
                    }
                }).bind("mouseup.button", function (o)
                {
                    if (!f.disabled) if (c !== o.pageX || e !== o.pageY) h = true
                })
            }
            if (this.type === "checkbox") this.buttonElement.bind("click.button", function ()
            {
                if (f.disabled || h) return false;
                a(this).toggleClass("ui-state-active");
                b.buttonElement.attr("aria-pressed", b.element[0].checked)
            });
            else if (this.type === "radio") this.buttonElement.bind("click.button", function ()
            {
                if (f.disabled || h) return false;
                a(this).addClass("ui-state-active");
                b.buttonElement.attr("aria-pressed", "true");
                var o = b.element[0];
                i(o).not(o).map(function ()
                {
                    return a(this).button("widget")[0]
                }).removeClass("ui-state-active").attr("aria-pressed", "false")
            });
            else
            {
                this.buttonElement.bind("mousedown.button", function ()
                {
                    if (f.disabled) return false;
                    a(this).addClass("ui-state-active");
                    d = this;
                    a(document).one("mouseup", function ()
                    {
                        d = null
                    })
                }).bind("mouseup.button", function ()
                {
                    if (f.disabled) return false;
                    a(this).removeClass("ui-state-active")
                }).bind("keydown.button", function (o)
                {
                    if (f.disabled) return false;
                    if (o.keyCode == a.ui.keyCode.SPACE || o.keyCode == a.ui.keyCode.ENTER) a(this).addClass("ui-state-active")
                }).bind("keyup.button", function ()
                {
                    a(this).removeClass("ui-state-active")
                });
                this.buttonElement.is("a") && this.buttonElement.keyup(function (o)
                {
                    o.keyCode === a.ui.keyCode.SPACE && a(this).click()
                })
            }
            this._setOption("disabled", f.disabled);
            this._resetButton()
        },
        _determineButtonType: function ()
        {
            this.type = this.element.is(":checkbox") ? "checkbox" : this.element.is(":radio") ? "radio" : this.element.is("input") ? "input" : "button";
            if (this.type === "checkbox" || this.type === "radio")
            {
                var b = this.element.parents().filter(":last"),
                    f = "label[for='" + this.element.attr("id") + "']";
                this.buttonElement = b.find(f);
                if (!this.buttonElement.length)
                {
                    b = b.length ? b.siblings() : this.element.siblings();
                    this.buttonElement = b.filter(f);
                    if (!this.buttonElement.length) this.buttonElement = b.find(f)
                }
                this.element.addClass("ui-helper-hidden-accessible");
                (b = this.element.is(":checked")) && this.buttonElement.addClass("ui-state-active");
                this.buttonElement.attr("aria-pressed", b)
            }
            else this.buttonElement = this.element
        },
        widget: function ()
        {
            return this.buttonElement
        },
        destroy: function ()
        {
            this.element.removeClass("ui-helper-hidden-accessible");
            this.buttonElement.removeClass("ui-button ui-widget ui-state-default ui-corner-all ui-state-hover ui-state-active  ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only").removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html());
            this.hasTitle || this.buttonElement.removeAttr("title");
            a.Widget.prototype.destroy.call(this)
        },
        _setOption: function (b, f)
        {
            a.Widget.prototype._setOption.apply(this, arguments);
            if (b === "disabled") f ? this.element.propAttr("disabled", true) : this.element.propAttr("disabled", false);
            else this._resetButton()
        },
        refresh: function ()
        {
            var b = this.element.is(":disabled");
            b !== this.options.disabled && this._setOption("disabled", b);
            if (this.type === "radio") i(this.element[0]).each(function ()
            {
                a(this).is(":checked") ? a(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : a(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            });
            else if (this.type === "checkbox") this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false")
        },
        _resetButton: function ()
        {
            if (this.type === "input") this.options.label && this.element.val(this.options.label);
            else
            {
                var b = this.buttonElement.removeClass("ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only"),
                    f = a("<span></span>").addClass("ui-button-text").html(this.options.label).appendTo(b.empty()).text(),
                    j = this.options.icons,
                    l = j.primary && j.secondary,
                    o = [];
                if (j.primary || j.secondary)
                {
                    if (this.options.text) o.push("ui-button-text-icon" + (l ? "s" : j.primary ? "-primary" : "-secondary"));
                    j.primary && b.prepend("<span class='ui-button-icon-primary ui-icon " + j.primary + "'></span>");
                    j.secondary && b.append("<span class='ui-button-icon-secondary ui-icon " + j.secondary + "'></span>");
                    if (!this.options.text)
                    {
                        o.push(l ? "ui-button-icons-only" : "ui-button-icon-only");
                        this.hasTitle || b.attr("title", f)
                    }
                }
                else o.push("ui-button-text-only");
                b.addClass(o.join(" "))
            }
        }
    });
    a.widget("ui.buttonset", {
        options: {
            items: ":button, :submit, :reset, :checkbox, :radio, a, :data(button)"
        },
        _create: function ()
        {
            this.element.addClass("ui-buttonset")
        },
        _init: function ()
        {
            this.refresh()
        },
        _setOption: function (b, f)
        {
            b === "disabled" && this.buttons.button("option", b, f);
            a.Widget.prototype._setOption.apply(this, arguments)
        },
        refresh: function ()
        {
            var b = this.element.css("direction") === "ltr";
            this.buttons = this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function ()
            {
                return a(this).button("widget")[0]
            }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(b ? "ui-corner-left" : "ui-corner-right").end().filter(":last").addClass(b ? "ui-corner-right" : "ui-corner-left").end().end()
        },
        destroy: function ()
        {
            this.element.removeClass("ui-buttonset");
            this.buttons.map(function ()
            {
                return a(this).button("widget")[0]
            }).removeClass("ui-corner-left ui-corner-right").end().button("destroy");
            a.Widget.prototype.destroy.call(this)
        }
    })
})(jQuery);
(function (a, d)
{
    function c()
    {
        this.debug = false;
        this._curInst = null;
        this._keyEvent = false;
        this._disabledInputs = [];
        this._inDialog = this._datepickerShowing = false;
        this._mainDivId = "ui-datepicker-div";
        this._inlineClass = "ui-datepicker-inline";
        this._appendClass = "ui-datepicker-append";
        this._triggerClass = "ui-datepicker-trigger";
        this._dialogClass = "ui-datepicker-dialog";
        this._disableClass = "ui-datepicker-disabled";
        this._unselectableClass = "ui-datepicker-unselectable";
        this._currentClass = "ui-datepicker-current-day";
        this._dayOverClass = "ui-datepicker-days-cell-over";
        this.regional = [];
        this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: false,
            hideIfNoPrevNext: false,
            navigationAsDateFormat: false,
            gotoCurrent: false,
            changeMonth: false,
            changeYear: false,
            yearRange: "c-10:c+10",
            showOtherMonths: false,
            selectOtherMonths: false,
            showWeek: false,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: true,
            showButtonPanel: false,
            autoSize: false,
            disabled: false
        };
        a.extend(this._defaults, this.regional[""]);
        this.dpDiv = e(a('<div id="' + this._mainDivId + '" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>'))
    }
    function e(b)
    {
        return b.bind("mouseout", function (f)
        {
            f = a(f.target).closest("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a");
            f.length && f.removeClass("ui-state-hover ui-datepicker-prev-hover ui-datepicker-next-hover")
        }).bind("mouseover", function (f)
        {
            f = a(f.target).closest("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a");
            if (!(a.datepicker._isDisabledDatepicker(i.inline ? b.parent()[0] : i.input[0]) || !f.length))
            {
                f.parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover");
                f.addClass("ui-state-hover");
                f.hasClass("ui-datepicker-prev") && f.addClass("ui-datepicker-prev-hover");
                f.hasClass("ui-datepicker-next") && f.addClass("ui-datepicker-next-hover")
            }
        })
    }
    function h(b, f)
    {
        a.extend(b, f);
        for (var j in f) if (f[j] == null || f[j] == d) b[j] = f[j];
        return b
    }
    a.extend(a.ui, {
        datepicker: {
            version: "1.8.16"
        }
    });
    var g = (new Date).getTime(),
        i;
    a.extend(c.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        log: function ()
        {
            this.debug && console.log.apply("", arguments)
        },
        _widgetDatepicker: function ()
        {
            return this.dpDiv
        },
        setDefaults: function (b)
        {
            h(this._defaults, b || {});
            return this
        },
        _attachDatepicker: function (b, f)
        {
            var j = null;
            for (var l in this._defaults)
            {
                var o = b.getAttribute("date:" + l);
                if (o)
                {
                    j = j || {};
                    try
                    {
                        j[l] = eval(o)
                    }
                    catch (n)
                    {
                        j[l] = o
                    }
                }
            }
            l = b.nodeName.toLowerCase();
            o = l == "div" || l == "span";
            if (!b.id)
            {
                this.uuid += 1;
                b.id = "dp" + this.uuid
            }
            var k = this._newInst(a(b), o);
            k.settings = a.extend(
            {}, f || {}, j || {});
            if (l == "input") this._connectDatepicker(b, k);
            else o && this._inlineDatepicker(b, k)
        },
        _newInst: function (b, f)
        {
            return {
                id: b[0].id.replace(/([^A-Za-z0-9_-])/g, "\\\\$1"),
                input: b,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: f,
                dpDiv: !f ? this.dpDiv : e(a('<div class="' + this._inlineClass + ' ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>'))
            }
        },
        _connectDatepicker: function (b, f)
        {
            var j = a(b);
            f.append = a([]);
            f.trigger = a([]);
            if (!j.hasClass(this.markerClassName))
            {
                this._attachments(j, f);
                j.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp).bind("setData.datepicker", function (l, o, n)
                {
                    f.settings[o] = n
                }).bind("getData.datepicker", function (l, o)
                {
                    return this._get(f, o)
                });
                this._autoSize(f);
                a.data(b, "datepicker", f);
                f.settings.disabled && this._disableDatepicker(b)
            }
        },
        _attachments: function (b, f)
        {
            var j = this._get(f, "appendText"),
                l = this._get(f, "isRTL");
            f.append && f.append.remove();
            if (j)
            {
                f.append = a('<span class="' + this._appendClass + '">' + j + "</span>");
                b[l ? "before" : "after"](f.append)
            }
            b.unbind("focus", this._showDatepicker);
            f.trigger && f.trigger.remove();
            j = this._get(f, "showOn");
            if (j == "focus" || j == "both") b.focus(this._showDatepicker);
            if (j == "button" || j == "both")
            {
                j = this._get(f, "buttonText");
                var o = this._get(f, "buttonImage");
                f.trigger = a(this._get(f, "buttonImageOnly") ? a("<img/>").addClass(this._triggerClass).attr(
                {
                    src: o,
                    alt: j,
                    title: j
                }) : a('<button type="button"></button>').addClass(this._triggerClass).html(o == "" ? j : a("<img/>").attr(
                {
                    src: o,
                    alt: j,
                    title: j
                })));
                b[l ? "before" : "after"](f.trigger);
                f.trigger.click(function ()
                {
                    a.datepicker._datepickerShowing && a.datepicker._lastInput == b[0] ? a.datepicker._hideDatepicker() : a.datepicker._showDatepicker(b[0]);
                    return false
                })
            }
        },
        _autoSize: function (b)
        {
            if (this._get(b, "autoSize") && !b.inline)
            {
                var f = new Date(2009, 11, 20),
                    j = this._get(b, "dateFormat");
                if (j.match(/[DM]/))
                {
                    var l = function (o)
                        {
                            for (var n = 0, k = 0, m = 0; m < o.length; m++) if (o[m].length > n)
                            {
                                n = o[m].length;
                                k = m
                            }
                            return k
                        };
                    f.setMonth(l(this._get(b, j.match(/MM/) ? "monthNames" : "monthNamesShort")));
                    f.setDate(l(this._get(b, j.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - f.getDay())
                }
                b.input.attr("size", this._formatDate(b, f).length)
            }
        },
        _inlineDatepicker: function (b, f)
        {
            var j = a(b);
            if (!j.hasClass(this.markerClassName))
            {
                j.addClass(this.markerClassName).append(f.dpDiv).bind("setData.datepicker", function (l, o, n)
                {
                    f.settings[o] = n
                }).bind("getData.datepicker", function (l, o)
                {
                    return this._get(f, o)
                });
                a.data(b, "datepicker", f);
                this._setDate(f, this._getDefaultDate(f), true);
                this._updateDatepicker(f);
                this._updateAlternate(f);
                f.settings.disabled && this._disableDatepicker(b);
                f.dpDiv.css("display", "block")
            }
        },
        _dialogDatepicker: function (b, f, j, l, o)
        {
            b = this._dialogInst;
            if (!b)
            {
                this.uuid += 1;
                this._dialogInput = a('<input type="text" id="' + ("dp" + this.uuid) + '" style="position: absolute; top: -100px; width: 0px; z-index: -10;"/>');
                this._dialogInput.keydown(this._doKeyDown);
                a("body").append(this._dialogInput);
                b = this._dialogInst = this._newInst(this._dialogInput, false);
                b.settings = {};
                a.data(this._dialogInput[0], "datepicker", b)
            }
            h(b.settings, l || {});
            f = f && f.constructor == Date ? this._formatDate(b, f) : f;
            this._dialogInput.val(f);
            this._pos = o ? o.length ? o : [o.pageX, o.pageY] : null;
            if (!this._pos) this._pos = [document.documentElement.clientWidth / 2 - 100 + (document.documentElement.scrollLeft || document.body.scrollLeft), document.documentElement.clientHeight / 2 - 150 + (document.documentElement.scrollTop || document.body.scrollTop)];
            this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px");
            b.settings.onSelect = j;
            this._inDialog = true;
            this.dpDiv.addClass(this._dialogClass);
            this._showDatepicker(this._dialogInput[0]);
            a.blockUI && a.blockUI(this.dpDiv);
            a.data(this._dialogInput[0], "datepicker", b);
            return this
        },
        _destroyDatepicker: function (b)
        {
            var f = a(b),
                j = a.data(b, "datepicker");
            if (f.hasClass(this.markerClassName))
            {
                var l = b.nodeName.toLowerCase();
                a.removeData(b, "datepicker");
                if (l == "input")
                {
                    j.append.remove();
                    j.trigger.remove();
                    f.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)
                }
                else if (l == "div" || l == "span") f.removeClass(this.markerClassName).empty()
            }
        },
        _enableDatepicker: function (b)
        {
            var f = a(b),
                j = a.data(b, "datepicker");
            if (f.hasClass(this.markerClassName))
            {
                var l = b.nodeName.toLowerCase();
                if (l == "input")
                {
                    b.disabled = false;
                    j.trigger.filter("button").each(function ()
                    {
                        this.disabled = false
                    }).end().filter("img").css(
                    {
                        opacity: "1.0",
                        cursor: ""
                    })
                }
                else if (l == "div" || l == "span")
                {
                    f = f.children("." + this._inlineClass);
                    f.children().removeClass("ui-state-disabled");
                    f.find("select.ui-datepicker-month, select.ui-datepicker-year").removeAttr("disabled")
                }
                this._disabledInputs = a.map(this._disabledInputs, function (o)
                {
                    return o == b ? null : o
                })
            }
        },
        _disableDatepicker: function (b)
        {
            var f = a(b),
                j = a.data(b, "datepicker");
            if (f.hasClass(this.markerClassName))
            {
                var l = b.nodeName.toLowerCase();
                if (l == "input")
                {
                    b.disabled = true;
                    j.trigger.filter("button").each(function ()
                    {
                        this.disabled = true
                    }).end().filter("img").css(
                    {
                        opacity: "0.5",
                        cursor: "default"
                    })
                }
                else if (l == "div" || l == "span")
                {
                    f = f.children("." + this._inlineClass);
                    f.children().addClass("ui-state-disabled");
                    f.find("select.ui-datepicker-month, select.ui-datepicker-year").attr("disabled", "disabled")
                }
                this._disabledInputs = a.map(this._disabledInputs, function (o)
                {
                    return o == b ? null : o
                });
                this._disabledInputs[this._disabledInputs.length] = b
            }
        },
        _isDisabledDatepicker: function (b)
        {
            if (!b) return false;
            for (var f = 0; f < this._disabledInputs.length; f++) if (this._disabledInputs[f] == b) return true;
            return false
        },
        _getInst: function (b)
        {
            try
            {
                return a.data(b, "datepicker")
            }
            catch (f)
            {
                throw "Missing instance data for this datepicker";
            }
        },
        _optionDatepicker: function (b, f, j)
        {
            var l = this._getInst(b);
            if (arguments.length == 2 && typeof f == "string") return f == "defaults" ? a.extend(
            {}, a.datepicker._defaults) : l ? f == "all" ? a.extend(
            {}, l.settings) : this._get(l, f) : null;
            var o = f || {};
            if (typeof f == "string")
            {
                o = {};
                o[f] = j
            }
            if (l)
            {
                this._curInst == l && this._hideDatepicker();
                var n = this._getDateDatepicker(b, true),
                    k = this._getMinMaxDate(l, "min"),
                    m = this._getMinMaxDate(l, "max");
                h(l.settings, o);
                if (k !== null && o.dateFormat !== d && o.minDate === d) l.settings.minDate = this._formatDate(l, k);
                if (m !== null && o.dateFormat !== d && o.maxDate === d) l.settings.maxDate = this._formatDate(l, m);
                this._attachments(a(b), l);
                this._autoSize(l);
                this._setDate(l, n);
                this._updateAlternate(l);
                this._updateDatepicker(l)
            }
        },
        _changeDatepicker: function (b, f, j)
        {
            this._optionDatepicker(b, f, j)
        },
        _refreshDatepicker: function (b)
        {
            (b = this._getInst(b)) && this._updateDatepicker(b)
        },
        _setDateDatepicker: function (b, f)
        {
            if (b = this._getInst(b))
            {
                this._setDate(b, f);
                this._updateDatepicker(b);
                this._updateAlternate(b)
            }
        },
        _getDateDatepicker: function (b, f)
        {
            (b = this._getInst(b)) && !b.inline && this._setDateFromField(b, f);
            return b ? this._getDate(b) : null
        },
        _doKeyDown: function (b)
        {
            var f = a.datepicker._getInst(b.target),
                j = true,
                l = f.dpDiv.is(".ui-datepicker-rtl");
            f._keyEvent = true;
            if (a.datepicker._datepickerShowing) switch (b.keyCode)
            {
            case 9:
                a.datepicker._hideDatepicker();
                j = false;
                break;
            case 13:
                j = a("td." + a.datepicker._dayOverClass + ":not(." + a.datepicker._currentClass + ")", f.dpDiv);
                j[0] && a.datepicker._selectDay(b.target, f.selectedMonth, f.selectedYear, j[0]);
                if (b = a.datepicker._get(f, "onSelect"))
                {
                    j = a.datepicker._formatDate(f);
                    b.apply(f.input ? f.input[0] : null, [j, f])
                }
                else a.datepicker._hideDatepicker();
                return false;
            case 27:
                a.datepicker._hideDatepicker();
                break;
            case 33:
                a.datepicker._adjustDate(b.target, b.ctrlKey ? -a.datepicker._get(f, "stepBigMonths") : -a.datepicker._get(f, "stepMonths"), "M");
                break;
            case 34:
                a.datepicker._adjustDate(b.target, b.ctrlKey ? +a.datepicker._get(f, "stepBigMonths") : +a.datepicker._get(f, "stepMonths"), "M");
                break;
            case 35:
                if (b.ctrlKey || b.metaKey) a.datepicker._clearDate(b.target);
                j = b.ctrlKey || b.metaKey;
                break;
            case 36:
                if (b.ctrlKey || b.metaKey) a.datepicker._gotoToday(b.target);
                j = b.ctrlKey || b.metaKey;
                break;
            case 37:
                if (b.ctrlKey || b.metaKey) a.datepicker._adjustDate(b.target, l ? +1 : -1, "D");
                j = b.ctrlKey || b.metaKey;
                if (b.originalEvent.altKey) a.datepicker._adjustDate(b.target, b.ctrlKey ? -a.datepicker._get(f, "stepBigMonths") : -a.datepicker._get(f, "stepMonths"), "M");
                break;
            case 38:
                if (b.ctrlKey || b.metaKey) a.datepicker._adjustDate(b.target, -7, "D");
                j = b.ctrlKey || b.metaKey;
                break;
            case 39:
                if (b.ctrlKey || b.metaKey) a.datepicker._adjustDate(b.target, l ? -1 : +1, "D");
                j = b.ctrlKey || b.metaKey;
                if (b.originalEvent.altKey) a.datepicker._adjustDate(b.target, b.ctrlKey ? +a.datepicker._get(f, "stepBigMonths") : +a.datepicker._get(f, "stepMonths"), "M");
                break;
            case 40:
                if (b.ctrlKey || b.metaKey) a.datepicker._adjustDate(b.target, +7, "D");
                j = b.ctrlKey || b.metaKey;
                break;
            default:
                j = false
            }
            else if (b.keyCode == 36 && b.ctrlKey) a.datepicker._showDatepicker(this);
            else j = false;
            if (j)
            {
                b.preventDefault();
                b.stopPropagation()
            }
        },
        _doKeyPress: function (b)
        {
            var f = a.datepicker._getInst(b.target);
            if (a.datepicker._get(f, "constrainInput"))
            {
                f = a.datepicker._possibleChars(a.datepicker._get(f, "dateFormat"));
                var j = String.fromCharCode(b.charCode == d ? b.keyCode : b.charCode);
                return b.ctrlKey || b.metaKey || j < " " || !f || f.indexOf(j) > -1
            }
        },
        _doKeyUp: function (b)
        {
            b = a.datepicker._getInst(b.target);
            if (b.input.val() != b.lastVal) try
            {
                if (a.datepicker.parseDate(a.datepicker._get(b, "dateFormat"), b.input ? b.input.val() : null, a.datepicker._getFormatConfig(b)))
                {
                    a.datepicker._setDateFromField(b);
                    a.datepicker._updateAlternate(b);
                    a.datepicker._updateDatepicker(b)
                }
            }
            catch (f)
            {
                a.datepicker.log(f)
            }
            return true
        },
        _showDatepicker: function (b)
        {
            b = b.target || b;
            if (b.nodeName.toLowerCase() != "input") b = a("input", b.parentNode)[0];
            if (!(a.datepicker._isDisabledDatepicker(b) || a.datepicker._lastInput == b))
            {
                var f = a.datepicker._getInst(b);
                if (a.datepicker._curInst && a.datepicker._curInst != f)
                {
                    a.datepicker._datepickerShowing && a.datepicker._triggerOnClose(a.datepicker._curInst);
                    a.datepicker._curInst.dpDiv.stop(true, true)
                }
                var j = a.datepicker._get(f, "beforeShow");
                j = j ? j.apply(b, [b, f]) : {};
                if (j !== false)
                {
                    h(f.settings, j);
                    f.lastVal = null;
                    a.datepicker._lastInput = b;
                    a.datepicker._setDateFromField(f);
                    if (a.datepicker._inDialog) b.value = "";
                    if (!a.datepicker._pos)
                    {
                        a.datepicker._pos = a.datepicker._findPos(b);
                        a.datepicker._pos[1] += b.offsetHeight
                    }
                    var l = false;
                    a(b).parents().each(function ()
                    {
                        l |= a(this).css("position") == "fixed";
                        return !l
                    });
                    if (l && a.browser.opera)
                    {
                        a.datepicker._pos[0] -= document.documentElement.scrollLeft;
                        a.datepicker._pos[1] -= document.documentElement.scrollTop
                    }
                    j = {
                        left: a.datepicker._pos[0],
                        top: a.datepicker._pos[1]
                    };
                    a.datepicker._pos = null;
                    f.dpDiv.empty();
                    f.dpDiv.css(
                    {
                        position: "absolute",
                        display: "block",
                        top: "-1000px"
                    });
                    a.datepicker._updateDatepicker(f);
                    j = a.datepicker._checkOffset(f, j, l);
                    f.dpDiv.css(
                    {
                        position: a.datepicker._inDialog && a.blockUI ? "static" : l ? "fixed" : "absolute",
                        display: "none",
                        left: j.left + "px",
                        top: j.top + "px"
                    });
                    if (!f.inline)
                    {
                        j = a.datepicker._get(f, "showAnim");
                        var o = a.datepicker._get(f, "duration"),
                            n = function ()
                            {
                                var k = f.dpDiv.find("iframe.ui-datepicker-cover");
                                if (k.length)
                                {
                                    var m = a.datepicker._getBorders(f.dpDiv);
                                    k.css(
                                    {
                                        left: -m[0],
                                        top: -m[1],
                                        width: f.dpDiv.outerWidth(),
                                        height: f.dpDiv.outerHeight()
                                    })
                                }
                            };
                        f.dpDiv.zIndex(a(b).zIndex() + 1);
                        a.datepicker._datepickerShowing = true;
                        a.effects && a.effects[j] ? f.dpDiv.show(j, a.datepicker._get(f, "showOptions"), o, n) : f.dpDiv[j || "show"](j ? o : null, n);
                        if (!j || !o) n();
                        f.input.is(":visible") && !f.input.is(":disabled") && f.input.focus();
                        a.datepicker._curInst = f
                    }
                }
            }
        },
        _updateDatepicker: function (b)
        {
            this.maxRows = 4;
            var f = a.datepicker._getBorders(b.dpDiv);
            i = b;
            b.dpDiv.empty().append(this._generateHTML(b));
            var j = b.dpDiv.find("iframe.ui-datepicker-cover");
            j.length && j.css(
            {
                left: -f[0],
                top: -f[1],
                width: b.dpDiv.outerWidth(),
                height: b.dpDiv.outerHeight()
            });
            b.dpDiv.find("." + this._dayOverClass + " a").mouseover();
            f = this._getNumberOfMonths(b);
            j = f[1];
            b.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width("");
            j > 1 && b.dpDiv.addClass("ui-datepicker-multi-" + j).css("width", 17 * j + "em");
            b.dpDiv[(f[0] != 1 || f[1] != 1 ? "add" : "remove") + "Class"]("ui-datepicker-multi");
            b.dpDiv[(this._get(b, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl");
            b == a.datepicker._curInst && a.datepicker._datepickerShowing && b.input && b.input.is(":visible") && !b.input.is(":disabled") && b.input[0] != document.activeElement && b.input.focus();
            if (b.yearshtml)
            {
                var l = b.yearshtml;
                setTimeout(function ()
                {
                    l === b.yearshtml && b.yearshtml && b.dpDiv.find("select.ui-datepicker-year:first").replaceWith(b.yearshtml);
                    l = b.yearshtml = null
                }, 0)
            }
        },
        _getBorders: function (b)
        {
            var f = function (j)
                {
                    return {
                        thin: 1,
                        medium: 2,
                        thick: 3
                    }[j] || j
                };
            return [parseFloat(f(b.css("border-left-width"))), parseFloat(f(b.css("border-top-width")))]
        },
        _checkOffset: function (b, f, j)
        {
            var l = b.dpDiv.outerWidth(),
                o = b.dpDiv.outerHeight(),
                n = b.input ? b.input.outerWidth() : 0,
                k = b.input ? b.input.outerHeight() : 0,
                m = document.documentElement.clientWidth + a(document).scrollLeft(),
                p = document.documentElement.clientHeight + a(document).scrollTop();
            f.left -= this._get(b, "isRTL") ? l - n : 0;
            f.left -= j && f.left == b.input.offset().left ? a(document).scrollLeft() : 0;
            f.top -= j && f.top == b.input.offset().top + k ? a(document).scrollTop() : 0;
            f.left -= Math.min(f.left, f.left + l > m && m > l ? Math.abs(f.left + l - m) : 0);
            f.top -= Math.min(f.top, f.top + o > p && p > o ? Math.abs(o + k) : 0);
            return f
        },
        _findPos: function (b)
        {
            for (var f = this._get(this._getInst(b), "isRTL"); b && (b.type == "hidden" || b.nodeType != 1 || a.expr.filters.hidden(b));) b = b[f ? "previousSibling" : "nextSibling"];
            b = a(b).offset();
            return [b.left, b.top]
        },
        _triggerOnClose: function (b)
        {
            var f = this._get(b, "onClose");
            if (f) f.apply(b.input ? b.input[0] : null, [b.input ? b.input.val() : "", b])
        },
        _hideDatepicker: function (b)
        {
            var f = this._curInst;
            if (!(!f || b && f != a.data(b, "datepicker"))) if (this._datepickerShowing)
            {
                b = this._get(f, "showAnim");
                var j = this._get(f, "duration"),
                    l = function ()
                    {
                        a.datepicker._tidyDialog(f);
                        this._curInst = null
                    };
                a.effects && a.effects[b] ? f.dpDiv.hide(b, a.datepicker._get(f, "showOptions"), j, l) : f.dpDiv[b == "slideDown" ? "slideUp" : b == "fadeIn" ? "fadeOut" : "hide"](b ? j : null, l);
                b || l();
                a.datepicker._triggerOnClose(f);
                this._datepickerShowing = false;
                this._lastInput = null;
                if (this._inDialog)
                {
                    this._dialogInput.css(
                    {
                        position: "absolute",
                        left: "0",
                        top: "-100px"
                    });
                    if (a.blockUI)
                    {
                        a.unblockUI();
                        a("body").append(this.dpDiv)
                    }
                }
                this._inDialog = false
            }
        },
        _tidyDialog: function (b)
        {
            b.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
        },
        _checkExternalClick: function (b)
        {
            if (a.datepicker._curInst)
            {
                b = a(b.target);
                b[0].id != a.datepicker._mainDivId && b.parents("#" + a.datepicker._mainDivId).length == 0 && !b.hasClass(a.datepicker.markerClassName) && !b.hasClass(a.datepicker._triggerClass) && a.datepicker._datepickerShowing && !(a.datepicker._inDialog && a.blockUI) && a.datepicker._hideDatepicker()
            }
        },
        _adjustDate: function (b, f, j)
        {
            b = a(b);
            var l = this._getInst(b[0]);
            if (!this._isDisabledDatepicker(b[0]))
            {
                this._adjustInstDate(l, f + (j == "M" ? this._get(l, "showCurrentAtPos") : 0), j);
                this._updateDatepicker(l)
            }
        },
        _gotoToday: function (b)
        {
            b = a(b);
            var f = this._getInst(b[0]);
            if (this._get(f, "gotoCurrent") && f.currentDay)
            {
                f.selectedDay = f.currentDay;
                f.drawMonth = f.selectedMonth = f.currentMonth;
                f.drawYear = f.selectedYear = f.currentYear
            }
            else
            {
                var j = new Date;
                f.selectedDay = j.getDate();
                f.drawMonth = f.selectedMonth = j.getMonth();
                f.drawYear = f.selectedYear = j.getFullYear()
            }
            this._notifyChange(f);
            this._adjustDate(b)
        },
        _selectMonthYear: function (b, f, j)
        {
            b = a(b);
            var l = this._getInst(b[0]);
            l["selected" + (j == "M" ? "Month" : "Year")] = l["draw" + (j == "M" ? "Month" : "Year")] = parseInt(f.options[f.selectedIndex].value, 10);
            this._notifyChange(l);
            this._adjustDate(b)
        },
        _selectDay: function (b, f, j, l)
        {
            var o = a(b);
            if (!(a(l).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0])))
            {
                o = this._getInst(o[0]);
                o.selectedDay = o.currentDay = a("a", l).html();
                o.selectedMonth = o.currentMonth = f;
                o.selectedYear = o.currentYear = j;
                this._selectDate(b, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear))
            }
        },
        _clearDate: function (b)
        {
            b = a(b);
            this._getInst(b[0]);
            this._selectDate(b, "")
        },
        _selectDate: function (b, f)
        {
            b = this._getInst(a(b)[0]);
            f = f != null ? f : this._formatDate(b);
            b.input && b.input.val(f);
            this._updateAlternate(b);
            var j = this._get(b, "onSelect");
            if (j) j.apply(b.input ? b.input[0] : null, [f, b]);
            else b.input && b.input.trigger("change");
            if (b.inline) this._updateDatepicker(b);
            else
            {
                this._hideDatepicker();
                this._lastInput = b.input[0];
                typeof b.input[0] != "object" && b.input.focus();
                this._lastInput = null
            }
        },
        _updateAlternate: function (b)
        {
            var f = this._get(b, "altField");
            if (f)
            {
                var j = this._get(b, "altFormat") || this._get(b, "dateFormat"),
                    l = this._getDate(b),
                    o = this.formatDate(j, l, this._getFormatConfig(b));
                a(f).each(function ()
                {
                    a(this).val(o)
                })
            }
        },
        noWeekends: function (b)
        {
            b = b.getDay();
            return [b > 0 && b < 6, ""]
        },
        iso8601Week: function (b)
        {
            b = new Date(b.getTime());
            b.setDate(b.getDate() + 4 - (b.getDay() || 7));
            var f = b.getTime();
            b.setMonth(0);
            b.setDate(1);
            return Math.floor(Math.round((f - b) / 864E5) / 7) + 1
        },
        parseDate: function (b, f, j)
        {
            if (b == null || f == null) throw "Invalid arguments";
            f = typeof f == "object" ? f.toString() : f + "";
            if (f == "") return null;
            var l = (j ? j.shortYearCutoff : null) || this._defaults.shortYearCutoff;
            l = typeof l != "string" ? l : (new Date).getFullYear() % 100 + parseInt(l, 10);
            for (var o = (j ? j.dayNamesShort : null) || this._defaults.dayNamesShort, n = (j ? j.dayNames : null) || this._defaults.dayNames, k = (j ? j.monthNamesShort : null) || this._defaults.monthNamesShort, m = (j ? j.monthNames : null) || this._defaults.monthNames, p = j = -1, q = -1, s = -1, r = false, u = function (z)
                {
                    (z = H + 1 < b.length && b.charAt(H + 1) == z) && H++;
                    return z
                }, v = function (z)
                {
                    var I = u(z);
                    z = new RegExp("^\\d{1," + (z == "@" ? 14 : z == "!" ? 20 : z == "y" && I ? 4 : z == "o" ? 3 : 2) + "}");
                    z = f.substring(y).match(z);
                    if (!z) throw "Missing number at position " + y;
                    y += z[0].length;
                    return parseInt(z[0], 10)
                }, w = function (z, I, N)
                {
                    z = a.map(u(z) ? N : I, function (D, E)
                    {
                        return [[E, D]]
                    }).sort(function (D, E)
                    {
                        return -(D[1].length - E[1].length)
                    });
                    var J = -1;
                    a.each(z, function (D, E)
                    {
                        D = E[1];
                        if (f.substr(y, D.length).toLowerCase() == D.toLowerCase())
                        {
                            J = E[0];
                            y += D.length;
                            return false
                        }
                    });
                    if (J != -1) return J + 1;
                    else throw "Unknown name at position " + y;
                }, x = function ()
                {
                    if (f.charAt(y) != b.charAt(H)) throw "Unexpected literal at position " + y;
                    y++
                }, y = 0, H = 0; H < b.length; H++) if (r) if (b.charAt(H) == "'" && !u("'")) r = false;
            else x();
            else switch (b.charAt(H))
            {
            case "d":
                q = v("d");
                break;
            case "D":
                w("D", o, n);
                break;
            case "o":
                s = v("o");
                break;
            case "m":
                p = v("m");
                break;
            case "M":
                p = w("M", k, m);
                break;
            case "y":
                j = v("y");
                break;
            case "@":
                var C = new Date(v("@"));
                j = C.getFullYear();
                p = C.getMonth() + 1;
                q = C.getDate();
                break;
            case "!":
                C = new Date((v("!") - this._ticksTo1970) / 1E4);
                j = C.getFullYear();
                p = C.getMonth() + 1;
                q = C.getDate();
                break;
            case "'":
                if (u("'")) x();
                else r = true;
                break;
            default:
                x()
            }
            if (y < f.length) throw "Extra/unparsed characters found in date: " + f.substring(y);
            if (j == -1) j = (new Date).getFullYear();
            else if (j < 100) j += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (j <= l ? 0 : -100);
            if (s > -1)
            {
                p = 1;
                q = s;
                do
                {
                    l = this._getDaysInMonth(j, p - 1);
                    if (q <= l) break;
                    p++;
                    q -= l
                } while (1)
            }
            C = this._daylightSavingAdjust(new Date(j, p - 1, q));
            if (C.getFullYear() != j || C.getMonth() + 1 != p || C.getDate() != q) throw "Invalid date";
            return C
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)) * 24 * 60 * 60 * 1E7,
        formatDate: function (b, f, j)
        {
            if (!f) return "";
            var l = (j ? j.dayNamesShort : null) || this._defaults.dayNamesShort,
                o = (j ? j.dayNames : null) || this._defaults.dayNames,
                n = (j ? j.monthNamesShort : null) || this._defaults.monthNamesShort;
            j = (j ? j.monthNames : null) || this._defaults.monthNames;
            var k = function (u)
                {
                    (u = r + 1 < b.length && b.charAt(r + 1) == u) && r++;
                    return u
                },
                m = function (u, v, w)
                {
                    v = "" + v;
                    if (k(u)) for (; v.length < w;) v = "0" + v;
                    return v
                },
                p = function (u, v, w, x)
                {
                    return k(u) ? x[v] : w[v]
                },
                q = "",
                s = false;
            if (f) for (var r = 0; r < b.length; r++) if (s) if (b.charAt(r) == "'" && !k("'")) s = false;
            else q += b.charAt(r);
            else switch (b.charAt(r))
            {
            case "d":
                q += m("d", f.getDate(), 2);
                break;
            case "D":
                q += p("D", f.getDay(), l, o);
                break;
            case "o":
                q += m("o", Math.round(((new Date(f.getFullYear(), f.getMonth(), f.getDate())).getTime() - (new Date(f.getFullYear(), 0, 0)).getTime()) / 864E5), 3);
                break;
            case "m":
                q += m("m", f.getMonth() + 1, 2);
                break;
            case "M":
                q += p("M", f.getMonth(), n, j);
                break;
            case "y":
                q += k("y") ? f.getFullYear() : (f.getYear() % 100 < 10 ? "0" : "") + f.getYear() % 100;
                break;
            case "@":
                q += f.getTime();
                break;
            case "!":
                q += f.getTime() * 1E4 + this._ticksTo1970;
                break;
            case "'":
                if (k("'")) q += "'";
                else s = true;
                break;
            default:
                q += b.charAt(r)
            }
            return q
        },
        _possibleChars: function (b)
        {
            for (var f = "", j = false, l = function (n)
                {
                    (n = o + 1 < b.length && b.charAt(o + 1) == n) && o++;
                    return n
                }, o = 0; o < b.length; o++) if (j) if (b.charAt(o) == "'" && !l("'")) j = false;
            else f += b.charAt(o);
            else switch (b.charAt(o))
            {
            case "d":
            case "m":
            case "y":
            case "@":
                f += "0123456789";
                break;
            case "D":
            case "M":
                return null;
            case "'":
                if (l("'")) f += "'";
                else j = true;
                break;
            default:
                f += b.charAt(o)
            }
            return f
        },
        _get: function (b, f)
        {
            return b.settings[f] !== d ? b.settings[f] : this._defaults[f]
        },
        _setDateFromField: function (b, f)
        {
            if (b.input.val() != b.lastVal)
            {
                var j = this._get(b, "dateFormat"),
                    l = b.lastVal = b.input ? b.input.val() : null,
                    o, n;
                o = n = this._getDefaultDate(b);
                var k = this._getFormatConfig(b);
                try
                {
                    o = this.parseDate(j, l, k) || n
                }
                catch (m)
                {
                    this.log(m);
                    l = f ? "" : l
                }
                b.selectedDay = o.getDate();
                b.drawMonth = b.selectedMonth = o.getMonth();
                b.drawYear = b.selectedYear = o.getFullYear();
                b.currentDay = l ? o.getDate() : 0;
                b.currentMonth = l ? o.getMonth() : 0;
                b.currentYear = l ? o.getFullYear() : 0;
                this._adjustInstDate(b)
            }
        },
        _getDefaultDate: function (b)
        {
            return this._restrictMinMax(b, this._determineDate(b, this._get(b, "defaultDate"), new Date))
        },
        _determineDate: function (b, f, j)
        {
            var l = function (n)
                {
                    var k = new Date;
                    k.setDate(k.getDate() + n);
                    return k
                },
                o = function (n)
                {
                    try
                    {
                        return a.datepicker.parseDate(a.datepicker._get(b, "dateFormat"), n, a.datepicker._getFormatConfig(b))
                    }
                    catch (k)
                    {}
                    var m = (n.toLowerCase().match(/^c/) ? a.datepicker._getDate(b) : null) || new Date,
                        p = m.getFullYear(),
                        q = m.getMonth();
                    m = m.getDate();
                    for (var s = /([+-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, r = s.exec(n); r;)
                    {
                        switch (r[2] || "d")
                        {
                        case "d":
                        case "D":
                            m += parseInt(r[1], 10);
                            break;
                        case "w":
                        case "W":
                            m += parseInt(r[1], 10) * 7;
                            break;
                        case "m":
                        case "M":
                            q += parseInt(r[1], 10);
                            m = Math.min(m, a.datepicker._getDaysInMonth(p, q));
                            break;
                        case "y":
                        case "Y":
                            p += parseInt(r[1], 10);
                            m = Math.min(m, a.datepicker._getDaysInMonth(p, q));
                            break
                        }
                        r = s.exec(n)
                    }
                    return new Date(p, q, m)
                };
            if (f = (f = f == null || f === "" ? j : typeof f == "string" ? o(f) : typeof f == "number" ? isNaN(f) ? j : l(f) : new Date(f.getTime())) && f.toString() == "Invalid Date" ? j : f)
            {
                f.setHours(0);
                f.setMinutes(0);
                f.setSeconds(0);
                f.setMilliseconds(0)
            }
            return this._daylightSavingAdjust(f)
        },
        _daylightSavingAdjust: function (b)
        {
            if (!b) return null;
            b.setHours(b.getHours() > 12 ? b.getHours() + 2 : 0);
            return b
        },
        _setDate: function (b, f, j)
        {
            var l = !f,
                o = b.selectedMonth,
                n = b.selectedYear;
            f = this._restrictMinMax(b, this._determineDate(b, f, new Date));
            b.selectedDay = b.currentDay = f.getDate();
            b.drawMonth = b.selectedMonth = b.currentMonth = f.getMonth();
            b.drawYear = b.selectedYear = b.currentYear = f.getFullYear();
            if ((o != b.selectedMonth || n != b.selectedYear) && !j) this._notifyChange(b);
            this._adjustInstDate(b);
            if (b.input) b.input.val(l ? "" : this._formatDate(b))
        },
        _getDate: function (b)
        {
            return !b.currentYear || b.input && b.input.val() == "" ? null : this._daylightSavingAdjust(new Date(b.currentYear, b.currentMonth, b.currentDay))
        },
        _generateHTML: function (b)
        {
            var f = new Date;
            f = this._daylightSavingAdjust(new Date(f.getFullYear(), f.getMonth(), f.getDate()));
            var j = this._get(b, "isRTL"),
                l = this._get(b, "showButtonPanel"),
                o = this._get(b, "hideIfNoPrevNext"),
                n = this._get(b, "navigationAsDateFormat"),
                k = this._getNumberOfMonths(b),
                m = this._get(b, "showCurrentAtPos"),
                p = this._get(b, "stepMonths"),
                q = k[0] != 1 || k[1] != 1,
                s = this._daylightSavingAdjust(!b.currentDay ? new Date(9999, 9, 9) : new Date(b.currentYear, b.currentMonth, b.currentDay)),
                r = this._getMinMaxDate(b, "min"),
                u = this._getMinMaxDate(b, "max");
            m = b.drawMonth - m;
            var v = b.drawYear;
            if (m < 0)
            {
                m += 12;
                v--
            }
            if (u)
            {
                var w = this._daylightSavingAdjust(new Date(u.getFullYear(), u.getMonth() - k[0] * k[1] + 1, u.getDate()));
                for (w = r && w < r ? r : w; this._daylightSavingAdjust(new Date(v, m, 1)) > w;)
                {
                    m--;
                    if (m < 0)
                    {
                        m = 11;
                        v--
                    }
                }
            }
            b.drawMonth = m;
            b.drawYear = v;
            w = this._get(b, "prevText");
            w = !n ? w : this.formatDate(w, this._daylightSavingAdjust(new Date(v, m - p, 1)), this._getFormatConfig(b));
            w = this._canAdjustMonth(b, -1, v, m) ? '<a class="ui-datepicker-prev ui-corner-all" onclick="DP_jQuery_' + g + ".datepicker._adjustDate('#" + b.id + "', -" + p + ", 'M');\" title=\"" + w + '"><span class="ui-icon ui-icon-circle-triangle-' + (j ? "e" : "w") + '">' + w + "</span></a>" : o ? "" : '<a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="' + w + '"><span class="ui-icon ui-icon-circle-triangle-' + (j ? "e" : "w") + '">' + w + "</span></a>";
            var x = this._get(b, "nextText");
            x = !n ? x : this.formatDate(x, this._daylightSavingAdjust(new Date(v, m + p, 1)), this._getFormatConfig(b));
            o = this._canAdjustMonth(b, +1, v, m) ? '<a class="ui-datepicker-next ui-corner-all" onclick="DP_jQuery_' + g + ".datepicker._adjustDate('#" + b.id + "', +" + p + ", 'M');\" title=\"" + x + '"><span class="ui-icon ui-icon-circle-triangle-' + (j ? "w" : "e") + '">' + x + "</span></a>" : o ? "" : '<a class="ui-datepicker-next ui-corner-all ui-state-disabled" title="' + x + '"><span class="ui-icon ui-icon-circle-triangle-' + (j ? "w" : "e") + '">' + x + "</span></a>";
            p = this._get(b, "currentText");
            x = this._get(b, "gotoCurrent") && b.currentDay ? s : f;
            p = !n ? p : this.formatDate(p, x, this._getFormatConfig(b));
            n = !b.inline ? '<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" onclick="DP_jQuery_' + g + '.datepicker._hideDatepicker();">' + this._get(b, "closeText") + "</button>" : "";
            l = l ? '<div class="ui-datepicker-buttonpane ui-widget-content">' + (j ? n : "") + (this._isInRange(b, x) ? '<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all" onclick="DP_jQuery_' + g + ".datepicker._gotoToday('#" + b.id + "');\">" + p + "</button>" : "") + (j ? "" : n) + "</div>" : "";
            n = parseInt(this._get(b, "firstDay"), 10);
            n = isNaN(n) ? 0 : n;
            p = this._get(b, "showWeek");
            x = this._get(b, "dayNames");
            this._get(b, "dayNamesShort");
            var y = this._get(b, "dayNamesMin"),
                H = this._get(b, "monthNames"),
                C = this._get(b, "monthNamesShort"),
                z = this._get(b, "beforeShowDay"),
                I = this._get(b, "showOtherMonths"),
                N = this._get(b, "selectOtherMonths");
            this._get(b, "calculateWeek");
            for (var J = this._getDefaultDate(b), D = "", E = 0; E < k[0]; E++)
            {
                var P = "";
                this.maxRows = 4;
                for (var L = 0; L < k[1]; L++)
                {
                    var Q = this._daylightSavingAdjust(new Date(v, m, b.selectedDay)),
                        B = " ui-corner-all",
                        F = "";
                    if (q)
                    {
                        F += '<div class="ui-datepicker-group';
                        if (k[1] > 1) switch (L)
                        {
                        case 0:
                            F += " ui-datepicker-group-first";
                            B = " ui-corner-" + (j ? "right" : "left");
                            break;
                        case k[1] - 1:
                            F += " ui-datepicker-group-last";
                            B = " ui-corner-" + (j ? "left" : "right");
                            break;
                        default:
                            F += " ui-datepicker-group-middle";
                            B = "";
                            break
                        }
                        F += '">'
                    }
                    F += '<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix' + B + '">' + (/all|left/.test(B) && E == 0 ? j ? o : w : "") + (/all|right/.test(B) && E == 0 ? j ? w : o : "") + this._generateMonthYearHeader(b, m, v, r, u, E > 0 || L > 0, H, C) + '</div><table class="ui-datepicker-calendar"><thead><tr>';
                    var G = p ? '<th class="ui-datepicker-week-col">' + this._get(b, "weekHeader") + "</th>" : "";
                    for (B = 0; B < 7; B++)
                    {
                        var A = (B + n) % 7;
                        G += "<th" + ((B + n + 6) % 7 >= 5 ? ' class="ui-datepicker-week-end"' : "") + '><span title="' + x[A] + '">' + y[A] + "</span></th>"
                    }
                    F += G + "</tr></thead><tbody>";
                    G = this._getDaysInMonth(v, m);
                    if (v == b.selectedYear && m == b.selectedMonth) b.selectedDay = Math.min(b.selectedDay, G);
                    B = (this._getFirstDayOfMonth(v, m) - n + 7) % 7;
                    G = Math.ceil((B + G) / 7);
                    this.maxRows = G = q ? this.maxRows > G ? this.maxRows : G : G;
                    A = this._daylightSavingAdjust(new Date(v, m, 1 - B));
                    for (var R = 0; R < G; R++)
                    {
                        F += "<tr>";
                        var S = !p ? "" : '<td class="ui-datepicker-week-col">' + this._get(b, "calculateWeek")(A) + "</td>";
                        for (B = 0; B < 7; B++)
                        {
                            var M = z ? z.apply(b.input ? b.input[0] : null, [A]) : [true, ""],
                                K = A.getMonth() != m,
                                O = K && !N || !M[0] || r && A < r || u && A > u;
                            S += '<td class="' + ((B + n + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (K ? " ui-datepicker-other-month" : "") + (A.getTime() == Q.getTime() && m == b.selectedMonth && b._keyEvent || J.getTime() == A.getTime() && J.getTime() == Q.getTime() ? " " + this._dayOverClass : "") + (O ? " " + this._unselectableClass + " ui-state-disabled" : "") + (K && !I ? "" : " " + M[1] + (A.getTime() == s.getTime() ? " " + this._currentClass : "") + (A.getTime() == f.getTime() ? " ui-datepicker-today" : "")) + '"' + ((!K || I) && M[2] ? ' title="' + M[2] + '"' : "") + (O ? "" : ' onclick="DP_jQuery_' + g + ".datepicker._selectDay('#" + b.id + "'," + A.getMonth() + "," + A.getFullYear() + ', this);return false;"') + ">" + (K && !I ? "&#xa0;" : O ? '<span class="ui-state-default">' + A.getDate() + "</span>" : '<a class="ui-state-default' + (A.getTime() == f.getTime() ? " ui-state-highlight" : "") + (A.getTime() == s.getTime() ? " ui-state-active" : "") + (K ? " ui-priority-secondary" : "") + '" href="#">' + A.getDate() + "</a>") + "</td>";
                            A.setDate(A.getDate() + 1);
                            A = this._daylightSavingAdjust(A)
                        }
                        F += S + "</tr>"
                    }
                    m++;
                    if (m > 11)
                    {
                        m = 0;
                        v++
                    }
                    F += "</tbody></table>" + (q ? "</div>" + (k[0] > 0 && L == k[1] - 1 ? '<div class="ui-datepicker-row-break"></div>' : "") : "");
                    P += F
                }
                D += P
            }
            D += l + (a.browser.msie && parseInt(a.browser.version, 10) < 7 && !b.inline ? '<iframe src="javascript:false;" class="ui-datepicker-cover" frameborder="0"></iframe>' : "");
            b._keyEvent = false;
            return D
        },
        _generateMonthYearHeader: function (b, f, j, l, o, n, k, m)
        {
            var p = this._get(b, "changeMonth"),
                q = this._get(b, "changeYear"),
                s = this._get(b, "showMonthAfterYear"),
                r = '<div class="ui-datepicker-title">',
                u = "";
            if (n || !p) u += '<span class="ui-datepicker-month">' + k[f] + "</span>";
            else
            {
                k = l && l.getFullYear() == j;
                var v = o && o.getFullYear() == j;
                u += '<select class="ui-datepicker-month" onchange="DP_jQuery_' + g + ".datepicker._selectMonthYear('#" + b.id + "', this, 'M');\" >";
                for (var w = 0; w < 12; w++) if ((!k || w >= l.getMonth()) && (!v || w <= o.getMonth())) u += '<option value="' + w + '"' + (w == f ? ' selected="selected"' : "") + ">" + m[w] + "</option>";
                u += "</select>"
            }
            s || (r += u + (n || !(p && q) ? "&#xa0;" : ""));
            if (!b.yearshtml)
            {
                b.yearshtml = "";
                if (n || !q) r += '<span class="ui-datepicker-year">' + j + "</span>";
                else
                {
                    m = this._get(b, "yearRange").split(":");
                    var x = (new Date).getFullYear();
                    k = function (y)
                    {
                        y = y.match(/c[+-].*/) ? j + parseInt(y.substring(1), 10) : y.match(/[+-].*/) ? x + parseInt(y, 10) : parseInt(y, 10);
                        return isNaN(y) ? x : y
                    };
                    f = k(m[0]);
                    m = Math.max(f, k(m[1] || ""));
                    f = l ? Math.max(f, l.getFullYear()) : f;
                    m = o ? Math.min(m, o.getFullYear()) : m;
                    for (b.yearshtml += '<select class="ui-datepicker-year" onchange="DP_jQuery_' + g + ".datepicker._selectMonthYear('#" + b.id + "', this, 'Y');\" >"; f <= m; f++) b.yearshtml += '<option value="' + f + '"' + (f == j ? ' selected="selected"' : "") + ">" + f + "</option>";
                    b.yearshtml += "</select>";
                    r += b.yearshtml;
                    b.yearshtml = null
                }
            }
            r += this._get(b, "yearSuffix");
            if (s) r += (n || !(p && q) ? "&#xa0;" : "") + u;
            r += "</div>";
            return r
        },
        _adjustInstDate: function (b, f, j)
        {
            var l = b.drawYear + (j == "Y" ? f : 0),
                o = b.drawMonth + (j == "M" ? f : 0);
            f = Math.min(b.selectedDay, this._getDaysInMonth(l, o)) + (j == "D" ? f : 0);
            l = this._restrictMinMax(b, this._daylightSavingAdjust(new Date(l, o, f)));
            b.selectedDay = l.getDate();
            b.drawMonth = b.selectedMonth = l.getMonth();
            b.drawYear = b.selectedYear = l.getFullYear();
            if (j == "M" || j == "Y") this._notifyChange(b)
        },
        _restrictMinMax: function (b, f)
        {
            var j = this._getMinMaxDate(b, "min");
            b = this._getMinMaxDate(b, "max");
            f = j && f < j ? j : f;
            return f = b && f > b ? b : f
        },
        _notifyChange: function (b)
        {
            var f = this._get(b, "onChangeMonthYear");
            if (f) f.apply(b.input ? b.input[0] : null, [b.selectedYear, b.selectedMonth + 1, b])
        },
        _getNumberOfMonths: function (b)
        {
            b = this._get(b, "numberOfMonths");
            return b == null ? [1, 1] : typeof b == "number" ? [1, b] : b
        },
        _getMinMaxDate: function (b, f)
        {
            return this._determineDate(b, this._get(b, f + "Date"), null)
        },
        _getDaysInMonth: function (b, f)
        {
            return 32 - this._daylightSavingAdjust(new Date(b, f, 32)).getDate()
        },
        _getFirstDayOfMonth: function (b, f)
        {
            return (new Date(b, f, 1)).getDay()
        },
        _canAdjustMonth: function (b, f, j, l)
        {
            var o = this._getNumberOfMonths(b);
            j = this._daylightSavingAdjust(new Date(j, l + (f < 0 ? f : o[0] * o[1]), 1));
            f < 0 && j.setDate(this._getDaysInMonth(j.getFullYear(), j.getMonth()));
            return this._isInRange(b, j)
        },
        _isInRange: function (b, f)
        {
            var j = this._getMinMaxDate(b, "min");
            b = this._getMinMaxDate(b, "max");
            return (!j || f.getTime() >= j.getTime()) && (!b || f.getTime() <= b.getTime())
        },
        _getFormatConfig: function (b)
        {
            var f = this._get(b, "shortYearCutoff");
            f = typeof f != "string" ? f : (new Date).getFullYear() % 100 + parseInt(f, 10);
            return {
                shortYearCutoff: f,
                dayNamesShort: this._get(b, "dayNamesShort"),
                dayNames: this._get(b, "dayNames"),
                monthNamesShort: this._get(b, "monthNamesShort"),
                monthNames: this._get(b, "monthNames")
            }
        },
        _formatDate: function (b, f, j, l)
        {
            if (!f)
            {
                b.currentDay = b.selectedDay;
                b.currentMonth = b.selectedMonth;
                b.currentYear = b.selectedYear
            }
            f = f ? typeof f == "object" ? f : this._daylightSavingAdjust(new Date(l, j, f)) : this._daylightSavingAdjust(new Date(b.currentYear, b.currentMonth, b.currentDay));
            return this.formatDate(this._get(b, "dateFormat"), f, this._getFormatConfig(b))
        }
    });
    a.fn.datepicker = function (b)
    {
        if (!this.length) return this;
        if (!a.datepicker.initialized)
        {
            a(document).mousedown(a.datepicker._checkExternalClick).find("body").append(a.datepicker.dpDiv);
            a.datepicker.initialized = true
        }
        var f = Array.prototype.slice.call(arguments, 1);
        if (typeof b == "string" && (b == "isDisabled" || b == "getDate" || b == "widget")) return a.datepicker["_" + b + "Datepicker"].apply(a.datepicker, [this[0]].concat(f));
        if (b == "option" && arguments.length == 2 && typeof arguments[1] == "string") return a.datepicker["_" + b + "Datepicker"].apply(a.datepicker, [this[0]].concat(f));
        return this.each(function ()
        {
            typeof b == "string" ? a.datepicker["_" + b + "Datepicker"].apply(a.datepicker, [this].concat(f)) : a.datepicker._attachDatepicker(this, b)
        })
    };
    a.datepicker = new c;
    a.datepicker.initialized = false;
    a.datepicker.uuid = (new Date).getTime();
    a.datepicker.version = "1.8.16";
    window["DP_jQuery_" + g] = a
})(jQuery);
(function (a, d)
{
    var c = {
        buttons: true,
        height: true,
        maxHeight: true,
        maxWidth: true,
        minHeight: true,
        minWidth: true,
        width: true
    },
        e = {
            maxHeight: true,
            maxWidth: true,
            minHeight: true,
            minWidth: true
        },
        h = a.attrFn || {
            val: true,
            css: true,
            html: true,
            text: true,
            data: true,
            width: true,
            height: true,
            offset: true,
            click: true
        };
    a.widget("ui.dialog", {
        options: {
            autoOpen: true,
            buttons: {},
            closeOnEscape: true,
            closeText: "close",
            dialogClass: "",
            draggable: true,
            hide: null,
            height: "auto",
            maxHeight: false,
            maxWidth: false,
            minHeight: 150,
            minWidth: 150,
            modal: false,
            position: {
                my: "center",
                at: "center",
                collision: "fit",
                using: function (g)
                {
                    var i = a(this).css(g).offset().top;
                    i < 0 && a(this).css("top", g.top - i)
                }
            },
            resizable: true,
            show: null,
            stack: true,
            title: "",
            width: 300,
            zIndex: 1E3
        },
        _create: function ()
        {
            this.originalTitle = this.element.attr("title");
            if (typeof this.originalTitle !== "string") this.originalTitle = "";
            this.options.title = this.options.title || this.originalTitle;
            var g = this,
                i = g.options,
                b = i.title || "&#160;",
                f = a.ui.dialog.getTitleId(g.element),
                j = (g.uiDialog = a("<div></div>")).appendTo(document.body).hide().addClass("ui-dialog ui-widget ui-widget-content ui-corner-all " + i.dialogClass).css(
                {
                    zIndex: i.zIndex
                }).attr("tabIndex", -1).css("outline", 0).keydown(function (n)
                {
                    if (i.closeOnEscape && !n.isDefaultPrevented() && n.keyCode && n.keyCode === a.ui.keyCode.ESCAPE)
                    {
                        g.close(n);
                        n.preventDefault()
                    }
                }).attr(
                {
                    role: "dialog",
                    "aria-labelledby": f
                }).mousedown(function (n)
                {
                    g.moveToTop(false, n)
                });
            g.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(j);
            var l = (g.uiDialogTitlebar = a("<div></div>")).addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(j),
                o = a('<a href="#"></a>').addClass("ui-dialog-titlebar-close ui-corner-all").attr("role", "button").hover(function ()
                {
                    o.addClass("ui-state-hover")
                }, function ()
                {
                    o.removeClass("ui-state-hover")
                }).focus(function ()
                {
                    o.addClass("ui-state-focus")
                }).blur(function ()
                {
                    o.removeClass("ui-state-focus")
                }).click(function (n)
                {
                    g.close(n);
                    return false
                }).appendTo(l);
            (g.uiDialogTitlebarCloseText = a("<span></span>")).addClass("ui-icon ui-icon-closethick").text(i.closeText).appendTo(o);
            a("<span></span>").addClass("ui-dialog-title").attr("id", f).html(b).prependTo(l);
            if (a.isFunction(i.beforeclose) && !a.isFunction(i.beforeClose)) i.beforeClose = i.beforeclose;
            l.find("*").add(l).disableSelection();
            i.draggable && a.fn.draggable && g._makeDraggable();
            i.resizable && a.fn.resizable && g._makeResizable();
            g._createButtons(i.buttons);
            g._isOpen = false;
            a.fn.bgiframe && j.bgiframe()
        },
        _init: function ()
        {
            this.options.autoOpen && this.open()
        },
        destroy: function ()
        {
            var g = this;
            g.overlay && g.overlay.destroy();
            g.uiDialog.hide();
            g.element.unbind(".dialog").removeData("dialog").removeClass("ui-dialog-content ui-widget-content").hide().appendTo("body");
            g.uiDialog.remove();
            g.originalTitle && g.element.attr("title", g.originalTitle);
            return g
        },
        widget: function ()
        {
            return this.uiDialog
        },
        close: function (g)
        {
            var i = this,
                b, f;
            if (false !== i._trigger("beforeClose", g))
            {
                i.overlay && i.overlay.destroy();
                i.uiDialog.unbind("keypress.ui-dialog");
                i._isOpen = false;
                if (i.options.hide) i.uiDialog.hide(i.options.hide, function ()
                {
                    i._trigger("close", g)
                });
                else
                {
                    i.uiDialog.hide();
                    i._trigger("close", g)
                }
                a.ui.dialog.overlay.resize();
                if (i.options.modal)
                {
                    b = 0;
                    a(".ui-dialog").each(function ()
                    {
                        if (this !== i.uiDialog[0])
                        {
                            f = a(this).css("z-index");
                            isNaN(f) || (b = Math.max(b, f))
                        }
                    });
                    a.ui.dialog.maxZ = b
                }
                return i
            }
        },
        isOpen: function ()
        {
            return this._isOpen
        },
        moveToTop: function (g, i)
        {
            var b = this,
                f = b.options;
            if (f.modal && !g || !f.stack && !f.modal) return b._trigger("focus", i);
            if (f.zIndex > a.ui.dialog.maxZ) a.ui.dialog.maxZ = f.zIndex;
            if (b.overlay)
            {
                a.ui.dialog.maxZ += 1;
                b.overlay.$el.css("z-index", a.ui.dialog.overlay.maxZ = a.ui.dialog.maxZ)
            }
            g = {
                scrollTop: b.element.scrollTop(),
                scrollLeft: b.element.scrollLeft()
            };
            a.ui.dialog.maxZ += 1;
            b.uiDialog.css("z-index", a.ui.dialog.maxZ);
            b.element.attr(g);
            b._trigger("focus", i);
            return b
        },
        open: function ()
        {
            if (!this._isOpen)
            {
                var g = this,
                    i = g.options,
                    b = g.uiDialog;
                g.overlay = i.modal ? new a.ui.dialog.overlay(g) : null;
                g._size();
                g._position(i.position);
                b.show(i.show);
                g.moveToTop(true);
                i.modal && b.bind("keypress.ui-dialog", function (f)
                {
                    if (f.keyCode === a.ui.keyCode.TAB)
                    {
                        var j = a(":tabbable", this),
                            l = j.filter(":first");
                        j = j.filter(":last");
                        if (f.target === j[0] && !f.shiftKey)
                        {
                            l.focus(1);
                            return false
                        }
                        else if (f.target === l[0] && f.shiftKey)
                        {
                            j.focus(1);
                            return false
                        }
                    }
                });
                a(g.element.find(":tabbable").get().concat(b.find(".ui-dialog-buttonpane :tabbable").get().concat(b.get()))).eq(0).focus();
                g._isOpen = true;
                g._trigger("open");
                return g
            }
        },
        _createButtons: function (g)
        {
            var i = this,
                b = false,
                f = a("<div></div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),
                j = a("<div></div>").addClass("ui-dialog-buttonset").appendTo(f);
            i.uiDialog.find(".ui-dialog-buttonpane").remove();
            typeof g === "object" && g !== null && a.each(g, function ()
            {
                return !(b = true)
            });
            if (b)
            {
                a.each(g, function (l, o)
                {
                    o = a.isFunction(o) ? {
                        click: o,
                        text: l
                    } : o;
                    var n = a('<button type="button"></button>').click(function ()
                    {
                        o.click.apply(i.element[0], arguments)
                    }).appendTo(j);
                    a.each(o, function (k, m)
                    {
                        if (k !== "click") k in h ? n[k](m) : n.attr(k, m)
                    });
                    a.fn.button && n.button()
                });
                f.appendTo(i.uiDialog)
            }
        },
        _makeDraggable: function ()
        {
            function g(l)
            {
                return {
                    position: l.position,
                    offset: l.offset
                }
            }
            var i = this,
                b = i.options,
                f = a(document),
                j;
            i.uiDialog.draggable(
            {
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar",
                containment: "document",
                start: function (l, o)
                {
                    j = b.height === "auto" ? "auto" : a(this).height();
                    a(this).height(a(this).height()).addClass("ui-dialog-dragging");
                    i._trigger("dragStart", l, g(o))
                },
                drag: function (l, o)
                {
                    i._trigger("drag", l, g(o))
                },
                stop: function (l, o)
                {
                    b.position = [o.position.left - f.scrollLeft(), o.position.top - f.scrollTop()];
                    a(this).removeClass("ui-dialog-dragging").height(j);
                    i._trigger("dragStop", l, g(o));
                    a.ui.dialog.overlay.resize()
                }
            })
        },
        _makeResizable: function (g)
        {
            function i(l)
            {
                return {
                    originalPosition: l.originalPosition,
                    originalSize: l.originalSize,
                    position: l.position,
                    size: l.size
                }
            }
            g = g === d ? this.options.resizable : g;
            var b = this,
                f = b.options,
                j = b.uiDialog.css("position");
            g = typeof g === "string" ? g : "n,e,s,w,se,sw,ne,nw";
            b.uiDialog.resizable(
            {
                cancel: ".ui-dialog-content",
                containment: "document",
                alsoResize: b.element,
                maxWidth: f.maxWidth,
                maxHeight: f.maxHeight,
                minWidth: f.minWidth,
                minHeight: b._minHeight(),
                handles: g,
                start: function (l, o)
                {
                    a(this).addClass("ui-dialog-resizing");
                    b._trigger("resizeStart", l, i(o))
                },
                resize: function (l, o)
                {
                    b._trigger("resize", l, i(o))
                },
                stop: function (l, o)
                {
                    a(this).removeClass("ui-dialog-resizing");
                    f.height = a(this).height();
                    f.width = a(this).width();
                    b._trigger("resizeStop", l, i(o));
                    a.ui.dialog.overlay.resize()
                }
            }).css("position", j).find(".ui-resizable-se").addClass("ui-icon ui-icon-grip-diagonal-se")
        },
        _minHeight: function ()
        {
            var g = this.options;
            return g.height === "auto" ? g.minHeight : Math.min(g.minHeight, g.height)
        },
        _position: function (g)
        {
            var i = [],
                b = [0, 0],
                f;
            if (g)
            {
                if (typeof g === "string" || typeof g === "object" && "0" in g)
                {
                    i = g.split ? g.split(" ") : [g[0], g[1]];
                    if (i.length === 1) i[1] = i[0];
                    a.each(["left", "top"], function (j, l)
                    {
                        if (+i[j] === i[j])
                        {
                            b[j] = i[j];
                            i[j] = l
                        }
                    });
                    g = {
                        my: i.join(" "),
                        at: i.join(" "),
                        offset: b.join(" ")
                    }
                }
                g = a.extend(
                {}, a.ui.dialog.prototype.options.position, g)
            }
            else g = a.ui.dialog.prototype.options.position;
            (f = this.uiDialog.is(":visible")) || this.uiDialog.show();
            this.uiDialog.css(
            {
                top: 0,
                left: 0
            }).position(a.extend(
            {
                of: window
            }, g));
            f || this.uiDialog.hide()
        },
        _setOptions: function (g)
        {
            var i = this,
                b = {},
                f = false;
            a.each(g, function (j, l)
            {
                i._setOption(j, l);
                if (j in c) f = true;
                if (j in e) b[j] = l
            });
            f && this._size();
            this.uiDialog.is(":data(resizable)") && this.uiDialog.resizable("option", b)
        },
        _setOption: function (g, i)
        {
            var b = this,
                f = b.uiDialog;
            switch (g)
            {
            case "beforeclose":
                g = "beforeClose";
                break;
            case "buttons":
                b._createButtons(i);
                break;
            case "closeText":
                b.uiDialogTitlebarCloseText.text("" + i);
                break;
            case "dialogClass":
                f.removeClass(b.options.dialogClass).addClass("ui-dialog ui-widget ui-widget-content ui-corner-all " + i);
                break;
            case "disabled":
                i ? f.addClass("ui-dialog-disabled") : f.removeClass("ui-dialog-disabled");
                break;
            case "draggable":
                var j = f.is(":data(draggable)");
                j && !i && f.draggable("destroy");
                !j && i && b._makeDraggable();
                break;
            case "position":
                b._position(i);
                break;
            case "resizable":
                (j = f.is(":data(resizable)")) && !i && f.resizable("destroy");
                j && typeof i === "string" && f.resizable("option", "handles", i);
                !j && i !== false && b._makeResizable(i);
                break;
            case "title":
                a(".ui-dialog-title", b.uiDialogTitlebar).html("" + (i || "&#160;"));
                break
            }
            a.Widget.prototype._setOption.apply(b, arguments)
        },
        _size: function ()
        {
            var g = this.options,
                i, b, f = this.uiDialog.is(":visible");
            this.element.show().css(
            {
                width: "auto",
                minHeight: 0,
                height: 0
            });
            if (g.minWidth > g.width) g.width = g.minWidth;
            i = this.uiDialog.css(
            {
                height: "auto",
                width: g.width
            }).height();
            b = Math.max(0, g.minHeight - i);
            if (g.height === "auto") if (a.support.minHeight) this.element.css(
            {
                minHeight: b,
                height: "auto"
            });
            else
            {
                this.uiDialog.show();
                g = this.element.css("height", "auto").height();
                f || this.uiDialog.hide();
                this.element.height(Math.max(g, b))
            }
            else this.element.height(Math.max(g.height - i, 0));
            this.uiDialog.is(":data(resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        }
    });
    a.extend(a.ui.dialog, {
        version: "1.8.16",
        uuid: 0,
        maxZ: 0,
        getTitleId: function (g)
        {
            g = g.attr("id");
            if (!g)
            {
                this.uuid += 1;
                g = this.uuid
            }
            return "ui-dialog-title-" + g
        },
        overlay: function (g)
        {
            this.$el = a.ui.dialog.overlay.create(g)
        }
    });
    a.extend(a.ui.dialog.overlay, {
        instances: [],
        oldInstances: [],
        maxZ: 0,
        events: a.map("focus,mousedown,mouseup,keydown,keypress,click".split(","), function (g)
        {
            return g + ".dialog-overlay"
        }).join(" "),
        create: function (g)
        {
            if (this.instances.length === 0)
            {
                setTimeout(function ()
                {
                    a.ui.dialog.overlay.instances.length && a(document).bind(a.ui.dialog.overlay.events, function (b)
                    {
                        if (a(b.target).zIndex() < a.ui.dialog.overlay.maxZ) return false
                    })
                }, 1);
                a(document).bind("keydown.dialog-overlay", function (b)
                {
                    if (g.options.closeOnEscape && !b.isDefaultPrevented() && b.keyCode && b.keyCode === a.ui.keyCode.ESCAPE)
                    {
                        g.close(b);
                        b.preventDefault()
                    }
                });
                a(window).bind("resize.dialog-overlay", a.ui.dialog.overlay.resize)
            }
            var i = (this.oldInstances.pop() || a("<div></div>").addClass("ui-widget-overlay")).appendTo(document.body).css(
            {
                width: this.width(),
                height: this.height()
            });
            a.fn.bgiframe && i.bgiframe();
            this.instances.push(i);
            return i
        },
        destroy: function (g)
        {
            var i = a.inArray(g, this.instances);
            i != -1 && this.oldInstances.push(this.instances.splice(i, 1)[0]);
            this.instances.length === 0 && a([document, window]).unbind(".dialog-overlay");
            g.remove();
            var b = 0;
            a.each(this.instances, function ()
            {
                b = Math.max(b, this.css("z-index"))
            });
            this.maxZ = b
        },
        height: function ()
        {
            var g, i;
            if (a.browser.msie && a.browser.version < 7)
            {
                g = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight);
                i = Math.max(document.documentElement.offsetHeight, document.body.offsetHeight);
                return g < i ? a(window).height() + "px" : g + "px"
            }
            else return a(document).height() + "px"
        },
        width: function ()
        {
            var g, i;
            if (a.browser.msie)
            {
                g = Math.max(document.documentElement.scrollWidth, document.body.scrollWidth);
                i = Math.max(document.documentElement.offsetWidth, document.body.offsetWidth);
                return g < i ? a(window).width() + "px" : g + "px"
            }
            else return a(document).width() + "px"
        },
        resize: function ()
        {
            var g = a([]);
            a.each(a.ui.dialog.overlay.instances, function ()
            {
                g = g.add(this)
            });
            g.css(
            {
                width: 0,
                height: 0
            }).css(
            {
                width: a.ui.dialog.overlay.width(),
                height: a.ui.dialog.overlay.height()
            })
        }
    });
    a.extend(a.ui.dialog.overlay.prototype, {
        destroy: function ()
        {
            a.ui.dialog.overlay.destroy(this.$el)
        }
    })
})(jQuery);
(function (a)
{
    a.ui = a.ui || {};
    var d = /left|center|right/,
        c = /top|center|bottom/,
        e = a.fn.position,
        h = a.fn.offset;
    a.fn.position = function (g)
    {
        if (!g || !g.of) return e.apply(this, arguments);
        g = a.extend(
        {}, g);
        var i = a(g.of),
            b = i[0],
            f = (g.collision || "flip").split(" "),
            j = g.offset ? g.offset.split(" ") : [0, 0],
            l, o, n;
        if (b.nodeType === 9)
        {
            l = i.width();
            o = i.height();
            n = {
                top: 0,
                left: 0
            }
        }
        else if (b.setTimeout)
        {
            l = i.width();
            o = i.height();
            n = {
                top: i.scrollTop(),
                left: i.scrollLeft()
            }
        }
        else if (b.preventDefault)
        {
            g.at = "left top";
            l = o = 0;
            n = {
                top: g.of.pageY,
                left: g.of.pageX
            }
        }
        else
        {
            l = i.outerWidth();
            o = i.outerHeight();
            n = i.offset()
        }
        a.each(["my", "at"], function ()
        {
            var k = (g[this] || "").split(" ");
            if (k.length === 1) k = d.test(k[0]) ? k.concat(["center"]) : c.test(k[0]) ? ["center"].concat(k) : ["center", "center"];
            k[0] = d.test(k[0]) ? k[0] : "center";
            k[1] = c.test(k[1]) ? k[1] : "center";
            g[this] = k
        });
        if (f.length === 1) f[1] = f[0];
        j[0] = parseInt(j[0], 10) || 0;
        if (j.length === 1) j[1] = j[0];
        j[1] = parseInt(j[1], 10) || 0;
        if (g.at[0] === "right") n.left += l;
        else if (g.at[0] === "center") n.left += l / 2;
        if (g.at[1] === "bottom") n.top += o;
        else if (g.at[1] === "center") n.top += o / 2;
        n.left += j[0];
        n.top += j[1];
        return this.each(function ()
        {
            var k = a(this),
                m = k.outerWidth(),
                p = k.outerHeight(),
                q = parseInt(a.curCSS(this, "marginLeft", true)) || 0,
                s = parseInt(a.curCSS(this, "marginTop", true)) || 0,
                r = m + q + (parseInt(a.curCSS(this, "marginRight", true)) || 0),
                u = p + s + (parseInt(a.curCSS(this, "marginBottom", true)) || 0),
                v = a.extend(
                {}, n),
                w;
            if (g.my[0] === "right") v.left -= m;
            else if (g.my[0] === "center") v.left -= m / 2;
            if (g.my[1] === "bottom") v.top -= p;
            else if (g.my[1] === "center") v.top -= p / 2;
            v.left = Math.round(v.left);
            v.top = Math.round(v.top);
            w = {
                left: v.left - q,
                top: v.top - s
            };
            a.each(["left", "top"], function (x, y)
            {
                a.ui.position[f[x]] && a.ui.position[f[x]][y](v, {
                    targetWidth: l,
                    targetHeight: o,
                    elemWidth: m,
                    elemHeight: p,
                    collisionPosition: w,
                    collisionWidth: r,
                    collisionHeight: u,
                    offset: j,
                    my: g.my,
                    at: g.at
                })
            });
            a.fn.bgiframe && k.bgiframe();
            k.offset(a.extend(v, {
                using: g.using
            }))
        })
    };
    a.ui.position = {
        fit: {
            left: function (g, i)
            {
                var b = a(window);
                b = i.collisionPosition.left + i.collisionWidth - b.width() - b.scrollLeft();
                g.left = b > 0 ? g.left - b : Math.max(g.left - i.collisionPosition.left, g.left)
            },
            top: function (g, i)
            {
                var b = a(window);
                b = i.collisionPosition.top + i.collisionHeight - b.height() - b.scrollTop();
                g.top = b > 0 ? g.top - b : Math.max(g.top - i.collisionPosition.top, g.top)
            }
        },
        flip: {
            left: function (g, i)
            {
                if (i.at[0] !== "center")
                {
                    var b = a(window);
                    b = i.collisionPosition.left + i.collisionWidth - b.width() - b.scrollLeft();
                    var f = i.my[0] === "left" ? -i.elemWidth : i.my[0] === "right" ? i.elemWidth : 0,
                        j = i.at[0] === "left" ? i.targetWidth : -i.targetWidth,
                        l = -2 * i.offset[0];
                    g.left += i.collisionPosition.left < 0 ? f + j + l : b > 0 ? f + j + l : 0
                }
            },
            top: function (g, i)
            {
                if (i.at[1] !== "center")
                {
                    var b = a(window);
                    b = i.collisionPosition.top + i.collisionHeight - b.height() - b.scrollTop();
                    var f = i.my[1] === "top" ? -i.elemHeight : i.my[1] === "bottom" ? i.elemHeight : 0,
                        j = i.at[1] === "top" ? i.targetHeight : -i.targetHeight,
                        l = -2 * i.offset[1];
                    g.top += i.collisionPosition.top < 0 ? f + j + l : b > 0 ? f + j + l : 0
                }
            }
        }
    };
    if (!a.offset.setOffset)
    {
        a.offset.setOffset = function (g, i)
        {
            if (/static/.test(a.curCSS(g, "position"))) g.style.position = "relative";
            var b = a(g),
                f = b.offset(),
                j = parseInt(a.curCSS(g, "top", true), 10) || 0,
                l = parseInt(a.curCSS(g, "left", true), 10) || 0;
            f = {
                top: i.top - f.top + j,
                left: i.left - f.left + l
            };
            "using" in i ? i.using.call(g, f) : b.css(f)
        };
        a.fn.offset = function (g)
        {
            var i = this[0];
            if (!i || !i.ownerDocument) return null;
            if (g) return this.each(function ()
            {
                a.offset.setOffset(this, g)
            });
            return h.call(this)
        }
    }
})(jQuery);
(function (a, d)
{
    a.widget("ui.progressbar", {
        options: {
            value: 0,
            max: 100
        },
        min: 0,
        _create: function ()
        {
            this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr(
            {
                role: "progressbar",
                "aria-valuemin": this.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._value()
            });
            this.valueDiv = a("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element);
            this.oldValue = this._value();
            this._refreshValue()
        },
        destroy: function ()
        {
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
            this.valueDiv.remove();
            a.Widget.prototype.destroy.apply(this, arguments)
        },
        value: function (c)
        {
            if (c === d) return this._value();
            this._setOption("value", c);
            return this
        },
        _setOption: function (c, e)
        {
            if (c === "value")
            {
                this.options.value = e;
                this._refreshValue();
                this._value() === this.options.max && this._trigger("complete")
            }
            a.Widget.prototype._setOption.apply(this, arguments)
        },
        _value: function ()
        {
            var c = this.options.value;
            if (typeof c !== "number") c = 0;
            return Math.min(this.options.max, Math.max(this.min, c))
        },
        _percentage: function ()
        {
            return 100 * this._value() / this.options.max
        },
        _refreshValue: function ()
        {
            var c = this.value(),
                e = this._percentage();
            if (this.oldValue !== c)
            {
                this.oldValue = c;
                this._trigger("change")
            }
            this.valueDiv.toggle(c > this.min).toggleClass("ui-corner-right", c === this.options.max).width(e.toFixed(0) + "%");
            this.element.attr("aria-valuenow", c)
        }
    });
    a.extend(a.ui.progressbar, {
        version: "1.8.16"
    })
})(jQuery);
(function (a)
{
    a.widget("ui.slider", a.ui.mouse, {
        widgetEventPrefix: "slide",
        options: {
            animate: false,
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: false,
            step: 1,
            value: 0,
            values: null
        },
        _create: function ()
        {
            var d = this,
                c = this.options,
                e = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                h = c.values && c.values.length || 1,
                g = [];
            this._mouseSliding = this._keySliding = false;
            this._animateOff = true;
            this._handleIndex = null;
            this._detectOrientation();
            this._mouseInit();
            this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all" + (c.disabled ? " ui-slider-disabled ui-disabled" : ""));
            this.range = a([]);
            if (c.range)
            {
                if (c.range === true)
                {
                    if (!c.values) c.values = [this._valueMin(), this._valueMin()];
                    if (c.values.length && c.values.length !== 2) c.values = [c.values[0], c.values[0]]
                }
                this.range = a("<div></div>").appendTo(this.element).addClass("ui-slider-range ui-widget-header" + (c.range === "min" || c.range === "max" ? " ui-slider-range-" + c.range : ""))
            }
            for (var i = e.length; i < h; i += 1) g.push("<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>");
            this.handles = e.add(a(g.join("")).appendTo(d.element));
            this.handle = this.handles.eq(0);
            this.handles.add(this.range).filter("a").click(function (b)
            {
                b.preventDefault()
            }).hover(function ()
            {
                c.disabled || a(this).addClass("ui-state-hover")
            }, function ()
            {
                a(this).removeClass("ui-state-hover")
            }).focus(function ()
            {
                if (c.disabled) a(this).blur();
                else
                {
                    a(".ui-slider .ui-state-focus").removeClass("ui-state-focus");
                    a(this).addClass("ui-state-focus")
                }
            }).blur(function ()
            {
                a(this).removeClass("ui-state-focus")
            });
            this.handles.each(function (b)
            {
                a(this).data("index.ui-slider-handle", b)
            });
            this.handles.keydown(function (b)
            {
                var f = true,
                    j = a(this).data("index.ui-slider-handle"),
                    l, o, n;
                if (!d.options.disabled)
                {
                    switch (b.keyCode)
                    {
                    case a.ui.keyCode.HOME:
                    case a.ui.keyCode.END:
                    case a.ui.keyCode.PAGE_UP:
                    case a.ui.keyCode.PAGE_DOWN:
                    case a.ui.keyCode.UP:
                    case a.ui.keyCode.RIGHT:
                    case a.ui.keyCode.DOWN:
                    case a.ui.keyCode.LEFT:
                        f = false;
                        if (!d._keySliding)
                        {
                            d._keySliding = true;
                            a(this).addClass("ui-state-active");
                            l = d._start(b, j);
                            if (l === false) return
                        }
                        break
                    }
                    n = d.options.step;
                    l = d.options.values && d.options.values.length ? (o = d.values(j)) : (o = d.value());
                    switch (b.keyCode)
                    {
                    case a.ui.keyCode.HOME:
                        o = d._valueMin();
                        break;
                    case a.ui.keyCode.END:
                        o = d._valueMax();
                        break;
                    case a.ui.keyCode.PAGE_UP:
                        o = d._trimAlignValue(l + (d._valueMax() - d._valueMin()) / 5);
                        break;
                    case a.ui.keyCode.PAGE_DOWN:
                        o = d._trimAlignValue(l - (d._valueMax() - d._valueMin()) / 5);
                        break;
                    case a.ui.keyCode.UP:
                    case a.ui.keyCode.RIGHT:
                        if (l === d._valueMax()) return;
                        o = d._trimAlignValue(l + n);
                        break;
                    case a.ui.keyCode.DOWN:
                    case a.ui.keyCode.LEFT:
                        if (l === d._valueMin()) return;
                        o = d._trimAlignValue(l - n);
                        break
                    }
                    d._slide(b, j, o);
                    return f
                }
            }).keyup(function (b)
            {
                var f = a(this).data("index.ui-slider-handle");
                if (d._keySliding)
                {
                    d._keySliding = false;
                    d._stop(b, f);
                    d._change(b, f);
                    a(this).removeClass("ui-state-active")
                }
            });
            this._refreshValue();
            this._animateOff = false
        },
        destroy: function ()
        {
            this.handles.remove();
            this.range.remove();
            this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-slider-disabled ui-widget ui-widget-content ui-corner-all").removeData("slider").unbind(".slider");
            this._mouseDestroy();
            return this
        },
        _mouseCapture: function (d)
        {
            var c = this.options,
                e, h, g, i, b;
            if (c.disabled) return false;
            this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            };
            this.elementOffset = this.element.offset();
            e = this._normValueFromMouse(
            {
                x: d.pageX,
                y: d.pageY
            });
            h = this._valueMax() - this._valueMin() + 1;
            i = this;
            this.handles.each(function (f)
            {
                var j = Math.abs(e - i.values(f));
                if (h > j)
                {
                    h = j;
                    g = a(this);
                    b = f
                }
            });
            if (c.range === true && this.values(1) === c.min)
            {
                b += 1;
                g = a(this.handles[b])
            }
            if (this._start(d, b) === false) return false;
            this._mouseSliding = true;
            i._handleIndex = b;
            g.addClass("ui-state-active").focus();
            c = g.offset();
            this._clickOffset = !a(d.target).parents().andSelf().is(".ui-slider-handle") ? {
                left: 0,
                top: 0
            } : {
                left: d.pageX - c.left - g.width() / 2,
                top: d.pageY - c.top - g.height() / 2 - (parseInt(g.css("borderTopWidth"), 10) || 0) - (parseInt(g.css("borderBottomWidth"), 10) || 0) + (parseInt(g.css("marginTop"), 10) || 0)
            };
            this.handles.hasClass("ui-state-hover") || this._slide(d, b, e);
            return this._animateOff = true
        },
        _mouseStart: function ()
        {
            return true
        },
        _mouseDrag: function (d)
        {
            var c = this._normValueFromMouse(
            {
                x: d.pageX,
                y: d.pageY
            });
            this._slide(d, this._handleIndex, c);
            return false
        },
        _mouseStop: function (d)
        {
            this.handles.removeClass("ui-state-active");
            this._mouseSliding = false;
            this._stop(d, this._handleIndex);
            this._change(d, this._handleIndex);
            this._clickOffset = this._handleIndex = null;
            return this._animateOff = false
        },
        _detectOrientation: function ()
        {
            this.orientation = this.options.orientation === "vertical" ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function (d)
        {
            var c;
            if (this.orientation === "horizontal")
            {
                c = this.elementSize.width;
                d = d.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)
            }
            else
            {
                c = this.elementSize.height;
                d = d.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)
            }
            c = d / c;
            if (c > 1) c = 1;
            if (c < 0) c = 0;
            if (this.orientation === "vertical") c = 1 - c;
            d = this._valueMax() - this._valueMin();
            return this._trimAlignValue(this._valueMin() + c * d)
        },
        _start: function (d, c)
        {
            var e = {
                handle: this.handles[c],
                value: this.value()
            };
            if (this.options.values && this.options.values.length)
            {
                e.value = this.values(c);
                e.values = this.values()
            }
            return this._trigger("start", d, e)
        },
        _slide: function (d, c, e)
        {
            var h;
            if (this.options.values && this.options.values.length)
            {
                h = this.values(c ? 0 : 1);
                if (this.options.values.length === 2 && this.options.range === true && (c === 0 && e > h || c === 1 && e < h)) e = h;
                if (e !== this.values(c))
                {
                    h = this.values();
                    h[c] = e;
                    d = this._trigger("slide", d, {
                        handle: this.handles[c],
                        value: e,
                        values: h
                    });
                    this.values(c ? 0 : 1);
                    d !== false && this.values(c, e, true)
                }
            }
            else if (e !== this.value())
            {
                d = this._trigger("slide", d, {
                    handle: this.handles[c],
                    value: e
                });
                d !== false && this.value(e)
            }
        },
        _stop: function (d, c)
        {
            var e = {
                handle: this.handles[c],
                value: this.value()
            };
            if (this.options.values && this.options.values.length)
            {
                e.value = this.values(c);
                e.values = this.values()
            }
            this._trigger("stop", d, e)
        },
        _change: function (d, c)
        {
            if (!this._keySliding && !this._mouseSliding)
            {
                var e = {
                    handle: this.handles[c],
                    value: this.value()
                };
                if (this.options.values && this.options.values.length)
                {
                    e.value = this.values(c);
                    e.values = this.values()
                }
                this._trigger("change", d, e)
            }
        },
        value: function (d)
        {
            if (arguments.length)
            {
                this.options.value = this._trimAlignValue(d);
                this._refreshValue();
                this._change(null, 0)
            }
            else return this._value()
        },
        values: function (d, c)
        {
            var e, h, g;
            if (arguments.length > 1)
            {
                this.options.values[d] = this._trimAlignValue(c);
                this._refreshValue();
                this._change(null, d)
            }
            else if (arguments.length) if (a.isArray(arguments[0]))
            {
                e = this.options.values;
                h = arguments[0];
                for (g = 0; g < e.length; g += 1)
                {
                    e[g] = this._trimAlignValue(h[g]);
                    this._change(null, g)
                }
                this._refreshValue()
            }
            else return this.options.values && this.options.values.length ? this._values(d) : this.value();
            else return this._values()
        },
        _setOption: function (d, c)
        {
            var e, h = 0;
            if (a.isArray(this.options.values)) h = this.options.values.length;
            a.Widget.prototype._setOption.apply(this, arguments);
            switch (d)
            {
            case "disabled":
                if (c)
                {
                    this.handles.filter(".ui-state-focus").blur();
                    this.handles.removeClass("ui-state-hover");
                    this.handles.propAttr("disabled", true);
                    this.element.addClass("ui-disabled")
                }
                else
                {
                    this.handles.propAttr("disabled", false);
                    this.element.removeClass("ui-disabled")
                }
                break;
            case "orientation":
                this._detectOrientation();
                this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation);
                this._refreshValue();
                break;
            case "value":
                this._animateOff = true;
                this._refreshValue();
                this._change(null, 0);
                this._animateOff = false;
                break;
            case "values":
                this._animateOff = true;
                this._refreshValue();
                for (e = 0; e < h; e += 1) this._change(null, e);
                this._animateOff = false;
                break
            }
        },
        _value: function ()
        {
            var d = this.options.value;
            return d = this._trimAlignValue(d)
        },
        _values: function (d)
        {
            var c, e;
            if (arguments.length)
            {
                c = this.options.values[d];
                return c = this._trimAlignValue(c)
            }
            else
            {
                c = this.options.values.slice();
                for (e = 0; e < c.length; e += 1) c[e] = this._trimAlignValue(c[e]);
                return c
            }
        },
        _trimAlignValue: function (d)
        {
            if (d <= this._valueMin()) return this._valueMin();
            if (d >= this._valueMax()) return this._valueMax();
            var c = this.options.step > 0 ? this.options.step : 1,
                e = (d - this._valueMin()) % c;
            d = d - e;
            if (Math.abs(e) * 2 >= c) d += e > 0 ? c : -c;
            return parseFloat(d.toFixed(5))
        },
        _valueMin: function ()
        {
            return this.options.min
        },
        _valueMax: function ()
        {
            return this.options.max
        },
        _refreshValue: function ()
        {
            var d = this.options.range,
                c = this.options,
                e = this,
                h = !this._animateOff ? c.animate : false,
                g, i = {},
                b, f, j, l;
            if (this.options.values && this.options.values.length) this.handles.each(function (o)
            {
                g = (e.values(o) - e._valueMin()) / (e._valueMax() - e._valueMin()) * 100;
                i[e.orientation === "horizontal" ? "left" : "bottom"] = g + "%";
                a(this).stop(1, 1)[h ? "animate" : "css"](i, c.animate);
                if (e.options.range === true) if (e.orientation === "horizontal")
                {
                    if (o === 0) e.range.stop(1, 1)[h ? "animate" : "css"](
                    {
                        left: g + "%"
                    }, c.animate);
                    if (o === 1) e.range[h ? "animate" : "css"](
                    {
                        width: g - b + "%"
                    }, {
                        queue: false,
                        duration: c.animate
                    })
                }
                else
                {
                    if (o === 0) e.range.stop(1, 1)[h ? "animate" : "css"](
                    {
                        bottom: g + "%"
                    }, c.animate);
                    if (o === 1) e.range[h ? "animate" : "css"](
                    {
                        height: g - b + "%"
                    }, {
                        queue: false,
                        duration: c.animate
                    })
                }
                b = g
            });
            else
            {
                f = this.value();
                j = this._valueMin();
                l = this._valueMax();
                g = l !== j ? (f - j) / (l - j) * 100 : 0;
                i[e.orientation === "horizontal" ? "left" : "bottom"] = g + "%";
                this.handle.stop(1, 1)[h ? "animate" : "css"](i, c.animate);
                if (d === "min" && this.orientation === "horizontal") this.range.stop(1, 1)[h ? "animate" : "css"](
                {
                    width: g + "%"
                }, c.animate);
                if (d === "max" && this.orientation === "horizontal") this.range[h ? "animate" : "css"](
                {
                    width: 100 - g + "%"
                }, {
                    queue: false,
                    duration: c.animate
                });
                if (d === "min" && this.orientation === "vertical") this.range.stop(1, 1)[h ? "animate" : "css"](
                {
                    height: g + "%"
                }, c.animate);
                if (d === "max" && this.orientation === "vertical") this.range[h ? "animate" : "css"](
                {
                    height: 100 - g + "%"
                }, {
                    queue: false,
                    duration: c.animate
                })
            }
        }
    });
    a.extend(a.ui.slider, {
        version: "1.8.16"
    })
})(jQuery);
(function (a, d)
{
    function c()
    {
        return ++h
    }
    function e()
    {
        return ++g
    }
    var h = 0,
        g = 0;
    a.widget("ui.tabs", {
        options: {
            add: null,
            ajaxOptions: null,
            cache: false,
            cookie: null,
            collapsible: false,
            disable: null,
            disabled: [],
            enable: null,
            event: "click",
            fx: null,
            idPrefix: "ui-tabs-",
            load: null,
            panelTemplate: "<div></div>",
            remove: null,
            select: null,
            show: null,
            spinner: "<em>Loading&#8230;</em>",
            tabTemplate: "<li><a href='#{href}'><span>#{label}</span></a></li>"
        },
        _create: function ()
        {
            this._tabify(true)
        },
        _setOption: function (i, b)
        {
            if (i == "selected") this.options.collapsible && b == this.options.selected || this.select(b);
            else
            {
                this.options[i] = b;
                this._tabify()
            }
        },
        _tabId: function (i)
        {
            return i.title && i.title.replace(/\s/g, "_").replace(/[^\w\u00c0-\uFFFF-]/g, "") || this.options.idPrefix + c()
        },
        _sanitizeSelector: function (i)
        {
            return i.replace(/:/g, "\\:")
        },
        _cookie: function ()
        {
            var i = this.cookie || (this.cookie = this.options.cookie.name || "ui-tabs-" + e());
            return a.cookie.apply(null, [i].concat(a.makeArray(arguments)))
        },
        _ui: function (i, b)
        {
            return {
                tab: i,
                panel: b,
                index: this.anchors.index(i)
            }
        },
        _cleanup: function ()
        {
            this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function ()
            {
                var i = a(this);
                i.html(i.data("label.tabs")).removeData("label.tabs")
            })
        },
        _tabify: function (i)
        {
            function b(r, u)
            {
                r.css("display", "");
                !a.support.opacity && u.opacity && r[0].style.removeAttribute("filter")
            }
            var f = this,
                j = this.options,
                l = /^#.+/;
            this.list = this.element.find("ol,ul").eq(0);
            this.lis = a(" > li:has(a[href])", this.list);
            this.anchors = this.lis.map(function ()
            {
                return a("a", this)[0]
            });
            this.panels = a([]);
            this.anchors.each(function (r, u)
            {
                var v = a(u).attr("href"),
                    w = v.split("#")[0],
                    x;
                if (w && (w === location.toString().split("#")[0] || (x = a("base")[0]) && w === x.href))
                {
                    v = u.hash;
                    u.href = v
                }
                if (l.test(v)) f.panels = f.panels.add(f.element.find(f._sanitizeSelector(v)));
                else if (v && v !== "#")
                {
                    a.data(u, "href.tabs", v);
                    a.data(u, "load.tabs", v.replace(/#.*$/, ""));
                    v = f._tabId(u);
                    u.href = "#" + v;
                    u = f.element.find("#" + v);
                    if (!u.length)
                    {
                        u = a(j.panelTemplate).attr("id", v).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(f.panels[r - 1] || f.list);
                        u.data("destroy.tabs", true)
                    }
                    f.panels = f.panels.add(u)
                }
                else j.disabled.push(r)
            });
            if (i)
            {
                this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all");
                this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");
                this.lis.addClass("ui-state-default ui-corner-top");
                this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom");
                if (j.selected === d)
                {
                    location.hash && this.anchors.each(function (r, u)
                    {
                        if (u.hash == location.hash)
                        {
                            j.selected = r;
                            return false
                        }
                    });
                    if (typeof j.selected !== "number" && j.cookie) j.selected = parseInt(f._cookie(), 10);
                    if (typeof j.selected !== "number" && this.lis.filter(".ui-tabs-selected").length) j.selected = this.lis.index(this.lis.filter(".ui-tabs-selected"));
                    j.selected = j.selected || (this.lis.length ? 0 : -1)
                }
                else if (j.selected === null) j.selected = -1;
                j.selected = j.selected >= 0 && this.anchors[j.selected] || j.selected < 0 ? j.selected : 0;
                j.disabled = a.unique(j.disabled.concat(a.map(this.lis.filter(".ui-state-disabled"), function (r)
                {
                    return f.lis.index(r)
                }))).sort();
                a.inArray(j.selected, j.disabled) != -1 && j.disabled.splice(a.inArray(j.selected, j.disabled), 1);
                this.panels.addClass("ui-tabs-hide");
                this.lis.removeClass("ui-tabs-selected ui-state-active");
                if (j.selected >= 0 && this.anchors.length)
                {
                    f.element.find(f._sanitizeSelector(f.anchors[j.selected].hash)).removeClass("ui-tabs-hide");
                    this.lis.eq(j.selected).addClass("ui-tabs-selected ui-state-active");
                    f.element.queue("tabs", function ()
                    {
                        f._trigger("show", null, f._ui(f.anchors[j.selected], f.element.find(f._sanitizeSelector(f.anchors[j.selected].hash))[0]))
                    });
                    this.load(j.selected)
                }
                a(window).bind("unload", function ()
                {
                    f.lis.add(f.anchors).unbind(".tabs");
                    f.lis = f.anchors = f.panels = null
                })
            }
            else j.selected = this.lis.index(this.lis.filter(".ui-tabs-selected"));
            this.element[j.collapsible ? "addClass" : "removeClass"]("ui-tabs-collapsible");
            j.cookie && this._cookie(j.selected, j.cookie);
            i = 0;
            for (var o; o = this.lis[i]; i++) a(o)[a.inArray(i, j.disabled) != -1 && !a(o).hasClass("ui-tabs-selected") ? "addClass" : "removeClass"]("ui-state-disabled");
            j.cache === false && this.anchors.removeData("cache.tabs");
            this.lis.add(this.anchors).unbind(".tabs");
            if (j.event !== "mouseover")
            {
                var n = function (r, u)
                    {
                        u.is(":not(.ui-state-disabled)") && u.addClass("ui-state-" + r)
                    },
                    k = function (r, u)
                    {
                        u.removeClass("ui-state-" + r)
                    };
                this.lis.bind("mouseover.tabs", function ()
                {
                    n("hover", a(this))
                });
                this.lis.bind("mouseout.tabs", function ()
                {
                    k("hover", a(this))
                });
                this.anchors.bind("focus.tabs", function ()
                {
                    n("focus", a(this).closest("li"))
                });
                this.anchors.bind("blur.tabs", function ()
                {
                    k("focus", a(this).closest("li"))
                })
            }
            var m, p;
            if (j.fx) if (a.isArray(j.fx))
            {
                m = j.fx[0];
                p = j.fx[1]
            }
            else m = p = j.fx;
            var q = p ?
            function (r, u)
            {
                a(r).closest("li").addClass("ui-tabs-selected ui-state-active");
                u.hide().removeClass("ui-tabs-hide").animate(p, p.duration || "normal", function ()
                {
                    b(u, p);
                    f._trigger("show", null, f._ui(r, u[0]))
                })
            } : function (r, u)
            {
                a(r).closest("li").addClass("ui-tabs-selected ui-state-active");
                u.removeClass("ui-tabs-hide");
                f._trigger("show", null, f._ui(r, u[0]))
            }, s = m ?
            function (r, u)
            {
                u.animate(m, m.duration || "normal", function ()
                {
                    f.lis.removeClass("ui-tabs-selected ui-state-active");
                    u.addClass("ui-tabs-hide");
                    b(u, m);
                    f.element.dequeue("tabs")
                })
            } : function (r, u)
            {
                f.lis.removeClass("ui-tabs-selected ui-state-active");
                u.addClass("ui-tabs-hide");
                f.element.dequeue("tabs")
            };
            this.anchors.bind(j.event + ".tabs", function ()
            {
                var r = this,
                    u = a(r).closest("li"),
                    v = f.panels.filter(":not(.ui-tabs-hide)"),
                    w = f.element.find(f._sanitizeSelector(r.hash));
                if (u.hasClass("ui-tabs-selected") && !j.collapsible || u.hasClass("ui-state-disabled") || u.hasClass("ui-state-processing") || f.panels.filter(":animated").length || f._trigger("select", null, f._ui(this, w[0])) === false)
                {
                    this.blur();
                    return false
                }
                j.selected = f.anchors.index(this);
                f.abort();
                if (j.collapsible) if (u.hasClass("ui-tabs-selected"))
                {
                    j.selected = -1;
                    j.cookie && f._cookie(j.selected, j.cookie);
                    f.element.queue("tabs", function ()
                    {
                        s(r, v)
                    }).dequeue("tabs");
                    this.blur();
                    return false
                }
                else if (!v.length)
                {
                    j.cookie && f._cookie(j.selected, j.cookie);
                    f.element.queue("tabs", function ()
                    {
                        q(r, w)
                    });
                    f.load(f.anchors.index(this));
                    this.blur();
                    return false
                }
                j.cookie && f._cookie(j.selected, j.cookie);
                if (w.length)
                {
                    v.length && f.element.queue("tabs", function ()
                    {
                        s(r, v)
                    });
                    f.element.queue("tabs", function ()
                    {
                        q(r, w)
                    });
                    f.load(f.anchors.index(this))
                }
                else throw "jQuery UI Tabs: Mismatching fragment identifier.";
                a.browser.msie && this.blur()
            });
            this.anchors.bind("click.tabs", function ()
            {
                return false
            })
        },
        _getIndex: function (i)
        {
            if (typeof i == "string") i = this.anchors.index(this.anchors.filter("[href$=" + i + "]"));
            return i
        },
        destroy: function ()
        {
            var i = this.options;
            this.abort();
            this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs");
            this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");
            this.anchors.each(function ()
            {
                var b = a.data(this, "href.tabs");
                if (b) this.href = b;
                var f = a(this).unbind(".tabs");
                a.each(["href", "load", "cache"], function (j, l)
                {
                    f.removeData(l + ".tabs")
                })
            });
            this.lis.unbind(".tabs").add(this.panels).each(function ()
            {
                a.data(this, "destroy.tabs") ? a(this).remove() : a(this).removeClass("ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-hover ui-state-focus ui-state-disabled ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide")
            });
            i.cookie && this._cookie(null, i.cookie);
            return this
        },
        add: function (i, b, f)
        {
            if (f === d) f = this.anchors.length;
            var j = this,
                l = this.options;
            b = a(l.tabTemplate.replace(/#\{href\}/g, i).replace(/#\{label\}/g, b));
            i = !i.indexOf("#") ? i.replace("#", "") : this._tabId(a("a", b)[0]);
            b.addClass("ui-state-default ui-corner-top").data("destroy.tabs", true);
            var o = j.element.find("#" + i);
            o.length || (o = a(l.panelTemplate).attr("id", i).data("destroy.tabs", true));
            o.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide");
            if (f >= this.lis.length)
            {
                b.appendTo(this.list);
                o.appendTo(this.list[0].parentNode)
            }
            else
            {
                b.insertBefore(this.lis[f]);
                o.insertBefore(this.panels[f])
            }
            l.disabled = a.map(l.disabled, function (n)
            {
                return n >= f ? ++n : n
            });
            this._tabify();
            if (this.anchors.length == 1)
            {
                l.selected = 0;
                b.addClass("ui-tabs-selected ui-state-active");
                o.removeClass("ui-tabs-hide");
                this.element.queue("tabs", function ()
                {
                    j._trigger("show", null, j._ui(j.anchors[0], j.panels[0]))
                });
                this.load(0)
            }
            this._trigger("add", null, this._ui(this.anchors[f], this.panels[f]));
            return this
        },
        remove: function (i)
        {
            i = this._getIndex(i);
            var b = this.options,
                f = this.lis.eq(i).remove(),
                j = this.panels.eq(i).remove();
            if (f.hasClass("ui-tabs-selected") && this.anchors.length > 1) this.select(i + (i + 1 < this.anchors.length ? 1 : -1));
            b.disabled = a.map(a.grep(b.disabled, function (l)
            {
                return l != i
            }), function (l)
            {
                return l >= i ? --l : l
            });
            this._tabify();
            this._trigger("remove", null, this._ui(f.find("a")[0], j[0]));
            return this
        },
        enable: function (i)
        {
            i = this._getIndex(i);
            var b = this.options;
            if (a.inArray(i, b.disabled) != -1)
            {
                this.lis.eq(i).removeClass("ui-state-disabled");
                b.disabled = a.grep(b.disabled, function (f)
                {
                    return f != i
                });
                this._trigger("enable", null, this._ui(this.anchors[i], this.panels[i]));
                return this
            }
        },
        disable: function (i)
        {
            i = this._getIndex(i);
            var b = this.options;
            if (i != b.selected)
            {
                this.lis.eq(i).addClass("ui-state-disabled");
                b.disabled.push(i);
                b.disabled.sort();
                this._trigger("disable", null, this._ui(this.anchors[i], this.panels[i]))
            }
            return this
        },
        select: function (i)
        {
            i = this._getIndex(i);
            if (i == -1) if (this.options.collapsible && this.options.selected != -1) i = this.options.selected;
            else return this;
            this.anchors.eq(i).trigger(this.options.event + ".tabs");
            return this
        },
        load: function (i)
        {
            i = this._getIndex(i);
            var b = this,
                f = this.options,
                j = this.anchors.eq(i)[0],
                l = a.data(j, "load.tabs");
            this.abort();
            if (!l || this.element.queue("tabs").length !== 0 && a.data(j, "cache.tabs")) this.element.dequeue("tabs");
            else
            {
                this.lis.eq(i).addClass("ui-state-processing");
                if (f.spinner)
                {
                    var o = a("span", j);
                    o.data("label.tabs", o.html()).html(f.spinner)
                }
                this.xhr = a.ajax(a.extend(
                {}, f.ajaxOptions, {
                    url: l,
                    success: function (n, k)
                    {
                        b.element.find(b._sanitizeSelector(j.hash)).html(n);
                        b._cleanup();
                        f.cache && a.data(j, "cache.tabs", true);
                        b._trigger("load", null, b._ui(b.anchors[i], b.panels[i]));
                        try
                        {
                            f.ajaxOptions.success(n, k)
                        }
                        catch (m)
                        {}
                    },
                    error: function (n, k)
                    {
                        b._cleanup();
                        b._trigger("load", null, b._ui(b.anchors[i], b.panels[i]));
                        try
                        {
                            f.ajaxOptions.error(n, k, i, j)
                        }
                        catch (m)
                        {}
                    }
                }));
                b.element.dequeue("tabs");
                return this
            }
        },
        abort: function ()
        {
            this.element.queue([]);
            this.panels.stop(false, true);
            this.element.queue("tabs", this.element.queue("tabs").splice(-2, 2));
            if (this.xhr)
            {
                this.xhr.abort();
                delete this.xhr
            }
            this._cleanup();
            return this
        },
        url: function (i, b)
        {
            this.anchors.eq(i).removeData("cache.tabs").data("load.tabs", b);
            return this
        },
        length: function ()
        {
            return this.anchors.length
        }
    });
    a.extend(a.ui.tabs, {
        version: "1.8.16"
    });
    a.extend(a.ui.tabs.prototype, {
        rotation: null,
        rotate: function (i, b)
        {
            var f = this,
                j = this.options,
                l = f._rotate || (f._rotate = function (o)
                {
                    clearTimeout(f.rotation);
                    f.rotation = setTimeout(function ()
                    {
                        var n = j.selected;
                        f.select(++n < f.anchors.length ? n : 0)
                    }, i);
                    o && o.stopPropagation()
                });
            b = f._unrotate || (f._unrotate = !b ?
            function (o)
            {
                o.clientX && f.rotate(null)
            } : function ()
            {
                t = j.selected;
                l()
            });
            if (i)
            {
                this.element.bind("tabsshow", l);
                this.anchors.bind(j.event + ".tabs", b);
                l()
            }
            else
            {
                clearTimeout(f.rotation);
                this.element.unbind("tabsshow", l);
                this.anchors.unbind(j.event + ".tabs", b);
                delete this._rotate;
                delete this._unrotate
            }
            return this
        }
    })
})(jQuery);

/**
 * --------------------------------------------------------------------
 * jQuery-Plugin "visualize"
 * by Scott Jehl, scott@filamentgroup.com
 * http://www.filamentgroup.com
 * Copyright (c) 2009 Filament Group 
 * Dual licensed under the MIT (filamentgroup.com/examples/mit-license.txt) and GPL (filamentgroup.com/examples/gpl-license.txt) licenses.
 * 	
 * --------------------------------------------------------------------
 */ (function ($)
{
    $.fn.visualize = function (options, container)
    {
        return $(this).each(function ()
        {
            //configuration
            var o = $.extend(
            {
                type: 'bar',
                //also available: area, pie, line
                width: $(this).width(),
                //height of canvas - defaults to table height
                height: $(this).height(),
                //height of canvas - defaults to table height
                appendTitle: true,
                //table caption text is added to chart
                title: null,
                //grabs from table caption if null
                appendKey: true,
                //color key is added to chart
                colors: ['#ae432e', '#77ab13', '#058dc7', '#ef561a', '#8d10ee', '#5a3b16', '#26a4ed', '#f45a90', '#e9e744'],
                textColors: [],
                //corresponds with colors array. null/undefined items will fall back to CSS
                parseDirection: 'x',
                //which direction to parse the table data
                pieMargin: 10,
                //pie charts only - spacing around pie
                pieLabelsAsPercent: true,
                pieLabelPos: 'inside',
                lineWeight: 4,
                //for line and area - stroke weight
                lineDots: false,
                //also available: 'single', 'double'
                dotInnerColor: "#ffffff",
                // only used for lineDots:'double'
                lineMargin: (options.lineDots ? 15 : 0),
                //for line and area - spacing around lines
                barGroupMargin: 10,
                chartId: '',
                xLabelParser: null,
                // function to parse labels as values
                valueParser: null,
                // function to parse values. must return a Number
                chartId: '',
                chartClass: '',
                barMargin: 1,
                //space around bars in bar chart (added to both sides of bar)
                yLabelInterval: 30,
                //distance between y labels
                interaction: false // only used for lineDots != false -- triggers mouseover and mouseout on original table
            }, options);

            //reset width, height to numbers
            o.width = parseFloat(o.width);
            o.height = parseFloat(o.height);

            // reset padding if graph is not lines
            if (o.type != 'line' && o.type != 'area')
            {
                o.lineMargin = 0;
            }

            var self = $(this);

            // scrape data from html table
            var tableData = {};
            var colors = o.colors;
            var textColors = o.textColors;


            var parseLabels = function (direction)
                {
                    var labels = [];
                    if (direction == 'x')
                    {
                        self.find('thead tr').each(function (i)
                        {
                            $(this).find('th').each(function (j)
                            {
                                if (!labels[j])
                                {
                                    labels[j] = [];
                                }
                                labels[j][i] = $(this).text()
                            })
                        });
                    }
                    else
                    {
                        self.find('tbody tr').each(function (i)
                        {
                            $(this).find('th').each(function (j)
                            {
                                if (!labels[i])
                                {
                                    labels[i] = [];
                                }
                                labels[i][j] = $(this).text()
                            });
                        });
                    }
                    return labels;
                };

            var fnParse = o.valueParser || parseFloat;
            var dataGroups = tableData.dataGroups = [];
            if (o.parseDirection == 'x')
            {
                self.find('tbody tr').each(function (i, tr)
                {
                    dataGroups[i] = {};
                    dataGroups[i].points = [];
                    dataGroups[i].color = colors[i];
                    if (textColors[i])
                    {
                        dataGroups[i].textColor = textColors[i];
                    }
                    $(tr).find('td').each(function (j, td)
                    {
                        dataGroups[i].points.push(
                        {
                            value: fnParse($(td).text()),
                            elem: td,
                            tableCords: [i, j]
                        });
                    });
                });
            }
            else
            {
                var cols = self.find('tbody tr:eq(0) td').size();
                for (var i = 0; i < cols; i++)
                {
                    dataGroups[i] = {};
                    dataGroups[i].points = [];
                    dataGroups[i].color = colors[i];
                    if (textColors[i])
                    {
                        dataGroups[i].textColor = textColors[i];
                    }
                    self.find('tbody tr').each(function (j)
                    {
                        dataGroups[i].points.push(
                        {
                            value: $(this).find('td').eq(i).text() * 1,
                            elem: this,
                            tableCords: [i, j]
                        });
                    });
                };
            }


            var allItems = tableData.allItems = [];
            $(dataGroups).each(function (i, row)
            {
                var count = 0;
                $.each(row.points, function (j, point)
                {
                    allItems.push(point);
                    count += point.value;
                });
                row.groupTotal = count;
            });

            tableData.dataSum = 0;
            tableData.topValue = 0;
            tableData.bottomValue = Infinity;
            $.each(allItems, function (i, item)
            {
                tableData.dataSum += fnParse(item.value);
                if (fnParse(item.value, 10) > tableData.topValue)
                {
                    tableData.topValue = fnParse(item.value, 10);
                }
                if (item.value < tableData.bottomValue)
                {
                    tableData.bottomValue = fnParse(item.value);
                }
            });
            var dataSum = tableData.dataSum;
            var topValue = tableData.topValue;
            var bottomValue = tableData.bottomValue;

            var xAllLabels = tableData.xAllLabels = parseLabels(o.parseDirection);
            var yAllLabels = tableData.yAllLabels = parseLabels(o.parseDirection === 'x' ? 'y' : 'x');

            var xLabels = tableData.xLabels = [];
            $.each(tableData.xAllLabels, function (i, labels)
            {
                tableData.xLabels.push(labels[0]);
            });

            var totalYRange = tableData.totalYRange = tableData.topValue - tableData.bottomValue;

            var zeroLocX = tableData.zeroLocX = 0;

            if ($.isFunction(o.xLabelParser))
            {

                var xTopValue = null;
                var xBottomValue = null;

                $.each(xLabels, function (i, label)
                {
                    label = xLabels[i] = o.xLabelParser(label);
                    if (i === 0)
                    {
                        xTopValue = label;
                        xBottomValue = label;
                    }
                    if (label > xTopValue)
                    {
                        xTopValue = label;
                    }
                    if (label < xBottomValue)
                    {
                        xBottomValue = label;
                    }
                });

                var totalXRange = tableData.totalXRange = xTopValue - xBottomValue;


                var xScale = tableData.xScale = (o.width - 2 * o.lineMargin) / totalXRange;
                var marginDiffX = 0;
                if (o.lineMargin)
                {
                    var marginDiffX = -2 * xScale - o.lineMargin;
                }
                zeroLocX = tableData.zeroLocX = xBottomValue + o.lineMargin;

                tableData.xBottomValue = xBottomValue;
                tableData.xTopValue = xTopValue;
                tableData.totalXRange = totalXRange;
            }

            var yScale = tableData.yScale = (o.height - 2 * o.lineMargin) / totalYRange;
            var zeroLocY = tableData.zeroLocY = (o.height - 2 * o.lineMargin) * (tableData.topValue / tableData.totalYRange) + o.lineMargin;

            var yLabels = tableData.yLabels = [];

            var numLabels = Math.floor((o.height - 2 * o.lineMargin) / 30);
            var loopInterval = tableData.totalYRange / numLabels; //fix provided from lab
            loopInterval = Math.round(parseFloat(loopInterval) / 5) * 5;
            loopInterval = Math.max(loopInterval, 1);
            // var start = 
            for (var j = Math.round(parseInt(tableData.bottomValue) / 5) * 5; j <= tableData.topValue + loopInterval; j += loopInterval)
            {
                yLabels.push(j);
            }
            if (yLabels[yLabels.length - 1] > tableData.topValue + loopInterval)
            {
                yLabels.pop();
            }
            else if (yLabels[yLabels.length - 1] <= tableData.topValue - 10)
            {
                yLabels.push(tableData.topValue);
            }

            // populate some data
            $.each(dataGroups, function (i, row)
            {
                row.yLabels = tableData.yAllLabels[i];
                $.each(row.points, function (j, point)
                {
                    point.zeroLocY = tableData.zeroLocY;
                    point.zeroLocX = tableData.zeroLocX;
                    point.xLabels = tableData.xAllLabels[j];
                    point.yLabels = tableData.yAllLabels[i];
                    point.color = row.color;
                });
            });

            try
            {
                console.log(tableData);
            }
            catch (e)
            {}

            var charts = {};

            charts.pie = {
                interactionPoints: dataGroups,

                setup: function ()
                {
                    charts.pie.draw(true);
                },
                draw: function (drawHtml)
                {

                    var centerx = Math.round(canvas.width() / 2);
                    var centery = Math.round(canvas.height() / 2);
                    var radius = centery - o.pieMargin;
                    var counter = 0.0;

                    if (drawHtml)
                    {
                        canvasContain.addClass('visualize-pie');

                        if (o.pieLabelPos == 'outside')
                        {
                            canvasContain.addClass('visualize-pie-outside');
                        }

                        var toRad = function (integer)
                            {
                                return (Math.PI / 180) * integer;
                            };
                        var labels = $('<ul class="visualize-labels"></ul>').insertAfter(canvas);
                    }


                    //draw the pie pieces
                    $.each(dataGroups, function (i, row)
                    {
                        var fraction = row.groupTotal / dataSum;
                        if (fraction <= 0 || isNaN(fraction)) return;
                        ctx.beginPath();
                        ctx.moveTo(centerx, centery);
                        ctx.arc(centerx, centery, radius, counter * Math.PI * 2 - Math.PI * 0.5, (counter + fraction) * Math.PI * 2 - Math.PI * 0.5, false);
                        ctx.lineTo(centerx, centery);
                        ctx.closePath();
                        ctx.fillStyle = dataGroups[i].color;
                        ctx.fill();
                        // draw labels
                        if (drawHtml)
                        {
                            var sliceMiddle = (counter + fraction / 2);
                            var distance = o.pieLabelPos == 'inside' ? radius / 1.5 : radius + radius / 5;
                            var labelx = Math.round(centerx + Math.sin(sliceMiddle * Math.PI * 2) * (distance));
                            var labely = Math.round(centery - Math.cos(sliceMiddle * Math.PI * 2) * (distance));
                            var leftRight = (labelx > centerx) ? 'right' : 'left';
                            var topBottom = (labely > centery) ? 'bottom' : 'top';
                            var percentage = parseFloat((fraction * 100).toFixed(2));

                            // interaction variables
                            row.canvasCords = [labelx, labely];
                            row.zeroLocY = tableData.zeroLocY = 0; // related to zeroLocY and plugin API
                            row.zeroLocX = tableData.zeroLocX = 0; // related to zeroLocX and plugin API
                            row.value = row.groupTotal;


                            if (percentage)
                            {
                                var labelval = (o.pieLabelsAsPercent) ? percentage + '%' : row.groupTotal;
                                var labeltext = $('<span class="visualize-label">' + labelval + '</span>').css(leftRight, 0).css(topBottom, 0);
                                if (labeltext) var label = $('<li class="visualize-label-pos"></li>').appendTo(labels).css(
                                {
                                    left: labelx,
                                    top: labely
                                }).append(labeltext);
                                labeltext.css('font-size', radius / 8).css('margin-' + leftRight, -labeltext.width() / 2).css('margin-' + topBottom, -labeltext.outerHeight() / 2);

                                if (dataGroups[i].textColor)
                                {
                                    labeltext.css('color', dataGroups[i].textColor);
                                }

                            }
                        }
                        counter += fraction;
                    });
                }
            };

            (function ()
            {

                var xInterval;

                var drawPoint = function (ctx, x, y, color, size)
                    {
                        ctx.moveTo(x, y);
                        ctx.beginPath();
                        ctx.arc(x, y, size / 2, 0, 2 * Math.PI, false);
                        ctx.closePath();
                        ctx.fillStyle = color;
                        ctx.fill();
                    };

                charts.line = {

                    interactionPoints: allItems,

                    setup: function (area)
                    {

                        if (area)
                        {
                            canvasContain.addClass('visualize-area');
                        }
                        else
                        {
                            canvasContain.addClass('visualize-line');
                        }

                        //write X labels
                        var xlabelsUL = $('<ul class="visualize-labels-x"></ul>').width(canvas.width()).height(canvas.height()).insertBefore(canvas);

                        if (!o.customXLabels)
                        {
                            xInterval = (canvas.width() - 2 * o.lineMargin) / (xLabels.length - 1);
                            $.each(xLabels, function (i)
                            {
                                var thisLi = $('<li><span>' + this + '</span></li>').prepend('<span class="line" />').css('left', o.lineMargin + xInterval * i).appendTo(xlabelsUL);
                                var label = thisLi.find('span:not(.line)');
                                var leftOffset = label.width() / -2;
                                if (i == 0)
                                {
                                    leftOffset = 0;
                                }
                                else if (i == xLabels.length - 1)
                                {
                                    leftOffset = -label.width();
                                }
                                label.css('margin-left', leftOffset).addClass('label');
                            });
                        }
                        else
                        {
                            o.customXLabels(tableData, xlabelsUL);
                        }

                        //write Y labels
                        var liBottom = (canvas.height() - 2 * o.lineMargin) / (yLabels.length - 1);
                        var ylabelsUL = $('<ul class="visualize-labels-y"></ul>').width(canvas.width()).height(canvas.height())
                        // .css('margin-top',-o.lineMargin)
                        .insertBefore(scroller);

                        $.each(yLabels, function (i)
                        {
                            var value = Math.floor(this);
                            var posB = (value - bottomValue) * yScale + o.lineMargin;
                            if (posB >= o.height - 1 || posB < 0)
                            {
                                return;
                            }
                            var thisLi = $('<li><span>' + value + '</span></li>').css('bottom', posB);
                            if (Math.abs(posB) < o.height - 1)
                            {
                                thisLi.prepend('<span class="line"  />');
                            }
                            thisLi.prependTo(ylabelsUL);

                            var label = thisLi.find('span:not(.line)');
                            var topOffset = label.height() / -2;
                            if (!o.lineMargin)
                            {
                                if (i == 0)
                                {
                                    topOffset = -label.height();
                                }
                                else if (i == yLabels.length - 1)
                                {
                                    topOffset = 0;
                                }
                            }
                            label.css('margin-top', topOffset).addClass('label');
                        });

                        //start from the bottom left
                        ctx.translate(zeroLocX, zeroLocY);

                        charts.line.draw(area);

                    },

                    draw: function (area)
                    {
                        // prevent drawing on top of previous draw
                        ctx.clearRect(-zeroLocX, -zeroLocY, o.width, o.height);
                        // Calculate each point properties before hand
                        var integer;
                        $.each(dataGroups, function (i, row)
                        {
                            integer = o.lineMargin; // the current offset
                            $.each(row.points, function (j, point)
                            {
                                if (o.xLabelParser)
                                {
                                    point.canvasCords = [(xLabels[j] - zeroLocX) * xScale - xBottomValue, -(point.value * yScale)];
                                }
                                else
                                {
                                    point.canvasCords = [integer, -(point.value * yScale)];
                                }

                                if (o.lineDots)
                                {
                                    point.dotSize = o.dotSize || o.lineWeight * Math.PI;
                                    point.dotInnerSize = o.dotInnerSize || o.lineWeight * Math.PI / 2;
                                    if (o.lineDots == 'double')
                                    {
                                        point.innerColor = o.dotInnerColor;
                                    }
                                }
                                integer += xInterval;
                            });
                        });
                        // fire custom event so we can enable rich interaction
                        self.trigger('vizualizeBeforeDraw', {
                            options: o,
                            table: self,
                            canvasContain: canvasContain,
                            tableData: tableData
                        });
                        // draw lines and areas
                        $.each(dataGroups, function (h)
                        {
                            // Draw lines
                            ctx.beginPath();
                            ctx.lineWidth = o.lineWeight;
                            ctx.lineJoin = 'round';
                            $.each(this.points, function (g)
                            {
                                var loc = this.canvasCords;
                                if (g == 0)
                                {
                                    ctx.moveTo(loc[0], loc[1]);
                                }
                                ctx.lineTo(loc[0], loc[1]);
                            });
                            ctx.strokeStyle = this.color;
                            ctx.stroke();
                            // Draw fills
                            if (area)
                            {
                                var integer = this.points[this.points.length - 1].canvasCords[0];
                                if (isFinite(integer)) ctx.lineTo(integer, 0);
                                ctx.lineTo(o.lineMargin, 0);
                                ctx.closePath();
                                ctx.fillStyle = this.color;
                                ctx.globalAlpha = .3;
                                ctx.fill();
                                ctx.globalAlpha = 1.0;
                            }
                            else
                            {
                                ctx.closePath();
                            }
                        });
                        // draw points
                        if (o.lineDots)
                        {
                            $.each(dataGroups, function (h)
                            {
                                $.each(this.points, function (g)
                                {
                                    drawPoint(ctx, this.canvasCords[0], this.canvasCords[1], this.color, this.dotSize);
                                    if (o.lineDots === 'double')
                                    {
                                        drawPoint(ctx, this.canvasCords[0], this.canvasCords[1], this.innerColor, this.dotInnerSize);
                                    }
                                });
                            });
                        }

                    }
                };

            })();

            charts.area = {
                setup: function ()
                {
                    charts.line.setup(true);
                },
                draw: charts.line.draw
            };

            (function ()
            {

                var horizontal, bottomLabels;

                charts.bar = {
                    setup: function ()
                    {
                        /**
                         * We can draw horizontal or vertical bars depending on the
                         * value of the 'barDirection' option (which may be 'vertical' or
                         * 'horizontal').
                         */

                        horizontal = (o.barDirection == 'horizontal');

                        canvasContain.addClass('visualize-bar');

                        /**
                         * Write labels along the bottom of the chart.	If we're drawing
                         * horizontal bars, these will be the yLabels, otherwise they
                         * will be the xLabels.	The positioning also varies slightly:
                         * yLabels are values, hence they will span the whole width of
                         * the canvas, whereas xLabels are supposed to line up with the
                         * bars.
                         */
                        bottomLabels = horizontal ? yLabels : xLabels;

                        var xInterval = canvas.width() / (bottomLabels.length - (horizontal ? 1 : 0));

                        var xlabelsUL = $('<ul class="visualize-labels-x"></ul>').width(canvas.width()).height(canvas.height()).insertBefore(canvas);

                        $.each(bottomLabels, function (i)
                        {
                            var thisLi = $('<li><span class="label">' + this + '</span></li>').prepend('<span class="line" />').css('left', xInterval * i).width(xInterval).appendTo(xlabelsUL);

                            if (horizontal)
                            {
                                var label = thisLi.find('span.label');
                                label.css("margin-left", -label.width() / 2);
                            }
                        });

                        /**
                         * Write labels along the left of the chart.	Follows the same idea
                         * as the bottom labels.
                         */
                        var leftLabels = horizontal ? xLabels : yLabels;
                        var liBottom = canvas.height() / (leftLabels.length - (horizontal ? 0 : 1));

                        var ylabelsUL = $('<ul class="visualize-labels-y"></ul>').width(canvas.width()).height(canvas.height()).insertBefore(canvas);

                        $.each(leftLabels, function (i)
                        {
                            var thisLi = $('<li><span>' + this + '</span></li>').prependTo(ylabelsUL);

                            var label = thisLi.find('span:not(.line)').addClass('label');

                            if (horizontal)
                            {
                                /**
                                 * For left labels, we want to vertically align the text
                                 * to the middle of its container, but we don't know how
                                 * many lines of text we will have, since the labels could
                                 * be very long.
                                 *
                                 * So we set a min-height of liBottom, and a max-height
                                 * of liBottom + 1, so we can then check the label's actual
                                 * height to determine if it spans one line or more lines.
                                 */
                                label.css(
                                {
                                    'min-height': liBottom,
                                    'max-height': liBottom + 1,
                                    'vertical-align': 'middle'
                                });
                                thisLi.css(
                                {
                                    'top': liBottom * i,
                                    'min-height': liBottom
                                });

                                var r = label[0].getClientRects()[0];
                                if (r.bottom - r.top == liBottom)
                                {
                                    /* This means we have only one line of text; hence
                                     * we can centre the text vertically by setting the line-height,
                                     * as described at:
                                     *   http://www.ampsoft.net/webdesign-l/vertical-aligned-nav-list.html
                                     *
                                     * (Although firefox has .height on the rectangle, IE doesn't,
                                     * so we use r.bottom - r.top rather than r.height.)
                                     */
                                    label.css('line-height', parseInt(liBottom) + 'px');
                                }
                                else
                                {
                                    /*
                                     * If there is more than one line of text, then we shouldn't
                                     * touch the line height, but we should make sure the text
                                     * doesn't overflow the container.
                                     */
                                    label.css("overflow", "hidden");
                                }
                            }
                            else
                            {
                                thisLi.css('bottom', liBottom * i).prepend('<span class="line" />');
                                label.css('margin-top', -label.height() / 2)
                            }
                        });

                        charts.bar.draw();

                    },

                    draw: function ()
                    {
                        // Draw bars
                        if (horizontal)
                        {
                            // for horizontal, keep the same code, but rotate everything 90 degrees
                            // clockwise.
                            ctx.rotate(Math.PI / 2);
                        }
                        else
                        {
                            // for vertical, translate to the top left corner.
                            ctx.translate(0, zeroLocY);
                        }

                        // Don't attempt to draw anything if all the values are zero,
                        // otherwise we will get weird exceptions from the canvas methods.
                        if (totalYRange <= 0) return;

                        var yScale = (horizontal ? canvas.width() : canvas.height()) / totalYRange;
                        var barWidth = horizontal ? (canvas.height() / xLabels.length) : (canvas.width() / (bottomLabels.length));
                        var linewidth = (barWidth - o.barGroupMargin * 2) / dataGroups.length;

                        for (var h = 0; h < dataGroups.length; h++)
                        {
                            ctx.beginPath();

                            var strokeWidth = linewidth - (o.barMargin * 2);
                            ctx.lineWidth = strokeWidth;
                            var points = dataGroups[h].points;
                            var integer = 0;
                            for (var i = 0; i < points.length; i++)
                            {
                                // If the last value is zero, IE will go nuts and not draw anything,
                                // so don't try to draw zero values at all.
                                if (points[i].value != 0)
                                {
                                    var xVal = (integer - o.barGroupMargin) + (h * linewidth) + linewidth / 2;
                                    xVal += o.barGroupMargin * 2;

                                    ctx.moveTo(xVal, 0);
                                    ctx.lineTo(xVal, Math.round(-points[i].value * yScale));
                                }
                                integer += barWidth;
                            }
                            ctx.strokeStyle = dataGroups[h].color;
                            ctx.stroke();
                            ctx.closePath();
                        }

                    }
                };

            })();

            //create new canvas, set w&h attrs (not inline styles)
            var canvasNode = document.createElement("canvas");
            var canvas = $(canvasNode).attr(
            {
                'height': o.height,
                'width': o.width
            });

            //get title for chart
            var title = o.title || self.find('caption').text();

            //create canvas wrapper div, set inline w&h, append
            var canvasContain = (container || $('<div ' + (o.chartId ? 'id="' + o.chartId + '" ' : '') + 'class="visualize ' + o.chartClass + '" role="img" aria-label="Chart representing data from the table: ' + title + '" />')).height(o.height).width(o.width);

            var scroller = $('<div class="visualize-scroller"></div>').appendTo(canvasContain).append(canvas);

            //title/key container
            if (o.appendTitle || o.appendKey)
            {
                var infoContain = $('<div class="visualize-info"></div>').appendTo(canvasContain);
            }

            //append title
            if (o.appendTitle)
            {
                $('<div class="visualize-title">' + title + '</div>').appendTo(infoContain);
            }


            //append key
            if (o.appendKey)
            {
                var newKey = $('<ul class="visualize-key"></ul>');
                $.each(yAllLabels, function (i, label)
                {
                    $('<li><span class="visualize-key-color" style="background: ' + dataGroups[i].color + '"></span><span class="visualize-key-label">' + label + '</span></li>').appendTo(newKey);
                });
                newKey.appendTo(infoContain);
            };

            // init interaction
            if (o.interaction)
            {
                // sets the canvas to track interaction
                // IE needs one div on top of the canvas since the VML shapes prevent mousemove from triggering correctly.
                // Pie charts needs tracker because labels goes on top of the canvas and also messes up with mousemove
                var tracker = $('<div class="visualize-interaction-tracker"/>').css(
                {
                    'height': o.height + 'px',
                    'width': o.width + 'px',
                    'position': 'relative',
                    'z-index': 200
                }).insertAfter(canvas);

                var triggerInteraction = function (overOut, data)
                    {
                        var data = $.extend(
                        {
                            canvasContain: canvasContain,
                            tableData: tableData
                        }, data);
                        self.trigger('vizualize' + overOut, data);
                    };

                var over = false,
                    last = false,
                    started = false;
                tracker.mousemove(function (e)
                {
                    var x, y, x1, y1, data, dist, i, current, selector, zLabel, elem, color, minDist, found, ev = e.originalEvent;

                    // get mouse position relative to the tracker/canvas
                    x = ev.layerX || ev.offsetX || 0;
                    y = ev.layerY || ev.offsetY || 0;

                    found = false;
                    minDist = started ? 30000 : (o.type == 'pie' ? (Math.round(canvas.height() / 2) - o.pieMargin) / 3 : o.lineWeight * 4);
                    // iterate datagroups to find points with matching
                    $.each(charts[o.type].interactionPoints, function (i, current)
                    {
                        x1 = current.canvasCords[0] + zeroLocX;
                        y1 = current.canvasCords[1] + (o.type == "pie" ? 0 : zeroLocY);
                        dist = Math.sqrt((x1 - x) * (x1 - x) + (y1 - y) * (y1 - y));
                        if (dist < minDist)
                        {
                            found = current;
                            minDist = dist;
                        }
                    });

                    if (o.multiHover && found)
                    {
                        x = found.canvasCords[0] + zeroLocX;
                        y = found.canvasCords[1] + (o.type == "pie" ? 0 : zeroLocY);
                        found = [found];
                        $.each(charts[o.type].interactionPoints, function (i, current)
                        {
                            if (current == found[0])
                            {
                                return;
                            }
                            x1 = current.canvasCords[0] + zeroLocX;
                            y1 = current.canvasCords[1] + zeroLocY;
                            dist = Math.sqrt((x1 - x) * (x1 - x) + (y1 - y) * (y1 - y));
                            if (dist <= o.multiHover)
                            {
                                found.push(current);
                            }
                        });
                    }
                    // trigger over and out only when state changes, instead of on every mousemove
                    over = found;
                    if (over != last)
                    {
                        if (over)
                        {
                            if (last)
                            {
                                triggerInteraction('Out', {
                                    point: last
                                });
                            }
                            triggerInteraction('Over', {
                                point: over
                            });
                            last = over;
                        }
                        if (last && !over)
                        {
                            triggerInteraction('Out', {
                                point: last
                            });
                            last = false;
                        }
                        started = true;
                    }
                });
                tracker.mouseleave(function ()
                {
                    triggerInteraction('Out', {
                        point: last,
                        mouseOutGraph: true
                    });
                    over = (last = false);
                });
            }

            //append new canvas to page
            if (!container)
            {
                canvasContain.insertAfter(this);
            }
            if (typeof (G_vmlCanvasManager) != 'undefined')
            {
                G_vmlCanvasManager.init();
                G_vmlCanvasManager.initElement(canvas[0]);
            }

            //set up the drawing board
            var ctx = canvas[0].getContext('2d');

            // Scroll graphs
            scroller.scrollLeft(o.width - scroller.width());

            // init plugins
            $.each($.visualizePlugins, function (i, plugin)
            {
                plugin.call(self, o, tableData);
            });

            //create chart
            charts[o.type].setup();

            if (!container)
            {
                //add event for updating
                self.bind('visualizeRefresh', function ()
                {
                    self.visualize(o, $(this).empty());
                });
                //add event for redraw
                self.bind('visualizeRedraw', function ()
                {
                    charts[o.type].draw();
                });
            }
        }).next(); //returns canvas(es)
    };
    // create array for plugins. if you wish to make a plugin,
    // just push your init funcion into this array
    $.visualizePlugins = [];

})(jQuery);

/**
 * --------------------------------------------------------------------
 * Tooltip plugin for the jQuery-Plugin "Visualize"
 * Tolltip by Ira� Carvalho, irae@irae.pro.br, http://irae.pro.br/en/
 * Copyright (c) 2010 Ira� Carvalho
 * Dual licensed under the MIT (filamentgroup.com/examples/mit-license.txt) and GPL (filamentgroup.com/examples/gpl-license.txt) licenses.
 * 	
 * Visualize plugin by Scott Jehl, scott@filamentgroup.com
 * Copyright (c) 2009 Filament Group, http://www.filamentgroup.com
 *
 * --------------------------------------------------------------------
 */

(function ($)
{
    $.visualizePlugins.push(function visualizeTooltip(options, tableData)
    {
        //configuration
        var o = $.extend(
        {
            tooltip: false,
            tooltipalign: 'auto',
            // also available 'left' and 'right'
            tooltipvalign: 'top',
            tooltipclass: 'visualize-tooltip',
            tooltiphtml: function (data)
            {
                if (options.multiHover)
                {
                    var html = '';
                    for (var i = 0; i < data.point.length; i++)
                    {
                        html += '<p>' + data.point[i].value + ' - ' + data.point[i].yLabels[0] + '</p>';
                    }
                    return html;
                }
                else
                {
                    return '<p>' + data.point.value + ' - ' + data.point.yLabels[0] + '</p>';
                }
            },
            delay: false
        }, options);

        // don't go any further if we are not to show anything
        if (!o.tooltip)
        {
            return;
        }

        var self = $(this),
            canvasContain = self.next(),
            scroller = canvasContain.find('.visualize-scroller'),
            scrollerW = scroller.width(),
            tracker = canvasContain.find('.visualize-interaction-tracker');

        // IE needs background color and opacity white or the tracker stays behind the tooltip
        tracker.css(
        {
            backgroundColor: 'white',
            opacity: 0,
            zIndex: 100
        });

        var tooltip = $('<div class="' + o.tooltipclass + '"/>').css(
        {
            position: 'absolute',
            display: 'none',
            zIndex: 90
        }).insertAfter(scroller.find('canvas'));

        var usescroll = true;

        if (typeof (G_vmlCanvasManager) != 'undefined')
        {
            scroller.css(
            {
                'position': 'absolute'
            });
            tracker.css(
            {
                marginTop: '-' + (o.height) + 'px'
            });
        }


        self.bind('vizualizeOver', function visualizeTooltipOver(e, data)
        {
            if (data.canvasContain.get(0) != canvasContain.get(0))
            {
                return;
            } // for multiple graphs originated from same table
            if (o.multiHover)
            {
                var p = data.point[0].canvasCords;
            }
            else
            {
                var p = data.point.canvasCords;
            }
            var left, right, top, clasRem, clasAd, bottom, x = Math.round(p[0] + data.tableData.zeroLocX),
                y = Math.round(p[1] + data.tableData.zeroLocY);
            if (o.tooltipalign == 'left' || (o.tooltipalign == 'auto' && x - scroller.scrollLeft() <= scrollerW / 2))
            {
                if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6))
                {
                    usescroll = false;
                }
                else
                {
                    usescroll = true;
                }
                left = x - (usescroll ? scroller.scrollLeft() : 0);
                if (x - scroller.scrollLeft() < 0)
                { // even with when not using scroll we need to calc with it for IE
                    return;
                }
                left = left + 'px';
                right = '';
                clasAdd = "tooltipleft";
                clasRem = "tooltipright";
            }
            else
            {
                if ($.browser.msie && $.browser.version == 7)
                {
                    usescroll = false;
                }
                else
                {
                    usescroll = true;
                }
                right = Math.abs(x - o.width) - (o.width - (usescroll ? scroller.scrollLeft() : 0) - scrollerW);
                if (Math.abs(x - o.width) - (o.width - scroller.scrollLeft() - scrollerW) < 0)
                { // even with when not using scroll we need to calc with it for IE
                    return;
                }
                left = '';
                right = right + 'px';
                clasAdd = "tooltipright";
                clasRem = "tooltipleft";
            }

            tooltip.addClass(clasAdd).removeClass(clasRem).html(o.tooltiphtml(data)).css(
            {
                display: 'block',
                top: y + 'px',
                left: left,
                right: right
            });
        });

        self.bind('vizualizeOut', function visualizeTooltipOut(e, data)
        {
            tooltip.css(
            {
                display: 'none'
            });
        });

    });
})(jQuery);

/*
 * File:        jquery.dataTables.min.js
 * Version:     1.8.2
 * Author:      Allan Jardine (www.sprymedia.co.uk)
 * Info:        www.datatables.net
 * 
 * Copyright 2008-2011 Allan Jardine, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, as supplied with this software.
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */ (function (i, za, p)
{
    i.fn.dataTableSettings = [];
    var D = i.fn.dataTableSettings;
    i.fn.dataTableExt = {};
    var n = i.fn.dataTableExt;
    n.sVersion = "1.8.2";
    n.sErrMode = "alert";
    n.iApiIndex = 0;
    n.oApi = {};
    n.afnFiltering = [];
    n.aoFeatures = [];
    n.ofnSearch = {};
    n.afnSortData = [];
    n.oStdClasses = {
        sPagePrevEnabled: "paginate_enabled_previous",
        sPagePrevDisabled: "paginate_disabled_previous",
        sPageNextEnabled: "paginate_enabled_next",
        sPageNextDisabled: "paginate_disabled_next",
        sPageJUINext: "",
        sPageJUIPrev: "",
        sPageButton: "paginate_button",
        sPageButtonActive: "paginate_active",
        sPageButtonStaticDisabled: "paginate_button paginate_button_disabled",
        sPageFirst: "first",
        sPagePrevious: "previous",
        sPageNext: "next",
        sPageLast: "last",
        sStripeOdd: "odd",
        sStripeEven: "even",
        sRowEmpty: "dataTables_empty",
        sWrapper: "dataTables_wrapper",
        sFilter: "dataTables_filter",
        sInfo: "dataTables_info",
        sPaging: "dataTables_paginate paging_",
        sLength: "dataTables_length",
        sProcessing: "dataTables_processing",
        sSortAsc: "sorting_asc",
        sSortDesc: "sorting_desc",
        sSortable: "sorting",
        sSortableAsc: "sorting_asc_disabled",
        sSortableDesc: "sorting_desc_disabled",
        sSortableNone: "sorting_disabled",
        sSortColumn: "sorting_",
        sSortJUIAsc: "",
        sSortJUIDesc: "",
        sSortJUI: "",
        sSortJUIAscAllowed: "",
        sSortJUIDescAllowed: "",
        sSortJUIWrapper: "",
        sSortIcon: "",
        sScrollWrapper: "dataTables_scroll",
        sScrollHead: "dataTables_scrollHead",
        sScrollHeadInner: "dataTables_scrollHeadInner",
        sScrollBody: "dataTables_scrollBody",
        sScrollFoot: "dataTables_scrollFoot",
        sScrollFootInner: "dataTables_scrollFootInner",
        sFooterTH: ""
    };
    n.oJUIClasses = {
        sPagePrevEnabled: "fg-button ui-button ui-state-default ui-corner-left",
        sPagePrevDisabled: "fg-button ui-button ui-state-default ui-corner-left ui-state-disabled",
        sPageNextEnabled: "fg-button ui-button ui-state-default ui-corner-right",
        sPageNextDisabled: "fg-button ui-button ui-state-default ui-corner-right ui-state-disabled",
        sPageJUINext: "ui-icon ui-icon-circle-arrow-e",
        sPageJUIPrev: "ui-icon ui-icon-circle-arrow-w",
        sPageButton: "fg-button ui-button ui-state-default",
        sPageButtonActive: "fg-button ui-button ui-state-default ui-state-disabled",
        sPageButtonStaticDisabled: "fg-button ui-button ui-state-default ui-state-disabled",
        sPageFirst: "first ui-corner-tl ui-corner-bl",
        sPagePrevious: "previous",
        sPageNext: "next",
        sPageLast: "last ui-corner-tr ui-corner-br",
        sStripeOdd: "odd",
        sStripeEven: "even",
        sRowEmpty: "dataTables_empty",
        sWrapper: "dataTables_wrapper",
        sFilter: "dataTables_filter",
        sInfo: "dataTables_info",
        sPaging: "dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",
        sLength: "dataTables_length",
        sProcessing: "dataTables_processing",
        sSortAsc: "ui-state-default",
        sSortDesc: "ui-state-default",
        sSortable: "ui-state-default",
        sSortableAsc: "ui-state-default",
        sSortableDesc: "ui-state-default",
        sSortableNone: "ui-state-default",
        sSortColumn: "sorting_",
        sSortJUIAsc: "css_right ui-icon ui-icon-triangle-1-n",
        sSortJUIDesc: "css_right ui-icon ui-icon-triangle-1-s",
        sSortJUI: "css_right ui-icon ui-icon-carat-2-n-s",
        sSortJUIAscAllowed: "css_right ui-icon ui-icon-carat-1-n",
        sSortJUIDescAllowed: "css_right ui-icon ui-icon-carat-1-s",
        sSortJUIWrapper: "DataTables_sort_wrapper",
        sSortIcon: "DataTables_sort_icon",
        sScrollWrapper: "dataTables_scroll",
        sScrollHead: "dataTables_scrollHead ui-state-default",
        sScrollHeadInner: "dataTables_scrollHeadInner",
        sScrollBody: "dataTables_scrollBody",
        sScrollFoot: "dataTables_scrollFoot ui-state-default",
        sScrollFootInner: "dataTables_scrollFootInner",
        sFooterTH: "ui-state-default"
    };
    n.oPagination = {
        two_button: {
            fnInit: function (g, l, s)
            {
                var t, w, y;
                if (g.bJUI)
                {
                    t = p.createElement("a");
                    w = p.createElement("a");
                    y = p.createElement("span");
                    y.className = g.oClasses.sPageJUINext;
                    w.appendChild(y);
                    y = p.createElement("span");
                    y.className = g.oClasses.sPageJUIPrev;
                    t.appendChild(y)
                }
                else
                {
                    t = p.createElement("div");
                    w = p.createElement("div")
                }
                t.className = g.oClasses.sPagePrevDisabled;
                w.className = g.oClasses.sPageNextDisabled;
                t.title = g.oLanguage.oPaginate.sPrevious;
                w.title = g.oLanguage.oPaginate.sNext;
                l.appendChild(t);
                l.appendChild(w);
                i(t).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "previous") && s(g)
                });
                i(w).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "next") && s(g)
                });
                i(t).bind("selectstart.DT", function ()
                {
                    return false
                });
                i(w).bind("selectstart.DT", function ()
                {
                    return false
                });
                if (g.sTableId !== "" && typeof g.aanFeatures.p == "undefined")
                {
                    l.setAttribute("id", g.sTableId + "_paginate");
                    t.setAttribute("id", g.sTableId + "_previous");
                    w.setAttribute("id", g.sTableId + "_next")
                }
            },
            fnUpdate: function (g)
            {
                if (g.aanFeatures.p) for (var l = g.aanFeatures.p, s = 0, t = l.length; s < t; s++) if (l[s].childNodes.length !== 0)
                {
                    l[s].childNodes[0].className = g._iDisplayStart === 0 ? g.oClasses.sPagePrevDisabled : g.oClasses.sPagePrevEnabled;
                    l[s].childNodes[1].className = g.fnDisplayEnd() == g.fnRecordsDisplay() ? g.oClasses.sPageNextDisabled : g.oClasses.sPageNextEnabled
                }
            }
        },
        iFullNumbersShowPages: 5,
        full_numbers: {
            fnInit: function (g, l, s)
            {
                var t = p.createElement("span"),
                    w = p.createElement("span"),
                    y = p.createElement("span"),
                    F = p.createElement("span"),
                    x = p.createElement("span");
                t.innerHTML = g.oLanguage.oPaginate.sFirst;
                w.innerHTML = g.oLanguage.oPaginate.sPrevious;
                F.innerHTML = g.oLanguage.oPaginate.sNext;
                x.innerHTML = g.oLanguage.oPaginate.sLast;
                var v = g.oClasses;
                t.className = v.sPageButton + " " + v.sPageFirst;
                w.className = v.sPageButton + " " + v.sPagePrevious;
                F.className = v.sPageButton + " " + v.sPageNext;
                x.className = v.sPageButton + " " + v.sPageLast;
                l.appendChild(t);
                l.appendChild(w);
                l.appendChild(y);
                l.appendChild(F);
                l.appendChild(x);
                i(t).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "first") && s(g)
                });
                i(w).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "previous") && s(g)
                });
                i(F).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "next") && s(g)
                });
                i(x).bind("click.DT", function ()
                {
                    g.oApi._fnPageChange(g, "last") && s(g)
                });
                i("span", l).bind("mousedown.DT", function ()
                {
                    return false
                }).bind("selectstart.DT", function ()
                {
                    return false
                });
                if (g.sTableId !== "" && typeof g.aanFeatures.p == "undefined")
                {
                    l.setAttribute("id", g.sTableId + "_paginate");
                    t.setAttribute("id", g.sTableId + "_first");
                    w.setAttribute("id", g.sTableId + "_previous");
                    F.setAttribute("id", g.sTableId + "_next");
                    x.setAttribute("id", g.sTableId + "_last")
                }
            },
            fnUpdate: function (g, l)
            {
                if (g.aanFeatures.p)
                {
                    var s = n.oPagination.iFullNumbersShowPages,
                        t = Math.floor(s / 2),
                        w = Math.ceil(g.fnRecordsDisplay() / g._iDisplayLength),
                        y = Math.ceil(g._iDisplayStart / g._iDisplayLength) + 1,
                        F = "",
                        x, v = g.oClasses;
                    if (w < s)
                    {
                        t = 1;
                        x = w
                    }
                    else if (y <= t)
                    {
                        t = 1;
                        x = s
                    }
                    else if (y >= w - t)
                    {
                        t = w - s + 1;
                        x = w
                    }
                    else
                    {
                        t = y - Math.ceil(s / 2) + 1;
                        x = t + s - 1
                    }
                    for (s = t; s <= x; s++) F += y != s ? '<span class="' + v.sPageButton + '">' + s + "</span>" : '<span class="' + v.sPageButtonActive + '">' + s + "</span>";
                    x = g.aanFeatures.p;
                    var z, $ = function (M)
                        {
                            g._iDisplayStart = (this.innerHTML * 1 - 1) * g._iDisplayLength;
                            l(g);
                            M.preventDefault()
                        },
                        X = function ()
                        {
                            return false
                        };
                    s = 0;
                    for (t = x.length; s < t; s++) if (x[s].childNodes.length !== 0)
                    {
                        z = i("span:eq(2)", x[s]);
                        z.html(F);
                        i("span", z).bind("click.DT", $).bind("mousedown.DT", X).bind("selectstart.DT", X);
                        z = x[s].getElementsByTagName("span");
                        z = [z[0], z[1], z[z.length - 2], z[z.length - 1]];
                        i(z).removeClass(v.sPageButton + " " + v.sPageButtonActive + " " + v.sPageButtonStaticDisabled);
                        if (y == 1)
                        {
                            z[0].className += " " + v.sPageButtonStaticDisabled;
                            z[1].className += " " + v.sPageButtonStaticDisabled
                        }
                        else
                        {
                            z[0].className += " " + v.sPageButton;
                            z[1].className += " " + v.sPageButton
                        }
                        if (w === 0 || y == w || g._iDisplayLength == -1)
                        {
                            z[2].className += " " + v.sPageButtonStaticDisabled;
                            z[3].className += " " + v.sPageButtonStaticDisabled
                        }
                        else
                        {
                            z[2].className += " " + v.sPageButton;
                            z[3].className += " " + v.sPageButton
                        }
                    }
                }
            }
        }
    };
    n.oSort = {
        "string-asc": function (g, l)
        {
            if (typeof g != "string") g = "";
            if (typeof l != "string") l = "";
            g = g.toLowerCase();
            l = l.toLowerCase();
            return g < l ? -1 : g > l ? 1 : 0
        },
        "string-desc": function (g, l)
        {
            if (typeof g != "string") g = "";
            if (typeof l != "string") l = "";
            g = g.toLowerCase();
            l = l.toLowerCase();
            return g < l ? 1 : g > l ? -1 : 0
        },
        "html-asc": function (g, l)
        {
            g = g.replace(/<.*?>/g, "").toLowerCase();
            l = l.replace(/<.*?>/g, "").toLowerCase();
            return g < l ? -1 : g > l ? 1 : 0
        },
        "html-desc": function (g, l)
        {
            g = g.replace(/<.*?>/g, "").toLowerCase();
            l = l.replace(/<.*?>/g, "").toLowerCase();
            return g < l ? 1 : g > l ? -1 : 0
        },
        "date-asc": function (g, l)
        {
            g = Date.parse(g);
            l = Date.parse(l);
            if (isNaN(g) || g === "") g = Date.parse("01/01/1970 00:00:00");
            if (isNaN(l) || l === "") l = Date.parse("01/01/1970 00:00:00");
            return g - l
        },
        "date-desc": function (g, l)
        {
            g = Date.parse(g);
            l = Date.parse(l);
            if (isNaN(g) || g === "") g = Date.parse("01/01/1970 00:00:00");
            if (isNaN(l) || l === "") l = Date.parse("01/01/1970 00:00:00");
            return l - g
        },
        "numeric-asc": function (g, l)
        {
            return (g == "-" || g === "" ? 0 : g * 1) - (l == "-" || l === "" ? 0 : l * 1)
        },
        "numeric-desc": function (g, l)
        {
            return (l == "-" || l === "" ? 0 : l * 1) - (g == "-" || g === "" ? 0 : g * 1)
        }
    };
    n.aTypes = [function (g)
    {
        if (typeof g == "number") return "numeric";
        else if (typeof g != "string") return null;
        var l, s = false;
        l = g.charAt(0);
        if ("0123456789-".indexOf(l) == -1) return null;
        for (var t = 1; t < g.length; t++)
        {
            l = g.charAt(t);
            if ("0123456789.".indexOf(l) == -1) return null;
            if (l == ".")
            {
                if (s) return null;
                s = true
            }
        }
        return "numeric"
    }, function (g)
    {
        var l = Date.parse(g);
        if (l !== null && !isNaN(l) || typeof g == "string" && g.length === 0) return "date";
        return null
    }, function (g)
    {
        if (typeof g == "string" && g.indexOf("<") != -1 && g.indexOf(">") != -1) return "html";
        return null
    }];
    n.fnVersionCheck = function (g)
    {
        var l = function (x, v)
            {
                for (; x.length < v;) x += "0";
                return x
            },
            s = n.sVersion.split(".");
        g = g.split(".");
        for (var t = "", w = "", y = 0, F = g.length; y < F; y++)
        {
            t += l(s[y], 3);
            w += l(g[y], 3)
        }
        return parseInt(t, 10) >= parseInt(w, 10)
    };
    n._oExternConfig = {
        iNextUnique: 0
    };
    i.fn.dataTable = function (g)
    {
        function l()
        {
            this.fnRecordsTotal = function ()
            {
                return this.oFeatures.bServerSide ? parseInt(this._iRecordsTotal, 10) : this.aiDisplayMaster.length
            };
            this.fnRecordsDisplay = function ()
            {
                return this.oFeatures.bServerSide ? parseInt(this._iRecordsDisplay, 10) : this.aiDisplay.length
            };
            this.fnDisplayEnd = function ()
            {
                return this.oFeatures.bServerSide ? this.oFeatures.bPaginate === false || this._iDisplayLength == -1 ? this._iDisplayStart + this.aiDisplay.length : Math.min(this._iDisplayStart + this._iDisplayLength, this._iRecordsDisplay) : this._iDisplayEnd
            };
            this.sInstance = this.oInstance = null;
            this.oFeatures = {
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bSort: true,
                bInfo: true,
                bAutoWidth: true,
                bProcessing: false,
                bSortClasses: true,
                bStateSave: false,
                bServerSide: false,
                bDeferRender: false
            };
            this.oScroll = {
                sX: "",
                sXInner: "",
                sY: "",
                bCollapse: false,
                bInfinite: false,
                iLoadGap: 100,
                iBarWidth: 0,
                bAutoCss: true
            };
            this.aanFeatures = [];
            this.oLanguage = {
                sProcessing: "Processing...",
                sLengthMenu: "Show _MENU_ entries",
                sZeroRecords: "No matching records found",
                sEmptyTable: "No data available in table",
                sLoadingRecords: "Loading...",
                sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
                sInfoEmpty: "Showing 0 to 0 of 0 entries",
                sInfoFiltered: "(filtered from _MAX_ total entries)",
                sInfoPostFix: "",
                sInfoThousands: ",",
                sSearch: "Search:",
                sUrl: "",
                oPaginate: {
                    sFirst: "First",
                    sPrevious: "Previous",
                    sNext: "Next",
                    sLast: "Last"
                },
                fnInfoCallback: null
            };
            this.aoData = [];
            this.aiDisplay = [];
            this.aiDisplayMaster = [];
            this.aoColumns = [];
            this.aoHeader = [];
            this.aoFooter = [];
            this.iNextId = 0;
            this.asDataSearch = [];
            this.oPreviousSearch = {
                sSearch: "",
                bRegex: false,
                bSmart: true
            };
            this.aoPreSearchCols = [];
            this.aaSorting = [
                [0, "asc", 0]
            ];
            this.aaSortingFixed = null;
            this.asStripeClasses = [];
            this.asDestroyStripes = [];
            this.sDestroyWidth = 0;
            this.fnFooterCallback = this.fnHeaderCallback = this.fnRowCallback = null;
            this.aoDrawCallback = [];
            this.fnInitComplete = this.fnPreDrawCallback = null;
            this.sTableId = "";
            this.nTableWrapper = this.nTBody = this.nTFoot = this.nTHead = this.nTable = null;
            this.bInitialised = this.bDeferLoading = false;
            this.aoOpenRows = [];
            this.sDom = "lfrtip";
            this.sPaginationType = "two_button";
            this.iCookieDuration = 7200;
            this.sCookiePrefix = "SpryMedia_DataTables_";
            this.fnCookieCallback = null;
            this.aoStateSave = [];
            this.aoStateLoad = [];
            this.sAjaxSource = this.oLoadedState = null;
            this.sAjaxDataProp = "aaData";
            this.bAjaxDataGet = true;
            this.jqXHR = null;
            this.fnServerData = function (a, b, c, d)
            {
                d.jqXHR = i.ajax(
                {
                    url: a,
                    data: b,
                    success: function (f)
                    {
                        i(d.oInstance).trigger("xhr", d);
                        c(f)
                    },
                    dataType: "json",
                    cache: false,
                    error: function (f, e)
                    {
                        e == "parsererror" && alert("DataTables warning: JSON data from server could not be parsed. This is caused by a JSON formatting error.")
                    }
                })
            };
            this.aoServerParams = [];
            this.fnFormatNumber = function (a)
            {
                if (a < 1E3) return a;
                else
                {
                    var b = a + "";
                    a = b.split("");
                    var c = "";
                    b = b.length;
                    for (var d = 0; d < b; d++)
                    {
                        if (d % 3 === 0 && d !== 0) c = this.oLanguage.sInfoThousands + c;
                        c = a[b - d - 1] + c
                    }
                }
                return c
            };
            this.aLengthMenu = [10, 25, 50, 100];
            this.bDrawing = this.iDraw = 0;
            this.iDrawError = -1;
            this._iDisplayLength = 10;
            this._iDisplayStart = 0;
            this._iDisplayEnd = 10;
            this._iRecordsDisplay = this._iRecordsTotal = 0;
            this.bJUI = false;
            this.oClasses = n.oStdClasses;
            this.bSortCellsTop = this.bSorted = this.bFiltered = false;
            this.oInit = null;
            this.aoDestroyCallback = []
        }
        function s(a)
        {
            return function ()
            {
                var b = [A(this[n.iApiIndex])].concat(Array.prototype.slice.call(arguments));
                return n.oApi[a].apply(this, b)
            }
        }
        function t(a)
        {
            var b, c, d = a.iInitDisplayStart;
            if (a.bInitialised === false) setTimeout(function ()
            {
                t(a)
            }, 200);
            else
            {
                Aa(a);
                X(a);
                M(a, a.aoHeader);
                a.nTFoot && M(a, a.aoFooter);
                K(a, true);
                a.oFeatures.bAutoWidth && ga(a);
                b = 0;
                for (c = a.aoColumns.length; b < c; b++) if (a.aoColumns[b].sWidth !== null) a.aoColumns[b].nTh.style.width = q(a.aoColumns[b].sWidth);
                if (a.oFeatures.bSort) R(a);
                else if (a.oFeatures.bFilter) N(a, a.oPreviousSearch);
                else
                {
                    a.aiDisplay = a.aiDisplayMaster.slice();
                    E(a);
                    C(a)
                }
                if (a.sAjaxSource !== null && !a.oFeatures.bServerSide)
                {
                    c = [];
                    ha(a, c);
                    a.fnServerData.call(a.oInstance, a.sAjaxSource, c, function (f)
                    {
                        var e = f;
                        if (a.sAjaxDataProp !== "") e = aa(a.sAjaxDataProp)(f);
                        for (b = 0; b < e.length; b++) v(a, e[b]);
                        a.iInitDisplayStart = d;
                        if (a.oFeatures.bSort) R(a);
                        else
                        {
                            a.aiDisplay = a.aiDisplayMaster.slice();
                            E(a);
                            C(a)
                        }
                        K(a, false);
                        w(a, f)
                    }, a)
                }
                else if (!a.oFeatures.bServerSide)
                {
                    K(a, false);
                    w(a)
                }
            }
        }
        function w(a, b)
        {
            a._bInitComplete = true;
            if (typeof a.fnInitComplete == "function") typeof b != "undefined" ? a.fnInitComplete.call(a.oInstance, a, b) : a.fnInitComplete.call(a.oInstance, a)
        }
        function y(a, b, c)
        {
            a.oLanguage = i.extend(true, a.oLanguage, b);
            typeof b.sEmptyTable == "undefined" && typeof b.sZeroRecords != "undefined" && o(a.oLanguage, b, "sZeroRecords", "sEmptyTable");
            typeof b.sLoadingRecords == "undefined" && typeof b.sZeroRecords != "undefined" && o(a.oLanguage, b, "sZeroRecords", "sLoadingRecords");
            c && t(a)
        }
        function F(a, b)
        {
            var c = a.aoColumns.length;
            b = {
                sType: null,
                _bAutoType: true,
                bVisible: true,
                bSearchable: true,
                bSortable: true,
                asSorting: ["asc", "desc"],
                sSortingClass: a.oClasses.sSortable,
                sSortingClassJUI: a.oClasses.sSortJUI,
                sTitle: b ? b.innerHTML : "",
                sName: "",
                sWidth: null,
                sWidthOrig: null,
                sClass: null,
                fnRender: null,
                bUseRendered: true,
                iDataSort: c,
                mDataProp: c,
                fnGetData: null,
                fnSetData: null,
                sSortDataType: "std",
                sDefaultContent: null,
                sContentPadding: "",
                nTh: b ? b : p.createElement("th"),
                nTf: null
            };
            a.aoColumns.push(b);
            if (typeof a.aoPreSearchCols[c] == "undefined" || a.aoPreSearchCols[c] === null) a.aoPreSearchCols[c] = {
                sSearch: "",
                bRegex: false,
                bSmart: true
            };
            else
            {
                if (typeof a.aoPreSearchCols[c].bRegex == "undefined") a.aoPreSearchCols[c].bRegex = true;
                if (typeof a.aoPreSearchCols[c].bSmart == "undefined") a.aoPreSearchCols[c].bSmart = true
            }
            x(a, c, null)
        }
        function x(a, b, c)
        {
            b = a.aoColumns[b];
            if (typeof c != "undefined" && c !== null)
            {
                if (typeof c.sType != "undefined")
                {
                    b.sType = c.sType;
                    b._bAutoType = false
                }
                o(b, c, "bVisible");
                o(b, c, "bSearchable");
                o(b, c, "bSortable");
                o(b, c, "sTitle");
                o(b, c, "sName");
                o(b, c, "sWidth");
                o(b, c, "sWidth", "sWidthOrig");
                o(b, c, "sClass");
                o(b, c, "fnRender");
                o(b, c, "bUseRendered");
                o(b, c, "iDataSort");
                o(b, c, "mDataProp");
                o(b, c, "asSorting");
                o(b, c, "sSortDataType");
                o(b, c, "sDefaultContent");
                o(b, c, "sContentPadding")
            }
            b.fnGetData = aa(b.mDataProp);
            b.fnSetData = Ba(b.mDataProp);
            if (!a.oFeatures.bSort) b.bSortable = false;
            if (!b.bSortable || i.inArray("asc", b.asSorting) == -1 && i.inArray("desc", b.asSorting) == -1)
            {
                b.sSortingClass = a.oClasses.sSortableNone;
                b.sSortingClassJUI = ""
            }
            else if (b.bSortable || i.inArray("asc", b.asSorting) == -1 && i.inArray("desc", b.asSorting) == -1)
            {
                b.sSortingClass = a.oClasses.sSortable;
                b.sSortingClassJUI = a.oClasses.sSortJUI
            }
            else if (i.inArray("asc", b.asSorting) != -1 && i.inArray("desc", b.asSorting) == -1)
            {
                b.sSortingClass = a.oClasses.sSortableAsc;
                b.sSortingClassJUI = a.oClasses.sSortJUIAscAllowed
            }
            else if (i.inArray("asc", b.asSorting) == -1 && i.inArray("desc", b.asSorting) != -1)
            {
                b.sSortingClass = a.oClasses.sSortableDesc;
                b.sSortingClassJUI = a.oClasses.sSortJUIDescAllowed
            }
        }
        function v(a, b)
        {
            var c;
            c = i.isArray(b) ? b.slice() : i.extend(true, {}, b);
            b = a.aoData.length;
            var d = {
                nTr: null,
                _iId: a.iNextId++,
                _aData: c,
                _anHidden: [],
                _sRowStripe: ""
            };
            a.aoData.push(d);
            for (var f, e = 0, h = a.aoColumns.length; e < h; e++)
            {
                c = a.aoColumns[e];
                typeof c.fnRender == "function" && c.bUseRendered && c.mDataProp !== null && O(a, b, e, c.fnRender(
                {
                    iDataRow: b,
                    iDataColumn: e,
                    aData: d._aData,
                    oSettings: a
                }));
                if (c._bAutoType && c.sType != "string")
                {
                    f = G(a, b, e, "type");
                    if (f !== null && f !== "")
                    {
                        f = ia(f);
                        if (c.sType === null) c.sType = f;
                        else if (c.sType != f && c.sType != "html") c.sType = "string"
                    }
                }
            }
            a.aiDisplayMaster.push(b);
            a.oFeatures.bDeferRender || z(a, b);
            return b
        }
        function z(a, b)
        {
            var c = a.aoData[b],
                d;
            if (c.nTr === null)
            {
                c.nTr = p.createElement("tr");
                typeof c._aData.DT_RowId != "undefined" && c.nTr.setAttribute("id", c._aData.DT_RowId);
                typeof c._aData.DT_RowClass != "undefined" && i(c.nTr).addClass(c._aData.DT_RowClass);
                for (var f = 0, e = a.aoColumns.length; f < e; f++)
                {
                    var h = a.aoColumns[f];
                    d = p.createElement("td");
                    d.innerHTML = typeof h.fnRender == "function" && (!h.bUseRendered || h.mDataProp === null) ? h.fnRender(
                    {
                        iDataRow: b,
                        iDataColumn: f,
                        aData: c._aData,
                        oSettings: a
                    }) : G(a, b, f, "display");
                    if (h.sClass !== null) d.className = h.sClass;
                    if (h.bVisible)
                    {
                        c.nTr.appendChild(d);
                        c._anHidden[f] = null
                    }
                    else c._anHidden[f] = d
                }
            }
        }
        function $(a)
        {
            var b, c, d, f, e, h, j, k, m;
            if (a.bDeferLoading || a.sAjaxSource === null)
            {
                j = a.nTBody.childNodes;
                b = 0;
                for (c = j.length; b < c; b++) if (j[b].nodeName.toUpperCase() == "TR")
                {
                    k = a.aoData.length;
                    a.aoData.push(
                    {
                        nTr: j[b],
                        _iId: a.iNextId++,
                        _aData: [],
                        _anHidden: [],
                        _sRowStripe: ""
                    });
                    a.aiDisplayMaster.push(k);
                    h = j[b].childNodes;
                    d = e = 0;
                    for (f = h.length; d < f; d++)
                    {
                        m = h[d].nodeName.toUpperCase();
                        if (m == "TD" || m == "TH")
                        {
                            O(a, k, e, i.trim(h[d].innerHTML));
                            e++
                        }
                    }
                }
            }
            j = ba(a);
            h = [];
            b = 0;
            for (c = j.length; b < c; b++)
            {
                d = 0;
                for (f = j[b].childNodes.length; d < f; d++)
                {
                    e = j[b].childNodes[d];
                    m = e.nodeName.toUpperCase();
                    if (m == "TD" || m == "TH") h.push(e)
                }
            }
            h.length != j.length * a.aoColumns.length && J(a, 1, "Unexpected number of TD elements. Expected " + j.length * a.aoColumns.length + " and got " + h.length + ". DataTables does not support rowspan / colspan in the table body, and there must be one cell for each row/column combination.");
            d = 0;
            for (f = a.aoColumns.length; d < f; d++)
            {
                if (a.aoColumns[d].sTitle === null) a.aoColumns[d].sTitle = a.aoColumns[d].nTh.innerHTML;
                j = a.aoColumns[d]._bAutoType;
                m = typeof a.aoColumns[d].fnRender == "function";
                e = a.aoColumns[d].sClass !== null;
                k = a.aoColumns[d].bVisible;
                var u, r;
                if (j || m || e || !k)
                {
                    b = 0;
                    for (c = a.aoData.length; b < c; b++)
                    {
                        u = h[b * f + d];
                        if (j && a.aoColumns[d].sType != "string")
                        {
                            r = G(a, b, d, "type");
                            if (r !== "")
                            {
                                r = ia(r);
                                if (a.aoColumns[d].sType === null) a.aoColumns[d].sType = r;
                                else if (a.aoColumns[d].sType != r && a.aoColumns[d].sType != "html") a.aoColumns[d].sType = "string"
                            }
                        }
                        if (m)
                        {
                            r = a.aoColumns[d].fnRender(
                            {
                                iDataRow: b,
                                iDataColumn: d,
                                aData: a.aoData[b]._aData,
                                oSettings: a
                            });
                            u.innerHTML = r;
                            a.aoColumns[d].bUseRendered && O(a, b, d, r)
                        }
                        if (e) u.className += " " + a.aoColumns[d].sClass;
                        if (k) a.aoData[b]._anHidden[d] = null;
                        else
                        {
                            a.aoData[b]._anHidden[d] = u;
                            u.parentNode.removeChild(u)
                        }
                    }
                }
            }
        }
        function X(a)
        {
            var b, c, d;
            a.nTHead.getElementsByTagName("tr");
            if (a.nTHead.getElementsByTagName("th").length !== 0)
            {
                b = 0;
                for (d = a.aoColumns.length; b < d; b++)
                {
                    c = a.aoColumns[b].nTh;
                    a.aoColumns[b].sClass !== null && i(c).addClass(a.aoColumns[b].sClass);
                    if (a.aoColumns[b].sTitle != c.innerHTML) c.innerHTML = a.aoColumns[b].sTitle
                }
            }
            else
            {
                var f = p.createElement("tr");
                b = 0;
                for (d = a.aoColumns.length; b < d; b++)
                {
                    c = a.aoColumns[b].nTh;
                    c.innerHTML = a.aoColumns[b].sTitle;
                    a.aoColumns[b].sClass !== null && i(c).addClass(a.aoColumns[b].sClass);
                    f.appendChild(c)
                }
                i(a.nTHead).html("")[0].appendChild(f);
                Y(a.aoHeader, a.nTHead)
            }
            if (a.bJUI)
            {
                b = 0;
                for (d = a.aoColumns.length; b < d; b++)
                {
                    c = a.aoColumns[b].nTh;
                    f = p.createElement("div");
                    f.className = a.oClasses.sSortJUIWrapper;
                    i(c).contents().appendTo(f);
                    var e = p.createElement("span");
                    e.className = a.oClasses.sSortIcon;
                    f.appendChild(e);
                    c.appendChild(f)
                }
            }
            d = function ()
            {
                this.onselectstart = function ()
                {
                    return false
                };
                return false
            };
            if (a.oFeatures.bSort) for (b = 0; b < a.aoColumns.length; b++) if (a.aoColumns[b].bSortable !== false)
            {
                ja(a, a.aoColumns[b].nTh, b);
                i(a.aoColumns[b].nTh).bind("mousedown.DT", d)
            }
            else i(a.aoColumns[b].nTh).addClass(a.oClasses.sSortableNone);
            a.oClasses.sFooterTH !== "" && i(a.nTFoot).children("tr").children("th").addClass(a.oClasses.sFooterTH);
            if (a.nTFoot !== null)
            {
                c = S(a, null, a.aoFooter);
                b = 0;
                for (d = a.aoColumns.length; b < d; b++) if (typeof c[b] != "undefined") a.aoColumns[b].nTf = c[b]
            }
        }
        function M(a, b, c)
        {
            var d, f, e, h = [],
                j = [],
                k = a.aoColumns.length;
            if (typeof c == "undefined") c = false;
            d = 0;
            for (f = b.length; d < f; d++)
            {
                h[d] = b[d].slice();
                h[d].nTr = b[d].nTr;
                for (e = k - 1; e >= 0; e--)!a.aoColumns[e].bVisible && !c && h[d].splice(e, 1);
                j.push([])
            }
            d = 0;
            for (f = h.length; d < f; d++)
            {
                if (h[d].nTr)
                {
                    a = 0;
                    for (e = h[d].nTr.childNodes.length; a < e; a++) h[d].nTr.removeChild(h[d].nTr.childNodes[0])
                }
                e = 0;
                for (b = h[d].length; e < b; e++)
                {
                    k = c = 1;
                    if (typeof j[d][e] == "undefined")
                    {
                        h[d].nTr.appendChild(h[d][e].cell);
                        for (j[d][e] = 1; typeof h[d + c] != "undefined" && h[d][e].cell == h[d + c][e].cell;)
                        {
                            j[d + c][e] = 1;
                            c++
                        }
                        for (; typeof h[d][e + k] != "undefined" && h[d][e].cell == h[d][e + k].cell;)
                        {
                            for (a = 0; a < c; a++) j[d + a][e + k] = 1;
                            k++
                        }
                        h[d][e].cell.rowSpan = c;
                        h[d][e].cell.colSpan = k
                    }
                }
            }
        }
        function C(a)
        {
            var b, c, d = [],
                f = 0,
                e = false;
            b = a.asStripeClasses.length;
            c = a.aoOpenRows.length;
            if (!(a.fnPreDrawCallback !== null && a.fnPreDrawCallback.call(a.oInstance, a) === false))
            {
                a.bDrawing = true;
                if (typeof a.iInitDisplayStart != "undefined" && a.iInitDisplayStart != -1)
                {
                    a._iDisplayStart = a.oFeatures.bServerSide ? a.iInitDisplayStart : a.iInitDisplayStart >= a.fnRecordsDisplay() ? 0 : a.iInitDisplayStart;
                    a.iInitDisplayStart = -1;
                    E(a)
                }
                if (a.bDeferLoading)
                {
                    a.bDeferLoading = false;
                    a.iDraw++
                }
                else if (a.oFeatures.bServerSide)
                {
                    if (!a.bDestroying && !Ca(a)) return
                }
                else a.iDraw++;
                if (a.aiDisplay.length !== 0)
                {
                    var h = a._iDisplayStart,
                        j = a._iDisplayEnd;
                    if (a.oFeatures.bServerSide)
                    {
                        h = 0;
                        j = a.aoData.length
                    }
                    for (h = h; h < j; h++)
                    {
                        var k = a.aoData[a.aiDisplay[h]];
                        k.nTr === null && z(a, a.aiDisplay[h]);
                        var m = k.nTr;
                        if (b !== 0)
                        {
                            var u = a.asStripeClasses[f % b];
                            if (k._sRowStripe != u)
                            {
                                i(m).removeClass(k._sRowStripe).addClass(u);
                                k._sRowStripe = u
                            }
                        }
                        if (typeof a.fnRowCallback == "function")
                        {
                            m = a.fnRowCallback.call(a.oInstance, m, a.aoData[a.aiDisplay[h]]._aData, f, h);
                            if (!m && !e)
                            {
                                J(a, 0, "A node was not returned by fnRowCallback");
                                e = true
                            }
                        }
                        d.push(m);
                        f++;
                        if (c !== 0) for (k = 0; k < c; k++) m == a.aoOpenRows[k].nParent && d.push(a.aoOpenRows[k].nTr)
                    }
                }
                else
                {
                    d[0] = p.createElement("tr");
                    if (typeof a.asStripeClasses[0] != "undefined") d[0].className = a.asStripeClasses[0];
                    e = a.oLanguage.sZeroRecords.replace("_MAX_", a.fnFormatNumber(a.fnRecordsTotal()));
                    if (a.iDraw == 1 && a.sAjaxSource !== null && !a.oFeatures.bServerSide) e = a.oLanguage.sLoadingRecords;
                    else if (typeof a.oLanguage.sEmptyTable != "undefined" && a.fnRecordsTotal() === 0) e = a.oLanguage.sEmptyTable;
                    b = p.createElement("td");
                    b.setAttribute("valign", "top");
                    b.colSpan = Z(a);
                    b.className = a.oClasses.sRowEmpty;
                    b.innerHTML = e;
                    d[f].appendChild(b)
                }
                typeof a.fnHeaderCallback == "function" && a.fnHeaderCallback.call(a.oInstance, i(a.nTHead).children("tr")[0], ca(a), a._iDisplayStart, a.fnDisplayEnd(), a.aiDisplay);
                typeof a.fnFooterCallback == "function" && a.fnFooterCallback.call(a.oInstance, i(a.nTFoot).children("tr")[0], ca(a), a._iDisplayStart, a.fnDisplayEnd(), a.aiDisplay);
                f = p.createDocumentFragment();
                b = p.createDocumentFragment();
                if (a.nTBody)
                {
                    e = a.nTBody.parentNode;
                    b.appendChild(a.nTBody);
                    if (!a.oScroll.bInfinite || !a._bInitComplete || a.bSorted || a.bFiltered)
                    {
                        c = a.nTBody.childNodes;
                        for (b = c.length - 1; b >= 0; b--) c[b].parentNode.removeChild(c[b])
                    }
                    b = 0;
                    for (c = d.length; b < c; b++) f.appendChild(d[b]);
                    a.nTBody.appendChild(f);
                    e !== null && e.appendChild(a.nTBody)
                }
                for (b = a.aoDrawCallback.length - 1; b >= 0; b--) a.aoDrawCallback[b].fn.call(a.oInstance, a);
                i(a.oInstance).trigger("draw", a);
                a.bSorted = false;
                a.bFiltered = false;
                a.bDrawing = false;
                if (a.oFeatures.bServerSide)
                {
                    K(a, false);
                    typeof a._bInitComplete == "undefined" && w(a)
                }
            }
        }
        function da(a)
        {
            if (a.oFeatures.bSort) R(a, a.oPreviousSearch);
            else if (a.oFeatures.bFilter) N(a, a.oPreviousSearch);
            else
            {
                E(a);
                C(a)
            }
        }
        function Ca(a)
        {
            if (a.bAjaxDataGet)
            {
                a.iDraw++;
                K(a, true);
                var b = Da(a);
                ha(a, b);
                a.fnServerData.call(a.oInstance, a.sAjaxSource, b, function (c)
                {
                    Ea(a, c)
                }, a);
                return false
            }
            else return true
        }
        function Da(a)
        {
            var b = a.aoColumns.length,
                c = [],
                d, f;
            c.push(
            {
                name: "sEcho",
                value: a.iDraw
            });
            c.push(
            {
                name: "iColumns",
                value: b
            });
            c.push(
            {
                name: "sColumns",
                value: ka(a)
            });
            c.push(
            {
                name: "iDisplayStart",
                value: a._iDisplayStart
            });
            c.push(
            {
                name: "iDisplayLength",
                value: a.oFeatures.bPaginate !== false ? a._iDisplayLength : -1
            });
            for (f = 0; f < b; f++)
            {
                d = a.aoColumns[f].mDataProp;
                c.push(
                {
                    name: "mDataProp_" + f,
                    value: typeof d == "function" ? "function" : d
                })
            }
            if (a.oFeatures.bFilter !== false)
            {
                c.push(
                {
                    name: "sSearch",
                    value: a.oPreviousSearch.sSearch
                });
                c.push(
                {
                    name: "bRegex",
                    value: a.oPreviousSearch.bRegex
                });
                for (f = 0; f < b; f++)
                {
                    c.push(
                    {
                        name: "sSearch_" + f,
                        value: a.aoPreSearchCols[f].sSearch
                    });
                    c.push(
                    {
                        name: "bRegex_" + f,
                        value: a.aoPreSearchCols[f].bRegex
                    });
                    c.push(
                    {
                        name: "bSearchable_" + f,
                        value: a.aoColumns[f].bSearchable
                    })
                }
            }
            if (a.oFeatures.bSort !== false)
            {
                d = a.aaSortingFixed !== null ? a.aaSortingFixed.length : 0;
                var e = a.aaSorting.length;
                c.push(
                {
                    name: "iSortingCols",
                    value: d + e
                });
                for (f = 0; f < d; f++)
                {
                    c.push(
                    {
                        name: "iSortCol_" + f,
                        value: a.aaSortingFixed[f][0]
                    });
                    c.push(
                    {
                        name: "sSortDir_" + f,
                        value: a.aaSortingFixed[f][1]
                    })
                }
                for (f = 0; f < e; f++)
                {
                    c.push(
                    {
                        name: "iSortCol_" + (f + d),
                        value: a.aaSorting[f][0]
                    });
                    c.push(
                    {
                        name: "sSortDir_" + (f + d),
                        value: a.aaSorting[f][1]
                    })
                }
                for (f = 0; f < b; f++) c.push(
                {
                    name: "bSortable_" + f,
                    value: a.aoColumns[f].bSortable
                })
            }
            return c
        }
        function ha(a, b)
        {
            for (var c = 0, d = a.aoServerParams.length; c < d; c++) a.aoServerParams[c].fn.call(a.oInstance, b)
        }
        function Ea(a, b)
        {
            if (typeof b.sEcho != "undefined") if (b.sEcho * 1 < a.iDraw) return;
            else a.iDraw = b.sEcho * 1;
            if (!a.oScroll.bInfinite || a.oScroll.bInfinite && (a.bSorted || a.bFiltered)) la(a);
            a._iRecordsTotal = b.iTotalRecords;
            a._iRecordsDisplay = b.iTotalDisplayRecords;
            var c = ka(a);
            if (c = typeof b.sColumns != "undefined" && c !== "" && b.sColumns != c) var d = Fa(a, b.sColumns);
            b = aa(a.sAjaxDataProp)(b);
            for (var f = 0, e = b.length; f < e; f++) if (c)
            {
                for (var h = [], j = 0, k = a.aoColumns.length; j < k; j++) h.push(b[f][d[j]]);
                v(a, h)
            }
            else v(a, b[f]);
            a.aiDisplay = a.aiDisplayMaster.slice();
            a.bAjaxDataGet = false;
            C(a);
            a.bAjaxDataGet = true;
            K(a, false)
        }
        function Aa(a)
        {
            var b = p.createElement("div");
            a.nTable.parentNode.insertBefore(b, a.nTable);
            a.nTableWrapper = p.createElement("div");
            a.nTableWrapper.className = a.oClasses.sWrapper;
            a.sTableId !== "" && a.nTableWrapper.setAttribute("id", a.sTableId + "_wrapper");
            a.nTableReinsertBefore = a.nTable.nextSibling;
            for (var c = a.nTableWrapper, d = a.sDom.split(""), f, e, h, j, k, m, u, r = 0; r < d.length; r++)
            {
                e = 0;
                h = d[r];
                if (h == "<")
                {
                    j = p.createElement("div");
                    k = d[r + 1];
                    if (k == "'" || k == '"')
                    {
                        m = "";
                        for (u = 2; d[r + u] != k;)
                        {
                            m += d[r + u];
                            u++
                        }
                        if (m == "H") m = "fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix";
                        else if (m == "F") m = "fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix";
                        if (m.indexOf(".") != -1)
                        {
                            k = m.split(".");
                            j.setAttribute("id", k[0].substr(1, k[0].length - 1));
                            j.className = k[1]
                        }
                        else if (m.charAt(0) == "#") j.setAttribute("id", m.substr(1, m.length - 1));
                        else j.className = m;
                        r += u
                    }
                    c.appendChild(j);
                    c = j
                }
                else if (h == ">") c = c.parentNode;
                else if (h == "l" && a.oFeatures.bPaginate && a.oFeatures.bLengthChange)
                {
                    f = Ga(a);
                    e = 1
                }
                else if (h == "f" && a.oFeatures.bFilter)
                {
                    f = Ha(a);
                    e = 1
                }
                else if (h == "r" && a.oFeatures.bProcessing)
                {
                    f = Ia(a);
                    e = 1
                }
                else if (h == "t")
                {
                    f = Ja(a);
                    e = 1
                }
                else if (h == "i" && a.oFeatures.bInfo)
                {
                    f = Ka(a);
                    e = 1
                }
                else if (h == "p" && a.oFeatures.bPaginate)
                {
                    f = La(a);
                    e = 1
                }
                else if (n.aoFeatures.length !== 0)
                {
                    j = n.aoFeatures;
                    u = 0;
                    for (k = j.length; u < k; u++) if (h == j[u].cFeature)
                    {
                        if (f = j[u].fnInit(a)) e = 1;
                        break
                    }
                }
                if (e == 1 && f !== null)
                {
                    if (typeof a.aanFeatures[h] != "object") a.aanFeatures[h] = [];
                    a.aanFeatures[h].push(f);
                    c.appendChild(f)
                }
            }
            b.parentNode.replaceChild(a.nTableWrapper, b)
        }
        function Ja(a)
        {
            if (a.oScroll.sX === "" && a.oScroll.sY === "") return a.nTable;
            var b = p.createElement("div"),
                c = p.createElement("div"),
                d = p.createElement("div"),
                f = p.createElement("div"),
                e = p.createElement("div"),
                h = p.createElement("div"),
                j = a.nTable.cloneNode(false),
                k = a.nTable.cloneNode(false),
                m = a.nTable.getElementsByTagName("thead")[0],
                u = a.nTable.getElementsByTagName("tfoot").length === 0 ? null : a.nTable.getElementsByTagName("tfoot")[0],
                r = typeof g.bJQueryUI != "undefined" && g.bJQueryUI ? n.oJUIClasses : n.oStdClasses;
            c.appendChild(d);
            e.appendChild(h);
            f.appendChild(a.nTable);
            b.appendChild(c);
            b.appendChild(f);
            d.appendChild(j);
            j.appendChild(m);
            if (u !== null)
            {
                b.appendChild(e);
                h.appendChild(k);
                k.appendChild(u)
            }
            b.className = r.sScrollWrapper;
            c.className = r.sScrollHead;
            d.className = r.sScrollHeadInner;
            f.className = r.sScrollBody;
            e.className = r.sScrollFoot;
            h.className = r.sScrollFootInner;
            if (a.oScroll.bAutoCss)
            {
                c.style.overflow = "hidden";
                c.style.position = "relative";
                e.style.overflow = "hidden";
                f.style.overflow = "auto"
            }
            c.style.border = "0";
            c.style.width = "100%";
            e.style.border = "0";
            d.style.width = "150%";
            j.removeAttribute("id");
            j.style.marginLeft = "0";
            a.nTable.style.marginLeft = "0";
            if (u !== null)
            {
                k.removeAttribute("id");
                k.style.marginLeft = "0"
            }
            d = i(a.nTable).children("caption");
            h = 0;
            for (k = d.length; h < k; h++) j.appendChild(d[h]);
            if (a.oScroll.sX !== "")
            {
                c.style.width = q(a.oScroll.sX);
                f.style.width = q(a.oScroll.sX);
                if (u !== null) e.style.width = q(a.oScroll.sX);
                i(f).scroll(function ()
                {
                    c.scrollLeft = this.scrollLeft;
                    if (u !== null) e.scrollLeft = this.scrollLeft
                })
            }
            if (a.oScroll.sY !== "") f.style.height = q(a.oScroll.sY);
            a.aoDrawCallback.push(
            {
                fn: Ma,
                sName: "scrolling"
            });
            a.oScroll.bInfinite && i(f).scroll(function ()
            {
                if (!a.bDrawing) if (i(this).scrollTop() + i(this).height() > i(a.nTable).height() - a.oScroll.iLoadGap) if (a.fnDisplayEnd() < a.fnRecordsDisplay())
                {
                    ma(a, "next");
                    E(a);
                    C(a)
                }
            });
            a.nScrollHead = c;
            a.nScrollFoot = e;
            return b
        }
        function Ma(a)
        {
            var b = a.nScrollHead.getElementsByTagName("div")[0],
                c = b.getElementsByTagName("table")[0],
                d = a.nTable.parentNode,
                f, e, h, j, k, m, u, r, H = [],
                L = a.nTFoot !== null ? a.nScrollFoot.getElementsByTagName("div")[0] : null,
                T = a.nTFoot !== null ? L.getElementsByTagName("table")[0] : null,
                B = i.browser.msie && i.browser.version <= 7;
            h = a.nTable.getElementsByTagName("thead");
            h.length > 0 && a.nTable.removeChild(h[0]);
            if (a.nTFoot !== null)
            {
                k = a.nTable.getElementsByTagName("tfoot");
                k.length > 0 && a.nTable.removeChild(k[0])
            }
            h = a.nTHead.cloneNode(true);
            a.nTable.insertBefore(h, a.nTable.childNodes[0]);
            if (a.nTFoot !== null)
            {
                k = a.nTFoot.cloneNode(true);
                a.nTable.insertBefore(k, a.nTable.childNodes[1])
            }
            if (a.oScroll.sX === "")
            {
                d.style.width = "100%";
                b.parentNode.style.width = "100%"
            }
            var U = S(a, h);
            f = 0;
            for (e = U.length; f < e; f++)
            {
                u = Na(a, f);
                U[f].style.width = a.aoColumns[u].sWidth
            }
            a.nTFoot !== null && P(function (I)
            {
                I.style.width = ""
            }, k.getElementsByTagName("tr"));
            f = i(a.nTable).outerWidth();
            if (a.oScroll.sX === "")
            {
                a.nTable.style.width = "100%";
                if (B && (d.scrollHeight > d.offsetHeight || i(d).css("overflow-y") == "scroll")) a.nTable.style.width = q(i(a.nTable).outerWidth() - a.oScroll.iBarWidth)
            }
            else if (a.oScroll.sXInner !== "") a.nTable.style.width = q(a.oScroll.sXInner);
            else if (f == i(d).width() && i(d).height() < i(a.nTable).height())
            {
                a.nTable.style.width = q(f - a.oScroll.iBarWidth);
                if (i(a.nTable).outerWidth() > f - a.oScroll.iBarWidth) a.nTable.style.width = q(f)
            }
            else a.nTable.style.width = q(f);
            f = i(a.nTable).outerWidth();
            e = a.nTHead.getElementsByTagName("tr");
            h = h.getElementsByTagName("tr");
            P(function (I, na)
            {
                m = I.style;
                m.paddingTop = "0";
                m.paddingBottom = "0";
                m.borderTopWidth = "0";
                m.borderBottomWidth = "0";
                m.height = 0;
                r = i(I).width();
                na.style.width = q(r);
                H.push(r)
            }, h, e);
            i(h).height(0);
            if (a.nTFoot !== null)
            {
                j = k.getElementsByTagName("tr");
                k = a.nTFoot.getElementsByTagName("tr");
                P(function (I, na)
                {
                    m = I.style;
                    m.paddingTop = "0";
                    m.paddingBottom = "0";
                    m.borderTopWidth = "0";
                    m.borderBottomWidth = "0";
                    m.height = 0;
                    r = i(I).width();
                    na.style.width = q(r);
                    H.push(r)
                }, j, k);
                i(j).height(0)
            }
            P(function (I)
            {
                I.innerHTML = "";
                I.style.width = q(H.shift())
            }, h);
            a.nTFoot !== null && P(function (I)
            {
                I.innerHTML = "";
                I.style.width = q(H.shift())
            }, j);
            if (i(a.nTable).outerWidth() < f)
            {
                j = d.scrollHeight > d.offsetHeight || i(d).css("overflow-y") == "scroll" ? f + a.oScroll.iBarWidth : f;
                if (B && (d.scrollHeight > d.offsetHeight || i(d).css("overflow-y") == "scroll")) a.nTable.style.width = q(j - a.oScroll.iBarWidth);
                d.style.width = q(j);
                b.parentNode.style.width = q(j);
                if (a.nTFoot !== null) L.parentNode.style.width = q(j);
                if (a.oScroll.sX === "") J(a, 1, "The table cannot fit into the current element which will cause column misalignment. The table has been drawn at its minimum possible width.");
                else a.oScroll.sXInner !== "" && J(a, 1, "The table cannot fit into the current element which will cause column misalignment. Increase the sScrollXInner value or remove it to allow automatic calculation")
            }
            else
            {
                d.style.width = q("100%");
                b.parentNode.style.width = q("100%");
                if (a.nTFoot !== null) L.parentNode.style.width = q("100%")
            }
            if (a.oScroll.sY === "") if (B) d.style.height = q(a.nTable.offsetHeight + a.oScroll.iBarWidth);
            if (a.oScroll.sY !== "" && a.oScroll.bCollapse)
            {
                d.style.height = q(a.oScroll.sY);
                B = a.oScroll.sX !== "" && a.nTable.offsetWidth > d.offsetWidth ? a.oScroll.iBarWidth : 0;
                if (a.nTable.offsetHeight < d.offsetHeight) d.style.height = q(i(a.nTable).height() + B)
            }
            B = i(a.nTable).outerWidth();
            c.style.width = q(B);
            b.style.width = q(B + a.oScroll.iBarWidth);
            if (a.nTFoot !== null)
            {
                L.style.width = q(a.nTable.offsetWidth + a.oScroll.iBarWidth);
                T.style.width = q(a.nTable.offsetWidth)
            }
            if (a.bSorted || a.bFiltered) d.scrollTop = 0
        }
        function ea(a)
        {
            if (a.oFeatures.bAutoWidth === false) return false;
            ga(a);
            for (var b = 0, c = a.aoColumns.length; b < c; b++) a.aoColumns[b].nTh.style.width = a.aoColumns[b].sWidth
        }
        function Ha(a)
        {
            var b = a.oLanguage.sSearch;
            b = b.indexOf("_INPUT_") !== -1 ? b.replace("_INPUT_", '<input type="text" />') : b === "" ? '<input type="text" />' : b + ' <input type="text" />';
            var c = p.createElement("div");
            c.className = a.oClasses.sFilter;
            c.innerHTML = "<label>" + b + "</label>";
            a.sTableId !== "" && typeof a.aanFeatures.f == "undefined" && c.setAttribute("id", a.sTableId + "_filter");
            b = i("input", c);
            b.val(a.oPreviousSearch.sSearch.replace('"', "&quot;"));
            b.bind("keyup.DT", function ()
            {
                for (var d = a.aanFeatures.f, f = 0, e = d.length; f < e; f++) d[f] != i(this).parents("div.dataTables_filter")[0] && i("input", d[f]).val(this.value);
                this.value != a.oPreviousSearch.sSearch && N(a, {
                    sSearch: this.value,
                    bRegex: a.oPreviousSearch.bRegex,
                    bSmart: a.oPreviousSearch.bSmart
                })
            });
            b.bind("keypress.DT", function (d)
            {
                if (d.keyCode == 13) return false
            });
            return c
        }
        
        function N(a, b, c)
        {
            Oa(a, b.sSearch, c, b.bRegex, b.bSmart);
            for (b = 0; b < a.aoPreSearchCols.length; b++) Pa(a, a.aoPreSearchCols[b].sSearch, b, a.aoPreSearchCols[b].bRegex, a.aoPreSearchCols[b].bSmart);
            n.afnFiltering.length !== 0 && Qa(a);
            a.bFiltered = true;
            i(a.oInstance).trigger("filter", a);
            a._iDisplayStart = 0;
            E(a);
            C(a);
            oa(a, 0)
        }
        function Qa(a)
        {
            for (var b = n.afnFiltering, c = 0, d = b.length; c < d; c++) for (var f = 0, e = 0, h = a.aiDisplay.length; e < h; e++)
            {
                var j = a.aiDisplay[e - f];
                if (!b[c](a, fa(a, j, "filter"), j))
                {
                    a.aiDisplay.splice(e - f, 1);
                    f++
                }
            }
        }
        function Pa(a, b, c, d, f)
        {
            if (b !== "")
            {
                var e = 0;
                b = pa(b, d, f);
                for (d = a.aiDisplay.length - 1; d >= 0; d--)
                {
                    f = qa(G(a, a.aiDisplay[d], c, "filter"), a.aoColumns[c].sType);
                    if (!b.test(f))
                    {
                        a.aiDisplay.splice(d, 1);
                        e++
                    }
                }
            }
        }
        function Oa(a, b, c, d, f)
        {
            var e = pa(b, d, f);
            if (typeof c == "undefined" || c === null) c = 0;
            if (n.afnFiltering.length !== 0) c = 1;
            if (b.length <= 0)
            {
                a.aiDisplay.splice(0, a.aiDisplay.length);
                a.aiDisplay = a.aiDisplayMaster.slice()
            }
            else if (a.aiDisplay.length == a.aiDisplayMaster.length || a.oPreviousSearch.sSearch.length > b.length || c == 1 || b.indexOf(a.oPreviousSearch.sSearch) !== 0)
            {
                a.aiDisplay.splice(0, a.aiDisplay.length);
                oa(a, 1);
                for (c = 0; c < a.aiDisplayMaster.length; c++) e.test(a.asDataSearch[c]) && a.aiDisplay.push(a.aiDisplayMaster[c])
            }
            else
            {
                var h = 0;
                for (c = 0; c < a.asDataSearch.length; c++) if (!e.test(a.asDataSearch[c]))
                {
                    a.aiDisplay.splice(c - h, 1);
                    h++
                }
            }
            a.oPreviousSearch.sSearch = b;
            a.oPreviousSearch.bRegex = d;
            a.oPreviousSearch.bSmart = f
        }
        function oa(a, b)
        {
            if (!a.oFeatures.bServerSide)
            {
                a.asDataSearch.splice(0, a.asDataSearch.length);
                b = typeof b != "undefined" && b == 1 ? a.aiDisplayMaster : a.aiDisplay;
                for (var c = 0, d = b.length; c < d; c++) a.asDataSearch[c] = ra(a, fa(a, b[c], "filter"))
            }
        }
        function ra(a, b)
        {
            var c = "";
            if (typeof a.__nTmpFilter == "undefined") a.__nTmpFilter = p.createElement("div");
            for (var d = a.__nTmpFilter, f = 0, e = a.aoColumns.length; f < e; f++) if (a.aoColumns[f].bSearchable) c += qa(b[f], a.aoColumns[f].sType) + "  ";
            if (c.indexOf("&") !== -1)
            {
                d.innerHTML = c;
                c = d.textContent ? d.textContent : d.innerText;
                c = c.replace(/\n/g, " ").replace(/\r/g, "")
            }
            return c
        }
        function pa(a, b, c)
        {
            if (c)
            {
                a = b ? a.split(" ") : sa(a).split(" ");
                a = "^(?=.*?" + a.join(")(?=.*?") + ").*$";
                return new RegExp(a, "i")
            }
            else
            {
                a = b ? a : sa(a);
                return new RegExp(a, "i")
            }
        }
        function qa(a, b)
        {
            if (typeof n.ofnSearch[b] == "function") return n.ofnSearch[b](a);
            else if (b == "html") return a.replace(/\n/g, " ").replace(/<.*?>/g, "");
            else if (typeof a == "string") return a.replace(/\n/g, " ");
            else if (a === null) return "";
            return a
        }
        function R(a, b)
        {
            var c, d, f, e, h = [],
                j = [],
                k = n.oSort;
            d = a.aoData;
            var m = a.aoColumns;
            if (!a.oFeatures.bServerSide && (a.aaSorting.length !== 0 || a.aaSortingFixed !== null))
            {
                h = a.aaSortingFixed !== null ? a.aaSortingFixed.concat(a.aaSorting) : a.aaSorting.slice();
                for (c = 0; c < h.length; c++)
                {
                    var u = h[c][0];
                    f = ta(a, u);
                    e = a.aoColumns[u].sSortDataType;
                    if (typeof n.afnSortData[e] != "undefined")
                    {
                        var r = n.afnSortData[e](a, u, f);
                        f = 0;
                        for (e = d.length; f < e; f++) O(a, f, u, r[f])
                    }
                }
                c = 0;
                for (d = a.aiDisplayMaster.length; c < d; c++) j[a.aiDisplayMaster[c]] = c;
                var H = h.length;
                a.aiDisplayMaster.sort(function (L, T)
                {
                    var B, U;
                    for (c = 0; c < H; c++)
                    {
                        B = m[h[c][0]].iDataSort;
                        U = m[B].sType;
                        B = k[(U ? U : "string") + "-" + h[c][1]](G(a, L, B, "sort"), G(a, T, B, "sort"));
                        if (B !== 0) return B
                    }
                    return k["numeric-asc"](j[L], j[T])
                })
            }
            if ((typeof b == "undefined" || b) && !a.oFeatures.bDeferRender) V(a);
            a.bSorted = true;
            i(a.oInstance).trigger("sort", a);
            if (a.oFeatures.bFilter) N(a, a.oPreviousSearch, 1);
            else
            {
                a.aiDisplay = a.aiDisplayMaster.slice();
                a._iDisplayStart = 0;
                E(a);
                C(a)
            }
        }
        function ja(a, b, c, d)
        {
            i(b).bind("click.DT", function (f)
            {
                if (a.aoColumns[c].bSortable !== false)
                {
                    var e = function ()
                        {
                            var h, j;
                            if (f.shiftKey)
                            {
                                for (var k = false, m = 0; m < a.aaSorting.length; m++) if (a.aaSorting[m][0] == c)
                                {
                                    k = true;
                                    h = a.aaSorting[m][0];
                                    j = a.aaSorting[m][2] + 1;
                                    if (typeof a.aoColumns[h].asSorting[j] == "undefined") a.aaSorting.splice(m, 1);
                                    else
                                    {
                                        a.aaSorting[m][1] = a.aoColumns[h].asSorting[j];
                                        a.aaSorting[m][2] = j
                                    }
                                    break
                                }
                                k === false && a.aaSorting.push([c, a.aoColumns[c].asSorting[0], 0])
                            }
                            else if (a.aaSorting.length == 1 && a.aaSorting[0][0] == c)
                            {
                                h = a.aaSorting[0][0];
                                j = a.aaSorting[0][2] + 1;
                                if (typeof a.aoColumns[h].asSorting[j] == "undefined") j = 0;
                                a.aaSorting[0][1] = a.aoColumns[h].asSorting[j];
                                a.aaSorting[0][2] = j
                            }
                            else
                            {
                                a.aaSorting.splice(0, a.aaSorting.length);
                                a.aaSorting.push([c, a.aoColumns[c].asSorting[0], 0])
                            }
                            R(a)
                        };
                    if (a.oFeatures.bProcessing)
                    {
                        K(a, true);
                        setTimeout(function ()
                        {
                            e();
                            a.oFeatures.bServerSide || K(a, false)
                        }, 0)
                    }
                    else e();
                    typeof d == "function" && d(a)
                }
            })
        }
        function V(a)
        {
            var b, c, d, f, e, h = a.aoColumns.length,
                j = a.oClasses;
            for (b = 0; b < h; b++) a.aoColumns[b].bSortable && i(a.aoColumns[b].nTh).removeClass(j.sSortAsc + " " + j.sSortDesc + " " + a.aoColumns[b].sSortingClass);
            f = a.aaSortingFixed !== null ? a.aaSortingFixed.concat(a.aaSorting) : a.aaSorting.slice();
            for (b = 0; b < a.aoColumns.length; b++) if (a.aoColumns[b].bSortable)
            {
                e = a.aoColumns[b].sSortingClass;
                d = -1;
                for (c = 0; c < f.length; c++) if (f[c][0] == b)
                {
                    e = f[c][1] == "asc" ? j.sSortAsc : j.sSortDesc;
                    d = c;
                    break
                }
                i(a.aoColumns[b].nTh).addClass(e);
                if (a.bJUI)
                {
                    c = i("span", a.aoColumns[b].nTh);
                    c.removeClass(j.sSortJUIAsc + " " + j.sSortJUIDesc + " " + j.sSortJUI + " " + j.sSortJUIAscAllowed + " " + j.sSortJUIDescAllowed);
                    c.addClass(d == -1 ? a.aoColumns[b].sSortingClassJUI : f[d][1] == "asc" ? j.sSortJUIAsc : j.sSortJUIDesc)
                }
            }
            else i(a.aoColumns[b].nTh).addClass(a.aoColumns[b].sSortingClass);
            e = j.sSortColumn;
            if (a.oFeatures.bSort && a.oFeatures.bSortClasses)
            {
                d = Q(a);
                if (a.oFeatures.bDeferRender) i(d).removeClass(e + "1 " + e + "2 " + e + "3");
                else if (d.length >= h) for (b = 0; b < h; b++) if (d[b].className.indexOf(e + "1") != -1)
                {
                    c = 0;
                    for (a = d.length / h; c < a; c++) d[h * c + b].className = i.trim(d[h * c + b].className.replace(e + "1", ""))
                }
                else if (d[b].className.indexOf(e + "2") != -1)
                {
                    c = 0;
                    for (a = d.length / h; c < a; c++) d[h * c + b].className = i.trim(d[h * c + b].className.replace(e + "2", ""))
                }
                else if (d[b].className.indexOf(e + "3") != -1)
                {
                    c = 0;
                    for (a = d.length / h; c < a; c++) d[h * c + b].className = i.trim(d[h * c + b].className.replace(" " + e + "3", ""))
                }
                j = 1;
                var k;
                for (b = 0; b < f.length; b++)
                {
                    k = parseInt(f[b][0], 10);
                    c = 0;
                    for (a = d.length / h; c < a; c++) d[h * c + k].className += " " + e + j;
                    j < 3 && j++
                }
            }
        }
        function La(a)
        {
            if (a.oScroll.bInfinite) return null;
            var b = p.createElement("div");
            b.className = a.oClasses.sPaging + a.sPaginationType;
            n.oPagination[a.sPaginationType].fnInit(a, b, function (c)
            {
                E(c);
                C(c)
            });
            typeof a.aanFeatures.p == "undefined" && a.aoDrawCallback.push(
            {
                fn: function (c)
                {
                    n.oPagination[c.sPaginationType].fnUpdate(c, function (d)
                    {
                        E(d);
                        C(d)
                    })
                },
                sName: "pagination"
            });
            return b
        }
        function ma(a, b)
        {
            var c = a._iDisplayStart;
            if (b == "first") a._iDisplayStart = 0;
            else if (b == "previous")
            {
                a._iDisplayStart = a._iDisplayLength >= 0 ? a._iDisplayStart - a._iDisplayLength : 0;
                if (a._iDisplayStart < 0) a._iDisplayStart = 0
            }
            else if (b == "next") if (a._iDisplayLength >= 0)
            {
                if (a._iDisplayStart + a._iDisplayLength < a.fnRecordsDisplay()) a._iDisplayStart += a._iDisplayLength
            }
            else a._iDisplayStart = 0;
            else if (b == "last") if (a._iDisplayLength >= 0)
            {
                b = parseInt((a.fnRecordsDisplay() - 1) / a._iDisplayLength, 10) + 1;
                a._iDisplayStart = (b - 1) * a._iDisplayLength
            }
            else a._iDisplayStart = 0;
            else J(a, 0, "Unknown paging action: " + b);
            i(a.oInstance).trigger("page", a);
            return c != a._iDisplayStart
        }
        function Ka(a)
        {
            var b = p.createElement("div");
            b.className = a.oClasses.sInfo;
            if (typeof a.aanFeatures.i == "undefined")
            {
                a.aoDrawCallback.push(
                {
                    fn: Ra,
                    sName: "information"
                });
                a.sTableId !== "" && b.setAttribute("id", a.sTableId + "_info")
            }
            return b
        }
        function Ra(a)
        {
            if (!(!a.oFeatures.bInfo || a.aanFeatures.i.length === 0))
            {
                var b = a._iDisplayStart + 1,
                    c = a.fnDisplayEnd(),
                    d = a.fnRecordsTotal(),
                    f = a.fnRecordsDisplay(),
                    e = a.fnFormatNumber(b),
                    h = a.fnFormatNumber(c),
                    j = a.fnFormatNumber(d),
                    k = a.fnFormatNumber(f);
                if (a.oScroll.bInfinite) e = a.fnFormatNumber(1);
                e = a.fnRecordsDisplay() === 0 && a.fnRecordsDisplay() == a.fnRecordsTotal() ? a.oLanguage.sInfoEmpty + a.oLanguage.sInfoPostFix : a.fnRecordsDisplay() === 0 ? a.oLanguage.sInfoEmpty + " " + a.oLanguage.sInfoFiltered.replace("_MAX_", j) + a.oLanguage.sInfoPostFix : a.fnRecordsDisplay() == a.fnRecordsTotal() ? a.oLanguage.sInfo.replace("_START_", e).replace("_END_", h).replace("_TOTAL_", k) + a.oLanguage.sInfoPostFix : a.oLanguage.sInfo.replace("_START_", e).replace("_END_", h).replace("_TOTAL_", k) + " " + a.oLanguage.sInfoFiltered.replace("_MAX_", a.fnFormatNumber(a.fnRecordsTotal())) + a.oLanguage.sInfoPostFix;
                if (a.oLanguage.fnInfoCallback !== null) e = a.oLanguage.fnInfoCallback(a, b, c, d, f, e);
                a = a.aanFeatures.i;
                b = 0;
                for (c = a.length; b < c; b++) i(a[b]).html(e)
            }
        }
        function Ga(a)
        {
            if (a.oScroll.bInfinite) return null;
            var b = '<select size="1" ' + (a.sTableId === "" ? "" : 'name="' + a.sTableId + '_length"') + ">",
                c, d;
            if (a.aLengthMenu.length == 2 && typeof a.aLengthMenu[0] == "object" && typeof a.aLengthMenu[1] == "object")
            {
                c = 0;
                for (d = a.aLengthMenu[0].length; c < d; c++) b += '<option value="' + a.aLengthMenu[0][c] + '">' + a.aLengthMenu[1][c] + "</option>"
            }
            else
            {
                c = 0;
                for (d = a.aLengthMenu.length; c < d; c++) b += '<option value="' + a.aLengthMenu[c] + '">' + a.aLengthMenu[c] + "</option>"
            }
            b += "</select>";
            var f = p.createElement("div");
            a.sTableId !== "" && typeof a.aanFeatures.l == "undefined" && f.setAttribute("id", a.sTableId + "_length");
            f.className = a.oClasses.sLength;
            f.innerHTML = "<label>" + a.oLanguage.sLengthMenu.replace("_MENU_", b) + "</label>";
            i('select option[value="' + a._iDisplayLength + '"]', f).attr("selected", true);
            i("select", f).bind("change.DT", function ()
            {
                var e = i(this).val(),
                    h = a.aanFeatures.l;
                c = 0;
                for (d = h.length; c < d; c++) h[c] != this.parentNode && i("select", h[c]).val(e);
                a._iDisplayLength = parseInt(e, 10);
                E(a);
                if (a.fnDisplayEnd() == a.fnRecordsDisplay())
                {
                    a._iDisplayStart = a.fnDisplayEnd() - a._iDisplayLength;
                    if (a._iDisplayStart < 0) a._iDisplayStart = 0
                }
                if (a._iDisplayLength == -1) a._iDisplayStart = 0;
                C(a)
            });
            return f
        }
        function Ia(a)
        {
            var b = p.createElement("div");
            a.sTableId !== "" && typeof a.aanFeatures.r == "undefined" && b.setAttribute("id", a.sTableId + "_processing");
            b.innerHTML = a.oLanguage.sProcessing;
            b.className = a.oClasses.sProcessing;
            a.nTable.parentNode.insertBefore(b, a.nTable);
            return b
        }
        function K(a, b)
        {
            if (a.oFeatures.bProcessing)
            {
                a = a.aanFeatures.r;
                for (var c = 0, d = a.length; c < d; c++) a[c].style.visibility = b ? "visible" : "hidden"
            }
        }
        function Na(a, b)
        {
            for (var c = -1, d = 0; d < a.aoColumns.length; d++)
            {
                a.aoColumns[d].bVisible === true && c++;
                if (c == b) return d
            }
            return null
        }
        function ta(a, b)
        {
            for (var c = -1, d = 0; d < a.aoColumns.length; d++)
            {
                a.aoColumns[d].bVisible === true && c++;
                if (d == b) return a.aoColumns[d].bVisible === true ? c : null
            }
            return null
        }
        function W(a, b)
        {
            var c, d;
            c = a._iDisplayStart;
            for (d = a._iDisplayEnd; c < d; c++) if (a.aoData[a.aiDisplay[c]].nTr == b) return a.aiDisplay[c];
            c = 0;
            for (d = a.aoData.length; c < d; c++) if (a.aoData[c].nTr == b) return c;
            return null
        }
        function Z(a)
        {
            for (var b = 0, c = 0; c < a.aoColumns.length; c++) a.aoColumns[c].bVisible === true && b++;
            return b
        }
        function E(a)
        {
            a._iDisplayEnd = a.oFeatures.bPaginate === false ? a.aiDisplay.length : a._iDisplayStart + a._iDisplayLength > a.aiDisplay.length || a._iDisplayLength == -1 ? a.aiDisplay.length : a._iDisplayStart + a._iDisplayLength
        }
        function Sa(a, b)
        {
            if (!a || a === null || a === "") return 0;
            if (typeof b == "undefined") b = p.getElementsByTagName("body")[0];
            var c = p.createElement("div");
            c.style.width = q(a);
            b.appendChild(c);
            a = c.offsetWidth;
            b.removeChild(c);
            return a
        }
        function ga(a)
        {
            var b = 0,
                c, d = 0,
                f = a.aoColumns.length,
                e, h = i("th", a.nTHead);
            for (e = 0; e < f; e++) if (a.aoColumns[e].bVisible)
            {
                d++;
                if (a.aoColumns[e].sWidth !== null)
                {
                    c = Sa(a.aoColumns[e].sWidthOrig, a.nTable.parentNode);
                    if (c !== null) a.aoColumns[e].sWidth = q(c);
                    b++
                }
            }
            if (f == h.length && b === 0 && d == f && a.oScroll.sX === "" && a.oScroll.sY === "") for (e = 0; e < a.aoColumns.length; e++)
            {
                c = i(h[e]).width();
                if (c !== null) a.aoColumns[e].sWidth = q(c)
            }
            else
            {
                b = a.nTable.cloneNode(false);
                e = a.nTHead.cloneNode(true);
                d = p.createElement("tbody");
                c = p.createElement("tr");
                b.removeAttribute("id");
                b.appendChild(e);
                if (a.nTFoot !== null)
                {
                    b.appendChild(a.nTFoot.cloneNode(true));
                    P(function (k)
                    {
                        k.style.width = ""
                    }, b.getElementsByTagName("tr"))
                }
                b.appendChild(d);
                d.appendChild(c);
                d = i("thead th", b);
                if (d.length === 0) d = i("tbody tr:eq(0)>td", b);
                h = S(a, e);
                for (e = d = 0; e < f; e++)
                {
                    var j = a.aoColumns[e];
                    if (j.bVisible && j.sWidthOrig !== null && j.sWidthOrig !== "") h[e - d].style.width = q(j.sWidthOrig);
                    else if (j.bVisible) h[e - d].style.width = "";
                    else d++
                }
                for (e = 0; e < f; e++) if (a.aoColumns[e].bVisible)
                {
                    d = Ta(a, e);
                    if (d !== null)
                    {
                        d = d.cloneNode(true);
                        if (a.aoColumns[e].sContentPadding !== "") d.innerHTML += a.aoColumns[e].sContentPadding;
                        c.appendChild(d)
                    }
                }
                f = a.nTable.parentNode;
                f.appendChild(b);
                if (a.oScroll.sX !== "" && a.oScroll.sXInner !== "") b.style.width = q(a.oScroll.sXInner);
                else if (a.oScroll.sX !== "")
                {
                    b.style.width = "";
                    if (i(b).width() < f.offsetWidth) b.style.width = q(f.offsetWidth)
                }
                else if (a.oScroll.sY !== "") b.style.width = q(f.offsetWidth);
                b.style.visibility = "hidden";
                Ua(a, b);
                f = i("tbody tr:eq(0)", b).children();
                if (f.length === 0) f = S(a, i("thead", b)[0]);
                if (a.oScroll.sX !== "")
                {
                    for (e = d = c = 0; e < a.aoColumns.length; e++) if (a.aoColumns[e].bVisible)
                    {
                        c += a.aoColumns[e].sWidthOrig === null ? i(f[d]).outerWidth() : parseInt(a.aoColumns[e].sWidth.replace("px", ""), 10) + (i(f[d]).outerWidth() - i(f[d]).width());
                        d++
                    }
                    b.style.width = q(c);
                    a.nTable.style.width = q(c)
                }
                for (e = d = 0; e < a.aoColumns.length; e++) if (a.aoColumns[e].bVisible)
                {
                    c = i(f[d]).width();
                    if (c !== null && c > 0) a.aoColumns[e].sWidth = q(c);
                    d++
                }
                a.nTable.style.width = q(i(b).outerWidth());
                b.parentNode.removeChild(b)
            }
        }
        function Ua(a, b)
        {
            if (a.oScroll.sX === "" && a.oScroll.sY !== "")
            {
                i(b).width();
                b.style.width = q(i(b).outerWidth() - a.oScroll.iBarWidth)
            }
            else if (a.oScroll.sX !== "") b.style.width = q(i(b).outerWidth())
        }
        function Ta(a, b)
        {
            var c = Va(a, b);
            if (c < 0) return null;
            if (a.aoData[c].nTr === null)
            {
                var d = p.createElement("td");
                d.innerHTML = G(a, c, b, "");
                return d
            }
            return Q(a, c)[b]
        }
        function Va(a, b)
        {
            for (var c = -1, d = -1, f = 0; f < a.aoData.length; f++)
            {
                var e = G(a, f, b, "display") + "";
                e = e.replace(/<.*?>/g, "");
                if (e.length > c)
                {
                    c = e.length;
                    d = f
                }
            }
            return d
        }
        function q(a)
        {
            if (a === null) return "0px";
            if (typeof a == "number")
            {
                if (a < 0) return "0px";
                return a + "px"
            }
            var b = a.charCodeAt(a.length - 1);
            if (b < 48 || b > 57) return a;
            return a + "px"
        }
        function Za(a, b)
        {
            if (a.length != b.length) return 1;
            for (var c = 0; c < a.length; c++) if (a[c] != b[c]) return 2;
            return 0
        }
        function ia(a)
        {
            for (var b = n.aTypes, c = b.length, d = 0; d < c; d++)
            {
                var f = b[d](a);
                if (f !== null) return f
            }
            return "string"
        }
        function A(a)
        {
            for (var b = 0; b < D.length; b++) if (D[b].nTable == a) return D[b];
            return null
        }
        function ca(a)
        {
            for (var b = [], c = a.aoData.length, d = 0; d < c; d++) b.push(a.aoData[d]._aData);
            return b
        }
        function ba(a)
        {
            for (var b = [], c = 0, d = a.aoData.length; c < d; c++) a.aoData[c].nTr !== null && b.push(a.aoData[c].nTr);
            return b
        }
        function Q(a, b)
        {
            var c = [],
                d, f, e, h, j;
            f = 0;
            var k = a.aoData.length;
            if (typeof b != "undefined")
            {
                f = b;
                k = b + 1
            }
            for (f = f; f < k; f++)
            {
                j = a.aoData[f];
                if (j.nTr !== null)
                {
                    b = [];
                    e = 0;
                    for (h = j.nTr.childNodes.length; e < h; e++)
                    {
                        d = j.nTr.childNodes[e].nodeName.toLowerCase();
                        if (d == "td" || d == "th") b.push(j.nTr.childNodes[e])
                    }
                    e = d = 0;
                    for (h = a.aoColumns.length; e < h; e++) if (a.aoColumns[e].bVisible) c.push(b[e - d]);
                    else
                    {
                        c.push(j._anHidden[e]);
                        d++
                    }
                }
            }
            return c
        }
        function sa(a)
        {
            return a.replace(new RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^)", "g"), "\\$1")
        }
        function ua(a, b)
        {
            for (var c = -1, d = 0, f = a.length; d < f; d++) if (a[d] == b) c = d;
            else a[d] > b && a[d]--;
            c != -1 && a.splice(c, 1)
        }
        function Fa(a, b)
        {
            b = b.split(",");
            for (var c = [], d = 0, f = a.aoColumns.length; d < f; d++) for (var e = 0; e < f; e++) if (a.aoColumns[d].sName == b[e])
            {
                c.push(e);
                break
            }
            return c
        }
        function ka(a)
        {
            for (var b = "", c = 0, d = a.aoColumns.length; c < d; c++) b += a.aoColumns[c].sName + ",";
            if (b.length == d) return "";
            return b.slice(0, -1)
        }
        function J(a, b, c)
        {
            a = a.sTableId === "" ? "DataTables warning: " + c : "DataTables warning (table id = '" + a.sTableId + "'): " + c;
            if (b === 0) if (n.sErrMode == "alert") alert(a);
            else throw a;
            else typeof console != "undefined" && typeof console.log != "undefined" && console.log(a)
        }
        function la(a)
        {
            a.aoData.splice(0, a.aoData.length);
            a.aiDisplayMaster.splice(0, a.aiDisplayMaster.length);
            a.aiDisplay.splice(0, a.aiDisplay.length);
            E(a)
        }
        function va(a)
        {
            if (!(!a.oFeatures.bStateSave || typeof a.bDestroying != "undefined"))
            {
                var b, c, d, f = "{";
                f += '"iCreate":' + (new Date).getTime() + ",";
                f += '"iStart":' + (a.oScroll.bInfinite ? 0 : a._iDisplayStart) + ",";
                f += '"iEnd":' + (a.oScroll.bInfinite ? a._iDisplayLength : a._iDisplayEnd) + ",";
                f += '"iLength":' + a._iDisplayLength + ",";
                f += '"sFilter":"' + encodeURIComponent(a.oPreviousSearch.sSearch) + '",';
                f += '"sFilterEsc":' + !a.oPreviousSearch.bRegex + ",";
                f += '"aaSorting":[ ';
                for (b = 0; b < a.aaSorting.length; b++) f += "[" + a.aaSorting[b][0] + ',"' + a.aaSorting[b][1] + '"],';
                f = f.substring(0, f.length - 1);
                f += "],";
                f += '"aaSearchCols":[ ';
                for (b = 0; b < a.aoPreSearchCols.length; b++) f += '["' + encodeURIComponent(a.aoPreSearchCols[b].sSearch) + '",' + !a.aoPreSearchCols[b].bRegex + "],";
                f = f.substring(0, f.length - 1);
                f += "],";
                f += '"abVisCols":[ ';
                for (b = 0; b < a.aoColumns.length; b++) f += a.aoColumns[b].bVisible + ",";
                f = f.substring(0, f.length - 1);
                f += "]";
                b = 0;
                for (c = a.aoStateSave.length; b < c; b++)
                {
                    d = a.aoStateSave[b].fn(a, f);
                    if (d !== "") f = d
                }
                f += "}";
                Wa(a.sCookiePrefix + a.sInstance, f, a.iCookieDuration, a.sCookiePrefix, a.fnCookieCallback)
            }
        }
        function Xa(a, b)
        {
            if (a.oFeatures.bStateSave)
            {
                var c, d, f;
                d = wa(a.sCookiePrefix + a.sInstance);
                if (d !== null && d !== "")
                {
                    try
                    {
                        c = typeof i.parseJSON == "function" ? i.parseJSON(d.replace(/'/g, '"')) : eval("(" + d + ")")
                    }
                    catch (e)
                    {
                        return
                    }
                    d = 0;
                    for (f = a.aoStateLoad.length; d < f; d++) if (!a.aoStateLoad[d].fn(a, c)) return;
                    a.oLoadedState = i.extend(true, {}, c);
                    a._iDisplayStart = c.iStart;
                    a.iInitDisplayStart = c.iStart;
                    a._iDisplayEnd = c.iEnd;
                    a._iDisplayLength = c.iLength;
                    a.oPreviousSearch.sSearch = decodeURIComponent(c.sFilter);
                    a.aaSorting = c.aaSorting.slice();
                    a.saved_aaSorting = c.aaSorting.slice();
                    if (typeof c.sFilterEsc != "undefined") a.oPreviousSearch.bRegex = !c.sFilterEsc;
                    if (typeof c.aaSearchCols != "undefined") for (d = 0; d < c.aaSearchCols.length; d++) a.aoPreSearchCols[d] = {
                        sSearch: decodeURIComponent(c.aaSearchCols[d][0]),
                        bRegex: !c.aaSearchCols[d][1]
                    };
                    if (typeof c.abVisCols != "undefined")
                    {
                        b.saved_aoColumns = [];
                        for (d = 0; d < c.abVisCols.length; d++)
                        {
                            b.saved_aoColumns[d] = {};
                            b.saved_aoColumns[d].bVisible = c.abVisCols[d]
                        }
                    }
                }
            }
        }
        function Wa(a, b, c, d, f)
        {
            var e = new Date;
            e.setTime(e.getTime() + c * 1E3);
            c = za.location.pathname.split("/");
            a = a + "_" + c.pop().replace(/[\/:]/g, "").toLowerCase();
            var h;
            if (f !== null)
            {
                h = typeof i.parseJSON == "function" ? i.parseJSON(b) : eval("(" + b + ")");
                b = f(a, h, e.toGMTString(), c.join("/") + "/")
            }
            else b = a + "=" + encodeURIComponent(b) + "; expires=" + e.toGMTString() + "; path=" + c.join("/") + "/";
            f = "";
            e = 9999999999999;
            if ((wa(a) !== null ? p.cookie.length : b.length + p.cookie.length) + 10 > 4096)
            {
                a = p.cookie.split(";");
                for (var j = 0, k = a.length; j < k; j++) if (a[j].indexOf(d) != -1)
                {
                    var m = a[j].split("=");
                    try
                    {
                        h = eval("(" + decodeURIComponent(m[1]) + ")")
                    }
                    catch (u)
                    {
                        continue
                    }
                    if (typeof h.iCreate != "undefined" && h.iCreate < e)
                    {
                        f = m[0];
                        e = h.iCreate
                    }
                }
                if (f !== "") p.cookie = f + "=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=" + c.join("/") + "/"
            }
            p.cookie = b
        }
        function wa(a)
        {
            var b = za.location.pathname.split("/");
            a = a + "_" + b[b.length - 1].replace(/[\/:]/g, "").toLowerCase() + "=";
            b = p.cookie.split(";");
            for (var c = 0; c < b.length; c++)
            {
                for (var d = b[c]; d.charAt(0) == " ";) d = d.substring(1, d.length);
                if (d.indexOf(a) === 0) return decodeURIComponent(d.substring(a.length, d.length))
            }
            return null
        }
        function Y(a, b)
        {
            b = i(b).children("tr");
            var c, d, f, e, h, j, k, m, u = function (L, T, B)
                {
                    for (; typeof L[T][B] != "undefined";) B++;
                    return B
                };
            a.splice(0, a.length);
            d = 0;
            for (j = b.length; d < j; d++) a.push([]);
            d = 0;
            for (j = b.length; d < j; d++)
            {
                f = 0;
                for (k = b[d].childNodes.length; f < k; f++)
                {
                    c = b[d].childNodes[f];
                    if (c.nodeName.toUpperCase() == "TD" || c.nodeName.toUpperCase() == "TH")
                    {
                        var r = c.getAttribute("colspan") * 1,
                            H = c.getAttribute("rowspan") * 1;
                        r = !r || r === 0 || r === 1 ? 1 : r;
                        H = !H || H === 0 || H === 1 ? 1 : H;
                        m = u(a, d, 0);
                        for (h = 0; h < r; h++) for (e = 0; e < H; e++)
                        {
                            a[d + e][m + h] = {
                                cell: c,
                                unique: r == 1 ? true : false
                            };
                            a[d + e].nTr = b[d]
                        }
                    }
                }
            }
        }
        function S(a, b, c)
        {
            var d = [];
            if (typeof c == "undefined")
            {
                c = a.aoHeader;
                if (typeof b != "undefined")
                {
                    c = [];
                    Y(c, b)
                }
            }
            b = 0;
            for (var f = c.length; b < f; b++) for (var e = 0, h = c[b].length; e < h; e++) if (c[b][e].unique && (typeof d[e] == "undefined" || !a.bSortCellsTop)) d[e] = c[b][e].cell;
            return d
        }
        function Ya()
        {
            var a = p.createElement("p"),
                b = a.style;
            b.width = "100%";
            b.height = "200px";
            b.padding = "0px";
            var c = p.createElement("div");
            b = c.style;
            b.position = "absolute";
            b.top = "0px";
            b.left = "0px";
            b.visibility = "hidden";
            b.width = "200px";
            b.height = "150px";
            b.padding = "0px";
            b.overflow = "hidden";
            c.appendChild(a);
            p.body.appendChild(c);
            b = a.offsetWidth;
            c.style.overflow = "scroll";
            a = a.offsetWidth;
            if (b == a) a = c.clientWidth;
            p.body.removeChild(c);
            return b - a
        }
        function P(a, b, c)
        {
            for (var d = 0, f = b.length; d < f; d++) for (var e = 0, h = b[d].childNodes.length; e < h; e++) if (b[d].childNodes[e].nodeType == 1) typeof c != "undefined" ? a(b[d].childNodes[e], c[d].childNodes[e]) : a(b[d].childNodes[e])
        }
        function o(a, b, c, d)
        {
            if (typeof d == "undefined") d = c;
            if (typeof b[c] != "undefined") a[d] = b[c]
        }
        function fa(a, b, c)
        {
            for (var d = [], f = 0, e = a.aoColumns.length; f < e; f++) d.push(G(a, b, f, c));
            return d
        }
        function G(a, b, c, d)
        {
            var f = a.aoColumns[c];
            if ((c = f.fnGetData(a.aoData[b]._aData)) === undefined)
            {
                if (a.iDrawError != a.iDraw && f.sDefaultContent === null)
                {
                    J(a, 0, "Requested unknown parameter '" + f.mDataProp + "' from the data source for row " + b);
                    a.iDrawError = a.iDraw
                }
                return f.sDefaultContent
            }
            if (c === null && f.sDefaultContent !== null) c = f.sDefaultContent;
            else if (typeof c == "function") return c();
            if (d == "display" && c === null) return "";
            return c
        }
        function O(a, b, c, d)
        {
            a.aoColumns[c].fnSetData(a.aoData[b]._aData, d)
        }
        function aa(a)
        {
            if (a === null) return function ()
            {
                return null
            };
            else if (typeof a == "function") return function (c)
            {
                return a(c)
            };
            else if (typeof a == "string" && a.indexOf(".") != -1)
            {
                var b = a.split(".");
                return b.length == 2 ?
                function (c)
                {
                    return c[b[0]][b[1]]
                } : b.length == 3 ?
                function (c)
                {
                    return c[b[0]][b[1]][b[2]]
                } : function (c)
                {
                    for (var d = 0, f = b.length; d < f; d++) c = c[b[d]];
                    return c
                }
            }
            else return function (c)
            {
                return c[a]
            }
        }
        function Ba(a)
        {
            if (a === null) return function ()
            {};
            else if (typeof a == "function") return function (c, d)
            {
                return a(c, d)
            };
            else if (typeof a == "string" && a.indexOf(".") != -1)
            {
                var b = a.split(".");
                return b.length == 2 ?
                function (c, d)
                {
                    c[b[0]][b[1]] = d
                } : b.length == 3 ?
                function (c, d)
                {
                    c[b[0]][b[1]][b[2]] = d
                } : function (c, d)
                {
                    for (var f = 0, e = b.length - 1; f < e; f++) c = c[b[f]];
                    c[b[b.length - 1]] = d
                }
            }
            else return function (c, d)
            {
                c[a] = d
            }
        }
        this.oApi = {};
        this.fnDraw = function (a)
        {
            var b = A(this[n.iApiIndex]);
            if (typeof a != "undefined" && a === false)
            {
                E(b);
                C(b)
            }
            else da(b)
        };
        this.fnFilter = function (a, b, c, d, f)
        {
            var e = A(this[n.iApiIndex]);
            if (e.oFeatures.bFilter)
            {
                if (typeof c == "undefined") c = false;
                if (typeof d == "undefined") d = true;
                if (typeof f == "undefined") f = true;
                if (typeof b == "undefined" || b === null)
                {
                    N(e, {
                        sSearch: a,
                        bRegex: c,
                        bSmart: d
                    }, 1);
                    if (f && typeof e.aanFeatures.f != "undefined")
                    {
                        b = e.aanFeatures.f;
                        c = 0;
                        for (d = b.length; c < d; c++) i("input", b[c]).val(a)
                    }
                }
                else
                {
                    e.aoPreSearchCols[b].sSearch = a;
                    e.aoPreSearchCols[b].bRegex = c;
                    e.aoPreSearchCols[b].bSmart = d;
                    N(e, e.oPreviousSearch, 1)
                }
            }
        };
        this.fnSettings = function ()
        {
            return A(this[n.iApiIndex])
        };
        this.fnVersionCheck = n.fnVersionCheck;
        this.fnSort = function (a)
        {
            var b = A(this[n.iApiIndex]);
            b.aaSorting = a;
            R(b)
        };
        this.fnSortListener = function (a, b, c)
        {
            ja(A(this[n.iApiIndex]), a, b, c)
        };
        this.fnAddData = function (a, b)
        {
            if (a.length === 0) return [];
            var c = [],
                d, f = A(this[n.iApiIndex]);
            if (typeof a[0] == "object") for (var e = 0; e < a.length; e++)
            {
                d = v(f, a[e]);
                if (d == -1) return c;
                c.push(d)
            }
            else
            {
                d = v(f, a);
                if (d == -1) return c;
                c.push(d)
            }
            f.aiDisplay = f.aiDisplayMaster.slice();
            if (typeof b == "undefined" || b) da(f);
            return c
        };
        this.fnDeleteRow = function (a, b, c)
        {
            var d = A(this[n.iApiIndex]);
            a = typeof a == "object" ? W(d, a) : a;
            var f = d.aoData.splice(a, 1),
                e = i.inArray(a, d.aiDisplay);
            d.asDataSearch.splice(e, 1);
            ua(d.aiDisplayMaster, a);
            ua(d.aiDisplay, a);
            typeof b == "function" && b.call(this, d, f);
            if (d._iDisplayStart >= d.aiDisplay.length)
            {
                d._iDisplayStart -= d._iDisplayLength;
                if (d._iDisplayStart < 0) d._iDisplayStart = 0
            }
            if (typeof c == "undefined" || c)
            {
                E(d);
                C(d)
            }
            return f
        };
        this.fnClearTable = function (a)
        {
            var b = A(this[n.iApiIndex]);
            la(b);
            if (typeof a == "undefined" || a) C(b)
        };
        this.fnOpen = function (a, b, c)
        {
            var d = A(this[n.iApiIndex]);
            this.fnClose(a);
            var f = p.createElement("tr"),
                e = p.createElement("td");
            f.appendChild(e);
            e.className = c;
            e.colSpan = Z(d);
            if (typeof b.jquery != "undefined" || typeof b == "object") e.appendChild(b);
            else e.innerHTML = b;
            b = i("tr", d.nTBody);
            i.inArray(a, b) != -1 && i(f).insertAfter(a);
            d.aoOpenRows.push(
            {
                nTr: f,
                nParent: a
            });
            return f
        };
        this.fnClose = function (a)
        {
            for (var b = A(this[n.iApiIndex]), c = 0; c < b.aoOpenRows.length; c++) if (b.aoOpenRows[c].nParent == a)
            {
                (a = b.aoOpenRows[c].nTr.parentNode) && a.removeChild(b.aoOpenRows[c].nTr);
                b.aoOpenRows.splice(c, 1);
                return 0
            }
            return 1
        };
        this.fnGetData = function (a, b)
        {
            var c = A(this[n.iApiIndex]);
            if (typeof a != "undefined")
            {
                a = typeof a == "object" ? W(c, a) : a;
                if (typeof b != "undefined") return G(c, a, b, "");
                return typeof c.aoData[a] != "undefined" ? c.aoData[a]._aData : null
            }
            return ca(c)
        };
        this.fnGetNodes = function (a)
        {
            var b = A(this[n.iApiIndex]);
            if (typeof a != "undefined") return typeof b.aoData[a] != "undefined" ? b.aoData[a].nTr : null;
            return ba(b)
        };
        this.fnGetPosition = function (a)
        {
            var b = A(this[n.iApiIndex]),
                c = a.nodeName.toUpperCase();
            if (c == "TR") return W(b, a);
            else if (c == "TD" || c == "TH")
            {
                c = W(b, a.parentNode);
                for (var d = Q(b, c), f = 0; f < b.aoColumns.length; f++) if (d[f] == a) return [c, ta(b, f), f]
            }
            return null
        };
        this.fnUpdate = function (a, b, c, d, f)
        {
            var e = A(this[n.iApiIndex]);
            b = typeof b == "object" ? W(e, b) : b;
            if (i.isArray(a) && typeof a == "object")
            {
                e.aoData[b]._aData = a.slice();
                for (c = 0; c < e.aoColumns.length; c++) this.fnUpdate(G(e, b, c), b, c, false, false)
            }
            else if (a !== null && typeof a == "object")
            {
                e.aoData[b]._aData = i.extend(true, {}, a);
                for (c = 0; c < e.aoColumns.length; c++) this.fnUpdate(G(e, b, c), b, c, false, false)
            }
            else
            {
                a = a;
                O(e, b, c, a);
                if (e.aoColumns[c].fnRender !== null)
                {
                    a = e.aoColumns[c].fnRender(
                    {
                        iDataRow: b,
                        iDataColumn: c,
                        aData: e.aoData[b]._aData,
                        oSettings: e
                    });
                    e.aoColumns[c].bUseRendered && O(e, b, c, a)
                }
                if (e.aoData[b].nTr !== null) Q(e, b)[c].innerHTML = a
            }
            c = i.inArray(b, e.aiDisplay);
            e.asDataSearch[c] = ra(e, fa(e, b, "filter"));
            if (typeof f == "undefined" || f) ea(e);
            if (typeof d == "undefined" || d) da(e);
            return 0
        };
        this.fnSetColumnVis = function (a, b, c)
        {
            var d = A(this[n.iApiIndex]),
                f, e;
            e = d.aoColumns.length;
            var h, j;
            if (d.aoColumns[a].bVisible != b)
            {
                if (b)
                {
                    for (f = j = 0; f < a; f++) d.aoColumns[f].bVisible && j++;
                    j = j >= Z(d);
                    if (!j) for (f = a; f < e; f++) if (d.aoColumns[f].bVisible)
                    {
                        h = f;
                        break
                    }
                    f = 0;
                    for (e = d.aoData.length; f < e; f++) if (d.aoData[f].nTr !== null) j ? d.aoData[f].nTr.appendChild(d.aoData[f]._anHidden[a]) : d.aoData[f].nTr.insertBefore(d.aoData[f]._anHidden[a], Q(d, f)[h])
                }
                else
                {
                    f = 0;
                    for (e = d.aoData.length; f < e; f++) if (d.aoData[f].nTr !== null)
                    {
                        h = Q(d, f)[a];
                        d.aoData[f]._anHidden[a] = h;
                        h.parentNode.removeChild(h)
                    }
                }
                d.aoColumns[a].bVisible = b;
                M(d, d.aoHeader);
                d.nTFoot && M(d, d.aoFooter);
                f = 0;
                for (e = d.aoOpenRows.length; f < e; f++) d.aoOpenRows[f].nTr.colSpan = Z(d);
                if (typeof c == "undefined" || c)
                {
                    ea(d);
                    C(d)
                }
                va(d)
            }
        };
        this.fnPageChange = function (a, b)
        {
            var c = A(this[n.iApiIndex]);
            ma(c, a);
            E(c);
            if (typeof b == "undefined" || b) C(c)
        };
        this.fnDestroy = function ()
        {
            var a = A(this[n.iApiIndex]),
                b = a.nTableWrapper.parentNode,
                c = a.nTBody,
                d, f;
            a.bDestroying = true;
            d = 0;
            for (f = a.aoDestroyCallback.length; d < f; d++) a.aoDestroyCallback[d].fn();
            d = 0;
            for (f = a.aoColumns.length; d < f; d++) a.aoColumns[d].bVisible === false && this.fnSetColumnVis(d, true);
            i(a.nTableWrapper).find("*").andSelf().unbind(".DT");
            i("tbody>tr>td." + a.oClasses.sRowEmpty, a.nTable).parent().remove();
            if (a.nTable != a.nTHead.parentNode)
            {
                i(a.nTable).children("thead").remove();
                a.nTable.appendChild(a.nTHead)
            }
            if (a.nTFoot && a.nTable != a.nTFoot.parentNode)
            {
                i(a.nTable).children("tfoot").remove();
                a.nTable.appendChild(a.nTFoot)
            }
            a.nTable.parentNode.removeChild(a.nTable);
            i(a.nTableWrapper).remove();
            a.aaSorting = [];
            a.aaSortingFixed = [];
            V(a);
            i(ba(a)).removeClass(a.asStripeClasses.join(" "));
            if (a.bJUI)
            {
                i("th", a.nTHead).removeClass([n.oStdClasses.sSortable, n.oJUIClasses.sSortableAsc, n.oJUIClasses.sSortableDesc, n.oJUIClasses.sSortableNone].join(" "));
                i("th span." + n.oJUIClasses.sSortIcon, a.nTHead).remove();
                i("th", a.nTHead).each(function ()
                {
                    var e = i("div." + n.oJUIClasses.sSortJUIWrapper, this),
                        h = e.contents();
                    i(this).append(h);
                    e.remove()
                })
            }
            else i("th", a.nTHead).removeClass([n.oStdClasses.sSortable, n.oStdClasses.sSortableAsc, n.oStdClasses.sSortableDesc, n.oStdClasses.sSortableNone].join(" "));
            a.nTableReinsertBefore ? b.insertBefore(a.nTable, a.nTableReinsertBefore) : b.appendChild(a.nTable);
            d = 0;
            for (f = a.aoData.length; d < f; d++) a.aoData[d].nTr !== null && c.appendChild(a.aoData[d].nTr);
            if (a.oFeatures.bAutoWidth === true) a.nTable.style.width = q(a.sDestroyWidth);
            i(c).children("tr:even").addClass(a.asDestroyStripes[0]);
            i(c).children("tr:odd").addClass(a.asDestroyStripes[1]);
            d = 0;
            for (f = D.length; d < f; d++) D[d] == a && D.splice(d, 1);
            a = null
        };
        this.fnAdjustColumnSizing = function (a)
        {
            var b = A(this[n.iApiIndex]);
            ea(b);
            if (typeof a == "undefined" || a) this.fnDraw(false);
            else if (b.oScroll.sX !== "" || b.oScroll.sY !== "") this.oApi._fnScrollDraw(b)
        };
        for (var xa in n.oApi) if (xa) this[xa] = s(xa);
        this.oApi._fnExternApiFunc = s;
        this.oApi._fnInitialise = t;
        this.oApi._fnInitComplete = w;
        this.oApi._fnLanguageProcess = y;
        this.oApi._fnAddColumn = F;
        this.oApi._fnColumnOptions = x;
        this.oApi._fnAddData = v;
        this.oApi._fnCreateTr = z;
        this.oApi._fnGatherData = $;
        this.oApi._fnBuildHead = X;
        this.oApi._fnDrawHead = M;
        this.oApi._fnDraw = C;
        this.oApi._fnReDraw = da;
        this.oApi._fnAjaxUpdate = Ca;
        this.oApi._fnAjaxParameters = Da;
        this.oApi._fnAjaxUpdateDraw = Ea;
        this.oApi._fnServerParams = ha;
        this.oApi._fnAddOptionsHtml = Aa;
        this.oApi._fnFeatureHtmlTable = Ja;
        this.oApi._fnScrollDraw = Ma;
        this.oApi._fnAdjustColumnSizing = ea;
        this.oApi._fnFeatureHtmlFilter = Ha;
        this.oApi._fnFilterComplete = N;
        this.oApi._fnFilterCustom = Qa;
        this.oApi._fnFilterColumn = Pa;
        this.oApi._fnFilter = Oa;
        this.oApi._fnBuildSearchArray = oa;
        this.oApi._fnBuildSearchRow = ra;
        this.oApi._fnFilterCreateSearch = pa;
        this.oApi._fnDataToSearch = qa;
        this.oApi._fnSort = R;
        this.oApi._fnSortAttachListener = ja;
        this.oApi._fnSortingClasses = V;
        this.oApi._fnFeatureHtmlPaginate = La;
        this.oApi._fnPageChange = ma;
        this.oApi._fnFeatureHtmlInfo = Ka;
        this.oApi._fnUpdateInfo = Ra;
        this.oApi._fnFeatureHtmlLength = Ga;
        this.oApi._fnFeatureHtmlProcessing = Ia;
        this.oApi._fnProcessingDisplay = K;
        this.oApi._fnVisibleToColumnIndex = Na;
        this.oApi._fnColumnIndexToVisible = ta;
        this.oApi._fnNodeToDataIndex = W;
        this.oApi._fnVisbleColumns = Z;
        this.oApi._fnCalculateEnd = E;
        this.oApi._fnConvertToWidth = Sa;
        this.oApi._fnCalculateColumnWidths = ga;
        this.oApi._fnScrollingWidthAdjust = Ua;
        this.oApi._fnGetWidestNode = Ta;
        this.oApi._fnGetMaxLenString = Va;
        this.oApi._fnStringToCss = q;
        this.oApi._fnArrayCmp = Za;
        this.oApi._fnDetectType = ia;
        this.oApi._fnSettingsFromNode = A;
        this.oApi._fnGetDataMaster = ca;
        this.oApi._fnGetTrNodes = ba;
        this.oApi._fnGetTdNodes = Q;
        this.oApi._fnEscapeRegex = sa;
        this.oApi._fnDeleteIndex = ua;
        this.oApi._fnReOrderIndex = Fa;
        this.oApi._fnColumnOrdering = ka;
        this.oApi._fnLog = J;
        this.oApi._fnClearTable = la;
        this.oApi._fnSaveState = va;
        this.oApi._fnLoadState = Xa;
        this.oApi._fnCreateCookie = Wa;
        this.oApi._fnReadCookie = wa;
        this.oApi._fnDetectHeader = Y;
        this.oApi._fnGetUniqueThs = S;
        this.oApi._fnScrollBarWidth = Ya;
        this.oApi._fnApplyToChildren = P;
        this.oApi._fnMap = o;
        this.oApi._fnGetRowData = fa;
        this.oApi._fnGetCellData = G;
        this.oApi._fnSetCellData = O;
        this.oApi._fnGetObjectDataFn = aa;
        this.oApi._fnSetObjectDataFn = Ba;
        var ya = this;
        return this.each(function ()
        {
            var a = 0,
                b, c, d, f;
            a = 0;
            for (b = D.length; a < b; a++)
            {
                if (D[a].nTable == this) if (typeof g == "undefined" || typeof g.bRetrieve != "undefined" && g.bRetrieve === true) return D[a].oInstance;
                else if (typeof g.bDestroy != "undefined" && g.bDestroy === true)
                {
                    D[a].oInstance.fnDestroy();
                    break
                }
                else
                {
                    J(D[a], 0, "Cannot reinitialise DataTable.\n\nTo retrieve the DataTables object for this table, please pass either no arguments to the dataTable() function, or set bRetrieve to true. Alternatively, to destory the old table and create a new one, set bDestroy to true (note that a lot of changes to the configuration can be made through the API which is usually much faster).");
                    return
                }
                if (D[a].sTableId !== "" && D[a].sTableId == this.getAttribute("id"))
                {
                    D.splice(a, 1);
                    break
                }
            }
            var e = new l;
            D.push(e);
            var h = false,
                j = false;
            a = this.getAttribute("id");
            if (a !== null)
            {
                e.sTableId = a;
                e.sInstance = a
            }
            else e.sInstance = n._oExternConfig.iNextUnique++;
            if (this.nodeName.toLowerCase() != "table") J(e, 0, "Attempted to initialise DataTables on a node which is not a table: " + this.nodeName);
            else
            {
                e.nTable = this;
                e.oInstance = ya.length == 1 ? ya : i(this).dataTable();
                e.oApi = ya.oApi;
                e.sDestroyWidth = i(this).width();
                if (typeof g != "undefined" && g !== null)
                {
                    e.oInit = g;
                    o(e.oFeatures, g, "bPaginate");
                    o(e.oFeatures, g, "bLengthChange");
                    o(e.oFeatures, g, "bFilter");
                    o(e.oFeatures, g, "bSort");
                    o(e.oFeatures, g, "bInfo");
                    o(e.oFeatures, g, "bProcessing");
                    o(e.oFeatures, g, "bAutoWidth");
                    o(e.oFeatures, g, "bSortClasses");
                    o(e.oFeatures, g, "bServerSide");
                    o(e.oFeatures, g, "bDeferRender");
                    o(e.oScroll, g, "sScrollX", "sX");
                    o(e.oScroll, g, "sScrollXInner", "sXInner");
                    o(e.oScroll, g, "sScrollY", "sY");
                    o(e.oScroll, g, "bScrollCollapse", "bCollapse");
                    o(e.oScroll, g, "bScrollInfinite", "bInfinite");
                    o(e.oScroll, g, "iScrollLoadGap", "iLoadGap");
                    o(e.oScroll, g, "bScrollAutoCss", "bAutoCss");
                    o(e, g, "asStripClasses", "asStripeClasses");
                    o(e, g, "asStripeClasses");
                    o(e, g, "fnPreDrawCallback");
                    o(e, g, "fnRowCallback");
                    o(e, g, "fnHeaderCallback");
                    o(e, g, "fnFooterCallback");
                    o(e, g, "fnCookieCallback");
                    o(e, g, "fnInitComplete");
                    o(e, g, "fnServerData");
                    o(e, g, "fnFormatNumber");
                    o(e, g, "aaSorting");
                    o(e, g, "aaSortingFixed");
                    o(e, g, "aLengthMenu");
                    o(e, g, "sPaginationType");
                    o(e, g, "sAjaxSource");
                    o(e, g, "sAjaxDataProp");
                    o(e, g, "iCookieDuration");
                    o(e, g, "sCookiePrefix");
                    o(e, g, "sDom");
                    o(e, g, "bSortCellsTop");
                    o(e, g, "oSearch", "oPreviousSearch");
                    o(e, g, "aoSearchCols", "aoPreSearchCols");
                    o(e, g, "iDisplayLength", "_iDisplayLength");
                    o(e, g, "bJQueryUI", "bJUI");
                    o(e.oLanguage, g, "fnInfoCallback");
                    typeof g.fnDrawCallback == "function" && e.aoDrawCallback.push(
                    {
                        fn: g.fnDrawCallback,
                        sName: "user"
                    });
                    typeof g.fnServerParams == "function" && e.aoServerParams.push(
                    {
                        fn: g.fnServerParams,
                        sName: "user"
                    });
                    typeof g.fnStateSaveCallback == "function" && e.aoStateSave.push(
                    {
                        fn: g.fnStateSaveCallback,
                        sName: "user"
                    });
                    typeof g.fnStateLoadCallback == "function" && e.aoStateLoad.push(
                    {
                        fn: g.fnStateLoadCallback,
                        sName: "user"
                    });
                    if (e.oFeatures.bServerSide && e.oFeatures.bSort && e.oFeatures.bSortClasses) e.aoDrawCallback.push(
                    {
                        fn: V,
                        sName: "server_side_sort_classes"
                    });
                    else e.oFeatures.bDeferRender && e.aoDrawCallback.push(
                    {
                        fn: V,
                        sName: "defer_sort_classes"
                    });
                    if (typeof g.bJQueryUI != "undefined" && g.bJQueryUI)
                    {
                        e.oClasses = n.oJUIClasses;
                        if (typeof g.sDom == "undefined") e.sDom = '<"H"lfr>t<"F"ip>'
                    }
                    if (e.oScroll.sX !== "" || e.oScroll.sY !== "") e.oScroll.iBarWidth = Ya();
                    if (typeof g.iDisplayStart != "undefined" && typeof e.iInitDisplayStart == "undefined")
                    {
                        e.iInitDisplayStart = g.iDisplayStart;
                        e._iDisplayStart = g.iDisplayStart
                    }
                    if (typeof g.bStateSave != "undefined")
                    {
                        e.oFeatures.bStateSave = g.bStateSave;
                        Xa(e, g);
                        e.aoDrawCallback.push(
                        {
                            fn: va,
                            sName: "state_save"
                        })
                    }
                    if (typeof g.iDeferLoading != "undefined")
                    {
                        e.bDeferLoading = true;
                        e._iRecordsTotal = g.iDeferLoading;
                        e._iRecordsDisplay = g.iDeferLoading
                    }
                    if (typeof g.aaData != "undefined") j = true;
                    if (typeof g != "undefined" && typeof g.aoData != "undefined") g.aoColumns = g.aoData;
                    if (typeof g.oLanguage != "undefined") if (typeof g.oLanguage.sUrl != "undefined" && g.oLanguage.sUrl !== "")
                    {
                        e.oLanguage.sUrl = g.oLanguage.sUrl;
                        i.getJSON(e.oLanguage.sUrl, null, function (u)
                        {
                            y(e, u, true)
                        });
                        h = true
                    }
                    else y(e, g.oLanguage, false)
                }
                else g = {};
                if (typeof g.asStripClasses == "undefined" && typeof g.asStripeClasses == "undefined")
                {
                    e.asStripeClasses.push(e.oClasses.sStripeOdd);
                    e.asStripeClasses.push(e.oClasses.sStripeEven)
                }
                c = false;
                d = i(this).children("tbody").children("tr");
                a = 0;
                for (b = e.asStripeClasses.length; a < b; a++) if (d.filter(":lt(2)").hasClass(e.asStripeClasses[a]))
                {
                    c = true;
                    break
                }
                if (c)
                {
                    e.asDestroyStripes = ["", ""];
                    if (i(d[0]).hasClass(e.oClasses.sStripeOdd)) e.asDestroyStripes[0] += e.oClasses.sStripeOdd + " ";
                    if (i(d[0]).hasClass(e.oClasses.sStripeEven)) e.asDestroyStripes[0] += e.oClasses.sStripeEven;
                    if (i(d[1]).hasClass(e.oClasses.sStripeOdd)) e.asDestroyStripes[1] += e.oClasses.sStripeOdd + " ";
                    if (i(d[1]).hasClass(e.oClasses.sStripeEven)) e.asDestroyStripes[1] += e.oClasses.sStripeEven;
                    d.removeClass(e.asStripeClasses.join(" "))
                }
                c = [];
                var k;
                a = this.getElementsByTagName("thead");
                if (a.length !== 0)
                {
                    Y(e.aoHeader, a[0]);
                    c = S(e)
                }
                if (typeof g.aoColumns == "undefined")
                {
                    k = [];
                    a = 0;
                    for (b = c.length; a < b; a++) k.push(null)
                }
                else k = g.aoColumns;
                a = 0;
                for (b = k.length; a < b; a++)
                {
                    if (typeof g.saved_aoColumns != "undefined" && g.saved_aoColumns.length == b)
                    {
                        if (k[a] === null) k[a] = {};
                        k[a].bVisible = g.saved_aoColumns[a].bVisible
                    }
                    F(e, c ? c[a] : null)
                }
                if (typeof g.aoColumnDefs != "undefined") for (a = g.aoColumnDefs.length - 1; a >= 0; a--)
                {
                    var m = g.aoColumnDefs[a].aTargets;
                    i.isArray(m) || J(e, 1, "aTargets must be an array of targets, not a " + typeof m);
                    c = 0;
                    for (d = m.length; c < d; c++) if (typeof m[c] == "number" && m[c] >= 0)
                    {
                        for (; e.aoColumns.length <= m[c];) F(e);
                        x(e, m[c], g.aoColumnDefs[a])
                    }
                    else if (typeof m[c] == "number" && m[c] < 0) x(e, e.aoColumns.length + m[c], g.aoColumnDefs[a]);
                    else if (typeof m[c] == "string")
                    {
                        b = 0;
                        for (f = e.aoColumns.length; b < f; b++) if (m[c] == "_all" || i(e.aoColumns[b].nTh).hasClass(m[c])) x(e, b, g.aoColumnDefs[a])
                    }
                }
                if (typeof k != "undefined")
                {
                    a = 0;
                    for (b = k.length; a < b; a++) x(e, a, k[a])
                }
                a = 0;
                for (b = e.aaSorting.length; a < b; a++)
                {
                    if (e.aaSorting[a][0] >= e.aoColumns.length) e.aaSorting[a][0] = 0;
                    k = e.aoColumns[e.aaSorting[a][0]];
                    if (typeof e.aaSorting[a][2] == "undefined") e.aaSorting[a][2] = 0;
                    if (typeof g.aaSorting == "undefined" && typeof e.saved_aaSorting == "undefined") e.aaSorting[a][1] = k.asSorting[0];
                    c = 0;
                    for (d = k.asSorting.length; c < d; c++) if (e.aaSorting[a][1] == k.asSorting[c])
                    {
                        e.aaSorting[a][2] = c;
                        break
                    }
                }
                V(e);
                a = i(this).children("thead");
                if (a.length === 0)
                {
                    a = [p.createElement("thead")];
                    this.appendChild(a[0])
                }
                e.nTHead = a[0];
                a = i(this).children("tbody");
                if (a.length === 0)
                {
                    a = [p.createElement("tbody")];
                    this.appendChild(a[0])
                }
                e.nTBody = a[0];
                a = i(this).children("tfoot");
                if (a.length > 0)
                {
                    e.nTFoot = a[0];
                    Y(e.aoFooter, e.nTFoot)
                }
                if (j) for (a = 0; a < g.aaData.length; a++) v(e, g.aaData[a]);
                else $(e);
                e.aiDisplay = e.aiDisplayMaster.slice();
                e.bInitialised = true;
                h === false && t(e)
            }
        })
    }
})(jQuery, window, document);


(function (a)
{
    a.uniform = {
        options: {
            selectClass: "selector",
            radioClass: "radio",
            checkboxClass: "checker", 
            fileClass: "uploader",
            filenameClass: "filename",
            fileBtnClass: "action",
            fileDefaultText: "No file selected",
            fileBtnText: "Choose File",
            checkedClass: "checked",
            focusClass: "focus",
            disabledClass: "disabled",
            buttonClass: "button",
            activeClass: "active",
            hoverClass: "hover",
            useID: true,
            idPrefix: "uniform",
            resetSelector: false,
            autoHide: true
        },
        elements: []
    };
    a.fn.uniform = function (k)
    {
        k = a.extend(a.uniform.options, k);
        var d = this;
        if (k.resetSelector != false)
        {
            a(k.resetSelector).mouseup(function ()
            {
                function l()
                {
                    a.uniform.update(d)
                }
                setTimeout(l, 10)
            })
        }
        function j(l)
        {
            $el = a(l);
            $el.addClass($el.attr("type"));
            b(l)
        }
        function g(l)
        {
            a(l).addClass("uniform");
            b(l)
        }
        function i(o)
        {
            var m = a(o);
            var p = a("<div>"),
                l = a("<span>");
            p.addClass(k.buttonClass);
            if (k.useID && m.attr("id") != "")
            {
                p.attr("id", k.idPrefix + "-" + m.attr("id"))
            }
            var n;
            if (m.is("a") || m.is("button"))
            {
                n = m.text()
            }
            else
            {
                if (m.is(":submit") || m.is(":reset") || m.is("input[type=button]"))
                {
                    n = m.attr("value")
                }
            }
            n = n == "" ? m.is(":reset") ? "Reset" : "Submit" : n;
            l.html(n);
            m.css("opacity", 0);
            m.wrap(p);
            m.wrap(l);
            p = m.closest("div");
            l = m.closest("span");
            if (m.is(":disabled"))
            {
                p.addClass(k.disabledClass)
            }
            p.bind(
            {
                "mouseenter.uniform": function ()
                {
                    p.addClass(k.hoverClass)
                },
                "mouseleave.uniform": function ()
                {
                    p.removeClass(k.hoverClass);
                    p.removeClass(k.activeClass)
                },
                "mousedown.uniform touchbegin.uniform": function ()
                {
                    p.addClass(k.activeClass)
                },
                "mouseup.uniform touchend.uniform": function ()
                {
                    p.removeClass(k.activeClass)
                },
                "click.uniform touchend.uniform": function (r)
                {
                    if (a(r.target).is("span") || a(r.target).is("div"))
                    {
                        if (o[0].dispatchEvent)
                        {
                            var q = document.createEvent("MouseEvents");
                            q.initEvent("click", true, true);
                            o[0].dispatchEvent(q)
                        }
                        else
                        {
                            o[0].click()
                        }
                    }
                }
            });
            o.bind(
            {
                "focus.uniform": function ()
                {
                    p.addClass(k.focusClass)
                },
                "blur.uniform": function ()
                {
                    p.removeClass(k.focusClass)
                }
            });
            a.uniform.noSelect(p);
            b(o)
        }
        function e(o)
        {
            var m = a(o);
            var p = a("<div />"),
                l = a("<span />");
            if (!m.css("display") == "none" && k.autoHide)
            {
                p.hide()
            }
            p.addClass(k.selectClass);
            if (k.useID && o.attr("id") != "")
            {
                p.attr("id", k.idPrefix + "-" + o.attr("id"))
            }
            var n = o.find(":selected:first");
            if (n.length == 0)
            {
                n = o.find("option:first")
            }
            l.html(n.html());
            o.css("opacity", 0); 
            o.wrap(p);
            o.before(l);
            p = o.parent("div");
            l = o.siblings("span");
            o.bind(
            {
                "change.uniform": function ()
                {
                    l.text(o.find(":selected").html());
                    p.removeClass(k.activeClass)
                },
                "focus.uniform": function ()
                {
                    p.addClass(k.focusClass)
                },
                "blur.uniform": function ()
                {
                    p.removeClass(k.focusClass);
                    p.removeClass(k.activeClass)
                },
                "mousedown.uniform touchbegin.uniform": function ()
                {
                    p.addClass(k.activeClass)
                },
                "mouseup.uniform touchend.uniform": function ()
                {
                    p.removeClass(k.activeClass)
                },
                "click.uniform touchend.uniform": function ()
                {
                    p.removeClass(k.activeClass)
                },
                "mouseenter.uniform": function ()
                {
                    p.addClass(k.hoverClass)
                },
                "mouseleave.uniform": function ()
                {
                    p.removeClass(k.hoverClass);
                    p.removeClass(k.activeClass)
                },
                "keyup.uniform": function ()
                {
                    l.text(o.find(":selected").html())
                }
            });
            if (a(o).attr("disabled"))
            {
                p.addClass(k.disabledClass)
            }
            a.uniform.noSelect(l);
            b(o)
        }
        function f(n)
        {
            var m = a(n);
            var o = a("<div />"),
                l = a("<span />");
            if (!m.css("display") == "none" && k.autoHide)
            {
                o.hide()
            }
            o.addClass(k.checkboxClass);
            if (k.useID && n.attr("id") != "")
            {
                o.attr("id", k.idPrefix + "-" + n.attr("id"))
            }
            a(n).wrap(o);
            a(n).wrap(l);
            l = n.parent();
            o = l.parent();
            a(n).css("opacity", 1).bind( //mayur
            {
                "focus.uniform": function ()
                {
                    o.addClass(k.focusClass)
                },
                "blur.uniform": function ()
                {
                    o.removeClass(k.focusClass)
                },
                "click.uniform touchend.uniform": function ()
                {
                    if (!a(n).attr("checked"))
                    {
                        l.removeClass(k.checkedClass)
                    }
                    else
                    {
                        l.addClass(k.checkedClass)
                    }
                },
                "mousedown.uniform touchbegin.uniform": function ()
                {
                    o.addClass(k.activeClass)
                },
                "mouseup.uniform touchend.uniform": function ()
                {
                    o.removeClass(k.activeClass)
                },
                "mouseenter.uniform": function ()
                {
                    o.addClass(k.hoverClass)
                },
                "mouseleave.uniform": function ()
                {
                    o.removeClass(k.hoverClass);
                    o.removeClass(k.activeClass)
                }
            });
            if (a(n).attr("checked"))
            {
                l.addClass(k.checkedClass)
            }
            if (a(n).attr("disabled"))
            {
                o.addClass(k.disabledClass)
            }
            b(n)
        }
        function c(n)
        {
            var m = a(n);
            var o = a("<div />"),
                l = a("<span />");
            if (!m.css("display") == "none" && k.autoHide)
            {
                o.hide()
            }
            o.addClass(k.radioClass);
            if (k.useID && n.attr("id") != "")
            {
                o.attr("id", k.idPrefix + "-" + n.attr("id"))
            }
            a(n).wrap(o);
            a(n).wrap(l);
            l = n.parent();
            o = l.parent();
            a(n).css("opacity", 0).bind(
            {
                "focus.uniform": function ()
                {
                    o.addClass(k.focusClass)
                },
                "blur.uniform": function ()
                {
                    o.removeClass(k.focusClass)
                },
                "click.uniform touchend.uniform": function ()
                {
                    if (!a(n).attr("checked"))
                    {
                        l.removeClass(k.checkedClass)
                    }
                    else
                    {
                        var p = k.radioClass.split(" ")[0];
                        a("." + p + " span." + k.checkedClass + ":has([name='" + a(n).attr("name") + "'])").removeClass(k.checkedClass);
                        l.addClass(k.checkedClass)
                    }
                },
                "mousedown.uniform touchend.uniform": function ()
                {
                    if (!a(n).is(":disabled"))
                    {
                        o.addClass(k.activeClass)
                    }
                },
                "mouseup.uniform touchbegin.uniform": function ()
                {
                    o.removeClass(k.activeClass)
                },
                "mouseenter.uniform touchend.uniform": function ()
                {
                    o.addClass(k.hoverClass)
                },
                "mouseleave.uniform": function ()
                {
                    o.removeClass(k.hoverClass);
                    o.removeClass(k.activeClass)
                }
            });
            if (a(n).attr("checked"))
            {
                l.addClass(k.checkedClass)
            }
            if (a(n).attr("disabled"))
            {
                o.addClass(k.disabledClass)
            }
            b(n)
        }
        function h(q)
        {
            var o = a(q);
            var r = a("<div />"),
                p = a("<span>" + k.fileDefaultText + "</span>"),
                m = a("<span>" + k.fileBtnText + "</span>");
            if (!o.css("display") == "none" && k.autoHide)
            {
                r.hide()
            }
            r.addClass(k.fileClass);
            p.addClass(k.filenameClass);
            m.addClass(k.fileBtnClass);
            if (k.useID && o.attr("id") != "")
            {
                r.attr("id", k.idPrefix + "-" + o.attr("id"))
            }
            o.wrap(r);
            o.after(m);
            o.after(p);
            r = o.closest("div");
            p = o.siblings("." + k.filenameClass);
            m = o.siblings("." + k.fileBtnClass);
            if (!o.attr("size"))
            {
                var l = r.width();
                o.attr("size", l / 10)
            }
            var n = function ()
                {
                    var s = o.val();
                    if (s === "")
                    {
                        s = k.fileDefaultText
                    }
                    else
                    {
                        s = s.split(/[\/\\]+/);
                        s = s[(s.length - 1)]
                    }
                    p.text(s)
                };
            n();
            o.css("opacity", 0).bind(
            {
                "focus.uniform": function ()
                {
                    r.addClass(k.focusClass)
                },
                "blur.uniform": function ()
                {
                    r.removeClass(k.focusClass)
                },
                "mousedown.uniform": function ()
                {
                    if (!a(q).is(":disabled"))
                    {
                        r.addClass(k.activeClass)
                    }
                },
                "mouseup.uniform": function ()
                {
                    r.removeClass(k.activeClass)
                },
                "mouseenter.uniform": function ()
                {
                    r.addClass(k.hoverClass)
                },
                "mouseleave.uniform": function ()
                {
                    r.removeClass(k.hoverClass);
                    r.removeClass(k.activeClass)
                }
            });
            if (a.browser.msie)
            {
                o.bind("click.uniform.ie7", function ()
                {
                    setTimeout(n, 0)
                })
            }
            else
            {
                o.bind("change.uniform", n)
            }
            if (o.attr("disabled"))
            {
                r.addClass(k.disabledClass)
            }
            a.uniform.noSelect(p);
            a.uniform.noSelect(m);
            b(q)
        }
        a.uniform.restore = function (l)
        {
            if (l == undefined)
            {
                l = a(a.uniform.elements)
            }
            a(l).each(function ()
            {
                if (a(this).is(":checkbox"))
                {
                    a(this).unwrap().unwrap()
                }
                else
                {
                    if (a(this).is("select"))
                    {
                        a(this).siblings("span").remove();
                        a(this).unwrap()
                    }
                    else
                    {
                        if (a(this).is(":radio"))
                        {
                            a(this).unwrap().unwrap()
                        }
                        else
                        {
                            if (a(this).is(":file"))
                            {
                                a(this).siblings("span").remove();
                                a(this).unwrap()
                            }
                            else
                            {
                                if (a(this).is("button, :submit, :reset, a, input[type='button']"))
                                {
                                    a(this).unwrap().unwrap()
                                }
                            }
                        }
                    }
                }
                a(this).unbind(".uniform");
                a(this).css("opacity", "1");
                var m = a.inArray(a(l), a.uniform.elements);
                a.uniform.elements.splice(m, 1)
            })
        };

        function b(l)
        {
            l = a(l).get();
            if (l.length > 1)
            {
                a.each(l, function (m, n)
                {
                    a.uniform.elements.push(n)
                })
            }
            else
            {
                a.uniform.elements.push(l)
            }
        }
        a.uniform.noSelect = function (l)
        {
            function m()
            {
                return false
            }
            a(l).each(function ()
            {
                this.onselectstart = this.ondragstart = m;
                a(this).mousedown(m).css(
                {
                    MozUserSelect: "none"
                })
            })
        };
        a.uniform.update = function (l)
        {
            if (l == undefined)
            {
                l = a(a.uniform.elements)
            }
            l = a(l);
            l.each(function ()
            {
                var n = a(this);
                if (n.is("select"))
                {
                    var m = n.siblings("span");
                    var p = n.parent("div");
                    p.removeClass(k.hoverClass + " " + k.focusClass + " " + k.activeClass);
                    m.html(n.find(":selected").html());
                    if (n.is(":disabled"))
                    {
                        p.addClass(k.disabledClass)
                    }
                    else
                    {
                        p.removeClass(k.disabledClass)
                    }
                }
                else
                {
                    if (n.is(":checkbox"))
                    {
                        var m = n.closest("span");
                        var p = n.closest("div");
                        p.removeClass(k.hoverClass + " " + k.focusClass + " " + k.activeClass);
                        m.removeClass(k.checkedClass);
                        if (n.is(":checked"))
                        {
                            m.addClass(k.checkedClass)
                        }
                        if (n.is(":disabled"))
                        {
                            p.addClass(k.disabledClass)
                        }
                        else
                        {
                            p.removeClass(k.disabledClass)
                        }
                    }
                    else
                    {
                        if (n.is(":radio"))
                        {
                            var m = n.closest("span");
                            var p = n.closest("div");
                            p.removeClass(k.hoverClass + " " + k.focusClass + " " + k.activeClass);
                            m.removeClass(k.checkedClass);
                            if (n.is(":checked"))
                            {
                                m.addClass(k.checkedClass)
                            }
                            if (n.is(":disabled"))
                            {
                                p.addClass(k.disabledClass)
                            }
                            else
                            {
                                p.removeClass(k.disabledClass)
                            }
                        }
                        else
                        {
                            if (n.is(":file"))
                            {
                                var p = n.parent("div");
                                var o = n.siblings(k.filenameClass);
                                btnTag = n.siblings(k.fileBtnClass);
                                p.removeClass(k.hoverClass + " " + k.focusClass + " " + k.activeClass);
                                o.text(n.val());
                                if (n.is(":disabled"))
                                {
                                    p.addClass(k.disabledClass)
                                }
                                else
                                {
                                    p.removeClass(k.disabledClass)
                                }
                            }
                            else
                            {
                                if (n.is(":submit") || n.is(":reset") || n.is("button") || n.is("a") || l.is("input[type=button]"))
                                {
                                    var p = n.closest("div");
                                    p.removeClass(k.hoverClass + " " + k.focusClass + " " + k.activeClass);
                                    if (n.is(":disabled"))
                                    {
                                        p.addClass(k.disabledClass)
                                    }
                                    else
                                    {
                                        p.removeClass(k.disabledClass)
                                    }
                                }
                            }
                        }
                    }
                }
            })
        };
        return this.each(function ()
        {
            if (a.support.selectOpacity)
            {
                var l = a(this);
                if (l.is("select"))
                {
                    if (l.attr("multiple") != true)
                    {
                        if (l.attr("size") == undefined || l.attr("size") <= 1)
                        {
                            e(l)
                        }
                    }
                }
                else
                {
                    if (l.is(":checkbox"))
                    {
                        f(l)
                    }
                    else
                    {
                        if (l.is(":radio"))
                        {
                            c(l)
                        }
                        else
                        {
                            if (l.is(":file"))
                            {
                                h(l)
                            }
                            else
                            {
                                if (l.is(":text, :password, input[type='email']"))
                                {
                                    j(l)
                                }
                                else
                                {
                                    if (l.is("textarea"))
                                    {
                                        g(l)
                                    }
                                    else
                                    {
                                        if (l.is("a") || l.is(":submit") || l.is(":reset") || l.is("button") || l.is("input[type=button]"))
                                        {
                                            i(l)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        })
    }
})(jQuery);

/*
 * jQuery UI Timepicker 0.2.9
 *
 * Copyright 2010-2011, Francois Gelinas
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://fgelinas.com/code/timepicker
 *
 * Depends:
 *	jquery.ui.core.js
 *  jquery.ui.position.js (only if position settngs are used)
 *
 * Change version 0.1.0 - moved the t-rex up here
 *
                                                  ____
       ___                                      .-~. /_"-._
      `-._~-.                                  / /_ "~o\  :Y
          \  \                                / : \~x.  ` ')
           ]  Y                              /  |  Y< ~-.__j
          /   !                        _.--~T : l  l<  /.-~
         /   /                 ____.--~ .   ` l /~\ \<|Y
        /   /             .-~~"        /| .    ',-~\ \L|
       /   /             /     .^   \ Y~Y \.^>/l_   "--'
      /   Y           .-"(  .  l__  j_j l_/ /~_.-~    .
     Y    l          /    \  )    ~~~." / `/"~ / \.__/l_
     |     \     _.-"      ~-{__     l  :  l._Z~-.___.--~
     |      ~---~           /   ~~"---\_  ' __[>
     l  .                _.^   ___     _>-y~
      \  \     .      .-~   .-~   ~>--"  /
       \  ~---"            /     ./  _.-'
        "-.,_____.,_  _.--~\     _.-~
                    ~~     (   _}       -Row
                           `. ~(
                             )  \
                            /,`--'~\--'~\
                  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                             ->T-Rex<-
*/

(function ($, undefined)
{

    $.extend($.ui, {
        timepicker: {
            version: "0.2.9"
        }
    });

    var PROP_NAME = 'timepicker';
    var tpuuid = new Date().getTime();

    /* Time picker manager.
    Use the singleton instance of this class, $.timepicker, to interact with the time picker.
    Settings for (groups of) time pickers are maintained in an instance object,
    allowing multiple different settings on the same page. */

    function Timepicker()
    {
        this.debug = true; // Change this to true to start debugging
        this._curInst = null; // The current instance in use
        this._isInline = false; // true if the instance is displayed inline
        this._disabledInputs = []; // List of time picker inputs that have been disabled
        this._timepickerShowing = false; // True if the popup picker is showing , false if not
        this._inDialog = false; // True if showing within a "dialog", false if not
        this._dialogClass = 'ui-timepicker-dialog'; // The name of the dialog marker class
        this._mainDivId = 'ui-timepicker-div'; // The ID of the main timepicker division
        this._inlineClass = 'ui-timepicker-inline'; // The name of the inline marker class
        this._currentClass = 'ui-timepicker-current'; // The name of the current hour / minutes marker class
        this._dayOverClass = 'ui-timepicker-days-cell-over'; // The name of the day hover marker class
        this.regional = []; // Available regional settings, indexed by language code
        this.regional[''] = { // Default regional settings
            hourText: 'Hour',
            // Display text for hours section
            minuteText: 'Minute',
            // Display text for minutes link
            amPmText: ['AM', 'PM'],
            // Display text for AM PM
            closeButtonText: 'Done',
            // Text for the confirmation button (ok button)
            nowButtonText: 'Now',
            // Text for the now button
            deselectButtonText: 'Deselect' // Text for the deselect button
        };
        this._defaults = { // Global defaults for all the time picker instances
            showOn: 'focus',
            // 'focus' for popup on focus,
            // 'button' for trigger button, or 'both' for either (not yet implemented)
            button: null,
            // 'button' element that will trigger the timepicker
            showAnim: 'fadeIn',
            // Name of jQuery animation for popup
            showOptions: {},
            // Options for enhanced animations
            appendText: '',
            // Display text following the input box, e.g. showing the format
            beforeShow: null,
            // Define a callback function executed before the timepicker is shown
            onSelect: null,
            // Define a callback function when a hour / minutes is selected
            onClose: null,
            // Define a callback function when the timepicker is closed
            timeSeparator: ':',
            // The character to use to separate hours and minutes.
            periodSeparator: ' ',
            // The character to use to separate the time from the time period.
            showPeriod: false,
            // Define whether or not to show AM/PM with selected time
            showPeriodLabels: true,
            // Show the AM/PM labels on the left of the time picker
            showLeadingZero: true,
            // Define whether or not to show a leading zero for hours < 10. [true/false]
            showMinutesLeadingZero: true,
            // Define whether or not to show a leading zero for minutes < 10.
            altField: '',
            // Selector for an alternate field to store selected time into
            defaultTime: 'now',
            // Used as default time when input field is empty or for inline timePicker
            // (set to 'now' for the current time, '' for no highlighted time)
            myPosition: 'left top',
            // Position of the dialog relative to the input.
            // see the position utility for more info : http://jqueryui.com/demos/position/
            atPosition: 'left bottom',
            // Position of the input element to match
            // Note : if the position utility is not loaded, the timepicker will attach left top to left bottom
            //NEW: 2011-02-03
            onHourShow: null,
            // callback for enabling / disabling on selectable hours  ex : function(hour) { return true; }
            onMinuteShow: null,
            // callback for enabling / disabling on time selection  ex : function(hour,minute) { return true; }
            hours: {
                starts: 0,
                // first displayed hour
                ends: 23 // last displayed hour
            },
            minutes: {
                starts: 0,
                // first displayed minute
                ends: 55,
                // last displayed minute
                interval: 5 // interval of displayed minutes
            },
            rows: 4,
            // number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
            // 2011-08-05 0.2.4
            showHours: true,
            // display the hours section of the dialog
            showMinutes: true,
            // display the minute section of the dialog
            optionalMinutes: false,
            // optionally parse inputs of whole hours with minutes omitted
            // buttons
            showCloseButton: false,
            // shows an OK button to confirm the edit
            showNowButton: false,
            // Shows the 'now' button
            showDeselectButton: false // Shows the deselect time button
        };
        $.extend(this._defaults, this.regional['']);

        this.tpDiv = $('<div id="' + this._mainDivId + '" class="ui-timepicker ui-widget ui-helper-clearfix ui-corner-all " style="display: none"></div>');
    }

    $.extend(Timepicker.prototype, {
        /* Class name added to elements to indicate already configured with a time picker. */
        markerClassName: 'hasTimepicker',

        /* Debug logging (if enabled). */
        log: function ()
        {
            if (this.debug) console.log.apply('', arguments);
        },

        _widgetTimepicker: function ()
        {
            return this.tpDiv;
        },

        /* Override the default settings for all instances of the time picker.
        @param  settings  object - the new settings to use as defaults (anonymous object)
        @return the manager object */
        setDefaults: function (settings)
        {
            extendRemove(this._defaults, settings || {});
            return this;
        },

        /* Attach the time picker to a jQuery selection.
        @param  target    element - the target input field or division or span
        @param  settings  object - the new settings to use for this time picker instance (anonymous) */
        _attachTimepicker: function (target, settings)
        {
            // check for settings on the control itself - in namespace 'time:'
            var inlineSettings = null;
            for (var attrName in this._defaults)
            {
                var attrValue = target.getAttribute('time:' + attrName);
                if (attrValue)
                {
                    inlineSettings = inlineSettings || {};
                    try
                    {
                        inlineSettings[attrName] = eval(attrValue);
                    }
                    catch (err)
                    {
                        inlineSettings[attrName] = attrValue;
                    }
                }
            }
            var nodeName = target.nodeName.toLowerCase();
            var inline = (nodeName == 'div' || nodeName == 'span');

            if (!target.id)
            {
                this.uuid += 1;
                target.id = 'tp' + this.uuid;
            }
            var inst = this._newInst($(target), inline);
            inst.settings = $.extend(
            {}, settings || {}, inlineSettings || {});
            if (nodeName == 'input')
            {
                this._connectTimepicker(target, inst);
                // init inst.hours and inst.minutes from the input value
                this._setTimeFromField(inst);
            }
            else if (inline)
            {
                this._inlineTimepicker(target, inst);
            }


        },

        /* Create a new instance object. */
        _newInst: function (target, inline)
        {
            var id = target[0].id.replace(/([^A-Za-z0-9_-])/g, '\\\\$1'); // escape jQuery meta chars
            return {
                id: id,
                input: target,
                // associated target
                inline: inline,
                // is timepicker inline or not :
                tpDiv: (!inline ? this.tpDiv : // presentation div
                $('<div class="' + this._inlineClass + ' ui-timepicker ui-widget  ui-helper-clearfix"></div>'))
            };
        },

        /* Attach the time picker to an input field. */
        _connectTimepicker: function (target, inst)
        {
            var input = $(target);
            inst.append = $([]);
            inst.trigger = $([]);
            if (input.hasClass(this.markerClassName))
            {
                return;
            }
            this._attachments(input, inst);
            input.addClass(this.markerClassName).
            keydown(this._doKeyDown).
            keyup(this._doKeyUp).
            bind("setData.timepicker", function (event, key, value)
            {
                inst.settings[key] = value;
            }).
            bind("getData.timepicker", function (event, key)
            {
                return this._get(inst, key);
            });
            $.data(target, PROP_NAME, inst);
        },

        /* Handle keystrokes. */
        _doKeyDown: function (event)
        {
            var inst = $.timepicker._getInst(event.target);
            var handled = true;
            inst._keyEvent = true;
            if ($.timepicker._timepickerShowing)
            {
                switch (event.keyCode)
                {
                case 9:
                    $.timepicker._hideTimepicker();
                    handled = false;
                    break; // hide on tab out
                case 13:
                    $.timepicker._updateSelectedValue(inst);
                    $.timepicker._hideTimepicker();

                    return false; // don't submit the form
                    break; // select the value on enter
                case 27:
                    $.timepicker._hideTimepicker();
                    break; // hide on escape
                default:
                    handled = false;
                }
            }
            else if (event.keyCode == 36 && event.ctrlKey)
            { // display the time picker on ctrl+home
                $.timepicker._showTimepicker(this);
            }
            else
            {
                handled = false;
            }
            if (handled)
            {
                event.preventDefault();
                event.stopPropagation();
            }
        },

        /* Update selected time on keyUp */
        /* Added verion 0.0.5 */
        _doKeyUp: function (event)
        {
            var inst = $.timepicker._getInst(event.target);
            $.timepicker._setTimeFromField(inst);
            $.timepicker._updateTimepicker(inst);
        },

        /* Make attachments based on settings. */
        _attachments: function (input, inst)
        {
            var appendText = this._get(inst, 'appendText');
            var isRTL = this._get(inst, 'isRTL');
            if (inst.append)
            {
                inst.append.remove();
            }
            if (appendText)
            {
                inst.append = $('<span class="' + this._appendClass + '">' + appendText + '</span>');
                input[isRTL ? 'before' : 'after'](inst.append);
            }
            input.unbind('focus.timepicker', this._showTimepicker);
            if (inst.trigger)
            {
                inst.trigger.remove();
            }

            var showOn = this._get(inst, 'showOn');
            if (showOn == 'focus' || showOn == 'both')
            { // pop-up time picker when in the marked field
                input.bind("focus.timepicker", this._showTimepicker);
            }
            if (showOn == 'button' || showOn == 'both')
            { // pop-up time picker when 'button' element is clicked
                var button = this._get(inst, 'button');
                $(button).bind("click.timepicker", function ()
                {
                    if ($.timepicker._timepickerShowing && $.timepicker._lastInput == input[0])
                    {
                        $.timepicker._hideTimepicker();
                    }
                    else
                    {
                        $.timepicker._showTimepicker(input[0]);
                    }
                    return false;
                });

            }
        },


        /* Attach an inline time picker to a div. */
        _inlineTimepicker: function (target, inst)
        {
            var divSpan = $(target);
            if (divSpan.hasClass(this.markerClassName)) return;
            divSpan.addClass(this.markerClassName).append(inst.tpDiv).
            bind("setData.timepicker", function (event, key, value)
            {
                inst.settings[key] = value;
            }).bind("getData.timepicker", function (event, key)
            {
                return this._get(inst, key);
            });
            $.data(target, PROP_NAME, inst);

            this._setTimeFromField(inst);
            this._updateTimepicker(inst);
            inst.tpDiv.show();
        },

        /* Pop-up the time picker for a given input field.
        @param  input  element - the input field attached to the time picker or
        event - if triggered by focus */
        _showTimepicker: function (input)
        {
            input = input.target || input;
            if (input.nodeName.toLowerCase() != 'input')
            {
                input = $('input', input.parentNode)[0];
            } // find from button/image trigger
            if ($.timepicker._isDisabledTimepicker(input) || $.timepicker._lastInput == input)
            {
                return;
            } // already here
            // fix v 0.0.8 - close current timepicker before showing another one
            $.timepicker._hideTimepicker();

            var inst = $.timepicker._getInst(input);
            if ($.timepicker._curInst && $.timepicker._curInst != inst)
            {
                $.timepicker._curInst.tpDiv.stop(true, true);
            }
            var beforeShow = $.timepicker._get(inst, 'beforeShow');
            extendRemove(inst.settings, (beforeShow ? beforeShow.apply(input, [input, inst]) : {}));
            inst.lastVal = null;
            $.timepicker._lastInput = input;

            $.timepicker._setTimeFromField(inst);

            // calculate default position
            if ($.timepicker._inDialog)
            {
                input.value = '';
            } // hide cursor
            if (!$.timepicker._pos)
            { // position below input
                $.timepicker._pos = $.timepicker._findPos(input);
                $.timepicker._pos[1] += input.offsetHeight; // add the height
            }
            var isFixed = false;
            $(input).parents().each(function ()
            {
                isFixed |= $(this).css('position') == 'fixed';
                return !isFixed;
            });
            if (isFixed && $.browser.opera)
            { // correction for Opera when fixed and scrolled
                $.timepicker._pos[0] -= document.documentElement.scrollLeft;
                $.timepicker._pos[1] -= document.documentElement.scrollTop;
            }

            var offset = {
                left: $.timepicker._pos[0],
                top: $.timepicker._pos[1]
            };

            $.timepicker._pos = null;
            // determine sizing offscreen
            inst.tpDiv.css(
            {
                position: 'absolute',
                display: 'block',
                top: '-1000px'
            });
            $.timepicker._updateTimepicker(inst);


            // position with the ui position utility, if loaded
            if ((!inst.inline) && (typeof $.ui.position == 'object'))
            {
                inst.tpDiv.position(
                {
                    of: inst.input,
                    my: $.timepicker._get(inst, 'myPosition'),
                    at: $.timepicker._get(inst, 'atPosition'),
                    // offset: $( "#offset" ).val(),
                    // using: using,
                    collision: 'flip'
                });
                var offset = inst.tpDiv.offset();
                $.timepicker._pos = [offset.top, offset.left];
            }


            // reset clicked state
            inst._hoursClicked = false;
            inst._minutesClicked = false;

            // fix width for dynamic number of time pickers
            // and adjust position before showing
            offset = $.timepicker._checkOffset(inst, offset, isFixed);
            inst.tpDiv.css(
            {
                position: ($.timepicker._inDialog && $.blockUI ? 'static' : (isFixed ? 'fixed' : 'absolute')),
                display: 'none',
                left: offset.left + 'px',
                top: offset.top + 'px'
            });
            if (!inst.inline)
            {
                var showAnim = $.timepicker._get(inst, 'showAnim');
                var duration = $.timepicker._get(inst, 'duration');

                var postProcess = function ()
                    {
                        $.timepicker._timepickerShowing = true;
                        var borders = $.timepicker._getBorders(inst.tpDiv);
                        inst.tpDiv.find('iframe.ui-timepicker-cover'). // IE6- only
                        css(
                        {
                            left: -borders[0],
                            top: -borders[1],
                            width: inst.tpDiv.outerWidth(),
                            height: inst.tpDiv.outerHeight()
                        });
                    };

                // Fixed the zIndex problem for real (I hope) - FG - v 0.2.9
                inst.tpDiv.css('zIndex', $.timepicker._getZIndex(input) + 1);

                if ($.effects && $.effects[showAnim])
                {
                    inst.tpDiv.show(showAnim, $.timepicker._get(inst, 'showOptions'), duration, postProcess);
                }
                else
                {
                    inst.tpDiv[showAnim || 'show']((showAnim ? duration : null), postProcess);
                }
                if (!showAnim || !duration)
                {
                    postProcess();
                }
                if (inst.input.is(':visible') && !inst.input.is(':disabled'))
                {
                    inst.input.focus();
                }
                $.timepicker._curInst = inst;
            }
        },

        // This is a copy of the zIndex function of UI core 1.8.??
        // Copied in the timepicker to stay backward compatible.
        _getZIndex: function (target)
        {
            var elem = $(target),
                position, value;
            while (elem.length && elem[0] !== document)
            {
                position = elem.css("position");
                if (position === "absolute" || position === "relative" || position === "fixed")
                {
                    value = parseInt(elem.css("zIndex"), 10);
                    if (!isNaN(value) && value !== 0)
                    {
                        return value;
                    }
                }
                elem = elem.parent();
            }
        },

        /* Generate the time picker content. */
        _updateTimepicker: function (inst)
        {
            inst.tpDiv.empty().append(this._generateHTML(inst));
            this._rebindDialogEvents(inst);

        },

        _rebindDialogEvents: function (inst)
        {
            var borders = $.timepicker._getBorders(inst.tpDiv),
                self = this;
            inst.tpDiv.find('iframe.ui-timepicker-cover') // IE6- only
            .css(
            {
                left: -borders[0],
                top: -borders[1],
                width: inst.tpDiv.outerWidth(),
                height: inst.tpDiv.outerHeight()
            }).end()
            // after the picker html is appended bind the click & double click events (faster in IE this way
            // then letting the browser interpret the inline events)
            // the binding for the minute cells also exists in _updateMinuteDisplay
            .find('.ui-timepicker-minute-cell').unbind().bind("click", {
                fromDoubleClick: false
            }, $.proxy($.timepicker.selectMinutes, this)).bind("dblclick", {
                fromDoubleClick: true
            }, $.proxy($.timepicker.selectMinutes, this)).end().find('.ui-timepicker-hour-cell').unbind().bind("click", {
                fromDoubleClick: false
            }, $.proxy($.timepicker.selectHours, this)).bind("dblclick", {
                fromDoubleClick: true
            }, $.proxy($.timepicker.selectHours, this)).end().find('.ui-timepicker td a').unbind().bind('mouseout', function ()
            {
                $(this).removeClass('ui-state-hover');
                if (this.className.indexOf('ui-timepicker-prev') != -1) $(this).removeClass('ui-timepicker-prev-hover');
                if (this.className.indexOf('ui-timepicker-next') != -1) $(this).removeClass('ui-timepicker-next-hover');
            }).bind('mouseover', function ()
            {
                if (!self._isDisabledTimepicker(inst.inline ? inst.tpDiv.parent()[0] : inst.input[0]))
                {
                    $(this).parents('.ui-timepicker-calendar').find('a').removeClass('ui-state-hover');
                    $(this).addClass('ui-state-hover');
                    if (this.className.indexOf('ui-timepicker-prev') != -1) $(this).addClass('ui-timepicker-prev-hover');
                    if (this.className.indexOf('ui-timepicker-next') != -1) $(this).addClass('ui-timepicker-next-hover');
                }
            }).end().find('.' + this._dayOverClass + ' a').trigger('mouseover').end().find('.ui-timepicker-now').bind("click", function (e)
            {
                $.timepicker.selectNow(e);
            }).end().find('.ui-timepicker-deselect').bind("click", function (e)
            {
                $.timepicker.deselectTime(e);
            }).end().find('.ui-timepicker-close').bind("click", function (e)
            {
                $.timepicker._hideTimepicker();
            }).end();
        },

        /* Generate the HTML for the current state of the time picker. */
        _generateHTML: function (inst)
        {

            var h, m, row, col, html, hoursHtml, minutesHtml = '',
                showPeriod = (this._get(inst, 'showPeriod') == true),
                showPeriodLabels = (this._get(inst, 'showPeriodLabels') == true),
                showLeadingZero = (this._get(inst, 'showLeadingZero') == true),
                showHours = (this._get(inst, 'showHours') == true),
                showMinutes = (this._get(inst, 'showMinutes') == true),
                amPmText = this._get(inst, 'amPmText'),
                rows = this._get(inst, 'rows'),
                amRows = 0,
                pmRows = 0,
                amItems = 0,
                pmItems = 0,
                amFirstRow = 0,
                pmFirstRow = 0,
                hours = Array(),
                hours_options = this._get(inst, 'hours'),
                hoursPerRow = null,
                hourCounter = 0,
                hourLabel = this._get(inst, 'hourText'),
                showCloseButton = this._get(inst, 'showCloseButton'),
                closeButtonText = this._get(inst, 'closeButtonText'),
                showNowButton = this._get(inst, 'showNowButton'),
                nowButtonText = this._get(inst, 'nowButtonText'),
                showDeselectButton = this._get(inst, 'showDeselectButton'),
                deselectButtonText = this._get(inst, 'deselectButtonText'),
                showButtonPanel = showCloseButton || showNowButton || showDeselectButton;



            // prepare all hours and minutes, makes it easier to distribute by rows
            for (h = hours_options.starts; h <= hours_options.ends; h++)
            {
                hours.push(h);
            }
            hoursPerRow = Math.ceil(hours.length / rows); // always round up
            if (showPeriodLabels)
            {
                for (hourCounter = 0; hourCounter < hours.length; hourCounter++)
                {
                    if (hours[hourCounter] < 12)
                    {
                        amItems++;
                    }
                    else
                    {
                        pmItems++;
                    }
                }
                hourCounter = 0;

                amRows = Math.floor(amItems / hours.length * rows);
                pmRows = Math.floor(pmItems / hours.length * rows);

                // assign the extra row to the period that is more densly populated
                if (rows != amRows + pmRows)
                {
                    // Make sure: AM Has Items and either PM Does Not, AM has no rows yet, or AM is more dense
                    if (amItems && (!pmItems || !amRows || (pmRows && amItems / amRows >= pmItems / pmRows)))
                    {
                        amRows++;
                    }
                    else
                    {
                        pmRows++;
                    }
                }
                amFirstRow = Math.min(amRows, 1);
                pmFirstRow = amRows + 1;
                hoursPerRow = Math.ceil(Math.max(amItems / amRows, pmItems / pmRows));
            }


            html = '<table class="ui-timepicker-table ui-widget-content ui-corner-all"><tr>';

            if (showHours)
            {

                html += '<td class="ui-timepicker-hours">' + '<div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">' + hourLabel + '</div>' + '<table class="ui-timepicker">';

                for (row = 1; row <= rows; row++)
                {
                    html += '<tr>';
                    // AM
                    if (row == amFirstRow && showPeriodLabels)
                    {
                        html += '<th rowspan="' + amRows.toString() + '" class="periods" scope="row">' + amPmText[0] + '</th>';
                    }
                    // PM
                    if (row == pmFirstRow && showPeriodLabels)
                    {
                        html += '<th rowspan="' + pmRows.toString() + '" class="periods" scope="row">' + amPmText[1] + '</th>';
                    }
                    for (col = 1; col <= hoursPerRow; col++)
                    {
                        if (showPeriodLabels && row < pmFirstRow && hours[hourCounter] >= 12)
                        {
                            html += this._generateHTMLHourCell(inst, undefined, showPeriod, showLeadingZero);
                        }
                        else
                        {
                            html += this._generateHTMLHourCell(inst, hours[hourCounter], showPeriod, showLeadingZero);
                            hourCounter++;
                        }
                    }
                    html += '</tr>';
                }
                html += '</tr></table>' + // Close the hours cells table
                '</td>'; // Close the Hour td
            }

            if (showMinutes)
            {
                html += '<td class="ui-timepicker-minutes">';
                html += this._generateHTMLMinutes(inst);
                html += '</td>';
            }

            html += '</tr>';


            if (showButtonPanel)
            {
                var buttonPanel = '<tr><td colspan="3"><div class="ui-timepicker-buttonpane ui-widget-content">';
                if (showNowButton)
                {
                    buttonPanel += '<button type="button" class="ui-timepicker-now ui-state-default ui-corner-all" ' + ' data-timepicker-instance-id="#' + inst.id.replace(/\\\\/g, "\\") + '" >' + nowButtonText + '</button>';
                }
                if (showDeselectButton)
                {
                    buttonPanel += '<button type="button" class="ui-timepicker-deselect ui-state-default ui-corner-all" ' + ' data-timepicker-instance-id="#' + inst.id.replace(/\\\\/g, "\\") + '" >' + deselectButtonText + '</button>';
                }
                if (showCloseButton)
                {
                    buttonPanel += '<button type="button" class="ui-timepicker-close ui-state-default ui-corner-all" ' + ' data-timepicker-instance-id="#' + inst.id.replace(/\\\\/g, "\\") + '" >' + closeButtonText + '</button>';
                }

                html += buttonPanel + '</div></td></tr>';
            }
            html += '</table>';

            /* IE6 IFRAME FIX (taken from datepicker 1.5.3, fixed in 0.1.2 */
            html += ($.browser.msie && parseInt($.browser.version, 10) < 7 && !inst.inline ? '<iframe src="javascript:false;" class="ui-timepicker-cover" frameborder="0"></iframe>' : '');

            return html;
        },

        /* Special function that update the minutes selection in currently visible timepicker
         * called on hour selection when onMinuteShow is defined  */
        _updateMinuteDisplay: function (inst)
        {
            var newHtml = this._generateHTMLMinutes(inst);
            inst.tpDiv.find('td.ui-timepicker-minutes').html(newHtml);
            this._rebindDialogEvents(inst);
            // after the picker html is appended bind the click & double click events (faster in IE this way
            // then letting the browser interpret the inline events)
            // yes I know, duplicate code, sorry
            /*                .find('.ui-timepicker-minute-cell')
                    .bind("click", { fromDoubleClick:false }, $.proxy($.timepicker.selectMinutes, this))
                    .bind("dblclick", { fromDoubleClick:true }, $.proxy($.timepicker.selectMinutes, this));
*/

        },

        /*
         * Generate the minutes table
         * This is separated from the _generateHTML function because is can be called separately (when hours changes)
         */
        _generateHTMLMinutes: function (inst)
        {

            var m, row, html = '',
                rows = this._get(inst, 'rows'),
                minutes = Array(),
                minutes_options = this._get(inst, 'minutes'),
                minutesPerRow = null,
                minuteCounter = 0,
                showMinutesLeadingZero = (this._get(inst, 'showMinutesLeadingZero') == true),
                onMinuteShow = this._get(inst, 'onMinuteShow'),
                minuteLabel = this._get(inst, 'minuteText');

            if (!minutes_options.starts)
            {
                minutes_options.starts = 0;
            }
            if (!minutes_options.ends)
            {
                minutes_options.ends = 59;
            }
            for (m = minutes_options.starts; m <= minutes_options.ends; m += minutes_options.interval)
            {
                minutes.push(m);
            }
            minutesPerRow = Math.round(minutes.length / rows + 0.49); // always round up
            /*
             * The minutes table
             */
            // if currently selected minute is not enabled, we have a problem and need to select a new minute.
            if (onMinuteShow && (onMinuteShow.apply((inst.input ? inst.input[0] : null), [inst.hours, inst.minutes]) == false))
            {
                // loop minutes and select first available
                for (minuteCounter = 0; minuteCounter < minutes.length; minuteCounter += 1)
                {
                    m = minutes[minuteCounter];
                    if (onMinuteShow.apply((inst.input ? inst.input[0] : null), [inst.hours, m]))
                    {
                        inst.minutes = m;
                        break;
                    }
                }
            }



            html += '<div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">' + minuteLabel + '</div>' + '<table class="ui-timepicker">';

            minuteCounter = 0;
            for (row = 1; row <= rows; row++)
            {
                html += '<tr>';
                while (minuteCounter < row * minutesPerRow)
                {
                    var m = minutes[minuteCounter];
                    var displayText = '';
                    if (m !== undefined)
                    {
                        displayText = (m < 10) && showMinutesLeadingZero ? "0" + m.toString() : m.toString();
                    }
                    html += this._generateHTMLMinuteCell(inst, m, displayText);
                    minuteCounter++;
                }
                html += '</tr>';
            }

            html += '</table>';

            return html;
        },

        /* Generate the content of a "Hour" cell */
        _generateHTMLHourCell: function (inst, hour, showPeriod, showLeadingZero)
        {

            var displayHour = hour;
            if ((hour > 12) && showPeriod)
            {
                displayHour = hour - 12;
            }
            if ((displayHour == 0) && showPeriod)
            {
                displayHour = 12;
            }
            if ((displayHour < 10) && showLeadingZero)
            {
                displayHour = '0' + displayHour;
            }

            var html = "";
            var enabled = true;
            var onHourShow = this._get(inst, 'onHourShow'); //custom callback
            if (hour == undefined)
            {
                html = '<td><span class="ui-state-default ui-state-disabled">&nbsp;</span></td>';
                return html;
            }

            if (onHourShow)
            {
                enabled = onHourShow.apply((inst.input ? inst.input[0] : null), [hour]);
            }

            if (enabled)
            {
                html = '<td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#' + inst.id.replace(/\\\\/g, "\\") + '" data-hour="' + hour.toString() + '">' + '<a class="ui-state-default ' + (hour == inst.hours ? 'ui-state-active' : '') + '">' + displayHour.toString() + '</a></td>';
            }
            else
            {
                html = '<td>' + '<span class="ui-state-default ui-state-disabled ' + (hour == inst.hours ? ' ui-state-active ' : ' ') + '">' + displayHour.toString() + '</span>' + '</td>';
            }
            return html;
        },

        /* Generate the content of a "Hour" cell */
        _generateHTMLMinuteCell: function (inst, minute, displayText)
        {
            var html = "";
            var enabled = true;
            var onMinuteShow = this._get(inst, 'onMinuteShow'); //custom callback
            if (onMinuteShow)
            {
                //NEW: 2011-02-03  we should give the hour as a parameter as well!
                enabled = onMinuteShow.apply((inst.input ? inst.input[0] : null), [inst.hours, minute]); //trigger callback
            }

            if (minute == undefined)
            {
                html = '<td><span class="ui-state-default ui-state-disabled">&nbsp;</span></td>';
                return html;
            }

            if (enabled)
            {
                html = '<td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#' + inst.id.replace(/\\\\/g, "\\") + '" data-minute="' + minute.toString() + '" >' + '<a class="ui-state-default ' + (minute == inst.minutes ? 'ui-state-active' : '') + '" >' + displayText + '</a></td>';
            }
            else
            {

                html = '<td>' + '<span class="ui-state-default ui-state-disabled" >' + displayText + '</span>' + '</td>';
            }
            return html;
        },


        /* Enable the date picker to a jQuery selection.
           @param  target    element - the target input field or division or span */
        _enableTimepicker: function (target)
        {
            var $target = $(target),
                target_id = $target.attr('id'),
                inst = $.data(target, PROP_NAME);

            if (!$target.hasClass(this.markerClassName))
            {
                return;
            }
            var nodeName = target.nodeName.toLowerCase();
            if (nodeName == 'input')
            {
                target.disabled = false;
                inst.trigger.filter('button').
                each(function ()
                {
                    this.disabled = false;
                }).end();
            }
            else if (nodeName == 'div' || nodeName == 'span')
            {
                var inline = $target.children('.' + this._inlineClass);
                inline.children().removeClass('ui-state-disabled');
            }
            this._disabledInputs = $.map(this._disabledInputs, function (value)
            {
                return (value == target_id ? null : value);
            }); // delete entry
        },

        /* Disable the time picker to a jQuery selection.
           @param  target    element - the target input field or division or span */
        _disableTimepicker: function (target)
        {
            var $target = $(target);
            var inst = $.data(target, PROP_NAME);
            if (!$target.hasClass(this.markerClassName))
            {
                return;
            }
            var nodeName = target.nodeName.toLowerCase();
            if (nodeName == 'input')
            {
                target.disabled = true;

                inst.trigger.filter('button').
                each(function ()
                {
                    this.disabled = true;
                }).end();

            }
            else if (nodeName == 'div' || nodeName == 'span')
            {
                var inline = $target.children('.' + this._inlineClass);
                inline.children().addClass('ui-state-disabled');
            }
            this._disabledInputs = $.map(this._disabledInputs, function (value)
            {
                return (value == target ? null : value);
            }); // delete entry
            this._disabledInputs[this._disabledInputs.length] = $target.attr('id');
        },

        /* Is the first field in a jQuery collection disabled as a timepicker?
        @param  target_id element - the target input field or division or span
        @return boolean - true if disabled, false if enabled */
        _isDisabledTimepicker: function (target_id)
        {
            if (!target_id)
            {
                return false;
            }
            for (var i = 0; i < this._disabledInputs.length; i++)
            {
                if (this._disabledInputs[i] == target_id)
                {
                    return true;
                }
            }
            return false;
        },

        /* Check positioning to remain on screen. */
        _checkOffset: function (inst, offset, isFixed)
        {
            var tpWidth = inst.tpDiv.outerWidth();
            var tpHeight = inst.tpDiv.outerHeight();
            var inputWidth = inst.input ? inst.input.outerWidth() : 0;
            var inputHeight = inst.input ? inst.input.outerHeight() : 0;
            var viewWidth = document.documentElement.clientWidth + $(document).scrollLeft();
            var viewHeight = document.documentElement.clientHeight + $(document).scrollTop();

            offset.left -= (this._get(inst, 'isRTL') ? (tpWidth - inputWidth) : 0);
            offset.left -= (isFixed && offset.left == inst.input.offset().left) ? $(document).scrollLeft() : 0;
            offset.top -= (isFixed && offset.top == (inst.input.offset().top + inputHeight)) ? $(document).scrollTop() : 0;

            // now check if datepicker is showing outside window viewport - move to a better place if so.
            offset.left -= Math.min(offset.left, (offset.left + tpWidth > viewWidth && viewWidth > tpWidth) ? Math.abs(offset.left + tpWidth - viewWidth) : 0);
            offset.top -= Math.min(offset.top, (offset.top + tpHeight > viewHeight && viewHeight > tpHeight) ? Math.abs(tpHeight + inputHeight) : 0);

            return offset;
        },

        /* Find an object's position on the screen. */
        _findPos: function (obj)
        {
            var inst = this._getInst(obj);
            var isRTL = this._get(inst, 'isRTL');
            while (obj && (obj.type == 'hidden' || obj.nodeType != 1))
            {
                obj = obj[isRTL ? 'previousSibling' : 'nextSibling'];
            }
            var position = $(obj).offset();
            return [position.left, position.top];
        },

        /* Retrieve the size of left and top borders for an element.
        @param  elem  (jQuery object) the element of interest
        @return  (number[2]) the left and top borders */
        _getBorders: function (elem)
        {
            var convert = function (value)
                {
                    return {
                        thin: 1,
                        medium: 2,
                        thick: 3
                    }[value] || value;
                };
            return [parseFloat(convert(elem.css('border-left-width'))), parseFloat(convert(elem.css('border-top-width')))];
        },


        /* Close time picker if clicked elsewhere. */
        _checkExternalClick: function (event)
        {
            if (!$.timepicker._curInst)
            {
                return;
            }
            var $target = $(event.target);
            if ($target[0].id != $.timepicker._mainDivId && $target.parents('#' + $.timepicker._mainDivId).length == 0 && !$target.hasClass($.timepicker.markerClassName) && !$target.hasClass($.timepicker._triggerClass) && $.timepicker._timepickerShowing && !($.timepicker._inDialog && $.blockUI)) $.timepicker._hideTimepicker();
        },

        /* Hide the time picker from view.
        @param  input  element - the input field attached to the time picker */
        _hideTimepicker: function (input)
        {
            var inst = this._curInst;
            if (!inst || (input && inst != $.data(input, PROP_NAME)))
            {
                return;
            }
            if (this._timepickerShowing)
            {
                var showAnim = this._get(inst, 'showAnim');
                var duration = this._get(inst, 'duration');
                var postProcess = function ()
                    {
                        $.timepicker._tidyDialog(inst);
                        this._curInst = null;
                    };
                if ($.effects && $.effects[showAnim])
                {
                    inst.tpDiv.hide(showAnim, $.timepicker._get(inst, 'showOptions'), duration, postProcess);
                }
                else
                {
                    inst.tpDiv[(showAnim == 'slideDown' ? 'slideUp' : (showAnim == 'fadeIn' ? 'fadeOut' : 'hide'))]((showAnim ? duration : null), postProcess);
                }
                if (!showAnim)
                {
                    postProcess();
                }
                var onClose = this._get(inst, 'onClose');
                if (onClose)
                {
                    onClose.apply(
                    (inst.input ? inst.input[0] : null), [(inst.input ? inst.input.val() : ''), inst]); // trigger custom callback
                }
                this._timepickerShowing = false;
                this._lastInput = null;
                if (this._inDialog)
                {
                    this._dialogInput.css(
                    {
                        position: 'absolute',
                        left: '0',
                        top: '-100px'
                    });
                    if ($.blockUI)
                    {
                        $.unblockUI();
                        $('body').append(this.tpDiv);
                    }
                }
                this._inDialog = false;
            }
        },



        /* Tidy up after a dialog display. */
        _tidyDialog: function (inst)
        {
            inst.tpDiv.removeClass(this._dialogClass).unbind('.ui-timepicker');
        },

        /* Retrieve the instance data for the target control.
        @param  target  element - the target input field or division or span
        @return  object - the associated instance data
        @throws  error if a jQuery problem getting data */
        _getInst: function (target)
        {
            try
            {
                return $.data(target, PROP_NAME);
            }
            catch (err)
            {
                throw 'Missing instance data for this timepicker';
            }
        },

        /* Get a setting value, defaulting if necessary. */
        _get: function (inst, name)
        {
            return inst.settings[name] !== undefined ? inst.settings[name] : this._defaults[name];
        },

        /* Parse existing time and initialise time picker. */
        _setTimeFromField: function (inst)
        {
            if (inst.input.val() == inst.lastVal)
            {
                return;
            }
            var defaultTime = this._get(inst, 'defaultTime');

            var timeToParse = defaultTime == 'now' ? this._getCurrentTimeRounded(inst) : defaultTime;
            if ((inst.inline == false) && (inst.input.val() != ''))
            {
                timeToParse = inst.input.val()
            }

            if (timeToParse instanceof Date)
            {
                inst.hours = timeToParse.getHours();
                inst.minutes = timeToParse.getMinutes();
            }
            else
            {
                var timeVal = inst.lastVal = timeToParse;
                if (timeToParse == '')
                {
                    inst.hours = -1;
                    inst.minutes = -1;
                }
                else
                {
                    var time = this.parseTime(inst, timeVal);
                    inst.hours = time.hours;
                    inst.minutes = time.minutes;
                }
            }


            $.timepicker._updateTimepicker(inst);
        },

        /* Update or retrieve the settings for an existing time picker.
           @param  target  element - the target input field or division or span
           @param  name    object - the new settings to update or
                           string - the name of the setting to change or retrieve,
                           when retrieving also 'all' for all instance settings or
                           'defaults' for all global defaults
           @param  value   any - the new value for the setting
                       (omit if above is an object or to retrieve a value) */
        _optionTimepicker: function (target, name, value)
        {
            var inst = this._getInst(target);
            if (arguments.length == 2 && typeof name == 'string')
            {
                return (name == 'defaults' ? $.extend(
                {}, $.timepicker._defaults) : (inst ? (name == 'all' ? $.extend(
                {}, inst.settings) : this._get(inst, name)) : null));
            }
            var settings = name || {};
            if (typeof name == 'string')
            {
                settings = {};
                settings[name] = value;
            }
            if (inst)
            {
                if (this._curInst == inst)
                {
                    this._hideTimepicker();
                }
                extendRemove(inst.settings, settings);
                this._updateTimepicker(inst);
            }
        },


        /* Set the time for a jQuery selection.
	    @param  target  element - the target input field or division or span
	    @param  time    String - the new time */
        _setTimeTimepicker: function (target, time)
        {
            var inst = this._getInst(target);
            if (inst)
            {
                this._setTime(inst, time);
                this._updateTimepicker(inst);
                this._updateAlternate(inst, time);
            }
        },

        /* Set the time directly. */
        _setTime: function (inst, time, noChange)
        {
            var origHours = inst.hours;
            var origMinutes = inst.minutes;
            var time = this.parseTime(inst, time);
            inst.hours = time.hours;
            inst.minutes = time.minutes;

            if ((origHours != inst.hours || origMinutes != inst.minuts) && !noChange)
            {
                inst.input.trigger('change');
            }
            this._updateTimepicker(inst);
            this._updateSelectedValue(inst);
        },

        /* Return the current time, ready to be parsed, rounded to the closest 5 minute */
        _getCurrentTimeRounded: function (inst)
        {
            var currentTime = new Date(),
                currentMinutes = currentTime.getMinutes(),
                // round to closest 5
                adjustedMinutes = Math.round(currentMinutes / 5) * 5;
            currentTime.setMinutes(adjustedMinutes);
            return currentTime;
        },

        /*
         * Parse a time string into hours and minutes
         */
        parseTime: function (inst, timeVal)
        {
            var retVal = new Object();
            retVal.hours = -1;
            retVal.minutes = -1;

            var timeSeparator = this._get(inst, 'timeSeparator'),
                amPmText = this._get(inst, 'amPmText'),
                showHours = this._get(inst, 'showHours'),
                showMinutes = this._get(inst, 'showMinutes'),
                optionalMinutes = this._get(inst, 'optionalMinutes'),
                showPeriod = (this._get(inst, 'showPeriod') == true),
                p = timeVal.indexOf(timeSeparator);

            // check if time separator found
            if (p != -1)
            {
                retVal.hours = parseInt(timeVal.substr(0, p), 10);
                retVal.minutes = parseInt(timeVal.substr(p + 1), 10);
            }
            // check for hours only
            else if ((showHours) && (!showMinutes || optionalMinutes))
            {
                retVal.hours = parseInt(timeVal, 10);
            }
            // check for minutes only
            else if ((!showHours) && (showMinutes))
            {
                retVal.minutes = parseInt(timeVal, 10);
            }

            if (showHours)
            {
                var timeValUpper = timeVal.toUpperCase();
                if ((retVal.hours < 12) && (showPeriod) && (timeValUpper.indexOf(amPmText[1].toUpperCase()) != -1))
                {
                    retVal.hours += 12;
                }
                // fix for 12 AM
                if ((retVal.hours == 12) && (showPeriod) && (timeValUpper.indexOf(amPmText[0].toUpperCase()) != -1))
                {
                    retVal.hours = 0;
                }
            }

            return retVal;
        },

        selectNow: function (e)
        {

            var id = $(e.target).attr("data-timepicker-instance-id"),
                $target = $(id),
                inst = this._getInst($target[0]);

            //if (!inst || (input && inst != $.data(input, PROP_NAME))) { return; }
            var currentTime = new Date();
            inst.hours = currentTime.getHours();
            inst.minutes = currentTime.getMinutes();
            this._updateSelectedValue(inst);
            this._updateTimepicker(inst);
            this._hideTimepicker();
        },

        deselectTime: function (e)
        {
            var id = $(e.target).attr("data-timepicker-instance-id"),
                $target = $(id),
                inst = this._getInst($target[0]);
            inst.hours = -1;
            inst.minutes = -1;
            this._updateSelectedValue(inst);
            this._hideTimepicker();
        },


        selectHours: function (event)
        {
            var $td = $(event.currentTarget),
                id = $td.attr("data-timepicker-instance-id"),
                newHours = $td.attr("data-hour"),
                fromDoubleClick = event.data.fromDoubleClick,
                $target = $(id),
                inst = this._getInst($target[0]),
                showMinutes = (this._get(inst, 'showMinutes') == true);

            // don't select if disabled
            if ($.timepicker._isDisabledTimepicker($target.attr('id')))
            {
                return false
            }

            $td.parents('.ui-timepicker-hours:first').find('a').removeClass('ui-state-active');
            $td.children('a').addClass('ui-state-active');
            inst.hours = newHours;

            // added for onMinuteShow callback
            var onMinuteShow = this._get(inst, 'onMinuteShow');
            if (onMinuteShow)
            {
                // this will trigger a callback on selected hour to make sure selected minute is allowed. 
                this._updateMinuteDisplay(inst);
            }

            this._updateSelectedValue(inst);

            inst._hoursClicked = true;
            if ((inst._minutesClicked) || (fromDoubleClick) || (showMinutes == false))
            {
                $.timepicker._hideTimepicker();
            }
            // return false because if used inline, prevent the url to change to a hashtag
            return false;
        },

        selectMinutes: function (event)
        {
            var $td = $(event.currentTarget),
                id = $td.attr("data-timepicker-instance-id"),
                newMinutes = $td.attr("data-minute"),
                fromDoubleClick = event.data.fromDoubleClick,
                $target = $(id),
                inst = this._getInst($target[0]),
                showHours = (this._get(inst, 'showHours') == true);

            // don't select if disabled
            if ($.timepicker._isDisabledTimepicker($target.attr('id')))
            {
                return false
            }

            $td.parents('.ui-timepicker-minutes:first').find('a').removeClass('ui-state-active');
            $td.children('a').addClass('ui-state-active');

            inst.minutes = newMinutes;
            this._updateSelectedValue(inst);

            inst._minutesClicked = true;
            if ((inst._hoursClicked) || (fromDoubleClick) || (showHours == false))
            {
                $.timepicker._hideTimepicker();
                // return false because if used inline, prevent the url to change to a hashtag
                return false;
            }

            // return false because if used inline, prevent the url to change to a hashtag
            return false;
        },

        _updateSelectedValue: function (inst)
        {
            var newTime = this._getParsedTime(inst);
            if (inst.input)
            {
                inst.input.val(newTime);
                inst.input.trigger('change');
            }
            var onSelect = this._get(inst, 'onSelect');
            if (onSelect)
            {
                onSelect.apply((inst.input ? inst.input[0] : null), [newTime, inst]);
            } // trigger custom callback
            this._updateAlternate(inst, newTime);
            return newTime;
        },

        /* this function process selected time and return it parsed according to instance options */
        _getParsedTime: function (inst)
        {

            if (inst.hours == -1 && inst.minutes == -1)
            {
                return '';
            }

            if ((inst.hours < 0) || (inst.hours > 23))
            {
                inst.hours = 12;
            }
            if ((inst.minutes < 0) || (inst.minutes > 59))
            {
                inst.minutes = 0;
            }

            var period = "",
                showPeriod = (this._get(inst, 'showPeriod') == true),
                showLeadingZero = (this._get(inst, 'showLeadingZero') == true),
                showHours = (this._get(inst, 'showHours') == true),
                showMinutes = (this._get(inst, 'showMinutes') == true),
                optionalMinutes = (this._get(inst, 'optionalMinutes') == true),
                amPmText = this._get(inst, 'amPmText'),
                selectedHours = inst.hours ? inst.hours : 0,
                selectedMinutes = inst.minutes ? inst.minutes : 0,
                displayHours = selectedHours ? selectedHours : 0,
                parsedTime = '';

            if (showPeriod)
            {
                if (inst.hours == 0)
                {
                    displayHours = 12;
                }
                if (inst.hours < 12)
                {
                    period = amPmText[0];
                }
                else
                {
                    period = amPmText[1];
                    if (displayHours > 12)
                    {
                        displayHours -= 12;
                    }
                }
            }

            var h = displayHours.toString();
            if (showLeadingZero && (displayHours < 10))
            {
                h = '0' + h;
            }

            var m = selectedMinutes.toString();
            if (selectedMinutes < 10)
            {
                m = '0' + m;
            }

            if (showHours)
            {
                parsedTime += h;
            }
            if (showHours && showMinutes && (!optionalMinutes || m != 0))
            {
                parsedTime += this._get(inst, 'timeSeparator');
            }
            if (showMinutes && (!optionalMinutes || m != 0))
            {
                parsedTime += m;
            }
            if (showHours)
            {
                if (period.length > 0)
                {
                    parsedTime += this._get(inst, 'periodSeparator') + period;
                }
            }

            return parsedTime;
        },

        /* Update any alternate field to synchronise with the main field. */
        _updateAlternate: function (inst, newTime)
        {
            var altField = this._get(inst, 'altField');
            if (altField)
            { // update alternate field too
                $(altField).each(function (i, e)
                {
                    $(e).val(newTime);
                });
            }
        },

        /* This might look unused but it's called by the $.fn.timepicker function with param getTime */
        /* added v 0.2.3 - gitHub issue #5 - Thanks edanuff */
        _getTimeTimepicker: function (input)
        {
            var inst = this._getInst(input);
            return this._getParsedTime(inst);
        },
        _getHourTimepicker: function (input)
        {
            var inst = this._getInst(input);
            if (inst == undefined)
            {
                return -1;
            }
            return inst.hours;
        },
        _getMinuteTimepicker: function (input)
        {
            var inst = this._getInst(input);
            if (inst == undefined)
            {
                return -1;
            }
            return inst.minutes;
        }

    });



    /* Invoke the timepicker functionality.
    @param  options  string - a command, optionally followed by additional parameters or
    Object - settings for attaching new timepicker functionality
    @return  jQuery object */
    $.fn.timepicker = function (options)
    {

        /* Initialise the time picker. */
        if (!$.timepicker.initialized)
        {
            $(document).mousedown($.timepicker._checkExternalClick).
            find('body').append($.timepicker.tpDiv);
            $.timepicker.initialized = true;
        }

        var otherArgs = Array.prototype.slice.call(arguments, 1);
        if (typeof options == 'string' && (options == 'getTime' || options == 'getHour' || options == 'getMinute')) return $.timepicker['_' + options + 'Timepicker'].
        apply($.timepicker, [this[0]].concat(otherArgs));
        if (options == 'option' && arguments.length == 2 && typeof arguments[1] == 'string') return $.timepicker['_' + options + 'Timepicker'].
        apply($.timepicker, [this[0]].concat(otherArgs));
        return this.each(function ()
        {
            typeof options == 'string' ? $.timepicker['_' + options + 'Timepicker'].
            apply($.timepicker, [this].concat(otherArgs)) : $.timepicker._attachTimepicker(this, options);
        });
    };

    /* jQuery extend now ignores nulls! */
    function extendRemove(target, props)
    {
        $.extend(target, props);
        for (var name in props)
        if (props[name] == null || props[name] == undefined) target[name] = props[name];
        return target;
    };

    $.timepicker = new Timepicker(); // singleton instance
    $.timepicker.initialized = false;
    $.timepicker.uuid = new Date().getTime();
    $.timepicker.version = "0.2.9";

    // Workaround for #4055
    // Add another global to avoid noConflict issues with inline event handlers
    window['TP_jQuery_' + tpuuid] = $;

})(jQuery);


/*

 FullCalendar v1.5.3
 http://arshaw.com/fullcalendar/

 Use fullcalendar.css for basic styling.
 For event drag & drop, requires jQuery UI draggable.
 For event resizing, requires jQuery UI resizable.

 Copyright (c) 2011 Adam Shaw
 Dual licensed under the MIT and GPL licenses, located in
 MIT-LICENSE.txt and GPL-LICENSE.txt respectively.

 Date: Mon Feb 6 22:40:40 2012 -0800

*/
(function (m, ma)
{
    function wb(a)
    {
        m.extend(true, Ya, a)
    }
    function Yb(a, b, e)
    {
        function d(k)
        {
            if (E)
            {
                u();
                q();
                na();
                S(k)
            }
            else f()
        }
        function f()
        {
            B = b.theme ? "ui" : "fc";
            a.addClass("fc");
            b.isRTL && a.addClass("fc-rtl");
            b.theme && a.addClass("ui-widget");
            E = m("<div class='fc-content' style='position:relative'/>").prependTo(a);
            C = new Zb(X, b);
            (P = C.render()) && a.prepend(P);
            y(b.defaultView);
            m(window).resize(oa);
            t() || g()
        }
        function g()
        {
            setTimeout(function ()
            {
                !n.start && t() && S()
            }, 0)
        }
        function l()
        {
            m(window).unbind("resize", oa);
            C.destroy();
            E.remove();
            a.removeClass("fc fc-rtl ui-widget")
        }
        function j()
        {
            return i.offsetWidth !== 0
        }
        function t()
        {
            return m("body")[0].offsetWidth !== 0
        }
        function y(k)
        {
            if (!n || k != n.name)
            {
                F++;
                pa();
                var D = n,
                    Z;
                if (D)
                {
                    (D.beforeHide || xb)();
                    Za(E, E.height());
                    D.element.hide()
                }
                else Za(E, 1);
                E.css("overflow", "hidden");
                if (n = Y[k]) n.element.show();
                else n = Y[k] = new Ja[k](Z = s = m("<div class='fc-view fc-view-" + k + "' style='position:absolute'/>").appendTo(E), X);
                D && C.deactivateButton(D.name);
                C.activateButton(k);
                S();
                E.css("overflow", "");
                D && Za(E, 1);
                Z || (n.afterShow || xb)();
                F--
            }
        }
        function S(k)
        {
            if (j())
            {
                F++;
                pa();
                o === ma && u();
                var D = false;
                if (!n.start || k || r < n.start || r >= n.end)
                {
                    n.render(r, k || 0);
                    fa(true);
                    D = true
                }
                else if (n.sizeDirty)
                {
                    n.clearEvents();
                    fa();
                    D = true
                }
                else if (n.eventsDirty)
                {
                    n.clearEvents();
                    D = true
                }
                n.sizeDirty = false;
                n.eventsDirty = false;
                ga(D);
                W = a.outerWidth();
                C.updateTitle(n.title);
                k = new Date;
                k >= n.start && k < n.end ? C.disableButton("today") : C.enableButton("today");
                F--;
                n.trigger("viewDisplay", i)
            }
        }
        function Q()
        {
            q();
            if (j())
            {
                u();
                fa();
                pa();
                n.clearEvents();
                n.renderEvents(J);
                n.sizeDirty = false
            }
        }
        function q()
        {
            m.each(Y, function (k, D)
            {
                D.sizeDirty = true
            })
        }
        function u()
        {
            o = b.contentHeight ? b.contentHeight : b.height ? b.height - (P ? P.height() : 0) - Sa(E) : Math.round(E.width() / Math.max(b.aspectRatio, 0.5))
        }
        function fa(k)
        {
            F++;
            n.setHeight(o, k);
            if (s)
            {
                s.css("position", "relative");
                s = null
            }
            n.setWidth(E.width(), k);
            F--
        }
        function oa()
        {
            if (!F) if (n.start)
            {
                var k = ++v;
                setTimeout(function ()
                {
                    if (k == v && !F && j()) if (W != (W = a.outerWidth()))
                    {
                        F++;
                        Q();
                        n.trigger("windowResize", i);
                        F--
                    }
                }, 200)
            }
            else g()
        }
        function ga(k)
        {
            if (!b.lazyFetching || ya(n.visStart, n.visEnd)) ra();
            else k && da()
        }
        function ra()
        {
            K(n.visStart, n.visEnd)
        }
        function sa(k)
        {
            J = k;
            da()
        }
        function ha(k)
        {
            da(k)
        }
        function da(k)
        {
            na();
            if (j())
            {
                n.clearEvents();
                n.renderEvents(J, k);
                n.eventsDirty = false
            }
        }
        function na()
        {
            m.each(Y, function (k, D)
            {
                D.eventsDirty = true
            })
        }
        function ua(k, D, Z)
        {
            n.select(k, D, Z === ma ? true : Z)
        }
        function pa()
        {
            n && n.unselect()
        }
        function U()
        {
            S(-1)
        }
        function ca()
        {
            S(1)
        }
        function ka()
        {
            gb(r, -1);
            S()
        }
        function qa()
        {
            gb(r, 1);
            S()
        }
        function G()
        {
            r = new Date;
            S()
        }
        function p(k, D, Z)
        {
            if (k instanceof Date) r = N(k);
            else yb(r, k, D, Z);
            S()
        }
        function L(k, D, Z)
        {
            k !== ma && gb(r, k);
            D !== ma && hb(r, D);
            Z !== ma && ba(r, Z);
            S()
        }
        function c()
        {
            return N(r)
        }
        function z()
        {
            return n
        }
        function H(k, D)
        {
            if (D === ma) return b[k];
            if (k == "height" || k == "contentHeight" || k == "aspectRatio")
            {
                b[k] = D;
                Q()
            }
        }
        function T(k, D)
        {
            if (b[k]) return b[k].apply(D || i, Array.prototype.slice.call(arguments, 2))
        }
        var X = this;
        X.options = b;
        X.render = d;
        X.destroy = l;
        X.refetchEvents = ra;
        X.reportEvents = sa;
        X.reportEventChange = ha;
        X.rerenderEvents = da;
        X.changeView = y;
        X.select = ua;
        X.unselect = pa;
        X.prev = U;
        X.next = ca;
        X.prevYear = ka;
        X.nextYear = qa;
        X.today = G;
        X.gotoDate = p;
        X.incrementDate = L;
        X.formatDate = function (k, D)
        {
            return Oa(k, D, b)
        };
        X.formatDates = function (k, D, Z)
        {
            return ib(k, D, Z, b)
        };
        X.getDate = c;
        X.getView = z;
        X.option = H;
        X.trigger = T;
        $b.call(X, b, e);
        var ya = X.isFetchNeeded,
            K = X.fetchEvents,
            i = a[0],
            C, P, E, B, n, Y = {},
            W, o, s, v = 0,
            F = 0,
            r = new Date,
            J = [],
            M;
        yb(r, b.year, b.month, b.date);
        b.droppable && m(document).bind("dragstart", function (k, D)
        {
            var Z = k.target,
                ja = m(Z);
            if (!ja.parents(".fc").length)
            {
                var ia = b.dropAccept;
                if (m.isFunction(ia) ? ia.call(Z, ja) : ja.is(ia))
                {
                    M = Z;
                    n.dragStart(M, k, D)
                }
            }
        }).bind("dragstop", function (k, D)
        {
            if (M)
            {
                n.dragStop(M, k, D);
                M = null
            }
        })
    }
    function Zb(a, b)
    {
        function e()
        {
            q = b.theme ? "ui" : "fc";
            if (b.header) return Q = m("<table class='fc-header' style='width:100%'/>").append(m("<tr/>").append(f("left")).append(f("center")).append(f("right")))
        }
        function d()
        {
            Q.remove()
        }
        function f(u)
        {
            var fa = m("<td class='fc-header-" + u + "'/>");
            (u = b.header[u]) && m.each(u.split(" "), function (oa)
            {
                oa > 0 && fa.append("<span class='fc-header-space'/>");
                var ga;
                m.each(this.split(","), function (ra, sa)
                {
                    if (sa == "title")
                    {
                        fa.append("<span class='fc-header-title'><h2>&nbsp;</h2></span>");
                        ga && ga.addClass(q + "-corner-right");
                        ga = null
                    }
                    else
                    {
                        var ha;
                        if (a[sa]) ha = a[sa];
                        else if (Ja[sa]) ha = function ()
                        {
                            na.removeClass(q + "-state-hover");
                            a.changeView(sa)
                        };
                        if (ha)
                        {
                            ra = b.theme ? jb(b.buttonIcons, sa) : null;
                            var da = jb(b.buttonText, sa),
                                na = m("<span class='fc-button fc-button-" + sa + " " + q + "-state-default'><span class='fc-button-inner'><span class='fc-button-content'>" + (ra ? "<span class='fc-icon-wrap'><span class='ui-icon ui-icon-" + ra + "'/></span>" : da) + "</span><span class='fc-button-effect'><span></span></span></span></span>");
                            if (na)
                            {
                                na.click(function ()
                                {
                                    na.hasClass(q + "-state-disabled") || ha()
                                }).mousedown(function ()
                                {
                                    na.not("." + q + "-state-active").not("." + q + "-state-disabled").addClass(q + "-state-down")
                                }).mouseup(function ()
                                {
                                    na.removeClass(q + "-state-down")
                                }).hover(function ()
                                {
                                    na.not("." + q + "-state-active").not("." + q + "-state-disabled").addClass(q + "-state-hover")
                                }, function ()
                                {
                                    na.removeClass(q + "-state-hover").removeClass(q + "-state-down")
                                }).appendTo(fa);
                                ga || na.addClass(q + "-corner-left");
                                ga = na
                            }
                        }
                    }
                });
                ga && ga.addClass(q + "-corner-right")
            });
            return fa
        }
        function g(u)
        {
            Q.find("h2").html(u)
        }
        function l(u)
        {
            Q.find("span.fc-button-" + u).addClass(q + "-state-active")
        }
        function j(u)
        {
            Q.find("span.fc-button-" + u).removeClass(q + "-state-active")
        }
        function t(u)
        {
            Q.find("span.fc-button-" + u).addClass(q + "-state-disabled")
        }
        function y(u)
        {
            Q.find("span.fc-button-" + u).removeClass(q + "-state-disabled")
        }
        var S = this;
        S.render = e;
        S.destroy = d;
        S.updateTitle = g;
        S.activateButton = l;
        S.deactivateButton = j;
        S.disableButton = t;
        S.enableButton = y;
        var Q = m([]),
            q
    }
    function $b(a, b)
    {
        function e(c, z)
        {
            return !ca || c < ca || z > ka
        }
        function d(c, z)
        {
            ca = c;
            ka = z;
            L = [];
            c = ++qa;
            G = z = U.length;
            for (var H = 0; H < z; H++) f(U[H], c)
        }
        function f(c, z)
        {
            g(c, function (H)
            {
                if (z == qa)
                {
                    if (H)
                    {
                        for (var T = 0; T < H.length; T++)
                        {
                            H[T].source = c;
                            oa(H[T])
                        }
                        L = L.concat(H)
                    }
                    G--;
                    G || ua(L)
                }
            })
        }
        function g(c, z)
        {
            var H, T = Aa.sourceFetchers,
                X;
            for (H = 0; H < T.length; H++)
            {
                X = T[H](c, ca, ka, z);
                if (X === true) return;
                else if (typeof X == "object")
                {
                    g(X, z);
                    return
                }
            }
            if (H = c.events) if (m.isFunction(H))
            {
                u();
                H(N(ca), N(ka), function (C)
                {
                    z(C);
                    fa()
                })
            }
            else m.isArray(H) ? z(H) : z();
            else if (c.url)
            {
                var ya = c.success,
                    K = c.error,
                    i = c.complete;
                H = m.extend(
                {}, c.data || {});
                T = Ta(c.startParam, a.startParam);
                X = Ta(c.endParam, a.endParam);
                if (T) H[T] = Math.round(+ca / 1E3);
                if (X) H[X] = Math.round(+ka / 1E3);
                u();
                m.ajax(m.extend(
                {}, ac, c, {
                    data: H,
                    success: function (C)
                    {
                        C = C || [];
                        var P = $a(ya, this, arguments);
                        if (m.isArray(P)) C = P;
                        z(C)
                    },
                    error: function ()
                    {
                        $a(K, this, arguments);
                        z()
                    },
                    complete: function ()
                    {
                        $a(i, this, arguments);
                        fa()
                    }
                }))
            }
            else z()
        }
        function l(c)
        {
            if (c = j(c))
            {
                G++;
                f(c, qa)
            }
        }
        function j(c)
        {
            if (m.isFunction(c) || m.isArray(c)) c = {
                events: c
            };
            else if (typeof c == "string") c = {
                url: c
            };
            if (typeof c == "object")
            {
                ga(c);
                U.push(c);
                return c
            }
        }
        function t(c)
        {
            U = m.grep(U, function (z)
            {
                return !ra(z, c)
            });
            L = m.grep(L, function (z)
            {
                return !ra(z.source, c)
            });
            ua(L)
        }
        function y(c)
        {
            var z, H = L.length,
                T, X = na().defaultEventEnd,
                ya = c.start - c._start,
                K = c.end ? c.end - (c._end || X(c)) : 0;
            for (z = 0; z < H; z++)
            {
                T = L[z];
                if (T._id == c._id && T != c)
                {
                    T.start = new Date(+T.start + ya);
                    T.end = c.end ? T.end ? new Date(+T.end + K) : new Date(+X(T) + K) : null;
                    T.title = c.title;
                    T.url = c.url;
                    T.allDay = c.allDay;
                    T.className = c.className;
                    T.editable = c.editable;
                    T.color = c.color;
                    T.backgroudColor = c.backgroudColor;
                    T.borderColor = c.borderColor;
                    T.textColor = c.textColor;
                    oa(T)
                }
            }
            oa(c);
            ua(L)
        }
        function S(c, z)
        {
            oa(c);
            if (!c.source)
            {
                if (z)
                {
                    pa.events.push(c);
                    c.source = pa
                }
                L.push(c)
            }
            ua(L)
        }
        function Q(c)
        {
            if (c)
            {
                if (!m.isFunction(c))
                {
                    var z = c + "";
                    c = function (T)
                    {
                        return T._id == z
                    }
                }
                L = m.grep(L, c, true);
                for (H = 0; H < U.length; H++) if (m.isArray(U[H].events)) U[H].events = m.grep(U[H].events, c, true)
            }
            else
            {
                L = [];
                for (var H = 0; H < U.length; H++) if (m.isArray(U[H].events)) U[H].events = []
            }
            ua(L)
        }
        function q(c)
        {
            if (m.isFunction(c)) return m.grep(L, c);
            else if (c)
            {
                c += "";
                return m.grep(L, function (z)
                {
                    return z._id == c
                })
            }
            return L
        }
        function u()
        {
            p++ || da("loading", null, true)
        }
        function fa()
        {
            --p || da("loading", null, false)
        }
        function oa(c)
        {
            var z = c.source || {},
                H = Ta(z.ignoreTimezone, a.ignoreTimezone);
            c._id = c._id || (c.id === ma ? "_fc" + bc++ : c.id + "");
            if (c.date)
            {
                if (!c.start) c.start = c.date;
                delete c.date
            }
            c._start = N(c.start = kb(c.start, H));
            c.end = kb(c.end, H);
            if (c.end && c.end <= c.start) c.end = null;
            c._end = c.end ? N(c.end) : null;
            if (c.allDay === ma) c.allDay = Ta(z.allDayDefault, a.allDayDefault);
            if (c.className)
            {
                if (typeof c.className == "string") c.className = c.className.split(/\s+/)
            }
            else c.className = []
        }
        function ga(c)
        {
            if (c.className)
            {
                if (typeof c.className == "string") c.className = c.className.split(/\s+/)
            }
            else c.className = [];
            for (var z = Aa.sourceNormalizers, H = 0; H < z.length; H++) z[H](c)
        }
        function ra(c, z)
        {
            return c && z && sa(c) == sa(z)
        }
        function sa(c)
        {
            return (typeof c == "object" ? c.events || c.url : "") || c
        }
        var ha = this;
        ha.isFetchNeeded = e;
        ha.fetchEvents = d;
        ha.addEventSource = l;
        ha.removeEventSource = t;
        ha.updateEvent = y;
        ha.renderEvent = S;
        ha.removeEvents = Q;
        ha.clientEvents = q;
        ha.normalizeEvent = oa;
        var da = ha.trigger,
            na = ha.getView,
            ua = ha.reportEvents,
            pa = {
                events: []
            },
            U = [pa],
            ca, ka, qa = 0,
            G = 0,
            p = 0,
            L = [];
        for (ha = 0; ha < b.length; ha++) j(b[ha])
    }
    function gb(a, b, e)
    {
        a.setFullYear(a.getFullYear() + b);
        e || Ka(a);
        return a
    }
    function hb(a, b, e)
    {
        if (+a)
        {
            b = a.getMonth() + b;
            var d = N(a);
            d.setDate(1);
            d.setMonth(b);
            a.setMonth(b);
            for (e || Ka(a); a.getMonth() != d.getMonth();) a.setDate(a.getDate() + (a < d ? 1 : -1))
        }
        return a
    }
    function ba(a, b, e)
    {
        if (+a)
        {
            b = a.getDate() + b;
            var d = N(a);
            d.setHours(9);
            d.setDate(b);
            a.setDate(b);
            e || Ka(a);
            lb(a, d)
        }
        return a
    }
    function lb(a, b)
    {
        if (+a) for (; a.getDate() != b.getDate();) a.setTime(+a + (a < b ? 1 : -1) * cc)
    }
    function xa(a, b)
    {
        a.setMinutes(a.getMinutes() + b);
        return a
    }
    function Ka(a)
    {
        a.setHours(0);
        a.setMinutes(0);
        a.setSeconds(0);
        a.setMilliseconds(0);
        return a
    }
    function N(a, b)
    {
        if (b) return Ka(new Date(+a));
        return new Date(+a)
    }
    function zb()
    {
        var a = 0,
            b;
        do b = new Date(1970, a++, 1);
        while (b.getHours());
        return b
    }
    function Fa(a, b, e)
    {
        for (b = b || 1; !a.getDay() || e && a.getDay() == 1 || !e && a.getDay() == 6;) ba(a, b);
        return a
    }
    function Ca(a, b)
    {
        return Math.round((N(a, true) - N(b, true)) / Ab)
    }
    function yb(a, b, e, d)
    {
        if (b !== ma && b != a.getFullYear())
        {
            a.setDate(1);
            a.setMonth(0);
            a.setFullYear(b)
        }
        if (e !== ma && e != a.getMonth())
        {
            a.setDate(1);
            a.setMonth(e)
        }
        d !== ma && a.setDate(d)
    }
    function kb(a, b)
    {
        if (typeof a == "object") return a;
        if (typeof a == "number") return new Date(a * 1E3);
        if (typeof a == "string")
        {
            if (a.match(/^\d+(\.\d+)?$/)) return new Date(parseFloat(a) * 1E3);
            if (b === ma) b = true;
            return Bb(a, b) || (a ? new Date(a) : null)
        }
        return null
    }
    function Bb(a, b)
    {
        a = a.match(/^([0-9]{4})(-([0-9]{2})(-([0-9]{2})([T ]([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?(Z|(([-+])([0-9]{2})(:?([0-9]{2}))?))?)?)?)?$/);
        if (!a) return null;
        var e = new Date(a[1], 0, 1);
        if (b || !a[13])
        {
            b = new Date(a[1], 0, 1, 9, 0);
            if (a[3])
            {
                e.setMonth(a[3] - 1);
                b.setMonth(a[3] - 1)
            }
            if (a[5])
            {
                e.setDate(a[5]);
                b.setDate(a[5])
            }
            lb(e, b);
            a[7] && e.setHours(a[7]);
            a[8] && e.setMinutes(a[8]);
            a[10] && e.setSeconds(a[10]);
            a[12] && e.setMilliseconds(Number("0." + a[12]) * 1E3);
            lb(e, b)
        }
        else
        {
            e.setUTCFullYear(a[1], a[3] ? a[3] - 1 : 0, a[5] || 1);
            e.setUTCHours(a[7] || 0, a[8] || 0, a[10] || 0, a[12] ? Number("0." + a[12]) * 1E3 : 0);
            if (a[14])
            {
                b = Number(a[16]) * 60 + (a[18] ? Number(a[18]) : 0);
                b *= a[15] == "-" ? 1 : -1;
                e = new Date(+e + b * 60 * 1E3)
            }
        }
        return e
    }
    function mb(a)
    {
        if (typeof a == "number") return a * 60;
        if (typeof a == "object") return a.getHours() * 60 + a.getMinutes();
        if (a = a.match(/(\d+)(?::(\d+))?\s*(\w+)?/))
        {
            var b = parseInt(a[1], 10);
            if (a[3])
            {
                b %= 12;
                if (a[3].toLowerCase().charAt(0) == "p") b += 12
            }
            return b * 60 + (a[2] ? parseInt(a[2], 10) : 0)
        }
    }
    function Oa(a, b, e)
    {
        return ib(a, null, b, e)
    }
    function ib(a, b, e, d)
    {
        d = d || Ya;
        var f = a,
            g = b,
            l, j = e.length,
            t, y, S, Q = "";
        for (l = 0; l < j; l++)
        {
            t = e.charAt(l);
            if (t == "'") for (y = l + 1; y < j; y++)
            {
                if (e.charAt(y) == "'")
                {
                    if (f)
                    {
                        Q += y == l + 1 ? "'" : e.substring(l + 1, y);
                        l = y
                    }
                    break
                }
            }
            else if (t == "(") for (y = l + 1; y < j; y++)
            {
                if (e.charAt(y) == ")")
                {
                    l = Oa(f, e.substring(l + 1, y), d);
                    if (parseInt(l.replace(/\D/, ""), 10)) Q += l;
                    l = y;
                    break
                }
            }
            else if (t == "[") for (y = l + 1; y < j; y++)
            {
                if (e.charAt(y) == "]")
                {
                    t = e.substring(l + 1, y);
                    l = Oa(f, t, d);
                    if (l != Oa(g, t, d)) Q += l;
                    l = y;
                    break
                }
            }
            else if (t == "{")
            {
                f = b;
                g = a
            }
            else if (t == "}")
            {
                f = a;
                g = b
            }
            else
            {
                for (y = j; y > l; y--) if (S = dc[e.substring(l, y)])
                {
                    if (f) Q += S(f, d);
                    l = y - 1;
                    break
                }
                if (y == l) if (f) Q += t
            }
        }
        return Q
    }
    function Ua(a)
    {
        return a.end ? ec(a.end, a.allDay) : ba(N(a.start), 1)
    }
    function ec(a, b)
    {
        a = N(a);
        return b || a.getHours() || a.getMinutes() ? ba(a, 1) : Ka(a)
    }
    function fc(a, b)
    {
        return (b.msLength - a.msLength) * 100 + (a.event.start - b.event.start)
    }
    function Cb(a, b)
    {
        return a.end > b.start && a.start < b.end
    }
    function nb(a, b, e, d)
    {
        var f = [],
            g, l = a.length,
            j, t, y, S, Q;
        for (g = 0; g < l; g++)
        {
            j = a[g];
            t = j.start;
            y = b[g];
            if (y > e && t < d)
            {
                if (t < e)
                {
                    t = N(e);
                    S = false
                }
                else
                {
                    t = t;
                    S = true
                }
                if (y > d)
                {
                    y = N(d);
                    Q = false
                }
                else
                {
                    y = y;
                    Q = true
                }
                f.push(
                {
                    event: j,
                    start: t,
                    end: y,
                    isStart: S,
                    isEnd: Q,
                    msLength: y - t
                })
            }
        }
        return f.sort(fc)
    }
    function ob(a)
    {
        var b = [],
            e, d = a.length,
            f, g, l, j;
        for (e = 0; e < d; e++)
        {
            f = a[e];
            for (g = 0;;)
            {
                l = false;
                if (b[g]) for (j = 0; j < b[g].length; j++) if (Cb(b[g][j], f))
                {
                    l = true;
                    break
                }
                if (l) g++;
                else break
            }
            if (b[g]) b[g].push(f);
            else b[g] = [f]
        }
        return b
    }
    function Db(a, b, e)
    {
        a.unbind("mouseover").mouseover(function (d)
        {
            for (var f = d.target, g; f != this;)
            {
                g = f;
                f = f.parentNode
            }
            if ((f = g._fci) !== ma)
            {
                g._fci = ma;
                g = b[f];
                e(g.event, g.element, g);
                m(d.target).trigger(d)
            }
            d.stopPropagation()
        })
    }
    function Va(a, b, e)
    {
        for (var d = 0, f; d < a.length; d++)
        {
            f = m(a[d]);
            f.width(Math.max(0, b - pb(f, e)))
        }
    }
    function Eb(a, b, e)
    {
        for (var d = 0, f; d < a.length; d++)
        {
            f = m(a[d]);
            f.height(Math.max(0, b - Sa(f, e)))
        }
    }
    function pb(a, b)
    {
        return gc(a) + hc(a) + (b ? ic(a) : 0)
    }
    function gc(a)
    {
        return (parseFloat(m.curCSS(a[0], "paddingLeft", true)) || 0) + (parseFloat(m.curCSS(a[0], "paddingRight", true)) || 0)
    }
    function ic(a)
    {
        return (parseFloat(m.curCSS(a[0], "marginLeft", true)) || 0) + (parseFloat(m.curCSS(a[0], "marginRight", true)) || 0)
    }
    function hc(a)
    {
        return (parseFloat(m.curCSS(a[0], "borderLeftWidth", true)) || 0) + (parseFloat(m.curCSS(a[0], "borderRightWidth", true)) || 0)
    }
    function Sa(a, b)
    {
        return jc(a) + kc(a) + (b ? Fb(a) : 0)
    }
    function jc(a)
    {
        return (parseFloat(m.curCSS(a[0], "paddingTop", true)) || 0) + (parseFloat(m.curCSS(a[0], "paddingBottom", true)) || 0)
    }
    function Fb(a)
    {
        return (parseFloat(m.curCSS(a[0], "marginTop", true)) || 0) + (parseFloat(m.curCSS(a[0], "marginBottom", true)) || 0)
    }

    function kc(a)
    {
        return (parseFloat(m.curCSS(a[0], "borderTopWidth", true)) || 0) + (parseFloat(m.curCSS(a[0], "borderBottomWidth", true)) || 0)
    }
    function Za(a, b)
    {
        b = typeof b == "number" ? b + "px" : b;
        a.each(function (e, d)
        {
            d.style.cssText += ";min-height:" + b + ";_height:" + b
        })
    }
    function xb()
    {}
    function Gb(a, b)
    {
        return a - b
    }
    function Hb(a)
    {
        return Math.max.apply(Math, a)
    }
    function Pa(a)
    {
        return (a < 10 ? "0" : "") + a
    }
    function jb(a, b)
    {
        if (a[b] !== ma) return a[b];
        b = b.split(/(?=[A-Z])/);
        for (var e = b.length - 1, d; e >= 0; e--)
        {
            d = a[b[e].toLowerCase()];
            if (d !== ma) return d
        }
        return a[""]
    }
    function Qa(a)
    {
        return a.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&#039;").replace(/"/g, "&quot;").replace(/\n/g, "<br />")
    }
    function Ib(a)
    {
        return a.id + "/" + a.className + "/" + a.style.cssText.replace(/(^|;)\s*(top|left|width|height)\s*:[^;]*/ig, "")
    }
    function qb(a)
    {
        a.attr("unselectable", "on").css("MozUserSelect", "none").bind("selectstart.ui", function ()
        {
            return false
        })
    }
    function ab(a)
    {
        a.children().removeClass("fc-first fc-last").filter(":first-child").addClass("fc-first").end().filter(":last-child").addClass("fc-last")
    }

    function rb(a, b)
    {
        a.each(function (e, d)
        {
            d.className = d.className.replace(/^fc-\w*/, "fc-" + lc[b.getDay()])
        })
    }
    function Jb(a, b)
    {
        var e = a.source || {},
            d = a.color,
            f = e.color,
            g = b("eventColor"),
            l = a.backgroundColor || d || e.backgroundColor || f || b("eventBackgroundColor") || g;
        d = a.borderColor || d || e.borderColor || f || b("eventBorderColor") || g;
        a = a.textColor || e.textColor || b("eventTextColor");
        b = [];
        l && b.push("background-color:" + l);
        d && b.push("border-color:" + d);
        a && b.push("color:" + a);
        return b.join(";")
    }
    function $a(a, b, e)
    {
        if (m.isFunction(a)) a = [a];
        if (a)
        {
            var d, f;
            for (d = 0; d < a.length; d++) f = a[d].apply(b, e) || f;
            return f
        }
    }
    function Ta()
    {
        for (var a = 0; a < arguments.length; a++) if (arguments[a] !== ma) return arguments[a]
    }
    function mc(a, b)
    {
        function e(j, t)
        {
            if (t)
            {
                hb(j, t);
                j.setDate(1)
            }
            j = N(j, true);
            j.setDate(1);
            t = hb(N(j), 1);
            var y = N(j),
                S = N(t),
                Q = f("firstDay"),
                q = f("weekends") ? 0 : 1;
            if (q)
            {
                Fa(y);
                Fa(S, -1, true)
            }
            ba(y, -((y.getDay() - Math.max(Q, q) + 7) % 7));
            ba(S, (7 - S.getDay() + Math.max(Q, q)) % 7);
            Q = Math.round((S - y) / (Ab * 7));
            if (f("weekMode") == "fixed")
            {
                ba(S, (6 - Q) * 7);
                Q = 6
            }
            d.title = l(j, f("titleFormat"));
            d.start = j;
            d.end = t;
            d.visStart = y;
            d.visEnd = S;
            g(6, Q, q ? 5 : 7, true)
        }
        var d = this;
        d.render = e;
        sb.call(d, a, b, "month");
        var f = d.opt,
            g = d.renderBasic,
            l = b.formatDate
    }
    function nc(a, b)
    {
        function e(j, t)
        {
            t && ba(j, t * 7);
            j = ba(N(j), -((j.getDay() - f("firstDay") + 7) % 7));
            t = ba(N(j), 7);
            var y = N(j),
                S = N(t),
                Q = f("weekends");
            if (!Q)
            {
                Fa(y);
                Fa(S, -1, true)
            }
            d.title = l(y, ba(N(S), -1), f("titleFormat"));
            d.start = j;
            d.end = t;
            d.visStart = y;
            d.visEnd = S;
            g(1, 1, Q ? 7 : 5, false)
        }
        var d = this;
        d.render = e;
        sb.call(d, a, b, "basicWeek");
        var f = d.opt,
            g = d.renderBasic,
            l = b.formatDates
    }
    function oc(a, b)
    {
        function e(j, t)
        {
            if (t)
            {
                ba(j, t);
                f("weekends") || Fa(j, t < 0 ? -1 : 1)
            }
            d.title = l(j, f("titleFormat"));
            d.start = d.visStart = N(j, true);
            d.end = d.visEnd = ba(N(d.start), 1);
            g(1, 1, 1, false)
        }
        var d = this;
        d.render = e;
        sb.call(d, a, b, "basicDay");
        var f = d.opt,
            g = d.renderBasic,
            l = b.formatDate
    }
    function sb(a, b, e)
    {
        function d(w, I, R, V)
        {
            v = I;
            F = R;
            f();
            (I = !C) ? g(w, V) : z();
            l(I)
        }
        function f()
        {
            if (k = L("isRTL"))
            {
                D = -1;
                Z = F - 1
            }
            else
            {
                D = 1;
                Z = 0
            }
            ja = L("firstDay");
            ia = L("weekends") ? 0 : 1;
            la = L("theme") ? "ui" : "fc";
            $ = L("columnFormat")
        }
        function g(w, I)
        {
            var R, V = la + "-widget-header",
                ea = la + "-widget-content",
                aa;
            R = "<table class='fc-border-separate' style='width:100%' cellspacing='0'><thead><tr>";
            for (aa = 0; aa < F; aa++) R += "<th class='fc- " + V + "'/>";
            R += "</tr></thead><tbody>";
            for (aa = 0; aa < w; aa++)
            {
                R += "<tr class='fc-week" + aa + "'>";
                for (V = 0; V < F; V++) R += "<td class='fc- " + ea + " fc-day" + (aa * F + V) + "'><div>" + (I ? "<div class='fc-day-number'/>" : "") + "<div class='fc-day-content'><div style='position:relative'>&nbsp;</div></div></div></td>";
                R += "</tr>"
            }
            R += "</tbody></table>";
            w = m(R).appendTo(a);
            K = w.find("thead");
            i = K.find("th");
            C = w.find("tbody");
            P = C.find("tr");
            E = C.find("td");
            B = E.filter(":first-child");
            n = P.eq(0).find("div.fc-day-content div");
            ab(K.add(K.find("tr")));
            ab(P);
            P.eq(0).addClass("fc-first");
            y(E);
            Y = m("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(a)
        }
        function l(w)
        {
            var I = w || v == 1,
                R = p.start.getMonth(),
                V = Ka(new Date),
                ea, aa, va;
            I && i.each(function (wa, Ga)
            {
                ea = m(Ga);
                aa = ca(wa);
                ea.html(ya(aa, $));
                rb(ea, aa)
            });
            E.each(function (wa, Ga)
            {
                ea = m(Ga);
                aa = ca(wa);
                aa.getMonth() == R ? ea.removeClass("fc-other-month") : ea.addClass("fc-other-month"); + aa == +V ? ea.addClass(la + "-state-highlight fc-today") : ea.removeClass(la + "-state-highlight fc-today");
                ea.find("div.fc-day-number").text(aa.getDate());
                I && rb(ea, aa)
            });
            P.each(function (wa, Ga)
            {
                va = m(Ga);
                if (wa < v)
                {
                    va.show();
                    wa == v - 1 ? va.addClass("fc-last") : va.removeClass("fc-last")
                }
                else va.hide()
            })
        }
        function j(w)
        {
            o = w;
            w = o - K.height();
            var I, R, V;
            if (L("weekMode") == "variable") I = R = Math.floor(w / (v == 1 ? 2 : 6));
            else
            {
                I = Math.floor(w / v);
                R = w - I * (v - 1)
            }
            B.each(function (ea, aa)
            {
                if (ea < v)
                {
                    V = m(aa);
                    Za(V.find("> div"), (ea == v - 1 ? R : I) - Sa(V))
                }
            })
        }
        function t(w)
        {
            W = w;
            M.clear();
            s = Math.floor(W / F);
            Va(i.slice(0, -1), s)
        }
        function y(w)
        {
            w.click(S).mousedown(X)
        }
        function S(w)
        {
            if (!L("selectable"))
            {
                var I = parseInt(this.className.match(/fc\-day(\d+)/)[1]);
                I = ca(I);
                c("dayClick", this, I, true, w)
            }
        }
        function Q(w, I, R)
        {
            R && r.build();
            R = N(p.visStart);
            for (var V = ba(N(R), F), ea = 0; ea < v; ea++)
            {
                var aa = new Date(Math.max(R, w)),
                    va = new Date(Math.min(V, I));
                if (aa < va)
                {
                    var wa;
                    if (k)
                    {
                        wa = Ca(va, R) * D + Z + 1;
                        aa = Ca(aa, R) * D + Z + 1
                    }
                    else
                    {
                        wa = Ca(aa, R);
                        aa = Ca(va, R)
                    }
                    y(q(ea, wa, ea, aa - 1))
                }
                ba(R, 7);
                ba(V, 7)
            }
        }
        function q(w, I, R, V)
        {
            w = r.rect(w, I, R, V, a);
            return H(w, a)
        }
        function u(w)
        {
            return N(w)
        }
        function fa(w, I)
        {
            Q(w, ba(N(I), 1), true)
        }
        function oa()
        {
            T()
        }
        function ga(w, I, R)
        {
            var V = ua(w);
            c("dayClick", E[V.row * F + V.col], w, I, R)
        }
        function ra(w, I)
        {
            J.start(function (R)
            {
                T();
                R && q(R.row, R.col, R.row, R.col)
            }, I)
        }
        function sa(w, I, R)
        {
            var V = J.stop();
            T();
            if (V)
            {
                V = pa(V);
                c("drop", w, V, true, I, R)
            }
        }
        function ha(w)
        {
            return N(w.start)
        }
        function da(w)
        {
            return M.left(w)
        }
        function na(w)
        {
            return M.right(w)
        }

        function ua(w)
        {
            return {
                row: Math.floor(Ca(w, p.visStart) / 7),
                col: ka(w.getDay())
            }
        }
        function pa(w)
        {
            return U(w.row, w.col)
        }
        function U(w, I)
        {
            return ba(N(p.visStart), w * 7 + I * D + Z)
        }
        function ca(w)
        {
            return U(Math.floor(w / F), w % F)
        }
        function ka(w)
        {
            return (w - Math.max(ja, ia) + F) % F * D + Z
        }
        function qa(w)
        {
            return P.eq(w)
        }
        function G()
        {
            return {
                left: 0,
                right: W
            }
        }
        var p = this;
        p.renderBasic = d;
        p.setHeight = j;
        p.setWidth = t;
        p.renderDayOverlay = Q;
        p.defaultSelectionEnd = u;
        p.renderSelection = fa;
        p.clearSelection = oa;
        p.reportDayClick = ga;
        p.dragStart = ra;
        p.dragStop = sa;
        p.defaultEventEnd = ha;
        p.getHoverListener = function ()
        {
            return J
        };
        p.colContentLeft = da;
        p.colContentRight = na;
        p.dayOfWeekCol = ka;
        p.dateCell = ua;
        p.cellDate = pa;
        p.cellIsAllDay = function ()
        {
            return true
        };
        p.allDayRow = qa;
        p.allDayBounds = G;
        p.getRowCnt = function ()
        {
            return v
        };
        p.getColCnt = function ()
        {
            return F
        };
        p.getColWidth = function ()
        {
            return s
        };
        p.getDaySegmentContainer = function ()
        {
            return Y
        };
        Kb.call(p, a, b, e);
        Lb.call(p);
        Mb.call(p);
        pc.call(p);
        var L = p.opt,
            c = p.trigger,
            z = p.clearEvents,
            H = p.renderOverlay,
            T = p.clearOverlays,
            X = p.daySelectionMousedown,
            ya = b.formatDate,
            K, i, C, P, E, B, n, Y, W, o, s, v, F, r, J, M, k, D, Z, ja, ia, la, $;
        qb(a.addClass("fc-grid"));
        r = new Nb(function (w, I)
        {
            var R, V, ea;
            i.each(function (aa, va)
            {
                R = m(va);
                V = R.offset().left;
                if (aa) ea[1] = V;
                ea = [V];
                I[aa] = ea
            });
            ea[1] = V + R.outerWidth();
            P.each(function (aa, va)
            {
                if (aa < v)
                {
                    R = m(va);
                    V = R.offset().top;
                    if (aa) ea[1] = V;
                    ea = [V];
                    w[aa] = ea
                }
            });
            ea[1] = V + R.outerHeight()
        });
        J = new Ob(r);
        M = new Pb(function (w)
        {
            return n.eq(w)
        })
    }
    function pc()
    {
        function a(U, ca)
        {
            S(U);
            ua(e(U), ca)
        }
        function b()
        {
            Q();
            ga().empty()
        }
        function e(U)
        {
            var ca = da(),
                ka = na(),
                qa = N(g.visStart);
            ka = ba(N(qa), ka);
            var G = m.map(U, Ua),
                p, L, c, z, H, T, X = [];
            for (p = 0; p < ca; p++)
            {
                L = ob(nb(U, G, qa, ka));
                for (c = 0; c < L.length; c++)
                {
                    z = L[c];
                    for (H = 0; H < z.length; H++)
                    {
                        T = z[H];
                        T.row = p;
                        T.level = c;
                        X.push(T)
                    }
                }
                ba(qa, 7);
                ba(ka, 7)
            }
            return X
        }
        function d(U, ca, ka)
        {
            t(U) && f(U, ca);
            ka.isEnd && y(U) && pa(U, ca, ka);
            q(U, ca)
        }
        function f(U, ca)
        {
            var ka = ra(),
                qa;
            ca.draggable(
            {
                zIndex: 9,
                delay: 50,
                opacity: l("dragOpacity"),
                revertDuration: l("dragRevertDuration"),
                start: function (G, p)
                {
                    j("eventDragStart", ca, U, G, p);
                    fa(U, ca);
                    ka.start(function (L, c, z, H)
                    {
                        ca.draggable("option", "revert", !L || !z && !H);
                        ha();
                        if (L)
                        {
                            qa = z * 7 + H * (l("isRTL") ? -1 : 1);
                            sa(ba(N(U.start), qa), ba(Ua(U), qa))
                        }
                        else qa = 0
                    }, G, "drag")
                },
                stop: function (G, p)
                {
                    ka.stop();
                    ha();
                    j("eventDragStop", ca, U, G, p);
                    if (qa) oa(this, U, qa, 0, U.allDay, G, p);
                    else
                    {
                        ca.css("filter", "");
                        u(U, ca)
                    }
                }
            })
        }
        var g = this;
        g.renderEvents = a;
        g.compileDaySegs = e;
        g.clearEvents = b;
        g.bindDaySeg = d;
        Qb.call(g);
        var l = g.opt,
            j = g.trigger,
            t = g.isEventDraggable,
            y = g.isEventResizable,
            S = g.reportEvents,
            Q = g.reportEventClear,
            q = g.eventElementHandlers,
            u = g.showEvents,
            fa = g.hideEvents,
            oa = g.eventDrop,
            ga = g.getDaySegmentContainer,
            ra = g.getHoverListener,
            sa = g.renderDayOverlay,
            ha = g.clearOverlays,
            da = g.getRowCnt,
            na = g.getColCnt,
            ua = g.renderDaySegs,
            pa = g.resizableDayEvent
    }
    function qc(a, b)
    {
        function e(j, t)
        {
            t && ba(j, t * 7);
            j = ba(N(j), -((j.getDay() - f("firstDay") + 7) % 7));
            t = ba(N(j), 7);
            var y = N(j),
                S = N(t),
                Q = f("weekends");
            if (!Q)
            {
                Fa(y);
                Fa(S, -1, true)
            }
            d.title = l(y, ba(N(S), -1), f("titleFormat"));
            d.start = j;
            d.end = t;
            d.visStart = y;
            d.visEnd = S;
            g(Q ? 7 : 5)
        }
        var d = this;
        d.render = e;
        Rb.call(d, a, b, "agendaWeek");
        var f = d.opt,
            g = d.renderAgenda,
            l = b.formatDates
    }
    function rc(a, b)
    {
        function e(j, t)
        {
            if (t)
            {
                ba(j, t);
                f("weekends") || Fa(j, t < 0 ? -1 : 1)
            }
            t = N(j, true);
            var y = ba(N(t), 1);
            d.title = l(j, f("titleFormat"));
            d.start = d.visStart = t;
            d.end = d.visEnd = y;
            g(1)
        }
        var d = this;
        d.render = e;
        Rb.call(d, a, b, "agendaDay");
        var f = d.opt,
            g = d.renderAgenda,
            l = b.formatDate
    }
    function Rb(a, b, e)
    {
        function d(h)
        {
            Ba = h;
            f();
            v ? P() : g();
            l()
        }
        function f()
        {
            Wa = i("theme") ? "ui" : "fc";
            Sb = i("weekends") ? 0 : 1;
            Tb = i("firstDay");
            if (Ub = i("isRTL"))
            {
                Ha = -1;
                Ia = Ba - 1
            }
            else
            {
                Ha = 1;
                Ia = 0
            }
            La = mb(i("minTime"));
            bb = mb(i("maxTime"));
            Vb = i("columnFormat")
        }
        function g()
        {
            var h = Wa + "-widget-header",
                O = Wa + "-widget-content",
                x, A, ta, za, Da, Ea = i("slotMinutes") % 15 == 0;
            x = "<table style='width:100%' class='fc-agenda-days fc-border-separate' cellspacing='0'><thead><tr><th class='fc-agenda-axis " + h + "'>&nbsp;</th>";
            for (A = 0; A < Ba; A++) x += "<th class='fc- fc-col" + A + " " + h + "'/>";
            x += "<th class='fc-agenda-gutter " + h + "'>&nbsp;</th></tr></thead><tbody><tr><th class='fc-agenda-axis " + h + "'>&nbsp;</th>";
            for (A = 0; A < Ba; A++) x += "<td class='fc- fc-col" + A + " " + O + "'><div><div class='fc-day-content'><div style='position:relative'>&nbsp;</div></div></div></td>";
            x += "<td class='fc-agenda-gutter " + O + "'>&nbsp;</td></tr></tbody></table>";
            v = m(x).appendTo(a);
            F = v.find("thead");
            r = F.find("th").slice(1, -1);
            J = v.find("tbody");
            M = J.find("td").slice(0, -1);
            k = M.find("div.fc-day-content div");
            D = M.eq(0);
            Z = D.find("> div");
            ab(F.add(F.find("tr")));
            ab(J.add(J.find("tr")));
            aa = F.find("th:first");
            va = v.find(".fc-agenda-gutter");
            ja = m("<div style='position:absolute;z-index:2;left:0;width:100%'/>").appendTo(a);
            if (i("allDaySlot"))
            {
                ia = m("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(ja);
                x = "<table style='width:100%' class='fc-agenda-allday' cellspacing='0'><tr><th class='" + h + " fc-agenda-axis'>" + i("allDayText") + "</th><td><div class='fc-day-content'><div style='position:relative'/></div></td><th class='" + h + " fc-agenda-gutter'>&nbsp;</th></tr></table>";
                la = m(x).appendTo(ja);
                $ = la.find("tr");
                q($.find("td"));
                aa = aa.add(la.find("th:first"));
                va = va.add(la.find("th.fc-agenda-gutter"));
                ja.append("<div class='fc-agenda-divider " + h + "'><div class='fc-agenda-divider-inner'/></div>")
            }
            else ia = m([]);
            w = m("<div style='position:absolute;width:100%;overflow-x:hidden;overflow-y:auto'/>").appendTo(ja);
            I = m("<div style='position:relative;width:100%;overflow:hidden'/>").appendTo(w);
            R = m("<div style='position:absolute;z-index:8;top:0;left:0'/>").appendTo(I);
            x = "<table class='fc-agenda-slots' style='width:100%' cellspacing='0'><tbody>";
            ta = zb();
            za = xa(N(ta), bb);
            xa(ta, La);
            for (A = tb = 0; ta < za; A++)
            {
                Da = ta.getMinutes();
                x += "<tr class='fc-slot" + A + " " + (!Da ? "" : "fc-minor") + "'><th class='fc-agenda-axis " + h + "'>" + (!Ea || !Da ? s(ta, i("axisFormat")) : "&nbsp;") + "</th><td class='" + O + "'><div style='position:relative'>&nbsp;</div></td></tr>";
                xa(ta, i("slotMinutes"));
                tb++
            }
            x += "</tbody></table>";
            V = m(x).appendTo(I);
            ea = V.find("div:first");
            u(V.find("td"));
            aa = aa.add(V.find("th:first"))
        }
        function l()
        {
            var h, O, x, A, ta = Ka(new Date);
            for (h = 0; h < Ba; h++)
            {
                A = ua(h);
                O = r.eq(h);
                O.html(s(A, Vb));
                x = M.eq(h); + A == +ta ? x.addClass(Wa + "-state-highlight fc-today") : x.removeClass(Wa + "-state-highlight fc-today");
                rb(O.add(x), A)
            }
        }
        function j(h, O)
        {
            if (h === ma) h = Wb;
            Wb = h;
            ub = {};
            var x = J.position().top,
                A = w.position().top;
            h = Math.min(h - x, V.height() + A + 1);
            Z.height(h - Sa(D));
            ja.css("top", x);
            w.height(h - A - 1);
            Xa = ea.height() + 1;
            O && y()
        }
        function t(h)
        {
            Ga = h;
            cb.clear();
            Ma = 0;
            Va(aa.width("").each(function (O, x)
            {
                Ma = Math.max(Ma, m(x).outerWidth())
            }), Ma);
            h = w[0].clientWidth;
            if (vb = w.width() - h)
            {
                Va(va, vb);
                va.show().prev().removeClass("fc-last")
            }
            else va.hide().prev().addClass("fc-last");
            db = Math.floor((h - Ma) / Ba);
            Va(r.slice(0, -1), db)
        }
        function y()
        {
            function h()
            {
                w.scrollTop(A)
            }
            var O = zb(),
                x = N(O);
            x.setHours(i("firstHour"));
            var A = ca(O, x) + 1;
            h();
            setTimeout(h, 0)
        }
        function S()
        {
            Xb = w.scrollTop()
        }
        function Q()
        {
            w.scrollTop(Xb)
        }
        function q(h)
        {
            h.click(fa).mousedown(W)
        }
        function u(h)
        {
            h.click(fa).mousedown(H)
        }
        function fa(h)
        {
            if (!i("selectable"))
            {
                var O = Math.min(Ba - 1, Math.floor((h.pageX - v.offset().left - Ma) / db)),
                    x = ua(O),
                    A = this.parentNode.className.match(/fc-slot(\d+)/);
                if (A)
                {
                    A = parseInt(A[1]) * i("slotMinutes");
                    var ta = Math.floor(A / 60);
                    x.setHours(ta);
                    x.setMinutes(A % 60 + La);
                    C("dayClick", M[O], x, false, h)
                }
                else C("dayClick", M[O], x, true, h)
            }
        }
        function oa(h, O, x)
        {
            x && Na.build();
            var A = N(K.visStart);
            if (Ub)
            {
                x = Ca(O, A) * Ha + Ia + 1;
                h = Ca(h, A) * Ha + Ia + 1
            }
            else
            {
                x = Ca(h, A);
                h = Ca(O, A)
            }
            x = Math.max(0, x);
            h = Math.min(Ba, h);
            x < h && q(ga(0, x, 0, h - 1))
        }
        function ga(h, O, x, A)
        {
            h = Na.rect(h, O, x, A, ja);
            return E(h, ja)
        }
        function ra(h, O)
        {
            for (var x = N(K.visStart), A = ba(N(x), 1), ta = 0; ta < Ba; ta++)
            {
                var za = new Date(Math.max(x, h)),
                    Da = new Date(Math.min(A, O));
                if (za < Da)
                {
                    var Ea = ta * Ha + Ia;
                    Ea = Na.rect(0, Ea, 0, Ea, I);
                    za = ca(x, za);
                    Da = ca(x, Da);
                    Ea.top = za;
                    Ea.height = Da - za;
                    u(E(Ea, I))
                }
                ba(x, 1);
                ba(A, 1)
            }
        }
        function sa(h)
        {
            return cb.left(h)
        }
        function ha(h)
        {
            return cb.right(h)
        }
        function da(h)
        {
            return {
                row: Math.floor(Ca(h, K.visStart) / 7),
                col: U(h.getDay())
            }
        }
        function na(h)
        {
            var O = ua(h.col);
            h = h.row;
            i("allDaySlot") && h--;
            h >= 0 && xa(O, La + h * i("slotMinutes"));
            return O
        }
        function ua(h)
        {
            return ba(N(K.visStart), h * Ha + Ia)
        }
        function pa(h)
        {
            return i("allDaySlot") && !h.row
        }
        function U(h)
        {
            return (h - Math.max(Tb, Sb) + Ba) % Ba * Ha + Ia
        }
        function ca(h, O)
        {
            h = N(h, true);
            if (O < xa(N(h), La)) return 0;
            if (O >= xa(N(h), bb)) return V.height();
            h = i("slotMinutes");
            O = O.getHours() * 60 + O.getMinutes() - La;
            var x = Math.floor(O / h),
                A = ub[x];
            if (A === ma) A = ub[x] = V.find("tr:eq(" + x + ") td div")[0].offsetTop;
            return Math.max(0, Math.round(A - 1 + Xa * (O % h / h)))
        }
        function ka()
        {
            return {
                left: Ma,
                right: Ga - vb
            }
        }
        function qa()
        {
            return $
        }
        function G(h)
        {
            var O = N(h.start);
            if (h.allDay) return O;
            return xa(O, i("defaultEventMinutes"))
        }
        function p(h, O)
        {
            if (O) return N(h);
            return xa(N(h), i("slotMinutes"))
        }
        function L(h, O, x)
        {
            if (x) i("allDaySlot") && oa(h, ba(N(O), 1), true);
            else c(h, O)
        }
        function c(h, O)
        {
            var x = i("selectHelper");
            Na.build();
            if (x)
            {
                var A = Ca(h, K.visStart) * Ha + Ia;
                if (A >= 0 && A < Ba)
                {
                    A = Na.rect(0, A, 0, A, I);
                    var ta = ca(h, h),
                        za = ca(h, O);
                    if (za > ta)
                    {
                        A.top = ta;
                        A.height = za - ta;
                        A.left += 2;
                        A.width -= 5;
                        if (m.isFunction(x))
                        {
                            if (h = x(h, O))
                            {
                                A.position = "absolute";
                                A.zIndex = 8;
                                wa = m(h).css(A).appendTo(I)
                            }
                        }
                        else
                        {
                            A.isStart = true;
                            A.isEnd = true;
                            wa = m(o(
                            {
                                title: "",
                                start: h,
                                end: O,
                                className: ["fc-select-helper"],
                                editable: false
                            }, A));
                            wa.css("opacity", i("dragOpacity"))
                        }
                        if (wa)
                        {
                            u(wa);
                            I.append(wa);
                            Va(wa, A.width, true);
                            Eb(wa, A.height, true)
                        }
                    }
                }
            }
            else ra(h, O)
        }
        function z()
        {
            B();
            if (wa)
            {
                wa.remove();
                wa = null
            }
        }
        function H(h)
        {
            if (h.which == 1 && i("selectable"))
            {
                Y(h);
                var O;
                Ra.start(function (x, A)
                {
                    z();
                    if (x && x.col == A.col && !pa(x))
                    {
                        A = na(A);
                        x = na(x);
                        O = [A, xa(N(A), i("slotMinutes")), x, xa(N(x), i("slotMinutes"))].sort(Gb);
                        c(O[0], O[3])
                    }
                    else O = null
                }, h);
                m(document).one("mouseup", function (x)
                {
                    Ra.stop();
                    if (O)
                    {
                        +O[0] == +O[1] && T(O[0], false, x);
                        n(O[0], O[3], false, x)
                    }
                })
            }
        }
        function T(h, O, x)
        {
            C("dayClick", M[U(h.getDay())], h, O, x)
        }
        function X(h, O)
        {
            Ra.start(function (x)
            {
                B();
                if (x) if (pa(x)) ga(x.row, x.col, x.row, x.col);
                else
                {
                    x = na(x);
                    var A = xa(N(x), i("defaultEventMinutes"));
                    ra(x, A)
                }
            }, O)
        }
        function ya(h, O, x)
        {
            var A = Ra.stop();
            B();
            A && C("drop", h, na(A), pa(A), O, x)
        }
        var K = this;
        K.renderAgenda = d;
        K.setWidth = t;
        K.setHeight = j;
        K.beforeHide = S;
        K.afterShow = Q;
        K.defaultEventEnd = G;
        K.timePosition = ca;
        K.dayOfWeekCol = U;
        K.dateCell = da;
        K.cellDate = na;
        K.cellIsAllDay = pa;
        K.allDayRow = qa;
        K.allDayBounds = ka;
        K.getHoverListener = function ()
        {
            return Ra
        };
        K.colContentLeft = sa;
        K.colContentRight = ha;
        K.getDaySegmentContainer = function ()
        {
            return ia
        };
        K.getSlotSegmentContainer = function ()
        {
            return R
        };
        K.getMinMinute = function ()
        {
            return La
        };
        K.getMaxMinute = function ()
        {
            return bb
        };
        K.getBodyContent = function ()
        {
            return I
        };
        K.getRowCnt = function ()
        {
            return 1
        };
        K.getColCnt = function ()
        {
            return Ba
        };
        K.getColWidth = function ()
        {
            return db
        };
        K.getSlotHeight = function ()
        {
            return Xa
        };
        K.defaultSelectionEnd = p;
        K.renderDayOverlay = oa;
        K.renderSelection = L;
        K.clearSelection = z;
        K.reportDayClick = T;
        K.dragStart = X;
        K.dragStop = ya;
        Kb.call(K, a, b, e);
        Lb.call(K);
        Mb.call(K);
        sc.call(K);
        var i = K.opt,
            C = K.trigger,
            P = K.clearEvents,
            E = K.renderOverlay,
            B = K.clearOverlays,
            n = K.reportSelection,
            Y = K.unselect,
            W = K.daySelectionMousedown,
            o = K.slotSegHtml,
            s = b.formatDate,
            v, F, r, J, M, k, D, Z, ja, ia, la, $, w, I, R, V, ea, aa, va, wa, Ga, Wb, Ma, db, vb, Xa, Xb, Ba, tb, Na, Ra, cb, ub = {},
            Wa, Tb, Sb, Ub, Ha, Ia, La, bb, Vb;
        qb(a.addClass("fc-agenda"));
        Na = new Nb(function (h, O)
        {
            function x(eb)
            {
                return Math.max(Ea, Math.min(tc, eb))
            }
            var A, ta, za;
            r.each(function (eb, uc)
            {
                A = m(uc);
                ta = A.offset().left;
                if (eb) za[1] = ta;
                za = [ta];
                O[eb] = za
            });
            za[1] = ta + A.outerWidth();
            if (i("allDaySlot"))
            {
                A = $;
                ta = A.offset().top;
                h[0] = [ta, ta + A.outerHeight()]
            }
            for (var Da = I.offset().top, Ea = w.offset().top, tc = Ea + w.outerHeight(), fb = 0; fb < tb; fb++) h.push([x(Da + Xa * fb), x(Da + Xa * (fb + 1))])
        });
        Ra = new Ob(Na);
        cb = new Pb(function (h)
        {
            return k.eq(h)
        })
    }
    function sc()
    {
        function a(o, s)
        {
            sa(o);
            var v, F = o.length,
                r = [],
                J = [];
            for (v = 0; v < F; v++) o[v].allDay ? r.push(o[v]) : J.push(o[v]);
            if (u("allDaySlot"))
            {
                L(e(r), s);
                na()
            }
            g(d(J), s)
        }
        function b()
        {
            ha();
            ua().empty();
            pa().empty()
        }
        function e(o)
        {
            o = ob(nb(o, m.map(o, Ua), q.visStart, q.visEnd));
            var s, v = o.length,
                F, r, J, M = [];
            for (s = 0; s < v; s++)
            {
                F = o[s];
                for (r = 0; r < F.length; r++)
                {
                    J = F[r];
                    J.row = 0;
                    J.level = s;
                    M.push(J)
                }
            }
            return M
        }
        function d(o)
        {
            var s = z(),
                v = ka(),
                F = ca(),
                r = xa(N(q.visStart), v),
                J = m.map(o, f),
                M, k, D, Z, ja, ia, la = [];
            for (M = 0; M < s; M++)
            {
                k = ob(nb(o, J, r, xa(N(r), F - v)));
                vc(k);
                for (D = 0; D < k.length; D++)
                {
                    Z = k[D];
                    for (ja = 0; ja < Z.length; ja++)
                    {
                        ia = Z[ja];
                        ia.col = M;
                        ia.level = D;
                        la.push(ia)
                    }
                }
                ba(r, 1, true)
            }
            return la
        }
        function f(o)
        {
            return o.end ? N(o.end) : xa(N(o.start), u("defaultEventMinutes"))
        }
        function g(o, s)
        {
            var v, F = o.length,
                r, J, M, k, D, Z, ja, ia, la, $ = "",
                w, I, R = {},
                V = {},
                ea = pa(),
                aa;
            v = z();
            if (w = u("isRTL"))
            {
                I = -1;
                aa = v - 1
            }
            else
            {
                I = 1;
                aa = 0
            }
            for (v = 0; v < F; v++)
            {
                r = o[v];
                J = r.event;
                M = qa(r.start, r.start);
                k = qa(r.start, r.end);
                D = r.col;
                Z = r.level;
                ja = r.forward || 0;
                ia = G(D * I + aa);
                la = p(D * I + aa) - ia;
                la = Math.min(la - 6, la * 0.95);
                D = Z ? la / (Z + ja + 1) : ja ? (la / (ja + 1) - 6) * 2 : la;
                Z = ia + la / (Z + ja + 1) * Z * I + (w ? la - D : 0);
                r.top = M;
                r.left = Z;
                r.outerWidth = D;
                r.outerHeight = k - M;
                $ += l(J, r)
            }
            ea[0].innerHTML = $;
            w = ea.children();
            for (v = 0; v < F; v++)
            {
                r = o[v];
                J = r.event;
                $ = m(w[v]);
                I = fa("eventRender", J, J, $);
                if (I === false) $.remove();
                else
                {
                    if (I && I !== true)
                    {
                        $.remove();
                        $ = m(I).css(
                        {
                            position: "absolute",
                            top: r.top,
                            left: r.left
                        }).appendTo(ea)
                    }
                    r.element = $;
                    if (J._id === s) t(J, $, r);
                    else $[0]._fci = v;
                    ya(J, $)
                }
            }
            Db(ea, o, t);
            for (v = 0; v < F; v++)
            {
                r = o[v];
                if ($ = r.element)
                {
                    J = R[s = r.key = Ib($[0])];
                    r.vsides = J === ma ? (R[s] = Sa($, true)) : J;
                    J = V[s];
                    r.hsides = J === ma ? (V[s] = pb($, true)) : J;
                    s = $.find("div.fc-event-content");
                    if (s.length) r.contentTop = s[0].offsetTop
                }
            }
            for (v = 0; v < F; v++)
            {
                r = o[v];
                if ($ = r.element)
                {
                    $[0].style.width = Math.max(0, r.outerWidth - r.hsides) + "px";
                    R = Math.max(0, r.outerHeight - r.vsides);
                    $[0].style.height = R + "px";
                    J = r.event;
                    if (r.contentTop !== ma && R - r.contentTop < 10)
                    {
                        $.find("div.fc-event-time").text(Y(J.start, u("timeFormat")) + " - " + J.title);
                        $.find("div.fc-event-title").remove()
                    }
                    fa("eventAfterRender", J, J, $)
                }
            }
        }
        function l(o, s)
        {
            var v = "<",
                F = o.url,
                r = Jb(o, u),
                J = r ? " style='" + r + "'" : "",
                M = ["fc-event", "fc-event-skin", "fc-event-vert"];
            oa(o) && M.push("fc-event-draggable");
            s.isStart && M.push("fc-corner-top");
            s.isEnd && M.push("fc-corner-bottom");
            M = M.concat(o.className);
            if (o.source) M = M.concat(o.source.className || []);
            v += F ? "a href='" + Qa(o.url) + "'" : "div";
            v += " class='" + M.join(" ") + "' style='position:absolute;z-index:8;top:" + s.top + "px;left:" + s.left + "px;" + r + "'><div class='fc-event-inner fc-event-skin'" + J + "><div class='fc-event-head fc-event-skin'" + J + "><div class='fc-event-time'>" + Qa(W(o.start, o.end, u("timeFormat"))) + "</div></div><div class='fc-event-content'><div class='fc-event-title'>" + Qa(o.title) + "</div></div><div class='fc-event-bg'></div></div>";
            if (s.isEnd && ga(o)) v += "<div class='ui-resizable-handle ui-resizable-s'>=</div>";
            v += "</" + (F ? "a" : "div") + ">";
            return v
        }
        function j(o, s, v)
        {
            oa(o) && y(o, s, v.isStart);
            v.isEnd && ga(o) && c(o, s, v);
            da(o, s)
        }
        function t(o, s, v)
        {
            var F = s.find("div.fc-event-time");
            oa(o) && S(o, s, F);
            v.isEnd && ga(o) && Q(o, s, F);
            da(o, s)
        }
        function y(o, s, v)
        {
            function F()
            {
                if (!M)
                {
                    s.width(r).height("").draggable("option", "grid", null);
                    M = true
                }
            }
            var r, J, M = true,
                k, D = u("isRTL") ? -1 : 1,
                Z = U(),
                ja = H(),
                ia = T(),
                la = ka();
            s.draggable(
            {
                zIndex: 9,
                opacity: u("dragOpacity", "month"),
                revertDuration: u("dragRevertDuration"),
                start: function ($, w)
                {
                    fa("eventDragStart", s, o, $, w);
                    i(o, s);
                    r = s.width();
                    Z.start(function (I, R, V, ea)
                    {
                        B();
                        if (I)
                        {
                            J = false;
                            k = ea * D;
                            if (I.row) if (v)
                            {
                                if (M)
                                {
                                    s.width(ja - 10);
                                    Eb(s, ia * Math.round((o.end ? (o.end - o.start) / wc : u("defaultEventMinutes")) / u("slotMinutes")));
                                    s.draggable("option", "grid", [ja, 1]);
                                    M = false
                                }
                            }
                            else J = true;
                            else
                            {
                                E(ba(N(o.start), k), ba(Ua(o), k));
                                F()
                            }
                            J = J || M && !k
                        }
                        else
                        {
                            F();
                            J = true
                        }
                        s.draggable("option", "revert", J)
                    }, $, "drag")
                },
                stop: function ($, w)
                {
                    Z.stop();
                    B();
                    fa("eventDragStop", s, o, $, w);
                    if (J)
                    {
                        F();
                        s.css("filter", "");
                        K(o, s)
                    }
                    else
                    {
                        var I = 0;
                        M || (I = Math.round((s.offset().top - X().offset().top) / ia) * u("slotMinutes") + la - (o.start.getHours() * 60 + o.start.getMinutes()));
                        C(this, o, k, I, M, $, w)
                    }
                }
            })
        }
        function S(o, s, v)
        {
            function F(I)
            {
                var R = xa(N(o.start), I),
                    V;
                if (o.end) V = xa(N(o.end), I);
                v.text(W(R, V, u("timeFormat")))
            }
            function r()
            {
                if (M)
                {
                    v.css("display", "");
                    s.draggable("option", "grid", [$, w]);
                    M = false
                }
            }
            var J, M = false,
                k, D, Z, ja = u("isRTL") ? -1 : 1,
                ia = U(),
                la = z(),
                $ = H(),
                w = T();
            s.draggable(
            {
                zIndex: 9,
                scroll: false,
                grid: [$, w],
                axis: la == 1 ? "y" : false,
                opacity: u("dragOpacity"),
                revertDuration: u("dragRevertDuration"),
                start: function (I, R)
                {
                    fa("eventDragStart", s, o, I, R);
                    i(o, s);
                    J = s.position();
                    D = Z = 0;
                    ia.start(function (V, ea, aa, va)
                    {
                        s.draggable("option", "revert", !V);
                        B();
                        if (V)
                        {
                            k = va * ja;
                            if (u("allDaySlot") && !V.row)
                            {
                                if (!M)
                                {
                                    M = true;
                                    v.hide();
                                    s.draggable("option", "grid", null)
                                }
                                E(ba(N(o.start), k), ba(Ua(o), k))
                            }
                            else r()
                        }
                    }, I, "drag")
                },
                drag: function (I, R)
                {
                    D = Math.round((R.position.top - J.top) / w) * u("slotMinutes");
                    if (D != Z)
                    {
                        M || F(D);
                        Z = D
                    }
                },
                stop: function (I, R)
                {
                    var V = ia.stop();
                    B();
                    fa("eventDragStop", s, o, I, R);
                    if (V && (k || D || M)) C(this, o, k, M ? 0 : D, M, I, R);
                    else
                    {
                        r();
                        s.css("filter", "");
                        s.css(J);
                        F(0);
                        K(o, s)
                    }
                }
            })
        }
        function Q(o, s, v)
        {
            var F, r, J = T();
            s.resizable(
            {
                handles: {
                    s: "div.ui-resizable-s"
                },
                grid: J,
                start: function (M, k)
                {
                    F = r = 0;
                    i(o, s);
                    s.css("z-index", 9);
                    fa("eventResizeStart", this, o, M, k)
                },
                resize: function (M, k)
                {
                    F = Math.round((Math.max(J, s.height()) - k.originalSize.height) / J);
                    if (F != r)
                    {
                        v.text(W(o.start, !F && !o.end ? null : xa(ra(o), u("slotMinutes") * F), u("timeFormat")));
                        r = F
                    }
                },
                stop: function (M, k)
                {
                    fa("eventResizeStop", this, o, M, k);
                    if (F) P(this, o, 0, u("slotMinutes") * F, M, k);
                    else
                    {
                        s.css("z-index", 8);
                        K(o, s)
                    }
                }
            })
        }
        var q = this;
        q.renderEvents = a;
        q.compileDaySegs = e;
        q.clearEvents = b;
        q.slotSegHtml = l;
        q.bindDaySeg = j;
        Qb.call(q);
        var u = q.opt,
            fa = q.trigger,
            oa = q.isEventDraggable,
            ga = q.isEventResizable,
            ra = q.eventEnd,
            sa = q.reportEvents,
            ha = q.reportEventClear,
            da = q.eventElementHandlers,
            na = q.setHeight,
            ua = q.getDaySegmentContainer,
            pa = q.getSlotSegmentContainer,
            U = q.getHoverListener,
            ca = q.getMaxMinute,
            ka = q.getMinMinute,
            qa = q.timePosition,
            G = q.colContentLeft,
            p = q.colContentRight,
            L = q.renderDaySegs,
            c = q.resizableDayEvent,
            z = q.getColCnt,
            H = q.getColWidth,
            T = q.getSlotHeight,
            X = q.getBodyContent,
            ya = q.reportEventElement,
            K = q.showEvents,
            i = q.hideEvents,
            C = q.eventDrop,
            P = q.eventResize,
            E = q.renderDayOverlay,
            B = q.clearOverlays,
            n = q.calendar,
            Y = n.formatDate,
            W = n.formatDates
    }
    function vc(a)
    {
        var b, e, d, f, g, l;
        for (b = a.length - 1; b > 0; b--)
        {
            f = a[b];
            for (e = 0; e < f.length; e++)
            {
                g = f[e];
                for (d = 0; d < a[b - 1].length; d++)
                {
                    l = a[b - 1][d];
                    if (Cb(g, l)) l.forward = Math.max(l.forward || 0, (g.forward || 0) + 1)
                }
            }
        }
    }
    function Kb(a, b, e)
    {
        function d(G, p)
        {
            G = qa[G];
            if (typeof G == "object") return jb(G, p || e);
            return G
        }
        function f(G, p)
        {
            return b.trigger.apply(b, [G, p || da].concat(Array.prototype.slice.call(arguments, 2), [da]))
        }
        function g(G)
        {
            return j(G) && !d("disableDragging")
        }
        function l(G)
        {
            return j(G) && !d("disableResizing")
        }
        function j(G)
        {
            return Ta(G.editable, (G.source || {}).editable, d("editable"))
        }
        function t(G)
        {
            U = {};
            var p, L = G.length,
                c;
            for (p = 0; p < L; p++)
            {
                c = G[p];
                if (U[c._id]) U[c._id].push(c);
                else U[c._id] = [c]
            }
        }
        function y(G)
        {
            return G.end ? N(G.end) : na(G)
        }
        function S(G, p)
        {
            ca.push(p);
            if (ka[G._id]) ka[G._id].push(p);
            else ka[G._id] = [p]
        }
        function Q()
        {
            ca = [];
            ka = {}
        }
        function q(G, p)
        {
            p.click(function (L)
            {
                if (!p.hasClass("ui-draggable-dragging") && !p.hasClass("ui-resizable-resizing")) return f("eventClick", this, G, L)
            }).hover(function (L)
            {
                f("eventMouseover", this, G, L)
            }, function (L)
            {
                f("eventMouseout", this, G, L)
            })
        }
        function u(G, p)
        {
            oa(G, p, "show")
        }
        function fa(G, p)
        {
            oa(G, p, "hide")
        }
        function oa(G, p, L)
        {
            G = ka[G._id];
            var c, z = G.length;
            for (c = 0; c < z; c++) if (!p || G[c][0] != p[0]) G[c][L]()
        }
        function ga(G, p, L, c, z, H, T)
        {
            var X = p.allDay,
                ya = p._id;
            sa(U[ya], L, c, z);
            f("eventDrop", G, p, L, c, z, function ()
            {
                sa(U[ya], -L, -c, X);
                pa(ya)
            }, H, T);
            pa(ya)
        }
        function ra(G, p, L, c, z, H)
        {
            var T = p._id;
            ha(U[T], L, c);
            f("eventResize", G, p, L, c, function ()
            {
                ha(U[T], -L, -c);
                pa(T)
            }, z, H);
            pa(T)
        }
        function sa(G, p, L, c)
        {
            L = L || 0;
            for (var z, H = G.length, T = 0; T < H; T++)
            {
                z = G[T];
                if (c !== ma) z.allDay = c;
                xa(ba(z.start, p, true), L);
                if (z.end) z.end = xa(ba(z.end, p, true), L);
                ua(z, qa)
            }
        }
        function ha(G, p, L)
        {
            L = L || 0;
            for (var c, z = G.length, H = 0; H < z; H++)
            {
                c = G[H];
                c.end = xa(ba(y(c), p, true), L);
                ua(c, qa)
            }
        }
        var da = this;
        da.element = a;
        da.calendar = b;
        da.name = e;
        da.opt = d;
        da.trigger = f;
        da.isEventDraggable = g;
        da.isEventResizable = l;
        da.reportEvents = t;
        da.eventEnd = y;
        da.reportEventElement = S;
        da.reportEventClear = Q;
        da.eventElementHandlers = q;
        da.showEvents = u;
        da.hideEvents = fa;
        da.eventDrop = ga;
        da.eventResize = ra;
        var na = da.defaultEventEnd,
            ua = b.normalizeEvent,
            pa = b.reportEventChange,
            U = {},
            ca = [],
            ka = {},
            qa = b.options
    }
    function Qb()
    {
        function a(i, C)
        {
            var P = z(),
                E = pa(),
                B = U(),
                n = 0,
                Y, W, o = i.length,
                s, v;
            P[0].innerHTML = e(i);
            d(i, P.children());
            f(i);
            g(i, P, C);
            l(i);
            j(i);
            t(i);
            C = y();
            for (P = 0; P < E; P++)
            {
                Y = [];
                for (W = 0; W < B; W++) Y[W] = 0;
                for (; n < o && (s = i[n]).row == P;)
                {
                    W = Hb(Y.slice(s.startCol, s.endCol));
                    s.top = W;
                    W += s.outerHeight;
                    for (v = s.startCol; v < s.endCol; v++) Y[v] = W;
                    n++
                }
                C[P].height(Hb(Y))
            }
            Q(i, S(C))
        }
        function b(i, C, P)
        {
            var E = m("<div/>"),
                B = z(),
                n = i.length,
                Y;
            E[0].innerHTML = e(i);
            E = E.children();
            B.append(E);
            d(i, E);
            l(i);
            j(i);
            t(i);
            Q(i, S(y()));
            E = [];
            for (B = 0; B < n; B++) if (Y = i[B].element)
            {
                i[B].row === C && Y.css("top", P);
                E.push(Y[0])
            }
            return m(E)
        }
        function e(i)
        {
            var C = fa("isRTL"),
                P, E = i.length,
                B, n, Y, W;
            P = ka();
            var o = P.left,
                s = P.right,
                v, F, r, J, M, k = "";
            for (P = 0; P < E; P++)
            {
                B = i[P];
                n = B.event;
                W = ["fc-event", "fc-event-skin", "fc-event-hori"];
                ga(n) && W.push("fc-event-draggable");
                if (C)
                {
                    B.isStart && W.push("fc-corner-right");
                    B.isEnd && W.push("fc-corner-left");
                    v = p(B.end.getDay() - 1);
                    F = p(B.start.getDay());
                    r = B.isEnd ? qa(v) : o;
                    J = B.isStart ? G(F) : s
                }
                else
                {
                    B.isStart && W.push("fc-corner-left");
                    B.isEnd && W.push("fc-corner-right");
                    v = p(B.start.getDay());
                    F = p(B.end.getDay() - 1);
                    r = B.isStart ? qa(v) : o;
                    J = B.isEnd ? G(F) : s
                }
                W = W.concat(n.className);
                if (n.source) W = W.concat(n.source.className || []);
                Y = n.url;
                M = Jb(n, fa);
                k += Y ? "<a href='" + Qa(Y) + "'" : "<div";
                k += " class='" + W.join(" ") + "' style='position:absolute;z-index:8;left:" + r + "px;" + M + "'><div class='fc-event-inner fc-event-skin'" + (M ? " style='" + M + "'" : "") + ">";
                if (!n.allDay && B.isStart) k += "<span class='fc-event-time'>" + Qa(T(n.start, n.end, fa("timeFormat"))) + "</span>";
                k += "<span class='fc-event-title'>" + Qa(n.title) + "</span></div>";
                if (B.isEnd && ra(n)) k += "<div class='ui-resizable-handle ui-resizable-" + (C ? "w" : "e") + "'>&nbsp;&nbsp;&nbsp;</div>";
                k += "</" + (Y ? "a" : "div") + ">";
                B.left = r;
                B.outerWidth = J - r;
                B.startCol = v;
                B.endCol = F + 1
            }
            return k
        }
        function d(i, C)
        {
            var P, E = i.length,
                B, n, Y;
            for (P = 0; P < E; P++)
            {
                B = i[P];
                n = B.event;
                Y = m(C[P]);
                n = oa("eventRender", n, n, Y);
                if (n === false) Y.remove();
                else
                {
                    if (n && n !== true)
                    {
                        n = m(n).css(
                        {
                            position: "absolute",
                            left: B.left
                        });
                        Y.replaceWith(n);
                        Y = n
                    }
                    B.element = Y
                }
            }
        }
        function f(i)
        {
            var C, P = i.length,
                E, B;
            for (C = 0; C < P; C++)
            {
                E = i[C];
                (B = E.element) && ha(E.event, B)
            }
        }
        function g(i, C, P)
        {
            var E, B = i.length,
                n, Y, W;
            for (E = 0; E < B; E++)
            {
                n = i[E];
                if (Y = n.element)
                {
                    W = n.event;
                    if (W._id === P) H(W, Y, n);
                    else Y[0]._fci = E
                }
            }
            Db(C, i, H)
        }
        function l(i)
        {
            var C, P = i.length,
                E, B, n, Y, W = {};
            for (C = 0; C < P; C++)
            {
                E = i[C];
                if (B = E.element)
                {
                    n = E.key = Ib(B[0]);
                    Y = W[n];
                    if (Y === ma) Y = W[n] = pb(B, true);
                    E.hsides = Y
                }
            }
        }
        function j(i)
        {
            var C, P = i.length,
                E, B;
            for (C = 0; C < P; C++)
            {
                E = i[C];
                if (B = E.element) B[0].style.width = Math.max(0, E.outerWidth - E.hsides) + "px"
            }
        }
        function t(i)
        {
            var C, P = i.length,
                E, B, n, Y, W = {};
            for (C = 0; C < P; C++)
            {
                E = i[C];
                if (B = E.element)
                {
                    n = E.key;
                    Y = W[n];
                    if (Y === ma) Y = W[n] = Fb(B);
                    E.outerHeight = B[0].offsetHeight + Y
                }
            }
        }
        function y()
        {
            var i, C = pa(),
                P = [];
            for (i = 0; i < C; i++) P[i] = ca(i).find("td:first div.fc-day-content > div");
            return P
        }
        function S(i)
        {
            var C, P = i.length,
                E = [];
            for (C = 0; C < P; C++) E[C] = i[C][0].offsetTop;
            return E
        }
        function Q(i, C)
        {
            var P, E = i.length,
                B, n;
            for (P = 0; P < E; P++)
            {
                B = i[P];
                if (n = B.element)
                {
                    n[0].style.top = C[B.row] + (B.top || 0) + "px";
                    B = B.event;
                    oa("eventAfterRender", B, B, n)
                }
            }
        }
        function q(i, C, P)
        {
            var E = fa("isRTL"),
                B = E ? "w" : "e",
                n = C.find("div.ui-resizable-" + B),
                Y = false;
            qb(C);
            C.mousedown(function (W)
            {
                W.preventDefault()
            }).click(function (W)
            {
                if (Y)
                {
                    W.preventDefault();
                    W.stopImmediatePropagation()
                }
            });
            n.mousedown(function (W)
            {
                function o(ia)
                {
                    oa("eventResizeStop", this, i, ia);
                    m("body").css("cursor", "");
                    s.stop();
                    ya();
                    k && ua(this, i, k, 0, ia);
                    setTimeout(function ()
                    {
                        Y = false
                    }, 0)
                }
                if (W.which == 1)
                {
                    Y = true;
                    var s = u.getHoverListener(),
                        v = pa(),
                        F = U(),
                        r = E ? -1 : 1,
                        J = E ? F - 1 : 0,
                        M = C.css("top"),
                        k, D, Z = m.extend(
                        {}, i),
                        ja = L(i.start);
                    K();
                    m("body").css("cursor", B + "-resize").one("mouseup", o);
                    oa("eventResizeStart", this, i, W);
                    s.start(function (ia, la)
                    {
                        if (ia)
                        {
                            var $ = Math.max(ja.row, ia.row);
                            ia = ia.col;
                            if (v == 1) $ = 0;
                            if ($ == ja.row) ia = E ? Math.min(ja.col, ia) : Math.max(ja.col, ia);
                            k = $ * 7 + ia * r + J - (la.row * 7 + la.col * r + J);
                            la = ba(sa(i), k, true);
                            if (k)
                            {
                                Z.end = la;
                                $ = D;
                                D = b(c([Z]), P.row, M);
                                D.find("*").css("cursor", B + "-resize");
                                $ && $.remove();
                                na(i)
                            }
                            else if (D)
                            {
                                da(i);
                                D.remove();
                                D = null
                            }
                            ya();
                            X(i.start, ba(N(la), 1))
                        }
                    }, W)
                }
            })
        }
        var u = this;
        u.renderDaySegs = a;
        u.resizableDayEvent = q;
        var fa = u.opt,
            oa = u.trigger,
            ga = u.isEventDraggable,
            ra = u.isEventResizable,
            sa = u.eventEnd,
            ha = u.reportEventElement,
            da = u.showEvents,
            na = u.hideEvents,
            ua = u.eventResize,
            pa = u.getRowCnt,
            U = u.getColCnt,
            ca = u.allDayRow,
            ka = u.allDayBounds,
            qa = u.colContentLeft,
            G = u.colContentRight,
            p = u.dayOfWeekCol,
            L = u.dateCell,
            c = u.compileDaySegs,
            z = u.getDaySegmentContainer,
            H = u.bindDaySeg,
            T = u.calendar.formatDates,
            X = u.renderDayOverlay,
            ya = u.clearOverlays,
            K = u.clearSelection
    }
    function Mb()
    {
        function a(Q, q, u)
        {
            b();
            q || (q = j(Q, u));
            t(Q, q, u);
            e(Q, q, u)
        }
        function b(Q)
        {
            if (S)
            {
                S = false;
                y();
                l("unselect", null, Q)
            }
        }
        function e(Q, q, u, fa)
        {
            S = true;
            l("select", null, Q, q, u, fa)
        }
        function d(Q)
        {
            var q = f.cellDate,
                u = f.cellIsAllDay,
                fa = f.getHoverListener(),
                oa = f.reportDayClick;
            if (Q.which == 1 && g("selectable"))
            {
                b(Q);
                var ga;
                fa.start(function (ra, sa)
                {
                    y();
                    if (ra && u(ra))
                    {
                        ga = [q(sa), q(ra)].sort(Gb);
                        t(ga[0], ga[1], true)
                    }
                    else ga = null
                }, Q);
                m(document).one("mouseup", function (ra)
                {
                    fa.stop();
                    if (ga)
                    {
                        +ga[0] == +ga[1] && oa(ga[0], true, ra);
                        e(ga[0], ga[1], true, ra)
                    }
                })
            }
        }
        var f = this;
        f.select = a;
        f.unselect = b;
        f.reportSelection = e;
        f.daySelectionMousedown = d;
        var g = f.opt,
            l = f.trigger,
            j = f.defaultSelectionEnd,
            t = f.renderSelection,
            y = f.clearSelection,
            S = false;
        g("selectable") && g("unselectAuto") && m(document).mousedown(function (Q)
        {
            var q = g("unselectCancel");
            if (q) if (m(Q.target).parents(q).length) return;
            b(Q)
        })
    }
    function Lb()
    {
        function a(g, l)
        {
            var j = f.shift();
            j || (j = m("<div class='fc-cell-overlay' style='position:absolute;z-index:3'/>"));
            j[0].parentNode != l[0] && j.appendTo(l);
            d.push(j.css(g).show());
            return j
        }
        function b()
        {
            for (var g; g = d.shift();) f.push(g.hide().unbind())
        }
        var e = this;
        e.renderOverlay = a;
        e.clearOverlays = b;
        var d = [],
            f = []
    }
    function Nb(a)
    {
        var b = this,
            e, d;
        b.build = function ()
        {
            e = [];
            d = [];
            a(e, d)
        };
        b.cell = function (f, g)
        {
            var l = e.length,
                j = d.length,
                t, y = -1,
                S = -1;
            for (t = 0; t < l; t++) if (g >= e[t][0] && g < e[t][1])
            {
                y = t;
                break
            }
            for (t = 0; t < j; t++) if (f >= d[t][0] && f < d[t][1])
            {
                S = t;
                break
            }
            return y >= 0 && S >= 0 ? {
                row: y,
                col: S
            } : null
        };
        b.rect = function (f, g, l, j, t)
        {
            t = t.offset();
            return {
                top: e[f][0] - t.top,
                left: d[g][0] - t.left,
                width: d[j][1] - d[g][0],
                height: e[l][1] - e[f][0]
            }
        }
    }
    function Ob(a)
    {
        function b(j)
        {
            xc(j);
            j = a.cell(j.pageX, j.pageY);
            if (!j != !l || j && (j.row != l.row || j.col != l.col))
            {
                if (j)
                {
                    g || (g = j);
                    f(j, g, j.row - g.row, j.col - g.col)
                }
                else f(j, g);
                l = j
            }
        }
        var e = this,
            d, f, g, l;
        e.start = function (j, t, y)
        {
            f = j;
            g = l = null;
            a.build();
            b(t);
            d = y || "mousemove";
            m(document).bind(d, b)
        };
        e.stop = function ()
        {
            m(document).unbind(d, b);
            return l
        }
    }
    function xc(a)
    {
        if (a.pageX === ma)
        {
            a.pageX = a.originalEvent.pageX;
            a.pageY = a.originalEvent.pageY
        }
    }
    function Pb(a)
    {
        function b(l)
        {
            return d[l] = d[l] || a(l)
        }
        var e = this,
            d = {},
            f = {},
            g = {};
        e.left = function (l)
        {
            return f[l] = f[l] === ma ? b(l).position().left : f[l]
        };
        e.right = function (l)
        {
            return g[l] = g[l] === ma ? e.left(l) + b(l).width() : g[l]
        };
        e.clear = function ()
        {
            d = {};
            f = {};
            g = {}
        }
    }
    var Ya = {
        defaultView: "month",
        aspectRatio: 1.35,
        header: {
            left: "title",
            center: "",
            right: "today prev,next"
        },
        weekends: true,
        allDayDefault: true,
        ignoreTimezone: true,
        lazyFetching: true,
        startParam: "start",
        endParam: "end",
        titleFormat: {
            month: "MMMM yyyy",
            week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
            day: "dddd, MMM d, yyyy"
        },
        columnFormat: {
            month: "ddd",
            week: "ddd M/d",
            day: "dddd M/d"
        },
        timeFormat: {
            "": "h(:mm)t"
        },
        isRTL: false,
        firstDay: 0,
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        buttonText: {
            prev: "&nbsp;&#9668;&nbsp;",
            next: "&nbsp;&#9658;&nbsp;",
            prevYear: "&nbsp;&lt;&lt;&nbsp;",
            nextYear: "&nbsp;&gt;&gt;&nbsp;",
            today: "today",
            month: "month",
            week: "week",
            day: "day"
        },
        theme: false,
        buttonIcons: {
            prev: "circle-triangle-w",
            next: "circle-triangle-e"
        },
        unselectAuto: true,
        dropAccept: "*"
    },
        yc = {
            header: {
                left: "next,prev today",
                center: "",
                right: "title"
            },
            buttonText: {
                prev: "&nbsp;&#9658;&nbsp;",
                next: "&nbsp;&#9668;&nbsp;",
                prevYear: "&nbsp;&gt;&gt;&nbsp;",
                nextYear: "&nbsp;&lt;&lt;&nbsp;"
            },
            buttonIcons: {
                prev: "circle-triangle-e",
                next: "circle-triangle-w"
            }
        },
        Aa = m.fullCalendar = {
            version: "1.5.3"
        },
        Ja = Aa.views = {};
    m.fn.fullCalendar = function (a)
    {
        if (typeof a == "string")
        {
            var b = Array.prototype.slice.call(arguments, 1),
                e;
            this.each(function ()
            {
                var f = m.data(this, "fullCalendar");
                if (f && m.isFunction(f[a]))
                {
                    f = f[a].apply(f, b);
                    if (e === ma) e = f;
                    a == "destroy" && m.removeData(this, "fullCalendar")
                }
            });
            if (e !== ma) return e;
            return this
        }
        var d = a.eventSources || [];
        delete a.eventSources;
        if (a.events)
        {
            d.push(a.events);
            delete a.events
        }
        a = m.extend(true, {}, Ya, a.isRTL || a.isRTL === ma && Ya.isRTL ? yc : {}, a);
        this.each(function (f, g)
        {
            f = m(g);
            g = new Yb(f, a, d);
            f.data("fullCalendar", g);
            g.render()
        });
        return this
    };
    Aa.sourceNormalizers = [];
    Aa.sourceFetchers = [];
    var ac = {
        dataType: "json",
        cache: false
    },
        bc = 1;
    Aa.addDays = ba;
    Aa.cloneDate = N;
    Aa.parseDate = kb;
    Aa.parseISO8601 = Bb;
    Aa.parseTime = mb;
    Aa.formatDate = Oa;
    Aa.formatDates = ib;
    var lc = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"],
        Ab = 864E5,
        cc = 36E5,
        wc = 6E4,
        dc = {
            s: function (a)
            {
                return a.getSeconds()
            },
            ss: function (a)
            {
                return Pa(a.getSeconds())
            },
            m: function (a)
            {
                return a.getMinutes()
            },
            mm: function (a)
            {
                return Pa(a.getMinutes())
            },
            h: function (a)
            {
                return a.getHours() % 12 || 12
            },
            hh: function (a)
            {
                return Pa(a.getHours() % 12 || 12)
            },
            H: function (a)
            {
                return a.getHours()
            },
            HH: function (a)
            {
                return Pa(a.getHours())
            },
            d: function (a)
            {
                return a.getDate()
            },
            dd: function (a)
            {
                return Pa(a.getDate())
            },
            ddd: function (a, b)
            {
                return b.dayNamesShort[a.getDay()]
            },
            dddd: function (a, b)
            {
                return b.dayNames[a.getDay()]
            },
            M: function (a)
            {
                return a.getMonth() + 1
            },
            MM: function (a)
            {
                return Pa(a.getMonth() + 1)
            },
            MMM: function (a, b)
            {
                return b.monthNamesShort[a.getMonth()]
            },
            MMMM: function (a, b)
            {
                return b.monthNames[a.getMonth()]
            },
            yy: function (a)
            {
                return (a.getFullYear() + "").substring(2)
            },
            yyyy: function (a)
            {
                return a.getFullYear()
            },
            t: function (a)
            {
                return a.getHours() < 12 ? "a" : "p"
            },
            tt: function (a)
            {
                return a.getHours() < 12 ? "am" : "pm"
            },
            T: function (a)
            {
                return a.getHours() < 12 ? "A" : "P"
            },
            TT: function (a)
            {
                return a.getHours() < 12 ? "AM" : "PM"
            },
            u: function (a)
            {
                return Oa(a, "yyyy-MM-dd'T'HH:mm:ss'Z'")
            },
            S: function (a)
            {
                a = a.getDate();
                if (a > 10 && a < 20) return "th";
                return ["st", "nd", "rd"][a % 10 - 1] || "th"
            }
        };
    Aa.applyAll = $a;
    Ja.month = mc;
    Ja.basicWeek = nc;
    Ja.basicDay = oc;
    wb(
    {
        weekMode: "fixed"
    });
    Ja.agendaWeek = qc;
    Ja.agendaDay = rc;
    wb(
    {
        allDaySlot: true,
        allDayText: "all-day",
        firstHour: 6,
        slotMinutes: 30,
        defaultEventMinutes: 120,
        axisFormat: "h(:mm)tt",
        timeFormat: {
            agenda: "h:mm{ - h:mm}"
        },
        dragOpacity: {
            agenda: 0.5
        },
        minTime: 0,
        maxTime: 24
    })
})(jQuery);


// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// released under the MIT license
(function ($)
{

    function maybeCall(thing, ctx)
    {
        return (typeof thing == 'function') ? (thing.call(ctx)) : thing;
    };

    function Tipsy(element, options)
    {
        this.$element = $(element);
        this.options = options;
        this.enabled = true;
        this.fixTitle();
    };

    Tipsy.prototype = {
        show: function ()
        {
            var title = this.getTitle();
            if (title && this.enabled)
            {
                var $tip = this.tip();

                $tip.find('.tipsy-inner')[this.options.html ? 'html' : 'text'](title);
                $tip[0].className = 'tipsy'; // reset classname in case of dynamic gravity
                $tip.remove().css(
                {
                    top: 0,
                    left: 0,
                    visibility: 'hidden',
                    display: 'block'
                }).prependTo(document.body);

                var pos = $.extend(
                {}, this.$element.offset(), {
                    width: this.$element[0].offsetWidth,
                    height: this.$element[0].offsetHeight
                });

                var actualWidth = $tip[0].offsetWidth,
                    actualHeight = $tip[0].offsetHeight,
                    gravity = maybeCall(this.options.gravity, this.$element[0]);

                var tp;
                switch (gravity.charAt(0))
                {
                case 'n':
                    tp = {
                        top: pos.top + pos.height + this.options.offset,
                        left: pos.left + pos.width / 2 - actualWidth / 2
                    };
                    break;
                case 's':
                    tp = {
                        top: pos.top - actualHeight - this.options.offset,
                        left: pos.left + pos.width / 2 - actualWidth / 2
                    };
                    break;
                case 'e':
                    tp = {
                        top: pos.top + pos.height / 2 - actualHeight / 2,
                        left: pos.left - actualWidth - this.options.offset
                    };
                    break;
                case 'w':
                    tp = {
                        top: pos.top + pos.height / 2 - actualHeight / 2,
                        left: pos.left + pos.width + this.options.offset
                    };
                    break;
                }

                if (gravity.length == 2)
                {
                    if (gravity.charAt(1) == 'w')
                    {
                        tp.left = pos.left + pos.width / 2 - 15;
                    }
                    else
                    {
                        tp.left = pos.left + pos.width / 2 - actualWidth + 15;
                    }
                }

                $tip.css(tp).addClass('tipsy-' + gravity);
                $tip.find('.tipsy-arrow')[0].className = 'tipsy-arrow tipsy-arrow-' + gravity.charAt(0);
                if (this.options.className)
                {
                    $tip.addClass(maybeCall(this.options.className, this.$element[0]));
                }

                if (this.options.fade)
                {
                    $tip.stop().css(
                    {
                        opacity: 0,
                        display: 'block',
                        visibility: 'visible'
                    }).animate(
                    {
                        opacity: this.options.opacity
                    });
                }
                else
                {
                    $tip.css(
                    {
                        visibility: 'visible',
                        opacity: this.options.opacity
                    });
                }
            }
        },

        hide: function ()
        {
            if (this.options.fade)
            {
                this.tip().stop().fadeOut(function ()
                {
                    $(this).remove();
                });
            }
            else
            {
                this.tip().remove();
            }
        },

        fixTitle: function ()
        {
            var $e = this.$element;
            if ($e.attr('title') || typeof ($e.attr('original-title')) != 'string')
            {
                $e.attr('original-title', $e.attr('title') || '').removeAttr('title');
            }
        },

        getTitle: function ()
        {
            var title, $e = this.$element,
                o = this.options;
            this.fixTitle();
            var title, o = this.options;
            if (typeof o.title == 'string')
            {
                title = $e.attr(o.title == 'title' ? 'original-title' : o.title);
            }
            else if (typeof o.title == 'function')
            {
                title = o.title.call($e[0]);
            }
            title = ('' + title).replace(/(^\s*|\s*$)/, "");
            return title || o.fallback;
        },

        tip: function ()
        {
            if (!this.$tip)
            {
                this.$tip = $('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');
            }
            return this.$tip;
        },

        validate: function ()
        {
            if (!this.$element[0].parentNode)
            {
                this.hide();
                this.$element = null;
                this.options = null;
            }
        },

        enable: function ()
        {
            this.enabled = true;
        },
        disable: function ()
        {
            this.enabled = false;
        },
        toggleEnabled: function ()
        {
            this.enabled = !this.enabled;
        }
    };

    $.fn.tipsy = function (options)
    {

        if (options === true)
        {
            return this.data('tipsy');
        }
        else if (typeof options == 'string')
        {
            var tipsy = this.data('tipsy');
            if (tipsy) tipsy[options]();
            return this;
        }

        options = $.extend(
        {}, $.fn.tipsy.defaults, options);

        function get(ele)
        {
            var tipsy = $.data(ele, 'tipsy');
            if (!tipsy)
            {
                tipsy = new Tipsy(ele, $.fn.tipsy.elementOptions(ele, options));
                $.data(ele, 'tipsy', tipsy);
            }
            return tipsy;
        }

        function enter()
        {
            var tipsy = get(this);
            tipsy.hoverState = 'in';
            if (options.delayIn == 0)
            {
                tipsy.show();
            }
            else
            {
                tipsy.fixTitle();
                setTimeout(function ()
                {
                    if (tipsy.hoverState == 'in') tipsy.show();
                }, options.delayIn);
            }
        };

        function leave()
        {
            var tipsy = get(this);
            tipsy.hoverState = 'out';
            if (options.delayOut == 0)
            {
                tipsy.hide();
            }
            else
            {
                setTimeout(function ()
                {
                    if (tipsy.hoverState == 'out') tipsy.hide();
                }, options.delayOut);
            }
        };

        if (!options.live) this.each(function ()
        {
            get(this);
        });

        if (options.trigger != 'manual')
        {
            var binder = options.live ? 'live' : 'bind',
                eventIn = options.trigger == 'hover' ? 'mouseenter' : 'focus',
                eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur';
            this[binder](eventIn, enter)[binder](eventOut, leave);
        }

        return this;

    };

    $.fn.tipsy.defaults = {
        className: null,
        delayIn: 0,
        delayOut: 0,
        fade: false,
        fallback: '',
        gravity: 'n',
        html: false,
        live: false,
        offset: 0,
        opacity: 0.8,
        title: 'title',
        trigger: 'hover'
    };

    // Overwrite this method to provide options on a per-element basis.
    // For example, you could store the gravity in a 'tipsy-gravity' attribute:
    // return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
    // (remember - do not modify 'options' in place!)
    $.fn.tipsy.elementOptions = function (ele, options)
    {
        return $.metadata ? $.extend(
        {}, options, $(ele).metadata()) : options;
    };

    $.fn.tipsy.autoNS = function ()
    {
        return $(this).offset().top > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
    };

    $.fn.tipsy.autoWE = function ()
    {
        return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
    };

    /**
     * yields a closure of the supplied parameters, producing a function that takes
     * no arguments and is suitable for use as an autogravity function like so:
     *
     * @param margin (int) - distance from the viewable region edge that an
     *        element should be before setting its tooltip's gravity to be away
     *        from that edge.
     * @param prefer (string, e.g. 'n', 'sw', 'w') - the direction to prefer
     *        if there are no viewable region edges effecting the tooltip's
     *        gravity. It will try to vary from this minimally, for example,
     *        if 'sw' is preferred and an element is near the right viewable 
     *        region edge, but not the top edge, it will set the gravity for
     *        that element's tooltip to be 'se', preserving the southern
     *        component.
     */
    $.fn.tipsy.autoBounds = function (margin, prefer)
    {
        return function ()
        {
            var dir = {
                ns: prefer[0],
                ew: (prefer.length > 1 ? prefer[1] : false)
            },
                boundTop = $(document).scrollTop() + margin,
                boundLeft = $(document).scrollLeft() + margin,
                $this = $(this);

            if ($this.offset().top < boundTop) dir.ns = 'n';
            if ($this.offset().left < boundLeft) dir.ew = 'w';
            if ($(window).width() + $(document).scrollLeft() - $this.offset().left < margin) dir.ew = 'e';
            if ($(window).height() + $(document).scrollTop() - $this.offset().top < margin) dir.ns = 's';

            return dir.ns + (dir.ew ? dir.ew : '');
        }
    };

})(jQuery);

/*
 * Inline Form Validation Engine 2.2.4, jQuery plugin
 *
 * Copyright(c) 2010, Cedric Dugas
 * http://www.position-absolute.com
 *
 * 2.0 Rewrite by Olivier Refalo
 * http://www.crionics.com
 *
 * Form validation engine allowing custom regex rules to be added.
 * Licensed under the MIT License
 */ (function ($)
{

    var methods = {

        /**
         * Kind of the constructor, called before any action
         * @param {Map} user options
         */
        init: function (options)
        {
            var form = this;
            if (!form.data('jqv') || form.data('jqv') == null)
            {
                methods._saveOptions(form, options);

                // bind all formError elements to close on click
                $(".formError").live("click", function ()
                {
                    $(this).fadeOut(150, function ()
                    {

                        // remove prompt once invisible
                        $(this).remove();
                    });
                });
            }
            return this;
        },
        /**
         * Attachs jQuery.validationEngine to form.submit and field.blur events
         * Takes an optional params: a list of options
         * ie. jQuery("#formID1").validationEngine('attach', {promptPosition : "centerRight"});
         */
        attach: function (userOptions)
        {

            var form = this;
            var options;

            if (userOptions) options = methods._saveOptions(form, userOptions);
            else options = form.data('jqv');

            var validateAttribute = (form.find("[data-validation-engine*=validate]")) ? "data-validation-engine" : "class";

            if (!options.binded)
            {
                if (options.bindMethod == "bind")
                {

                    // bind fields
                    form.find("[class*=validate]").not("[type=checkbox]").not("[type=radio]").not(".datepicker").bind(options.validationEventTrigger, methods._onFieldEvent);
                    form.find("[class*=validate][type=checkbox],[class*=validate][type=radio]").bind("click", methods._onFieldEvent);
                    form.find("[class*=validate][class*=datepicker]").bind(options.validationEventTrigger, {
                        "delay": 300
                    }, methods._onFieldEvent);

                    // bind form.submit
                    form.bind("submit", methods._onSubmitEvent);
                }
                else if (options.bindMethod == "live")
                {
                    // bind fields with LIVE (for persistant state)
                    form.find("[class*=validate]").not("[type=checkbox]").not(".datepicker").live(options.validationEventTrigger, methods._onFieldEvent);
                    form.find("[class*=validate][type=checkbox]").live("click", methods._onFieldEvent);
                    form.find("[class*=validate][class*=datepicker]").live(options.validationEventTrigger, {
                        "delay": 300
                    }, methods._onFieldEvent);

                    // bind form.submit
                    form.live("submit", methods._onSubmitEvent);
                }

                options.binded = true;

                if (options.autoPositionUpdate)
                {
                    $(window).bind("resize", {
                        "noAnimation": true,
                        "formElem": form
                    }, methods.updatePromptsPosition);
                }

            }
            return this;
        },
        /**
         * Unregisters any bindings that may point to jQuery.validaitonEngine
         */
        detach: function ()
        {
            var form = this;
            var options = form.data('jqv');
            if (options.binded)
            {

                // unbind fields
                form.find("[class*=validate]").not("[type=checkbox]").unbind(options.validationEventTrigger, methods._onFieldEvent);
                form.find("[class*=validate][type=checkbox],[class*=validate][type=radio]").unbind("click", methods._onFieldEvent);

                // unbind form.submit
                form.unbind("submit", methods.onAjaxFormComplete);

                // unbind live fields (kill)
                form.find("[class*=validate]").not("[type=checkbox]").die(options.validationEventTrigger, methods._onFieldEvent);
                form.find("[class*=validate][type=checkbox]").die("click", methods._onFieldEvent);

                // unbind form.submit
                form.die("submit", methods.onAjaxFormComplete);

                form.removeData('jqv');

                if (options.autoPositionUpdate)
                {
                    $(window).unbind("resize", methods.updatePromptsPosition)
                }
            }
            return this;
        },
        /**
         * Validates the form fields, shows prompts accordingly.
         * Note: There is no ajax form validation with this method, only field ajax validation are evaluated
         *
         * @return true if the form validates, false if it fails
         */
        validate: function ()
        {
            return methods._validateFields(this);
        },
        /**
         * Validates one field, shows prompt accordingly.
         * Note: There is no ajax form validation with this method, only field ajax validation are evaluated
         *
         * @return true if the form validates, false if it fails
         */
        validateField: function (el)
        {
            var options = $(this).data('jqv');
            var r = methods._validateField($(el), options);

            if (options.onSuccess && options.InvalidFields.length == 0) options.onSuccess();
            else if (options.onFailure && options.InvalidFields.length > 0) options.onFailure();

            return r;
        },
        /**
         * Validates the form fields, shows prompts accordingly.
         * Note: this methods performs fields and form ajax validations(if setup)
         *
         * @return true if the form validates, false if it fails, undefined if ajax is used for form validation
         */
        validateform: function ()
        {
            return methods._onSubmitEvent.call(this);
        },
        /**
         *  Redraw prompts position, useful when you change the DOM state when validating
         */
        updatePromptsPosition: function (event)
        {

            if (event && this == window) var form = event.data.formElem,
                noAnimation = event.data.noAnimation;
            else var form = $(this.closest('form'));

            var options = form.data('jqv');
            // No option, take default one
            form.find('[class*=validate]').not(':hidden').not(":disabled").each(function ()
            {
                var field = $(this);
                var prompt = methods._getPrompt(field);
                var promptText = $(prompt).find(".formErrorContent").html();

                if (prompt) methods._updatePrompt(field, $(prompt), promptText, undefined, false, options, noAnimation);
            })
            return this;
        },
        /**
         * Displays a prompt on a element.
         * Note that the element needs an id!
         *
         * @param {String} promptText html text to display type
         * @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
         * @param {String} possible values topLeft, topRight, bottomLeft, centerRight, bottomRight
         */
        showPrompt: function (promptText, type, promptPosition, showArrow)
        {

            var form = this.closest('form');
            var options = form.data('jqv');
            // No option, take default one
            if (!options) options = methods._saveOptions(this, options);
            if (promptPosition) options.promptPosition = promptPosition;
            options.showArrow = showArrow == true;

            methods._showPrompt(this, promptText, type, false, options);
            return this;
        },
        /**
         * Closes all error prompts on the page
         */
        hidePrompt: function ()
        {
            var promptClass = "." + methods._getClassName($(this).attr("id")) + "formError";
            $(promptClass).fadeTo("fast", 0.3, function ()
            {
                $(this).remove();
            });
            return this;
        },
        /**
         * Closes form error prompts, CAN be invidual
         */
        hide: function ()
        {
            var closingtag;
            if ($(this).is("form"))
            {
                closingtag = "parentForm" + methods._getClassName($(this).attr("id"));
            }
            else
            {
                closingtag = methods._getClassName($(this).attr("id")) + "formError";
            }
            $('.' + closingtag).fadeTo("fast", 0.3, function ()
            {
                $(this).remove();
            });
            return this;
        },
        /**
         * Closes all error prompts on the page
         */
        hideAll: function ()
        {
            $('.formError').fadeTo("fast", 0.3, function ()
            {
                $(this).remove();
            });
            return this;
        },
        /**
         * Typically called when user exists a field using tab or a mouse click, triggers a field
         * validation
         */
        _onFieldEvent: function (event)
        {
            var field = $(this);
            var form = field.closest('form');
            var options = form.data('jqv');
            // validate the current field
            window.setTimeout(function ()
            {
                methods._validateField(field, options);
                if (options.InvalidFields.length == 0 && options.onSuccess)
                {
                    options.onSuccess();
                }
                else if (options.InvalidFields.length > 0 && options.onFailure)
                {
                    options.onFailure();
                }
            }, (event.data) ? event.data.delay : 0);

        },
        /**
         * Called when the form is submited, shows prompts accordingly
         *
         * @param {jqObject}
         *            form
         * @return false if form submission needs to be cancelled
         */
        _onSubmitEvent: function ()
        {
            var form = $(this);
            var options = form.data('jqv');

            // validate each field (- skip field ajax validation, no necessary since we will perform an ajax form validation)
            var r = methods._validateFields(form, true);

            if (r && options.ajaxFormValidation)
            {
                methods._validateFormWithAjax(form, options);
                return false;
            }

            if (options.onValidationComplete)
            {
                options.onValidationComplete(form, r);
                return false;
            }
            return r;
        },

        /**
         * Return true if the ajax field validations passed so far
         * @param {Object} options
         * @return true, is all ajax validation passed so far (remember ajax is async)
         */
        _checkAjaxStatus: function (options)
        {
            var status = true;
            $.each(options.ajaxValidCache, function (key, value)
            {
                if (!value)
                {
                    status = false;
                    // break the each
                    return false;
                }
            });
            return status;
        },
        /**
         * Validates form fields, shows prompts accordingly
         *
         * @param {jqObject}
         *            form
         * @param {skipAjaxFieldValidation}
         *            boolean - when set to true, ajax field validation is skipped, typically used when the submit button is clicked
         *
         * @return true if form is valid, false if not, undefined if ajax form validation is done
         */
        _validateFields: function (form, skipAjaxValidation)
        {
            var options = form.data('jqv');

            // this variable is set to true if an error is found
            var errorFound = false;

            // Trigger hook, start validation
            form.trigger("jqv.form.validating");
            // first, evaluate status of non ajax fields
            var first_err = null;
            form.find('[class*=validate]').not(':hidden').not(":disabled").each(function ()
            {
                var field = $(this);
                errorFound |= methods._validateField(field, options, skipAjaxValidation);
                field.focus();
                if (options.doNotShowAllErrosOnSubmit) return false;
                if (errorFound && first_err == null) first_err = field;
            });
            // second, check to see if all ajax calls completed ok
            // errorFound |= !methods._checkAjaxStatus(options);
            // thrird, check status and scroll the container accordingly
            form.trigger("jqv.form.result", [errorFound]);

            if (errorFound)
            {
                if (options.scroll)
                {
                    var destination = first_err.offset().top;
                    var fixleft = first_err.offset().left;

                    //prompt positioning adjustment support. Usage: positionType:Xshift,Yshift (for ex.: bottomLeft:+20 or bottomLeft:-20,+10)
                    var positionType = options.promptPosition;
                    if (typeof (positionType) == 'string')
                    {
                        if (positionType.indexOf(":") != -1)
                        {
                            positionType = positionType.substring(0, positionType.indexOf(":"));
                        }
                    }

                    if (positionType != "bottomRight" && positionType != "bottomLeft")
                    {
                        var prompt_err = methods._getPrompt(first_err);
                        destination = prompt_err.offset().top;
                    }

                    // get the position of the first error, there should be at least one, no need to check this
                    //var destination = form.find(".formError:not('.greenPopup'):first").offset().top;
                    $("html:not(:animated),body:not(:animated)").animate(
                    {
                        scrollTop: destination,
                        scrollLeft: fixleft
                    }, 1100, function ()
                    {
                        if (options.focusFirstField) first_err.focus();
                    });
                    if (options.isOverflown)
                    {
                        var overflowDIV = $(options.overflownDIV);
                        var scrollContainerScroll = overflowDIV.scrollTop();
                        var scrollContainerPos = -parseInt(overflowDIV.offset().top);

                        destination += scrollContainerScroll + scrollContainerPos - 5;
                        var scrollContainer = $(options.overflownDIV + ":not(:animated)");

                        scrollContainer.animate(
                        {
                            scrollTop: destination
                        }, 1100);
                    }

                }
                else if (options.focusFirstField) first_err.focus();
                return false;
            }
            return true;
        },
        /**
         * This method is called to perform an ajax form validation.
         * During this process all the (field, value) pairs are sent to the server which returns a list of invalid fields or true
         *
         * @param {jqObject} form
         * @param {Map} options
         */
        _validateFormWithAjax: function (form, options)
        {

            var data = form.serialize();
            var url = (options.ajaxFormValidationURL) ? options.ajaxFormValidationURL : form.attr("action");
            $.ajax(
            {
                type: "GET",
                url: url,
                cache: false,
                dataType: "json",
                data: data,
                form: form,
                methods: methods,
                options: options,
                beforeSend: function ()
                {
                    return options.onBeforeAjaxFormValidation(form, options);
                },
                error: function (data, transport)
                {
                    methods._ajaxError(data, transport);
                },
                success: function (json)
                {

                    if (json !== true)
                    {

                        // getting to this case doesn't necessary means that the form is invalid
                        // the server may return green or closing prompt actions
                        // this flag helps figuring it out
                        var errorInForm = false;
                        for (var i = 0; i < json.length; i++)
                        {
                            var value = json[i];

                            var errorFieldId = value[0];
                            var errorField = $($("#" + errorFieldId)[0]);

                            // make sure we found the element
                            if (errorField.length == 1)
                            {

                                // promptText or selector
                                var msg = value[2];
                                // if the field is valid
                                if (value[1] == true)
                                {

                                    if (msg == "" || !msg)
                                    {
                                        // if for some reason, status==true and error="", just close the prompt
                                        methods._closePrompt(errorField);
                                    }
                                    else
                                    {
                                        // the field is valid, but we are displaying a green prompt
                                        if (options.allrules[msg])
                                        {
                                            var txt = options.allrules[msg].alertTextOk;
                                            if (txt) msg = txt;
                                        }
                                        methods._showPrompt(errorField, msg, "pass", false, options, true);
                                    }

                                }
                                else
                                {
                                    // the field is invalid, show the red error prompt
                                    errorInForm |= true;
                                    if (options.allrules[msg])
                                    {
                                        var txt = options.allrules[msg].alertText;
                                        if (txt) msg = txt;
                                    }
                                    methods._showPrompt(errorField, msg, "", false, options, true);
                                }
                            }
                        }
                        options.onAjaxFormComplete(!errorInForm, form, json, options);
                    }
                    else options.onAjaxFormComplete(true, form, "", options);
                }
            });

        },
        /**
         * Validates field, shows prompts accordingly
         *
         * @param {jqObject}
         *            field
         * @param {Array[String]}
         *            field's validation rules
         * @param {Map}
         *            user options
         * @return true if field is valid
         */
        _validateField: function (field, options, skipAjaxValidation)
        {
            if (!field.attr("id")) $.error("jQueryValidate: an ID attribute is required for this field: " + field.attr("name") + " class:" + field.attr("class"));

            var rulesParsing = field.attr('class');
            var getRules = /validate\[(.*)\]/.exec(rulesParsing);

            if (!getRules) return false;
            var str = getRules[1];
            var rules = str.split(/\[|,|\]/);

            // true if we ran the ajax validation, tells the logic to stop messing with prompts
            var isAjaxValidator = false;
            var fieldName = field.attr("name");
            var promptText = "";
            var required = false;
            options.isError = false;
            options.showArrow = true;

            var form = $(field.closest("form"));

            for (var i = 0; i < rules.length; i++)
            {
                // Fix for adding spaces in the rules
                rules[i] = rules[i].replace(" ", "")
                var errorMsg = undefined;
                switch (rules[i])
                {

                case "required":
                    required = true;
                    errorMsg = methods._required(field, rules, i, options);
                    break;
                case "custom":
                    errorMsg = methods._customRegex(field, rules, i, options);
                    break;
                case "groupRequired":
                    // Check is its the first of group, if not, reload validation with first field
                    // AND continue normal validation on present field
                    var classGroup = "[class*=" + rules[i + 1] + "]";
                    var firstOfGroup = form.find(classGroup).eq(0);
                    if (firstOfGroup[0] != field[0])
                    {
                        methods._validateField(firstOfGroup, options, skipAjaxValidation)
                        options.showArrow = true;
                        continue;
                    };
                    errorMsg = methods._groupRequired(field, rules, i, options);
                    if (errorMsg) required = true;
                    options.showArrow = false;
                    break;
                case "ajax":
                    // ajax has its own prompts handling technique
                    if (!skipAjaxValidation)
                    {
                        methods._ajax(field, rules, i, options);
                        isAjaxValidator = true;
                    }
                    break;
                case "minSize":
                    errorMsg = methods._minSize(field, rules, i, options);
                    break;
                case "maxSize":
                    errorMsg = methods._maxSize(field, rules, i, options);
                    break;
                case "min":
                    errorMsg = methods._min(field, rules, i, options);
                    break;
                case "max":
                    errorMsg = methods._max(field, rules, i, options);
                    break;
                case "past":
                    errorMsg = methods._past(field, rules, i, options);
                    break;
                case "future":
                    errorMsg = methods._future(field, rules, i, options);
                    break;
                case "dateRange":
                    var classGroup = "[class*=" + rules[i + 1] + "]";
                    var firstOfGroup = form.find(classGroup).eq(0);
                    var secondOfGroup = form.find(classGroup).eq(1);

                    //if one entry out of the pair has value then proceed to run through validation
                    if (firstOfGroup[0].value || secondOfGroup[0].value)
                    {
                        errorMsg = methods._dateRange(firstOfGroup, secondOfGroup, rules, i, options);
                    }
                    if (errorMsg) required = true;
                    options.showArrow = false;
                    break;

                case "dateTimeRange":
                    var classGroup = "[class*=" + rules[i + 1] + "]";
                    var firstOfGroup = form.find(classGroup).eq(0);
                    var secondOfGroup = form.find(classGroup).eq(1);

                    //if one entry out of the pair has value then proceed to run through validation
                    if (firstOfGroup[0].value || secondOfGroup[0].value)
                    {
                        errorMsg = methods._dateTimeRange(firstOfGroup, secondOfGroup, rules, i, options);
                    }
                    if (errorMsg) required = true;
                    options.showArrow = false;
                    break;
                case "maxCheckbox":
                    errorMsg = methods._maxCheckbox(form, field, rules, i, options);
                    field = $(form.find("input[name='" + fieldName + "']"));
                    break;
                case "minCheckbox":
                    errorMsg = methods._minCheckbox(form, field, rules, i, options);
                    field = $(form.find("input[name='" + fieldName + "']"));
                    break;
                case "equals":
                    errorMsg = methods._equals(field, rules, i, options);
                    break;
                case "funcCall":
                    errorMsg = methods._funcCall(field, rules, i, options);
                    break;

                default:
                    //$.error("jQueryValidator rule not found"+rules[i]);
                }
                if (errorMsg !== undefined)
                {
                    promptText += errorMsg + "<br/>";
                    options.isError = true;
                }
            }
            // If the rules required is not added, an empty field is not validated
            if (!required && field.val() == "") options.isError = false;

            // Hack for radio/checkbox group button, the validation go into the
            // first radio/checkbox of the group
            var fieldType = field.prop("type");

            if ((fieldType == "radio" || fieldType == "checkbox") && form.find("input[name='" + fieldName + "']").size() > 1)
            {
                field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:first"));
                options.showArrow = false;
            }

            if (fieldType == "text" && form.find("input[name='" + fieldName + "']").size() > 1)
            {
                field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:first"));
                options.showArrow = false;
            }

            if (options.isError)
            {
                methods._showPrompt(field, promptText, "", false, options);
            }
            else
            {
                if (!isAjaxValidator) methods._closePrompt(field);
            }

            if (!isAjaxValidator)
            {
                field.trigger("jqv.field.result", [field, options.isError, promptText]);
            }

            /* Record error */
            var errindex = $.inArray(field[0], options.InvalidFields);
            if (errindex == -1)
            {
                if (options.isError) options.InvalidFields.push(field[0]);
            }
            else if (!options.isError)
            {
                options.InvalidFields.splice(errindex, 1);
            }

            return options.isError;
        },
        /**
         * Required validation
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _required: function (field, rules, i, options)
        {
            switch (field.prop("type"))
            {
            case "text":
            case "password":
            case "textarea":
            case "file":
            default:
                if (!field.val()) return options.allrules[rules[i]].alertText;
                break;
            case "radio":
            case "checkbox":
                var form = field.closest("form");
                var name = field.attr("name");
                if (form.find("input[name='" + name + "']:checked").size() == 0)
                {
                    if (form.find("input[name='" + name + "']").size() == 1) return options.allrules[rules[i]].alertTextCheckboxe;
                    else return options.allrules[rules[i]].alertTextCheckboxMultiple;
                }
                break;
                // required for <select>
            case "select-one":
                // added by paul@kinetek.net for select boxes, Thank you
                if (!field.val()) return options.allrules[rules[i]].alertText;
                break;
            case "select-multiple":
                // added by paul@kinetek.net for select boxes, Thank you
                if (!field.find("option:selected").val()) return options.allrules[rules[i]].alertText;
                break;
            }
        },
        /**
         * Validate that 1 from the group field is required
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _groupRequired: function (field, rules, i, options)
        {
            var classGroup = "[class*=" + rules[i + 1] + "]";
            var isValid = false;
            // Check all fields from the group
            field.closest("form").find(classGroup).each(function ()
            {
                if (!methods._required($(this), rules, i, options))
                {
                    isValid = true;
                    return false;
                }
            })

            if (!isValid) return options.allrules[rules[i]].alertText;
        },
        /**
         * Validate Regex rules
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _customRegex: function (field, rules, i, options)
        {
            var customRule = rules[i + 1];
            var rule = options.allrules[customRule];
            if (!rule)
            {
                alert("jqv:custom rule not found " + customRule);
                return;
            }

            var ex = rule.regex;
            if (!ex)
            {
                alert("jqv:custom regex not found " + customRule);
                return;
            }
            var pattern = new RegExp(ex);

            if (!pattern.test(field.val())) return options.allrules[customRule].alertText;
        },
        /**
         * Validate custom function outside of the engine scope
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _funcCall: function (field, rules, i, options)
        {
            var functionName = rules[i + 1];
            var fn = window[functionName] || options.customFunctions[functionName];
            if (typeof (fn) == 'function') return fn(field, rules, i, options);

        },
        /**
         * Field match
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _equals: function (field, rules, i, options)
        {
            var equalsField = rules[i + 1];

            if (field.val() != $("#" + equalsField).val()) return options.allrules.equals.alertText;
        },
        /**
         * Check the maximum size (in characters)
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _maxSize: function (field, rules, i, options)
        {
            var max = rules[i + 1];
            var len = field.val().length;

            if (len > max)
            {
                var rule = options.allrules.maxSize;
                return rule.alertText + max + rule.alertText2;
            }
        },
        /**
         * Check the minimum size (in characters)
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _minSize: function (field, rules, i, options)
        {
            var min = rules[i + 1];
            var len = field.val().length;

            if (len < min)
            {
                var rule = options.allrules.minSize;
                return rule.alertText + min + rule.alertText2;
            }
        },
        /**
         * Check number minimum value
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _min: function (field, rules, i, options)
        {
            var min = parseFloat(rules[i + 1]);
            var len = parseFloat(field.val());

            if (len < min)
            {
                var rule = options.allrules.min;
                if (rule.alertText2) return rule.alertText + min + rule.alertText2;
                return rule.alertText + min;
            }
        },
        /**
         * Check number maximum value
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _max: function (field, rules, i, options)
        {
            var max = parseFloat(rules[i + 1]);
            var len = parseFloat(field.val());

            if (len > max)
            {
                var rule = options.allrules.max;
                if (rule.alertText2) return rule.alertText + max + rule.alertText2;
                //orefalo: to review, also do the translations
                return rule.alertText + max;
            }
        },
        /**
         * Checks date is in the past
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _past: function (field, rules, i, options)
        {

            var p = rules[i + 1];
            var pdate = (p.toLowerCase() == "now") ? new Date() : methods._parseDate(p);
            var vdate = methods._parseDate(field.val());

            if (vdate < pdate)
            {
                var rule = options.allrules.past;
                if (rule.alertText2) return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
                return rule.alertText + methods._dateToString(pdate);
            }
        },
        /**
         * Checks date is in the future
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _future: function (field, rules, i, options)
        {

            var p = rules[i + 1];
            var pdate = (p.toLowerCase() == "now") ? new Date() : methods._parseDate(p);
            var vdate = methods._parseDate(field.val());

            if (vdate > pdate)
            {
                var rule = options.allrules.future;
                if (rule.alertText2) return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
                return rule.alertText + methods._dateToString(pdate);
            }
        },
        /**
         * Checks if valid date
         *
         * @param {string} date string
         * @return a bool based on determination of valid date
         */
        _isDate: function (value)
        {
            var dateRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/);
            if (dateRegEx.test(value))
            {
                return true;
            }
            return false;
        },
        /**
         * Checks if valid date time
         *
         * @param {string} date string
         * @return a bool based on determination of valid date time
         */
        _isDateTime: function (value)
        {
            var dateTimeRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/);
            if (dateTimeRegEx.test(value))
            {
                return true;
            }
            return false;
        },
        //Checks if the start date is before the end date
        //returns true if end is later than start
        _dateCompare: function (start, end)
        {
            return (new Date(start.toString()) < new Date(end.toString()));
        },
        /**
         * Checks date range
         *
         * @param {jqObject} first field name
         * @param {jqObject} second field name
         * @return an error string if validation failed
         */
        _dateRange: function (first, second, rules, i, options)
        {
            //are not both populated
            if ((!first[0].value && second[0].value) || (first[0].value && !second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }

            //are not both dates
            if (!methods._isDate(first[0].value) || !methods._isDate(second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }

            //are both dates but range is off
            if (!methods._dateCompare(first[0].value, second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
        },


        /**
         * Checks date time range
         *
         * @param {jqObject} first field name
         * @param {jqObject} second field name
         * @return an error string if validation failed
         */
        _dateTimeRange: function (first, second, rules, i, options)
        {
            //are not both populated
            if ((!first[0].value && second[0].value) || (first[0].value && !second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            //are not both dates
            if (!methods._isDateTime(first[0].value) || !methods._isDateTime(second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            //are both dates but range is off
            if (!methods._dateCompare(first[0].value, second[0].value))
            {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
        },
        /**
         * Max number of checkbox selected
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _maxCheckbox: function (form, field, rules, i, options)
        {

            var nbCheck = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = form.find("input[name='" + groupname + "']:checked").size();
            if (groupSize > nbCheck)
            {
                options.showArrow = false;
                if (options.allrules.maxCheckbox.alertText2) return options.allrules.maxCheckbox.alertText + " " + nbCheck + " " + options.allrules.maxCheckbox.alertText2;
                return options.allrules.maxCheckbox.alertText;
            }
        },
        /**
         * Min number of checkbox selected
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return an error string if validation failed
         */
        _minCheckbox: function (form, field, rules, i, options)
        {

            var nbCheck = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = form.find("input[name='" + groupname + "']:checked").size();
            if (groupSize < nbCheck)
            {
                options.showArrow = false;
                return options.allrules.minCheckbox.alertText + " " + nbCheck + " " + options.allrules.minCheckbox.alertText2;
            }
        },
        /**
         * Ajax field validation
         *
         * @param {jqObject} field
         * @param {Array[String]} rules
         * @param {int} i rules index
         * @param {Map}
         *            user options
         * @return nothing! the ajax validator handles the prompts itself
         */
        _ajax: function (field, rules, i, options)
        {

            var errorSelector = rules[i + 1];
            var rule = options.allrules[errorSelector];
            var extraData = rule.extraData;
            var extraDataDynamic = rule.extraDataDynamic;

            if (!extraData) extraData = "";

            if (extraDataDynamic)
            {
                var tmpData = [];
                var domIds = String(extraDataDynamic).split(",");
                for (var i = 0; i < domIds.length; i++)
                {
                    var id = domIds[i];
                    if ($(id).length)
                    {
                        var inputValue = field.closest("form").find(id).val();
                        var keyValue = id.replace('#', '') + '=' + escape(inputValue);
                        tmpData.push(keyValue);
                    }
                }
                extraDataDynamic = tmpData.join("&");
            }
            else
            {
                extraDataDynamic = "";
            }

            if (!options.isError)
            {
                $.ajax(
                {
                    type: "GET",
                    url: rule.url,
                    cache: false,
                    dataType: "json",
                    data: "fieldId=" + field.attr("id") + "&fieldValue=" + field.val() + "&extraData=" + extraData + "&" + extraDataDynamic,
                    field: field,
                    rule: rule,
                    methods: methods,
                    options: options,
                    beforeSend: function ()
                    {
                        // build the loading prompt
                        var loadingText = rule.alertTextLoad;
                        if (loadingText) methods._showPrompt(field, loadingText, "load", true, options);
                    },
                    error: function (data, transport)
                    {
                        methods._ajaxError(data, transport);
                    },
                    success: function (json)
                    {

                        // asynchronously called on success, data is the json answer from the server
                        var errorFieldId = json[0];
                        var errorField = $($("#" + errorFieldId)[0]);
                        // make sure we found the element
                        if (errorField.length == 1)
                        {
                            var status = json[1];
                            // read the optional msg from the server
                            var msg = json[2];
                            if (!status)
                            {
                                // Houston we got a problem - display an red prompt
                                options.ajaxValidCache[errorFieldId] = false;
                                options.isError = true;

                                // resolve the msg prompt
                                if (msg)
                                {
                                    if (options.allrules[msg])
                                    {
                                        var txt = options.allrules[msg].alertText;
                                        if (txt) msg = txt;
                                    }
                                }
                                else msg = rule.alertText;

                                methods._showPrompt(errorField, msg, "", true, options);
                            }
                            else
                            {
                                if (options.ajaxValidCache[errorFieldId] !== undefined) options.ajaxValidCache[errorFieldId] = true;

                                // resolves the msg prompt
                                if (msg)
                                {
                                    if (options.allrules[msg])
                                    {
                                        var txt = options.allrules[msg].alertTextOk;
                                        if (txt) msg = txt;
                                    }
                                }
                                else msg = rule.alertTextOk;

                                // see if we should display a green prompt
                                if (msg) methods._showPrompt(errorField, msg, "pass", true, options);
                                else methods._closePrompt(errorField);
                            }
                        }
                        errorField.trigger("jqv.field.result", [errorField, !options.isError, msg]);
                    }
                });
            }
        },
        /**
         * Common method to handle ajax errors
         *
         * @param {Object} data
         * @param {Object} transport
         */
        _ajaxError: function (data, transport)
        {
            if (data.status == 0 && transport == null) alert("The page is not served from a server! ajax call failed");
            else if (typeof console != "undefined") console.log("Ajax error: " + data.status + " " + transport);
        },
        /**
         * date -> string
         *
         * @param {Object} date
         */
        _dateToString: function (date)
        {

            return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        },
        /**
         * Parses an ISO date
         * @param {String} d
         */
        _parseDate: function (d)
        {

            var dateParts = d.split("-");
            if (dateParts == d) dateParts = d.split("/");
            return new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
        },
        /**
         * Builds or updates a prompt with the given information
         *
         * @param {jqObject} field
         * @param {String} promptText html text to display type
         * @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
         * @param {boolean} ajaxed - use to mark fields than being validated with ajax
         * @param {Map} options user options
         */
        _showPrompt: function (field, promptText, type, ajaxed, options, ajaxform)
        {
            var prompt = methods._getPrompt(field);
            // The ajax submit errors are not see has an error in the form,
            // When the form errors are returned, the engine see 2 bubbles, but those are ebing closed by the engine at the same time
            // Because no error was found befor submitting
            if (ajaxform) prompt = false;
            if (prompt) methods._updatePrompt(field, prompt, promptText, type, ajaxed, options);
            else methods._buildPrompt(field, promptText, type, ajaxed, options);
        },
        /**
         * Builds and shades a prompt for the given field.
         *
         * @param {jqObject} field
         * @param {String} promptText html text to display type
         * @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
         * @param {boolean} ajaxed - use to mark fields than being validated with ajax
         * @param {Map} options user options
         */
        _buildPrompt: function (field, promptText, type, ajaxed, options)
        {

            // create the prompt
            var prompt = $('<div>');
            prompt.addClass(methods._getClassName(field.attr("id")) + "formError");
            // add a class name to identify the parent form of the prompt
            if (field.is(":input")) prompt.addClass("parentForm" + methods._getClassName(field.parents('form').attr("id")));
            prompt.addClass("formError");

            switch (type)
            {
            case "pass":
                prompt.addClass("greenPopup");
                break;
            case "load":
                prompt.addClass("blackPopup");
                break;
            default:
                /* it has error  */
                options.InvalidCount++;
            }
            if (ajaxed) prompt.addClass("ajaxed");

            // create the prompt content
            var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);
            // create the css arrow pointing at the field
            // note that there is no triangle on max-checkbox and radio
            if (options.showArrow)
            {
                var arrow = $('<div>').addClass("formErrorArrow");

                //prompt positioning adjustment support. Usage: positionType:Xshift,Yshift (for ex.: bottomLeft:+20 or bottomLeft:-20,+10)
                var positionType = field.data("promptPosition") || options.promptPosition;
                if (typeof (positionType) == 'string')
                {
                    if (positionType.indexOf(":") != -1)
                    {
                        positionType = positionType.substring(0, positionType.indexOf(":"));
                    };
                };


                switch (positionType)
                {
                case "bottomLeft":
                case "bottomRight":
                    prompt.find(".formErrorContent").before(arrow);
                    arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');
                    break;
                case "topLeft":
                case "topRight":
                    arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');
                    prompt.append(arrow);
                    break;
                }
            }

            //Cedric: Needed if a container is in position:relative
            // insert prompt in the form or in the overflown container?
            if (options.isOverflown) field.before(prompt);
            else $("body").append(prompt);

            var pos = methods._calculatePosition(field, prompt, options);
            prompt.css(
            {
                "top": pos.callerTopPosition,
                "left": pos.callerleftPosition,
                "marginTop": pos.marginTopSize,
                "opacity": 0
            }).data("callerField", field);

            return prompt.animate(
            {
                "opacity": 0.87
            });

        },
        /**
         * Updates the prompt text field - the field for which the prompt
         * @param {jqObject} field
         * @param {String} promptText html text to display type
         * @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
         * @param {boolean} ajaxed - use to mark fields than being validated with ajax
         * @param {Map} options user options
         */
        _updatePrompt: function (field, prompt, promptText, type, ajaxed, options, noAnimation)
        {

            if (prompt)
            {
                if (typeof type !== "undefined")
                {
                    if (type == "pass") prompt.addClass("greenPopup");
                    else prompt.removeClass("greenPopup");

                    if (type == "load") prompt.addClass("blackPopup");
                    else prompt.removeClass("blackPopup");
                }
                if (ajaxed) prompt.addClass("ajaxed");
                else prompt.removeClass("ajaxed");

                prompt.find(".formErrorContent").html(promptText);

                var pos = methods._calculatePosition(field, prompt, options);
                css = {
                    "top": pos.callerTopPosition,
                    "left": pos.callerleftPosition,
                    "marginTop": pos.marginTopSize
                };

                if (noAnimation) prompt.css(css);
                else prompt.animate(css)
            }
        },
        /**
         * Closes the prompt associated with the given field
         *
         * @param {jqObject}
         *            field
         */
        _closePrompt: function (field)
        {

            var prompt = methods._getPrompt(field);
            if (prompt) prompt.fadeTo("fast", 0, function ()
            {
                prompt.remove();
            });
        },
        closePrompt: function (field)
        {
            return methods._closePrompt(field);
        },
        /**
         * Returns the error prompt matching the field if any
         *
         * @param {jqObject}
         *            field
         * @return undefined or the error prompt (jqObject)
         */
        _getPrompt: function (field)
        {
            var className = methods._getClassName(field.attr("id")) + "formError";
            var match = $("." + methods._escapeExpression(className))[0];
            if (match) return $(match);
        },
        /**
         * Returns the escapade classname
         *
         * @param {selector}
         *            className
         */
        _escapeExpression: function (selector)
        {
            return selector.replace(/([#;&,\.\+\*\~':"\!\^$\[\]\(\)=>\|])/g, "\\$1");
        },
        /**
         * Calculates prompt position
         *
         * @param {jqObject}
         *            field
         * @param {jqObject}
         *            the prompt
         * @param {Map}
         *            options
         * @return positions
         */
        _calculatePosition: function (field, promptElmt, options)
        {

            var promptTopPosition, promptleftPosition, marginTopSize;
            var fieldWidth = field.width();
            var promptHeight = promptElmt.height();

            var overflow = options.isOverflown;
            if (overflow)
            {
                // is the form contained in an overflown container?
                promptTopPosition = promptleftPosition = 0;
                // compensation for the arrow
                marginTopSize = -promptHeight;
            }
            else
            {
                var offset = field.offset();
                promptTopPosition = offset.top;
                promptleftPosition = offset.left;
                marginTopSize = 0;
            }

            //prompt positioning adjustment support 
            //now you can adjust prompt position
            //usage: positionType:Xshift,Yshift
            //for example: 
            //   bottomLeft:+20 means bottomLeft position shifted by 20 pixels right horizontally
            //   topRight:20, -15 means topRight position shifted by 20 pixels to right and 15 pixels to top
            //You can use +pixels, - pixels. If no sign is provided than + is default.
            var positionType = field.data("promptPosition") || options.promptPosition;
            var shift1 = "";
            var shift2 = "";
            var shiftX = 0;
            var shiftY = 0;
            if (typeof (positionType) == 'string')
            {
                //do we have any position adjustments ?
                if (positionType.indexOf(":") != -1)
                {
                    shift1 = positionType.substring(positionType.indexOf(":") + 1);
                    positionType = positionType.substring(0, positionType.indexOf(":"));

                    //if any advanced positioning will be needed (percents or something else) - parser should be added here
                    //for now we use simple parseInt()
                    //do we have second parameter?
                    if (shift1.indexOf(",") != -1)
                    {
                        shift2 = shift1.substring(shift1.indexOf(",") + 1);
                        shift1 = shift1.substring(0, shift1.indexOf(","));
                        shiftY = parseInt(shift2);
                        if (isNaN(shiftY))
                        {
                            shiftY = 0;
                        };
                    };

                    shiftX = parseInt(shift1);
                    if (isNaN(shift1))
                    {
                        shift1 = 0;
                    };

                };
            };

            switch (positionType)
            {

            default:
            case "topRight":
                if (overflow)
                // Is the form contained in an overflown container?
                promptleftPosition += fieldWidth - 30;
                else
                {
                    promptleftPosition += fieldWidth - 30;
                    promptTopPosition += -promptHeight - 2;
                }
                break;
            case "topLeft":
                promptTopPosition += -promptHeight - 10;
                break;
            case "centerRight":
                promptleftPosition += fieldWidth + 13;
                break;
            case "bottomLeft":
                promptTopPosition = promptTopPosition + field.height() + 15;
                break;
            case "bottomRight":
                promptleftPosition += fieldWidth - 30;
                promptTopPosition += field.height() + 5;
            }

            //apply adjusments if any
            promptleftPosition += shiftX;
            promptTopPosition += shiftY;

            return {
                "callerTopPosition": promptTopPosition + "px",
                "callerleftPosition": promptleftPosition + "px",
                "marginTopSize": marginTopSize + "px"
            };
        },
        /**
         * Saves the user options and variables in the form.data
         *
         * @param {jqObject}
         *            form - the form where the user option should be saved
         * @param {Map}
         *            options - the user options
         * @return the user options (extended from the defaults)
         */
        _saveOptions: function (form, options)
        {

            // is there a language localisation ?
            if ($.validationEngineLanguage) var allRules = $.validationEngineLanguage.allRules;
            else $.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");
            // --- Internals DO NOT TOUCH or OVERLOAD ---
            // validation rules and i18
            $.validationEngine.defaults.allrules = allRules;

            var userOptions = $.extend(true, {}, $.validationEngine.defaults, options);

            form.data('jqv', userOptions);
            return userOptions;
        },

        /**
         * Removes forbidden characters from class name
         * @param {String} className
         */
        _getClassName: function (className)
        {
            if (className)
            {
                return className.replace(/:/g, "_").replace(/\./g, "_");
            }
        }
    };

    /**
     * Plugin entry point.
     * You may pass an action as a parameter or a list of options.
     * if none, the init and attach methods are being called.
     * Remember: if you pass options, the attached method is NOT called automatically
     *
     * @param {String}
     *            method (optional) action
     */
    $.fn.validationEngine = function (method)
    {

        var form = $(this);
        if (!form[0]) return false; // stop here if the form does not exist
        if (typeof (method) == 'string' && method.charAt(0) != '_' && methods[method])
        {

            // make sure init is called once
            if (method != "showPrompt" && method != "hidePrompt" && method != "hide" && method != "hideAll") methods.init.apply(form);

            return methods[method].apply(form, Array.prototype.slice.call(arguments, 1));
        }
        else if (typeof method == 'object' || !method)
        {

            // default constructor with or without arguments
            methods.init.apply(form, arguments);
            return methods.attach.apply(form);
        }
        else
        {
            $.error('Method ' + method + ' does not exist in jQuery.validationEngine');
        }
    };



    // LEAK GLOBAL OPTIONS
    $.validationEngine = {
        defaults: {

            // Name of the event triggering field validation
            validationEventTrigger: "blur",
            // Automatically scroll viewport to the first error
            scroll: true,
            // Focus on the first input
            focusFirstField: true,
            // Opening box position, possible locations are: topLeft,
            // topRight, bottomLeft, centerRight, bottomRight
            promptPosition: "topRight",
            bindMethod: "bind",
            // internal, automatically set to true when it parse a _ajax rule
            inlineAjax: false,
            // if set to true, the form data is sent asynchronously via ajax to the form.action url (get)
            ajaxFormValidation: false,
            // Ajax form validation callback method: boolean onComplete(form, status, errors, options)
            // retuns false if the form.submit event needs to be canceled.
            ajaxFormValidationURL: false,
            // The url to send the submit ajax validation (default to action)
            onAjaxFormComplete: $.noop,
            // called right before the ajax call, may return false to cancel
            onBeforeAjaxFormValidation: $.noop,
            // Stops form from submitting and execute function assiciated with it
            onValidationComplete: false,

            // Used when the form is displayed within a scrolling DIV
            isOverflown: false,
            overflownDIV: "",

            // Used when you have a form fields too close and the errors messages are on top of other disturbing viewing messages
            doNotShowAllErrosOnSubmit: false,

            // true when form and fields are binded
            binded: false,
            // set to true, when the prompt arrow needs to be displayed
            showArrow: true,
            // did one of the validation fail ? kept global to stop further ajax validations
            isError: false,
            // Caches field validation status, typically only bad status are created.
            // the array is used during ajax form validation to detect issues early and prevent an expensive submit
            ajaxValidCache: {},
            // Auto update prompt position after window resize
            autoPositionUpdate: false,

            InvalidFields: [],
            onSuccess: false,
            onFailure: false
        }
    }
})(jQuery);

(function ($)
{
    $.fn.validationEngineLanguage = function ()
    {};
    $.validationEngineLanguage = {
        newLang: function ()
        {
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* This field is required",
                    "alertTextCheckboxMultiple": "* Please select an option",
                    "alertTextCheckboxe": "* This checkbox is required",
                    "alertTextDateRange": "* Both date range fields are required"
                },
                "dateRange": {
                    "regex": "none",
                    "alertText": "* Invalid ",
                    "alertText2": "Date Range"
                },
                "dateTimeRange": {
                    "regex": "none",
                    "alertText": "* Invalid ",
                    "alertText2": "Date Time Range"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Minimum ",
                    "alertText2": " characters allowed"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Maximum ",
                    "alertText2": " characters allowed"
                },
                "groupRequired": {
                    "regex": "none",
                    "alertText": "* You must fill one of the following fields"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* Minimum value is "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Maximum value is "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Date prior to "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Date past "
                },
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Maximum ",
                    "alertText2": " options allowed"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Please select ",
                    "alertText2": " options"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* Fields do not match"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,
                    "alertText": "* Invalid phone number"
                },
                "email": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
                    "alertText": "* Invalid email address"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Not a valid integer"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
                    "alertText": "* Invalid floating decimal number"
                },
                "date": {
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/,
                    "alertText": "* Invalid date, must be in YYYY-MM-DD format"
                },
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* Invalid IP address"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* Invalid URL"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Numbers only"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* Letters only"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* No special characters allowed"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This username is available",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* This name is already taken",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This name is available",
                    // speaks by itself
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxNameCallPhp": {
                    // remote json service location
                    "url": "phpajax/ajaxValidateFieldName.php",
                    // error
                    "alertText": "* This name is already taken",
                    // speaks by itself
                    "alertTextLoad": "* Validating, please wait"
                },
                "validate2fields": {
                    "alertText": "* Please input HELLO"
                },
                //tls warning:homegrown not fielded 
                "dateFormat": {
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* Invalid Date"
                },
                //tls warning:homegrown not fielded 
                "dateTimeFormat": {
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* Invalid Date or Date Format",
                    "alertText2": "Expected Format: ",
                    "alertText3": "mm/dd/yyyy hh:mm:ss AM|PM or ",
                    "alertText4": "yyyy-mm-dd hh:mm:ss AM|PM"
                }
            };

        }
    };

    $.validationEngineLanguage.newLang();

})(jQuery);

/**
 * jQuery lightBox plugin
 * This jQuery plugin was inspired and based on Lightbox 2 by Lokesh Dhakar (http://www.huddletogether.com/projects/lightbox2/)
 * and adapted to me for use like a plugin from jQuery.
 * @name jquery-lightbox-0.5.js
 * @author Leandro Vieira Pinho - http://leandrovieira.com
 * @version 0.5
 * @date April 11, 2008
 * @category jQuery plugin
 * @copyright (c) 2008 Leandro Vieira Pinho (leandrovieira.com)
 * @license CC Attribution-No Derivative Works 2.5 Brazil - http://creativecommons.org/licenses/by-nd/2.5/br/deed.en_US
 * @example Visit http://leandrovieira.com/projects/jquery/lightbox/ for more informations about this jQuery plugin
 */ (function ($)
{
    $.fn.lightBox = function (settings)
    {
        settings = jQuery.extend(
        {
            overlayBgColor: '#000',
            overlayOpacity: 0.8,
            fixedNavigation: false,
            imageLoading: './images/lightbox/lightbox-ico-loading.gif',
            imageBtnPrev: './images/lightbox/lightbox-btn-prev.gif',
            imageBtnNext: './images/lightbox/lightbox-btn-next.gif',
            imageBtnClose: './images/lightbox/lightbox-btn-close.gif',
            imageBlank: './images/lightbox/lightbox-blank.gif',
            containerBorderSize: 10,
            containerResizeSpeed: 400,
            txtImage: 'Image',
            txtOf: 'of',
            keyToClose: 'c',
            keyToPrev: 'p',
            keyToNext: 'n',
            imageArray: [],
            activeImage: 0
        }, settings);
        var jQueryMatchedObj = this;

        function _initialize()
        {
            _start(this, jQueryMatchedObj);
            return false;
        }

        function _start(objClicked, jQueryMatchedObj)
        {
            $('embed, object, select').css(
            {
                'visibility': 'hidden'
            });
            _set_interface();
            settings.imageArray.length = 0;
            settings.activeImage = 0;
            if (jQueryMatchedObj.length == 1)
            {
                settings.imageArray.push(new Array(objClicked.getAttribute('href'), objClicked.getAttribute('title')));
            }
            else
            {
                for (var i = 0; i < jQueryMatchedObj.length; i++)
                {
                    settings.imageArray.push(new Array(jQueryMatchedObj[i].getAttribute('href'), jQueryMatchedObj[i].getAttribute('title')));
                }
            }
            while (settings.imageArray[settings.activeImage][0] != objClicked.getAttribute('href'))
            {
                settings.activeImage++;
            }
            _set_image_to_view();
        }

        function _set_interface()
        {
            $('body').append('<div id="jquery-overlay"></div><div id="jquery-lightbox"><div id="lightbox-container-image-box"><div id="lightbox-container-image"><img id="lightbox-image"><div style="" id="lightbox-nav"><a href="#" id="lightbox-nav-btnPrev"></a><a href="#" id="lightbox-nav-btnNext"></a></div><div id="lightbox-loading"><a href="#" id="lightbox-loading-link"><img src="' + settings.imageLoading + '"></a></div></div></div><div id="lightbox-container-image-data-box"><div id="lightbox-container-image-data"><div id="lightbox-image-details"><span id="lightbox-image-details-caption"></span><span id="lightbox-image-details-currentNumber"></span></div><div id="lightbox-secNav"><a href="#" id="lightbox-secNav-btnClose"><img src="' + settings.imageBtnClose + '"></a></div></div></div></div>');
            var arrPageSizes = ___getPageSize();
            $('#jquery-overlay').css(
            {
                backgroundColor: settings.overlayBgColor,
                opacity: settings.overlayOpacity,
                width: arrPageSizes[0],
                height: arrPageSizes[1]
            }).fadeIn();
            var arrPageScroll = ___getPageScroll();
            $('#jquery-lightbox').css(
            {
                top: arrPageScroll[1] + (arrPageSizes[3] / 10),
                left: arrPageScroll[0]
            }).show();
            $('#jquery-overlay,#jquery-lightbox').click(function ()
            {
                _finish();
            });
            $('#lightbox-loading-link,#lightbox-secNav-btnClose').click(function ()
            {
                _finish();
                return false;
            });
            $(window).resize(function ()
            {
                var arrPageSizes = ___getPageSize();
                $('#jquery-overlay').css(
                {
                    width: arrPageSizes[0],
                    height: arrPageSizes[1]
                });
                var arrPageScroll = ___getPageScroll();
                $('#jquery-lightbox').css(
                {
                    top: arrPageScroll[1] + (arrPageSizes[3] / 10),
                    left: arrPageScroll[0]
                });
            });
        }

        function _set_image_to_view()
        {
            $('#lightbox-loading').show();
            if (settings.fixedNavigation)
            {
                $('#lightbox-image,#lightbox-container-image-data-box,#lightbox-image-details-currentNumber').hide();
            }
            else
            {
                $('#lightbox-image,#lightbox-nav,#lightbox-nav-btnPrev,#lightbox-nav-btnNext,#lightbox-container-image-data-box,#lightbox-image-details-currentNumber').hide();
            }
            var objImagePreloader = new Image();
            objImagePreloader.onload = function ()
            {
                $('#lightbox-image').attr('src', settings.imageArray[settings.activeImage][0]);
                _resize_container_image_box(objImagePreloader.width, objImagePreloader.height);
                objImagePreloader.onload = function ()
                {};
            };
            objImagePreloader.src = settings.imageArray[settings.activeImage][0];
        };

        function _resize_container_image_box(intImageWidth, intImageHeight)
        {
            var intCurrentWidth = $('#lightbox-container-image-box').width();
            var intCurrentHeight = $('#lightbox-container-image-box').height();
            var intWidth = (intImageWidth + (settings.containerBorderSize * 2));
            var intHeight = (intImageHeight + (settings.containerBorderSize * 2));
            var intDiffW = intCurrentWidth - intWidth;
            var intDiffH = intCurrentHeight - intHeight;
            $('#lightbox-container-image-box').animate(
            {
                width: intWidth,
                height: intHeight
            }, settings.containerResizeSpeed, function ()
            {
                _show_image();
            });
            if ((intDiffW == 0) && (intDiffH == 0))
            {
                if ($.browser.msie)
                {
                    ___pause(250);
                }
                else
                {
                    ___pause(100);
                }
            }
            $('#lightbox-container-image-data-box').css(
            {
                width: intImageWidth
            });
            $('#lightbox-nav-btnPrev,#lightbox-nav-btnNext').css(
            {
                height: intImageHeight + (settings.containerBorderSize * 2)
            });
        };

        function _show_image()
        {
            $('#lightbox-loading').hide();
            $('#lightbox-image').fadeIn(function ()
            {
                _show_image_data();
                _set_navigation();
            });
            _preload_neighbor_images();
        };

        function _show_image_data()
        {
            $('#lightbox-container-image-data-box').slideDown('fast');
            $('#lightbox-image-details-caption').hide();
            if (settings.imageArray[settings.activeImage][1])
            {
                $('#lightbox-image-details-caption').html(settings.imageArray[settings.activeImage][1]).show();
            }
            if (settings.imageArray.length > 1)
            {
                $('#lightbox-image-details-currentNumber').html(settings.txtImage + ' ' + (settings.activeImage + 1) + ' ' + settings.txtOf + ' ' + settings.imageArray.length).show();
            }
        }

        function _set_navigation()
        {
            $('#lightbox-nav').show();
            $('#lightbox-nav-btnPrev,#lightbox-nav-btnNext').css(
            {
                'background': 'transparent url(' + settings.imageBlank + ') no-repeat'
            });
            if (settings.activeImage != 0)
            {
                if (settings.fixedNavigation)
                {
                    $('#lightbox-nav-btnPrev').css(
                    {
                        'background': 'url(' + settings.imageBtnPrev + ') left 15% no-repeat'
                    }).unbind().bind('click', function ()
                    {
                        settings.activeImage = settings.activeImage - 1;
                        _set_image_to_view();
                        return false;
                    });
                }
                else
                {
                    $('#lightbox-nav-btnPrev').unbind().hover(function ()
                    {
                        $(this).css(
                        {
                            'background': 'url(' + settings.imageBtnPrev + ') left 15% no-repeat'
                        });
                    }, function ()
                    {
                        $(this).css(
                        {
                            'background': 'transparent url(' + settings.imageBlank + ') no-repeat'
                        });
                    }).show().bind('click', function ()
                    {
                        settings.activeImage = settings.activeImage - 1;
                        _set_image_to_view();
                        return false;
                    });
                }
            }
            if (settings.activeImage != (settings.imageArray.length - 1))
            {
                if (settings.fixedNavigation)
                {
                    $('#lightbox-nav-btnNext').css(
                    {
                        'background': 'url(' + settings.imageBtnNext + ') right 15% no-repeat'
                    }).unbind().bind('click', function ()
                    {
                        settings.activeImage = settings.activeImage + 1;
                        _set_image_to_view();
                        return false;
                    });
                }
                else
                {
                    $('#lightbox-nav-btnNext').unbind().hover(function ()
                    {
                        $(this).css(
                        {
                            'background': 'url(' + settings.imageBtnNext + ') right 15% no-repeat'
                        });
                    }, function ()
                    {
                        $(this).css(
                        {
                            'background': 'transparent url(' + settings.imageBlank + ') no-repeat'
                        });
                    }).show().bind('click', function ()
                    {
                        settings.activeImage = settings.activeImage + 1;
                        _set_image_to_view();
                        return false;
                    });
                }
            }
            _enable_keyboard_navigation();
        }

        function _enable_keyboard_navigation()
        {
            $(document).keydown(function (objEvent)
            {
                _keyboard_action(objEvent);
            });
        }

        function _disable_keyboard_navigation()
        {
            $(document).unbind();
        }

        function _keyboard_action(objEvent)
        {
            if (objEvent == null)
            {
                keycode = event.keyCode;
                escapeKey = 27;
            }
            else
            {
                keycode = objEvent.keyCode;
                escapeKey = objEvent.DOM_VK_ESCAPE;
            }
            key = String.fromCharCode(keycode).toLowerCase();
            if ((key == settings.keyToClose) || (key == 'x') || (keycode == escapeKey))
            {
                _finish();
            }
            if ((key == settings.keyToPrev) || (keycode == 37))
            {}
            if ((key == settings.keyToNext) || (keycode == 39))
            {}
        }

        function _preload_neighbor_images()
        {
            if ((settings.imageArray.length - 1) > settings.activeImage)
            {
                objNext = new Image();
                objNext.src = settings.imageArray[settings.activeImage + 1][0];
            }
            if (settings.activeImage > 0)
            {
                objPrev = new Image();
                objPrev.src = settings.imageArray[settings.activeImage - 1][0];
            }
        }

        function _finish()
        {
            $('#jquery-lightbox').remove();
            $('#jquery-overlay').fadeOut(function ()
            {
                $('#jquery-overlay').remove();
            });
            $('embed, object, select').css(
            {
                'visibility': 'visible'
            });
        }

        function ___getPageSize()
        {
            var xScroll, yScroll;
            if (window.innerHeight && window.scrollMaxY)
            {
                xScroll = window.innerWidth + window.scrollMaxX;
                yScroll = window.innerHeight + window.scrollMaxY;
            }
            else if (document.body.scrollHeight > document.body.offsetHeight)
            {
                xScroll = document.body.scrollWidth;
                yScroll = document.body.scrollHeight;
            }
            else
            {
                xScroll = document.body.offsetWidth;
                yScroll = document.body.offsetHeight;
            }
            var windowWidth, windowHeight;
            if (self.innerHeight)
            {
                if (document.documentElement.clientWidth)
                {
                    windowWidth = document.documentElement.clientWidth;
                }
                else
                {
                    windowWidth = self.innerWidth;
                }
                windowHeight = self.innerHeight;
            }
            else if (document.documentElement && document.documentElement.clientHeight)
            {
                windowWidth = document.documentElement.clientWidth;
                windowHeight = document.documentElement.clientHeight;
            }
            else if (document.body)
            {
                windowWidth = document.body.clientWidth;
                windowHeight = document.body.clientHeight;
            }
            if (yScroll < windowHeight)
            {
                pageHeight = windowHeight;
            }
            else
            {
                pageHeight = yScroll;
            }
            if (xScroll < windowWidth)
            {
                pageWidth = xScroll;
            }
            else
            {
                pageWidth = windowWidth;
            }
            arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
            return arrayPageSize;
        };

        function ___getPageScroll()
        {
            var xScroll, yScroll;
            if (self.pageYOffset)
            {
                yScroll = self.pageYOffset;
                xScroll = self.pageXOffset;
            }
            else if (document.documentElement && document.documentElement.scrollTop)
            {
                yScroll = document.documentElement.scrollTop;
                xScroll = document.documentElement.scrollLeft;
            }
            else if (document.body)
            {
                yScroll = document.body.scrollTop;
                xScroll = document.body.scrollLeft;
            }
            arrayPageScroll = new Array(xScroll, yScroll);
            return arrayPageScroll;
        };

        function ___pause(ms)
        {
            var date = new Date();
            curDate = null;
            do
            {
                var curDate = new Date();
            }
            while (curDate - date < ms);
        };
        return this.unbind('click').click(_initialize);
    };
})(jQuery);

(function ($)
{

    $.modal = function (config)
    {

        var defaults, options, container, header, close, content, title, overlay;

        defaults = {
            title: '',
            html: '',
            ajax: '',
            width: null,
            overlay: true,
            overlayClose: false,
            escClose: true
        };

        options = $.extend(defaults, config);

        container = $('<div>', {
            id: 'modal'
        });
        header = $('<div>', {
            id: 'modalHeader'
        });
        content = $('<div>', {
            id: 'modalContent'
        });
        overlay = $('<div>', {
            id: 'overlay'
        });
        title = $('<h2>', {
            text: options.title
        });
        close = $('<a>', {
            'class': 'close',
            href: 'javascript:;',
            html: '&times'
        });

        container.appendTo('body');
        header.appendTo(container);
        content.appendTo(container);
        if (options.overlay)
        {
            overlay.appendTo('body');
        }
        title.prependTo(header);
        close.appendTo(header);

        if (options.ajax == '' && options.html == '')
        {
            title.text('No Content');
        }

        if (options.ajax !== '')
        {
            content.html('<div id="modalLoader"><img src="./img/ajax-loader.gif" /></div>');
            $.modal.reposition();
            $.get(options.ajax, function (response)
            {
                content.html(response);
                $.modal.reposition();
            });
        }

        if (options.html !== '')
        {
            content.html(options.html);
        }

        close.bind('click', function (e)
        {
            e.preventDefault();
            $.modal.close();
        });

        if (options.overlayClose)
        {
            overlay.bind('click', function (e)
            {
                $.modal.close();
            });
        }

        if (options.escClose)
        {
            $(document).bind('keyup.modal', function (e)
            {
                var key = e.which || e.keyCode;

                if (key == 27)
                {
                    $.modal.close();
                }
            });
        }

        $.modal.reposition();
    }

    $.modal.reposition = function ()
    {
        var width = $('#modal').outerWidth();
        var centerOffset = width / 2;
        $('#modal').css(
        {
            'left': '50%',
            'top': $(window).scrollTop() + 75,
            'margin-left': '-' + centerOffset + 'px'
        });
    };

    $.modal.close = function ()
    {
        $('#modal').remove();
        $('#overlay').remove();
        $(document).unbind('keyup.modal');
    }

    function getPageScroll()
    {
        var xScroll, yScroll;

        if (self.pageYOffset)
        {
            yScroll = self.pageYOffset;
            xScroll = self.pageXOffset;
        }
        else if (document.documentElement && document.documentElement.scrollTop)
        { // Explorer 6 Strict
            yScroll = document.documentElement.scrollTop;
            xScroll = document.documentElement.scrollLeft;
        }
        else if (document.body)
        { // all other Explorers
            yScroll = document.body.scrollTop;
            xScroll = document.body.scrollLeft;
        }

        return new Array(xScroll, yScroll);
    }

})(jQuery);

(function ($)
{

    $.alert = function (config)
    {

        var defaults, options, container, content, actions, close, submit, cancel, title, overlay;

        defaults = {
            type: 'default',
            title: '',
            text: '',
            confirmText: 'Confirm',
            cancelText: 'Cancel',
            callback: function ()
            {},
            overlayClose: false,
            escClose: true
        };

        options = $.extend(defaults, config);

        container = $('<div>', {
            id: 'alert'
        });
        content = $('<div>', {
            id: 'alertContent'
        });
        close = $('<a>', {
            'class': 'close',
            href: 'javascript:;',
            html: '&times'
        });
        actions = $('<div>', {
            id: 'alertActions'
        });
        overlay = $('<div>', {
            id: 'overlay'
        });
        title = $('<h2>', {
            text: options.title
        });

        submit = $('<button>', {
            'class': 'btn btn-small btn-primary',
            text: options.confirmText
        });
        cancel = $('<button>', {
            'class': 'btn btn-small btn-quaternary',
            text: options.cancelText
        });

        container.appendTo('body');
        content.appendTo(container);
        close.appendTo(container);
        overlay.appendTo('body');
        title.prependTo(content);

        content.append(options.text);

        actions.appendTo(content);

        if (options.type === 'confirm')
        {
            submit.appendTo(actions);
            cancel.appendTo(actions);
        }
        else
        {
            submit.appendTo(actions);
            submit.text('Ok');
        }

        submit.bind('click', function (e)
        {
            e.preventDefault();

            if (typeof options.callback === 'function')
            {
                options.callback.apply();
            }

            $.alert.close();
        });

        submit.focus();

        cancel.bind('click', function (e)
        {
            e.preventDefault();
            $.alert.close();
        });

        close.bind('click', function (e)
        {
            e.preventDefault();
            $.alert.close();
        });

        if (options.overlayClose)
        {
            overlay.bind('click', function (e)
            {
                $.alert.close();
            });
        }

        if (options.escClose)
        {
            $(document).bind('keyup.alert', function (e)
            {
                var key = e.which || e.keyCode;

                if (key == 27)
                {
                    $.alert.close();
                }
            });
        }


    }

    $.alert.close = function ()
    {
        $('#alert').remove();
        $('#overlay').remove();
        $(document).unbind('keyup.alert');
    }

})(jQuery);


function tabClick(e)
{
    e.preventDefault();

    var $this = $(this);
    var id = $this.attr('href');
    var parent = $this.parents('.widget');

    $this.parent().addClass('active').siblings('li').removeClass('active');

    parent.find('.widget-content').hide();
    $(id).show();

}

/*
 ### jQuery Google Maps Plugin v1.01 ###
 * Home: http://www.mayzes.org/googlemaps.jquery.html
 * Code: http://www.mayzes.org/js/jquery.googlemaps1.01.js
 * Date: 2010-01-14 (Thursday, 14 Jan 2010)
 * 
 * Dual licensed under the MIT and GPL licenses.
 *   http://www.gnu.org/licenses/gpl.html
 *   http://www.opensource.org/licenses/mit-license.php
 ###
*/
jQuery.fn.googleMaps = function (options)
{

    if (!window.GBrowserIsCompatible || !GBrowserIsCompatible())
    {
        return this;
    }


    // Fill default values where not set by instantiation code
    var opts = $.extend(
    {}, $.googleMaps.defaults, options);

    //$.fn.googleMaps.includeGoogle(opts.key, opts.sensor);
    return this.each(function ()
    {
        // Create Map
        $.googleMaps.gMap = new GMap2(this, opts);
        $.googleMaps.mapsConfiguration(opts);
    });
};

$.googleMaps = {
    mapsConfiguration: function (opts)
    {
        // GEOCODE
        if (opts.geocode)
        {
            geocoder = new GClientGeocoder();
            geocoder.getLatLng(opts.geocode, function (center)
            {
                if (!center)
                {
                    alert(address + " not found");
                }
                else
                {
                    $.googleMaps.gMap.setCenter(center, opts.depth);
                    $.googleMaps.latitude = center.x;
                    $.googleMaps.longitude = center.y;
                }
            });
        }
        else
        {
            // Latitude & Longitude Center Point
            var center = $.googleMaps.mapLatLong(opts.latitude, opts.longitude);
            // Set the center of the Map with the new Center Point and Depth
            $.googleMaps.gMap.setCenter(center, opts.depth);
        }

        // POLYLINE
        if (opts.polyline)
        // Draw a PolyLine on the Map
        $.googleMaps.gMap.addOverlay($.googleMaps.mapPolyLine(opts.polyline));
        // GEODESIC 
        if (opts.geodesic)
        {
            $.googleMaps.mapGeoDesic(opts.geodesic);
        }
        // PAN
        if (opts.pan)
        {
            // Set Default Options
            opts.pan = $.googleMaps.mapPanOptions(opts.pan);
            // Pan the Map
            window.setTimeout(function ()
            {
                $.googleMaps.gMap.panTo($.googleMaps.mapLatLong(opts.pan.panLatitude, opts.pan.panLongitude));
            }, opts.pan.timeout);
        }

        // LAYER
        if (opts.layer)
        // Set the Custom Layer
        $.googleMaps.gMap.addOverlay(new GLayer(opts.layer));

        // MARKERS
        if (opts.markers) $.googleMaps.mapMarkers(center, opts.markers);

        // CONTROLS
        if (opts.controls.type || opts.controls.zoom || opts.controls.mapType)
        {
            $.googleMaps.mapControls(opts.controls);
        }
        else
        {
            if (!opts.controls.hide) $.googleMaps.gMap.setUIToDefault();
        }

        // SCROLL
        if (opts.scroll) $.googleMaps.gMap.enableScrollWheelZoom();
        else if (!opts.scroll) $.googleMaps.gMap.disableScrollWheelZoom();

        // LOCAL SEARCH
        if (opts.controls.localSearch) $.googleMaps.gMap.enableGoogleBar();
        else $.googleMaps.gMap.disableGoogleBar();

        // FEED (RSS/KML)
        if (opts.feed) $.googleMaps.gMap.addOverlay(new GGeoXml(opts.feed));

        // TRAFFIC INFO
        if (opts.trafficInfo)
        {
            var trafficOptions = {
                incidents: true
            };
            trafficInfo = new GTrafficOverlay(trafficOptions);
            $.googleMaps.gMap.addOverlay(trafficInfo);
        }

        // DIRECTIONS
        if (opts.directions)
        {
            $.googleMaps.directions = new GDirections($.googleMaps.gMap, opts.directions.panel);
            $.googleMaps.directions.load(opts.directions.route);
        }

        if (opts.streetViewOverlay)
        {
            svOverlay = new GStreetviewOverlay();
            $.googleMaps.gMap.addOverlay(svOverlay);
        }
    },
    mapGeoDesic: function (options)
    {
        // Default GeoDesic Options
        geoDesicDefaults = {
            startLatitude: 37.4419,
            startLongitude: -122.1419,
            endLatitude: 37.4519,
            endLongitude: -122.1519,
            color: '#ff0000',
            pixels: 2,
            opacity: 10
        }
        // Merge the User & Default Options
        options = $.extend(
        {}, geoDesicDefaults, options);
        var polyOptions = {
            geodesic: true
        };
        var polyline = new GPolyline([
        new GLatLng(options.startLatitude, options.startLongitude), new GLatLng(options.endLatitude, options.endLongitude)], options.color, options.pixels, options.opacity, polyOptions);
        $.googleMaps.gMap.addOverlay(polyline);
    },
    localSearchControl: function (options)
    {
        var controlLocation = $.googleMaps.mapControlsLocation(options.location);
        $.googleMaps.gMap.addControl(new $.googleMaps.gMap.LocalSearch(), new GControlPosition(controlLocation, new GSize(options.x, options.y)));
    },
    getLatitude: function ()
    {
        return $.googleMaps.latitude;
    },
    getLongitude: function ()
    {
        return $.googleMaps.longitude;
    },
    directions: {},
    latitude: '',
    longitude: '',
    latlong: {},
    maps: {},
    marker: {},
    gMap: {},
    defaults: {
        // Default Map Options
        latitude: 37.4419,
        longitude: -122.1419,
        depth: 13,
        scroll: true,
        trafficInfo: false,
        streetViewOverlay: false,
        controls: {
            hide: false,
            localSearch: false
        },
        layer: null
    },
    mapPolyLine: function (options)
    {
        // Default PolyLine Options
        polylineDefaults = {
            startLatitude: 37.4419,
            startLongitude: -122.1419,
            endLatitude: 37.4519,
            endLongitude: -122.1519,
            color: '#ff0000',
            pixels: 2
        }
        // Merge the User & Default Options
        options = $.extend(
        {}, polylineDefaults, options);
        //Return the New Polyline
        return new GPolyline([
        $.googleMaps.mapLatLong(options.startLatitude, options.startLongitude), $.googleMaps.mapLatLong(options.endLatitude, options.endLongitude)], options.color, options.pixels);
    },
    mapLatLong: function (latitude, longitude)
    {
        // Returns Latitude & Longitude Center Point
        return new GLatLng(latitude, longitude);
    },
    mapPanOptions: function (options)
    {
        // Returns Panning Options
        var panDefaults = {
            panLatitude: 37.4569,
            panLongitude: -122.1569,
            timeout: 0
        }
        return options = $.extend(
        {}, panDefaults, options);
    },
    mapMarkersOptions: function (icon)
    {
        //Define an icon
        var gIcon = new GIcon(G_DEFAULT_ICON);
        if (icon.image)
        // Define Icons Image
        gIcon.image = icon.image;
        if (icon.shadow)
        // Define Icons Shadow
        gIcon.shadow = icon.shadow;
        if (icon.iconSize)
        // Define Icons Size
        gIcon.iconSize = new GSize(icon.iconSize);
        if (icon.shadowSize)
        // Define Icons Shadow Size
        gIcon.shadowSize = new GSize(icon.shadowSize);
        if (icon.iconAnchor)
        // Define Icons Anchor
        gIcon.iconAnchor = new GPoint(icon.iconAnchor);
        if (icon.infoWindowAnchor)
        // Define Icons Info Window Anchor
        gIcon.infoWindowAnchor = new GPoint(icon.infoWindowAnchor);
        if (icon.dragCrossImage)
        // Define Drag Cross Icon Image
        gIcon.dragCrossImage = icon.dragCrossImage;
        if (icon.dragCrossSize)
        // Define Drag Cross Icon Size
        gIcon.dragCrossSize = new GSize(icon.dragCrossSize);
        if (icon.dragCrossAnchor)
        // Define Drag Cross Icon Anchor
        gIcon.dragCrossAnchor = new GPoint(icon.dragCrossAnchor);
        if (icon.maxHeight)
        // Define Icons Max Height
        gIcon.maxHeight = icon.maxHeight;
        if (icon.PrintImage)
        // Define Print Image
        gIcon.PrintImage = icon.PrintImage;
        if (icon.mozPrintImage)
        // Define Moz Print Image
        gIcon.mozPrintImage = icon.mozPrintImage;
        if (icon.PrintShadow)
        // Define Print Shadow
        gIcon.PrintShadow = icon.PrintShadow;
        if (icon.transparent)
        // Define Transparent
        gIcon.transparent = icon.transparent;
        return gIcon;
    },
    mapMarkers: function (center, markers)
    {
        if (typeof (markers.length) == 'undefined')
        // One marker only. Parse it into an array for consistency.
        markers = [markers];

        var j = 0;
        for (i = 0; i < markers.length; i++)
        {
            var gIcon = null;
            if (markers[i].icon)
            {
                gIcon = $.googleMaps.mapMarkersOptions(markers[i].icon);
            }

            if (markers[i].geocode)
            {
                var geocoder = new GClientGeocoder();
                geocoder.getLatLng(markers[i].geocode, function (center)
                {
                    if (!center) alert(address + " not found");
                    else $.googleMaps.marker[i] = new GMarker(center, {
                        draggable: markers[i].draggable,
                        icon: gIcon
                    });
                });
            }
            else if (markers[i].latitude && markers[i].longitude)
            {
                // Latitude & Longitude Center Point
                center = $.googleMaps.mapLatLong(markers[i].latitude, markers[i].longitude);
                $.googleMaps.marker[i] = new GMarker(center, {
                    draggable: markers[i].draggable,
                    icon: gIcon
                });
            }
            $.googleMaps.gMap.addOverlay($.googleMaps.marker[i]);
            if (markers[i].info)
            {
                // Hide Div Layer With Info Window HTML
                $(markers[i].info.layer).hide();
                // Marker Div Layer Exists
                if (markers[i].info.popup)
                // Map Marker Shows an Info Box on Load
                $.googleMaps.marker[i].openInfoWindowHtml($(markers[i].info.layer).html());
                else $.googleMaps.marker[i].bindInfoWindowHtml($(markers[i].info.layer).html().toString());
            }
        }
    },
    mapControlsLocation: function (location)
    {
        switch (location)
        {
        case 'G_ANCHOR_TOP_RIGHT':
            return G_ANCHOR_TOP_RIGHT;
            break;
        case 'G_ANCHOR_BOTTOM_RIGHT':
            return G_ANCHOR_BOTTOM_RIGHT;
            break;
        case 'G_ANCHOR_TOP_LEFT':
            return G_ANCHOR_TOP_LEFT;
            break;
        case 'G_ANCHOR_BOTTOM_LEFT':
            return G_ANCHOR_BOTTOM_LEFT;
            break;
        }
        return;
    },
    mapControl: function (control)
    {
        switch (control)
        {
        case 'GLargeMapControl3D':
            return new GLargeMapControl3D();
            break;
        case 'GLargeMapControl':
            return new GLargeMapControl();
            break;
        case 'GSmallMapControl':
            return new GSmallMapControl();
            break;
        case 'GSmallZoomControl3D':
            return new GSmallZoomControl3D();
            break;
        case 'GSmallZoomControl':
            return new GSmallZoomControl();
            break;
        case 'GScaleControl':
            return new GScaleControl();
            break;
        case 'GMapTypeControl':
            return new GMapTypeControl();
            break;
        case 'GHierarchicalMapTypeControl':
            return new GHierarchicalMapTypeControl();
            break;
        case 'GOverviewMapControl':
            return new GOverviewMapControl();
            break;
        case 'GNavLabelControl':
            return new GNavLabelControl();
            break;
        }
        return;
    },
    mapTypeControl: function (type)
    {
        switch (type)
        {
        case 'G_NORMAL_MAP':
            return G_NORMAL_MAP;
            break;
        case 'G_SATELLITE_MAP':
            return G_SATELLITE_MAP;
            break;
        case 'G_HYBRID_MAP':
            return G_HYBRID_MAP;
            break;
        }
        return;
    },
    mapControls: function (options)
    {
        // Default Controls Options
        controlsDefaults = {
            type: {
                location: 'G_ANCHOR_TOP_RIGHT',
                x: 10,
                y: 10,
                control: 'GMapTypeControl'
            },
            zoom: {
                location: 'G_ANCHOR_TOP_LEFT',
                x: 10,
                y: 10,
                control: 'GLargeMapControl3D'
            }
        };
        // Merge the User & Default Options
        options = $.extend(
        {}, controlsDefaults, options);
        options.type = $.extend(
        {}, controlsDefaults.type, options.type);
        options.zoom = $.extend(
        {}, controlsDefaults.zoom, options.zoom);

        if (options.type)
        {
            var controlLocation = $.googleMaps.mapControlsLocation(options.type.location);
            var controlPosition = new GControlPosition(controlLocation, new GSize(options.type.x, options.type.y));
            $.googleMaps.gMap.addControl($.googleMaps.mapControl(options.type.control), controlPosition);
        }
        if (options.zoom)
        {
            var controlLocation = $.googleMaps.mapControlsLocation(options.zoom.location);
            var controlPosition = new GControlPosition(controlLocation, new GSize(options.zoom.x, options.zoom.y))
            $.googleMaps.gMap.addControl($.googleMaps.mapControl(options.zoom.control), controlPosition);
        }
        if (options.mapType)
        {
            if (options.mapType.length >= 1)
            {
                for (i = 0; i < options.mapType.length; i++)
                {
                    if (options.mapType[i].remove) $.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType[i].remove));
                    if (options.mapType[i].add) $.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType[i].add));
                }
            }
            else
            {
                if (options.mapType.add) $.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType.add));
                if (options.mapType.remove) $.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType.remove));
            }
        }
    },
    geoCode: function (options)
    {
        geocoder = new GClientGeocoder();

        geocoder.getLatLng(options.address, function (point)
        {
            if (!point) alert(address + " not found");
            else $.googleMaps.gMap.setCenter(point, options.depth);
        });
    }
};

/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */ (function ($)
{
    var ColorPicker = function ()
        {
            var
            ids = {},
                inAction, charMin = 65,
                visible, tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
                defaults = {
                    eventName: 'click',
                    onShow: function ()
                    {},
                    onBeforeShow: function ()
                    {},
                    onHide: function ()
                    {},
                    onChange: function ()
                    {},
                    onSubmit: function ()
                    {},
                    color: 'ff0000',
                    livePreview: true,
                    flat: false
                },
                fillRGBFields = function (hsb, cal)
                {
                    var rgb = HSBToRGB(hsb);
                    $(cal).data('colorpicker').fields.eq(1).val(rgb.r).end().eq(2).val(rgb.g).end().eq(3).val(rgb.b).end();
                },
                fillHSBFields = function (hsb, cal)
                {
                    $(cal).data('colorpicker').fields.eq(4).val(hsb.h).end().eq(5).val(hsb.s).end().eq(6).val(hsb.b).end();
                },
                fillHexFields = function (hsb, cal)
                {
                    $(cal).data('colorpicker').fields.eq(0).val(HSBToHex(hsb)).end();
                },
                setSelector = function (hsb, cal)
                {
                    $(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex(
                    {
                        h: hsb.h,
                        s: 100,
                        b: 100
                    }));
                    $(cal).data('colorpicker').selectorIndic.css(
                    {
                        left: parseInt(150 * hsb.s / 100, 10),
                        top: parseInt(150 * (100 - hsb.b) / 100, 10)
                    });
                },
                setHue = function (hsb, cal)
                {
                    $(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h / 360, 10));
                },
                setCurrentColor = function (hsb, cal)
                {
                    $(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
                },
                setNewColor = function (hsb, cal)
                {
                    $(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
                },
                keyDown = function (ev)
                {
                    var pressedKey = ev.charCode || ev.keyCode || -1;
                    if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32)
                    {
                        return false;
                    }
                    var cal = $(this).parent().parent();
                    if (cal.data('colorpicker').livePreview === true)
                    {
                        change.apply(this);
                    }
                },
                change = function (ev)
                {
                    var cal = $(this).parent().parent(),
                        col;
                    if (this.parentNode.className.indexOf('_hex') > 0)
                    {
                        cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
                    }
                    else if (this.parentNode.className.indexOf('_hsb') > 0)
                    {
                        cal.data('colorpicker').color = col = fixHSB(
                        {
                            h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
                            s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
                            b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
                        });
                    }
                    else
                    {
                        cal.data('colorpicker').color = col = RGBToHSB(fixRGB(
                        {
                            r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
                            g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
                            b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
                        }));
                    }
                    if (ev)
                    {
                        fillRGBFields(col, cal.get(0));
                        fillHexFields(col, cal.get(0));
                        fillHSBFields(col, cal.get(0));
                    }
                    setSelector(col, cal.get(0));
                    setHue(col, cal.get(0));
                    setNewColor(col, cal.get(0));
                    cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
                },
                blur = function (ev)
                {
                    var cal = $(this).parent().parent();
                    cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                },
                focus = function ()
                {
                    charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
                    $(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                    $(this).parent().addClass('colorpicker_focus');
                },
                downIncrement = function (ev)
                {
                    var field = $(this).parent().find('input').focus();
                    var current = {
                        el: $(this).parent().addClass('colorpicker_slider'),
                        max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
                        y: ev.pageY,
                        field: field,
                        val: parseInt(field.val(), 10),
                        preview: $(this).parent().parent().data('colorpicker').livePreview
                    };
                    $(document).bind('mouseup', current, upIncrement);
                    $(document).bind('mousemove', current, moveIncrement);
                },
                moveIncrement = function (ev)
                {
                    ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
                    if (ev.data.preview)
                    {
                        change.apply(ev.data.field.get(0), [true]);
                    }
                    return false;
                },
                upIncrement = function (ev)
                {
                    change.apply(ev.data.field.get(0), [true]);
                    ev.data.el.removeClass('colorpicker_slider').find('input').focus();
                    $(document).unbind('mouseup', upIncrement);
                    $(document).unbind('mousemove', moveIncrement);
                    return false;
                },
                downHue = function (ev)
                {
                    var current = {
                        cal: $(this).parent(),
                        y: $(this).offset().top
                    };
                    current.preview = current.cal.data('colorpicker').livePreview;
                    $(document).bind('mouseup', current, upHue);
                    $(document).bind('mousemove', current, moveHue);
                },
                moveHue = function (ev)
                {
                    change.apply(
                    ev.data.cal.data('colorpicker').fields.eq(4).val(parseInt(360 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.y)))) / 150, 10)).get(0), [ev.data.preview]);
                    return false;
                },
                upHue = function (ev)
                {
                    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    $(document).unbind('mouseup', upHue);
                    $(document).unbind('mousemove', moveHue);
                    return false;
                },
                downSelector = function (ev)
                {
                    var current = {
                        cal: $(this).parent(),
                        pos: $(this).offset()
                    };
                    current.preview = current.cal.data('colorpicker').livePreview;
                    $(document).bind('mouseup', current, upSelector);
                    $(document).bind('mousemove', current, moveSelector);
                },
                moveSelector = function (ev)
                {
                    change.apply(
                    ev.data.cal.data('colorpicker').fields.eq(6).val(parseInt(100 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.pos.top)))) / 150, 10)).end().eq(5).val(parseInt(100 * (Math.max(0, Math.min(150, (ev.pageX - ev.data.pos.left)))) / 150, 10)).get(0), [ev.data.preview]);
                    return false;
                },
                upSelector = function (ev)
                {
                    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    $(document).unbind('mouseup', upSelector);
                    $(document).unbind('mousemove', moveSelector);
                    return false;
                },
                enterSubmit = function (ev)
                {
                    $(this).addClass('colorpicker_focus');
                },
                leaveSubmit = function (ev)
                {
                    $(this).removeClass('colorpicker_focus');
                },
                clickSubmit = function (ev)
                {
                    var cal = $(this).parent();
                    var col = cal.data('colorpicker').color;
                    cal.data('colorpicker').origColor = col;
                    setCurrentColor(col, cal.get(0));
                    cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
                },
                show = function (ev)
                {
                    var cal = $('#' + $(this).data('colorpickerId'));
                    cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
                    var pos = $(this).offset();
                    var viewPort = getViewport();
                    var top = pos.top + this.offsetHeight;
                    var left = pos.left;
                    if (top + 176 > viewPort.t + viewPort.h)
                    {
                        top -= this.offsetHeight + 176;
                    }
                    if (left + 356 > viewPort.l + viewPort.w)
                    {
                        left -= 356;
                    }
                    cal.css(
                    {
                        left: left + 'px',
                        top: top + 'px'
                    });
                    if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false)
                    {
                        cal.show();
                    }
                    $(document).bind('mousedown', {
                        cal: cal
                    }, hide);
                    return false;
                },
                hide = function (ev)
                {
                    if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0)))
                    {
                        if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false)
                        {
                            ev.data.cal.hide();
                        }
                        $(document).unbind('mousedown', hide);
                    }
                },
                isChildOf = function (parentEl, el, container)
                {
                    if (parentEl == el)
                    {
                        return true;
                    }
                    if (parentEl.contains)
                    {
                        return parentEl.contains(el);
                    }
                    if (parentEl.compareDocumentPosition)
                    {
                        return !!(parentEl.compareDocumentPosition(el) & 16);
                    }
                    var prEl = el.parentNode;
                    while (prEl && prEl != container)
                    {
                        if (prEl == parentEl) return true;
                        prEl = prEl.parentNode;
                    }
                    return false;
                },
                getViewport = function ()
                {
                    var m = document.compatMode == 'CSS1Compat';
                    return {
                        l: window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
                        t: window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
                        w: window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
                        h: window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
                    };
                },
                fixHSB = function (hsb)
                {
                    return {
                        h: Math.min(360, Math.max(0, hsb.h)),
                        s: Math.min(100, Math.max(0, hsb.s)),
                        b: Math.min(100, Math.max(0, hsb.b))
                    };
                },
                fixRGB = function (rgb)
                {
                    return {
                        r: Math.min(255, Math.max(0, rgb.r)),
                        g: Math.min(255, Math.max(0, rgb.g)),
                        b: Math.min(255, Math.max(0, rgb.b))
                    };
                },
                fixHex = function (hex)
                {
                    var len = 6 - hex.length;
                    if (len > 0)
                    {
                        var o = [];
                        for (var i = 0; i < len; i++)
                        {
                            o.push('0');
                        }
                        o.push(hex);
                        hex = o.join('');
                    }
                    return hex;
                },
                HexToRGB = function (hex)
                {
                    var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
                    return {
                        r: hex >> 16,
                        g: (hex & 0x00FF00) >> 8,
                        b: (hex & 0x0000FF)
                    };
                },
                HexToHSB = function (hex)
                {
                    return RGBToHSB(HexToRGB(hex));
                },
                RGBToHSB = function (rgb)
                {
                    var hsb = {
                        h: 0,
                        s: 0,
                        b: 0
                    };
                    var min = Math.min(rgb.r, rgb.g, rgb.b);
                    var max = Math.max(rgb.r, rgb.g, rgb.b);
                    var delta = max - min;
                    hsb.b = max;
                    if (max != 0)
                    {

                        }
                    hsb.s = max != 0 ? 255 * delta / max : 0;
                    if (hsb.s != 0)
                    {
                        if (rgb.r == max)
                        {
                            hsb.h = (rgb.g - rgb.b) / delta;
                        }
                        else if (rgb.g == max)
                        {
                            hsb.h = 2 + (rgb.b - rgb.r) / delta;
                        }
                        else
                        {
                            hsb.h = 4 + (rgb.r - rgb.g) / delta;
                        }
                    }
                    else
                    {
                        hsb.h = -1;
                    }
                    hsb.h *= 60;
                    if (hsb.h < 0)
                    {
                        hsb.h += 360;
                    }
                    hsb.s *= 100 / 255;
                    hsb.b *= 100 / 255;
                    return hsb;
                },
                HSBToRGB = function (hsb)
                {
                    var rgb = {};
                    var h = Math.round(hsb.h);
                    var s = Math.round(hsb.s * 255 / 100);
                    var v = Math.round(hsb.b * 255 / 100);
                    if (s == 0)
                    {
                        rgb.r = rgb.g = rgb.b = v;
                    }
                    else
                    {
                        var t1 = v;
                        var t2 = (255 - s) * v / 255;
                        var t3 = (t1 - t2) * (h % 60) / 60;
                        if (h == 360) h = 0;
                        if (h < 60)
                        {
                            rgb.r = t1;
                            rgb.b = t2;
                            rgb.g = t2 + t3
                        }
                        else if (h < 120)
                        {
                            rgb.g = t1;
                            rgb.b = t2;
                            rgb.r = t1 - t3
                        }
                        else if (h < 180)
                        {
                            rgb.g = t1;
                            rgb.r = t2;
                            rgb.b = t2 + t3
                        }
                        else if (h < 240)
                        {
                            rgb.b = t1;
                            rgb.r = t2;
                            rgb.g = t1 - t3
                        }
                        else if (h < 300)
                        {
                            rgb.b = t1;
                            rgb.g = t2;
                            rgb.r = t2 + t3
                        }
                        else if (h < 360)
                        {
                            rgb.r = t1;
                            rgb.g = t2;
                            rgb.b = t1 - t3
                        }
                        else
                        {
                            rgb.r = 0;
                            rgb.g = 0;
                            rgb.b = 0
                        }
                    }
                    return {
                        r: Math.round(rgb.r),
                        g: Math.round(rgb.g),
                        b: Math.round(rgb.b)
                    };
                },
                RGBToHex = function (rgb)
                {
                    var hex = [
                    rgb.r.toString(16), rgb.g.toString(16), rgb.b.toString(16)];
                    $.each(hex, function (nr, val)
                    {
                        if (val.length == 1)
                        {
                            hex[nr] = '0' + val;
                        }
                    });
                    return hex.join('');
                },
                HSBToHex = function (hsb)
                {
                    return RGBToHex(HSBToRGB(hsb));
                },
                restoreOriginal = function ()
                {
                    var cal = $(this).parent();
                    var col = cal.data('colorpicker').origColor;
                    cal.data('colorpicker').color = col;
                    fillRGBFields(col, cal.get(0));
                    fillHexFields(col, cal.get(0));
                    fillHSBFields(col, cal.get(0));
                    setSelector(col, cal.get(0));
                    setHue(col, cal.get(0));
                    setNewColor(col, cal.get(0));
                };
            return {
                init: function (opt)
                {
                    opt = $.extend(
                    {}, defaults, opt || {});
                    if (typeof opt.color == 'string')
                    {
                        opt.color = HexToHSB(opt.color);
                    }
                    else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined)
                    {
                        opt.color = RGBToHSB(opt.color);
                    }
                    else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined)
                    {
                        opt.color = fixHSB(opt.color);
                    }
                    else
                    {
                        return this;
                    }
                    return this.each(function ()
                    {
                        if (!$(this).data('colorpickerId'))
                        {
                            var options = $.extend(
                            {}, opt);
                            options.origColor = opt.color;
                            var id = 'collorpicker_' + parseInt(Math.random() * 1000);
                            $(this).data('colorpickerId', id);
                            var cal = $(tpl).attr('id', id);
                            if (options.flat)
                            {
                                cal.appendTo(this).show();
                            }
                            else
                            {
                                cal.appendTo(document.body);
                            }
                            options.fields = cal.find('input').bind('keyup', keyDown).bind('change', change).bind('blur', blur).bind('focus', focus);
                            cal.find('span').bind('mousedown', downIncrement).end().find('>div.colorpicker_current_color').bind('click', restoreOriginal);
                            options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
                            options.selectorIndic = options.selector.find('div div');
                            options.el = this;
                            options.hue = cal.find('div.colorpicker_hue div');
                            cal.find('div.colorpicker_hue').bind('mousedown', downHue);
                            options.newColor = cal.find('div.colorpicker_new_color');
                            options.currentColor = cal.find('div.colorpicker_current_color');
                            cal.data('colorpicker', options);
                            cal.find('div.colorpicker_submit').bind('mouseenter', enterSubmit).bind('mouseleave', leaveSubmit).bind('click', clickSubmit);
                            fillRGBFields(options.color, cal.get(0));
                            fillHSBFields(options.color, cal.get(0));
                            fillHexFields(options.color, cal.get(0));
                            setHue(options.color, cal.get(0));
                            setSelector(options.color, cal.get(0));
                            setCurrentColor(options.color, cal.get(0));
                            setNewColor(options.color, cal.get(0));
                            if (options.flat)
                            {
                                cal.css(
                                {
                                    position: 'relative',
                                    display: 'block'
                                });
                            }
                            else
                            {
                                $(this).bind(options.eventName, show);
                            }
                        }
                    });
                },
                showPicker: function ()
                {
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            show.apply(this);
                        }
                    });
                },
                hidePicker: function ()
                {
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            $('#' + $(this).data('colorpickerId')).hide();
                        }
                    });
                },
                setColor: function (col)
                {
                    if (typeof col == 'string')
                    {
                        col = HexToHSB(col);
                    }
                    else if (col.r != undefined && col.g != undefined && col.b != undefined)
                    {
                        col = RGBToHSB(col);
                    }
                    else if (col.h != undefined && col.s != undefined && col.b != undefined)
                    {
                        col = fixHSB(col);
                    }
                    else
                    {
                        return this;
                    }
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            var cal = $('#' + $(this).data('colorpickerId'));
                            cal.data('colorpicker').color = col;
                            cal.data('colorpicker').origColor = col;
                            fillRGBFields(col, cal.get(0));
                            fillHSBFields(col, cal.get(0));
                            fillHexFields(col, cal.get(0));
                            setHue(col, cal.get(0));
                            setSelector(col, cal.get(0));
                            setCurrentColor(col, cal.get(0));
                            setNewColor(col, cal.get(0));
                        }
                    });
                }
            };
        }();
    $.fn.extend(
    {
        ColorPicker: ColorPicker.init,
        ColorPickerHide: ColorPicker.hidePicker,
        ColorPickerShow: ColorPicker.showPicker,
        ColorPickerSetColor: ColorPicker.setColor
    });
})(jQuery)

var ChartHelper = function ()
    {

        var visualizeChartType = 'area';
        var visualizeChartHeight = '280px';
        var visualizeChartColors = ['#06C', '#222', '#777', '#555', '#002646', '#999', '#bbb', '#ccc', '#eee'];
        var visualizeChartWidth = '';

        return {
            fusion: fusion,
            visualize: visualize
        };

        function visualize(config)
        {
            config.el.each(function ()
            {
                visualizeChartHeight = ($(this).attr('data-chart-height') != null) ? $(this).attr('data-chart-height') + 'px' : visualizeChartHeight;
                visualizeChartType = ($(this).attr('data-chart-type') != null) ? $(this).attr('data-chart-type') : visualizeChartType;

                visualizeChartWidth = $(this).parent().width() * .92;

                if (visualizeChartType == 'line' || visualizeChartType == 'pie')
                {
                    $(this).hide().visualize(
                    {
                        type: visualizeChartType,
                        width: visualizeChartWidth,
                        height: visualizeChartHeight,
                        colors: visualizeChartColors,
                        lineDots: 'double',
                        interaction: true,
                        multiHover: 5,
                        tooltip: true,
                        tooltiphtml: function (data)
                        {
                            var html = '';
                            for (var i = 0; i < data.point.length; i++)
                            {
                                html += '<p class="chart_tooltip"><strong>' + data.point[i].value + '</strong> ' + data.point[i].yLabels[0] + '</p>';
                            }
                            return html;
                        }
                    }).addClass('chartHelperChart');;
                }
                else
                {
                    $(this).hide().visualize(
                    {
                        type: visualizeChartType,
                        colors: visualizeChartColors,
                        width: visualizeChartWidth,
                        height: visualizeChartHeight
                    }).addClass('chartHelperChart');
                }
            });
        }

        function fusion(object)
        {

            var el = $('#' + object.id);

            el.addClass('chart-holder');
            el.empty();
            object.width = object.width || el.width();
            object.height = object.height || el.height();

            object.width = el.width();

            var chart = new FusionCharts("./FusionCharts/FCF_" + object.chart + ".swf", object.id, object.width, object.height);
            if (object.dataUrl)
            {
                chart.setDataURL(object.dataUrl);
            }
            else
            {
                chart.setDataXML(object.data);
            }

            chart.render(object.id);

            return chart;

        }
    }();

$(function ()
{
   
    $('.uniformForm').find("select, input:checkbox, input:radio, input:file").uniform();

    $('.validateForm').validationEngine();

});
{
    $('.chartHelperChart').remove();
    ChartHelper.visualize(
    {
        el: $('table.stats')
    });
}