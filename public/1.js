(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

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

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation-edit.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/automation-edit.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-eva-icons */ "./node_modules/vue-eva-icons/dist/vue-eva.common.js");
/* harmony import */ var vue_eva_icons__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_eva_icons__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_SwitchAutomationGrid__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/SwitchAutomationGrid */ "./resources/js/components/SwitchAutomationGrid.vue");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

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
      apiUrl: window.config.apiUrl,
      showDeleteBtn: false,
      statuses: ["1", "0"],
      sources: {},
      workflows: {
        'export': 0,
        'post': 1
      },
      sourceVars: {},
      addressBooks: {},
      hasError: false,
      webhook_id: null,
      //todo можжно загнать в hidden
      workflow: null,
      meta: {
        'book_id': null,
        'post_url': null
      },
      mapping: [],
      source: null,
      is_tracking: false,
      rule: null,
      status: 1,
      name: null,
      created_at: null,
      updated_at: null
    };
  },
  metaInfo: function metaInfo() {
    return {
      title: this.$t('automation')
    };
  },
  created: function created() {
    this.getSources();

    if (this.$route.params.id && this.$route.params.id !== 'new') {
      this.getAutomation();
      this.showDeleteBtn = true;
    } else {
      var date = new Date();
      this.name = this.$t('My automation') + ' ' + date.getTime();
    }

    this.getAddressBooks();
  },
  methods: {
    prepareMappingData: function prepareMappingData(data) {
      var result = [];

      for (var key in data) {
        if (_typeof(data[key]) === 'object') {
          var collectedIncludesItems = [];

          for (var itemKey in data[key]) {
            collectedIncludesItems.push({
              'id': i++,
              'key': itemKey,
              'value': data[key][itemKey]
            });
          }

          result.push({
            'key': key,
            'value': collectedIncludesItems
          });
        } else {
          result.push({
            'key': key,
            'value': data[key]
          });
        }
      }

      return result;
    },
    getSources: function getSources() {
      var _this = this;

      axios__WEBPACK_IMPORTED_MODULE_2___default.a.get(this.apiUrl + '/source').then(function (response) {
        _this.sources = response.data;
      })["catch"](function (e) {
        console.log(e.response);
      });
    },
    getSourceVars: function getSourceVars() {
      var _this2 = this;

      axios__WEBPACK_IMPORTED_MODULE_2___default.a.get(this.apiUrl + '/source/' + this.source).then(function (response) {
        _this2.sourceVars = response.data;
      })["catch"](function (e) {
        console.log(e.response);
      });
    },
    getAutomation: function getAutomation() {
      var _this3 = this;

      axios__WEBPACK_IMPORTED_MODULE_2___default.a.get(this.apiUrl + '/automation/' + this.$route.params.id).then(function (response) {
        _this3.webhook_id = response.data.webhooks_id;
        _this3.workflow = response.data.workflow;
        _this3.meta = response.data.meta;
        _this3.mapping = _this3.prepareMappingData(response.data.mapping);
        _this3.source = response.data.source;
        _this3.is_tracking = response.data.is_tracking;
        _this3.rule = response.data.rule;
        _this3.status = response.data.status;
        _this3.name = response.data.name;
        _this3.created_at = response.data.created_at;
        _this3.updated_at = response.data.updated_at;

        _this3.getSourceVars();
      })["catch"](function (e) {
        console.log(e.response);
      });
    },
    getAddressBooks: function getAddressBooks() {
      var _this4 = this;

      axios__WEBPACK_IMPORTED_MODULE_2___default.a.get(this.apiUrl + '/addressbooks').then(function (response) {
        console.log(response.data);
        _this4.addressBooks = response.data;
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2& ***!
  \*************************************************************************************************************************************************************************************************************/
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
    _c("div", [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-body" }, [
          _c("div", { staticClass: "d-flex align-items-center pb-2" }, [
            _c("div", { staticClass: "mr-auto" }, [
              _c(
                "span",
                { staticClass: "badge-spill" },
                [_c("eva-icon", { attrs: { name: "bulb-outline" } })],
                1
              )
            ]),
            _vm._v(" "),
            _vm.showDeleteBtn
              ? _c("button", { staticClass: "btn btn-delete float-right" }, [
                  _vm._v("Удалить")
                ])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-row" }, [
            _c("div", { staticClass: "form-group col-md-9" }, [
              _c("label", [_vm._v("Имя")]),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model.trim",
                    value: _vm.name,
                    expression: "name",
                    modifiers: { trim: true }
                  }
                ],
                staticClass: "form-control",
                attrs: { type: "text" },
                domProps: { value: _vm.name },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.name = $event.target.value.trim()
                  },
                  blur: function($event) {
                    return _vm.$forceUpdate()
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group col-md-3" }, [
              _c("label", [_vm._v("Статус")]),
              _vm._v(" "),
              _c(
                "select",
                {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.status,
                      expression: "status"
                    }
                  ],
                  staticClass: "form-control",
                  on: {
                    change: function($event) {
                      var $$selectedVal = Array.prototype.filter
                        .call($event.target.options, function(o) {
                          return o.selected
                        })
                        .map(function(o) {
                          var val = "_value" in o ? o._value : o.value
                          return val
                        })
                      _vm.status = $event.target.multiple
                        ? $$selectedVal
                        : $$selectedVal[0]
                    }
                  }
                },
                _vm._l(_vm.statuses, function(value_status) {
                  return _c("option", { domProps: { value: value_status } }, [
                    _vm._v(
                      "\n                                " +
                        _vm._s(
                          value_status === "0"
                            ? _vm.$t("disable")
                            : _vm.$t("active")
                        ) +
                        "\n                            "
                    )
                  ])
                }),
                0
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Событие в амгазине")]),
            _vm._v(" "),
            _c(
              "select",
              {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.source,
                    expression: "source"
                  }
                ],
                staticClass: "form-control",
                on: {
                  change: [
                    function($event) {
                      var $$selectedVal = Array.prototype.filter
                        .call($event.target.options, function(o) {
                          return o.selected
                        })
                        .map(function(o) {
                          var val = "_value" in o ? o._value : o.value
                          return val
                        })
                      _vm.source = $event.target.multiple
                        ? $$selectedVal
                        : $$selectedVal[0]
                    },
                    function($event) {
                      return _vm.getSourceVars()
                    }
                  ]
                }
              },
              [
                _c(
                  "option",
                  { attrs: { value: "", disabled: "", selected: "" } },
                  [_vm._v(_vm._s(_vm.$t("select source")))]
                ),
                _vm._v(" "),
                _vm._l(_vm.sources, function(item_source) {
                  return _c("option", [
                    _vm._v(
                      "\n                            " +
                        _vm._s(_vm.$t(item_source)) +
                        "\n                        "
                    )
                  ])
                })
              ],
              2
            ),
            _vm._v(" "),
            _c("small", { staticClass: "form-text text-muted" }, [
              _vm._v(
                "\n                        Событие в магазине которое отслеживать\n                    "
              )
            ])
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _vm.source
      ? _c("div", [
          _c(
            "div",
            { staticClass: "delimiter" },
            [_c("eva-icon", { attrs: { name: "more-vertical-outline" } })],
            1
          ),
          _vm._v(" "),
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-body" }, [
              _c("div", { staticClass: "d-flex align-items-center pb-2" }, [
                _c(
                  "span",
                  { staticClass: "badge-spill" },
                  [_c("eva-icon", { attrs: { name: "flash-outline" } })],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Действие")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.workflow,
                        expression: "workflow"
                      }
                    ],
                    staticClass: "form-control",
                    on: {
                      change: function($event) {
                        var $$selectedVal = Array.prototype.filter
                          .call($event.target.options, function(o) {
                            return o.selected
                          })
                          .map(function(o) {
                            var val = "_value" in o ? o._value : o.value
                            return val
                          })
                        _vm.workflow = $event.target.multiple
                          ? $$selectedVal
                          : $$selectedVal[0]
                      }
                    }
                  },
                  [
                    _c(
                      "option",
                      { attrs: { value: "", disabled: "", selected: "" } },
                      [_vm._v("---")]
                    ),
                    _vm._v(" "),
                    _vm._l(_vm.workflows, function(
                      workflow_value,
                      workflow_key
                    ) {
                      return _c(
                        "option",
                        { domProps: { value: workflow_value } },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(_vm.$t(workflow_key)) +
                              "\n                        "
                          )
                        ]
                      )
                    })
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _vm.workflow === 0
                ? _c("div", { staticClass: "form-group" }, [
                    _c("label", [_vm._v("Книга")]),
                    _vm._v(" "),
                    _c(
                      "select",
                      {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.meta.book_id,
                            expression: "meta.book_id"
                          }
                        ],
                        staticClass: "form-control",
                        on: {
                          change: function($event) {
                            var $$selectedVal = Array.prototype.filter
                              .call($event.target.options, function(o) {
                                return o.selected
                              })
                              .map(function(o) {
                                var val = "_value" in o ? o._value : o.value
                                return val
                              })
                            _vm.$set(
                              _vm.meta,
                              "book_id",
                              $event.target.multiple
                                ? $$selectedVal
                                : $$selectedVal[0]
                            )
                          }
                        }
                      },
                      [
                        _c("option", { attrs: { selected: "" } }, [
                          _vm._v("Choose...")
                        ]),
                        _vm._v(" "),
                        _vm._l(_vm.addressBooks, function(addressBook) {
                          return _c(
                            "option",
                            { domProps: { value: addressBook.id } },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(addressBook.name) +
                                  " (" +
                                  _vm._s(addressBook.inactive_email_qty) +
                                  ")\n                        "
                              )
                            ]
                          )
                        })
                      ],
                      2
                    ),
                    _vm._v(" "),
                    _c("small", { staticClass: "form-text text-muted" }, [
                      _vm._v(
                        "\n                        Книга в которую будут экспортироваться данные\n                    "
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.workflow === 1
                ? _c("div", { staticClass: "form-group" }, [
                    _c("label", [_vm._v("POST URL")]),
                    _vm._v(" "),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model.trim",
                          value: _vm.meta.post_url,
                          expression: "meta.post_url",
                          modifiers: { trim: true }
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { type: "text" },
                      domProps: { value: _vm.meta.post_url },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.meta,
                            "post_url",
                            $event.target.value.trim()
                          )
                        },
                        blur: function($event) {
                          return _vm.$forceUpdate()
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("small", { staticClass: "form-text text-muted" }, [
                      _vm._v(
                        "\n                        POST URL события в A360 SendPulse\n                    "
                      )
                    ])
                  ])
                : _vm._e()
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    (_vm.workflow === 0 && _vm.meta.book_id) || _vm.workflow === 1
      ? _c("div", [
          _c(
            "div",
            { staticClass: "delimiter" },
            [_c("eva-icon", { attrs: { name: "more-vertical-outline" } })],
            1
          ),
          _vm._v(" "),
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-body" }, [
              _c("div", { staticClass: "d-flex align-items-center" }, [
                _c(
                  "span",
                  { staticClass: "badge-spill" },
                  [_c("eva-icon", { attrs: { name: "cube-outline" } })],
                  1
                )
              ]),
              _vm._v(" "),
              _c("br"),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "col-12" },
                [
                  _vm._l(_vm.mapping, function(mappingItem, index) {
                    return _c("div", { staticClass: "form-row p-0 pt-1" }, [
                      _c("div", { staticClass: "form-group col-7" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model.trim",
                              value: mappingItem.key,
                              expression: "mappingItem.key",
                              modifiers: { trim: true }
                            }
                          ],
                          staticClass: "form-control",
                          attrs: { type: "text", required: "required" },
                          domProps: { value: mappingItem.key },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                mappingItem,
                                "key",
                                $event.target.value.trim()
                              )
                            },
                            blur: function($event) {
                              return _vm.$forceUpdate()
                            }
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group col-4" }, [
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: mappingItem.value,
                                expression: "mappingItem.value"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: function($event) {
                                var $$selectedVal = Array.prototype.filter
                                  .call($event.target.options, function(o) {
                                    return o.selected
                                  })
                                  .map(function(o) {
                                    var val = "_value" in o ? o._value : o.value
                                    return val
                                  })
                                _vm.$set(
                                  mappingItem,
                                  "value",
                                  $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                )
                              }
                            }
                          },
                          [
                            _c("option", { attrs: { selected: "" } }, [
                              _vm._v(_vm._s(index))
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.sourceVars, function(
                              sourceVarValue,
                              sourceVarKey
                            ) {
                              return _c("option", [
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(sourceVarKey) +
                                    " (" +
                                    _vm._s(sourceVarValue) +
                                    ")\n                                "
                                )
                              ])
                            })
                          ],
                          2
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group col-1" }, [
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-delete-var",
                            on: {
                              click: function($event) {
                                return _vm.mapping.splice(index, 1)
                              }
                            }
                          },
                          [
                            _c("eva-icon", { attrs: { name: "close-outline" } })
                          ],
                          1
                        )
                      ])
                    ])
                  }),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-row p-0 pt-1" }, [
                    _vm._m(0),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group col-4" }),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group col-1" }, [
                      _c(
                        "button",
                        { staticClass: "btn btn-delete-var" },
                        [_c("eva-icon", { attrs: { name: "close-outline" } })],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-12 p-4 structure-block" }, [
                      _c("div", { staticClass: "form-row p-0 pt-1" }, [
                        _vm._m(1),
                        _vm._v(" "),
                        _vm._m(2),
                        _vm._v(" "),
                        _c("div", { staticClass: "form-group col-1" }, [
                          _c(
                            "button",
                            { staticClass: "btn btn-delete-var" },
                            [
                              _c("eva-icon", {
                                attrs: { name: "close-outline" }
                              })
                            ],
                            1
                          )
                        ])
                      ])
                    ])
                  ])
                ],
                2
              )
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "col-12" }, [
      _c(
        "div",
        { staticClass: "delimiter" },
        [_c("eva-icon", { attrs: { name: "more-vertical-outline" } })],
        1
      ),
      _vm._v(" "),
      _vm._m(3)
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group col-7" }, [
      _c("input", {
        staticClass: "form-control",
        attrs: {
          type: "text",
          required: "required",
          placeholder: "localization.user_var"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group col-7" }, [
      _c("input", {
        staticClass: "form-control",
        attrs: {
          type: "text",
          required: "required",
          placeholder: "localization.user_var"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group col-4" }, [
      _c("select", { staticClass: "form-control" }, [
        _c("option", { attrs: { selected: "" } }, [_vm._v("Choossses.ы.ффs.")]),
        _vm._v(" "),
        _c("option", [_vm._v("...")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "text-center mb-5" }, [
      _c("button", { staticClass: "btn btn-lg btn-save" }, [
        _vm._v("Сохранить")
      ])
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

/***/ "./resources/js/pages/automation-edit.vue":
/*!************************************************!*\
  !*** ./resources/js/pages/automation-edit.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./automation-edit.vue?vue&type=template&id=e1dafab2& */ "./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2&");
/* harmony import */ var _automation_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./automation-edit.vue?vue&type=script&lang=js& */ "./resources/js/pages/automation-edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _automation_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/automation-edit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/automation-edit.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/pages/automation-edit.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./automation-edit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation-edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2&":
/*!*******************************************************************************!*\
  !*** ./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./automation-edit.vue?vue&type=template&id=e1dafab2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/automation-edit.vue?vue&type=template&id=e1dafab2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_automation_edit_vue_vue_type_template_id_e1dafab2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);