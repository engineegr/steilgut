export default {

    data: function () {
        return {
            optionList: [{ isSelected: true }, { isSelected: false }],

            notification: {
                LFP: "",
                email: "",
                phone: "",
                date: "2021-06-21",
                time: "10:00 - 12:00",
                place: "",
            },

            agreement: false,
            isLoading: false,
            isError: false,
            status: null,

            isSentMsg: false,
            isSendError: false,
        };
    },

    methods: {
        handleOptionClick: function (event, index) {
            ("use strict");
            this.optionList.forEach((item) => {
                item.isSelected = false;
            });

            this.optionList[index].isSelected = true;
        },

        handleTimeSelection: function (event, attributeName, attributeValue) {
            ("use strict");
            this.notification["time"] = attributeValue;
        },

        sendNotification: async function (event) {
            ("use strict");
            debugger;

            this.srvSideErrors = null;
            this.clientSideErrorMap = new Map();
            if (!this.$_validateNotification()) {
                return;
            }

            if (this.optionList[0].isSelected) {
                this.notification["place"] = "TERRACE";
            } else if (this.optionList[1].isSelected) {
                this.notification["place"] = "VINEYARD";
            }
            try {
                this.isLoading = true;
                this.isError = false;
                // make post request
                await axios.post("/api/degustation/signUp", this.notification, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                });
            } catch (reject) {
                if (is404(reject) || is422(reject) || is500(reject)) {
                    console.error(
                        "Error [SummaryComp::$_doHandleSubmitBankTransferPayment] Status (500/422/404): " +
                        reject.response.data.errors
                    );
                    this.srvSideErrors = reject.response.data.errors;
                    this.isSendError = true;
                } else {
                    this.isError = true;
                    console.error(
                        "Error [SummaryComp::$_doHandleSubmitBankTransferPayment] Unexpected error status: " +
                        reject
                    );
                }
                console.warn(
                    "Warn [degustationSignUp::sendNotification] Error occurred " + reject
                );
                this.status = reject.response.status;
                this.srvSideErrors = reject.response.data.errors;
            } finally {
                this.isLoading = false;
                if (!this.hasErrors) {
                    this.isSentMsg = true;
                    setTimeout(() => {
                        this.isSentMsg = false;
                    }, 3000);
                }

                if (this.isSendError) {
                    setTimeout(() => {
                        this.isSendError = false;
                    }, 3000);
                }
            }
        },

        $_validateNotification: function () {
            ("use strict");

            console.log(
                "Debug [degustationSignUp:$_validateNotification] enter the function"
            );
            const lfpValidateStr = this.validateRequiredField({
                fieldTitle: 'LFP',
                fieldValue: this.notification["LFP"]
            });
            if (lfpValidateStr !== "") {
                this.clientSideErrorMap.set("LFP", lfpValidateStr);
            }

            const emailValidateStr = this.validateEmail(this.notification["email"]);
            if (emailValidateStr !== "") {
                this.clientSideErrorMap.set("email", emailValidateStr);
            }

            const phoneValidateStr = this.validatePhoneNumber(this.notification["phone"]);
            if (phoneValidateStr !== "") {
                this.clientSideErrorMap.set("phone", phoneValidateStr);
            }

            const agreementValidateStr = this.validateConsentCheckbox(this.agreement);
            if (agreementValidateStr !== "") {
                this.clientSideErrorMap.set("agreement", agreementValidateStr);
            }

            const isValid =
                lfpValidateStr === "" &&
                emailValidateStr === "" &&
                phoneValidateStr === "" &&
                agreementValidateStr === "";
            return isValid;
        },
    }
};