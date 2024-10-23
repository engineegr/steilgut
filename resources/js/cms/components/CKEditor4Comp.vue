<template>
    <div id="ckeditor4" class="ckeditor4 tw-m-2">
        <ckeditor
            :editor-url="editorUrl"
            class="ckeditor4-container"
            v-model="thread"
            :config="editorConfig"
        ></ckeditor>
        <textarea
            name="ckeditor4Thread"
            class="tw-hidden sm:tw-hidden"
            id="ckeditor4-value"
            cols="30"
            rows="10"
            v-model="thread"
        ></textarea>
    </div>
</template>

<script>
export default {
    props: {
        content: {
            type: String,
            Default: "<p>Content of the editor.</p>",
        },
    },

    data() {
        return {
            editorUrl: "/build/js/ckeditor_4.16.0_70644fee2045/ckeditor.js",
            thread: this.content,
            editorConfig: {
                extraPlugins: "uploadimage,image2",
                // Upload images to a CKFinder connector (note that the response type is set to JSON).
                uploadUrl:
                    "/build/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json",

                // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                filebrowserBrowseUrl: "/build/php/ckfinder/ckfinder.html",
                filebrowserImageBrowseUrl:
                    "/build/php/ckfinder/ckfinder.html?type=Images",
                filebrowserUploadUrl:
                    "/build/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
                filebrowserImageUploadUrl:
                    "/build/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
                filebrowserWindowWidth: "1000",
                filebrowserWindowHeight: "700",
                width: "80%",
                margin: "auto",
            },
        };
    },

    beforeUpdate() {
        ("use strict");
        const ckeditor4HtmlElement = document.getElementById("cke_editor1");
        if (ckeditor4HtmlElement) {
            ckeditor4HtmlElement.style.margin = "auto";
        } else {
            console.warn("CKEditor4 [mounted] Couldn't find ckeditor4 container");
        }
    },
};
</script>

<style scoped>
.ckeditor4 {
    flex: 1 0 auto;
    flex-direction: column;
    align-items: stretch;
}
</style>
