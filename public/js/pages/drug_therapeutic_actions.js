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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/panel/js/panel/drug_therapeutic_action.js":
/*!*************************************************************!*\
  !*** ./resources/panel/js/panel/drug_therapeutic_action.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  axios.post(therapeuticActionGetURL).then(function (response) {
    console.log(response);
    $('#drug_therapeutic_action_select').select2({
      data: response.data.map(function (therapeuticAction) {
        var obj = {
          "id": therapeuticAction.id,
          "value": therapeuticAction.id,
          "text": therapeuticAction.name
        };
        return obj;
      })
    });
  });
  $('#add_therapeutic_action').click(function (e) {
    e.preventDefault();
    $('#new_therapeutic_action_wrapper').removeClass('hidden');
    $('#hide_add_button').removeClass('hidden');
    $('#add_therapeutic_action').addClass('hidden');
    $('#new_therapeutic_action_field').focus();
  });
  $('#hide_add_button').click(function (e) {
    e.preventDefault();
    $('#new_therapeutic_action_wrapper').addClass('hidden');
    $('#hide_add_button').addClass('hidden');
    $('#add_therapeutic_action').removeClass('hidden');
  });
  $('#save_therapeutic_action').click(function (e) {
    e.preventDefault();
    var params = {
      name: $('#new_therapeutic_action_field').val(),
      description: $('#new_therapeutic_action_field').val(),
      method: 'PUT'
    };
    axios.post(therapeuticActionStoreURL, params).then(function (response) {
      if (response.data.status === 200) {
        var item = response.data.therapeutic_action;
        var newOption = new Option(item.name, item.id, true, true);
        $('#drug_therapeutic_action_select').append(newOption).trigger('change');
        toastr.success('Se ha guardado la accion terapeutica');
        $('#hide_add_button').trigger('click');
      } else {
        toastr.error('No se puede crear dicha accion terapeutica');
      }
    });
    $('#new_therapeutic_action_field').val('');
  });
});

/***/ }),

/***/ 2:
/*!*******************************************************************!*\
  !*** multi ./resources/panel/js/panel/drug_therapeutic_action.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\farmaciaunion\resources\panel\js\panel\drug_therapeutic_action.js */"./resources/panel/js/panel/drug_therapeutic_action.js");


/***/ })

/******/ });