import { calcAspectRatioStyleClassList } from "../utils/resizer";
export default {

    props: {
        isDesktopAspectRatioCorrection: {
            type: [Boolean, String],
            required: false,
            default: false,
        }
    },

    data: function () {
        return {
            styleClassList: '',
        };
    },

    created() {
        "use strict";
        window.addEventListener("resize", this.resizeStateCallback, true);
        document.addEventListener("fullscreenchange", this.resizeStateCallback, true);
    },

    mounted() {
        "use strict";
        if (!this.isMobileRelatedLayout() && this.isDesktopAspectRatioCorrection) {
            var resultStyleClassList = calcAspectRatioStyleClassList('.ar-balanced-page');
            if (resultStyleClassList !== 'nd') {
                this.styleClassList = resultStyleClassList.trim();
            }
        }
    },

    destroyed() {
        "use strict";
        window.removeEventListener("resize", this.resizeStateCallback);
        document.removeEventListener("fullscreenchange", this.resizeStateCallback);
    },

    methods: {
        resizeStateCallback: _.debounce(
            function (event) {
                "use strict";
                if (this.isMobileRelatedLayout() || !this.isDesktopAspectRatioCorrection) {
                    this.flushStyleAttribute('.ar-balanced-page');
                    return;
                }

                var resultStyleClassList = calcAspectRatioStyleClassList('.ar-balanced-page');
                if (resultStyleClassList !== 'nd') {
                    console.log(
                        "Debug aspectRatioCorrection [resizeStateCallback] Desktop layout: apply style"
                    );
                    this.styleClassList = resultStyleClassList.trim();
                } else {
                    console.log(
                        "Debug aspectRatioCorrection [resizeStateCallback] Desktop layout: flush style"
                    );
                    this.styleClassList = '';
                }

            },
            500,
            {
                leading: false,
                trailing: true,
            }
        ),
    }
}