<template>
<q-layout>
    <q-header elevated class="glossy bg-blue-grey">
        <q-toolbar>
            <!-- <q-btn flat dense round @click="leftDrawerOpen = !leftDrawerOpen" aria-label="Menu" icon="menu" /> -->
            <q-toolbar-title>
                {{$appName}}
            </q-toolbar-title>

            <q-btn flat dense round icon="exit_to_app" @click="exit">
                <q-tooltip content-class="bg-red text-white">Exit Application</q-tooltip>
            </q-btn>
        </q-toolbar>
    </q-header>

    <!-- <q-drawer v-model="leftDrawerOpen" bordered content-class="bg-grey-2">
        <q-list>
            <q-item-label header>Essential Links</q-item-label>
            <q-item clickable tag="a" target="_blank" href="https://quasar.dev">
                <q-item-section avatar>
                    <q-icon name="home" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Home</q-item-label>
                    <q-item-label caption>Dashboard</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable tag="a" target="_blank" href="https://github.com/quasarframework/">
                <q-item-section avatar>
                    <q-icon name="code" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Github</q-item-label>
                    <q-item-label caption>github.com/quasarframework</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable tag="a" target="_blank" href="https://chat.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="chat" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Discord Chat Channel</q-item-label>
                    <q-item-label caption>chat.quasar.dev</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable tag="a" target="_blank" href="https://forum.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="forum" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Forum</q-item-label>
                    <q-item-label caption>forum.quasar.dev</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable tag="a" target="_blank" href="https://twitter.com/quasarframework">
                <q-item-section avatar>
                    <q-icon name="rss_feed" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Twitter</q-item-label>
                    <q-item-label caption>@quasarframework</q-item-label>
                </q-item-section>
            </q-item>
        </q-list>
    </q-drawer> -->

    <q-page-container>
        <router-view />
    </q-page-container>
</q-layout>
</template>

<script>
import axios from "axios";
export default {

    data() {
        return {
            // leftDrawerOpen: this.$q.platform.is.desktop
            leftDrawerOpen: false

        }
    },
    mounted() {
        //console.log("KEY From Default : " + this.$store.getters.key);
        //console.log("UID From Default : " + this.$store.getters.uid);
        console.log("Role From Default : " + this.$store.getters.role);

        let params = new FormData();
        params.append("uid", this.$store.getters.uid);
        params.append("key", this.$store.getters.key);
        params.append("syscode", this.$syscode);
        axios({
            method: "post",
            url: this.$api + "chkauthen.php",
            data: params
        }).then(res => {
            if (res.data.authen == false) {
                this.$router.replace({
                    name: "signin"
                })
            }
        })

    },
    methods: {
        exit() {
            this.$q
                .dialog({
                    title: "Confirm",
                    message: "Do you want to exit application?",
                    cancel: true,
                    persistent: true
                })
                .onOk(() => {
                    // console.log('>>>> OK')
                    this.$router.replace({
                        name: "signin"
                    });
                })
        }
    }

}
</script>

<style>

</style>
