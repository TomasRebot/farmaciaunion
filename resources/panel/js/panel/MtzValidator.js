if (typeof (MtzValidations) === 'undefined') MtzValidations = {};
MtzValidations = (function ($) {
    const defaultHandler = function(form) {
        var errors=false;
        $('#'+form.name+' [required].error').removeClass('error');
        $('#'+form.name+' [required]').each(function() {
            if ($(this).val()==="") {
                $(this).addClass('error');
                errors=true;
            }
        });
        if (errors) {
            return 0;
        } else {
            $(`#${form.name}`).submit();
        }
    };
    const defaultInvalidHandler = function(event) {
        var submitButton=$(event.currentTarget).find('button[data-role=invisible-captcha]').attr('id');
        grecaptcha.reset(recaptchaId[submitButton]);
    };

    const checkDomObject = function(obj){
        try {
            return obj instanceof HTMLElement;
        }
        catch(e){
            return (typeof obj==="object") &&
                (obj.nodeType===1) && (typeof obj.style === "object") &&
                (typeof obj.ownerDocument ==="object");
        }
    }

    const loadMessages = function(keys){
        switch (keys[0]) {
            case'minlength': return `El campo debe tener al menos ${keys[1]} digitos`;
            case'maxlength':return  `El campo debe tener al menos ${keys[1]} digitos`;
            case'required':return  `El campo es requerido`;
            case'email':return  `El campo debe ser un email valido`;
            case'url':return  `Ingrese una url valida, ejemplo: https://www.farmaciaunion.com.ar`;
        }
    }
    const loadForm = function (form) {
        if(checkDomObject(document.getElementById(form.name))){
            const inputs = Object.values(document.getElementById(form.name).elements);
            inputs.filter( (input) => {
                const rule = input.dataset.rule;
                const restrictions = input.dataset.restrictions;
                if(rule !== undefined && restrictions !== undefined){
                    const keys = restrictions.split('|');
                    const isObject = keys.length;
                    if(isObject > 1){
                        const object = {};
                        const messages = {};
                        keys.forEach((key) => {
                            const value = key.split(':');
                            if(value[1] === 'false') value[1] = false;
                            if(value[1] === 'true') value[1] = true;
                            object[value[0]] = value[1];
                            messages[value[0]] = loadMessages(value)
                        })
                        form.rules[rule] = object;
                        form.messages[rule] = messages;

                    }else{
                        form.rules[rule] = restrictions;
                        form.messages[rule] = loadMessages([restrictions])
                    }
                }
            });
        }
    }

    const submitHandlers = {
        default: defaultHandler,
    }
    const invalidHandlers = {
        default: defaultInvalidHandler,
    }


    //variable form indica el formulario del dom, y formObj es el formulario en construccion
    const setObjHandlers = function(form, formObj){
        const domHandler = form.dataset.handler
        const domInvalidHandler = form.dataset.invalidhandler
        formObj.submitHandler = (domHandler !== undefined ) ? submitHandlers[domHandler] : submitHandlers['default'];
        formObj.invalidHandler = (domInvalidHandler !== undefined && domInvalidHandler !== 'false') ? submitHandlers[domHandler] : false;
        return formObj;
    }

    const forms = [];

    const createForms = function(){
        const aviableForms = Object.values(document.getElementsByClassName('validable'));
        aviableForms.forEach((form) => {
            if(checkDomObject(form)){
                let formObj = { name: '', rules: {}, messages: {}, submitHandler: '', invalidHandler:'' };
                formObj.name =form.getAttribute('id')
                formObj = setObjHandlers(form, formObj);
                forms.push(formObj)
            }
        });
    }
    const init = function () {
        createForms();
        forms.forEach((form) => {
            $.when(loadForm(form)).done(() => {
                const formObject = {
                    rules: form.rules,
                    messages:form.messages,
                    submitHandler: form.submitHandler,
                };
                if(form.invalidHandler) formObject.invalidHandler = form.invalidHandler(form);

              $(`#${form.name}`).validate(formObject)
            })
        });
    };

    const getFormData = function (){
        return forms;
    }

    return {
        init: init,
        getForms: getFormData,
    };
})(jQuery);
jQuery(document).ready(MtzValidations.init);
