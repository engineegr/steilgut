export const is404 = function (err) {
    return isErrorWithResponseAndStatus(err) && 404 === err.response.status;
};

/*
 * 422 Unprocessable Entity
*/
export const is422 = function (err) {
    return isErrorWithResponseAndStatus(err) && 422 === err.response.status;
};

export const is500 = function (err) {
    return isErrorWithResponseAndStatus(err) && 500 === err.response.status;
}

export const processErrorResponse = function (reject) {
    ("use strict");
    console.log("Debug [response::processError]");
    if (is404(reject) || is422(reject) || is500(reject)) {
        console.error(
            'Error [response::processError] Status (500/422/404): ' +
            reject.response.data.errors
        )
    } else {
        console.error(
            'Error [response::processError] Unexpected error status: ' +
            reject.message
        );
    }
}

const isErrorWithResponseAndStatus = function (err) {
    return err.response && err.response.status && err.response.data.errors;
};