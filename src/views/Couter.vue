<template>
<div>
    <br>
    <br>
    <br>
    <br>
    Couter
    <p>Counter: {{ counter }}</p>
    <button @click="updateCounter">Update</button>
</div>
</template>

<script>
import firebaseApp from '../firebase'

export default {
    data() {
        return {
            counter: {},
            salesid: '999'
        }
    },

    methods: {
        updateCounter() {
            //this.counter++
            var d = new Date();
            this.dbRef.set({
                time: d.toLocaleDateString() + " " + d.toLocaleTimeString()
            })
        }
    },
    created() {
        // สร้าง reference ไปยัง counter ซึ่งเป็น root node ของ reatime database
        this.dbRef = firebaseApp.database().ref('qn/sales/' + this.salesid)

    },

    mounted() {
        // สร้าง subscription สำหรับติดตามการเปลี่ยนแปลงของข้อมูล
        this.dbRef.on('value', ss => {
            console.log(ss.val())
            this.counter = ss.val()
        })
    },

    beforeDestroy() {
        // ยกเลิก subsciption เมื่อ component ถูกถอดจาก dom
        this.dbRef.off()
    }
}
</script>

<style>

</style>
