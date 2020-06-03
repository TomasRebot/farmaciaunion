/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/panel/js/panel/product_form.js":
/*!**************************************************!*\
  !*** ./resources/panel/js/panel/product_form.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var brandsSelect = $('#brands_select');
  var categorySelect = $('#category_select');
  var providerSelect = $('#provider_select');
  var laboratorySelect = $('#laboratory_select');
  var description = $('#input-description');
  var drugSelect = $('#drug_select');
  var therapeuticActionSelect = $('#therapeutic_action_select');
  var isEditting = $('#id').val() !== undefined;
  var ajaxLoader = $('#product_ajax_select_loading');
  var productSelects = $('#product_ajax_select_container');
  description.summernote(summernoteBaseMediumConfig);
  var params = isEditting ? {
    product: $('#id').val()
  } : {};
  drugSelect.select2();
  providerSelect.select2();
  therapeuticActionSelect.select2();
  brandsSelect.select2();
  laboratorySelect.select2();
  categorySelect.select2();
  axios.post(productSuportDataUrl, params).then(function (response) {
    var data = response.data;
    productSelects.removeClass('opacity-0');
    ajaxLoader.addClass('hidden');
    drugSelect.trigger({
      type: 'select2:select',
      params: {
        data: data.drugs.map(function (drug) {
          var obj = {
            "id": drug.id,
            "value": drug.id,
            "text": drug.name
          };
          return obj;
        })
      }
    });
    drugSelect.select2({
      data: data.drugs.map(function (drug) {
        var obj = {
          "id": drug.id,
          "value": drug.id,
          "text": drug.name
        };
        return obj;
      })
    });
    providerSelect.select2({
      data: data.providers.map(function (item) {
        var obj = {
          "id": item.id,
          "value": item.id,
          "text": item.name
        };
        return obj;
      })
    });
    therapeuticActionSelect.select2({
      data: data.therapeutic_actions.map(function (item) {
        var obj = {
          "id": item.id,
          "value": item.id,
          "text": item.name
        };
        return obj;
      })
    });
    brandsSelect.select2({
      data: data.brands.map(function (item) {
        var obj = {
          "id": item.id,
          "value": item.id,
          "text": item.name
        };
        return obj;
      })
    });
    laboratorySelect.select2({
      data: data.laboratories.map(function (item) {
        var obj = {
          "id": item.id,
          "value": item.id,
          "text": item.name
        };
        return obj;
      })
    });
    categorySelect.select2({
      data: data.categories.map(function (item) {
        var obj = {
          "id": item.id,
          "value": item.id,
          "text": item.name
        };
        return obj;
      })
    });

    if (data.product !== []) {
      brandsSelect.val(data.product.brand);
      brandsSelect.trigger('change');
      categorySelect.val(data.product.category);
      categorySelect.trigger('change');
      providerSelect.val(data.product.provider);
      providerSelect.trigger('change');
      laboratorySelect.val(data.product.laboratory);
      laboratorySelect.trigger('change');
      drugSelect.val(data.product.drug);
      drugSelect.trigger('change');
      therapeuticActionSelect.val(data.product.therapeutic_action);
      therapeuticActionSelect.trigger('change');
    }
  });
});

/***/ }),

/***/ 1:
/*!********************************************************!*\
  !*** multi ./resources/panel/js/panel/product_form.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\farmaciaunion\resources\panel\js\panel\product_form.js */"./resources/panel/js/panel/product_form.js");


/***/ })

/******/ });