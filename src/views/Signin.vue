<template>
<div class="q-pa-md">

    <div class="column items-center q-gutter-y-md">
        <div class="row q-col-gutter-xs">
            <div class="col">
                <q-input class="bg-white" outlined label="Username" style="width:290px;" stack-label v-model="uid" />
            </div>
        </div>
        <div class="row q-col-gutter-xs">
            <div class="col">
                <q-input class="bg-white" v-model="password" :type="isPwd ? 'password' : 'text'" label="Password" stack-label outlined style="width:290px;">
                    <template v-slot:append>
                        <q-icon :name="isPwd ? 'visibility_off' : 'visibility'" class="cursor-pointer" @click="isPwd = !isPwd" />
                    </template>
                </q-input>
            </div>
        </div>
        <div class="row q-col-gutter-xs">
            <div class="col">
                <q-btn color="blue-grey-6" class="q-px-xl q-py-xs" label="Sign In" @click="signin" style="width:290px;" />
            </div>
        </div>
          <div class="row q-col-gutter-xs">
            <div class="col">
                <label>Last Update : 2022-02-25 :10.00</label>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            // uid: "naylit-tw",
            // password: "Naylit@tw",
            uid: "",
            password: "",
            isPwd: true
        };
    },
    mounted() {

        this.$store.commit("setAuthen", false)
        this.$store.commit("setKey", "")
        this.$store.commit("setUID", "")
        // console.log("apiURI", this.$api)
        // console.log(this.$appName)
        // console.log("Sales", this.$store.getters.saleid)
    },
    methods: {
        async signin() {
            if (this.uid == "" || this.password == "") {
                this.$q.notify({
                    position: "top-right",
                    timeout: 2500,
                    textColor: "white",
                    color: "red",
                    message: "Please fill Username and Password!",
                    html: true
                });
                return false;

            }

            let params = new FormData();
            params.append("uid", this.uid);
            params.append("pwd", this.password);
            await axios({
                method: "post",
                url: this.$api + "signin.php/signin",
                data: params
            }).then(res => {
                console.log(res.data)
                if (res.data.authen == false) {
                    this.$q.notify({
                        position: "top-right",
                        timeout: 2500,
                        textColor: "white",
                        color: "red",
                        message: "Username or Password is fail!",
                        html: true
                    });
                } else {
                    this.$store.commit("setRole", res.data.role);
                    let params2 = new FormData();
                    params2.append("uid", this.uid);
                    params2.append("syscode", this.$syscode);
                    axios({
                        method: "post",
                        url: this.$api + "genkey.php",
                        data: params2
                    }).then(res => {
                        this.$store.commit("setAuthen", true);
                        this.$store.commit("setKey", res.data.key);
                        this.$store.commit("setUID", res.data.uid);
                        this.$router.replace({
                            name: "home"
                        });
                    })

                }
            });
        }

    }
}
</script>

<style>

</style>
