<template>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-4 d-block navbar-space"
             data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="index.html"><img src="/assets/img/gallery/logo.png"
                                                                                  height="24" alt="..."/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span>
                </button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                        <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link fw-medium active"
                                                                               aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#team">Team</a>
                        </li>
                        <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#designIdeas">Design
                            Ideas</a></li>
                        <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#help">Help</a>
                        </li>
                    </ul>
                    <form class="ps-lg-5"><a class="btn btn-outline-warning text-primary order-1 order-lg-0" href="#!">Get
                        In Touch</a></form>
                </div>
            </div>
        </nav>

        <slot></slot>


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
<!--    <script src="vendors/@popperjs/popper.min.js"></script>-->
<!--    <script src="vendors/bootstrap/bootstrap.min.js"></script>-->
<!--    <script src="vendors/is/is.min.js"></script>-->
<!--    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>-->
<!--    <script src="vendors/fontawesome/all.min.js"></script>-->
<!--    <script src="/assets/js/theme.js"></script>-->


</template>


<script>
import axios from 'axios' // eslint-disable-line
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Pagination from '@/components/ListingPagination.vue'


// import Pagination from '@/components/Pagination'

import {
    getHeaderIcon,
    getErrorMessage,
    pluralize,
    pluralize3,
    momentDatetime,
    getDictionaryLabel,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'

import {
    settingsJsMomentDatetimeFormat, settingsCurrencyActiveLabels, settingsCurrencyIsTopLabels
} from '@/app.settings.js'

// file:///mnt/_work_sdb8/wwwroot/lar/BiCurrencies/resources/js/Components/ListingHeader.vue
// import app from '@/main.js'

export default {
    name: 'FrontendLayout',
    components: {
        VueFinalModal,
    },
    setup( props) {
        console.log('FrontendLayout props::')
        console.log(props)

        const app_version = ref('D')

        console.log('FrontendLayout::')


        const FrontendLayoutListOnMounted = async () => {
            console.log('FrontendLayoutListOnMounted::')


            return;
            "use strict";

            function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

            function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

            function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

            /* -------------------------------------------------------------------------- */

            /*                                    Utils                                   */

            /* -------------------------------------------------------------------------- */
            var docReady = function docReady(fn) {
                // see if DOM is already available
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', fn);
                } else {
                    setTimeout(fn, 1);
                }
            };

            var resize = function resize(fn) {
                return window.addEventListener('resize', fn);
            };

            var isIterableArray = function isIterableArray(array) {
                return Array.isArray(array) && !!array.length;
            };

            var camelize = function camelize(str) {
                var text = str.replace(/[-_\s.]+(.)?/g, function (_, c) {
                    return c ? c.toUpperCase() : '';
                });
                return "".concat(text.substr(0, 1).toLowerCase()).concat(text.substr(1));
            };

            var getData = function getData(el, data) {
                try {
                    return JSON.parse(el.dataset[camelize(data)]);
                } catch (e) {
                    return el.dataset[camelize(data)];
                }
            };
            /* ----------------------------- Colors function ---------------------------- */


            var hexToRgb = function hexToRgb(hexValue) {
                var hex;
                hexValue.indexOf('#') === 0 ? hex = hexValue.substring(1) : hex = hexValue; // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")

                var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.replace(shorthandRegex, function (m, r, g, b) {
                    return r + r + g + g + b + b;
                }));
                return result ? [parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)] : null;
            };

            var rgbaColor = function rgbaColor() {
                var color = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '#fff';
                var alpha = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0.5;
                return "rgba(".concat(hexToRgb(color), ", ").concat(alpha, ")");
            };
            /* --------------------------------- Colors --------------------------------- */


            var colors = {
                primary: '#0057FF',
                secondary: '#748194',
                success: '#00d27a',
                info: '#27bcfd',
                warning: '#f5803e',
                danger: '#e63757',
                light: '#F9FAFD',
                dark: '#000'
            };
            var grays = {
                white: '#fff',
                100: '#f9fafd',
                200: '#edf2f9',
                300: '#d8e2ef',
                400: '#b6c1d2',
                500: '#9da9bb',
                600: '#748194',
                700: '#5e6e82',
                800: '#4d5969',
                900: '#344050',
                1000: '#232e3c',
                1100: '#0b1727',
                black: '#000'
            };

            var hasClass = function hasClass(el, className) {
                !el && false;
                return el.classList.value.includes(className);
            };

            var addClass = function addClass(el, className) {
                el.classList.add(className);
            };

            var getOffset = function getOffset(el) {
                var rect = el.getBoundingClientRect();
                var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                return {
                    top: rect.top + scrollTop,
                    left: rect.left + scrollLeft
                };
            };

            var isScrolledIntoView = function isScrolledIntoView(el) {
                var top = el.offsetTop;
                var left = el.offsetLeft;
                var width = el.offsetWidth;
                var height = el.offsetHeight;

                while (el.offsetParent) {
                    // eslint-disable-next-line no-param-reassign
                    el = el.offsetParent;
                    top += el.offsetTop;
                    left += el.offsetLeft;
                }

                return {
                    all: top >= window.pageYOffset && left >= window.pageXOffset && top + height <= window.pageYOffset + window.innerHeight && left + width <= window.pageXOffset + window.innerWidth,
                    partial: top < window.pageYOffset + window.innerHeight && left < window.pageXOffset + window.innerWidth && top + height > window.pageYOffset && left + width > window.pageXOffset
                };
            };

            var breakpoints = {
                xs: 0,
                sm: 576,
                md: 768,
                lg: 992,
                xl: 1200,
                xxl: 1540
            };

            var getBreakpoint = function getBreakpoint(el) {
                var classes = el && el.classList.value;
                var breakpoint;

                if (classes) {
                    breakpoint = breakpoints[classes.split(' ').filter(function (cls) {
                        return cls.includes('navbar-expand-');
                    }).pop().split('-').pop()];
                }

                return breakpoint;
            };
            /* --------------------------------- Cookie --------------------------------- */


            var setCookie = function setCookie(name, value, expire) {
                var expires = new Date();
                expires.setTime(expires.getTime() + expire);
                document.cookie = "".concat(name, "=").concat(value, ";expires=").concat(expires.toUTCString());
            };

            var getCookie = function getCookie(name) {
                var keyValue = document.cookie.match("(^|;) ?".concat(name, "=([^;]*)(;|$)"));
                return keyValue ? keyValue[2] : keyValue;
            };

            var settings = {
                tinymce: {
                    theme: 'oxide'
                },
                chart: {
                    borderColor: 'rgba(255, 255, 255, 0.8)'
                }
            };
            /* -------------------------- Chart Initialization -------------------------- */

            var newChart = function newChart(chart, config) {
                var ctx = chart.getContext('2d');
                return new window.Chart(ctx, config);
            };
            /* ---------------------------------- Store --------------------------------- */


            var getItemFromStore = function getItemFromStore(key, defaultValue) {
                var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;

                try {
                    return JSON.parse(store.getItem(key)) || defaultValue;
                } catch (_unused) {
                    return store.getItem(key) || defaultValue;
                }
            };

            var setItemToStore = function setItemToStore(key, payload) {
                var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
                return store.setItem(key, payload);
            };

            var getStoreSpace = function getStoreSpace() {
                var store = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : localStorage;
                return parseFloat((escape(encodeURIComponent(JSON.stringify(store))).length / (1024 * 1024)).toFixed(2));
            };

            var utils = {
                docReady: docReady,
                resize: resize,
                isIterableArray: isIterableArray,
                camelize: camelize,
                getData: getData,
                hasClass: hasClass,
                addClass: addClass,
                hexToRgb: hexToRgb,
                rgbaColor: rgbaColor,
                colors: colors,
                grays: grays,
                getOffset: getOffset,
                isScrolledIntoView: isScrolledIntoView,
                getBreakpoint: getBreakpoint,
                setCookie: setCookie,
                getCookie: getCookie,
                newChart: newChart,
                settings: settings,
                getItemFromStore: getItemFromStore,
                setItemToStore: setItemToStore,
                getStoreSpace: getStoreSpace
            };
            /* -------------------------------------------------------------------------- */

            /*                                  Detector                                  */

            /* -------------------------------------------------------------------------- */

            var detectorInit = function detectorInit() {
                var _window = window,
                    is = _window.is;
                var html = document.querySelector('html');
                is.opera() && addClass(html, 'opera');
                is.mobile() && addClass(html, 'mobile');
                is.firefox() && addClass(html, 'firefox');
                is.safari() && addClass(html, 'safari');
                is.ios() && addClass(html, 'ios');
                is.iphone() && addClass(html, 'iphone');
                is.ipad() && addClass(html, 'ipad');
                is.ie() && addClass(html, 'ie');
                is.edge() && addClass(html, 'edge');
                is.chrome() && addClass(html, 'chrome');
                is.mac() && addClass(html, 'osx');
                is.windows() && addClass(html, 'windows');
                navigator.userAgent.match('CriOS') && addClass(html, 'chrome');
            };
            /*-----------------------------------------------
            |   Top navigation opacity on scroll
            -----------------------------------------------*/


            var navbarInit = function navbarInit() {
                var Selector = {
                    NAVBAR: '[data-navbar-on-scroll]',
                    NAVBAR_COLLAPSE: '.navbar-collapse',
                    NAVBAR_TOGGLER: '.navbar-toggler'
                };
                var ClassNames = {
                    COLLAPSED: 'collapsed'
                };
                var Events = {
                    SCROLL: 'scroll',
                    SHOW_BS_COLLAPSE: 'show.bs.collapse',
                    HIDE_BS_COLLAPSE: 'hide.bs.collapse',
                    HIDDEN_BS_COLLAPSE: 'hidden.bs.collapse'
                };
                var DataKey = {
                    NAVBAR_ON_SCROLL: 'navbar-light-on-scroll'
                };
                var navbar = document.querySelector(Selector.NAVBAR); // responsive nav collapsed

                navbar.addEventListener('click', function (e) {
                    if (e.target.classList.contains('nav-link') && window.innerWidth < utils.getBreakpoint(navbar)) {
                        navbar.querySelector(Selector.NAVBAR_TOGGLER).click();
                    }
                });

                if (navbar) {
                    var windowHeight = window.innerHeight;
                    var html = document.documentElement;
                    var navbarCollapse = navbar.querySelector(Selector.NAVBAR_COLLAPSE);

                    var allColors = _objectSpread(_objectSpread({}, utils.colors), utils.grays);

                    var name = utils.getData(navbar, DataKey.NAVBAR_ON_SCROLL);
                    var colorName = Object.keys(allColors).includes(name) ? name : 'light';
                    var color = allColors[colorName];
                    var bgClassName = "bg-".concat(colorName);
                    var shadowName = 'shadow-transition';
                    var colorRgb = utils.hexToRgb(color);

                    var _window$getComputedSt = window.getComputedStyle(navbar),
                        backgroundImage = _window$getComputedSt.backgroundImage;

                    var transition = 'background-color 0.35s ease';
                    navbar.style.backgroundImage = 'navbar-space'; // Change navbar background color on scroll

                    window.addEventListener(Events.SCROLL, function () {
                        var scrollTop = html.scrollTop;
                        var alpha = scrollTop / windowHeight * 0.5; // console.log(alpha);
                        // Add class on scroll

                        navbar.classList.add('backdrop');

                        if (alpha === 0) {
                            navbar.classList.remove('backdrop');
                        }

                        alpha >= 1 && (alpha = 1);
                        navbar.style.backgroundColor = "rgba(".concat(colorRgb[0], ", ").concat(colorRgb[1], ", ").concat(colorRgb[2], ", ").concat(alpha, ")");
                        navbar.style.backgroundImage = alpha > 0 || utils.hasClass(navbarCollapse, 'show') ? backgroundImage : 'navbar-space';
                        alpha > 0 || utils.hasClass(navbarCollapse, 'show') ? navbar.classList.add(shadowName) : navbar.classList.remove(shadowName);
                    }); // Toggle bg class on window resize

                    utils.resize(function () {
                        var breakPoint = utils.getBreakpoint(navbar);

                        if (window.innerWidth > breakPoint) {
                            navbar.style.backgroundImage = html.scrollTop ? backgroundImage : 'none';
                            navbar.style.transition = 'none';
                        } else if (!utils.hasClass(navbar.querySelector(Selector.NAVBAR_TOGGLER), ClassNames.COLLAPSED)) {
                            navbar.classList.add(bgClassName);
                            navbar.classList.add(shadowName);
                            navbar.style.backgroundImage = backgroundImage;
                        }

                        if (window.innerWidth <= breakPoint) {
                            navbar.style.transition = utils.hasClass(navbarCollapse, 'show') ? transition : 'none';
                        }
                    });
                    navbarCollapse.addEventListener(Events.SHOW_BS_COLLAPSE, function () {
                        navbar.classList.add(bgClassName);
                        navbar.classList.add(shadowName);
                        navbar.style.backgroundImage = backgroundImage;
                        navbar.style.transition = transition;
                    });
                    navbarCollapse.addEventListener(Events.HIDE_BS_COLLAPSE, function () {
                        navbar.classList.remove(bgClassName);
                        navbar.classList.remove(shadowName);
                        !html.scrollTop && (navbar.style.backgroundImage = 'none');
                    });
                    navbarCollapse.addEventListener(Events.HIDDEN_BS_COLLAPSE, function () {
                        navbar.style.transition = 'none';
                    });
                }
            };
            /* -------------------------------------------------------------------------- */

            /*                                Scroll To Top                               */

            /* -------------------------------------------------------------------------- */


            var scrollToTop = function scrollToTop() {
                document.querySelectorAll('[data-anchor] > a, [data-scroll-to]').forEach(function (anchor) {
                    anchor.addEventListener('click', function (e) {
                        var _utils$getData;

                        e.preventDefault();
                        var el = e.target;
                        var id = utils.getData(el, 'scroll-to') || el.getAttribute('href');
                        window.scroll({
                            top: (_utils$getData = utils.getData(el, 'offset-top')) !== null && _utils$getData !== void 0 ? _utils$getData : utils.getOffset(document.querySelector(id)).top - 100,
                            left: 0,
                            behavior: 'smooth'
                        });
                        window.location.hash = id;
                    });
                });
            }; // /* -------------------------------------------------------------------------- */
// /*                            Theme Initialization                            */
// /* -------------------------------------------------------------------------- */


            docReady(navbarInit);
            docReady(detectorInit);
            docReady(scrollToTop);
//# sourceMappingURL=theme.js.map

            // window.emitter.on('paginationPageChangedEvent', params => {
            //     console.log('TARGET paginationPageChangedEvent params::')
            //     console.log(params)
            //     if (params.parentComponentKey === 'currency') {
            //         currencyRowsPaginationPageClicked(params.page)
            //     }
            // })

        } // const FrontendLayoutListOnMounted = async () => {

        onMounted(FrontendLayoutListOnMounted)

        return { // setup return
            // Listing Page state
            app_version,


            // Settings vars
            settingsJsMomentDatetimeFormat,
            settingsCurrencyActiveLabels,
            settingsCurrencyIsTopLabels,


            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getErrorMessage,
            getHeaderIcon,
            getDictionaryLabel,
        }
    }, // setup() {

}
</script>


<style>
.currencies_modal_container {
    display: flex;
    justify-content: center;
    align-items: center;
    /*background-color: #343A40;*/
    /*background-color: olive !important;*/
}

.currencies_modal_header {
    background-color: #0f6d7c;
    color: $admin_text_color;
    /*border-bottom: 2px solid rgba(123,123,123);*/
    border-bottom: 1px solid  $admin_text_color;
    /*padding: 0;*/
    padding: 0.5rem 0.5rem;
    margin: 0;
    position: relative;
    /*border-top-left-radius: 0.5rem;*/
    /*border-top-right-radius: 0.5rem;*/
}

.currencies_modal_footer {
    /*border-top: 1px solid white;*/
    padding: 0.8rem;
    /*background-color: yellow;*/
}

.currencies_modal_content {
    position: relative;
    width: 50%;

    margin-left: 4px;
    min-height: 360px;
    /*max-height: 360px;*/
    padding: 0;
    overflow: auto;
    /*background-color: red !important;*/
    background-color: #343A40 !important;
    /*border-radius: 4px;*/

    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    /*border: 2px dotted yellow !important;*/


    /*height: 100%;*/
    /*//////////*/
    display: flex;
    flex-direction: column;

    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */

    background: rgba(255, 255, 255, .1);

}

/* Medium ≥768px  ipad or ipad mini */
@media only screen and (min-width: 768px) and (max-width: 991px) {
    /* Ipad Pro md */
    .currencies_modal_content {
        min-height: 500px;
        /*background-color: yellow !important;*/
    }
}

.currencies_modal_close {
    background-color: #0f6d7c;
    color:  $admin_text_color !important;
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 24px;
    height: 24px;
    /*margin: 4px 4px 0 0;*/
    cursor: pointer;
}

.currencies_modal_close::hover {
    color:  $admin_text_color !important;
    background-color: #0f6d7c;
}

.multiselect {
    /*    display: block  !important;*/
    /*    width: 100%  !important;*/
    /*    height: calc(2.25rem + 2px)  !important;*/
    /*    padding: 0.375rem 0.75rem  !important;*/
    /*    font-size: 1rem  !important;*/
    /*    font-weight: 400  !important;*/
    /*    line-height: 1.5  !important;*/
    /*    background-clip: padding-box  !important;*/
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    box-shadow: inset 0 0 0 transparent !important;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;


    background-color: #343A40 !important;
    color: $ admin_form_background_color !important;
}


.currencies_modal_content_editor_form {
    margin-top: 0.7rem;
    flex: 1; /* same as flex: 1 1 auto; */
    background-color: #343A40;
}


</style>
