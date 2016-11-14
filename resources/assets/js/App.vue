<template>
    <div>
        <app-nav></app-nav>
        <router-view></router-view>
    </div>
</template>

<script>
import AppNav from './components/AppNav.vue';

export default {
    components: {
        AppNav
    }
}
</script>
