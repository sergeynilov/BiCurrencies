<template>
  <div class="column_content_centered p-1 m-0">

    <div class="row_content_centered">
      <div v-show="show_loading_image" class="loading"></div>
      <div style="display:flex; flex : 1 0 310px; align-self: center; border: 0px dotted red; " class="p-0"
           v-show="!show_loading_image">
        <h2 style="display: flex; flex-wrap: nowrap;" :class="header_class+' row_content_left_aligned'">
          <i v-show="header_icon" :class="header_icon+' m-0 mr-1 p-0'"></i>
          <span v-html="header_title"></span>
        </h2>
      </div>

      <div v-if="right_icon!= ''" style="display:flex; align-self: flex-end; border: 0px dotted blue; " class="mb-2">
        <i :class="'action_icon icon_right_text_margin '+right_icon_class" title="Refresh" WWW@click="triggerEditorHeaderRightButtonClickedEvent"></i>
      </div>

    </div>

    <div v-if="message" class="text-danger m-2" style="border: 0px dotted grey;">
      <strong>!!!{{ message }};;;</strong>
    </div>

  </div>

</template>

<script>

  export default {

    props: {
      message: {
        required: false,
        default: ''
      },
      header_class: {
        type: String,
        required: false,
        default: ''
      },
      header_title: {
        type: String,
        required: true,
        default: ''
      },
      header_icon: {
        type: String,
        required: false,
        default: ''
      },
      show_loading_image: {
        type: Boolean,
        required: true,
        default: true
      },

      right_icon: {
        type: String,
        required: false,
        default: ''
      },
      parent_component_key: {
        type: String,
        required: false,
        default: ''
      }

    },

    methods: {
      triggerEditorHeaderRightButtonClickedEvent () {
        // bus.$emit('editorHeaderRightButtonClickedEvent', this.parent_component_key)
      }
    },
    computed: {

      right_icon_class () {
        return this.right_icon + ' p-1 m-0'
      }

    } // computed: {

  }
</script>
