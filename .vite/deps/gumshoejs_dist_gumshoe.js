import {
  __commonJS
} from "./chunk-EWTE5DHJ.js";

// node_modules/gumshoejs/dist/gumshoe.js
var require_gumshoe = __commonJS({
  "node_modules/gumshoejs/dist/gumshoe.js"(exports, module) {
    (function(root, factory) {
      if (typeof define === "function" && define.amd) {
        define([], function() {
          return factory(root);
        });
      } else if (typeof exports === "object") {
        module.exports = factory(root);
      } else {
        root.Gumshoe = factory(root);
      }
    })(typeof global !== "undefined" ? global : typeof window !== "undefined" ? window : exports, function(window2) {
      "use strict";
      var defaults = {
        // Active classes
        navClass: "active",
        contentClass: "active",
        // Nested navigation
        nested: false,
        nestedClass: "active",
        // Offset & reflow
        offset: 0,
        reflow: false,
        // Event support
        events: true
      };
      var extend = function() {
        var merged = {};
        Array.prototype.forEach.call(arguments, function(obj) {
          for (var key in obj) {
            if (!obj.hasOwnProperty(key)) return;
            merged[key] = obj[key];
          }
        });
        return merged;
      };
      var emitEvent = function(type, elem, detail) {
        if (!detail.settings.events) return;
        var event = new CustomEvent(type, {
          bubbles: true,
          cancelable: true,
          detail
        });
        elem.dispatchEvent(event);
      };
      var getOffsetTop = function(elem) {
        var location = 0;
        if (elem.offsetParent) {
          while (elem) {
            location += elem.offsetTop;
            elem = elem.offsetParent;
          }
        }
        return location >= 0 ? location : 0;
      };
      var sortContents = function(contents) {
        if (contents) {
          contents.sort(function(item1, item2) {
            var offset1 = getOffsetTop(item1.content);
            var offset2 = getOffsetTop(item2.content);
            if (offset1 < offset2) return -1;
            return 1;
          });
        }
      };
      var getOffset = function(settings) {
        if (typeof settings.offset === "function") {
          return parseFloat(settings.offset());
        }
        return parseFloat(settings.offset);
      };
      var getDocumentHeight = function() {
        return Math.max(
          document.body.scrollHeight,
          document.documentElement.scrollHeight,
          document.body.offsetHeight,
          document.documentElement.offsetHeight,
          document.body.clientHeight,
          document.documentElement.clientHeight
        );
      };
      var isInView = function(elem, settings, bottom) {
        var bounds = elem.getBoundingClientRect();
        var offset = getOffset(settings);
        if (bottom) {
          return parseInt(bounds.bottom, 10) < (window2.innerHeight || document.documentElement.clientHeight);
        }
        return parseInt(bounds.top, 10) <= offset;
      };
      var isAtBottom = function() {
        if (window2.innerHeight + window2.pageYOffset >= getDocumentHeight()) return true;
        return false;
      };
      var useLastItem = function(item, settings) {
        if (isAtBottom() && isInView(item.content, settings, true)) return true;
        return false;
      };
      var getActive = function(contents, settings) {
        var last = contents[contents.length - 1];
        if (useLastItem(last, settings)) return last;
        for (var i = contents.length - 1; i >= 0; i--) {
          if (isInView(contents[i].content, settings)) return contents[i];
        }
      };
      var deactivateNested = function(nav, settings) {
        if (!settings.nested || !nav.parentNode) return;
        var li = nav.parentNode.closest("li");
        if (!li) return;
        li.classList.remove(settings.nestedClass);
        deactivateNested(li, settings);
      };
      var deactivate = function(items, settings) {
        if (!items) return;
        var li = items.nav.closest("li");
        if (!li) return;
        li.classList.remove(settings.navClass);
        items.content.classList.remove(settings.contentClass);
        deactivateNested(li, settings);
        emitEvent("gumshoeDeactivate", li, {
          link: items.nav,
          content: items.content,
          settings
        });
      };
      var activateNested = function(nav, settings) {
        if (!settings.nested) return;
        var li = nav.parentNode.closest("li");
        if (!li) return;
        li.classList.add(settings.nestedClass);
        activateNested(li, settings);
      };
      var activate = function(items, settings) {
        if (!items) return;
        var li = items.nav.closest("li");
        if (!li) return;
        li.classList.add(settings.navClass);
        items.content.classList.add(settings.contentClass);
        activateNested(li, settings);
        emitEvent("gumshoeActivate", li, {
          link: items.nav,
          content: items.content,
          settings
        });
      };
      var Constructor = function(selector, options) {
        var publicAPIs = {};
        var navItems, contents, current, timeout, settings;
        publicAPIs.setup = function() {
          navItems = document.querySelectorAll(selector);
          contents = [];
          Array.prototype.forEach.call(navItems, function(item) {
            var content = document.getElementById(decodeURIComponent(item.hash.substr(1)));
            if (!content) return;
            contents.push({
              nav: item,
              content
            });
          });
          sortContents(contents);
        };
        publicAPIs.detect = function() {
          var active = getActive(contents, settings);
          if (!active) {
            if (current) {
              deactivate(current, settings);
              current = null;
            }
            return;
          }
          if (current && active.content === current.content) return;
          deactivate(current, settings);
          activate(active, settings);
          current = active;
        };
        var scrollHandler = function(event) {
          if (timeout) {
            window2.cancelAnimationFrame(timeout);
          }
          timeout = window2.requestAnimationFrame(publicAPIs.detect);
        };
        var resizeHandler = function(event) {
          if (timeout) {
            window2.cancelAnimationFrame(timeout);
          }
          timeout = window2.requestAnimationFrame(function() {
            sortContents(contents);
            publicAPIs.detect();
          });
        };
        publicAPIs.destroy = function() {
          if (current) {
            deactivate(current, settings);
          }
          window2.removeEventListener("scroll", scrollHandler, false);
          if (settings.reflow) {
            window2.removeEventListener("resize", resizeHandler, false);
          }
          contents = null;
          navItems = null;
          current = null;
          timeout = null;
          settings = null;
        };
        var init = function() {
          settings = extend(defaults, options || {});
          publicAPIs.setup();
          publicAPIs.detect();
          window2.addEventListener("scroll", scrollHandler, false);
          if (settings.reflow) {
            window2.addEventListener("resize", resizeHandler, false);
          }
        };
        init();
        return publicAPIs;
      };
      return Constructor;
    });
  }
});
export default require_gumshoe();
/*! Bundled license information:

gumshoejs/dist/gumshoe.js:
  (*!
   * gumshoejs v5.1.2
   * A simple, framework-agnostic scrollspy script.
   * (c) 2019 Chris Ferdinandi
   * MIT License
   * http://github.com/cferdinandi/gumshoe
   *)
*/
//# sourceMappingURL=gumshoejs_dist_gumshoe.js.map
