<template>
    <div class="container">
        <transition nam="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted');
        }
    }
</script>