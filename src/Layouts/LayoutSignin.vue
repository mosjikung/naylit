<template>
<q-layout>
    <q-header elevated class="glossy bg-blue-grey">
        <q-toolbar>
            <q-toolbar-title>
               {{$appName}}
            </q-toolbar-title>

            <div></div>
        </q-toolbar>
    </q-header>

    <q-page-container>
        <router-view />
    </q-page-container>
</q-layout>
</template>

<script>
export default {
    data() {
        return {
            lastupdate: "2019-11-01 08:00"
            // leftDrawerOpen: this.$q.platform.is.desktop
        }
    }
}
</script>

<style>

</style>
