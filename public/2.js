(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-eva-icons */ "./node_modules/vue-eva-icons/dist/vue-eva.common.js");
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_eva_icons__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _plugins_switchAutomationGrid__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../plugins/switchAutomationGrid */ "./resources/js/plugins/switchAutomationGrid.js");
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  components: _defineProperty({}, vue_eva_icons__WEBPACK_IMPORTED_MODULE_1__["EvaIcon"].name, vue_eva_icons__WEBPACK_IMPORTED_MODULE_1__["EvaIcon"]),
  computed: Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])({
    mode: 'automation/mode'
  }),
  mounted: function mounted() {
    Object(_plugins_switchAutomationGrid__WEBPACK_IMPORTED_MODULE_2__["switchAutomationGrid"])(this.mode);
  },
  methods: {
    setGridMode: function setGridMode(mode) {
      this.$store.dispatch('automation/setGridMode', {
        mode: mode
      });
      Object(_plugins_switchAutomationGrid__WEBPACK_IMPORTED_MODULE_2__["switchAutomationGrid"])(mode);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/automation.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-eva-icons */ "./node_modules/vue-eva-icons/dist/vue-eva.common.js");
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_SwitchAutomationGrid__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/SwitchAutomationGrid */ "./resources/js/components/SwitchAutomationGrid.vue");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  components: _defineProperty({
    SwitchAutomationGrid: _components_SwitchAutomationGrid__WEBPACK_IMPORTED_MODULE_1__["default"]
  }, vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__["EvaIcon"].name, vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__["EvaIcon"]),
  middleware: 'auth',
  data: function data() {
    return {
      automation: [],
      current_page: 1,
      first_page_url: null,
      last_page: 1,
      next_page_url: null,
      path: null,
      per_page: null,
      prev_page_url: null,
      total: 0
    };
  },
  metaInfo: function metaInfo() {
    return {
      title: this.$t('automation')
    };
  },
  created: function created() {
    this.fetchAutomation();
  },
  methods: {
    fetchAutomation: function fetchAutomation() {
      var _this = this;

      var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      axios__WEBPACK_IMPORTED_MODULE_2___default.a.get(url !== null && url !== void 0 ? url : 'api/automation').then(function (response) {
        _this.automation = response.data.data;
        _this.current_page = response.data.current_page;
        _this.first_page_url = response.data.first_page_url;
        _this.last_page = response.data.last_page;
        _this.next_page_url = response.data.next_page_url;
        _this.path = response.data.path;
        _this.per_page = response.data.per_page;
        _this.prev_page_url = response.data.prev_page_url;
        _this.total = response.data.total;
      })["catch"](function (e) {
        console.log(e.response);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88& ***!
  \***********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "text-right" }, [
    _c(
      "button",
      {
        staticClass: "btn btn-edit",
        class: { active: this.mode === "list" },
        on: {
          click: function($event) {
            return _vm.setGridMode("list")
          }
        }
      },
      [_c("eva-icon", { attrs: { name: "list-outline" } })],
      1
    ),
    _vm._v(" "),
    _c(
      "button",
      {
        staticClass: "btn btn-edit",
        class: { active: this.mode === "grid" },
        on: {
          click: function($event) {
            return _vm.setGridMode("grid")
          }
        }
      },
      [_c("eva-icon", { attrs: { name: "grid-outline" } })],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation.vue?vue&type=template&id=80969080&":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/automation.vue?vue&type=template&id=80969080& ***!
  \********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "col-12" }, [
    _c(
      "div",
      { staticClass: "d-flex align-items-center pb-3 pb-md-5" },
      [
        _vm._m(0),
        _vm._v(" "),
        _c(
          "router-link",
          {
            staticClass: "btn float-right",
            attrs: {
              tag: "button",
              to: { name: "automation-edit", params: { id: "new" } }
            }
          },
          [_vm._v("\n            Добавить новую\n        ")]
        )
      ],
      1
    ),
    _vm._v(" "),
    _vm.automation.length > 0
      ? _c(
          "div",
          [
            _c("switch-automation-grid"),
            _vm._v(" "),
            _c(
              "ul",
              { staticClass: "list", attrs: { id: "automation" } },
              _vm._l(_vm.automation, function(item) {
                return _c(
                  "li",
                  [
                    _c(
                      "div",
                      { staticClass: "name" },
                      [
                        _c(
                          "router-link",
                          {
                            attrs: {
                              to: {
                                name: "automation-edit",
                                params: { id: item.id }
                              }
                            }
                          },
                          [
                            _vm._v(
                              "\n                        " +
                                _vm._s(item.name) +
                                "\n                    "
                            )
                          ]
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "info" }, [
                      _c("span", [_vm._v(_vm._s(_vm.$t(item.source)))])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "info" }, [
                      _c("span", [
                        _vm._v(
                          _vm._s(
                            item.workflow === 0
                              ? _vm.$t("export")
                              : _vm.$t("POST URL")
                          )
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "info" }, [
                      _c("span", [
                        _vm._v(
                          _vm._s(
                            item.status === 1
                              ? _vm.$t("active")
                              : _vm.$t("disable")
                          )
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "router-link",
                      {
                        staticClass: "btn btn-edit",
                        attrs: {
                          tag: "button",
                          to: {
                            name: "automation-edit",
                            params: { id: item.id }
                          }
                        }
                      },
                      [_c("eva-icon", { attrs: { name: "edit-outline" } })],
                      1
                    )
                  ],
                  1
                )
              }),
              0
            ),
            _vm._v(" "),
            this.total > this.per_page
              ? _c("nav", [
                  _c(
                    "ul",
                    { staticClass: "pagination" },
                    [
                      _c(
                        "li",
                        {
                          staticClass: "page-item",
                          class: { disabled: this.prev_page_url === null }
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "page-link",
                              attrs: { href: "javascript:void(0);" },
                              on: {
                                click: function($event) {
                                  return _vm.fetchAutomation(_vm.prev_page_url)
                                }
                              }
                            },
                            [_vm._v("«")]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _vm._l(Math.ceil(this.total / this.per_page), function(
                        n
                      ) {
                        return _c(
                          "li",
                          {
                            staticClass: "page-item",
                            class: { active: _vm.current_page === n }
                          },
                          [
                            _c(
                              "a",
                              {
                                staticClass: "page-link",
                                attrs: { href: "javascript:void(0);" },
                                on: {
                                  click: function($event) {
                                    return _vm.fetchAutomation(
                                      _vm.path + "?page=" + n
                                    )
                                  }
                                }
                              },
                              [_vm._v(_vm._s(n))]
                            )
                          ]
                        )
                      }),
                      _vm._v(" "),
                      _c(
                        "li",
                        {
                          staticClass: "page-item",
                          class: { disabled: this.next_page_url === null }
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "page-link",
                              attrs: { href: "javascript:void(0);" },
                              on: {
                                click: function($event) {
                                  return _vm.fetchAutomation(_vm.next_page_url)
                                }
                              }
                            },
                            [_vm._v("»")]
                          )
                        ]
                      )
                    ],
                    2
                  )
                ])
              : _vm._e()
          ],
          1
        )
      : _c("div", { staticClass: "card" }, [
          _c(
            "div",
            { staticClass: "card-body text-center" },
            [
              _c("h4", [_vm._v("Empty automation")]),
              _vm._v(" "),
              _c("p", { staticClass: "pb-5" }, [
                _vm._v("Автоматизируйте работу Вашего магазина")
              ]),
              _vm._v(" "),
              _c(
                "router-link",
                {
                  staticClass: "btn btn-add",
                  attrs: {
                    tag: "button",
                    to: { name: "automation-edit", params: { id: "new" } }
                  }
                },
                [_vm._v("\n                Добавить новую\n            ")]
              )
            ],
            1
          )
        ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "mr-auto" }, [
      _c("h4", { staticClass: "d-inline-block m-0" }, [_vm._v("Автоматизация")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/SwitchAutomationGrid.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/SwitchAutomationGrid.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88& */ "./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88&");
/* harmony import */ var _SwitchAutomationGrid_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SwitchAutomationGrid.vue?vue&type=script&lang=js& */ "./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SwitchAutomationGrid_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/SwitchAutomationGrid.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SwitchAutomationGrid_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./SwitchAutomationGrid.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SwitchAutomationGrid.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SwitchAutomationGrid_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SwitchAutomationGrid.vue?vue&type=template&id=1c8a2c88&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SwitchAutomationGrid_vue_vue_type_template_id_1c8a2c88___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/pages/automation.vue":
/*!*******************************************!*\
  !*** ./resources/js/pages/automation.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./automation.vue?vue&type=template&id=80969080& */ "./resources/js/pages/automation.vue?vue&type=template&id=80969080&");
/* harmony import */ var _automation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./automation.vue?vue&type=script&lang=js& */ "./resources/js/pages/automation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _automation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__["render"],
  _automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/automation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/automation.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/pages/automation.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./automation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/automation.vue?vue&type=template&id=80969080&":
/*!**************************************************************************!*\
  !*** ./resources/js/pages/automation.vue?vue&type=template&id=80969080& ***!
  \**************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./automation.vue?vue&type=template&id=80969080& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation.vue?vue&type=template&id=80969080&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_vue_vue_type_template_id_80969080___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);