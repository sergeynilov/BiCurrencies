<template>
    <footer class="main-footer">

        <strong>Copyright &copy; 2014-{{ currentDate.getFullYear() }} <inertia-link href="#">{{ $page.props.site_name }}</inertia-link>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>
</template>

<script>
export default {
    // copyright_text
    mounted() {
        // console.log('Footer mounted 1 this.role')
        // console.log(this.role)
    },

    data() {
        return {
            currentDate: new Date,
        }
    }
}
</script>
