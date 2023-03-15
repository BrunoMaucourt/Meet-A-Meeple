(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$":
/*!****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.[jt]sx?$ ***!
  \****************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$";

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js":
/*!******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_reflect_to_string_tag_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.reflect.to-string-tag.js */ "./node_modules/core-js/modules/es.reflect.to-string-tag.js");
/* harmony import */ var core_js_modules_es_reflect_to_string_tag_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_to_string_tag_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.error.cause.js */ "./node_modules/core-js/modules/es.error.cause.js");
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }



















function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);
  var _super = _createSuper(_default);
  function _default() {
    _classCallCheck(this, _default);
    return _super.apply(this, arguments);
  }
  _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
  }]);
  return _default;
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_19__.Controller);


/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)


// start the Stimulus application


/******** START FOOTER********/

var header = document.querySelector('header');
var body = document.querySelector('body');
var site_title = document.querySelector('#site_title');

/*START ANIMATION MENU*/
window.addEventListener('resize', function () {
  if (body.offsetWidth < 1280) {
    site_title.style.transform = "scale(1) translateY(0px)";
    site_title.style.transition = "all 1s ease";
  } else if (body.offsetWidth > 1280 && scrollY < 80) {
    site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
    header.style.boxShadow = "none";
    header.style.transition = "all 1.5s ease";
    site_title.style.transition = "all 1s ease";
  }
});
document.addEventListener('scroll', function () {
  if (scrollY > 80 && body.offsetWidth > 1280) {
    site_title.style.transform = "scale(1) translateY(0px)";
    site_title.style.transition = "all 1s ease";
    header.style.boxShadow = "2px 0px 2px black";
    header.style.transition = "all 1.5s ease";
  } else if (scrollY < 80 && body.offsetWidth > 1280) {
    site_title.style.transform = "scale(1.2,1.2) translateY(2rem)";
    site_title.style.transition = "all 1s ease";
    header.style.boxShadow = "none";
    header.style.transition = "all 1.5s ease";
  } else if (body.offsetWidth < 1280 && scrollY < 80) {
    header.style.boxShadow = "none";
    header.style.transition = "all 1.5s ease";
  } else {
    header.style.boxShadow = "2px 0px 2px black";
    header.style.transition = "all 1.5s ease";
  }
});
/*END ANIMATION MENU*/

/* START BURGER MENU */
var open_mobile_menu_btn = document.querySelector('#mobile-open-button');
var close_mobile_menu_btn = document.querySelector('#mobile-close-button');
var mobile_menu = document.querySelector('#mobile-menu');
var isMobileMenuVisible = false;
function toggleMenu() {
  mobile_menu.classList.toggle('hidden');
  mobile_menu.classList.toggle('flex');
  console.log(isMobileMenuVisible);
  if (isMobileMenuVisible) {
    isMobileMenuVisible = false;
  } else {
    isMobileMenuVisible = true;
  }
}
open_mobile_menu_btn.addEventListener('click', toggleMenu);
close_mobile_menu_btn.addEventListener('click', toggleMenu);
/* END BURGER MENU */

/*START PROFIL MENU*/
var profil_menu_button = document.querySelector('#profil-menu-button');
var profil_menu = document.querySelector('#profil-menu');
var isProfilMenuVisible = false;
function toggleProfilMenu() {
  profil_menu.classList.toggle('hidden');
  profil_menu.classList.toggle('flex');
  if (isProfilMenuVisible) {
    isProfilMenuVisible = false;
  } else {
    isProfilMenuVisible = true;
  }
}
profil_menu_button.addEventListener('click', toggleProfilMenu);
document.addEventListener('click', function (e) {
  if (e.target.id !== "profil-menu" && e.target.id !== "profil-menu-button" && isProfilMenuVisible) {
    toggleProfilMenu();
  } else if (e.target.id !== "mobile-menu" && e.target.id !== "mobile-open-button" && isMobileMenuVisible) {
    toggleMenu();
  }
});
/*END PROFIL MENU*/
/********END FOOTER********/

/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$"));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_da-03e5c3"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUFNYSxHQUFHLEdBQUdELDBFQUFnQixDQUFDRSx5SUFJbkMsQ0FBQzs7QUFFRjtBQUNBOzs7Ozs7Ozs7Ozs7QUNWQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8gXFwuW2p0XXN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy5qc29uIiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9oZWxsb19jb250cm9sbGVyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Jvb3RzdHJhcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/NmJlNiJdLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgbWFwID0ge1xuXHRcIi4vaGVsbG9fY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanNcIlxufTtcblxuXG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dChyZXEpIHtcblx0dmFyIGlkID0gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSk7XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKGlkKTtcbn1cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpIHtcblx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhtYXAsIHJlcSkpIHtcblx0XHR2YXIgZSA9IG5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIgKyByZXEgKyBcIidcIik7XG5cdFx0ZS5jb2RlID0gJ01PRFVMRV9OT1RfRk9VTkQnO1xuXHRcdHRocm93IGU7XG5cdH1cblx0cmV0dXJuIG1hcFtyZXFdO1xufVxud2VicGFja0NvbnRleHQua2V5cyA9IGZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0S2V5cygpIHtcblx0cmV0dXJuIE9iamVjdC5rZXlzKG1hcCk7XG59O1xud2VicGFja0NvbnRleHQucmVzb2x2ZSA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZTtcbm1vZHVsZS5leHBvcnRzID0gd2VicGFja0NvbnRleHQ7XG53ZWJwYWNrQ29udGV4dC5pZCA9IFwiLi9hc3NldHMvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuW2p0XXN4PyRcIjsiLCJleHBvcnQgZGVmYXVsdCB7XG59OyIsImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdAaG90d2lyZWQvc3RpbXVsdXMnO1xyXG5cclxuLypcclxuICogVGhpcyBpcyBhbiBleGFtcGxlIFN0aW11bHVzIGNvbnRyb2xsZXIhXHJcbiAqXHJcbiAqIEFueSBlbGVtZW50IHdpdGggYSBkYXRhLWNvbnRyb2xsZXI9XCJoZWxsb1wiIGF0dHJpYnV0ZSB3aWxsIGNhdXNlXHJcbiAqIHRoaXMgY29udHJvbGxlciB0byBiZSBleGVjdXRlZC4gVGhlIG5hbWUgXCJoZWxsb1wiIGNvbWVzIGZyb20gdGhlIGZpbGVuYW1lOlxyXG4gKiBoZWxsb19jb250cm9sbGVyLmpzIC0+IFwiaGVsbG9cIlxyXG4gKlxyXG4gKiBEZWxldGUgdGhpcyBmaWxlIG9yIGFkYXB0IGl0IGZvciB5b3VyIHVzZSFcclxuICovXHJcbmV4cG9ydCBkZWZhdWx0IGNsYXNzIGV4dGVuZHMgQ29udHJvbGxlciB7XHJcbiAgICBjb25uZWN0KCkge1xyXG4gICAgICAgIHRoaXMuZWxlbWVudC50ZXh0Q29udGVudCA9ICdIZWxsbyBTdGltdWx1cyEgRWRpdCBtZSBpbiBhc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyc7XHJcbiAgICB9XHJcbn1cclxuIiwiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xyXG5cclxuLy8gc3RhcnQgdGhlIFN0aW11bHVzIGFwcGxpY2F0aW9uXHJcbmltcG9ydCAnLi9ib290c3RyYXAnO1xyXG5cclxuXHJcblxyXG4vKioqKioqKiogU1RBUlQgRk9PVEVSKioqKioqKiovXHJcblxyXG4gICAgbGV0IGhlYWRlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2hlYWRlcicpO1xyXG4gICAgbGV0IGJvZHkgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5Jyk7XHJcbiAgICBsZXQgc2l0ZV90aXRsZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNzaXRlX3RpdGxlJyk7XHJcblxyXG4gICAgLypTVEFSVCBBTklNQVRJT04gTUVOVSovXHJcbiAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywoKT0+e1xyXG4gICAgICAgIGlmKGJvZHkub2Zmc2V0V2lkdGggPCAxMjgwKXtcclxuICAgICAgICAgICAgc2l0ZV90aXRsZS5zdHlsZS50cmFuc2Zvcm0gPSBcInNjYWxlKDEpIHRyYW5zbGF0ZVkoMHB4KVwiO1xyXG4gICAgICAgICAgICBzaXRlX3RpdGxlLnN0eWxlLnRyYW5zaXRpb24gPSBcImFsbCAxcyBlYXNlXCI7XHJcbiAgICAgICAgfWVsc2UgaWYoYm9keS5vZmZzZXRXaWR0aCA+IDEyODAgJiYgc2Nyb2xsWSA8IDgwKXtcclxuICAgICAgICAgICAgc2l0ZV90aXRsZS5zdHlsZS50cmFuc2Zvcm0gPSBcInNjYWxlKDEuMiwxLjIpIHRyYW5zbGF0ZVkoMnJlbSlcIjtcclxuICAgICAgICAgICAgaGVhZGVyLnN0eWxlLmJveFNoYWRvdyA9IFwibm9uZVwiO1xyXG4gICAgICAgICAgICBoZWFkZXIuc3R5bGUudHJhbnNpdGlvbiA9IFwiYWxsIDEuNXMgZWFzZVwiO1xyXG4gICAgICAgICAgICBzaXRlX3RpdGxlLnN0eWxlLnRyYW5zaXRpb24gPSBcImFsbCAxcyBlYXNlXCI7XHJcbiAgICAgICAgfVxyXG4gICAgfSlcclxuXHJcbiAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdzY3JvbGwnLCAoKT0+e1xyXG4gICAgICAgIGlmKHNjcm9sbFk+ODAgJiYgYm9keS5vZmZzZXRXaWR0aD4xMjgwKXtcclxuICAgICAgICAgICAgc2l0ZV90aXRsZS5zdHlsZS50cmFuc2Zvcm0gPSBcInNjYWxlKDEpIHRyYW5zbGF0ZVkoMHB4KVwiO1xyXG4gICAgICAgICAgICBzaXRlX3RpdGxlLnN0eWxlLnRyYW5zaXRpb24gPSBcImFsbCAxcyBlYXNlXCI7XHJcbiAgICAgICAgICAgIGhlYWRlci5zdHlsZS5ib3hTaGFkb3cgPSBcIjJweCAwcHggMnB4IGJsYWNrXCI7XHJcbiAgICAgICAgICAgIGhlYWRlci5zdHlsZS50cmFuc2l0aW9uID0gXCJhbGwgMS41cyBlYXNlXCI7ICAgIFxyXG4gICAgICAgIH1lbHNlIGlmKHNjcm9sbFk8ODAgJiYgYm9keS5vZmZzZXRXaWR0aD4xMjgwKXtcclxuICAgICAgICAgICAgc2l0ZV90aXRsZS5zdHlsZS50cmFuc2Zvcm0gPSBcInNjYWxlKDEuMiwxLjIpIHRyYW5zbGF0ZVkoMnJlbSlcIjtcclxuICAgICAgICAgICAgc2l0ZV90aXRsZS5zdHlsZS50cmFuc2l0aW9uID0gXCJhbGwgMXMgZWFzZVwiO1xyXG4gICAgICAgICAgICBoZWFkZXIuc3R5bGUuYm94U2hhZG93ID0gXCJub25lXCI7XHJcbiAgICAgICAgICAgIGhlYWRlci5zdHlsZS50cmFuc2l0aW9uID0gXCJhbGwgMS41cyBlYXNlXCI7IFxyXG4gICAgICAgIH1lbHNlIGlmKGJvZHkub2Zmc2V0V2lkdGggPCAxMjgwICYmIHNjcm9sbFkgPCA4MCl7XHJcbiAgICAgICAgICAgIGhlYWRlci5zdHlsZS5ib3hTaGFkb3cgPSBcIm5vbmVcIjtcclxuICAgICAgICAgICAgaGVhZGVyLnN0eWxlLnRyYW5zaXRpb24gPSBcImFsbCAxLjVzIGVhc2VcIjtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaGVhZGVyLnN0eWxlLmJveFNoYWRvdyA9IFwiMnB4IDBweCAycHggYmxhY2tcIjtcclxuICAgICAgICAgICAgaGVhZGVyLnN0eWxlLnRyYW5zaXRpb24gPSBcImFsbCAxLjVzIGVhc2VcIjtcclxuICAgICAgICB9XHJcbiAgICB9KSBcclxuICAgIC8qRU5EIEFOSU1BVElPTiBNRU5VKi8gXHJcblxyXG4gICAgLyogU1RBUlQgQlVSR0VSIE1FTlUgKi9cclxuICAgIGNvbnN0IG9wZW5fbW9iaWxlX21lbnVfYnRuID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21vYmlsZS1vcGVuLWJ1dHRvbicpO1xyXG4gICAgY29uc3QgY2xvc2VfbW9iaWxlX21lbnVfYnRuID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21vYmlsZS1jbG9zZS1idXR0b24nKTtcclxuICAgIGNvbnN0IG1vYmlsZV9tZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21vYmlsZS1tZW51Jyk7XHJcbiAgICBsZXQgaXNNb2JpbGVNZW51VmlzaWJsZSA9IGZhbHNlO1xyXG5cclxuICAgIGZ1bmN0aW9uIHRvZ2dsZU1lbnUoKXtcclxuICAgICAgICBtb2JpbGVfbWVudS5jbGFzc0xpc3QudG9nZ2xlKCdoaWRkZW4nKTtcclxuICAgICAgICBtb2JpbGVfbWVudS5jbGFzc0xpc3QudG9nZ2xlKCdmbGV4Jyk7XHJcbiAgICAgICAgY29uc29sZS5sb2coaXNNb2JpbGVNZW51VmlzaWJsZSk7XHJcbiAgICAgICAgaWYoaXNNb2JpbGVNZW51VmlzaWJsZSl7XHJcbiAgICAgICAgICAgIGlzTW9iaWxlTWVudVZpc2libGUgPSBmYWxzZTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaXNNb2JpbGVNZW51VmlzaWJsZSA9IHRydWU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIG9wZW5fbW9iaWxlX21lbnVfYnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJyx0b2dnbGVNZW51KTtcclxuICAgIGNsb3NlX21vYmlsZV9tZW51X2J0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsdG9nZ2xlTWVudSk7XHJcbiAgICAvKiBFTkQgQlVSR0VSIE1FTlUgKi9cclxuXHJcbiAgICAvKlNUQVJUIFBST0ZJTCBNRU5VKi9cclxuICAgIGNvbnN0IHByb2ZpbF9tZW51X2J1dHRvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcm9maWwtbWVudS1idXR0b24nKTtcclxuICAgIGNvbnN0IHByb2ZpbF9tZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3Byb2ZpbC1tZW51Jyk7XHJcbiAgICBsZXQgaXNQcm9maWxNZW51VmlzaWJsZSA9IGZhbHNlO1xyXG5cclxuICAgIGZ1bmN0aW9uIHRvZ2dsZVByb2ZpbE1lbnUoKXtcclxuICAgICAgICBwcm9maWxfbWVudS5jbGFzc0xpc3QudG9nZ2xlKCdoaWRkZW4nKTtcclxuICAgICAgICBwcm9maWxfbWVudS5jbGFzc0xpc3QudG9nZ2xlKCdmbGV4Jyk7XHJcblxyXG4gICAgICAgIGlmKGlzUHJvZmlsTWVudVZpc2libGUpe1xyXG4gICAgICAgICAgICBpc1Byb2ZpbE1lbnVWaXNpYmxlID0gZmFsc2U7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGlzUHJvZmlsTWVudVZpc2libGUgPSB0cnVlO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBwcm9maWxfbWVudV9idXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLHRvZ2dsZVByb2ZpbE1lbnUpO1xyXG5cclxuICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywoZSk9PntcclxuICAgICAgICBpZihlLnRhcmdldC5pZCAhPT0gXCJwcm9maWwtbWVudVwiICYmIGUudGFyZ2V0LmlkICE9PSBcInByb2ZpbC1tZW51LWJ1dHRvblwiICYmIGlzUHJvZmlsTWVudVZpc2libGUpe1xyXG4gICAgICAgICAgICB0b2dnbGVQcm9maWxNZW51KCk7XHJcbiAgICAgICAgfWVsc2UgaWYoZS50YXJnZXQuaWQgIT09IFwibW9iaWxlLW1lbnVcIiAmJiBlLnRhcmdldC5pZCAhPT0gXCJtb2JpbGUtb3Blbi1idXR0b25cIiAmJiBpc01vYmlsZU1lbnVWaXNpYmxlKXtcclxuICAgICAgICAgICAgdG9nZ2xlTWVudSgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pXHJcbiAgICAvKkVORCBQUk9GSUwgTUVOVSovXHJcbi8qKioqKioqKkVORCBGT09URVIqKioqKioqKi8iLCJpbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcclxuXHJcbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XHJcbmV4cG9ydCBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcclxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcclxuICAgIHRydWUsXHJcbiAgICAvXFwuW2p0XXN4PyQvXHJcbikpO1xyXG5cclxuLy8gcmVnaXN0ZXIgYW55IGN1c3RvbSwgM3JkIHBhcnR5IGNvbnRyb2xsZXJzIGhlcmVcclxuLy8gYXBwLnJlZ2lzdGVyKCdzb21lX2NvbnRyb2xsZXJfbmFtZScsIFNvbWVJbXBvcnRlZENvbnRyb2xsZXIpO1xyXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiQ29udHJvbGxlciIsIl9kZWZhdWx0IiwiX0NvbnRyb2xsZXIiLCJfaW5oZXJpdHMiLCJfc3VwZXIiLCJfY3JlYXRlU3VwZXIiLCJfY2xhc3NDYWxsQ2hlY2siLCJhcHBseSIsImFyZ3VtZW50cyIsIl9jcmVhdGVDbGFzcyIsImtleSIsInZhbHVlIiwiY29ubmVjdCIsImVsZW1lbnQiLCJ0ZXh0Q29udGVudCIsImRlZmF1bHQiLCJoZWFkZXIiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJib2R5Iiwic2l0ZV90aXRsZSIsIndpbmRvdyIsImFkZEV2ZW50TGlzdGVuZXIiLCJvZmZzZXRXaWR0aCIsInN0eWxlIiwidHJhbnNmb3JtIiwidHJhbnNpdGlvbiIsInNjcm9sbFkiLCJib3hTaGFkb3ciLCJvcGVuX21vYmlsZV9tZW51X2J0biIsImNsb3NlX21vYmlsZV9tZW51X2J0biIsIm1vYmlsZV9tZW51IiwiaXNNb2JpbGVNZW51VmlzaWJsZSIsInRvZ2dsZU1lbnUiLCJjbGFzc0xpc3QiLCJ0b2dnbGUiLCJjb25zb2xlIiwibG9nIiwicHJvZmlsX21lbnVfYnV0dG9uIiwicHJvZmlsX21lbnUiLCJpc1Byb2ZpbE1lbnVWaXNpYmxlIiwidG9nZ2xlUHJvZmlsTWVudSIsImUiLCJ0YXJnZXQiLCJpZCIsInN0YXJ0U3RpbXVsdXNBcHAiLCJhcHAiLCJyZXF1aXJlIiwiY29udGV4dCJdLCJzb3VyY2VSb290IjoiIn0=