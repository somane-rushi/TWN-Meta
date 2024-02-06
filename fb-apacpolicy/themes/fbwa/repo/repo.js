/*! Select2 4.1.0-beta.1 | https://github.com/select2/select2/blob/master/LICENSE.md */
!(function (n) {
    "function" == typeof define && define.amd
        ? define(["jquery"], n)
        : "object" == typeof module && module.exports
        ? (module.exports = function (e, t) {
              return void 0 === t && (t = "undefined" != typeof window ? require("jquery") : require("jquery")(e)), n(t), t;
          })
        : n(jQuery);
})(function (d) {
    var e = (function () {
            if (d && d.fn && d.fn.select2 && d.fn.select2.amd) var e = d.fn.select2.amd;
            var t, n, i, h, s, r, f, g, m, v, y, _, o, a, w, l;
            function b(e, t) {
                return o.call(e, t);
            }
            function c(e, t) {
                var n,
                    i,
                    o,
                    s,
                    r,
                    a,
                    l,
                    c,
                    u,
                    d,
                    p,
                    h = t && t.split("/"),
                    f = y.map,
                    g = (f && f["*"]) || {};
                if (e) {
                    for (r = (e = e.split("/")).length - 1, y.nodeIdCompat && w.test(e[r]) && (e[r] = e[r].replace(w, "")), "." === e[0].charAt(0) && h && (e = h.slice(0, h.length - 1).concat(e)), u = 0; u < e.length; u++)
                        if ("." === (p = e[u])) e.splice(u, 1), (u -= 1);
                        else if (".." === p) {
                            if (0 === u || (1 === u && ".." === e[2]) || ".." === e[u - 1]) continue;
                            0 < u && (e.splice(u - 1, 2), (u -= 2));
                        }
                    e = e.join("/");
                }
                if ((h || g) && f) {
                    for (u = (n = e.split("/")).length; 0 < u; u -= 1) {
                        if (((i = n.slice(0, u).join("/")), h))
                            for (d = h.length; 0 < d; d -= 1)
                                if ((o = (o = f[h.slice(0, d).join("/")]) && o[i])) {
                                    (s = o), (a = u);
                                    break;
                                }
                        if (s) break;
                        !l && g && g[i] && ((l = g[i]), (c = u));
                    }
                    !s && l && ((s = l), (a = c)), s && (n.splice(0, a, s), (e = n.join("/")));
                }
                return e;
            }
            function x(t, n) {
                return function () {
                    var e = a.call(arguments, 0);
                    return "string" != typeof e[0] && 1 === e.length && e.push(null), r.apply(h, e.concat([t, n]));
                };
            }
            function A(t) {
                return function (e) {
                    m[t] = e;
                };
            }
            function D(e) {
                if (b(v, e)) {
                    var t = v[e];
                    delete v[e], (_[e] = !0), s.apply(h, t);
                }
                if (!b(m, e) && !b(_, e)) throw new Error("No " + e);
                return m[e];
            }
            function u(e) {
                var t,
                    n = e ? e.indexOf("!") : -1;
                return -1 < n && ((t = e.substring(0, n)), (e = e.substring(n + 1, e.length))), [t, e];
            }
            function S(e) {
                return e ? u(e) : [];
            }
            return (
                (e && e.requirejs) ||
                    (e ? (n = e) : (e = {}),
                    (m = {}),
                    (v = {}),
                    (y = {}),
                    (_ = {}),
                    (o = Object.prototype.hasOwnProperty),
                    (a = [].slice),
                    (w = /\.js$/),
                    (f = function (e, t) {
                        var n,
                            i = u(e),
                            o = i[0],
                            s = t[1];
                        return (
                            (e = i[1]),
                            o && (n = D((o = c(o, s)))),
                            o
                                ? (e =
                                      n && n.normalize
                                          ? n.normalize(
                                                e,
                                                (function (t) {
                                                    return function (e) {
                                                        return c(e, t);
                                                    };
                                                })(s)
                                            )
                                          : c(e, s))
                                : ((o = (i = u((e = c(e, s))))[0]), (e = i[1]), o && (n = D(o))),
                            { f: o ? o + "!" + e : e, n: e, pr: o, p: n }
                        );
                    }),
                    (g = {
                        require: function (e) {
                            return x(e);
                        },
                        exports: function (e) {
                            var t = m[e];
                            return void 0 !== t ? t : (m[e] = {});
                        },
                        module: function (e) {
                            return {
                                id: e,
                                uri: "",
                                exports: m[e],
                                config: (function (e) {
                                    return function () {
                                        return (y && y.config && y.config[e]) || {};
                                    };
                                })(e),
                            };
                        },
                    }),
                    (s = function (e, t, n, i) {
                        var o,
                            s,
                            r,
                            a,
                            l,
                            c,
                            u,
                            d = [],
                            p = typeof n;
                        if (((c = S((i = i || e))), "undefined" == p || "function" == p)) {
                            for (t = !t.length && n.length ? ["require", "exports", "module"] : t, l = 0; l < t.length; l += 1)
                                if ("require" === (s = (a = f(t[l], c)).f)) d[l] = g.require(e);
                                else if ("exports" === s) (d[l] = g.exports(e)), (u = !0);
                                else if ("module" === s) o = d[l] = g.module(e);
                                else if (b(m, s) || b(v, s) || b(_, s)) d[l] = D(s);
                                else {
                                    if (!a.p) throw new Error(e + " missing " + s);
                                    a.p.load(a.n, x(i, !0), A(s), {}), (d[l] = m[s]);
                                }
                            (r = n ? n.apply(m[e], d) : void 0), e && (o && o.exports !== h && o.exports !== m[e] ? (m[e] = o.exports) : (r === h && u) || (m[e] = r));
                        } else e && (m[e] = n);
                    }),
                    (t = n = r = function (e, t, n, i, o) {
                        if ("string" == typeof e) return g[e] ? g[e](t) : D(f(e, S(t)).f);
                        if (!e.splice) {
                            if (((y = e).deps && r(y.deps, y.callback), !t)) return;
                            t.splice ? ((e = t), (t = n), (n = null)) : (e = h);
                        }
                        return (
                            (t = t || function () {}),
                            "function" == typeof n && ((n = i), (i = o)),
                            i
                                ? s(h, e, t, n)
                                : setTimeout(function () {
                                      s(h, e, t, n);
                                  }, 4),
                            r
                        );
                    }),
                    (r.config = function (e) {
                        return r(e);
                    }),
                    (t._defined = m),
                    ((i = function (e, t, n) {
                        if ("string" != typeof e) throw new Error("See almond README: incorrect module build, no module name");
                        t.splice || ((n = t), (t = [])), b(m, e) || b(v, e) || (v[e] = [e, t, n]);
                    }).amd = { jQuery: !0 }),
                    (e.requirejs = t),
                    (e.require = n),
                    (e.define = i)),
                e.define("almond", function () {}),
                e.define("jquery", [], function () {
                    var e = d || $;
                    return null == e && console && console.error && console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."), e;
                }),
                e.define("select2/utils", ["jquery"], function (s) {
                    var o = {};
                    function u(e) {
                        var t = e.prototype,
                            n = [];
                        for (var i in t) {
                            "function" == typeof t[i] && "constructor" !== i && n.push(i);
                        }
                        return n;
                    }
                    (o.Extend = function (e, t) {
                        var n = {}.hasOwnProperty;
                        function i() {
                            this.constructor = e;
                        }
                        for (var o in t) n.call(t, o) && (e[o] = t[o]);
                        return (i.prototype = t.prototype), (e.prototype = new i()), (e.__super__ = t.prototype), e;
                    }),
                        (o.Decorate = function (i, o) {
                            var e = u(o),
                                t = u(i);
                            function s() {
                                var e = Array.prototype.unshift,
                                    t = o.prototype.constructor.length,
                                    n = i.prototype.constructor;
                                0 < t && (e.call(arguments, i.prototype.constructor), (n = o.prototype.constructor)), n.apply(this, arguments);
                            }
                            (o.displayName = i.displayName),
                                (s.prototype = new (function () {
                                    this.constructor = s;
                                })());
                            for (var n = 0; n < t.length; n++) {
                                var r = t[n];
                                s.prototype[r] = i.prototype[r];
                            }
                            function a(e) {
                                var t = function () {};
                                e in s.prototype && (t = s.prototype[e]);
                                var n = o.prototype[e];
                                return function () {
                                    return Array.prototype.unshift.call(arguments, t), n.apply(this, arguments);
                                };
                            }
                            for (var l = 0; l < e.length; l++) {
                                var c = e[l];
                                s.prototype[c] = a(c);
                            }
                            return s;
                        });
                    function e() {
                        this.listeners = {};
                    }
                    (e.prototype.on = function (e, t) {
                        (this.listeners = this.listeners || {}), e in this.listeners ? this.listeners[e].push(t) : (this.listeners[e] = [t]);
                    }),
                        (e.prototype.trigger = function (e) {
                            var t = Array.prototype.slice,
                                n = t.call(arguments, 1);
                            (this.listeners = this.listeners || {}),
                                null == n && (n = []),
                                0 === n.length && n.push({}),
                                (n[0]._type = e) in this.listeners && this.invoke(this.listeners[e], t.call(arguments, 1)),
                                "*" in this.listeners && this.invoke(this.listeners["*"], arguments);
                        }),
                        (e.prototype.invoke = function (e, t) {
                            for (var n = 0, i = e.length; n < i; n++) e[n].apply(this, t);
                        }),
                        (o.Observable = e),
                        (o.generateChars = function (e) {
                            for (var t = "", n = 0; n < e; n++) {
                                t += Math.floor(36 * Math.random()).toString(36);
                            }
                            return t;
                        }),
                        (o.bind = function (e, t) {
                            return function () {
                                e.apply(t, arguments);
                            };
                        }),
                        (o._convertData = function (e) {
                            for (var t in e) {
                                var n = t.split("-"),
                                    i = e;
                                if (1 !== n.length) {
                                    for (var o = 0; o < n.length; o++) {
                                        var s = n[o];
                                        (s = s.substring(0, 1).toLowerCase() + s.substring(1)) in i || (i[s] = {}), o == n.length - 1 && (i[s] = e[t]), (i = i[s]);
                                    }
                                    delete e[t];
                                }
                            }
                            return e;
                        }),
                        (o.hasScroll = function (e, t) {
                            var n = s(t),
                                i = t.style.overflowX,
                                o = t.style.overflowY;
                            return (i !== o || ("hidden" !== o && "visible" !== o)) && ("scroll" === i || "scroll" === o || n.innerHeight() < t.scrollHeight || n.innerWidth() < t.scrollWidth);
                        }),
                        (o.escapeMarkup = function (e) {
                            var t = { "\\": "&#92;", "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;", "/": "&#47;" };
                            return "string" != typeof e
                                ? e
                                : String(e).replace(/[&<>"'\/\\]/g, function (e) {
                                      return t[e];
                                  });
                        }),
                        (o.__cache = {});
                    var n = 0;
                    return (
                        (o.GetUniqueElementId = function (e) {
                            var t = e.getAttribute("data-select2-id");
                            return null != t || ((t = e.id ? "select2-data-" + e.id : "select2-data-" + (++n).toString() + "-" + o.generateChars(4)), e.setAttribute("data-select2-id", t)), t;
                        }),
                        (o.StoreData = function (e, t, n) {
                            var i = o.GetUniqueElementId(e);
                            o.__cache[i] || (o.__cache[i] = {}), (o.__cache[i][t] = n);
                        }),
                        (o.GetData = function (e, t) {
                            var n = o.GetUniqueElementId(e);
                            return t ? (o.__cache[n] && null != o.__cache[n][t] ? o.__cache[n][t] : s(e).data(t)) : o.__cache[n];
                        }),
                        (o.RemoveData = function (e) {
                            var t = o.GetUniqueElementId(e);
                            null != o.__cache[t] && delete o.__cache[t], e.removeAttribute("data-select2-id");
                        }),
                        (o.copyNonInternalCssClasses = function (e, t) {
                            var n = e.getAttribute("class").trim().split(/\s+/);
                            n = n.filter(function (e) {
                                return 0 === e.indexOf("select2-");
                            });
                            var i = t.getAttribute("class").trim().split(/\s+/);
                            i = i.filter(function (e) {
                                return 0 !== e.indexOf("select2-");
                            });
                            var o = n.concat(i);
                            e.setAttribute("class", o.join(" "));
                        }),
                        o
                    );
                }),
                e.define("select2/results", ["jquery", "./utils"], function (h, f) {
                    function i(e, t, n) {
                        (this.$element = e), (this.data = n), (this.options = t), i.__super__.constructor.call(this);
                    }
                    return (
                        f.Extend(i, f.Observable),
                        (i.prototype.render = function () {
                            var e = h('<ul class="select2-results__options" role="listbox"></ul>');
                            return this.options.get("multiple") && e.attr("aria-multiselectable", "true"), (this.$results = e);
                        }),
                        (i.prototype.clear = function () {
                            this.$results.empty();
                        }),
                        (i.prototype.displayMessage = function (e) {
                            var t = this.options.get("escapeMarkup");
                            this.clear(), this.hideLoading();
                            var n = h('<li role="alert" aria-live="assertive" class="select2-results__option"></li>'),
                                i = this.options.get("translations").get(e.message);
                            n.append(t(i(e.args))), (n[0].className += " select2-results__message"), this.$results.append(n);
                        }),
                        (i.prototype.hideMessages = function () {
                            this.$results.find(".select2-results__message").remove();
                        }),
                        (i.prototype.append = function (e) {
                            this.hideLoading();
                            var t = [];
                            if (null != e.results && 0 !== e.results.length) {
                                e.results = this.sort(e.results);
                                for (var n = 0; n < e.results.length; n++) {
                                    var i = e.results[n],
                                        o = this.option(i);
                                    t.push(o);
                                }
                                this.$results.append(t);
                            } else 0 === this.$results.children().length && this.trigger("results:message", { message: "noResults" });
                        }),
                        (i.prototype.position = function (e, t) {
                            t.find(".select2-results").append(e);
                        }),
                        (i.prototype.sort = function (e) {
                            return this.options.get("sorter")(e);
                        }),
                        (i.prototype.highlightFirstItem = function () {
                            var e = this.$results.find(".select2-results__option--selectable"),
                                t = e.filter(".select2-results__option--selected");
                            0 < t.length ? t.first().trigger("mouseenter") : e.first().trigger("mouseenter"), this.ensureHighlightVisible();
                        }),
                        (i.prototype.setClasses = function () {
                            var t = this;
                            this.data.current(function (e) {
                                var i = e.map(function (e) {
                                    return e.id.toString();
                                });
                                t.$results.find(".select2-results__option--selectable").each(function () {
                                    var e = h(this),
                                        t = f.GetData(this, "data"),
                                        n = "" + t.id;
                                    (null != t.element && t.element.selected) || (null == t.element && -1 < i.indexOf(n))
                                        ? (this.classList.add("select2-results__option--selected"), e.attr("aria-selected", "true"))
                                        : (this.classList.remove("select2-results__option--selected"), e.attr("aria-selected", "false"));
                                });
                            });
                        }),
                        (i.prototype.showLoading = function (e) {
                            this.hideLoading();
                            var t = { disabled: !0, loading: !0, text: this.options.get("translations").get("searching")(e) },
                                n = this.option(t);
                            (n.className += " loading-results"), this.$results.prepend(n);
                        }),
                        (i.prototype.hideLoading = function () {
                            this.$results.find(".loading-results").remove();
                        }),
                        (i.prototype.option = function (e) {
                            var t = document.createElement("li");
                            t.classList.add("select2-results__option"), t.classList.add("select2-results__option--selectable");
                            var n = { role: "option" },
                                i = window.Element.prototype.matches || window.Element.prototype.msMatchesSelector || window.Element.prototype.webkitMatchesSelector;
                            for (var o in (((null != e.element && i.call(e.element, ":disabled")) || (null == e.element && e.disabled)) &&
                                ((n["aria-disabled"] = "true"), t.classList.remove("select2-results__option--selectable"), t.classList.add("select2-results__option--disabled")),
                            null == e.id && t.classList.remove("select2-results__option--selectable"),
                            null != e._resultId && (t.id = e._resultId),
                            e.title && (t.title = e.title),
                            e.children && ((n.role = "group"), (n["aria-label"] = e.text), t.classList.remove("select2-results__option--selectable"), t.classList.add("select2-results__option--group")),
                            n)) {
                                var s = n[o];
                                t.setAttribute(o, s);
                            }
                            if (e.children) {
                                var r = h(t),
                                    a = document.createElement("strong");
                                (a.className = "select2-results__group"), this.template(e, a);
                                for (var l = [], c = 0; c < e.children.length; c++) {
                                    var u = e.children[c],
                                        d = this.option(u);
                                    l.push(d);
                                }
                                var p = h("<ul></ul>", { class: "select2-results__options select2-results__options--nested" });
                                p.append(l), r.append(a), r.append(p);
                            } else this.template(e, t);
                            return f.StoreData(t, "data", e), t;
                        }),
                        (i.prototype.bind = function (t, e) {
                            var l = this,
                                n = t.id + "-results";
                            this.$results.attr("id", n),
                                t.on("results:all", function (e) {
                                    l.clear(), l.append(e.data), t.isOpen() && (l.setClasses(), l.highlightFirstItem());
                                }),
                                t.on("results:append", function (e) {
                                    l.append(e.data), t.isOpen() && l.setClasses();
                                }),
                                t.on("query", function (e) {
                                    l.hideMessages(), l.showLoading(e);
                                }),
                                t.on("select", function () {
                                    t.isOpen() && (l.setClasses(), l.options.get("scrollAfterSelect") && l.highlightFirstItem());
                                }),
                                t.on("unselect", function () {
                                    t.isOpen() && (l.setClasses(), l.options.get("scrollAfterSelect") && l.highlightFirstItem());
                                }),
                                t.on("open", function () {
                                    l.$results.attr("aria-expanded", "true"), l.$results.attr("aria-hidden", "false"), l.setClasses(), l.ensureHighlightVisible();
                                }),
                                t.on("close", function () {
                                    l.$results.attr("aria-expanded", "false"), l.$results.attr("aria-hidden", "true"), l.$results.removeAttr("aria-activedescendant");
                                }),
                                t.on("results:toggle", function () {
                                    var e = l.getHighlightedResults();
                                    0 !== e.length && e.trigger("mouseup");
                                }),
                                t.on("results:select", function () {
                                    var e = l.getHighlightedResults();
                                    if (0 !== e.length) {
                                        var t = f.GetData(e[0], "data");
                                        e.hasClass("select2-results__option--selected") ? l.trigger("close", {}) : l.trigger("select", { data: t });
                                    }
                                }),
                                t.on("results:previous", function () {
                                    var e = l.getHighlightedResults(),
                                        t = l.$results.find(".select2-results__option--selectable"),
                                        n = t.index(e);
                                    if (!(n <= 0)) {
                                        var i = n - 1;
                                        0 === e.length && (i = 0);
                                        var o = t.eq(i);
                                        o.trigger("mouseenter");
                                        var s = l.$results.offset().top,
                                            r = o.offset().top,
                                            a = l.$results.scrollTop() + (r - s);
                                        0 === i ? l.$results.scrollTop(0) : r - s < 0 && l.$results.scrollTop(a);
                                    }
                                }),
                                t.on("results:next", function () {
                                    var e = l.getHighlightedResults(),
                                        t = l.$results.find(".select2-results__option--selectable"),
                                        n = t.index(e) + 1;
                                    if (!(n >= t.length)) {
                                        var i = t.eq(n);
                                        i.trigger("mouseenter");
                                        var o = l.$results.offset().top + l.$results.outerHeight(!1),
                                            s = i.offset().top + i.outerHeight(!1),
                                            r = l.$results.scrollTop() + s - o;
                                        0 === n ? l.$results.scrollTop(0) : o < s && l.$results.scrollTop(r);
                                    }
                                }),
                                t.on("results:focus", function (e) {
                                    e.element[0].classList.add("select2-results__option--highlighted"), e.element[0].setAttribute("aria-selected", "true");
                                }),
                                t.on("results:message", function (e) {
                                    l.displayMessage(e);
                                }),
                                h.fn.mousewheel &&
                                    this.$results.on("mousewheel", function (e) {
                                        var t = l.$results.scrollTop(),
                                            n = l.$results.get(0).scrollHeight - t + e.deltaY,
                                            i = 0 < e.deltaY && t - e.deltaY <= 0,
                                            o = e.deltaY < 0 && n <= l.$results.height();
                                        i ? (l.$results.scrollTop(0), e.preventDefault(), e.stopPropagation()) : o && (l.$results.scrollTop(l.$results.get(0).scrollHeight - l.$results.height()), e.preventDefault(), e.stopPropagation());
                                    }),
                                this.$results.on("mouseup", ".select2-results__option--selectable", function (e) {
                                    var t = h(this),
                                        n = f.GetData(this, "data");
                                    t.hasClass("select2-results__option--selected")
                                        ? l.options.get("multiple")
                                            ? l.trigger("unselect", { originalEvent: e, data: n })
                                            : l.trigger("close", {})
                                        : l.trigger("select", { originalEvent: e, data: n });
                                }),
                                this.$results.on("mouseenter", ".select2-results__option--selectable", function (e) {
                                    var t = f.GetData(this, "data");
                                    l.getHighlightedResults().removeClass("select2-results__option--highlighted").attr("aria-selected", "false"), l.trigger("results:focus", { data: t, element: h(this) });
                                });
                        }),
                        (i.prototype.getHighlightedResults = function () {
                            return this.$results.find(".select2-results__option--highlighted");
                        }),
                        (i.prototype.destroy = function () {
                            this.$results.remove();
                        }),
                        (i.prototype.ensureHighlightVisible = function () {
                            var e = this.getHighlightedResults();
                            if (0 !== e.length) {
                                var t = this.$results.find(".select2-results__option--selectable").index(e),
                                    n = this.$results.offset().top,
                                    i = e.offset().top,
                                    o = this.$results.scrollTop() + (i - n),
                                    s = i - n;
                                (o -= 2 * e.outerHeight(!1)), t <= 2 ? this.$results.scrollTop(0) : (s > this.$results.outerHeight() || s < 0) && this.$results.scrollTop(o);
                            }
                        }),
                        (i.prototype.template = function (e, t) {
                            var n = this.options.get("templateResult"),
                                i = this.options.get("escapeMarkup"),
                                o = n(e, t);
                            null == o ? (t.style.display = "none") : "string" == typeof o ? (t.innerHTML = i(o)) : h(t).append(o);
                        }),
                        i
                    );
                }),
                e.define("select2/keys", [], function () {
                    return { BACKSPACE: 8, TAB: 9, ENTER: 13, SHIFT: 16, CTRL: 17, ALT: 18, ESC: 27, SPACE: 32, PAGE_UP: 33, PAGE_DOWN: 34, END: 35, HOME: 36, LEFT: 37, UP: 38, RIGHT: 39, DOWN: 40, DELETE: 46 };
                }),
                e.define("select2/selection/base", ["jquery", "../utils", "../keys"], function (n, i, o) {
                    function s(e, t) {
                        (this.$element = e), (this.options = t), s.__super__.constructor.call(this);
                    }
                    return (
                        i.Extend(s, i.Observable),
                        (s.prototype.render = function () {
                            var e = n('<span class="select2-selection" role="combobox"  aria-haspopup="true" aria-expanded="false"></span>');
                            return (
                                (this._tabindex = 0),
                                null != i.GetData(this.$element[0], "old-tabindex")
                                    ? (this._tabindex = i.GetData(this.$element[0], "old-tabindex"))
                                    : null != this.$element.attr("tabindex") && (this._tabindex = this.$element.attr("tabindex")),
                                e.attr("title", this.$element.attr("title")),
                                e.attr("tabindex", this._tabindex),
                                e.attr("aria-disabled", "false"),
                                (this.$selection = e)
                            );
                        }),
                        (s.prototype.bind = function (e, t) {
                            var n = this,
                                i = e.id + "-results";
                            (this.container = e),
                                this.$selection.on("focus", function (e) {
                                    n.trigger("focus", e);
                                }),
                                this.$selection.on("blur", function (e) {
                                    n._handleBlur(e);
                                }),
                                this.$selection.on("keydown", function (e) {
                                    n.trigger("keypress", e), e.which === o.SPACE && e.preventDefault();
                                }),
                                e.on("results:focus", function (e) {
                                    n.$selection.attr("aria-activedescendant", e.data._resultId);
                                }),
                                e.on("selection:update", function (e) {
                                    n.update(e.data);
                                }),
                                e.on("open", function () {
                                    n.$selection.attr("aria-expanded", "true"), n.$selection.attr("aria-owns", i), n._attachCloseHandler(e);
                                }),
                                e.on("close", function () {
                                    n.$selection.attr("aria-expanded", "false"), n.$selection.removeAttr("aria-activedescendant"), n.$selection.removeAttr("aria-owns"), n.$selection.trigger("focus"), n._detachCloseHandler(e);
                                }),
                                e.on("enable", function () {
                                    n.$selection.attr("tabindex", n._tabindex), n.$selection.attr("aria-disabled", "false");
                                }),
                                e.on("disable", function () {
                                    n.$selection.attr("tabindex", "-1"), n.$selection.attr("aria-disabled", "true");
                                });
                        }),
                        (s.prototype._handleBlur = function (e) {
                            var t = this;
                            window.setTimeout(function () {
                                document.activeElement == t.$selection[0] || n.contains(t.$selection[0], document.activeElement) || t.trigger("blur", e);
                            }, 1);
                        }),
                        (s.prototype._attachCloseHandler = function (e) {
                            n(document.body).on("mousedown.select2." + e.id, function (e) {
                                var t = n(e.target).closest(".select2");
                                n(".select2.select2-container--open").each(function () {
                                    this != t[0] && i.GetData(this, "element").select2("close");
                                });
                            });
                        }),
                        (s.prototype._detachCloseHandler = function (e) {
                            n(document.body).off("mousedown.select2." + e.id);
                        }),
                        (s.prototype.position = function (e, t) {
                            t.find(".selection").append(e);
                        }),
                        (s.prototype.destroy = function () {
                            this._detachCloseHandler(this.container);
                        }),
                        (s.prototype.update = function (e) {
                            throw new Error("The `update` method must be defined in child classes.");
                        }),
                        (s.prototype.isEnabled = function () {
                            return !this.isDisabled();
                        }),
                        (s.prototype.isDisabled = function () {
                            return this.options.get("disabled");
                        }),
                        s
                    );
                }),
                e.define("select2/selection/single", ["jquery", "./base", "../utils", "../keys"], function (e, t, n, i) {
                    function o() {
                        o.__super__.constructor.apply(this, arguments);
                    }
                    return (
                        n.Extend(o, t),
                        (o.prototype.render = function () {
                            var e = o.__super__.render.call(this);
                            return e[0].classList.add("select2-selection--single"), e.html('<span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'), e;
                        }),
                        (o.prototype.bind = function (t, e) {
                            var n = this;
                            o.__super__.bind.apply(this, arguments);
                            var i = t.id + "-container";
                            this.$selection.find(".select2-selection__rendered").attr("id", i).attr("role", "textbox").attr("aria-readonly", "true"),
                                this.$selection.attr("aria-labelledby", i),
                                this.$selection.on("mousedown", function (e) {
                                    1 === e.which && n.trigger("toggle", { originalEvent: e });
                                }),
                                this.$selection.on("focus", function (e) {}),
                                this.$selection.on("blur", function (e) {}),
                                t.on("focus", function (e) {
                                    t.isOpen() || n.$selection.trigger("focus");
                                });
                        }),
                        (o.prototype.clear = function () {
                            var e = this.$selection.find(".select2-selection__rendered");
                            e.empty(), e.removeAttr("title");
                        }),
                        (o.prototype.display = function (e, t) {
                            var n = this.options.get("templateSelection");
                            return this.options.get("escapeMarkup")(n(e, t));
                        }),
                        (o.prototype.selectionContainer = function () {
                            return e("<span></span>");
                        }),
                        (o.prototype.update = function (e) {
                            if (0 !== e.length) {
                                var t = e[0],
                                    n = this.$selection.find(".select2-selection__rendered"),
                                    i = this.display(t, n);
                                n.empty().append(i);
                                var o = t.title || t.text;
                                o ? n.attr("title", o) : n.removeAttr("title");
                            } else this.clear();
                        }),
                        o
                    );
                }),
                e.define("select2/selection/multiple", ["jquery", "./base", "../utils"], function (o, e, d) {
                    function s(e, t) {
                        s.__super__.constructor.apply(this, arguments);
                    }
                    return (
                        d.Extend(s, e),
                        (s.prototype.render = function () {
                            var e = s.__super__.render.call(this);
                            return e[0].classList.add("select2-selection--multiple"), e.html('<ul class="select2-selection__rendered"></ul>'), e;
                        }),
                        (s.prototype.bind = function (e, t) {
                            var i = this;
                            s.__super__.bind.apply(this, arguments);
                            var n = e.id + "-container";
                            this.$selection.find(".select2-selection__rendered").attr("id", n),
                                this.$selection.on("click", function (e) {
                                    i.trigger("toggle", { originalEvent: e });
                                }),
                                this.$selection.on("click", ".select2-selection__choice__remove", function (e) {
                                    if (!i.isDisabled()) {
                                        var t = o(this).parent(),
                                            n = d.GetData(t[0], "data");
                                        i.trigger("unselect", { originalEvent: e, data: n });
                                    }
                                }),
                                this.$selection.on("keydown", ".select2-selection__choice__remove", function (e) {
                                    i.isDisabled() || e.stopPropagation();
                                });
                        }),
                        (s.prototype.clear = function () {
                            var e = this.$selection.find(".select2-selection__rendered");
                            e.empty(), e.removeAttr("title");
                        }),
                        (s.prototype.display = function (e, t) {
                            var n = this.options.get("templateSelection");
                            return this.options.get("escapeMarkup")(n(e, t));
                        }),
                        (s.prototype.selectionContainer = function () {
                            return o(
                                '<li class="select2-selection__choice"><button type="button" class="select2-selection__choice__remove" tabindex="-1"><span aria-hidden="true">&times;</span></button><span class="select2-selection__choice__display"></span></li>'
                            );
                        }),
                        (s.prototype.update = function (e) {
                            if ((this.clear(), 0 !== e.length)) {
                                for (var t = [], n = this.$selection.find(".select2-selection__rendered").attr("id") + "-choice-", i = 0; i < e.length; i++) {
                                    var o = e[i],
                                        s = this.selectionContainer(),
                                        r = this.display(o, s),
                                        a = n + d.generateChars(4) + "-";
                                    o.id ? (a += o.id) : (a += d.generateChars(4)), s.find(".select2-selection__choice__display").append(r).attr("id", a);
                                    var l = o.title || o.text;
                                    l && s.attr("title", l);
                                    var c = this.options.get("translations").get("removeItem"),
                                        u = s.find(".select2-selection__choice__remove");
                                    u.attr("title", c()), u.attr("aria-label", c()), u.attr("aria-describedby", a), d.StoreData(s[0], "data", o), t.push(s);
                                }
                                this.$selection.find(".select2-selection__rendered").append(t);
                            }
                        }),
                        s
                    );
                }),
                e.define("select2/selection/placeholder", [], function () {
                    function e(e, t, n) {
                        (this.placeholder = this.normalizePlaceholder(n.get("placeholder"))), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.normalizePlaceholder = function (e, t) {
                            return "string" == typeof t && (t = { id: "", text: t }), t;
                        }),
                        (e.prototype.createPlaceholder = function (e, t) {
                            var n = this.selectionContainer();
                            return n.html(this.display(t)), n[0].classList.add("select2-selection__placeholder"), n[0].classList.remove("select2-selection__choice"), n;
                        }),
                        (e.prototype.update = function (e, t) {
                            var n = 1 == t.length && t[0].id != this.placeholder.id;
                            if (1 < t.length || n) return e.call(this, t);
                            this.clear();
                            var i = this.createPlaceholder(this.placeholder);
                            this.$selection.find(".select2-selection__rendered").append(i);
                        }),
                        e
                    );
                }),
                e.define("select2/selection/allowClear", ["jquery", "../keys", "../utils"], function (s, i, a) {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                null == this.placeholder && this.options.get("debug") && window.console && console.error && console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option."),
                                this.$selection.on("mousedown", ".select2-selection__clear", function (e) {
                                    i._handleClear(e);
                                }),
                                t.on("keypress", function (e) {
                                    i._handleKeyboardClear(e, t);
                                });
                        }),
                        (e.prototype._handleClear = function (e, t) {
                            if (!this.isDisabled()) {
                                var n = this.$selection.find(".select2-selection__clear");
                                if (0 !== n.length) {
                                    t.stopPropagation();
                                    var i = a.GetData(n[0], "data"),
                                        o = this.$element.val();
                                    this.$element.val(this.placeholder.id);
                                    var s = { data: i };
                                    if ((this.trigger("clear", s), s.prevented)) this.$element.val(o);
                                    else {
                                        for (var r = 0; r < i.length; r++) if (((s = { data: i[r] }), this.trigger("unselect", s), s.prevented)) return void this.$element.val(o);
                                        this.$element.trigger("input").trigger("change"), this.trigger("toggle", {});
                                    }
                                }
                            }
                        }),
                        (e.prototype._handleKeyboardClear = function (e, t, n) {
                            n.isOpen() || (t.which != i.DELETE && t.which != i.BACKSPACE) || this._handleClear(t);
                        }),
                        (e.prototype.update = function (e, t) {
                            if ((e.call(this, t), this.$selection.find(".select2-selection__clear").remove(), !(0 < this.$selection.find(".select2-selection__placeholder").length || 0 === t.length))) {
                                var n = this.$selection.find(".select2-selection__rendered").attr("id"),
                                    i = this.options.get("translations").get("removeAllItems"),
                                    o = s('<button type="button" class="select2-selection__clear" tabindex="-1"><span aria-hidden="true">&times;</span></button>');
                                o.attr("title", i()), o.attr("aria-label", i()), o.attr("aria-describedby", n), a.StoreData(o[0], "data", t), this.$selection.prepend(o);
                            }
                        }),
                        e
                    );
                }),
                e.define("select2/selection/search", ["jquery", "../utils", "../keys"], function (i, l, c) {
                    function e(e, t, n) {
                        e.call(this, t, n);
                    }
                    return (
                        (e.prototype.render = function (e) {
                            var t = i(
                                '<span class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" /></span>'
                            );
                            (this.$searchContainer = t), (this.$search = t.find("input")), this.$search.prop("autocomplete", this.options.get("autocomplete"));
                            var n = e.call(this);
                            return this._transferTabIndex(), n.append(this.$searchContainer), n;
                        }),
                        (e.prototype.bind = function (e, t, n) {
                            var i = this,
                                o = t.id + "-results",
                                s = t.id + "-container";
                            e.call(this, t, n),
                                i.$search.attr("aria-describedby", s),
                                t.on("open", function () {
                                    i.$search.attr("aria-controls", o), i.$search.trigger("focus");
                                }),
                                t.on("close", function () {
                                    i.$search.val(""), i.resizeSearch(), i.$search.removeAttr("aria-controls"), i.$search.removeAttr("aria-activedescendant"), i.$search.trigger("focus");
                                }),
                                t.on("enable", function () {
                                    i.$search.prop("disabled", !1), i._transferTabIndex();
                                }),
                                t.on("disable", function () {
                                    i.$search.prop("disabled", !0);
                                }),
                                t.on("focus", function (e) {
                                    i.$search.trigger("focus");
                                }),
                                t.on("results:focus", function (e) {
                                    e.data._resultId ? i.$search.attr("aria-activedescendant", e.data._resultId) : i.$search.removeAttr("aria-activedescendant");
                                }),
                                this.$selection.on("focusin", ".select2-search--inline", function (e) {
                                    i.trigger("focus", e);
                                }),
                                this.$selection.on("focusout", ".select2-search--inline", function (e) {
                                    i._handleBlur(e);
                                }),
                                this.$selection.on("keydown", ".select2-search--inline", function (e) {
                                    if ((e.stopPropagation(), i.trigger("keypress", e), (i._keyUpPrevented = e.isDefaultPrevented()), e.which === c.BACKSPACE && "" === i.$search.val())) {
                                        var t = i.$selection.find(".select2-selection__choice").last();
                                        if (0 < t.length) {
                                            var n = l.GetData(t[0], "data");
                                            i.searchRemoveChoice(n), e.preventDefault();
                                        }
                                    }
                                }),
                                this.$selection.on("click", ".select2-search--inline", function (e) {
                                    i.$search.val() && e.stopPropagation();
                                });
                            var r = document.documentMode,
                                a = r && r <= 11;
                            this.$selection.on("input.searchcheck", ".select2-search--inline", function (e) {
                                a ? i.$selection.off("input.search input.searchcheck") : i.$selection.off("keyup.search");
                            }),
                                this.$selection.on("keyup.search input.search", ".select2-search--inline", function (e) {
                                    if (a && "input" === e.type) i.$selection.off("input.search input.searchcheck");
                                    else {
                                        var t = e.which;
                                        t != c.SHIFT && t != c.CTRL && t != c.ALT && t != c.TAB && i.handleSearch(e);
                                    }
                                });
                        }),
                        (e.prototype._transferTabIndex = function (e) {
                            this.$search.attr("tabindex", this.$selection.attr("tabindex")), this.$selection.attr("tabindex", "-1");
                        }),
                        (e.prototype.createPlaceholder = function (e, t) {
                            this.$search.attr("placeholder", t.text);
                        }),
                        (e.prototype.update = function (e, t) {
                            var n = this.$search[0] == document.activeElement;
                            this.$search.attr("placeholder", ""), e.call(this, t), this.resizeSearch(), n && this.$search.trigger("focus");
                        }),
                        (e.prototype.handleSearch = function () {
                            if ((this.resizeSearch(), !this._keyUpPrevented)) {
                                var e = this.$search.val();
                                this.trigger("query", { term: e });
                            }
                            this._keyUpPrevented = !1;
                        }),
                        (e.prototype.searchRemoveChoice = function (e, t) {
                            this.trigger("unselect", { data: t }), this.$search.val(t.text), this.handleSearch();
                        }),
                        (e.prototype.resizeSearch = function () {
                            this.$search.css("width", "25px");
                            var e = "100%";
                            "" === this.$search.attr("placeholder") && (e = 0.75 * (this.$search.val().length + 1) + "em");
                            this.$search.css("width", e);
                        }),
                        e
                    );
                }),
                e.define("select2/selection/selectionCss", ["../utils"], function (i) {
                    function e() {}
                    return (
                        (e.prototype.render = function (e) {
                            var t = e.call(this),
                                n = this.options.get("selectionCssClass") || "";
                            return -1 !== n.indexOf(":all:") && ((n = n.replace(":all:", "")), i.copyNonInternalCssClasses(t[0], this.$element[0])), t.addClass(n), t;
                        }),
                        e
                    );
                }),
                e.define("select2/selection/eventRelay", ["jquery"], function (r) {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this,
                                o = ["open", "opening", "close", "closing", "select", "selecting", "unselect", "unselecting", "clear", "clearing"],
                                s = ["opening", "closing", "selecting", "unselecting", "clearing"];
                            e.call(this, t, n),
                                t.on("*", function (e, t) {
                                    if (-1 !== o.indexOf(e)) {
                                        t = t || {};
                                        var n = r.Event("select2:" + e, { params: t });
                                        i.$element.trigger(n), -1 !== s.indexOf(e) && (t.prevented = n.isDefaultPrevented());
                                    }
                                });
                        }),
                        e
                    );
                }),
                e.define("select2/translation", ["jquery", "require"], function (t, n) {
                    function i(e) {
                        this.dict = e || {};
                    }
                    return (
                        (i.prototype.all = function () {
                            return this.dict;
                        }),
                        (i.prototype.get = function (e) {
                            return this.dict[e];
                        }),
                        (i.prototype.extend = function (e) {
                            this.dict = t.extend({}, e.all(), this.dict);
                        }),
                        (i._cache = {}),
                        (i.loadPath = function (e) {
                            if (!(e in i._cache)) {
                                var t = n(e);
                                i._cache[e] = t;
                            }
                            return new i(i._cache[e]);
                        }),
                        i
                    );
                }),
                e.define("select2/diacritics", [], function () {
                    return {
                        "Ⓐ": "A",
                        Ａ: "A",
                        À: "A",
                        Á: "A",
                        Â: "A",
                        Ầ: "A",
                        Ấ: "A",
                        Ẫ: "A",
                        Ẩ: "A",
                        Ã: "A",
                        Ā: "A",
                        Ă: "A",
                        Ằ: "A",
                        Ắ: "A",
                        Ẵ: "A",
                        Ẳ: "A",
                        Ȧ: "A",
                        Ǡ: "A",
                        Ä: "A",
                        Ǟ: "A",
                        Ả: "A",
                        Å: "A",
                        Ǻ: "A",
                        Ǎ: "A",
                        Ȁ: "A",
                        Ȃ: "A",
                        Ạ: "A",
                        Ậ: "A",
                        Ặ: "A",
                        Ḁ: "A",
                        Ą: "A",
                        Ⱥ: "A",
                        Ɐ: "A",
                        Ꜳ: "AA",
                        Æ: "AE",
                        Ǽ: "AE",
                        Ǣ: "AE",
                        Ꜵ: "AO",
                        Ꜷ: "AU",
                        Ꜹ: "AV",
                        Ꜻ: "AV",
                        Ꜽ: "AY",
                        "Ⓑ": "B",
                        Ｂ: "B",
                        Ḃ: "B",
                        Ḅ: "B",
                        Ḇ: "B",
                        Ƀ: "B",
                        Ƃ: "B",
                        Ɓ: "B",
                        "Ⓒ": "C",
                        Ｃ: "C",
                        Ć: "C",
                        Ĉ: "C",
                        Ċ: "C",
                        Č: "C",
                        Ç: "C",
                        Ḉ: "C",
                        Ƈ: "C",
                        Ȼ: "C",
                        Ꜿ: "C",
                        "Ⓓ": "D",
                        Ｄ: "D",
                        Ḋ: "D",
                        Ď: "D",
                        Ḍ: "D",
                        Ḑ: "D",
                        Ḓ: "D",
                        Ḏ: "D",
                        Đ: "D",
                        Ƌ: "D",
                        Ɗ: "D",
                        Ɖ: "D",
                        Ꝺ: "D",
                        Ǳ: "DZ",
                        Ǆ: "DZ",
                        ǲ: "Dz",
                        ǅ: "Dz",
                        "Ⓔ": "E",
                        Ｅ: "E",
                        È: "E",
                        É: "E",
                        Ê: "E",
                        Ề: "E",
                        Ế: "E",
                        Ễ: "E",
                        Ể: "E",
                        Ẽ: "E",
                        Ē: "E",
                        Ḕ: "E",
                        Ḗ: "E",
                        Ĕ: "E",
                        Ė: "E",
                        Ë: "E",
                        Ẻ: "E",
                        Ě: "E",
                        Ȅ: "E",
                        Ȇ: "E",
                        Ẹ: "E",
                        Ệ: "E",
                        Ȩ: "E",
                        Ḝ: "E",
                        Ę: "E",
                        Ḙ: "E",
                        Ḛ: "E",
                        Ɛ: "E",
                        Ǝ: "E",
                        "Ⓕ": "F",
                        Ｆ: "F",
                        Ḟ: "F",
                        Ƒ: "F",
                        Ꝼ: "F",
                        "Ⓖ": "G",
                        Ｇ: "G",
                        Ǵ: "G",
                        Ĝ: "G",
                        Ḡ: "G",
                        Ğ: "G",
                        Ġ: "G",
                        Ǧ: "G",
                        Ģ: "G",
                        Ǥ: "G",
                        Ɠ: "G",
                        Ꞡ: "G",
                        Ᵹ: "G",
                        Ꝿ: "G",
                        "Ⓗ": "H",
                        Ｈ: "H",
                        Ĥ: "H",
                        Ḣ: "H",
                        Ḧ: "H",
                        Ȟ: "H",
                        Ḥ: "H",
                        Ḩ: "H",
                        Ḫ: "H",
                        Ħ: "H",
                        Ⱨ: "H",
                        Ⱶ: "H",
                        Ɥ: "H",
                        "Ⓘ": "I",
                        Ｉ: "I",
                        Ì: "I",
                        Í: "I",
                        Î: "I",
                        Ĩ: "I",
                        Ī: "I",
                        Ĭ: "I",
                        İ: "I",
                        Ï: "I",
                        Ḯ: "I",
                        Ỉ: "I",
                        Ǐ: "I",
                        Ȉ: "I",
                        Ȋ: "I",
                        Ị: "I",
                        Į: "I",
                        Ḭ: "I",
                        Ɨ: "I",
                        "Ⓙ": "J",
                        Ｊ: "J",
                        Ĵ: "J",
                        Ɉ: "J",
                        "Ⓚ": "K",
                        Ｋ: "K",
                        Ḱ: "K",
                        Ǩ: "K",
                        Ḳ: "K",
                        Ķ: "K",
                        Ḵ: "K",
                        Ƙ: "K",
                        Ⱪ: "K",
                        Ꝁ: "K",
                        Ꝃ: "K",
                        Ꝅ: "K",
                        Ꞣ: "K",
                        "Ⓛ": "L",
                        Ｌ: "L",
                        Ŀ: "L",
                        Ĺ: "L",
                        Ľ: "L",
                        Ḷ: "L",
                        Ḹ: "L",
                        Ļ: "L",
                        Ḽ: "L",
                        Ḻ: "L",
                        Ł: "L",
                        Ƚ: "L",
                        Ɫ: "L",
                        Ⱡ: "L",
                        Ꝉ: "L",
                        Ꝇ: "L",
                        Ꞁ: "L",
                        Ǉ: "LJ",
                        ǈ: "Lj",
                        "Ⓜ": "M",
                        Ｍ: "M",
                        Ḿ: "M",
                        Ṁ: "M",
                        Ṃ: "M",
                        Ɱ: "M",
                        Ɯ: "M",
                        "Ⓝ": "N",
                        Ｎ: "N",
                        Ǹ: "N",
                        Ń: "N",
                        Ñ: "N",
                        Ṅ: "N",
                        Ň: "N",
                        Ṇ: "N",
                        Ņ: "N",
                        Ṋ: "N",
                        Ṉ: "N",
                        Ƞ: "N",
                        Ɲ: "N",
                        Ꞑ: "N",
                        Ꞥ: "N",
                        Ǌ: "NJ",
                        ǋ: "Nj",
                        "Ⓞ": "O",
                        Ｏ: "O",
                        Ò: "O",
                        Ó: "O",
                        Ô: "O",
                        Ồ: "O",
                        Ố: "O",
                        Ỗ: "O",
                        Ổ: "O",
                        Õ: "O",
                        Ṍ: "O",
                        Ȭ: "O",
                        Ṏ: "O",
                        Ō: "O",
                        Ṑ: "O",
                        Ṓ: "O",
                        Ŏ: "O",
                        Ȯ: "O",
                        Ȱ: "O",
                        Ö: "O",
                        Ȫ: "O",
                        Ỏ: "O",
                        Ő: "O",
                        Ǒ: "O",
                        Ȍ: "O",
                        Ȏ: "O",
                        Ơ: "O",
                        Ờ: "O",
                        Ớ: "O",
                        Ỡ: "O",
                        Ở: "O",
                        Ợ: "O",
                        Ọ: "O",
                        Ộ: "O",
                        Ǫ: "O",
                        Ǭ: "O",
                        Ø: "O",
                        Ǿ: "O",
                        Ɔ: "O",
                        Ɵ: "O",
                        Ꝋ: "O",
                        Ꝍ: "O",
                        Œ: "OE",
                        Ƣ: "OI",
                        Ꝏ: "OO",
                        Ȣ: "OU",
                        "Ⓟ": "P",
                        Ｐ: "P",
                        Ṕ: "P",
                        Ṗ: "P",
                        Ƥ: "P",
                        Ᵽ: "P",
                        Ꝑ: "P",
                        Ꝓ: "P",
                        Ꝕ: "P",
                        "Ⓠ": "Q",
                        Ｑ: "Q",
                        Ꝗ: "Q",
                        Ꝙ: "Q",
                        Ɋ: "Q",
                        "Ⓡ": "R",
                        Ｒ: "R",
                        Ŕ: "R",
                        Ṙ: "R",
                        Ř: "R",
                        Ȑ: "R",
                        Ȓ: "R",
                        Ṛ: "R",
                        Ṝ: "R",
                        Ŗ: "R",
                        Ṟ: "R",
                        Ɍ: "R",
                        Ɽ: "R",
                        Ꝛ: "R",
                        Ꞧ: "R",
                        Ꞃ: "R",
                        "Ⓢ": "S",
                        Ｓ: "S",
                        ẞ: "S",
                        Ś: "S",
                        Ṥ: "S",
                        Ŝ: "S",
                        Ṡ: "S",
                        Š: "S",
                        Ṧ: "S",
                        Ṣ: "S",
                        Ṩ: "S",
                        Ș: "S",
                        Ş: "S",
                        Ȿ: "S",
                        Ꞩ: "S",
                        Ꞅ: "S",
                        "Ⓣ": "T",
                        Ｔ: "T",
                        Ṫ: "T",
                        Ť: "T",
                        Ṭ: "T",
                        Ț: "T",
                        Ţ: "T",
                        Ṱ: "T",
                        Ṯ: "T",
                        Ŧ: "T",
                        Ƭ: "T",
                        Ʈ: "T",
                        Ⱦ: "T",
                        Ꞇ: "T",
                        Ꜩ: "TZ",
                        "Ⓤ": "U",
                        Ｕ: "U",
                        Ù: "U",
                        Ú: "U",
                        Û: "U",
                        Ũ: "U",
                        Ṹ: "U",
                        Ū: "U",
                        Ṻ: "U",
                        Ŭ: "U",
                        Ü: "U",
                        Ǜ: "U",
                        Ǘ: "U",
                        Ǖ: "U",
                        Ǚ: "U",
                        Ủ: "U",
                        Ů: "U",
                        Ű: "U",
                        Ǔ: "U",
                        Ȕ: "U",
                        Ȗ: "U",
                        Ư: "U",
                        Ừ: "U",
                        Ứ: "U",
                        Ữ: "U",
                        Ử: "U",
                        Ự: "U",
                        Ụ: "U",
                        Ṳ: "U",
                        Ų: "U",
                        Ṷ: "U",
                        Ṵ: "U",
                        Ʉ: "U",
                        "Ⓥ": "V",
                        Ｖ: "V",
                        Ṽ: "V",
                        Ṿ: "V",
                        Ʋ: "V",
                        Ꝟ: "V",
                        Ʌ: "V",
                        Ꝡ: "VY",
                        "Ⓦ": "W",
                        Ｗ: "W",
                        Ẁ: "W",
                        Ẃ: "W",
                        Ŵ: "W",
                        Ẇ: "W",
                        Ẅ: "W",
                        Ẉ: "W",
                        Ⱳ: "W",
                        "Ⓧ": "X",
                        Ｘ: "X",
                        Ẋ: "X",
                        Ẍ: "X",
                        "Ⓨ": "Y",
                        Ｙ: "Y",
                        Ỳ: "Y",
                        Ý: "Y",
                        Ŷ: "Y",
                        Ỹ: "Y",
                        Ȳ: "Y",
                        Ẏ: "Y",
                        Ÿ: "Y",
                        Ỷ: "Y",
                        Ỵ: "Y",
                        Ƴ: "Y",
                        Ɏ: "Y",
                        Ỿ: "Y",
                        "Ⓩ": "Z",
                        Ｚ: "Z",
                        Ź: "Z",
                        Ẑ: "Z",
                        Ż: "Z",
                        Ž: "Z",
                        Ẓ: "Z",
                        Ẕ: "Z",
                        Ƶ: "Z",
                        Ȥ: "Z",
                        Ɀ: "Z",
                        Ⱬ: "Z",
                        Ꝣ: "Z",
                        "ⓐ": "a",
                        ａ: "a",
                        ẚ: "a",
                        à: "a",
                        á: "a",
                        â: "a",
                        ầ: "a",
                        ấ: "a",
                        ẫ: "a",
                        ẩ: "a",
                        ã: "a",
                        ā: "a",
                        ă: "a",
                        ằ: "a",
                        ắ: "a",
                        ẵ: "a",
                        ẳ: "a",
                        ȧ: "a",
                        ǡ: "a",
                        ä: "a",
                        ǟ: "a",
                        ả: "a",
                        å: "a",
                        ǻ: "a",
                        ǎ: "a",
                        ȁ: "a",
                        ȃ: "a",
                        ạ: "a",
                        ậ: "a",
                        ặ: "a",
                        ḁ: "a",
                        ą: "a",
                        ⱥ: "a",
                        ɐ: "a",
                        ꜳ: "aa",
                        æ: "ae",
                        ǽ: "ae",
                        ǣ: "ae",
                        ꜵ: "ao",
                        ꜷ: "au",
                        ꜹ: "av",
                        ꜻ: "av",
                        ꜽ: "ay",
                        "ⓑ": "b",
                        ｂ: "b",
                        ḃ: "b",
                        ḅ: "b",
                        ḇ: "b",
                        ƀ: "b",
                        ƃ: "b",
                        ɓ: "b",
                        "ⓒ": "c",
                        ｃ: "c",
                        ć: "c",
                        ĉ: "c",
                        ċ: "c",
                        č: "c",
                        ç: "c",
                        ḉ: "c",
                        ƈ: "c",
                        ȼ: "c",
                        ꜿ: "c",
                        ↄ: "c",
                        "ⓓ": "d",
                        ｄ: "d",
                        ḋ: "d",
                        ď: "d",
                        ḍ: "d",
                        ḑ: "d",
                        ḓ: "d",
                        ḏ: "d",
                        đ: "d",
                        ƌ: "d",
                        ɖ: "d",
                        ɗ: "d",
                        ꝺ: "d",
                        ǳ: "dz",
                        ǆ: "dz",
                        "ⓔ": "e",
                        ｅ: "e",
                        è: "e",
                        é: "e",
                        ê: "e",
                        ề: "e",
                        ế: "e",
                        ễ: "e",
                        ể: "e",
                        ẽ: "e",
                        ē: "e",
                        ḕ: "e",
                        ḗ: "e",
                        ĕ: "e",
                        ė: "e",
                        ë: "e",
                        ẻ: "e",
                        ě: "e",
                        ȅ: "e",
                        ȇ: "e",
                        ẹ: "e",
                        ệ: "e",
                        ȩ: "e",
                        ḝ: "e",
                        ę: "e",
                        ḙ: "e",
                        ḛ: "e",
                        ɇ: "e",
                        ɛ: "e",
                        ǝ: "e",
                        "ⓕ": "f",
                        ｆ: "f",
                        ḟ: "f",
                        ƒ: "f",
                        ꝼ: "f",
                        "ⓖ": "g",
                        ｇ: "g",
                        ǵ: "g",
                        ĝ: "g",
                        ḡ: "g",
                        ğ: "g",
                        ġ: "g",
                        ǧ: "g",
                        ģ: "g",
                        ǥ: "g",
                        ɠ: "g",
                        ꞡ: "g",
                        ᵹ: "g",
                        ꝿ: "g",
                        "ⓗ": "h",
                        ｈ: "h",
                        ĥ: "h",
                        ḣ: "h",
                        ḧ: "h",
                        ȟ: "h",
                        ḥ: "h",
                        ḩ: "h",
                        ḫ: "h",
                        ẖ: "h",
                        ħ: "h",
                        ⱨ: "h",
                        ⱶ: "h",
                        ɥ: "h",
                        ƕ: "hv",
                        "ⓘ": "i",
                        ｉ: "i",
                        ì: "i",
                        í: "i",
                        î: "i",
                        ĩ: "i",
                        ī: "i",
                        ĭ: "i",
                        ï: "i",
                        ḯ: "i",
                        ỉ: "i",
                        ǐ: "i",
                        ȉ: "i",
                        ȋ: "i",
                        ị: "i",
                        į: "i",
                        ḭ: "i",
                        ɨ: "i",
                        ı: "i",
                        "ⓙ": "j",
                        ｊ: "j",
                        ĵ: "j",
                        ǰ: "j",
                        ɉ: "j",
                        "ⓚ": "k",
                        ｋ: "k",
                        ḱ: "k",
                        ǩ: "k",
                        ḳ: "k",
                        ķ: "k",
                        ḵ: "k",
                        ƙ: "k",
                        ⱪ: "k",
                        ꝁ: "k",
                        ꝃ: "k",
                        ꝅ: "k",
                        ꞣ: "k",
                        "ⓛ": "l",
                        ｌ: "l",
                        ŀ: "l",
                        ĺ: "l",
                        ľ: "l",
                        ḷ: "l",
                        ḹ: "l",
                        ļ: "l",
                        ḽ: "l",
                        ḻ: "l",
                        ſ: "l",
                        ł: "l",
                        ƚ: "l",
                        ɫ: "l",
                        ⱡ: "l",
                        ꝉ: "l",
                        ꞁ: "l",
                        ꝇ: "l",
                        ǉ: "lj",
                        "ⓜ": "m",
                        ｍ: "m",
                        ḿ: "m",
                        ṁ: "m",
                        ṃ: "m",
                        ɱ: "m",
                        ɯ: "m",
                        "ⓝ": "n",
                        ｎ: "n",
                        ǹ: "n",
                        ń: "n",
                        ñ: "n",
                        ṅ: "n",
                        ň: "n",
                        ṇ: "n",
                        ņ: "n",
                        ṋ: "n",
                        ṉ: "n",
                        ƞ: "n",
                        ɲ: "n",
                        ŉ: "n",
                        ꞑ: "n",
                        ꞥ: "n",
                        ǌ: "nj",
                        "ⓞ": "o",
                        ｏ: "o",
                        ò: "o",
                        ó: "o",
                        ô: "o",
                        ồ: "o",
                        ố: "o",
                        ỗ: "o",
                        ổ: "o",
                        õ: "o",
                        ṍ: "o",
                        ȭ: "o",
                        ṏ: "o",
                        ō: "o",
                        ṑ: "o",
                        ṓ: "o",
                        ŏ: "o",
                        ȯ: "o",
                        ȱ: "o",
                        ö: "o",
                        ȫ: "o",
                        ỏ: "o",
                        ő: "o",
                        ǒ: "o",
                        ȍ: "o",
                        ȏ: "o",
                        ơ: "o",
                        ờ: "o",
                        ớ: "o",
                        ỡ: "o",
                        ở: "o",
                        ợ: "o",
                        ọ: "o",
                        ộ: "o",
                        ǫ: "o",
                        ǭ: "o",
                        ø: "o",
                        ǿ: "o",
                        ɔ: "o",
                        ꝋ: "o",
                        ꝍ: "o",
                        ɵ: "o",
                        œ: "oe",
                        ƣ: "oi",
                        ȣ: "ou",
                        ꝏ: "oo",
                        "ⓟ": "p",
                        ｐ: "p",
                        ṕ: "p",
                        ṗ: "p",
                        ƥ: "p",
                        ᵽ: "p",
                        ꝑ: "p",
                        ꝓ: "p",
                        ꝕ: "p",
                        "ⓠ": "q",
                        ｑ: "q",
                        ɋ: "q",
                        ꝗ: "q",
                        ꝙ: "q",
                        "ⓡ": "r",
                        ｒ: "r",
                        ŕ: "r",
                        ṙ: "r",
                        ř: "r",
                        ȑ: "r",
                        ȓ: "r",
                        ṛ: "r",
                        ṝ: "r",
                        ŗ: "r",
                        ṟ: "r",
                        ɍ: "r",
                        ɽ: "r",
                        ꝛ: "r",
                        ꞧ: "r",
                        ꞃ: "r",
                        "ⓢ": "s",
                        ｓ: "s",
                        ß: "s",
                        ś: "s",
                        ṥ: "s",
                        ŝ: "s",
                        ṡ: "s",
                        š: "s",
                        ṧ: "s",
                        ṣ: "s",
                        ṩ: "s",
                        ș: "s",
                        ş: "s",
                        ȿ: "s",
                        ꞩ: "s",
                        ꞅ: "s",
                        ẛ: "s",
                        "ⓣ": "t",
                        ｔ: "t",
                        ṫ: "t",
                        ẗ: "t",
                        ť: "t",
                        ṭ: "t",
                        ț: "t",
                        ţ: "t",
                        ṱ: "t",
                        ṯ: "t",
                        ŧ: "t",
                        ƭ: "t",
                        ʈ: "t",
                        ⱦ: "t",
                        ꞇ: "t",
                        ꜩ: "tz",
                        "ⓤ": "u",
                        ｕ: "u",
                        ù: "u",
                        ú: "u",
                        û: "u",
                        ũ: "u",
                        ṹ: "u",
                        ū: "u",
                        ṻ: "u",
                        ŭ: "u",
                        ü: "u",
                        ǜ: "u",
                        ǘ: "u",
                        ǖ: "u",
                        ǚ: "u",
                        ủ: "u",
                        ů: "u",
                        ű: "u",
                        ǔ: "u",
                        ȕ: "u",
                        ȗ: "u",
                        ư: "u",
                        ừ: "u",
                        ứ: "u",
                        ữ: "u",
                        ử: "u",
                        ự: "u",
                        ụ: "u",
                        ṳ: "u",
                        ų: "u",
                        ṷ: "u",
                        ṵ: "u",
                        ʉ: "u",
                        "ⓥ": "v",
                        ｖ: "v",
                        ṽ: "v",
                        ṿ: "v",
                        ʋ: "v",
                        ꝟ: "v",
                        ʌ: "v",
                        ꝡ: "vy",
                        "ⓦ": "w",
                        ｗ: "w",
                        ẁ: "w",
                        ẃ: "w",
                        ŵ: "w",
                        ẇ: "w",
                        ẅ: "w",
                        ẘ: "w",
                        ẉ: "w",
                        ⱳ: "w",
                        "ⓧ": "x",
                        ｘ: "x",
                        ẋ: "x",
                        ẍ: "x",
                        "ⓨ": "y",
                        ｙ: "y",
                        ỳ: "y",
                        ý: "y",
                        ŷ: "y",
                        ỹ: "y",
                        ȳ: "y",
                        ẏ: "y",
                        ÿ: "y",
                        ỷ: "y",
                        ẙ: "y",
                        ỵ: "y",
                        ƴ: "y",
                        ɏ: "y",
                        ỿ: "y",
                        "ⓩ": "z",
                        ｚ: "z",
                        ź: "z",
                        ẑ: "z",
                        ż: "z",
                        ž: "z",
                        ẓ: "z",
                        ẕ: "z",
                        ƶ: "z",
                        ȥ: "z",
                        ɀ: "z",
                        ⱬ: "z",
                        ꝣ: "z",
                        Ά: "Α",
                        Έ: "Ε",
                        Ή: "Η",
                        Ί: "Ι",
                        Ϊ: "Ι",
                        Ό: "Ο",
                        Ύ: "Υ",
                        Ϋ: "Υ",
                        Ώ: "Ω",
                        ά: "α",
                        έ: "ε",
                        ή: "η",
                        ί: "ι",
                        ϊ: "ι",
                        ΐ: "ι",
                        ό: "ο",
                        ύ: "υ",
                        ϋ: "υ",
                        ΰ: "υ",
                        ώ: "ω",
                        ς: "σ",
                        "’": "'",
                    };
                }),
                e.define("select2/data/base", ["../utils"], function (i) {
                    function n(e, t) {
                        n.__super__.constructor.call(this);
                    }
                    return (
                        i.Extend(n, i.Observable),
                        (n.prototype.current = function (e) {
                            throw new Error("The `current` method must be defined in child classes.");
                        }),
                        (n.prototype.query = function (e, t) {
                            throw new Error("The `query` method must be defined in child classes.");
                        }),
                        (n.prototype.bind = function (e, t) {}),
                        (n.prototype.destroy = function () {}),
                        (n.prototype.generateResultId = function (e, t) {
                            var n = e.id + "-result-";
                            return (n += i.generateChars(4)), null != t.id ? (n += "-" + t.id.toString()) : (n += "-" + i.generateChars(4)), n;
                        }),
                        n
                    );
                }),
                e.define("select2/data/select", ["./base", "../utils", "jquery"], function (e, l, c) {
                    function n(e, t) {
                        (this.$element = e), (this.options = t), n.__super__.constructor.call(this);
                    }
                    return (
                        l.Extend(n, e),
                        (n.prototype.current = function (e) {
                            var t = this;
                            e(
                                Array.prototype.map.call(this.$element[0].querySelectorAll(":checked"), function (e) {
                                    return t.item(c(e));
                                })
                            );
                        }),
                        (n.prototype.select = function (o) {
                            var s = this;
                            if (((o.selected = !0), null != o.element && "option" === o.element.tagName.toLowerCase())) return (o.element.selected = !0), void this.$element.trigger("input").trigger("change");
                            if (this.$element.prop("multiple"))
                                this.current(function (e) {
                                    var t = [];
                                    (o = [o]).push.apply(o, e);
                                    for (var n = 0; n < o.length; n++) {
                                        var i = o[n].id;
                                        -1 === t.indexOf(i) && t.push(i);
                                    }
                                    s.$element.val(t), s.$element.trigger("input").trigger("change");
                                });
                            else {
                                var e = o.id;
                                this.$element.val(e), this.$element.trigger("input").trigger("change");
                            }
                        }),
                        (n.prototype.unselect = function (o) {
                            var s = this;
                            if (this.$element.prop("multiple")) {
                                if (((o.selected = !1), null != o.element && "option" === o.element.tagName.toLowerCase())) return (o.element.selected = !1), void this.$element.trigger("input").trigger("change");
                                this.current(function (e) {
                                    for (var t = [], n = 0; n < e.length; n++) {
                                        var i = e[n].id;
                                        i !== o.id && -1 === t.indexOf(i) && t.push(i);
                                    }
                                    s.$element.val(t), s.$element.trigger("input").trigger("change");
                                });
                            }
                        }),
                        (n.prototype.bind = function (e, t) {
                            var n = this;
                            (this.container = e).on("select", function (e) {
                                n.select(e.data);
                            }),
                                e.on("unselect", function (e) {
                                    n.unselect(e.data);
                                });
                        }),
                        (n.prototype.destroy = function () {
                            this.$element.find("*").each(function () {
                                l.RemoveData(this);
                            });
                        }),
                        (n.prototype.query = function (i, e) {
                            var o = [],
                                s = this;
                            this.$element.children().each(function () {
                                if ("option" === this.tagName.toLowerCase() || "optgroup" === this.tagName.toLowerCase()) {
                                    var e = c(this),
                                        t = s.item(e),
                                        n = s.matches(i, t);
                                    null !== n && o.push(n);
                                }
                            }),
                                e({ results: o });
                        }),
                        (n.prototype.addOptions = function (e) {
                            this.$element.append(e);
                        }),
                        (n.prototype.option = function (e) {
                            var t;
                            e.children ? ((t = document.createElement("optgroup")).label = e.text) : void 0 !== (t = document.createElement("option")).textContent ? (t.textContent = e.text) : (t.innerText = e.text),
                                void 0 !== e.id && (t.value = e.id),
                                e.disabled && (t.disabled = !0),
                                e.selected && (t.selected = !0),
                                e.title && (t.title = e.title);
                            var n = this._normalizeItem(e);
                            return (n.element = t), l.StoreData(t, "data", n), c(t);
                        }),
                        (n.prototype.item = function (e) {
                            var t = {};
                            if (null != (t = l.GetData(e[0], "data"))) return t;
                            var n = e[0];
                            if ("option" === n.tagName.toLowerCase()) t = { id: e.val(), text: e.text(), disabled: e.prop("disabled"), selected: e.prop("selected"), title: e.prop("title") };
                            else if ("optgroup" === n.tagName.toLowerCase()) {
                                t = { text: e.prop("label"), children: [], title: e.prop("title") };
                                for (var i = e.children("option"), o = [], s = 0; s < i.length; s++) {
                                    var r = c(i[s]),
                                        a = this.item(r);
                                    o.push(a);
                                }
                                t.children = o;
                            }
                            return ((t = this._normalizeItem(t)).element = e[0]), l.StoreData(e[0], "data", t), t;
                        }),
                        (n.prototype._normalizeItem = function (e) {
                            e !== Object(e) && (e = { id: e, text: e });
                            return (
                                null != (e = c.extend({}, { text: "" }, e)).id && (e.id = e.id.toString()),
                                null != e.text && (e.text = e.text.toString()),
                                null == e._resultId && e.id && null != this.container && (e._resultId = this.generateResultId(this.container, e)),
                                c.extend({}, { selected: !1, disabled: !1 }, e)
                            );
                        }),
                        (n.prototype.matches = function (e, t) {
                            return this.options.get("matcher")(e, t);
                        }),
                        n
                    );
                }),
                e.define("select2/data/array", ["./select", "../utils", "jquery"], function (e, t, f) {
                    function i(e, t) {
                        (this._dataToConvert = t.get("data") || []), i.__super__.constructor.call(this, e, t);
                    }
                    return (
                        t.Extend(i, e),
                        (i.prototype.bind = function (e, t) {
                            i.__super__.bind.call(this, e, t), this.addOptions(this.convertToOptions(this._dataToConvert));
                        }),
                        (i.prototype.select = function (n) {
                            var e = this.$element.find("option").filter(function (e, t) {
                                return t.value == n.id.toString();
                            });
                            0 === e.length && ((e = this.option(n)), this.addOptions(e)), i.__super__.select.call(this, n);
                        }),
                        (i.prototype.convertToOptions = function (e) {
                            var t = this,
                                n = this.$element.find("option"),
                                i = n
                                    .map(function () {
                                        return t.item(f(this)).id;
                                    })
                                    .get(),
                                o = [];
                            function s(e) {
                                return function () {
                                    return f(this).val() == e.id;
                                };
                            }
                            for (var r = 0; r < e.length; r++) {
                                var a = this._normalizeItem(e[r]);
                                if (0 <= i.indexOf(a.id)) {
                                    var l = n.filter(s(a)),
                                        c = this.item(l),
                                        u = f.extend(!0, {}, a, c),
                                        d = this.option(u);
                                    l.replaceWith(d);
                                } else {
                                    var p = this.option(a);
                                    if (a.children) {
                                        var h = this.convertToOptions(a.children);
                                        p.append(h);
                                    }
                                    o.push(p);
                                }
                            }
                            return o;
                        }),
                        i
                    );
                }),
                e.define("select2/data/ajax", ["./array", "../utils", "jquery"], function (e, t, s) {
                    function n(e, t) {
                        (this.ajaxOptions = this._applyDefaults(t.get("ajax"))), null != this.ajaxOptions.processResults && (this.processResults = this.ajaxOptions.processResults), n.__super__.constructor.call(this, e, t);
                    }
                    return (
                        t.Extend(n, e),
                        (n.prototype._applyDefaults = function (e) {
                            var t = {
                                data: function (e) {
                                    return s.extend({}, e, { q: e.term });
                                },
                                transport: function (e, t, n) {
                                    var i = s.ajax(e);
                                    return i.then(t), i.fail(n), i;
                                },
                            };
                            return s.extend({}, t, e, !0);
                        }),
                        (n.prototype.processResults = function (e) {
                            return e;
                        }),
                        (n.prototype.query = function (n, i) {
                            var o = this;
                            null != this._request && (s.isFunction(this._request.abort) && this._request.abort(), (this._request = null));
                            var t = s.extend({ type: "GET" }, this.ajaxOptions);
                            function e() {
                                var e = t.transport(
                                    t,
                                    function (e) {
                                        var t = o.processResults(e, n);
                                        o.options.get("debug") &&
                                            window.console &&
                                            console.error &&
                                            ((t && t.results && Array.isArray(t.results)) || console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")),
                                            i(t);
                                    },
                                    function () {
                                        ("status" in e && (0 === e.status || "0" === e.status)) || o.trigger("results:message", { message: "errorLoading" });
                                    }
                                );
                                o._request = e;
                            }
                            "function" == typeof t.url && (t.url = t.url.call(this.$element, n)),
                                "function" == typeof t.data && (t.data = t.data.call(this.$element, n)),
                                this.ajaxOptions.delay && null != n.term ? (this._queryTimeout && window.clearTimeout(this._queryTimeout), (this._queryTimeout = window.setTimeout(e, this.ajaxOptions.delay))) : e();
                        }),
                        n
                    );
                }),
                e.define("select2/data/tags", ["jquery"], function (t) {
                    function e(e, t, n) {
                        var i = n.get("tags"),
                            o = n.get("createTag");
                        void 0 !== o && (this.createTag = o);
                        var s = n.get("insertTag");
                        if ((void 0 !== s && (this.insertTag = s), e.call(this, t, n), Array.isArray(i)))
                            for (var r = 0; r < i.length; r++) {
                                var a = i[r],
                                    l = this._normalizeItem(a),
                                    c = this.option(l);
                                this.$element.append(c);
                            }
                    }
                    return (
                        (e.prototype.query = function (e, c, u) {
                            var d = this;
                            this._removeOldTags(),
                                null != c.term && null == c.page
                                    ? e.call(this, c, function e(t, n) {
                                          for (var i = t.results, o = 0; o < i.length; o++) {
                                              var s = i[o],
                                                  r = null != s.children && !e({ results: s.children }, !0);
                                              if ((s.text || "").toUpperCase() === (c.term || "").toUpperCase() || r) return !n && ((t.data = i), void u(t));
                                          }
                                          if (n) return !0;
                                          var a = d.createTag(c);
                                          if (null != a) {
                                              var l = d.option(a);
                                              l.attr("data-select2-tag", !0), d.addOptions([l]), d.insertTag(i, a);
                                          }
                                          (t.results = i), u(t);
                                      })
                                    : e.call(this, c, u);
                        }),
                        (e.prototype.createTag = function (e, t) {
                            if (null == t.term) return null;
                            var n = t.term.trim();
                            return "" === n ? null : { id: n, text: n };
                        }),
                        (e.prototype.insertTag = function (e, t, n) {
                            t.unshift(n);
                        }),
                        (e.prototype._removeOldTags = function (e) {
                            this.$element.find("option[data-select2-tag]").each(function () {
                                this.selected || t(this).remove();
                            });
                        }),
                        e
                    );
                }),
                e.define("select2/data/tokenizer", ["jquery"], function (d) {
                    function e(e, t, n) {
                        var i = n.get("tokenizer");
                        void 0 !== i && (this.tokenizer = i), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            e.call(this, t, n), (this.$search = t.dropdown.$search || t.selection.$search || n.find(".select2-search__field"));
                        }),
                        (e.prototype.query = function (e, t, n) {
                            var i = this;
                            t.term = t.term || "";
                            var o = this.tokenizer(t, this.options, function (e) {
                                var t = i._normalizeItem(e);
                                if (
                                    !i.$element.find("option").filter(function () {
                                        return d(this).val() === t.id;
                                    }).length
                                ) {
                                    var n = i.option(t);
                                    n.attr("data-select2-tag", !0), i._removeOldTags(), i.addOptions([n]);
                                }
                                !(function (e) {
                                    i.trigger("select", { data: e });
                                })(t);
                            });
                            o.term !== t.term && (this.$search.length && (this.$search.val(o.term), this.$search.trigger("focus")), (t.term = o.term)), e.call(this, t, n);
                        }),
                        (e.prototype.tokenizer = function (e, t, n, i) {
                            for (
                                var o = n.get("tokenSeparators") || [],
                                    s = t.term,
                                    r = 0,
                                    a =
                                        this.createTag ||
                                        function (e) {
                                            return { id: e.term, text: e.term };
                                        };
                                r < s.length;

                            ) {
                                var l = s[r];
                                if (-1 !== o.indexOf(l)) {
                                    var c = s.substr(0, r),
                                        u = a(d.extend({}, t, { term: c }));
                                    null != u ? (i(u), (s = s.substr(r + 1) || ""), (r = 0)) : r++;
                                } else r++;
                            }
                            return { term: s };
                        }),
                        e
                    );
                }),
                e.define("select2/data/minimumInputLength", [], function () {
                    function e(e, t, n) {
                        (this.minimumInputLength = n.get("minimumInputLength")), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.query = function (e, t, n) {
                            (t.term = t.term || ""),
                                t.term.length < this.minimumInputLength ? this.trigger("results:message", { message: "inputTooShort", args: { minimum: this.minimumInputLength, input: t.term, params: t } }) : e.call(this, t, n);
                        }),
                        e
                    );
                }),
                e.define("select2/data/maximumInputLength", [], function () {
                    function e(e, t, n) {
                        (this.maximumInputLength = n.get("maximumInputLength")), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.query = function (e, t, n) {
                            (t.term = t.term || ""),
                                0 < this.maximumInputLength && t.term.length > this.maximumInputLength
                                    ? this.trigger("results:message", { message: "inputTooLong", args: { maximum: this.maximumInputLength, input: t.term, params: t } })
                                    : e.call(this, t, n);
                        }),
                        e
                    );
                }),
                e.define("select2/data/maximumSelectionLength", [], function () {
                    function e(e, t, n) {
                        (this.maximumSelectionLength = n.get("maximumSelectionLength")), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                t.on("select", function () {
                                    i._checkIfMaximumSelected();
                                });
                        }),
                        (e.prototype.query = function (e, t, n) {
                            var i = this;
                            this._checkIfMaximumSelected(function () {
                                e.call(i, t, n);
                            });
                        }),
                        (e.prototype._checkIfMaximumSelected = function (e, n) {
                            var i = this;
                            this.current(function (e) {
                                var t = null != e ? e.length : 0;
                                0 < i.maximumSelectionLength && t >= i.maximumSelectionLength ? i.trigger("results:message", { message: "maximumSelected", args: { maximum: i.maximumSelectionLength } }) : n && n();
                            });
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown", ["jquery", "./utils"], function (t, e) {
                    function n(e, t) {
                        (this.$element = e), (this.options = t), n.__super__.constructor.call(this);
                    }
                    return (
                        e.Extend(n, e.Observable),
                        (n.prototype.render = function () {
                            var e = t('<span class="select2-dropdown"><span class="select2-results"></span></span>');
                            return e.attr("dir", this.options.get("dir")), (this.$dropdown = e);
                        }),
                        (n.prototype.bind = function () {}),
                        (n.prototype.position = function (e, t) {}),
                        (n.prototype.destroy = function () {
                            this.$dropdown.remove();
                        }),
                        n
                    );
                }),
                e.define("select2/dropdown/search", ["jquery"], function (s) {
                    function e() {}
                    return (
                        (e.prototype.render = function (e) {
                            var t = e.call(this),
                                n = s(
                                    '<span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="-1" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" /></span>'
                                );
                            return (this.$searchContainer = n), (this.$search = n.find("input")), this.$search.prop("autocomplete", this.options.get("autocomplete")), t.prepend(n), t;
                        }),
                        (e.prototype.bind = function (e, t, n) {
                            var i = this,
                                o = t.id + "-results";
                            e.call(this, t, n),
                                this.$search.on("keydown", function (e) {
                                    i.trigger("keypress", e), (i._keyUpPrevented = e.isDefaultPrevented());
                                }),
                                this.$search.on("input", function (e) {
                                    s(this).off("keyup");
                                }),
                                this.$search.on("keyup input", function (e) {
                                    i.handleSearch(e);
                                }),
                                t.on("open", function () {
                                    i.$search.attr("tabindex", 0),
                                        i.$search.attr("aria-controls", o),
                                        i.$search.trigger("focus"),
                                        window.setTimeout(function () {
                                            i.$search.trigger("focus");
                                        }, 0);
                                }),
                                t.on("close", function () {
                                    i.$search.attr("tabindex", -1), i.$search.removeAttr("aria-controls"), i.$search.removeAttr("aria-activedescendant"), i.$search.val(""), i.$search.trigger("blur");
                                }),
                                t.on("focus", function () {
                                    t.isOpen() || i.$search.trigger("focus");
                                }),
                                t.on("results:all", function (e) {
                                    (null != e.query.term && "" !== e.query.term) || (i.showSearch(e) ? i.$searchContainer[0].classList.remove("select2-search--hide") : i.$searchContainer[0].classList.add("select2-search--hide"));
                                }),
                                t.on("results:focus", function (e) {
                                    e.data._resultId ? i.$search.attr("aria-activedescendant", e.data._resultId) : i.$search.removeAttr("aria-activedescendant");
                                });
                        }),
                        (e.prototype.handleSearch = function (e) {
                            if (!this._keyUpPrevented) {
                                var t = this.$search.val();
                                this.trigger("query", { term: t });
                            }
                            this._keyUpPrevented = !1;
                        }),
                        (e.prototype.showSearch = function (e, t) {
                            return !0;
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/hidePlaceholder", [], function () {
                    function e(e, t, n, i) {
                        (this.placeholder = this.normalizePlaceholder(n.get("placeholder"))), e.call(this, t, n, i);
                    }
                    return (
                        (e.prototype.append = function (e, t) {
                            (t.results = this.removePlaceholder(t.results)), e.call(this, t);
                        }),
                        (e.prototype.normalizePlaceholder = function (e, t) {
                            return "string" == typeof t && (t = { id: "", text: t }), t;
                        }),
                        (e.prototype.removePlaceholder = function (e, t) {
                            for (var n = t.slice(0), i = t.length - 1; 0 <= i; i--) {
                                var o = t[i];
                                this.placeholder.id === o.id && n.splice(i, 1);
                            }
                            return n;
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/infiniteScroll", ["jquery"], function (n) {
                    function e(e, t, n, i) {
                        (this.lastParams = {}), e.call(this, t, n, i), (this.$loadingMore = this.createLoadingMore()), (this.loading = !1);
                    }
                    return (
                        (e.prototype.append = function (e, t) {
                            this.$loadingMore.remove(), (this.loading = !1), e.call(this, t), this.showLoadingMore(t) && (this.$results.append(this.$loadingMore), this.loadMoreIfNeeded());
                        }),
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                t.on("query", function (e) {
                                    (i.lastParams = e), (i.loading = !0);
                                }),
                                t.on("query:append", function (e) {
                                    (i.lastParams = e), (i.loading = !0);
                                }),
                                this.$results.on("scroll", this.loadMoreIfNeeded.bind(this));
                        }),
                        (e.prototype.loadMoreIfNeeded = function () {
                            var e = n.contains(document.documentElement, this.$loadingMore[0]);
                            if (!this.loading && e) {
                                var t = this.$results.offset().top + this.$results.outerHeight(!1);
                                this.$loadingMore.offset().top + this.$loadingMore.outerHeight(!1) <= t + 50 && this.loadMore();
                            }
                        }),
                        (e.prototype.loadMore = function () {
                            this.loading = !0;
                            var e = n.extend({}, { page: 1 }, this.lastParams);
                            e.page++, this.trigger("query:append", e);
                        }),
                        (e.prototype.showLoadingMore = function (e, t) {
                            return t.pagination && t.pagination.more;
                        }),
                        (e.prototype.createLoadingMore = function () {
                            var e = n('<li class="select2-results__option select2-results__option--load-more"role="option" aria-disabled="true"></li>'),
                                t = this.options.get("translations").get("loadingMore");
                            return e.html(t(this.lastParams)), e;
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/attachBody", ["jquery", "../utils"], function (f, a) {
                    function e(e, t, n) {
                        (this.$dropdownParent = f(n.get("dropdownParent") || document.body)), e.call(this, t, n);
                    }
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                t.on("open", function () {
                                    i._showDropdown(), i._attachPositioningHandler(t), i._bindContainerResultHandlers(t);
                                }),
                                t.on("close", function () {
                                    i._hideDropdown(), i._detachPositioningHandler(t);
                                }),
                                this.$dropdownContainer.on("mousedown", function (e) {
                                    e.stopPropagation();
                                });
                        }),
                        (e.prototype.destroy = function (e) {
                            e.call(this), this.$dropdownContainer.remove();
                        }),
                        (e.prototype.position = function (e, t, n) {
                            t.attr("class", n.attr("class")), t[0].classList.remove("select2"), t[0].classList.add("select2-container--open"), t.css({ position: "absolute", top: -999999 }), (this.$container = n);
                        }),
                        (e.prototype.render = function (e) {
                            var t = f("<span></span>"),
                                n = e.call(this);
                            return t.append(n), (this.$dropdownContainer = t);
                        }),
                        (e.prototype._hideDropdown = function (e) {
                            this.$dropdownContainer.detach();
                        }),
                        (e.prototype._bindContainerResultHandlers = function (e, t) {
                            if (!this._containerResultsHandlersBound) {
                                var n = this;
                                t.on("results:all", function () {
                                    n._positionDropdown(), n._resizeDropdown();
                                }),
                                    t.on("results:append", function () {
                                        n._positionDropdown(), n._resizeDropdown();
                                    }),
                                    t.on("results:message", function () {
                                        n._positionDropdown(), n._resizeDropdown();
                                    }),
                                    t.on("select", function () {
                                        n._positionDropdown(), n._resizeDropdown();
                                    }),
                                    t.on("unselect", function () {
                                        n._positionDropdown(), n._resizeDropdown();
                                    }),
                                    (this._containerResultsHandlersBound = !0);
                            }
                        }),
                        (e.prototype._attachPositioningHandler = function (e, t) {
                            var n = this,
                                i = "scroll.select2." + t.id,
                                o = "resize.select2." + t.id,
                                s = "orientationchange.select2." + t.id,
                                r = this.$container.parents().filter(a.hasScroll);
                            r.each(function () {
                                a.StoreData(this, "select2-scroll-position", { x: f(this).scrollLeft(), y: f(this).scrollTop() });
                            }),
                                r.on(i, function (e) {
                                    var t = a.GetData(this, "select2-scroll-position");
                                    f(this).scrollTop(t.y);
                                }),
                                f(window).on(i + " " + o + " " + s, function (e) {
                                    n._positionDropdown(), n._resizeDropdown();
                                });
                        }),
                        (e.prototype._detachPositioningHandler = function (e, t) {
                            var n = "scroll.select2." + t.id,
                                i = "resize.select2." + t.id,
                                o = "orientationchange.select2." + t.id;
                            this.$container.parents().filter(a.hasScroll).off(n), f(window).off(n + " " + i + " " + o);
                        }),
                        (e.prototype._positionDropdown = function () {
                            var e = f(window),
                                t = this.$dropdown[0].classList.contains("select2-dropdown--above"),
                                n = this.$dropdown[0].classList.contains("select2-dropdown--below"),
                                i = null,
                                o = this.$container.offset();
                            o.bottom = o.top + this.$container.outerHeight(!1);
                            var s = { height: this.$container.outerHeight(!1) };
                            (s.top = o.top), (s.bottom = o.top + s.height);
                            var r = this.$dropdown.outerHeight(!1),
                                a = e.scrollTop(),
                                l = e.scrollTop() + e.height(),
                                c = a < o.top - r,
                                u = l > o.bottom + r,
                                d = { left: o.left, top: s.bottom },
                                p = this.$dropdownParent;
                            "static" === p.css("position") && (p = p.offsetParent());
                            var h = { top: 0, left: 0 };
                            (f.contains(document.body, p[0]) || p[0].isConnected) && (h = p.offset()),
                                (d.top -= h.top),
                                (d.left -= h.left),
                                t || n || (i = "below"),
                                u || !c || t ? !c && u && t && (i = "below") : (i = "above"),
                                ("above" == i || (t && "below" !== i)) && (d.top = s.top - h.top - r),
                                null != i &&
                                    (this.$dropdown[0].classList.remove("select2-dropdown--below"),
                                    this.$dropdown[0].classList.remove("select2-dropdown--above"),
                                    this.$dropdown[0].classList.add("select2-dropdown--" + i),
                                    this.$container[0].classList.remove("select2-container--below"),
                                    this.$container[0].classList.remove("select2-container--above"),
                                    this.$container[0].classList.add("select2-container--" + i)),
                                this.$dropdownContainer.css(d);
                        }),
                        (e.prototype._resizeDropdown = function () {
                            var e = { width: this.$container.outerWidth(!1) + "px" };
                            this.options.get("dropdownAutoWidth") && ((e.minWidth = e.width), (e.position = "relative"), (e.width = "auto")), this.$dropdown.css(e);
                        }),
                        (e.prototype._showDropdown = function (e) {
                            this.$dropdownContainer.appendTo(this.$dropdownParent), this._positionDropdown(), this._resizeDropdown();
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/minimumResultsForSearch", [], function () {
                    function e(e, t, n, i) {
                        (this.minimumResultsForSearch = n.get("minimumResultsForSearch")), this.minimumResultsForSearch < 0 && (this.minimumResultsForSearch = 1 / 0), e.call(this, t, n, i);
                    }
                    return (
                        (e.prototype.showSearch = function (e, t) {
                            return (
                                !(
                                    (function e(t) {
                                        for (var n = 0, i = 0; i < t.length; i++) {
                                            var o = t[i];
                                            o.children ? (n += e(o.children)) : n++;
                                        }
                                        return n;
                                    })(t.data.results) < this.minimumResultsForSearch
                                ) && e.call(this, t)
                            );
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/selectOnClose", ["../utils"], function (s) {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                t.on("close", function (e) {
                                    i._handleSelectOnClose(e);
                                });
                        }),
                        (e.prototype._handleSelectOnClose = function (e, t) {
                            if (t && null != t.originalSelect2Event) {
                                var n = t.originalSelect2Event;
                                if ("select" === n._type || "unselect" === n._type) return;
                            }
                            var i = this.getHighlightedResults();
                            if (!(i.length < 1)) {
                                var o = s.GetData(i[0], "data");
                                (null != o.element && o.element.selected) || (null == o.element && o.selected) || this.trigger("select", { data: o });
                            }
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/closeOnSelect", [], function () {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            var i = this;
                            e.call(this, t, n),
                                t.on("select", function (e) {
                                    i._selectTriggered(e);
                                }),
                                t.on("unselect", function (e) {
                                    i._selectTriggered(e);
                                });
                        }),
                        (e.prototype._selectTriggered = function (e, t) {
                            var n = t.originalEvent;
                            (n && (n.ctrlKey || n.metaKey)) || this.trigger("close", { originalEvent: n, originalSelect2Event: t });
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/dropdownCss", ["../utils"], function (i) {
                    function e() {}
                    return (
                        (e.prototype.render = function (e) {
                            var t = e.call(this),
                                n = this.options.get("dropdownCssClass") || "";
                            return -1 !== n.indexOf(":all:") && ((n = n.replace(":all:", "")), i.copyNonInternalCssClasses(t[0], this.$element[0])), t.addClass(n), t;
                        }),
                        e
                    );
                }),
                e.define("select2/i18n/en", [], function () {
                    return {
                        errorLoading: function () {
                            return "The results could not be loaded.";
                        },
                        inputTooLong: function (e) {
                            var t = e.input.length - e.maximum,
                                n = "Please delete " + t + " character";
                            return 1 != t && (n += "s"), n;
                        },
                        inputTooShort: function (e) {
                            return "Please enter " + (e.minimum - e.input.length) + " or more characters";
                        },
                        loadingMore: function () {
                            return "Loading more results…";
                        },
                        maximumSelected: function (e) {
                            var t = "You can only select " + e.maximum + " item";
                            return 1 != e.maximum && (t += "s"), t;
                        },
                        noResults: function () {
                            return "No results found";
                        },
                        searching: function () {
                            return "Searching…";
                        },
                        removeAllItems: function () {
                            return "Remove all items";
                        },
                        removeItem: function () {
                            return "Remove item";
                        },
                    };
                }),
                e.define(
                    "select2/defaults",
                    [
                        "jquery",
                        "./results",
                        "./selection/single",
                        "./selection/multiple",
                        "./selection/placeholder",
                        "./selection/allowClear",
                        "./selection/search",
                        "./selection/selectionCss",
                        "./selection/eventRelay",
                        "./utils",
                        "./translation",
                        "./diacritics",
                        "./data/select",
                        "./data/array",
                        "./data/ajax",
                        "./data/tags",
                        "./data/tokenizer",
                        "./data/minimumInputLength",
                        "./data/maximumInputLength",
                        "./data/maximumSelectionLength",
                        "./dropdown",
                        "./dropdown/search",
                        "./dropdown/hidePlaceholder",
                        "./dropdown/infiniteScroll",
                        "./dropdown/attachBody",
                        "./dropdown/minimumResultsForSearch",
                        "./dropdown/selectOnClose",
                        "./dropdown/closeOnSelect",
                        "./dropdown/dropdownCss",
                        "./i18n/en",
                    ],
                    function (l, s, r, a, c, u, d, p, h, f, g, t, m, v, y, _, w, b, $, x, A, D, S, O, E, L, C, T, q, e) {
                        function n() {
                            this.reset();
                        }
                        return (
                            (n.prototype.apply = function (e) {
                                if (
                                    (null == (e = l.extend(!0, {}, this.defaults, e)).dataAdapter &&
                                        (null != e.ajax ? (e.dataAdapter = y) : null != e.data ? (e.dataAdapter = v) : (e.dataAdapter = m),
                                        0 < e.minimumInputLength && (e.dataAdapter = f.Decorate(e.dataAdapter, b)),
                                        0 < e.maximumInputLength && (e.dataAdapter = f.Decorate(e.dataAdapter, $)),
                                        0 < e.maximumSelectionLength && (e.dataAdapter = f.Decorate(e.dataAdapter, x)),
                                        e.tags && (e.dataAdapter = f.Decorate(e.dataAdapter, _)),
                                        (null == e.tokenSeparators && null == e.tokenizer) || (e.dataAdapter = f.Decorate(e.dataAdapter, w))),
                                    null == e.resultsAdapter &&
                                        ((e.resultsAdapter = s),
                                        null != e.ajax && (e.resultsAdapter = f.Decorate(e.resultsAdapter, O)),
                                        null != e.placeholder && (e.resultsAdapter = f.Decorate(e.resultsAdapter, S)),
                                        e.selectOnClose && (e.resultsAdapter = f.Decorate(e.resultsAdapter, C))),
                                    null == e.dropdownAdapter)
                                ) {
                                    if (e.multiple) e.dropdownAdapter = A;
                                    else {
                                        var t = f.Decorate(A, D);
                                        e.dropdownAdapter = t;
                                    }
                                    0 !== e.minimumResultsForSearch && (e.dropdownAdapter = f.Decorate(e.dropdownAdapter, L)),
                                        e.closeOnSelect && (e.dropdownAdapter = f.Decorate(e.dropdownAdapter, T)),
                                        null != e.dropdownCssClass && (e.dropdownAdapter = f.Decorate(e.dropdownAdapter, q)),
                                        (e.dropdownAdapter = f.Decorate(e.dropdownAdapter, E));
                                }
                                null == e.selectionAdapter &&
                                    (e.multiple ? (e.selectionAdapter = a) : (e.selectionAdapter = r),
                                    null != e.placeholder && (e.selectionAdapter = f.Decorate(e.selectionAdapter, c)),
                                    e.allowClear && (e.selectionAdapter = f.Decorate(e.selectionAdapter, u)),
                                    e.multiple && (e.selectionAdapter = f.Decorate(e.selectionAdapter, d)),
                                    null != e.selectionCssClass && (e.selectionAdapter = f.Decorate(e.selectionAdapter, p)),
                                    (e.selectionAdapter = f.Decorate(e.selectionAdapter, h))),
                                    (e.language = this._resolveLanguage(e.language)),
                                    e.language.push("en");
                                for (var n = [], i = 0; i < e.language.length; i++) {
                                    var o = e.language[i];
                                    -1 === n.indexOf(o) && n.push(o);
                                }
                                return (e.language = n), (e.translations = this._processTranslations(e.language, e.debug)), e;
                            }),
                            (n.prototype.reset = function () {
                                function a(e) {
                                    return e.replace(/[^\u0000-\u007E]/g, function (e) {
                                        return t[e] || e;
                                    });
                                }
                                this.defaults = {
                                    amdLanguageBase: "./i18n/",
                                    autocomplete: "off",
                                    closeOnSelect: !0,
                                    debug: !1,
                                    dropdownAutoWidth: !1,
                                    escapeMarkup: f.escapeMarkup,
                                    language: {},
                                    matcher: function e(t, n) {
                                        if (null == t.term || "" === t.term.trim()) return n;
                                        if (n.children && 0 < n.children.length) {
                                            for (var i = l.extend(!0, {}, n), o = n.children.length - 1; 0 <= o; o--) null == e(t, n.children[o]) && i.children.splice(o, 1);
                                            return 0 < i.children.length ? i : e(t, i);
                                        }
                                        var s = a(n.text).toUpperCase(),
                                            r = a(t.term).toUpperCase();
                                        return -1 < s.indexOf(r) ? n : null;
                                    },
                                    minimumInputLength: 0,
                                    maximumInputLength: 0,
                                    maximumSelectionLength: 0,
                                    minimumResultsForSearch: 0,
                                    selectOnClose: !1,
                                    scrollAfterSelect: !1,
                                    sorter: function (e) {
                                        return e;
                                    },
                                    templateResult: function (e) {
                                        return e.text;
                                    },
                                    templateSelection: function (e) {
                                        return e.text;
                                    },
                                    theme: "default",
                                    width: "resolve",
                                };
                            }),
                            (n.prototype.applyFromElement = function (e, t) {
                                var n = e.language,
                                    i = this.defaults.language,
                                    o = t.prop("lang"),
                                    s = t.closest("[lang]").prop("lang"),
                                    r = Array.prototype.concat.call(this._resolveLanguage(o), this._resolveLanguage(n), this._resolveLanguage(i), this._resolveLanguage(s));
                                return (e.language = r), e;
                            }),
                            (n.prototype._resolveLanguage = function (e) {
                                if (!e) return [];
                                if (l.isEmptyObject(e)) return [];
                                if (l.isPlainObject(e)) return [e];
                                var t;
                                t = Array.isArray(e) ? e : [e];
                                for (var n = [], i = 0; i < t.length; i++)
                                    if ((n.push(t[i]), "string" == typeof t[i] && 0 < t[i].indexOf("-"))) {
                                        var o = t[i].split("-")[0];
                                        n.push(o);
                                    }
                                return n;
                            }),
                            (n.prototype._processTranslations = function (e, t) {
                                for (var n = new g(), i = 0; i < e.length; i++) {
                                    var o = new g(),
                                        s = e[i];
                                    if ("string" == typeof s)
                                        try {
                                            o = g.loadPath(s);
                                        } catch (e) {
                                            try {
                                                (s = this.defaults.amdLanguageBase + s), (o = g.loadPath(s));
                                            } catch (e) {
                                                t && window.console && console.warn && console.warn('Select2: The language file for "' + s + '" could not be automatically loaded. A fallback will be used instead.');
                                            }
                                        }
                                    else o = l.isPlainObject(s) ? new g(s) : s;
                                    n.extend(o);
                                }
                                return n;
                            }),
                            (n.prototype.set = function (e, t) {
                                var n = {};
                                n[l.camelCase(e)] = t;
                                var i = f._convertData(n);
                                l.extend(!0, this.defaults, i);
                            }),
                            new n()
                        );
                    }
                ),
                e.define("select2/options", ["jquery", "./defaults", "./utils"], function (d, n, p) {
                    function e(e, t) {
                        (this.options = e), null != t && this.fromElement(t), null != t && (this.options = n.applyFromElement(this.options, t)), (this.options = n.apply(this.options));
                    }
                    return (
                        (e.prototype.fromElement = function (e) {
                            var t = ["select2"];
                            null == this.options.multiple && (this.options.multiple = e.prop("multiple")),
                                null == this.options.disabled && (this.options.disabled = e.prop("disabled")),
                                null == this.options.autocomplete && e.prop("autocomplete") && (this.options.autocomplete = e.prop("autocomplete")),
                                null == this.options.dir && (e.prop("dir") ? (this.options.dir = e.prop("dir")) : e.closest("[dir]").prop("dir") ? (this.options.dir = e.closest("[dir]").prop("dir")) : (this.options.dir = "ltr")),
                                e.prop("disabled", this.options.disabled),
                                e.prop("multiple", this.options.multiple),
                                p.GetData(e[0], "select2Tags") &&
                                    (this.options.debug &&
                                        window.console &&
                                        console.warn &&
                                        console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags="true"` attributes and will be removed in future versions of Select2.'),
                                    p.StoreData(e[0], "data", p.GetData(e[0], "select2Tags")),
                                    p.StoreData(e[0], "tags", !0)),
                                p.GetData(e[0], "ajaxUrl") &&
                                    (this.options.debug &&
                                        window.console &&
                                        console.warn &&
                                        console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."),
                                    e.attr("ajax--url", p.GetData(e[0], "ajaxUrl")),
                                    p.StoreData(e[0], "ajax-Url", p.GetData(e[0], "ajaxUrl")));
                            var n = {};
                            function i(e, t) {
                                return t.toUpperCase();
                            }
                            for (var o = 0; o < e[0].attributes.length; o++) {
                                var s = e[0].attributes[o].name,
                                    r = "data-";
                                if (s.substr(0, r.length) == r) {
                                    var a = s.substring(r.length),
                                        l = p.GetData(e[0], a);
                                    n[a.replace(/-([a-z])/g, i)] = l;
                                }
                            }
                            d.fn.jquery && "1." == d.fn.jquery.substr(0, 2) && e[0].dataset && (n = d.extend(!0, {}, e[0].dataset, n));
                            var c = d.extend(!0, {}, p.GetData(e[0]), n);
                            for (var u in (c = p._convertData(c))) -1 < t.indexOf(u) || (d.isPlainObject(this.options[u]) ? d.extend(this.options[u], c[u]) : (this.options[u] = c[u]));
                            return this;
                        }),
                        (e.prototype.get = function (e) {
                            return this.options[e];
                        }),
                        (e.prototype.set = function (e, t) {
                            this.options[e] = t;
                        }),
                        e
                    );
                }),
                e.define("select2/core", ["jquery", "./options", "./utils", "./keys"], function (t, c, u, i) {
                    var d = function (e, t) {
                        null != u.GetData(e[0], "select2") && u.GetData(e[0], "select2").destroy(), (this.$element = e), (this.id = this._generateId(e)), (t = t || {}), (this.options = new c(t, e)), d.__super__.constructor.call(this);
                        var n = e.attr("tabindex") || 0;
                        u.StoreData(e[0], "old-tabindex", n), e.attr("tabindex", "-1");
                        var i = this.options.get("dataAdapter");
                        this.dataAdapter = new i(e, this.options);
                        var o = this.render();
                        this._placeContainer(o);
                        var s = this.options.get("selectionAdapter");
                        (this.selection = new s(e, this.options)), (this.$selection = this.selection.render()), this.selection.position(this.$selection, o);
                        var r = this.options.get("dropdownAdapter");
                        (this.dropdown = new r(e, this.options)), (this.$dropdown = this.dropdown.render()), this.dropdown.position(this.$dropdown, o);
                        var a = this.options.get("resultsAdapter");
                        (this.results = new a(e, this.options, this.dataAdapter)), (this.$results = this.results.render()), this.results.position(this.$results, this.$dropdown);
                        var l = this;
                        this._bindAdapters(),
                            this._registerDomEvents(),
                            this._registerDataEvents(),
                            this._registerSelectionEvents(),
                            this._registerDropdownEvents(),
                            this._registerResultsEvents(),
                            this._registerEvents(),
                            this.dataAdapter.current(function (e) {
                                l.trigger("selection:update", { data: e });
                            }),
                            e[0].classList.add("select2-hidden-accessible"),
                            e.attr("aria-hidden", "true"),
                            this._syncAttributes(),
                            u.StoreData(e[0], "select2", this),
                            e.data("select2", this);
                    };
                    return (
                        u.Extend(d, u.Observable),
                        (d.prototype._generateId = function (e) {
                            return "select2-" + (null != e.attr("id") ? e.attr("id") : null != e.attr("name") ? e.attr("name") + "-" + u.generateChars(2) : u.generateChars(4)).replace(/(:|\.|\[|\]|,)/g, "");
                        }),
                        (d.prototype._placeContainer = function (e) {
                            e.insertAfter(this.$element);
                            var t = this._resolveWidth(this.$element, this.options.get("width"));
                            null != t && e.css("width", t);
                        }),
                        (d.prototype._resolveWidth = function (e, t) {
                            var n = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;
                            if ("resolve" == t) {
                                var i = this._resolveWidth(e, "style");
                                return null != i ? i : this._resolveWidth(e, "element");
                            }
                            if ("element" == t) {
                                var o = e.outerWidth(!1);
                                return o <= 0 ? "auto" : o + "px";
                            }
                            if ("style" != t) return "computedstyle" != t ? t : window.getComputedStyle(e[0]).width;
                            var s = e.attr("style");
                            if ("string" != typeof s) return null;
                            for (var r = s.split(";"), a = 0, l = r.length; a < l; a += 1) {
                                var c = r[a].replace(/\s/g, "").match(n);
                                if (null !== c && 1 <= c.length) return c[1];
                            }
                            return null;
                        }),
                        (d.prototype._bindAdapters = function () {
                            this.dataAdapter.bind(this, this.$container), this.selection.bind(this, this.$container), this.dropdown.bind(this, this.$container), this.results.bind(this, this.$container);
                        }),
                        (d.prototype._registerDomEvents = function () {
                            var t = this;
                            this.$element.on("change.select2", function () {
                                t.dataAdapter.current(function (e) {
                                    t.trigger("selection:update", { data: e });
                                });
                            }),
                                this.$element.on("focus.select2", function (e) {
                                    t.trigger("focus", e);
                                }),
                                (this._syncA = u.bind(this._syncAttributes, this)),
                                (this._syncS = u.bind(this._syncSubtree, this)),
                                (this._observer = new window.MutationObserver(function (e) {
                                    t._syncA(), t._syncS(e);
                                })),
                                this._observer.observe(this.$element[0], { attributes: !0, childList: !0, subtree: !1 });
                        }),
                        (d.prototype._registerDataEvents = function () {
                            var n = this;
                            this.dataAdapter.on("*", function (e, t) {
                                n.trigger(e, t);
                            });
                        }),
                        (d.prototype._registerSelectionEvents = function () {
                            var n = this,
                                i = ["toggle", "focus"];
                            this.selection.on("toggle", function () {
                                n.toggleDropdown();
                            }),
                                this.selection.on("focus", function (e) {
                                    n.focus(e);
                                }),
                                this.selection.on("*", function (e, t) {
                                    -1 === i.indexOf(e) && n.trigger(e, t);
                                });
                        }),
                        (d.prototype._registerDropdownEvents = function () {
                            var n = this;
                            this.dropdown.on("*", function (e, t) {
                                n.trigger(e, t);
                            });
                        }),
                        (d.prototype._registerResultsEvents = function () {
                            var n = this;
                            this.results.on("*", function (e, t) {
                                n.trigger(e, t);
                            });
                        }),
                        (d.prototype._registerEvents = function () {
                            var n = this;
                            this.on("open", function () {
                                n.$container[0].classList.add("select2-container--open");
                            }),
                                this.on("close", function () {
                                    n.$container[0].classList.remove("select2-container--open");
                                }),
                                this.on("enable", function () {
                                    n.$container[0].classList.remove("select2-container--disabled");
                                }),
                                this.on("disable", function () {
                                    n.$container[0].classList.add("select2-container--disabled");
                                }),
                                this.on("blur", function () {
                                    n.$container[0].classList.remove("select2-container--focus");
                                }),
                                this.on("query", function (t) {
                                    n.isOpen() || n.trigger("open", {}),
                                        this.dataAdapter.query(t, function (e) {
                                            n.trigger("results:all", { data: e, query: t });
                                        });
                                }),
                                this.on("query:append", function (t) {
                                    this.dataAdapter.query(t, function (e) {
                                        n.trigger("results:append", { data: e, query: t });
                                    });
                                }),
                                this.on("keypress", function (e) {
                                    var t = e.which;
                                    n.isOpen()
                                        ? t === i.ESC || t === i.TAB || (t === i.UP && e.altKey)
                                            ? (n.close(e), e.preventDefault())
                                            : t === i.ENTER
                                            ? (n.trigger("results:select", {}), e.preventDefault())
                                            : t === i.SPACE && e.ctrlKey
                                            ? (n.trigger("results:toggle", {}), e.preventDefault())
                                            : t === i.UP
                                            ? (n.trigger("results:previous", {}), e.preventDefault())
                                            : t === i.DOWN && (n.trigger("results:next", {}), e.preventDefault())
                                        : (t === i.ENTER || t === i.SPACE || (t === i.DOWN && e.altKey)) && (n.open(), e.preventDefault());
                                });
                        }),
                        (d.prototype._syncAttributes = function () {
                            this.options.set("disabled", this.$element.prop("disabled")), this.isDisabled() ? (this.isOpen() && this.close(), this.trigger("disable", {})) : this.trigger("enable", {});
                        }),
                        (d.prototype._isChangeMutation = function (e) {
                            var t = this;
                            if (e.addedNodes && 0 < e.addedNodes.length)
                                for (var n = 0; n < e.addedNodes.length; n++) {
                                    if (e.addedNodes[n].selected) return !0;
                                }
                            else {
                                if (e.removedNodes && 0 < e.removedNodes.length) return !0;
                                if (Array.isArray(e))
                                    return e.some(function (e) {
                                        return t._isChangeMutation(e);
                                    });
                            }
                            return !1;
                        }),
                        (d.prototype._syncSubtree = function (e) {
                            var t = this._isChangeMutation(e),
                                n = this;
                            t &&
                                this.dataAdapter.current(function (e) {
                                    n.trigger("selection:update", { data: e });
                                });
                        }),
                        (d.prototype.trigger = function (e, t) {
                            var n = d.__super__.trigger,
                                i = { open: "opening", close: "closing", select: "selecting", unselect: "unselecting", clear: "clearing" };
                            if ((void 0 === t && (t = {}), e in i)) {
                                var o = i[e],
                                    s = { prevented: !1, name: e, args: t };
                                if ((n.call(this, o, s), s.prevented)) return void (t.prevented = !0);
                            }
                            n.call(this, e, t);
                        }),
                        (d.prototype.toggleDropdown = function () {
                            this.isDisabled() || (this.isOpen() ? this.close() : this.open());
                        }),
                        (d.prototype.open = function () {
                            this.isOpen() || this.isDisabled() || this.trigger("query", {});
                        }),
                        (d.prototype.close = function (e) {
                            this.isOpen() && this.trigger("close", { originalEvent: e });
                        }),
                        (d.prototype.isEnabled = function () {
                            return !this.isDisabled();
                        }),
                        (d.prototype.isDisabled = function () {
                            return this.options.get("disabled");
                        }),
                        (d.prototype.isOpen = function () {
                            return this.$container[0].classList.contains("select2-container--open");
                        }),
                        (d.prototype.hasFocus = function () {
                            return this.$container[0].classList.contains("select2-container--focus");
                        }),
                        (d.prototype.focus = function (e) {
                            this.hasFocus() || (this.$container[0].classList.add("select2-container--focus"), this.trigger("focus", {}));
                        }),
                        (d.prototype.enable = function (e) {
                            this.options.get("debug") &&
                                window.console &&
                                console.warn &&
                                console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'),
                                (null != e && 0 !== e.length) || (e = [!0]);
                            var t = !e[0];
                            this.$element.prop("disabled", t);
                        }),
                        (d.prototype.data = function () {
                            this.options.get("debug") &&
                                0 < arguments.length &&
                                window.console &&
                                console.warn &&
                                console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.');
                            var t = [];
                            return (
                                this.dataAdapter.current(function (e) {
                                    t = e;
                                }),
                                t
                            );
                        }),
                        (d.prototype.val = function (e) {
                            if (
                                (this.options.get("debug") &&
                                    window.console &&
                                    console.warn &&
                                    console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'),
                                null == e || 0 === e.length)
                            )
                                return this.$element.val();
                            var t = e[0];
                            Array.isArray(t) &&
                                (t = t.map(function (e) {
                                    return e.toString();
                                })),
                                this.$element.val(t).trigger("input").trigger("change");
                        }),
                        (d.prototype.destroy = function () {
                            this.$container.remove(),
                                this._observer.disconnect(),
                                (this._observer = null),
                                (this._syncA = null),
                                (this._syncS = null),
                                this.$element.off(".select2"),
                                this.$element.attr("tabindex", u.GetData(this.$element[0], "old-tabindex")),
                                this.$element[0].classList.remove("select2-hidden-accessible"),
                                this.$element.attr("aria-hidden", "false"),
                                u.RemoveData(this.$element[0]),
                                this.$element.removeData("select2"),
                                this.dataAdapter.destroy(),
                                this.selection.destroy(),
                                this.dropdown.destroy(),
                                this.results.destroy(),
                                (this.dataAdapter = null),
                                (this.selection = null),
                                (this.dropdown = null),
                                (this.results = null);
                        }),
                        (d.prototype.render = function () {
                            var e = t('<span class="select2 select2-container"><span class="selection"></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>');
                            return e.attr("dir", this.options.get("dir")), (this.$container = e), this.$container[0].classList.add("select2-container--" + this.options.get("theme")), u.StoreData(e[0], "element", this.$element), e;
                        }),
                        d
                    );
                }),
                e.define("select2/dropdown/attachContainer", [], function () {
                    function e(e, t, n) {
                        e.call(this, t, n);
                    }
                    return (
                        (e.prototype.position = function (e, t, n) {
                            n.find(".dropdown-wrapper").append(t), t[0].classList.add("select2-dropdown--below"), n[0].classList.add("select2-container--below");
                        }),
                        e
                    );
                }),
                e.define("select2/dropdown/stopPropagation", [], function () {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            e.call(this, t, n);
                            this.$dropdown.on(
                                [
                                    "blur",
                                    "change",
                                    "click",
                                    "dblclick",
                                    "focus",
                                    "focusin",
                                    "focusout",
                                    "input",
                                    "keydown",
                                    "keyup",
                                    "keypress",
                                    "mousedown",
                                    "mouseenter",
                                    "mouseleave",
                                    "mousemove",
                                    "mouseover",
                                    "mouseup",
                                    "search",
                                    "touchend",
                                    "touchstart",
                                ].join(" "),
                                function (e) {
                                    e.stopPropagation();
                                }
                            );
                        }),
                        e
                    );
                }),
                e.define("select2/selection/stopPropagation", [], function () {
                    function e() {}
                    return (
                        (e.prototype.bind = function (e, t, n) {
                            e.call(this, t, n);
                            this.$selection.on(
                                [
                                    "blur",
                                    "change",
                                    "click",
                                    "dblclick",
                                    "focus",
                                    "focusin",
                                    "focusout",
                                    "input",
                                    "keydown",
                                    "keyup",
                                    "keypress",
                                    "mousedown",
                                    "mouseenter",
                                    "mouseleave",
                                    "mousemove",
                                    "mouseover",
                                    "mouseup",
                                    "search",
                                    "touchend",
                                    "touchstart",
                                ].join(" "),
                                function (e) {
                                    e.stopPropagation();
                                }
                            );
                        }),
                        e
                    );
                }),
                (l = function (p) {
                    var h,
                        f,
                        e = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
                        t = "onwheel" in document || 9 <= document.documentMode ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
                        g = Array.prototype.slice;
                    if (p.event.fixHooks) for (var n = e.length; n; ) p.event.fixHooks[e[--n]] = p.event.mouseHooks;
                    var m = (p.event.special.mousewheel = {
                        version: "3.1.12",
                        setup: function () {
                            if (this.addEventListener) for (var e = t.length; e; ) this.addEventListener(t[--e], i, !1);
                            else this.onmousewheel = i;
                            p.data(this, "mousewheel-line-height", m.getLineHeight(this)), p.data(this, "mousewheel-page-height", m.getPageHeight(this));
                        },
                        teardown: function () {
                            if (this.removeEventListener) for (var e = t.length; e; ) this.removeEventListener(t[--e], i, !1);
                            else this.onmousewheel = null;
                            p.removeData(this, "mousewheel-line-height"), p.removeData(this, "mousewheel-page-height");
                        },
                        getLineHeight: function (e) {
                            var t = p(e),
                                n = t["offsetParent" in p.fn ? "offsetParent" : "parent"]();
                            return n.length || (n = p("body")), parseInt(n.css("fontSize"), 10) || parseInt(t.css("fontSize"), 10) || 16;
                        },
                        getPageHeight: function (e) {
                            return p(e).height();
                        },
                        settings: { adjustOldDeltas: !0, normalizeOffset: !0 },
                    });
                    function i(e) {
                        var t,
                            n = e || window.event,
                            i = g.call(arguments, 1),
                            o = 0,
                            s = 0,
                            r = 0,
                            a = 0,
                            l = 0;
                        if (
                            (((e = p.event.fix(n)).type = "mousewheel"),
                            "detail" in n && (r = -1 * n.detail),
                            "wheelDelta" in n && (r = n.wheelDelta),
                            "wheelDeltaY" in n && (r = n.wheelDeltaY),
                            "wheelDeltaX" in n && (s = -1 * n.wheelDeltaX),
                            "axis" in n && n.axis === n.HORIZONTAL_AXIS && ((s = -1 * r), (r = 0)),
                            (o = 0 === r ? s : r),
                            "deltaY" in n && (o = r = -1 * n.deltaY),
                            "deltaX" in n && ((s = n.deltaX), 0 === r && (o = -1 * s)),
                            0 !== r || 0 !== s)
                        ) {
                            if (1 === n.deltaMode) {
                                var c = p.data(this, "mousewheel-line-height");
                                (o *= c), (r *= c), (s *= c);
                            } else if (2 === n.deltaMode) {
                                var u = p.data(this, "mousewheel-page-height");
                                (o *= u), (r *= u), (s *= u);
                            }
                            if (
                                ((t = Math.max(Math.abs(r), Math.abs(s))),
                                (!f || t < f) && y(n, (f = t)) && (f /= 40),
                                y(n, t) && ((o /= 40), (s /= 40), (r /= 40)),
                                (o = Math[1 <= o ? "floor" : "ceil"](o / f)),
                                (s = Math[1 <= s ? "floor" : "ceil"](s / f)),
                                (r = Math[1 <= r ? "floor" : "ceil"](r / f)),
                                m.settings.normalizeOffset && this.getBoundingClientRect)
                            ) {
                                var d = this.getBoundingClientRect();
                                (a = e.clientX - d.left), (l = e.clientY - d.top);
                            }
                            return (
                                (e.deltaX = s),
                                (e.deltaY = r),
                                (e.deltaFactor = f),
                                (e.offsetX = a),
                                (e.offsetY = l),
                                (e.deltaMode = 0),
                                i.unshift(e, o, s, r),
                                h && clearTimeout(h),
                                (h = setTimeout(v, 200)),
                                (p.event.dispatch || p.event.handle).apply(this, i)
                            );
                        }
                    }
                    function v() {
                        f = null;
                    }
                    function y(e, t) {
                        return m.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 == 0;
                    }
                    p.fn.extend({
                        mousewheel: function (e) {
                            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel");
                        },
                        unmousewheel: function (e) {
                            return this.unbind("mousewheel", e);
                        },
                    });
                }),
                "function" == typeof e.define && e.define.amd ? e.define("jquery-mousewheel", ["jquery"], l) : "object" == typeof exports ? (module.exports = l) : l(d),
                e.define("jquery.select2", ["jquery", "jquery-mousewheel", "./select2/core", "./select2/defaults", "./select2/utils"], function (o, e, s, t, r) {
                    if (null == o.fn.select2) {
                        var a = ["open", "close", "destroy"];
                        o.fn.select2 = function (t) {
                            if ("object" == typeof (t = t || {}))
                                return (
                                    this.each(function () {
                                        var e = o.extend(!0, {}, t);
                                        new s(o(this), e);
                                    }),
                                    this
                                );
                            if ("string" != typeof t) throw new Error("Invalid arguments for Select2: " + t);
                            var n,
                                i = Array.prototype.slice.call(arguments, 1);
                            return (
                                this.each(function () {
                                    var e = r.GetData(this, "select2");
                                    null == e && window.console && console.error && console.error("The select2('" + t + "') method was called on an element that is not using Select2."), (n = e[t].apply(e, i));
                                }),
                                -1 < a.indexOf(t) ? this : n
                            );
                        };
                    }
                    return null == o.fn.select2.defaults && (o.fn.select2.defaults = t), s;
                }),
                { define: e.define, require: e.require }
            );
        })(),
        t = e.require("jquery.select2");
    return (d.fn.select2.amd = e), t;
});

//var enoughRoomBelow = true;
//var enoughRoomAbove = false;

jQuery(document).ready(
    function ($) {

        $('#search-results-sortby').css({'visibility':'hidden','height':'0'});    
        $('#search-results-title').fadeOut(1);
        $('#the-legend-wrapper.legend-home').fadeOut(1);

        function ams_create_all()
        {
            $("[id^=ams__]").each(
                function () {
                    var cur_id = $(this).attr('id');
                    $('#' + cur_id).select2(
                        {
                            closeOnSelect : false,
                            allowHtml: true,
                            allowClear: true,
                            tags: false,
                            placeholder: $(this).attr('data-placeholder')
                        }
                    );
                }
            );
        }

        // create all the multiselects
        ams_create_all();

        // get results on standard form submit
        $(document).on(
            'submit', 'form#ams-form', function (e) {
                e.preventDefault();
                ams_search_results('default', 'form#ams-form', false);
            }
        );
        $(document).on(
            'submit', 'form#ams-form-mobile', function (e) {
                e.preventDefault();
                ams_search_results('default', 'form#ams-form-mobile', true);
            }
        );
        $('#ams-form-submit').click(
            function (e) {
                e.preventDefault();
                ams_search_results('default', '#ams-form-submit', false);
            }
        );
        $('#ams-form-submit-mobile').click(
            function (e) {
                e.preventDefault();
                ams_search_results('default', '#ams-form-submit-mobile', false);
            }
        );
        $('#ams-form-submit-mobile').click(
            function (e) {
                e.preventDefault();
                ams_search_results('default', '#ams-form-submit-mobile', true);
            }
        );

        // get results on advanced filter submit
        $('#ams-advanced-filters').click(
            function (e) {
                e.preventDefault();
                ams_search_results('filters', '#ams-advanced-filters', false);
            }
        );

        // get results on sortby change
        $('#search-results-sortby-select').change(
            function (e) {
                e.preventDefault();
                ams_search_results('sortby', '#search-results-sortby-select', false);
            }
        );

        // get results on quick link click
        $('.ams-quick-link').click(
            function (e) {
                e.preventDefault();
                reset_all_filters(false);
                var id = $(this).attr('id');
                var filters = $('#' + id).attr('data-filters');
                var f_arr = filters.split(',');
                $.each(
                    f_arr, function (i, v) {
                        var split = v.split('--');
                        var select = split[0];
                        $('#ams__' + select).val(v);
                        $('#ams__' + select).trigger('change');
                    }
                );
                ams_search_results('quicklink', id, false);
            }
        );

             // get results on home legend click
        $('.legend-home .ams-legend-link').click(
            function (e) {
                e.preventDefault();
                reset_all_filters(false);
                var id = $(this).attr('id');
                var filters = $('#' + id).attr('data-filters');
                var f_arr = filters.split(',');
                $.each(
                    f_arr, function (i, v) {
                        var split = v.split('--');
                        var select = split[0];
                        $('#ams__' + select).val(v);
                        $('#ams__' + select).trigger('change');
                    }
                );
                ams_search_results('legendlink', id, false);
            }
        );

        // reset all advanced filters
        function reset_all_filters(animate) {
            $("[id^=ams__]").each(
                function () {
                    $(this).val(null).trigger('change');
                }
            );
            var $form  = $('form#ams-form');
            var $input = $form.find('input[name="ams"]');
            $input.val('');
            var $form_m  = $('form#ams-form-mobile');
            var $input_m = $form_m.find('input[name="ams-mobile"]');
            $input_m.val('');
            if (animate == true) {
	            $('html, body').animate(
	                {
	                    scrollTop: $form.offset().top - 100
	                }, 250
	            ); 
	          }
        }

        $('#ams-reset-advanced-filters').click( function(e) {
        	e.preventDefault();
        	reset_all_filters(true);
        });

        function group_all_filters()
        {
            var all_filters = [];
            $("[id^=ams__]").each(
                function () {
                    var more_filters = $(this).select2('val');
                    if (null !== more_filters) {
                          all_filters = all_filters.concat(more_filters);
                    }
                }
            );
            all_filters = all_filters.join();
            return all_filters;
        }

        // send query via ajax
        function ams_search_results(type, id, mobile)
        {
            const the_ajaxurl  = repofbapac.ajaxurl;
            const the_security = repofbapac.security;
            var $results = $('#search-results');
            var $form    = $('form#ams-form');
            var $input   = $form.find('input[name="ams"]');
            var width    = parseInt($(window).width());
            if (width < 767) {
                var $form  = $('form#ams-form-mobile');
                var $input   = $form.find('input[name="ams-mobile"]');
            }
            if ('quicklink' === type) {
                var query   = $('#' + id).attr('data-query');
                var filters = $('#' + id).attr('data-filters');
                $input.val(query);
            } else {
                var query   = $input.val();
                var filters = group_all_filters();
            }
            var sortby   = $('#search-results-sortby-select').find(":selected").val();
            if ( ('' != filters) && (filters.split(',').length > 15) ) {
                alert('For best results, please select 15 tags or fewer.')
            } else if (( ('' != query) && (query.length > 1) ) || ( ('' != filters) && (filters.length > 1) ) ) {
                $.ajax(
                    {
                        type : 'post',
                        url : the_ajaxurl,
                        data : {
                            action   : 'Repo_Load_Search_results',
                            security : the_security,
                            query    : query,
                            filters  : filters,
                            width    : width,
                            sortby   : sortby
                        },
                        beforeSend: function () {
                            $('#search-results-sortby').css({'visibility':'hidden','height':'0'});
                            $('#search-results-title').fadeOut(1);
                            $('#the-legend-wrapper.legend-home').fadeOut(1);
                            $('#search-results-count').html('').fadeOut(1);
                        },
                        success : function ( response ) {
                            $('.has-results-or-no').addClass('has--results');
                            $results.html(response).fadeIn(50);
                            var newcount = jQuery('#search-results-hidden-count').attr('data-total');
                            if (newcount < 30) {
                                var extra_message = '';
                            } else {
                                var extra_message = '. Use additional filters to narrow down your results.';
                            }
                            $('#search-results-title').fadeIn();
                            if (newcount > 0) {    
                                var word = ' results';
                                if (newcount == 1) {
                                    var word = ' result';
                                }
                                $('#search-results-count').html(newcount + word + extra_message).fadeIn(50);
                                $('#search-results-sortby').css({'visibility':'visible','height':'auto'});
                                $('#the-legend-wrapper.legend-home').fadeIn();  
                            }
                            $('html, body').animate(
                                {
                                    scrollTop: $("#advanced-search-results").offset().top - 100
                                        }, 75
                            ); 
                            $('.post-col-content-more-results').fadeOut(1);
                            load_more_logic();
                            card_hover_effect();
                            copyto_clipboard_logic();
                            setTimeout(function(){
                        	  	var topics = $('#ams__topic').select2('val');
	                        	  if (null !== topics) {
	                        	  	if (1 === topics.length) {
	                        	  		var topic = topics[0];
	                        	  		var split = topic.split('--');
	                        	  		var which = split[1].replace('_', '-');
	                        	  		if ('other-topic' == which) {
                                            which = 'other';
                                        }
                        	  			$('.post-col-content').removeClass('topic-finsafety topic-economic-recovery topic-safety-misinfo topic-privacy topic-training-resource');
                        	  			$('.post-col-content').addClass('topic-' + which);
	                        	  	}
	                        	  }
	                        	}, 35);
                        }
                    }
                ); 
                return false;
            } else {
                alert('Error. Please search for something.');
            }
        }

        function load_more_logic()
        {
            $('#load-more-results').on(
                'click', function () {
                    $('#load-more-results').hide();
                    var which = parseInt($(this).attr('data-nextgroup'));
                    $('.post-col-content-more-results.more-group-' + which).fadeIn(1000);
                    var next = parseInt(which + 1);
                    $(this).fadeOut(500).fadeIn(500);
                    $(this).attr('data-nextgroup', next);
                    var total = $(this).attr('data-totalgroups');
                    setTimeout(
                        function () {
                            if (next <= total ) {
                                $('#load-more-results').show();
                            } else {
                                $('#load-more-results').hide();
                            }
                        }, 500
                    );
                }
            );
        }

        // tag / filter hover state
        $('.select2-selection__choice__remove').on(
            'hover', function () {
                $('.select2-container--default .select2-selection--multiple .select2-selection__choice__remove').css('background-color','#005178');
            }
        );

        // close featured info box
        $('.info-box-icon.close-bar').click(
            function (e) {
                $(this).closest('.featured-info-bar').animate({"opacity": 0});
            }
        );

        $('#ams__asset_type').on('select2:select', function(e) {
            var curr = $('#ams__asset_type').select2('val');
            if ('asset_type--case_study' == e.params.data.id ) {
                var case_study_arr = ['asset_type--case_study_micro_business', 'asset_type--case_study_small_business', 'asset_type--case_study_video', 'asset_type--case_study_women_entrepreneur', 'asset_type--case_study_written'];
                curr = curr.concat(case_study_arr);
                $('#ams__asset_type').val(curr);
                $('#ams__asset_type').trigger('change');
            }
        });

        $('#ams__mobile').on('select2:select', function(e) {
            var curr = $('#ams__mobile').select2('val');
            if ('asset_type--case_study' == e.params.data.id ) {
                var case_study_arr = ['asset_type--case_study_micro_business', 'asset_type--case_study_small_business', 'asset_type--case_study_video', 'asset_type--case_study_women_entrepreneur', 'asset_type--case_study_written'];
                curr = curr.concat(case_study_arr);
                $('#ams__mobile').val(curr);
                $('#ams__mobile').trigger('change');
            }
        });
        
        //anchor links on latest page
        if (location.href.indexOf("#") != -1) {
                      var url = encodeURI(location.href); 
                      var hash = url.substring(url.indexOf('#')+1);
            if ($('#' + hash)[0] ) {
                setTimeout(
                    function () {
                        scrollToAnchor(eval(hash));
                    }, 500
                );
            }
        }

        function scrollToAnchor(aid)
        {
            var aTag = $("a[name='a-"+ aid +"']");
            $('html,body').animate({scrollTop: aTag.offset().top - 75},'slow');
        }

        //card link icon hovers
        function card_hover_effect()
        {
            $('#advanced-search-results .card-link').hover(
              function () {
                    console.log('hovered');
                    var num   = $(this).attr('data-num');
                    var which = $(this).attr('data-part');
                    var other = ('icon' == which) ? 'text' : 'icon';
                    $('.card-link-' + other + '-' + num).toggleClass('hover');
                }
            );
        }

        //latest link icon hovers
        $('.latest-link').hover(
            function () {
                var num   = $(this).attr('data-num');
                var which = $(this).attr('data-part');
                var other = ('icon' == which) ? 'text' : 'icon';
                $('.latest-link-' + other + '-' + num).toggleClass('hover');
            }
        );

        //hero image fade
        if ($('#heroimage')[0]) {
            $('.heroimage-inner.not--first').fadeOut(1);
            setInterval(
                function () { 
                    var next = $('.heroimage-inner.current').attr('data-next');
                    $('.heroimage-inner.current').fadeOut(2000);
                    $('.heroimage-inner').removeClass('current');
                    $('#heroimage-inner-' + next).fadeIn(1500).addClass('current');
                }, 5000
            );
        }

        // tooltip
        $('.tooltip-circle').hover( function(){
            $('#tooltip-content').toggleClass('display');
            $('.select2-container.select2-container--default').removeClass('select2-container--open');
        });

        $(window).resize(function(){
          if ( $(window).width() < 768 ) {
            if ( $('.post-col-content-more-results')[0] ) {
                $('.post-col-content-more-results').fadeOut(1);
            }
          }
        });

        if ($('.page-template-template-latest')[0]) {

            function latest_page_view_more() {
            $('.more-group').fadeOut(1);
                $('#loadmore-cta').click(
                    function () {
                        var cur = parseInt($(this).attr('data-next'));
                        $('.more-group-' + cur).fadeIn();
                        var next = parseInt(cur + 1);
                        $(this).attr('data-next',next);
                        var max = $('#latest-query-totals').attr('data-totalgroups');
                        if (next >= max) {
                            $('#loadmore-cta').hide();
                        }
                    }
                );
            }

            latest_page_view_more();
        }

        // get results on latest pg legend click
        $('.legend-latest .ams-legend-link').click(
            function (e) {
                e.preventDefault();
                reset_all_filters(false);
                var id = $(this).attr('id');
                var filters = $('#' + id).attr('data-filters');
                var f_arr = filters.split(',');
                $.each(
                    f_arr, function (i, v) {
                        var split = v.split('--');
                        var select = split[0];
                        $('#ams__' + select).val(v);
                        $('#ams__' + select).trigger('change');
                    }
                );
                ams_latest_queries(id);
            }
        );

        // latest page ajax queries
        function ams_latest_queries(id)
        {
            const the_ajaxurl  = repofbapac.ajaxurl;
            const the_security = repofbapac.security;
            var $results = $('#latest-search-results');
            var filters = $('#' + id).attr('data-filters');
            if ( ('' != filters) && (filters.split(',').length > 15) ) {
                alert('For best results, please select 15 tags or fewer.')
            } else if ( ('' != filters) && (filters.length > 1) ) {
                $.ajax(
                    {
                        type : 'post',
                        url : the_ajaxurl,
                        data : {
                            action   : 'Repo_Load_Latest_results',
                            security : the_security,
                            filters  : filters
                        },
                        beforeSend: function () {
                            $results.html('').fadeOut(75);
                            $('#loadmore-cta').show().attr( 'data-next', parseInt(1) );
                        },
                        success : function ( response ) {
                            $results.html(response).fadeIn(150);
                            $('.more-group').fadeOut(1);
                            if (filters == 'topic--other_topic') {
                                $('.list-post-row').removeClass('topic-finsafety topic-economic-recovery topic-safety-misinfo topic-privacy topic-training-resource');
                                $('.list-post-row').addClass('topic-other');
                            }
                        }
                    }
                ); 
                return false;
            } else {
                alert('Error. Something went wrong. Try again.');
            }
        }


        //CopytoClipBoard Logic and encryption
        function copyto_clipboard_logic(){
            var $temp = jQuery("<input>");
            jQuery('.clipboard').on('click', function(e) {
                e.preventDefault();
                jQuery(".copytoclipboard").text("(Copy URL)")
                var url = jQuery(this).attr("href");
                // var assetid = jQuery(this).attr("id");
                var rowObj = jQuery(this).closest(".pccb-row");
                // var newurl = url+encodeURIComponent(encrypt_assetid);
                jQuery("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();
                rowObj.find(".copytoclipboard").text("(URL Copied)");
            })
        }
        copyto_clipboard_logic();
        // alert(1);
        

    }
);//docready
