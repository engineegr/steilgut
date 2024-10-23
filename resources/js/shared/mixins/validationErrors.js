export default {
    data: function () {
        return {
            srvSideErrors: [],

            clientSideErrorMap: new Map,
            UNKNOWN_ERROR_CODE_STR: 'Unknow error code',
        };
    },

    methods: {
        errorsFor: function (field) {
            let errMsgResultList = [];
            if (this.clientSideErrorMap.size > 0 && this.clientSideErrorMap.get(field)) {
                errMsgResultList.push(this.clientSideErrorMap.get(field));
            }

            if (this.srvSideErrors && this.srvSideErrors[field]) {
                errMsgResultList = errMsgResultList.concat(this.srvSideErrors[field]);
            }
            return errMsgResultList;
        },

        validateEmail: function (emailStr) {
            const emailRegExp = /^\S+@\S+$/;
            return this.validateField({
                fieldTitle: 'email',
                fieldValue: emailStr,
                regExpObj: emailRegExp,
            });
        },

        validateZipCode: function (zipCodeStr) {
            const zipCodeRegExp = /^([0-9]{4,6}([-][0-9]{4})?)$/i;
            return this.validateField({
                fieldTitle: 'zip',
                fieldValue: zipCodeStr,
                regExpObj: zipCodeRegExp,
            });
        },

        /*
        * Supported formats
        *
        * +7(4242)66-44444
        * +7(4242)6644444
        * +7(4242)66-44444-22
        * +742426644444
        * etc
        */
        validatePhoneNumber: function (phoneStr) {
            const phoneRegExp = /^([+]?[0-9]{1,2}[ ]?(([(][0-9]{3,4}[)]){1}|([0-9]{3,4}){1})[ -\s\.]?[0-9]{2,3}[-\s\.]?[0-9]{4,6}([-][0-9]{2})?)$/i;
            return this.validateField({
                fieldTitle: 'phone',
                fieldValue: phoneStr,
                regExpObj: phoneRegExp,
            });
        },

        /* 
        * Contact page specific validation messages
        */
        validateConsentCheckbox: function (checkboxVal) {
            if (!checkboxVal && checkboxVal !== true && checkboxVal !== "true") {
                return this.getValidationErrorMsgString({ errorCode: 'non_confirmed_consent' });
            }
            return '';
        },

        validateRequiredField: function ({ fieldTitle = 'LFP', fieldValue = '' } = {}) {
            if (!fieldValue || fieldValue.length === 0) {
                return this.getValidationErrorMsgString({ errorCode: 'required', fieldTitle });
            }
            return '';
        },

        validateField: function ({ fieldTitle = 'LFP', fieldValue = 'LFP', regExpObj = /^.*$/, isRequired = true } = {}) {
            let validateErrMsg = isRequired ? this.validateRequiredField({
                fieldTitle,
                fieldValue
            }) : '';

            if (validateErrMsg) {
                return validateErrMsg;
            }

            if (!regExpObj.test(fieldValue)) {
                return this.getValidationErrorMsgString({
                    errorCode: 'not_regex', fieldTitle
                });
            }
            return '';
        },

        getValidationErrorMsgString: function ({ errorCode, fieldTitle = '' } = {}) {
            const validationExpr = this.__(`validation.${errorCode}`);
            if (!validationExpr) {
                console.warn("Warning [validationErrors::getValidationErrorMsgString] Unknown error code");
                return this.UNKNOWN_ERROR_CODE_STR;
            }

            const fieldName = this.__(`validation.attributes.${fieldTitle}`);
            return validationExpr.replace(":attribute", fieldName);
        },

        logSrvSideErrors: function () {
            if (this.srvSideErrors && this.srvSideErrors.length > 0) {
                console.log("validationErrors [logErrors] Log server side errors ");
                for (let err of this.srvSideErrors) {
                    console.log("validationErrors [logErrors] Error: " + err.toString());
                }
            } else {
                console.info("validationErrors [logErrors] Nothing to log");
            }

        }
    }

}