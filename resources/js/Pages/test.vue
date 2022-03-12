<template>
<!--    <h1>resources/js/Pages/test.vue</h1>-->

    <div class="appWWW">
<!--        <ck-editor></ck-editor>-->
        <ckeditor :editor="editor" @blur="onEditorInput" v-model="editorData" :config="editorConfig"></ckeditor>

        <!--        <div class="menu">MENU</div>-->
<!--        <div class="header">HEADER</div>-->
<!--        <div class="content">CONTENT</div>-->
<!--        <div class="footer">FOOTER</div>-->
    </div>

</template>


<script>
// import AppLayout from '@/Layouts/AppLayout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    components: {
        // AppLayout,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                // The configuration of the editor.
            }
        }
    },
    methods: {
        onEditorInput() {
            console.log(this.editorData);
        }
    }
}
</script>

<style>

.app {
    height: 100vh;
    display: grid;
    grid-template-columns: auto 1fr;
    grid-template-rows: 56px 1fr 40px;
    grid-template-areas: "menu header" "menu content" "menu footer";
}

.menu {
    grid-area: "menu";
    width: 260px;
    height: 100vh;
    background-color: lightblue;
    /*transition: width 1s;*/
    overflow: hidden;
}

.app:hover .menu {
    width: 0px;
}

.header {
    grid-area: header;
}

.content {
    grid-area: content;
}

.footer {
    grid-area: footer;
}
</style>
