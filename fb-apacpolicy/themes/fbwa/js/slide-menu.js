!(function (t) {
    var e = {};
    function n(r) {
        if (e[r]) return e[r].exports;
        var i = (e[r] = { i: r, l: !1, exports: {} });
        return t[r].call(i.exports, i, i.exports, n), (i.l = !0), i.exports;
    }
    (n.m = t),
        (n.c = e),
        (n.d = function (t, e, r) {
            n.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: r });
        }),
        (n.r = function (t) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });
        }),
        (n.t = function (t, e) {
            if ((1 & e && (t = n(t)), 8 & e)) return t;
            if (4 & e && "object" == typeof t && t && t.__esModule) return t;
            var r = Object.create(null);
            if ((n.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t))
                for (var i in t)
                    n.d(
                        r,
                        i,
                        function (e) {
                            return t[e];
                        }.bind(null, i)
                    );
            return r;
        }),
        (n.n = function (t) {
            var e =
                t && t.__esModule
                    ? function () {
                          return t.default;
                      }
                    : function () {
                          return t;
                      };
            return n.d(e, "a", e), e;
        }),
        (n.o = function (t, e) {
            return Object.prototype.hasOwnProperty.call(t, e);
        }),
        (n.p = ""),
        n((n.s = 51));
})([
    function (t, e, n) {
        (function (e) {
            var n = "object",
                r = function (t) {
                    return t && t.Math == Math && t;
                };
            t.exports = r(typeof globalThis == n && globalThis) || r(typeof window == n && window) || r(typeof self == n && self) || r(typeof e == n && e) || Function("return this")();
        }.call(this, n(24)));
    },
    function (t, e) {
        t.exports = function (t) {
            try {
                return !!t();
            } catch (t) {
                return !0;
            }
        };
    },
    function (t, e) {
        t.exports = function (t) {
            return "object" == typeof t ? null !== t : "function" == typeof t;
        };
    },
    function (t, e) {
        var n = {}.hasOwnProperty;
        t.exports = function (t, e) {
            return n.call(t, e);
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(8),
            o = n(26),
            c = r["__core-js_shared__"] || i("__core-js_shared__", {});
        (t.exports = function (t, e) {
            return c[t] || (c[t] = void 0 !== e ? e : {});
        })("versions", []).push({ version: "3.1.3", mode: o ? "pure" : "global", copyright: "© 2019 Denis Pushkarev (zloirock.ru)" });
    },
    function (t, e, n) {
        var r = n(6),
            i = n(11),
            o = n(14);
        t.exports = r
            ? function (t, e, n) {
                  return i.f(t, e, o(1, n));
              }
            : function (t, e, n) {
                  return (t[e] = n), t;
              };
    },
    function (t, e, n) {
        var r = n(1);
        t.exports = !r(function () {
            return (
                7 !=
                Object.defineProperty({}, "a", {
                    get: function () {
                        return 7;
                    },
                }).a
            );
        });
    },
    function (t, e, n) {
        var r = n(2);
        t.exports = function (t) {
            if (!r(t)) throw TypeError(String(t) + " is not an object");
            return t;
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(5);
        t.exports = function (t, e) {
            try {
                i(r, t, e);
            } catch (n) {
                r[t] = e;
            }
            return e;
        };
    },
    function (t, e, n) {
        var r = n(34),
            i = n(20);
        t.exports = function (t) {
            return r(i(t));
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(4),
            o = n(5),
            c = n(3),
            s = n(8),
            a = n(15),
            u = n(27),
            l = u.get,
            f = u.enforce,
            p = String(a).split("toString");
        i("inspectSource", function (t) {
            return a.call(t);
        }),
            (t.exports = function (t, e, n, i) {
                var a = !!i && !!i.unsafe,
                    u = !!i && !!i.enumerable,
                    l = !!i && !!i.noTargetGet;
                "function" == typeof n && ("string" != typeof e || c(n, "name") || o(n, "name", e), (f(n).source = p.join("string" == typeof e ? e : ""))),
                    t !== r ? (a ? !l && t[e] && (u = !0) : delete t[e], u ? (t[e] = n) : o(t, e, n)) : u ? (t[e] = n) : s(e, n);
            })(Function.prototype, "toString", function () {
                return ("function" == typeof this && l(this).source) || a.call(this);
            });
    },
    function (t, e, n) {
        var r = n(6),
            i = n(12),
            o = n(7),
            c = n(13),
            s = Object.defineProperty;
        e.f = r
            ? s
            : function (t, e, n) {
                  if ((o(t), (e = c(e, !0)), o(n), i))
                      try {
                          return s(t, e, n);
                      } catch (t) {}
                  if ("get" in n || "set" in n) throw TypeError("Accessors not supported");
                  return "value" in n && (t[e] = n.value), t;
              };
    },
    function (t, e, n) {
        var r = n(6),
            i = n(1),
            o = n(25);
        t.exports =
            !r &&
            !i(function () {
                return (
                    7 !=
                    Object.defineProperty(o("div"), "a", {
                        get: function () {
                            return 7;
                        },
                    }).a
                );
            });
    },
    function (t, e, n) {
        var r = n(2);
        t.exports = function (t, e) {
            if (!r(t)) return t;
            var n, i;
            if (e && "function" == typeof (n = t.toString) && !r((i = n.call(t)))) return i;
            if ("function" == typeof (n = t.valueOf) && !r((i = n.call(t)))) return i;
            if (!e && "function" == typeof (n = t.toString) && !r((i = n.call(t)))) return i;
            throw TypeError("Can't convert object to primitive value");
        };
    },
    function (t, e) {
        t.exports = function (t, e) {
            return { enumerable: !(1 & t), configurable: !(2 & t), writable: !(4 & t), value: e };
        };
    },
    function (t, e, n) {
        var r = n(4);
        t.exports = r("native-function-to-string", Function.toString);
    },
    function (t, e) {
        var n = 0,
            r = Math.random();
        t.exports = function (t) {
            return "Symbol(".concat(void 0 === t ? "" : t, ")_", (++n + r).toString(36));
        };
    },
    function (t, e) {
        t.exports = {};
    },
    function (t, e, n) {
        var r = n(6),
            i = n(33),
            o = n(14),
            c = n(9),
            s = n(13),
            a = n(3),
            u = n(12),
            l = Object.getOwnPropertyDescriptor;
        e.f = r
            ? l
            : function (t, e) {
                  if (((t = c(t)), (e = s(e, !0)), u))
                      try {
                          return l(t, e);
                      } catch (t) {}
                  if (a(t, e)) return o(!i.f.call(t, e), t[e]);
              };
    },
    function (t, e) {
        var n = {}.toString;
        t.exports = function (t) {
            return n.call(t).slice(8, -1);
        };
    },
    function (t, e) {
        t.exports = function (t) {
            if (null == t) throw TypeError("Can't call method on " + t);
            return t;
        };
    },
    function (t, e) {
        var n = Math.ceil,
            r = Math.floor;
        t.exports = function (t) {
            return isNaN((t = +t)) ? 0 : (t > 0 ? r : n)(t);
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(4),
            o = n(16),
            c = n(47),
            s = r.Symbol,
            a = i("wks");
        t.exports = function (t) {
            return a[t] || (a[t] = (c && s[t]) || (c ? s : o)("Symbol." + t));
        };
    },
    function (t, e, n) {
        "use strict";
        var r = n(10),
            i = n(7),
            o = n(1),
            c = n(30),
            s = /./.toString,
            a = RegExp.prototype,
            u = o(function () {
                return "/a/b" != s.call({ source: "a", flags: "b" });
            }),
            l = "toString" != s.name;
        (u || l) &&
            r(
                RegExp.prototype,
                "toString",
                function () {
                    var t = i(this),
                        e = String(t.source),
                        n = t.flags;
                    return "/" + e + "/" + String(void 0 === n && t instanceof RegExp && !("flags" in a) ? c.call(t) : n);
                },
                { unsafe: !0 }
            );
    },
    function (t, e) {
        var n;
        n = (function () {
            return this;
        })();
        try {
            n = n || new Function("return this")();
        } catch (t) {
            "object" == typeof window && (n = window);
        }
        t.exports = n;
    },
    function (t, e, n) {
        var r = n(0),
            i = n(2),
            o = r.document,
            c = i(o) && i(o.createElement);
        t.exports = function (t) {
            return c ? o.createElement(t) : {};
        };
    },
    function (t, e) {
        t.exports = !1;
    },
    function (t, e, n) {
        var r,
            i,
            o,
            c = n(28),
            s = n(0),
            a = n(2),
            u = n(5),
            l = n(3),
            f = n(29),
            p = n(17),
            h = s.WeakMap;
        if (c) {
            var d = new h(),
                m = d.get,
                v = d.has,
                E = d.set;
            (r = function (t, e) {
                return E.call(d, t, e), e;
            }),
                (i = function (t) {
                    return m.call(d, t) || {};
                }),
                (o = function (t) {
                    return v.call(d, t);
                });
        } else {
            var g = f("state");
            (p[g] = !0),
                (r = function (t, e) {
                    return u(t, g, e), e;
                }),
                (i = function (t) {
                    return l(t, g) ? t[g] : {};
                }),
                (o = function (t) {
                    return l(t, g);
                });
        }
        t.exports = {
            set: r,
            get: i,
            has: o,
            enforce: function (t) {
                return o(t) ? i(t) : r(t, {});
            },
            getterFor: function (t) {
                return function (e) {
                    var n;
                    if (!a(e) || (n = i(e)).type !== t) throw TypeError("Incompatible receiver, " + t + " required");
                    return n;
                };
            },
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(15),
            o = r.WeakMap;
        t.exports = "function" == typeof o && /native code/.test(i.call(o));
    },
    function (t, e, n) {
        var r = n(4),
            i = n(16),
            o = r("keys");
        t.exports = function (t) {
            return o[t] || (o[t] = i(t));
        };
    },
    function (t, e, n) {
        "use strict";
        var r = n(7);
        t.exports = function () {
            var t = r(this),
                e = "";
            return t.global && (e += "g"), t.ignoreCase && (e += "i"), t.multiline && (e += "m"), t.unicode && (e += "u"), t.sticky && (e += "y"), e;
        };
    },
    function (t, e, n) {
        "use strict";
        var r = n(32),
            i = n(45);
        r(
            { target: "String", proto: !0, forced: !n(48)("includes") },
            {
                includes: function (t) {
                    return !!~i(this, t, "includes").indexOf(t, arguments.length > 1 ? arguments[1] : void 0);
                },
            }
        );
    },
    function (t, e, n) {
        var r = n(0),
            i = n(18).f,
            o = n(5),
            c = n(10),
            s = n(8),
            a = n(35),
            u = n(44);
        t.exports = function (t, e) {
            var n,
                l,
                f,
                p,
                h,
                d = t.target,
                m = t.global,
                v = t.stat;
            if ((n = m ? r : v ? r[d] || s(d, {}) : (r[d] || {}).prototype))
                for (l in e) {
                    if (((p = e[l]), (f = t.noTargetGet ? (h = i(n, l)) && h.value : n[l]), !u(m ? l : d + (v ? "." : "#") + l, t.forced) && void 0 !== f)) {
                        if (typeof p == typeof f) continue;
                        a(p, f);
                    }
                    (t.sham || (f && f.sham)) && o(p, "sham", !0), c(n, l, p, t);
                }
        };
    },
    function (t, e, n) {
        "use strict";
        var r = {}.propertyIsEnumerable,
            i = Object.getOwnPropertyDescriptor,
            o = i && !r.call({ 1: 2 }, 1);
        e.f = o
            ? function (t) {
                  var e = i(this, t);
                  return !!e && e.enumerable;
              }
            : r;
    },
    function (t, e, n) {
        var r = n(1),
            i = n(19),
            o = "".split;
        t.exports = r(function () {
            return !Object("z").propertyIsEnumerable(0);
        })
            ? function (t) {
                  return "String" == i(t) ? o.call(t, "") : Object(t);
              }
            : Object;
    },
    function (t, e, n) {
        var r = n(3),
            i = n(36),
            o = n(18),
            c = n(11);
        t.exports = function (t, e) {
            for (var n = i(e), s = c.f, a = o.f, u = 0; u < n.length; u++) {
                var l = n[u];
                r(t, l) || s(t, l, a(e, l));
            }
        };
    },
    function (t, e, n) {
        var r = n(0),
            i = n(37),
            o = n(43),
            c = n(7),
            s = r.Reflect;
        t.exports =
            (s && s.ownKeys) ||
            function (t) {
                var e = i.f(c(t)),
                    n = o.f;
                return n ? e.concat(n(t)) : e;
            };
    },
    function (t, e, n) {
        var r = n(38),
            i = n(42).concat("length", "prototype");
        e.f =
            Object.getOwnPropertyNames ||
            function (t) {
                return r(t, i);
            };
    },
    function (t, e, n) {
        var r = n(3),
            i = n(9),
            o = n(39),
            c = n(17),
            s = o(!1);
        t.exports = function (t, e) {
            var n,
                o = i(t),
                a = 0,
                u = [];
            for (n in o) !r(c, n) && r(o, n) && u.push(n);
            for (; e.length > a; ) r(o, (n = e[a++])) && (~s(u, n) || u.push(n));
            return u;
        };
    },
    function (t, e, n) {
        var r = n(9),
            i = n(40),
            o = n(41);
        t.exports = function (t) {
            return function (e, n, c) {
                var s,
                    a = r(e),
                    u = i(a.length),
                    l = o(c, u);
                if (t && n != n) {
                    for (; u > l; ) if ((s = a[l++]) != s) return !0;
                } else for (; u > l; l++) if ((t || l in a) && a[l] === n) return t || l || 0;
                return !t && -1;
            };
        };
    },
    function (t, e, n) {
        var r = n(21),
            i = Math.min;
        t.exports = function (t) {
            return t > 0 ? i(r(t), 9007199254740991) : 0;
        };
    },
    function (t, e, n) {
        var r = n(21),
            i = Math.max,
            o = Math.min;
        t.exports = function (t, e) {
            var n = r(t);
            return n < 0 ? i(n + e, 0) : o(n, e);
        };
    },
    function (t, e) {
        t.exports = ["constructor", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "valueOf"];
    },
    function (t, e) {
        e.f = Object.getOwnPropertySymbols;
    },
    function (t, e, n) {
        var r = n(1),
            i = /#|\.prototype\./,
            o = function (t, e) {
                var n = s[c(t)];
                return n == u || (n != a && ("function" == typeof e ? r(e) : !!e));
            },
            c = (o.normalize = function (t) {
                return String(t).replace(i, ".").toLowerCase();
            }),
            s = (o.data = {}),
            a = (o.NATIVE = "N"),
            u = (o.POLYFILL = "P");
        t.exports = o;
    },
    function (t, e, n) {
        var r = n(46),
            i = n(20);
        t.exports = function (t, e, n) {
            if (r(e)) throw TypeError("String.prototype." + n + " doesn't accept regex");
            return String(i(t));
        };
    },
    function (t, e, n) {
        var r = n(2),
            i = n(19),
            o = n(22)("match");
        t.exports = function (t) {
            var e;
            return r(t) && (void 0 !== (e = t[o]) ? !!e : "RegExp" == i(t));
        };
    },
    function (t, e, n) {
        var r = n(1);
        t.exports =
            !!Object.getOwnPropertySymbols &&
            !r(function () {
                return !String(Symbol());
            });
    },
    function (t, e, n) {
        var r = n(22)("match");
        t.exports = function (t) {
            var e = /./;
            try {
                "/./"[t](e);
            } catch (n) {
                try {
                    return (e[r] = !1), "/./"[t](e);
                } catch (t) {}
            }
            return !1;
        };
    },
    function (t, e, n) {},
    ,
    function (t, e, n) {
        "use strict";
        n.r(e);
        var r, i, o;
        n(23), n(31), n(49);
        function c(t, e, n) {
            const r = [];
            for (; null !== t.parentElement && (void 0 === n || r.length < n); ) t instanceof HTMLElement && t.matches(e) && r.push(t), (t = t.parentElement);
            return r;
        }
        function s(t, e) {
            const n = c(t, e, 1);
            return n.length ? n[0] : null;
        }
        !(function (t) {
            (t[(t.Backward = -1)] = "Backward"), (t[(t.Forward = 1)] = "Forward");
        })(r || (r = {})),
            (function (t) {
                (t.Left = "left"), (t.Right = "right");
            })(i || (i = {})),
            (function (t) {
                (t.Back = "back"), (t.Close = "close"), (t.Forward = "forward"), (t.Navigate = "navigate"), (t.Open = "open");
            })(o || (o = {}));
        const a = { backLinkAfter: "", backLinkBefore: "", keyClose: "", keyOpen: "", position: "right", showBackLink: !0, submenuLinkAfter: "", submenuLinkBefore: "" };
        class u {
            constructor(t, e) {
                if (((this.level = 0), (this.isOpen = !1), (this.isAnimating = !1), (this.lastAction = null), null === t)) throw new Error("Argument `elem` must be a valid HTML node");
                (this.options = Object.assign({}, a, e)), (this.menuElem = t), (this.wrapperElem = document.createElement("div")), this.wrapperElem.classList.add(u.CLASS_NAMES.wrapper);
                const n = this.menuElem.querySelector("ul");
                n &&
                    (function (t, e) {
                        if (null === t.parentElement) throw Error("`elem` has no parentElement");
                        t.parentElement.insertBefore(e, t), e.appendChild(t);
                    })(n, this.wrapperElem),
                    this.initMenu(),
                    this.initSubmenus(),
                    this.initEventHandlers(),
                    (this.menuElem._slideMenu = this);
            }
            toggle(t) {
                let e,
                    n = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1];
                if (void 0 === t) return this.isOpen ? this.close(n) : this.open(n);
                if (((e = t ? 0 : this.options.position === i.Left ? "-100%" : "100%"), (this.isOpen = t), n)) this.moveSlider(this.menuElem, e);
                else {
                    const t = this.moveSlider.bind(this, this.menuElem, e);
                    this.runWithoutAnimation(t);
                }
            }
            open() {
                let t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                this.triggerEvent(o.Open), this.toggle(!0, t);
            }
            close() {
                let t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
                this.triggerEvent(o.Close), this.toggle(!1, t);
            }
            back() {
                this.navigate(r.Backward);
            }
            destroy() {
                const { submenuLinkAfter: t, submenuLinkBefore: e, showBackLink: n } = this.options;
                if (t || e) {
                    Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.decorator))).forEach((t) => {
                        t.parentElement && t.parentElement.removeChild(t);
                    });
                }
                if (n) {
                    Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.control))).forEach((t) => {
                        const e = s(t, "li");
                        e && e.parentElement && e.parentElement.removeChild(e);
                    });
                }
                !(function (t) {
                    const e = t.parentElement;
                    if (null === e) throw Error("`elem` has no parentElement");
                    for (; t.firstChild; ) e.insertBefore(t.firstChild, t);
                    e.removeChild(t);
                })(this.wrapperElem),
                    (this.menuElem.style.cssText = ""),
                    this.menuElem.querySelectorAll("ul").forEach((t) => (t.style.cssText = "")),
                    delete this.menuElem._slideMenu;
            }
            navigateTo(t) {
                if ((this.triggerEvent(o.Navigate), "string" == typeof t)) {
                    const e = document.querySelector(t);
                    if (!(e instanceof HTMLElement)) throw new Error("Invalid parameter `target`. A valid query selector is required.");
                    t = e;
                }
                Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.active))).forEach((t) => {
                    (t.style.display = "none"), t.classList.remove(u.CLASS_NAMES.active);
                });
                const e = c(t, "ul"),
                    n = e.length - 1;
                n >= 0 && n !== this.level && ((this.level = n), this.moveSlider(this.wrapperElem, 100 * -this.level)),
                    e.forEach((t) => {
                        (t.style.display = "block"), t.classList.add(u.CLASS_NAMES.active);
                    });
            }
            initEventHandlers() {
                Array.from(this.menuElem.querySelectorAll("a")).forEach((t) =>
                    t.addEventListener("click", (t) => {
                        const e = t.target,
                            n = e.matches("a") ? e : s(e, "a");
                        n && this.navigate(r.Forward, n);
                    })
                ),
                    this.menuElem.addEventListener("transitionend", this.onTransitionEnd.bind(this)),
                    this.wrapperElem.addEventListener("transitionend", this.onTransitionEnd.bind(this)),
                    this.initKeybindings(),
                    this.initSubmenuVisibility();
            }
            onTransitionEnd(t) {
                (t.target !== this.menuElem && t.target !== this.wrapperElem) || ((this.isAnimating = !1), this.lastAction && (this.triggerEvent(this.lastAction, !0), (this.lastAction = null)));
            }
            initKeybindings() {
                document.addEventListener("keydown", (t) => {
                    switch (t.key) {
                        case this.options.keyClose:
                            this.close();
                            break;
                        case this.options.keyOpen:
                            this.open();
                            break;
                        default:
                            return;
                    }
                    t.preventDefault();
                });
            }
            initSubmenuVisibility() {
                this.menuElem.addEventListener("sm.back-after", () => {
                    const t = ".".concat(u.CLASS_NAMES.active, " ").repeat(this.level + 1),
                        e = this.menuElem.querySelector("ul ".concat(t));
                    e && ((e.style.display = "none"), e.classList.remove(u.CLASS_NAMES.active));
                });
            }
            triggerEvent(t) {
                let e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
                this.lastAction = t;
                const n = "sm.".concat(t).concat(e ? "-after" : ""),
                    r = new CustomEvent(n);
                this.menuElem.dispatchEvent(r);
            }
            navigate() {
                let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : r.Forward,
                    e = arguments.length > 1 ? arguments[1] : void 0;
                if (this.isAnimating || (t === r.Backward && 0 === this.level)) return;
                const n = -100 * (this.level + t);
                if (e && null !== e.parentElement && t === r.Forward) {
                    const t = e.parentElement.querySelector("ul");
                    if (!t) return;
                    t.classList.add(u.CLASS_NAMES.active), (t.style.display = "block");
                }
                const i = t === r.Forward ? o.Forward : o.Back;
                this.triggerEvent(i), (this.level = this.level + t), this.moveSlider(this.wrapperElem, n);
            }
            moveSlider(t, e) {
                e.toString().includes("%") || (e += "%"), (t.style.transform = "translateX(".concat(e, ")")), (this.isAnimating = !0);
            }
            initMenu() {
                this.runWithoutAnimation(() => {
                    switch (this.options.position) {
                        case i.Left:
                            Object.assign(this.menuElem.style, { left: 0, right: "auto", transform: "translateX(-100%)" });
                            break;
                        default:
                            Object.assign(this.menuElem.style, { left: "auto", right: 0 });
                    }
                    this.menuElem.style.display = "block";
                });
            }
            runWithoutAnimation(t) {
                const e = [this.menuElem, this.wrapperElem];
                e.forEach((t) => (t.style.transition = "none")), t(), this.menuElem.offsetHeight, e.forEach((t) => t.style.removeProperty("transition")), (this.isAnimating = !1);
            }
            initSubmenus() {
                this.menuElem.querySelectorAll("a").forEach((t) => {
                    if (null === t.parentElement) return;
                    const e = t.parentElement.querySelector("ul");
                    if (!e) return;
                    t.addEventListener("click", (t) => {
                        t.preventDefault();
                    });
                    const n = t.textContent;
                    if ((this.addLinkDecorators(t), this.options.showBackLink)) {
                        const { backLinkBefore: t, backLinkAfter: r } = this.options,
                            i = document.createElement("a");
                        (i.innerHTML = t + n + r), i.classList.add(u.CLASS_NAMES.backlink, u.CLASS_NAMES.control), i.setAttribute("data-action", o.Back);
                        const c = document.createElement("li");
                        c.appendChild(i), e.insertBefore(c, e.firstChild);
                    }
                });
            }
            addLinkDecorators(t) {
                const { submenuLinkBefore: e, submenuLinkAfter: n } = this.options;
                if (e) {
                    const n = document.createElement("span");
                    n.classList.add(u.CLASS_NAMES.decorator), (n.innerHTML = e), t.insertBefore(n, t.firstChild);
                }
                if (n) {
                    const e = document.createElement("span");
                    e.classList.add(u.CLASS_NAMES.decorator), (e.innerHTML = n), t.appendChild(e);
                }
                return t;
            }
        }
        (u.NAMESPACE = "slide-menu"),
            (u.CLASS_NAMES = {
                active: "".concat(u.NAMESPACE, "__submenu--active"),
                backlink: "".concat(u.NAMESPACE, "__backlink"),
                control: "".concat(u.NAMESPACE, "__control"),
                decorator: "".concat(u.NAMESPACE, "__decorator"),
                wrapper: "".concat(u.NAMESPACE, "__slider"),
            }),
            document.addEventListener("click", (t) => {
                if (!(t.target instanceof HTMLElement)) return;
                const e = t.target.className.includes(u.CLASS_NAMES.control) ? t.target : s(t.target, ".".concat(u.CLASS_NAMES.control));
                if (!e || !e.className.includes(u.CLASS_NAMES.control)) return;
                const n = e.getAttribute("data-target"),
                    r = n && "this" !== n ? document.getElementById(n) : s(e, ".".concat(u.NAMESPACE));
                if (!r) throw new Error("Unable to find menu ".concat(n));
                const i = r._slideMenu,
                    o = e.getAttribute("data-action"),
                    c = e.getAttribute("data-arg");
                i && o && "function" == typeof i[o] && (c ? i[o](c) : i[o]());
            }),
            (window.SlideMenu = u);
    },
]);
