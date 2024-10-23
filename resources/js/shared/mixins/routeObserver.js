export default {

    methods: {
        ifLightBackgroundPage: function () {
            // debugger;
            const fullPath = this.$route.fullPath;
            const lightBackgroundPathRegexp = /^(.*masthead\/(store|wines-cart|(order\/(delivery|payment))))$/;
            return lightBackgroundPathRegexp.test(fullPath);
        },

        isActivePagePath: function (pagePath) {
            const fullPath = this.$route.fullPath;
            const pagePathRegexp = new RegExp(fullPath);
            return pagePathRegexp.test(pagePath);
        },

        isActivePathMatch: function (aPathExp) {
            const pagePathRegexp = new RegExp(aPathExp);
            const fullPath = this.$route.fullPath;
            return pagePathRegexp.test(fullPath);
        }
    }
};